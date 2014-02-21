<ul class="nav nav-tabs nav-stacked main-menu">
  <li @if(Route::currentRouteName() == 'admin.dashboard') class="active" @endif>
    {{ HTML::decode(link_to_route('admin.dashboard', '<i class="fa fa-home icon"></i><span class="hidden-tablet"> Dashboard</span>')) }}
  </li>
  @if(Sentry::getUser()->hasAccess('admin'))
  <li @if(Route::currentRouteName() == 'admin.user') class="active" @endif>
    {{ HTML::decode(link_to_route('admin.user.index', '<i class="fa fa-user icon"></i><span class="hidden-tablet"> Usuários</span>')) }}
  </li>
  @endif
</ul>