<?php namespace Tresyz\HellesManager\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Install extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'admin:install';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Install all admin resources';

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
   * @return mixed
   */
  public function fire()
  {
    $this->info('Installing all required resources');
    $this->info('- Installing migrations');
    $this->call('migrate:install', array());
    $this->info('- Migrate Sentry');
    $this->call('migrate', array('--package' => 'cartalyst/sentry'));
    $this->info('- Publish manager assets');
    $this->call('asset:publish', array('argument' => 'tresyz/helles-manager'));
    $this->info('- Seeding the manager tables');
    $this->call('db:seed', array('--class' => 'ManagerTableSeeder'));
    if($this->option('add-user') !== FALSE) {
      $this->info('- Creating a new user');
      $this->call('admin:add-user', array());
    }
  }

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return array();
  }

  /**
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {
    return array(
      array('add-user', 'add', InputOption::VALUE_OPTIONAL, 'Should I take you to create a new user?', FALSE),
    );
  }

}
