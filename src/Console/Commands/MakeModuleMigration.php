<?php

namespace SAR\ModuleCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration file for specific module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $module_name = $this->ask('Enter your module name');
        if(File::exists('modules/' . $module_name)) {
            $migration_name = $this->ask('Enter your migration name');
            $this->call('make:migration', ['name' => $migration_name]);
            $migration_route = "modules/" . $module_name . "/src/database/migrations/";
            if(!File::exists($migration_route)) {
                File::makeDirectory($migration_route,0777,true);
            }
            $command = "mv database/migrations/*_$migration_name" . ".php $migration_route";
            exec($command);
        }else{
            $this->error('Module does not exist.create the module using module:make command.');
        }
    }
}
