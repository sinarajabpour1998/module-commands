<?php

namespace SAR\ModuleCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class for specific module';

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
            $model_name = $this->ask('Enter your model name');
            $this->call('make:model', ['name' => $model_name]);
            $model_route = "modules/" . $module_name . "/src/Models/";
            if(!File::exists($model_route)) {
                File::makeDirectory($model_route,0777,true);
            }
            $command = "mv app/Models/$model_name" . ".php $model_route";
            exec($command);
        }else{
            $this->error('Module does not exist.create the module using module:make command.');
        }
    }
}
