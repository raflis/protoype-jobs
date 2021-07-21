<div class="form-group col-sm-12">
  {{ Form::label('activity_id', 'Selecciona un proyecto') }} <code>*</code>
  {{ Form::select('activity_id', $activities, null, ['class' => 'form-control', 'required' => true]) }}
</div>

@if(Route::currentRouteName()=="progress.edit")
<div class="form-group col-sm-12">
  {{ Form::label('percentage', 'Porcentaje de avance %:') }}
  {{ Form::number('percentage', null, ['class' => 'form-control cursor-not-allowed', 'placeholder' => '% de avance', 'max' => 100, 'min' => 1,'required' => false, 'readonly' => true]) }}
</div>
@else
<div class="form-group col-sm-12">
  {{ Form::label('percentage', 'Porcentaje de avance %:') }} <code>*</code> <span class="percentage-get"></span>
  {{ Form::number('percentage', null, ['class' => 'form-control', 'placeholder' => '% de avance', 'max' => 100, 'min' => 1,'required' => true]) }}
</div>
@endif
<div class="form-group col-sm-12">
  {{ Form::label('observation', 'Comentarios:') }}
  {{ Form::textarea('observation', null, ['class' => 'form-control', 'placeholder' => 'Comentarios ...', 'rows' => 3]) }}
</div>

<div class="form-group col-sm-12 mt-2">
  {{ Form::label('file', 'Archivo:') }}
  {{ Form::file('file', null, ['class' => 'form-control-file']) }}
</div>