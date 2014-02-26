<?php namespace Tresyz\HellesManager\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RemoveUser extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:remove-user';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remove user from admin section';

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
    $email = $this->option('email');
    if(!$email) {
      $email = $this->ask('E-mail: ');
    }

    try {
      $user = \Sentry::findUserByCredentials(array(
        'email'      => $email,
      ));

      $user->delete();
      $this->info('User deleted.');
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
      array('email', 'e', InputOption::VALUE_OPTIONAL, 'User e-mail.')
		);
	}

}
