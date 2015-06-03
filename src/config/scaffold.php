<?php

return [

    /*
     * Path for scaffolding controllers.
     * If 'prefix' is used when scaffolding
     * that folder will be added to these paths
    */
    'controllers_path'  => './app/Http/Controllers/',


    /*
     * Path for scaffolding models.
     * If 'prefix' is used when scaffolding
     * that folder will be added to these paths
    */
    'models_path' => './app/Repositories/',

    /*
     * Path for scaffolding models.
     * If 'prefix' is used when scaffolding
     * that folder will be added to these paths
    */
    'models_command_path' => 'Repositories/',


    /*
     * Path for scaffolding seeds.
     * If 'prefix' is used when scaffolding
     * that folder will be added to these paths
    */
    'seeds_path' => './database/seeds/',


    /*
     * Path for scaffolding views.
     * If 'prefix' is used when scaffolding
     * that folder will be added to these paths
    */
    'views_path' => './resources/views/',


    /*
     * 'prefix' is an option for scaffold command.
     * Setting this to true will add prefix to controllers folders.
    */
    'prefix_controllers' => true,

    /*
     * 'prefix' is an option for scaffold command.
     * Setting this to true will add prefix to models folders.
    */
    'prefix_models' => true,

    /*
     * 'prefix' is an option for scaffold command.
     * Setting this to true will add prefix to seeds folders.
    */
    'prefix_seeds' => true,

    /*
     * 'prefix' is an option for scaffold command.
     * Setting this to true will add prefix to views folders.
    */
    'prefix_views' => true

];