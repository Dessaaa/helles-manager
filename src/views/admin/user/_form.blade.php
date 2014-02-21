
  <div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
    {{ Form::label('first_name', 'Nome', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::text('first_name', NULL, array('class' => 'form-control')) }}
      <small class="help-block">Campo obrigatório.</small> 
    </div>
  </div>
  <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
    {{ Form::label('last_name', 'Sobrenome', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::text('last_name', NULL, array('class' => 'form-control')) }}
      <small class="help-block">Campo obrigatório.</small> 
    </div>
  </div>
  <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
    {{ Form::label('email', 'E-mail', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-5">
      {{ Form::email('email', NULL, array('class' => 'form-control')) }}
      <small class="help-block">Campo obrigatório. Máximo 255 caracteres</small> 
    </div>
  </div>
  <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
    {{ Form::label('password', 'Senha', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::password('password', array('class' => 'form-control')) }}
      <small class="help-block">Campo obrigatório. Mínimo de 8 caracteres</small> 
    </div>
  </div>
  <div class="form-group {{$errors->has('confirm') ? 'has-error' : ''}}">
    {{ Form::label('confirm', 'Confirme a Senha', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::password('confirm', array('class' => 'form-control')) }}
      <small class="help-block">Campo obrigatório.</small> 
    </div>
  </div>
  <div class="form-group {{$errors->has('group_id') ? 'has-error' : ''}}">
    {{ Form::label('group_id', 'Grupo', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-3">
      {{ Form::select('group_id', $groups, NULL, array('class' => 'form-control')) }}
      <small class="help-block">Campo obrigatório.</small> 
    </div>
  </div>
  <div class="form-group {{$errors->has('activated') ? 'has-error' : ''}}">
    {{ Form::label('activated', 'Ativo?', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-10">
      <label class="radio">
        {{ Form::radio('activated', 1, NULL, array('class' => '')) }}
        Sim
      </label>
      <div style="clear:both"></div>
      <label class="radio">
        {{ Form::radio('activated', 0, NULL, array('class' => '')) }}
        Não
      </label>
      <small class="help-block">Campo obrigatório.</small> 
    </div>
  </div>
