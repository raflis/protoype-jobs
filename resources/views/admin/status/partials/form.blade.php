<div class="form-group col-sm-12 col-md-6">
  {{ Form::label('name', 'Nombre:') }} <code>*</code>
  {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un nombre']) }}
</div>

<div class="form-group col-sm-12 col-md-6">
  {{ Form::label('order', 'Orden:') }} <code>*</code>
  {{ Form::number('order', null, ['class' => 'form-control', 'placeholder' => 'Ingrese un N° de orden']) }}
</div>