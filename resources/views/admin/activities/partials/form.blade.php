<div class="form-group col-sm-12">
  {{ Form::label('name', 'Nombre del proyecto:') }} <code>*</code>
  {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del proyecto', 'maxlength' => 250]) }}
</div>

<div class="form-group col-sm-12">
  {{ Form::label('task', 'Nombre de la tarea:') }} <code>*</code>
  {{ Form::textarea('task', null, ['class' => 'form-control', 'placeholder' => 'Descripción breve de la tarea', 'rows' => 2]) }}
</div>

<div class="form-group col-sm-12">
  {{ Form::label('observation', 'Comentarios:') }}
  {{ Form::textarea('observation', null, ['class' => 'form-control', 'placeholder' => 'Comentarios ...', 'rows' => 3]) }}
</div>

<div class="form-group col-sm-12">
  {{ Form::label('type_id', 'Qué tipo de archivo se va a entregar al final:') }} <code>*</code>
  {{ Form::select('type_id', $types, null, ['class' => 'form-control']) }}
</div>

@if(Route::currentRouteName()=="activities.create")
{{ Form::hidden('status_id', $status->id) }}
@endif

<div class="form-group col-sm-12 mt-2">
  {{ Form::label('file', 'Archivo:') }}
  {{ Form::file('file', null, ['class' => 'form-control-file']) }}
</div>

<div class="form-group col-sm-6">
  {{ Form::label('start_date', 'Fecha de inicio:') }} <code>*</code>
  {{ Form::date('start_date', null, ['class' => (Route::currentRouteName()==="activities.edit")?"form-control cursor-not-allowed":"form-control", 'readonly' => (Route::currentRouteName()==="activities.edit")?true:false]) }}
</div>

<div class="form-group col-sm-6">
  {{ Form::label('end_date', 'Fecha de fin:') }} <code>*</code>
  {{ Form::date('end_date', null, ['class' => 'form-control']) }}
</div>