<?php namespace Tresyz\HellesManager\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Pluralizer;

class Scaffold extends \Way\Generators\Commands\ScaffoldGeneratorCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:scaffold';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate a manager scaffold';

  public function fire()
  {
    // // Scaffolding should always begin with the singular
    // // form of the now.
    $this->model = Pluralizer::singular($this->argument('name'));

    $this->fields = $this->option('fields');

    if (is_null($this->fields))
    {
        throw new \Way\Generators\Commands\MissingFieldsException('You must specify the fields option.');
    }

    // // We're going to need access to these values
    // // within future commands. I'll save them
    // // to temporary files to allow for that.
    $this->cache->fields($this->fields);
    $this->cache->modelName($this->model);

    $this->generateModel();
    $this->generateController();
    $this->generateViews();
    $this->generateMigration();
    $this->generateSeed();

    $this->updateRoutesFile($this->model);
    $this->info('Updated ' . app_path() . '/routes.php');

    $this->updateMenu($this->model);
    $this->info('Updated admin menu');

    // // We're all finished, so we
    // // can delete the cache.
    $this->cache->destroyAll();
  }

  protected function generateController()
  {
    $name = Pluralizer::plural($this->model);

    if(!\File::exists('app/controllers/Admin')){
      \File::makeDirectory('app/controllers/Admin');
    }

    $this->call(
      'generate:controller',
      array(
        'name' => "{$name}Controller",
        '--path' => "app/controllers/Admin/",
        '--template' => $this->getControllerTemplatePath()
      )
    );
  }

  /**
   * Call generate:views
   *
   * @return void
   */
  protected function generateViews()
  {
    if(!\File::exists('app/views/admin')){
      \File::makeDirectory('app/views/admin');
    }

    $viewsDir = app_path().'/views/admin';
    $container = $viewsDir . '/' . Pluralizer::plural($this->model);
    $layouts = $viewsDir . '/layouts';
    $views = array('index', 'show', 'create', 'edit', '_form', '_header');

    $this->generator->folders(
      array($container)
    );

    // If generating a scaffold, we also need views/layouts/scaffold
    $views[] = 'template';
    $this->generator->folders($layouts);

    // Let's filter through all of our needed views
    // and create each one.
    foreach($views as $view) {
      $path = $view === 'template' ? $layouts : $container;
      $this->generateView($view, $path);
    }
  }

  protected function generateView($view, $path)
  {
      $this->call(
            'admin:generate-view',
            array(
                'name'       => $view,
                '--path'     => $path,
                '--template' => $this->getViewTemplatePath($view)
            )
        );
  }

  /**
   * Get the path to the template for a controller.
   *
   * @return string
   */
  protected function getControllerTemplatePath()
  {
    return __DIR__.'/../../../templates/scaffold/controller.txt';
  }

  /**
   * Get the path to the template for a view.
   *
   * @return string
   */
  protected function getViewTemplatePath($view = 'view')
  {
    return __DIR__."/../../../templates/scaffold/views/{$view}.txt";
  } 

  /**
   * Update app/routes.php
   *
   * @param  string $name
   * @return void
   */
  public function updateRoutesFile($name)
  {
    $name = strtolower(Pluralizer::plural($name));

    \File::append(
      app_path() . '/routesAdmin.php',
      "Route::resource('" . $name . "', 'Admin\\" . ucwords($name) . "Controller');\n"
    );
  }

  /**
   * Update app/views/admin/templates/_menu.blade.php
   *
   * @param  string $name
   * @return void
   */
  public function updateMenu($name)
  {
    $name = strtolower(Pluralizer::plural($name));

    if(!\File::exists('app/views/admin/templates/_menu.blade.php')) {
      $menu = \File::get(__DIR__ . '/../../../views/admin/templates/_menu.blade.php');
      $menu = str_replace('</ul>', '', $menu);
    } else {
      $menu = \File::get('app/views/admin/templates/_menu.blade.php');
      $menu = str_replace('</ul>', '', $menu);
    }
    if(!\File::exists('app/views/admin/')) {
      \File::makeDirectory('app/views/admin/');
    }
    if(!\File::exists('app/views/admin/templates')) {
      \File::makeDirectory('app/views/admin/templates');
    }

    

    $label = $this->option('menu_name') ?: ucwords($name);
    $icon = $this->option('menu_icon') ?: 'fa-cog';

    $menu.= <<<EOT
<li @if(Route::currentRouteName() == 'admin.$name') class="active" @endif>
  {{ HTML::decode(link_to_route('admin.$name.index', '<i class="fa $icon icon"></i><span class="hidden-tablet"> $label</span>')) }}
</li>
EOT;

    $menu.= "\n</ul>";

    \File::put(
      'app/views/admin/templates/_menu.blade.php',
      $menu
    );

  }

  protected function getOptions()
  {
    $options = parent::getOptions();
    $options[] = array('menu_name', null, InputOption::VALUE_OPTIONAL, 'Menu name', null);
    $options[] = array('menu_icon', null, InputOption::VALUE_OPTIONAL, 'Menu icon', null);

    return $options;
  }

}
