# Module Commands
Laravel module commands package, version 1.0.3

## Installiation
Using composer : 

`composer require sar/module-commands`

Packagist : https://packagist.org/packages/sar/module-commands

## Usage
This package provides module artisan commands for laravel apps.
You can always checkout new commands by `php artisan list` , 
module section

`php artisan <command>` without any name or arguments 

After creating new module, controller or model (etc...) , you must change 
the namespace of the created file. this package can not set the namespaces
based on module name (until version 1.0.3).

## Available Commands

### Version 1.0.0

`module:make`          Create a new module structure and service provider

`module:controller`    Create a new controller class for specific module

`module:migration`     Create a new migration file for specific module

`module:model`         Create a new Eloquent model class for specific module

`module:seeder`        Create a new seeder class for specific module

### Version 1.0.2

`module:component`     Create a new view component class for specific module

`module:observer`      Create a new observer class for specific module

`module:request`       Create a new form request class for specific module
