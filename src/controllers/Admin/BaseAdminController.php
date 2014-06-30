<?php namespace Tresyz\HellesManager\Admin;
 
 use App\Models\Page, Input, Redirect, Sentry, Str, Illuminate\Routing\Controller;

class BaseAdminController extends \BaseController {

  protected $layout = 'helles-manager::admin.templates.layout';

  public function __construct()
  {
    \View::share('title', 'Helles - Manager');
    \View::share('company', '3yz');
  }


}