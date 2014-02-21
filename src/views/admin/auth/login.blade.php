@section('content')
  <div class="login-box">
    <br/>
    {{ Form::open(array('class' => 'form-horizontal')) }}
      <fieldset>
        @if ($errors->has('login'))
        <div class="messages">
          <div class="alert alert-error">{{ $errors->first('login', ':message') }}</div>
        </div>
        @endif
        <div class="form-group">
          <div class="controls">
          <div class="input-group col-sm-12">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            {{ Form::text('email', null, array('id' => 'username', 'class' => 'form-control', 'placeholder' => 'E-mail')) }}
          </div>  
          </div>
        </div>
        
        <div class="form-group">
          <div class="controls">
          <div class="input-group col-sm-12">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            {{ Form::password('password', array('id' => 'password', 'class' => 'form-control', 'placeholder' => 'Senha')) }}
          </div>  
          </div>
        </div>
        
        <label class="remember" for="remember">
          {{ Form::checkbox('remember', 1, null, array('id' => 'remember')) }}
          Lembrar a senha?
        </label>

        <div class="button-login">  
          <button type="submit" class="btn btn-primary"><i class="icon-off icon-white"></i> Login</button>
        </div>
        <div class="clearfix"></div>
    {{ Form::close() }}
    <br/>
  </div><!--/col-->
@stop