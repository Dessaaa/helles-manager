<?php

Route::filter('auth.admin', function()
{
    if ( ! Sentry::check())
    {
        return Redirect::route('admin.login');
    }
});