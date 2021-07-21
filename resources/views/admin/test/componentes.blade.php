@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid profile">
        <div class="row show-header">
            <div class="col-sm-12">
                <h1>
                    <i class="fas fa-user-cog fa-xs"></i> <span>Datos del componente</span>
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

                        <div class="form-group col-sm-6">
                            {{ Form::label('id_project', 'Nombre del proyecto:') }} <code>*</code>
                            {{ Form::select('id_project', ['0'=>'Proyecto Diners'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('name', 'Estado:') }} <code>*</code>
                            {{ Form::select('id_project', ['0'=>'Seleccione'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-12">
                            {{ Form::label('name', 'Nombre del componente:') }} <code>*</code>
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre']) }}
                        </div>

                        <!--<div class="form-group col-sm-6">
                            {{ Form::label('name', 'Entregable:') }} <code>*</code>
                            {{ Form::select('id_project', ['0'=>'Seleccione'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('name', 'Tipo de actividad:') }} <code>*</code>
                            {{ Form::select('id_project', ['0'=>'Requerimiento', '1'=>'Incidencia'], null, ['class' => 'form-control']) }}
                        </div>-->

                        <div class="form-group col-sm-12">
                            {{ Form::label('name', 'Descripción:') }} <code>*</code>
                            {{ Form::textarea('name', null, ['class' => 'form-control', 'rows'=>2]) }}
                        </div>
                        
                        <div class="form-group col-sm-6 mt-2">
                            <a class="btn btn-sm btn-dark" href="{{ route('funcionalidades') }}">
                                <i class="fas fa-plus pr-1"></i> Agregar Funcionalidad
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