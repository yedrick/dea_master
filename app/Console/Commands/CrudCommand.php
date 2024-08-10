<?php

namespace App\Console\Commands;

use Doctrine\DBAL\DriverManager;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;

class CrudCommand extends Command {

    protected Filesystem $files;
    protected array $tableColumns = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        foreach ($tables as $key => $table) {
            $this->info("Table: $table");
            $columns = $this->getColumns($table);
            // $this->info("Columns: ".json_encode($columns));
            $this->info("Relations: ".json_encode($this->getRelations($table)));
        }

    }
    //funcion para obtener las tablas de la base de datos
    protected function getTables(){
        $ignoreTables = [
            'migrations', 'sessions', 'oauth_auth_codes', 'oauth_access_tokens', 'oauth_refresh_tokens', 'oauth_clients',
            'oauth_personal_access_clients', 'personal_access_tokens','failed_jobs','cache','cache_locks','job_batches','jobs','password_reset_tokens',
        ];
        $tables = [];
        $table_schema = Schema::getTables();
        foreach ($table_schema as $table) {
            $tables[] = $table['name'];
        }
        $tables = array_values( array_filter($tables, function($el) use( $ignoreTables ) {
			return !in_array( $el, $ignoreTables);
		}));
        return $tables;
    }

    protected function getColumns($table): ?array{
            $tableColumns = Schema::getColumns($table);
        return $tableColumns;
    }

    // funcion para verificar  typo de columana
    protected function getColumnTypeDb($table, $column,$fullDefinition=false){
        $tableColumns = Schema::getColumns($table,$column,$fullDefinition);
        return $tableColumns;
    }

    // funcion para verificar las relaciones de una tabla
    protected function getRelations($table){
        // $indexs=Schema::getIndexListing($table);
        // $indexs=Schema::getIndexes($table);
        $indexs=Schema::getForeignKeys($table);
        return $indexs;
    }


    protected function tableExists($table): bool{
        return Schema::hasTable($table);
    }

    // creamos una funcion para correr comandos
    protected function runCommands($command){
        $this->call($command);
    }


    protected function getStub($type){
        // return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function getModelNamespace($model){
        return "App\\Models\\$model";
    }

    protected function getControllerNamespace($controller){
        return "App\\Http\\Controllers\\$controller";
    }

    protected function getMigrationNamespace($migration){
        return "database\\migrations\\$migration";
    }

    protected function getFactoryNamespace($factory){
        return "database\\factories\\$factory";
    }

}
