<?php

namespace App\Console\Commands;

use Doctrine\DBAL\DriverManager;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Console\Commands\CrudCommand;
use App\Models\Field;
use App\Models\FieldOption;
use App\Models\Node;
use App\Services\ColumnTypeMap;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class NodeCommand extends CrudCommand{


    protected $columnTypeMap;
    protected $table_relation=[];
    protected $relations=[];

    // inyectamos el servicio ColumnTypeMap
    public function __construct(ColumnTypeMap $columnTypeMap){
        parent::__construct();
        $this->columnTypeMap = $columnTypeMap;
    }



    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crud-node';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando Para node';

    /**
     * Execute the console command.
     */
    public function handle(){
        $this->info('Crud Command');
        $this->runCommands('config:cache');
        $this->runCommands('migrate:fresh');
        $tables = $this->getTables();
        foreach ($tables as $key => $table) {
            $this->info("Table: $table");
            $model_name = str_replace('_','-',Str::studly(Str::singular($table)));
            $this->modelExists($model_name,$table);
            $node=$this->createNode($table);
            $this->getColumnsNode($node);
        }
        $this->runCommands('config:clear');
        // ejecutamos seeders
        $this->info('Run Seeders');
        $this->runCommands('db:seed');
        $this->info('End Command');
    }


    //funcion donde se tiene que implementar la logica para obtener las columnas de una tabla
    protected function getColumnsNode($node) {
        $table = $node->table_name;
        $tableSchema = $this->getColumns($table);
        $displayThreshold = 6;

        return collect($tableSchema)->map(function ($column, $key) use ($node, &$displayThreshold, $table) {
            $displayThreshold--;
            $isRelation = str_contains($column['name'], '_id');
            if ($isRelation) {
                $this->getRelationColumn($table, $column['name']);
            }
            $relation = $this->relations[$column['name']] ?? null;
            // $value_relation=$relation['table']!=null?$relation['table']: null;
            $required=1;
            if($column['nullable']){
                $required=0;
            }
            if($node->name == 'field'){
                $required=0;
            }
            $field=Field::create([
                'parent_id' => $node->id,
                'order' => $key + 1,
                'name' => $column['name'],
                'trans_name' => $column['name'],
                'type' => $this->columnTypeMap->getColumnType($column['type'], $column['name']),
                'display_list' => $this->getDisplayList($displayThreshold, $column['name']),
                'display_item' => $this->getDisplayItem($displayThreshold, $column['name']),
                'relation' => $isRelation ? 1 : 0,
                'required' => $required??0,
                'label' => "field.{$column['name']}",
                'placeholder' => null,
                'relation_cond' => $relation['model_relation'] ?? null,
                'value' => $relation['table'] ?? null,
            ]);
            $this->handleSpecialFieldTypes($field,$column['type_name'],$column['type']);
            return $field;
        })->all();
    }

    private function getDisplayList($threshold, $name): string {
        return $threshold <= 0 || in_array($name, ['created_at', 'updated_at', 'deleted_at']) ? 'excel' : 'show';
    }

    private function getDisplayItem($threshold, $name): string {
        return in_array($name, ['created_at', 'updated_at', 'deleted_at','id','email_verified_at']) ? 'none' : 'show';
    }

    private function handleSpecialFieldTypes(Field $field,$type,$option): void {
        if (in_array($type, ['enum', 'tinyint'])) {
            $options = $type === 'enum'
                ? explode("','", substr($option, 6, -2))
                : ['No', 'Si'];

            $this->createFieldOptions($options, $field->id);
            $field->type='select';
            $field->save();
        }
    }

    // funcion para crear los fieldsOptions
    protected function createFieldOptions($options, $parent_id) {
        collect($options)->each(function ($option) use ($parent_id) {
            $num=0;
            FieldOption::create([
                'parent_id' => $parent_id,
                'name' => $option,
                'label' => "admin.{$option}",
            ]);
        });
    }

    // funcion para obtner la relacion de una tabla  y columan que termina en _id
    protected function getRelationColumn($table, $name) {
        if (in_array($table, $this->table_relation)) {
            return;
        }

        $this->table_relation[] = $table;
        $columns = $this->getRelations($table);

        $this->relations = array_merge(
            $this->relations,
            collect($columns)->mapWithKeys(function ($column) {
                return [
                    $column['columns'][0] => [
                        'table' => Str::singular($column['foreign_table']),
                        'model_relation' => $this->getDirModel($column['foreign_table'])
                    ]
                ];
            })->all()
        );
    }

    protected function getDirModel($name) {
        $modelName=Str::studly(Str::singular($name));
        $modulePath = base_path('app/Master/Models/' . $modelName . '.php');
        $systemPath = base_path('app/Models/' . $modelName . '.php');
        if (File::exists($modulePath)) {
            $dirModel='App\\Master\\Models\\'.$modelName;
            return $dirModel;
        }
        if (File::exists($systemPath)) {
            $dirModel='App\\Models\\'.$modelName;
            return $dirModel;
        }

        return null;
    }
    // funcion par crear el node
    protected function createNode($table){
        if(Node::where('table_name',$table)->exists()){
            return;
        }
        $node=Node::create([
            'name'=>str_replace('_','-',Str::singular($table)),
            'table_name'=>$table,
            'model'=>$this->getDirModel($table),
            'singular'=>'node.'.$table,
            'plural'=>'nodes.'.$table,
        ]);
        return $node;
    }

    // verificamos si existe la el modelo
    protected function modelExists($model_name,$table){
        $model_exist_master=base_path('vendor/yedrick/master/src/app/Models/'.$model_name.'.php');
        $model_exist=app_path('Models\\'.$model_name.'.php');
        if(!file_exists($model_exist) && !file_exists($model_exist_master)){
            $this->info('Crear Modelo');
            $this->createModel($table);
        }
    }

    // creamos el modelo  por stub
    protected function createModel($table){
        Artisan::call('make:model-master', ['table' => $table]);
    }

}
