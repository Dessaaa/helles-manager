<?php namespace Tresyz\HellesManager\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AddUser extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:add-user';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add new user to the admin section';

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
    $first_name = $this->option('first_name');
    $last_name = $this->option('last_name');
    $email = $this->option('email');
    $password = $this->option('password');
    $group = $this->option('group');
    if(!$first_name) {
      $first_name = $this->ask('First name: ');
    }
    if(!$last_name) {
      $last_name = $this->ask('Last name: ');
    }
    if(!$email) {
      $email = $this->ask('E-mail: ');
    }
    if(!$password) {
      $password = $this->secret('Password: ');
    }
    if(!$group) {
      $group = $this->secret('Group: ');
    }

    try {
      $user = \Sentry::getUserProvider()->create(array(
          'email'       => $email,
          'password'    => $password,
          'first_name'  => $first_name,
          'last_name'   => $last_name,
          'activated'   => 1,
      ));

      $group = \Sentry::getGroupProvider()->findByName($group);
      $user->addGroup($group);
      $this->info('User created, now you can login.');
    } catch(\Exception $e) {
      $this->error($e->getMessage());
    }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(  
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
      array('first_name', 'f', InputOption::VALUE_REQUIRED, 'User first name.'),
      array('last_name', 'l', InputOption::VALUE_OPTIONAL, 'User last name.'),
      array('email', 'e', InputOption::VALUE_OPTIONAL, 'User e-mail.'),
      array('password', 'p', InputOption::VALUE_OPTIONAL, 'User password.'),
      array('group', 'g', InputOption::VALUE_OPTIONAL, 'User group.'),
		);
	}

}
