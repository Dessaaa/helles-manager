<?php namespace Tresyz\HellesManager\Admin;

use LaravelBook\Ardent\Ardent;

class UserController extends BaseAdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    $users = \Sentry::findAllUsers();
    \Debugbar::info($users);

    $this->layout->content = \View::make('helles-manager::admin.user.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    $groups = \Sentry::findAllGroups();
    $ar_groups = array();
    foreach($groups as $group) {
      $ar_groups[$group->id] = $group->name;
    }
    $this->layout->content = \View::make('helles-manager::admin.user.create')
      ->with('user', new \User())
      ->with('groups', $ar_groups);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    $input = \Input::get();
    $group_id = $input['group_id'];
    try {
      $rules = array(
        'first_name'  => 'required',
        'last_name'   => 'required',
        'email'       => 'required|email|unique:users',
        'email'       => 'required|email|unique:users',
        'password'    => 'required|min:8|same:confirm',
        'confirm'     => 'required',
        'activated'     => 'required'
      );

      //validate the inputs
      $validation = \Validator::make($input, $rules);
      if($validation->fails()) {
        \Notification::error('Confira os campos obrigatórios antes de continuar');
        return \Redirect::route('admin.user.create')
          ->withErrors($validation)
          ->withInput();
      } else {
        unset($input['confirm']);     
        unset($input['group_id']);     
        $user = \Sentry::createUser($input);
        if($user) {
          \Notification::success('Usuário adicionado com sucesso!');
          return \Redirect::route('admin.user.index');
        }
      }

      $adminGroup = Sentry::findGroupById($group_id);
      $user->addGroup($adminGroup);
    } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
      echo 'Login field is required.';
    } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
      echo 'Password field is required.';
    } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
      echo 'User with this login already exists.';
    } catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
      echo 'Group was not found.';
    }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
    $user = \User::find($id);
    $groups = \Sentry::findAllGroups();
    $ar_groups = array();
    foreach($groups as $group) {
      $ar_groups[$group->id] = $group->name;
    }
    $groups = $ar_groups;
    if(is_null($user)) {
      return Redirect::route('admin.user.index');
    }

    $this->layout->content = \View::make('helles-manager::admin.user.edit', compact('user', 'groups'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::get();
    try {
      $rules = array(
        'email'  => 'required|email|unique:users,id,' . $id,
        'password' => 'required|min:8|same:confirm',
        'confirm' => 'required'
      );
      if(empty($input['password']) && empty($input['confirm'])) {
        unset($rules['password'], $rules['confirm']);
      }
      //validate the inputs
      $validation = \Validator::make($input, $rules);

      if($validation->fails()) {
        $failed = $validation->failed();
        \Notification::error('Confira os campos obrigatórios antes de continuar');
        return \Redirect::route('admin.user.edit', $id)
          ->withErrors($validation)
          ->withInput();
      } else {
        unset($input['confirm']);     
        $user = \Sentry::findUserById($id);
        $user->email = $input['email'];
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->activated = $input['activated'];
        if(!empty($input['password'])) {
          $user->password = $input['password'];
        }
        //get groups
        foreach($user->getGroups() as $group) {
          $user->removeGroup($group->id);
        }

        $group = \Sentry::findGroupById($input['group_id']);
        $user->addGroup($group);
        if($user->save()) {
          \Notification::success('Usuário alterado com sucesso!');
          return \Redirect::route('admin.user.index');
        }
      }
    } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
      echo 'Login field is required.';
    } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
      echo 'Password field is required.';
    } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
      echo 'User with this login already exists.';
    } catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
      echo 'Group was not found.';
    }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try {
      // Find the user using the user id
      $user = \Sentry::findUserById($id);

      // Delete the user
      $user->delete();
      \Notification::info('Usuário removido com sucesso.');
    } catch(\Exception $e) {
      \Notification::error('Houve um problema ao excluir o usuário.');
    }
    return \Redirect::route('admin.user.index');
	}

}
