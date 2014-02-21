<?php namespace Tresyz\HellesManager\Admin;
 
 use App\Models\Page, Input, Redirect, Sentry, Str, Illuminate\Routing\Controller;

class BaseAdminController extends \BaseController {

  protected $layout = 'helles-manager::admin.templates.layout';

}