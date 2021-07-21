<div class="form-group col-sm-6">
    {{ Form::label('name', 'Nombre:') }} <code>*</code>
    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su nombre']) }}
</div>

<div class="form-group col-sm-6">
  {{ Form::label('lastname', 'Apellido:') }} <code>*</code>
  {{ Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su apellido']) }}
</div>

<div class="form-group col-sm-6">
  {{ Form::label('email', 'Email:') }} <code>*</code>
  {{ Form::email('email', null, ['class' => (Route::currentRouteName()==="login.edit")?"form-control cursor-not-allowed":"form-control", 'placeholder' => 'Ingrese un correo electrónico', 'readonly' => (Route::currentRouteName()==="login.edit")?true:false]) }}
</div>

<div class="form-group col-sm-6">
  {{ Form::label('role', 'Tipo de usuario:') }} <code>*</code>
  {{ Form::select('role',[''=>'Selecciona un perfil','1'=>'Supervisor','2'=>'Usuario Normal'], null, ['class' => 'form-control']) }}
</div>

<div class="form-group col-sm-12 parentDiv" style="display: {{ (Route::currentRouteName()==="login.edit" && $user->role==2)?'block':'none' }}">
  {{ Form::label('parent_id', 'Selecciona su supervisor asociado:') }} <code>*</code>
  {{ Form::select('parent_id', $supervisors, null, ['class' => 'form-control']) }}
</div>

<div class="form-group col-sm-6">
  {{ Form::label('password', 'Contraseña:') }} <code>{{ Route::currentRouteName()==="login.edit"?'':'*' }}</code>
  {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingrese una contraseña', 'minlength' => 8]) }}
</div>

<div class="form-group col-sm-6">
  {{ Form::label('repassword', 'Repita contraseña:') }} <code>{{ Route::currentRouteName()==="login.edit"?'':'*' }}</code>
  {{ Form::password('repassword', ['class' => 'form-control', 'placeholder' => 'Repita nuevamente la contraseña', 'minlength' => 8]) }}
</div>

<div class="form-group col-sm-12">
  {{ Form::label('avatar', 'Imagen:') }} <span class="font-light" style="font-size:.7rem">Subir imagen con dimensión cuadrada</span>
  {{ Form::file('avatar', ['class' => 'form-control-file', 'accept'=>'image/*']) }}
</div>

@section('script')
    
<script>
$('document').ready(function(){

@if(Route::currentRouteName()==="login.edit")
  var role = '{{ $user->role }}';
  var parent = '{{ $user->parent?$user->parent->id:'NULL' }}';
  if(role=="2" && parent=="NULL")
  {
    $('#parent_id').attr('required', true);
  }
@endif
  //$('.parentDiv').hide();
  $('#role').change(function(){
    if($(this).val()==1) //supervisor
    {
      $('.parentDiv').hide();
      $('#parent_id').attr('required', false);
    }else if($(this).val()==2) //Usuario normal
    {
      $('.parentDiv').show();
      $('#parent_id').attr('required', true);
    }else
    {
      $('.parentDiv').hide();
      $('#parent_id').attr('required', false);
    }
  });
});
</script>

@endsection
