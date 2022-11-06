<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Services Path
    |--------------------------------------------------------------------------
    |
    | This value has the path of the service folder. This package will create
    | create all the service layer inside this folder. By default, the package
    | will create service file on App\Services folder.
    |
    */

    'service_folder_path' => app_path('Services'),

    /*
    |--------------------------------------------------------------------------
    | Stub folder path
    |--------------------------------------------------------------------------
    |
    | This value has the path of the stub folder when it's published. By
    | default, it will be located in a folder called 'stub', in the root
    | directory of the Laravel project.
    |
    */

    'stub_folder_path' => base_path('stub'),

    /*
    |--------------------------------------------------------------------------
    | Parameters
    |--------------------------------------------------------------------------
    |
    | This are the parameters passed to [make:all] command, to create all layers
    | of the project. By default, it creates migration, factory, seeder, model
    | and controller. You can modify it to satisfy your needs.
    |
    */

    'parameters' => '-mfsc'
];
