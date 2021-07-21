<div class="form-group col-sm-12">
    {{ Form::label('short_name', 'Nombre corto:') }} <code>*</code>
    {{ Form::text('short_name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre corto']) }}
</div>

<div class="form-group col-sm-12">
  {{ Form::label('name', 'Nombre largo:') }} <code>*</code>
  {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre largo']) }}
</div>