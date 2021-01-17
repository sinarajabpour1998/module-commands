<?php

namespace SAR\ModuleCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new form request class for specific module';

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
            $request_route = "modules/" . $module_name . "/src/Http/Requests/";
            $request_name = $this->ask('Enter your request name');
            $this->call('make:request', ['name' => $request_name]);
            if (!File::exists($request_route . $request_name . '.php')){
                if(!File::exists($request_route)) {
                    File::makeDirectory($request_route,0777,true);
                }
                $command = "mv app/Http/Requests/$request_name" . ".php $request_route";
                exec($command);
            }else{
                $this->error('Request already exists.');
            }
        }else{
            $this->error('Module does not exist.create the module using module:make command.');
        }
    }
}
