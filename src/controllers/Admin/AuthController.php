<?php namespace Tresyz\HellesManager\Admin;

  use Auth, BaseController, Form, Input, Redirect, Sentry, View, Request, Response, URL;

  class AuthController extends BaseAdminController {

    public function getLogin()
    {
      Sentry::logout();

      $this->layout->content = \View::make('helles-manager::admin.auth.login');
    }


    public function postLogin()
    {
      if(Request::ajax()){
          $credentials = array(
            'email'    => base64_decode(Input::get('email')),
            'password' => base64_decode(Input::get('password'))
          );

          $remember = (Input::get('remember') == 1);
          $err = array('url' => '');

          try
          {
            $user = Sentry::authenticate($credentials, $remember);
            if ($user) {
              $err = array('url'=> URL::route('admin.dashboard'), 'error' => false);
            }
          } catch (\Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $err['error'] = 'Informe o e-mail/senha';
          } catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $err['error'] = 'Informe o e-mail/senha';
          } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $err['error'] = 'E-mail/senha inválidos';
          } catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $err['error'] = 'Usuário desativado';
          }
      } else {
        $err['error'] = 'Nenhuma requisição ajax efetuada';
      }

      return Response::json($err);
    }

    public function getLogout()
    {
      Sentry::logout();

      return Redirect::route('admin.login');
    }

  }
