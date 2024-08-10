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
        // guardaremos los filds de node
        // $nodes=Node::get();
        // foreach ($nodes as $node) {
        //     $this->info('Node: '.$node->table_name);
        //     $columns=$this->getColumnsNode($node);
        // }
    }


    //funcion donde se tiene que implementar la logica para obtener las columnas de una tabla
    protected function getColumnsNode($node){
        $table=$node->table_name;
        $columns = [];
        $num=0;
        $display_list='show';
        $display_item='show';
        $table_schema = $this->getColumns($table);
        // $this->info('Tabla: '.$table);
        foreach ($table_schema as $key=>$column) {
            if (strpos($column['name'], '_id') !== false) {
                $this->getRelationColum($table,$column['name']);
            }
            // armamos el tipo y el name de la columna  donde llamamos la funcion del service ColumnTypeMap
            $model_relation = null;
            $table_relation = null;
            foreach ($this->relations as $relation) {
                if (array_key_exists($column['name'], $relation)) {
                    $model_relation = $relation[$column['name']]['model_relation'];
                    $table_relation = $relation[$column['name']]['table'];
                }
            }
            if($num>5||$column['name']==='created_at' || $column['name']==='updated_at' || $column['name']==='deleted_at'){
                $display_list='excel';
                $display_item='none';
            }
            $field=Field::create([
                'parent_id' => $node->id,
                'order'=>($num+=1),
                'name' => $column['name'],
                'trans_name'=>$column['name'],
                'type' => $this->columnTypeMap->getColumnType($column['type'], $column['name']),
                'display_list'=>$display_list,
                'display_item'=>$display_item,
                'relation' => strpos($column['name'], '_id') !== false ? 1 : 0,
                'required' => $column['nullable'] === 1 ? 1 : 0,
                'label' =>'field.'.$column['name'],
                'placeholder' => null,
                'relation_cond' => $model_relation??null,
                'value' => $table_relation??null,
            ]);
            if($column['type_name']==='Enum' || $column['type_name']==='enum'){
                $options=$column['type'];//enum('option1','option2')
                $options=explode("','",substr($options,6,-2));
                $this->createFieldOptions($options,$field->id);
            }
            if ($column['type_name']==='tinyint') {
                $options=['No','Si'];
                $this->createFieldOptions($options,$field->id);
            }
        }
        return $columns;
    }

    // funcion para crear los fieldsOptions
    protected function createFieldOptions($options,$parent_id){
        foreach ($options as $option) {
            FieldOption::create([
                'parent_id'=>$parent_id,
                'name'=>$option,
                'label'=>'admin.'.$option,
            ]);
        }
    }

    // funcion para obtner la relacion de una tabla  y columan que termina en _id
    protected function getRelationColum($table,$name){
        if (in_array($table, $this->table_relation)) {
            return [];
        }
        $this->table_relation[] = $table;
        $columns= $this->getRelations($table);
        foreach ($columns as $column) {
            $this->relations[] = [
                $column['columns'][0] => [
                    'table' => $column['foreign_table'],
                    // 'model_relation' => 'App\\Models\\'.ucfirst($column['foreign_table']),
                    'model_relation'=>$this->getDirModel($column['foreign_table'])
                ]
            ];
        }
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
