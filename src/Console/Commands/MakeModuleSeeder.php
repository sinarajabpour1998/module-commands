<?php

namespace SAR\ModuleCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new seeder class for specific module';

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
            $seeder_route = "modules/" . $module_name . "/src/database/seeders/";
            $seeder_name = $this->ask('Enter your seeder name');
            if (!File::exists($seeder_route . $seeder_name . '.php')){
                $this->call('make:seeder', ['name' => $seeder_name]);
                if(!File::exists($seeder_route)) {
                    File::makeDirectory($seeder_route,0777,true);
                }
                $command = "mv database/seeders/$seeder_name" . ".php $seeder_route";
                exec($command);
            }else{
                $this->error('Seeder already exists.');
            }
        }else{
            $this->error('Module does not exist.create the module using module:make command.');
        }
    }
}
