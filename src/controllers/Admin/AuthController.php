<?php namespace Tresyz\HellesManager\Admin;
 
  use Auth, BaseController, Form, Input, Redirect, Sentry, View;

  class AuthController extends BaseAdminController {

    public function getLogin()
    {
      Sentry::logout();

      // var_dump($this->layout);die;
      
      $this->layout->content = \View::make('helles-manager::admin.auth.login');
    }

    public function postLogin()
    {
      $credentials = array(
        'email'    => Input::get('email'),
        'password' => Input::get('password')
      );

      $remember = (Input::get('remember') == 1);

      try
      {
        $user = Sentry::authenticate($credentials, $remember);

        if ($user) {
          return Redirect::route('admin.dashboard');
        }
      } catch (\Cartalyst\Sentry\Users\LoginRequiredException $e) {
        $error = 'Informe o e-mail/senha';
      } catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e) {
        $error = 'Informe o e-mail/senha';
      } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
        $error = 'E-mail/senha inválidos';
      } catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e) {
        $error = 'Usuário desativado';
      }
      return Redirect::route('admin.login')->withErrors(array('login' => $error));
    }

    public function getLogout()
    {
      Sentry::logout();

      return Redirect::route('admin.login');
    }

  }