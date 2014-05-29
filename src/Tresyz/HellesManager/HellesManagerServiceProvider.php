<?php namespace Tresyz\HellesManager;

use Illuminate\Support\ServiceProvider;

class HellesManagerServiceProvider extends ServiceProvider {

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
	public function boot()
	{
    $this->package('tresyz/helles-manager');

    include __DIR__.'/../../routes.php';
    include __DIR__.'/../../filters.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
    $cache = new \Way\Generators\Cache($this->app['files']);
    $resource_generator = new \Way\Generators\Generators\ResourceGenerator($this->app['files']);
    $view_generator = new \Tresyz\HellesManager\Generators\ViewGenerator($this->app['files'], $cache);

    $this->app['admin.add.user'] = $this->app->share(function() {
      return new Commands\AddUser();
    });
    $this->app['admin.remove.user'] = $this->app->share(function() {
      return new Commands\RemoveUser();
    });
    $this->app['admin.scaffold'] = $this->app->share(function() use($resource_generator, $cache) {
        
      return new Commands\Scaffold($resource_generator, $cache);
    });

    $this->app['admin.generate.view'] = $this->app->share(function() use($view_generator) {
      return new Commands\ViewGenerator($view_generator);
    });
    
    $this->commands('admin.add.user');
    $this->commands('admin.remove.user');
    $this->commands('admin.scaffold');
    $this->commands('admin.generate.view');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
