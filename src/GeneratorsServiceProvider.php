<?php

namespace janareit\L5scaffold;

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->publishes([__DIR__ . '/config/scaffold.php' => config_path('scaffold.php')]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->mergeConfigFrom(__DIR__ . '/config/scaffold.php', 'scaffold');
		$this->registerScaffoldGenerator();

	}


	/**
	 * Register the make:scaffold generator.
	 */
	private function registerScaffoldGenerator()
	{
		$this->app->singleton('command.larascaf.scaffold', function ($app) {
			return $app['janareit\L5scaffold\Commands\ScaffoldMakeCommand'];
		});

		$this->commands('command.larascaf.scaffold');
	}


}
