<?php

namespace SAR\ModuleCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleObserver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:observer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new observer class for specific module';

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
            $observer_route = 'modules/' . $module_name . '/src/Observers/';
            $observer_name = $this->ask('Enter your observer name');
            if (!File::exists($observer_route . $observer_name . '.php')){
                $this->call('make:observer', ['name' => $observer_name]);
                if(!File::exists($observer_route)) {
                    File::makeDirectory($observer_route,0777,true);
                }
                $command = "mv app/Observers/$observer_name" . ".php $observer_route";
                exec($command);
            }else{
                $this->error('Observer already exists.');
            }
        }else{
            $this->error('Module does not exist.create the module using module:make command.');
        }
    }

    public function makeModuleDir($directory)
    {
        File::makeDirectory('modules/' . $directory,0777,true);
    }
}
