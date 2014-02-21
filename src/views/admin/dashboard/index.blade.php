@section('content')

<div>
  <hr>
  <ul class="breadcrumb">
    <li>
      <a href="#">Home</a>
    </li>
    <li class="active"> 
      Dashboard
    </li>
  </ul>
  <hr>
</div>

<div class="jumbotron">
  <h1>Dashboard</h1>
  <p>Olá <strong>{{ $user = Sentry::getUser()->first_name }} {{ $user = Sentry::getUser()->last_name }}</strong>! Seja bem-vindo ao sistema de gerenciamento do site.</p>  
</div>

@stop