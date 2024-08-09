<?php

namespace App\Console\Commands;

use Doctrine\DBAL\DriverManager;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Console\Commands\CrudCommand;
use App\Models\Field;
use App\Models\Node;
use App\Services\ColumnTypeMap;
use Illuminate\Support\Facades\Artisan;

class NodeCommand extends CrudCommand   {


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
        //  Ejectuar comandos de crear base de datos y tablas pero primero borramos la base de datos
        $this->runCommands('config:cache');
        // creamos la base de datos
        $this->runCommands('migrate:fresh');
        $tables = $this->getTables();
        $tables_array=[];
        foreach ($tables as $key => $table) {
            $this->info("Table: $table");
            $model_name = str_replace('_','-',Str::studly(Str::singular($table)));
            $model_exist_master=base_path('vendor/yedrick/master/src/app/Models/'.$model_name.'.php');
            $model_exist=app_path('Models\\'.$model_name.'.php');
            if(!file_exists($model_exist) && !file_exists($model_exist_master)){
                $this->info('Crear Modelo');
                $this->createModel($table,$table);
            }
            $model=$this->getDirModel($table);
            $node=[
                'name'=>str_replace('_','-',Str::singular($table)),
                'table_name'=>$table,
                'model'=>$model,
                'singular'=>'',
                'plular'=>'',
            ];
            $columns = $this->getColumnsNode($table);
            $node_create=Node::create($node);
            // obtner  el nodo creado
            $this->info('NODE');
            $this->info($node_create);
            $columns['parent_id']=>$node_create->id;
            Field::crete()

            // $this->info("Columns: ".json_encode($columns));
        }
        // $this->info(json_encode($tables_array));
    }
    //funcion donde se tiene que implementar la logica para obtener las columnas de una tabla
    protected function getColumnsNode($table){
        $columns = [];
        $num=0;
        $display_list='show';
        $display_item='show';
        $table_schema = $this->getColumns($table);
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
            if($key<=4||$column['name']==='created_at' || $column['name']==='updated_at'){
                $display_list='excel';
                $display_item='excel';
            }
            $columns[] = [
                'order'=>$num+1,
                'name' => $column['name'],
                'trans_name'=>$column['name'],
                'type' => $this->columnTypeMap->getColumnType($column['type'], $column['name']),
                'singular' => '',
                'plural' => '',
                'display_list'=>$display_list,
                'display_item'=>$display_item,
                'relation_cond' => $model_relation??null,
                'value' => $table_relation??null,
            ];
        }
        return $columns;
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
        $model=null;
        if (file_exists(app_path('Models\\'.str_replace('_','-',Str::studly($name)).'.php'))) {
            $model = '\App\\Models\\'.str_replace('_','-',Str::studly($name));
        }elseif (file_exists(base_path('vendor/yedrick/master/src/app/Models/'.str_replace('_','-',Str::studly($name)).'.php'))){
            $model = '\yedrick\Master\App\Models\\'.str_replace('_','-',Str::studly($name));
        }elseif (file_exists(app_path('Models\\'.Str::studly(Str::singular($name)).'.php'))) {
            $model= 'App\\Models\\'.Str::studly($name).'.php';
        }
        if ($model===null) {
            $this->info('Modelo no encontrado');
        }
        return $model;
    }

    // creamos el modelo  por stub
    protected function createModel($table){
        $this->info('Creando Modelo');
        Artisan::call('make:model-master', ['table' => $table]);
    }

}
