<?php

namespace SAR\ModuleCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class for specific module';

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
            $controller_name = $this->ask('Enter your controller name');
            $this->call('make:controller', ['name' => $controller_name]);
            $command = "mv app/Http/Controllers/$controller_name" . ".php modules/" . $module_name . "/src/Http/Controllers/";
            exec($command);
        }else{
            $this->error('Module does not exist.create the module using module:make command.');
        }
    }
}
