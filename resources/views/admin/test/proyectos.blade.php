@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid profile">
        <div class="row show-header">
            <div class="col-sm-12">
                <h1>
                    <i class="fas fa-user-cog fa-xs"></i> <span>Datos del proyecto</span>
                </h1>
            </div>
        </div>
        <div class="row show-content mt-3">

            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Proyecto
                        </span>
                    </div>
                    
                    <div class="card-body row test">
                        <div class="col-sm-12">
                            @include('admin.includes.alert')
                        </div>
                        <div class="form-group col-sm-12">
                            {{ Form::label('name', 'Nombre:') }} <code>*</code>
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre']) }}
                        </div>
                        
                        <div class="form-group col-sm-6">
                          {{ Form::label('id_type_project', 'Tipo:') }} <code>*</code>
                          {{ Form::select('id_type_project', ['0'=>'One shot', '1' => 'Licenciamiento'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('id_project_area', 'Áreas:') }} <code>*</code>
                            {{ Form::select('id_project_area', ['0'=>'UX', '1' => 'UI', '2' => 'iOs', '3' => 'Android'], null, ['class' => 'form-control']) }}
                        </div>
                        
                        <div class="form-group col-sm-6">
                            {{ Form::label('', 'Cliente:') }} <code>*</code>
                            {{ Form::select('', ['0'=>'Seleccione'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('', 'Estado:') }} <code>*</code>
                            {{ Form::select('', ['0'=>'Por iniciar', '1'=>'En curso'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-4">
                            {{ Form::label('', 'Respons. COM:') }} <code>*</code>
                            {{ Form::select('', ['0'=>'Seleccione'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-4">
                            {{ Form::label('', 'Respons. UI/UX:') }} <code>*</code>
                            {{ Form::select('', ['0'=>'Seleccione'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-4">
                            {{ Form::label('', 'Respons. TI:') }} <code>*</code>
                            {{ Form::select('', ['0'=>'Seleccione'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('', 'Alcance:') }} <code>*</code>
                            {{ Form::textarea('', null, ['class' => 'form-control', 'rows' => 2]) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('', 'Restricciones:') }} <code>*</code>
                            {{ Form::textarea('', null, ['class' => 'form-control', 'rows' => 2]) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('name', 'Fecha de inicio:') }} <code>*</code>
                            {{ Form::date('name', null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('name', 'Fecha de fin:') }} <code>*</code>
                            {{ Form::date('name', null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('', 'Moneda:') }} <code>*</code>
                            {{ Form::select('', ['0'=>'Soles', '1'=>'Dólares'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('', 'Monto:') }} <code>*</code>
                            {{ Form::number('', null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-6 mt-2">
                            <a class="btn btn-sm btn-dark" href="{{ route('componentes') }}">
                                <i class="fas fa-plus pr-1"></i> Agregar Componente
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 my-4 px-0">
                    {!! Form::submit('Guardar',['class'=>'btn btn-success btn-sm py-2 px-3']) !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection