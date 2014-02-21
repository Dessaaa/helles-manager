@section('content')
<div>
  <hr>
  <ul class="breadcrumb">
    <li>{{ link_to_route('admin.dashboard', 'Home') }}</li>
    <li>{{ link_to_route('admin.user.index', 'Usuários') }}</li>
  </ul>
  <hr>
</div> 

{{ Notification::showAll() }}

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header">
        <h2><i class="fa fa-edit"></i><span class="break"></span>Alterar</h2>
        <!-- <div class="box-icon">
          <a href="forms.html#" class="btn-setting"><i class="fa fa-wrench"></i></a>
          <a href="forms.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
          <a href="forms.html#" class="btn-close"><i class="fa fa-times"></i></a>
        </div> -->
      </div>
      <div class="box-content">
        {{ Form::model($user, array('route' => 'admin.user.update', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) }}
        <fieldset class="col-sm-12">  
          @include('helles-manager::admin.user._form')
          <div class="form-actions">
            {{ Form::button('Salvar', array('type' => 'submit', 'class' => 'btn btn-info')) }}
            ou {{ link_to(URL::route('admin.user.index'), 'cancelar') }}
          </div>
        </fieldset>
        {{ Form::close() }}
      </div>
    </div><!--/span-->
  </div>
</div><!--/row-->
@stop