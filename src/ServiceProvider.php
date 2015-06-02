<?php namespace Cviebrock\EloquentReplaceable;

use Illuminate\Support\ServiceProvider as BaseProvider;


class ServiceProvider extends BaseProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;


	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot() {
		$configPath = __DIR__ . '/../config/replaceable.php';
		$this->publishes([$configPath => config_path('replaceable.php')]);
		$this->mergeConfigFrom($configPath, 'replaceable');
	}


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
	}


	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return [];
	}
}
