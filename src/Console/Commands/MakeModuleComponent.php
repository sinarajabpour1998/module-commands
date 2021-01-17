<?php

namespace SAR\ModuleCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:component';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view component class for specific module';

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
            $component_route = 'modules/' . $module_name . '/src/views/components/';
            $component_name = $this->ask('Enter your component name');
            if (!File::exists($component_route . $component_name . '.blade.php')){
                $this->call('make:component', ['name' => $component_name]);
                if(!File::exists($component_route)) {
                    File::makeDirectory($component_route,0777,true);
                }
                $command = "mv resources/views/components/$component_name" . ".blade.php $component_route";
                exec($command);
            }else{
                $this->error('Component already exists.');
            }
        }else{
            $this->error('Module does not exist.create the module using module:make command.');
        }
    }
}
