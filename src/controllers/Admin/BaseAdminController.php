<?php namespace Tresyz\HellesManager\Admin;
 
 use App\Models\Page, Input, Redirect, Sentry, Str, Illuminate\Routing\Controller;

class BaseAdminController extends \BaseController {

  protected $layout = 'helles-manager::admin.templates.layout';

  protected function setupLayout()
  {
    if ( ! is_null($this->layout))
    {
      if(\View::exists('admin.templates.layout')) {
        $this->layout = 'admin.templates.layout';
      }
      $this->layout = \View::make($this->layout);
    }
  }

}