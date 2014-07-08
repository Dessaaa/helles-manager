<?php 
class ManagerTableSeeder extends Seeder {

  public function run()
  {
    Eloquent::unguard();
    DB::table('groups')->delete();

    Sentry::getGroupProvider()->create(array(
      'name'        => 'Admin',
      'permissions' => array(
      'admin'       => 1,
      ),
    ));
    Sentry::getGroupProvider()->create(array(
      'name'        => 'Manager',
      'permissions' => array(
      ),
    ));
    $this->command->info('Managers tables seeded!');
  }

}
