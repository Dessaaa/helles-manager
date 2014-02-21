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

{{ link_to_route('admin.user.create', 'Adicionar', NULL, array('class' => 'btn btn-info')) }}

<div class="row">   
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header" data-original-title>
        <h2><i class="fa fa-list"></i><span class="break"></span>Listagem</h2>
        <!-- <div class="box-icon">
          <a href="table.html#" class="btn-setting"><i class="fa fa-wrench"></i></a>
          <a href="table.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
          <a href="table.html#" class="btn-close"><i class="fa fa-times"></i></a>
        </div> -->
      </div>
      <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable" data-sort-column="0" data-sort-direction="asc">
          <thead>
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Permissões</th>
              <th class="actions">Ações</th>
            </tr>
          </thead>   
          <tbody>
            @foreach($users as $user)
            <tr>
            <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @foreach($user->groups as $group)
              <span class="label label-default">{{ $group->name }}</span>
              @endforeach
            </td>
            <td class="actions">
              <!-- <a class="btn btn-success" href="#">
                <i class="icon-zoom-in icon-white"></i>
              </a> -->
              {{ HTML::decode(link_to_route('admin.user.edit', '<i class="fa fa-edit"></i>', $user->id,  array('class' => 'btn'))) }}
              {{ HTML::decode(link_to_route('admin.user.destroy','<i class="fa fa-trash-o"></i>', $user->id, array('class' => 'btn btn-danger delete'))) }}
            </td>
          </tr>
            @endforeach
          </tbody>
        </table>            
      </div>
    </div>
  </div><!--/col-->

</div><!--/row-->
@stop