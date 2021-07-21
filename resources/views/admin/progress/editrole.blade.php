@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid">
        <div class="row show-header">
            <div class="col-sm-12">
                <h1>
                    <i class="fas fa-forward fa-xs"></i> <span>Avance</span>
                </h1>
            </div>
        </div>
        <div class="row show-content mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Detalle del avance seleccionado
                        </span>
                    </div>
                    <div class="card-body row">
                        <div class="col-sm-12">
                            @include('admin.includes.alert')
                        </div>
                        <div class="col-sm-12">
                            <p>
                                <span class="name">Nombre del proyecto: </span>
                                <span class="name-text">{{ $progress->activity->name }}</span>
                            </p>
                            <p>
                                <span class="name">Descripción de la tarea: </span>
                                <span class="name-text">{{ $progress->activity->task }}</span>
                            </p>
                            @if($progress->activity->file!=NULL)
                            <p>
                                <span class="name">Archivo del avance: </span>
                                <span class="name-text">
                                    <a href="{{ $progress->file }}" target="_blank">Click aquí para ver/descargar</a>
                                </span>
                            </p>
                            @endif
                            <p>
                                <span class="name">Observación del usuario: </span>
                                <span class="name-text">{{ $progress->observation }}</span>
                            </p>
                            <p>
                                @php
                                    $color = ($progress->percentage==100)?'bg-success':'bg-primary'
                                @endphp
                                <span class="name">Progreso: </span>
                                <div class="progress mb-2">
                                    <div class="progress-bar {{ $color }}" role="progressbar" style="width: {{ $progress->percentage }}%;" aria-valuenow="{{ $progress->percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $progress->percentage }}%</div>
                                </div>
                            </p>
                            <hr>
                            <p>
                                <span class="name-user">Usuario asignado: </span>
                                <span class="name-text-user">{{ ucwords($progress->activity->user->full_name) }}</span>
                            </p>
                            @if($progress->activity->user->parent)
                            <p>
                                <span class="name-user">Supervisor asignado: </span>
                                <span class="name-text-user">{{ ucwords($progress->activity->user->parent->full_name) }}</span>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 feedback">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Registrar Feedback
                        </span>
                    </div>
                    {!! Form::model($progress, ['route' => ['progress.update.role', $progress->id], 'method' => 'PUT']) !!}
                    <div class="card-body row">
                        <div class="col-sm-12">
                            @include('admin.includes.alert')
                            <div class="form-group col-sm-12">
                                {{ Form::label('feedback', 'Feedback:') }}
                                {{ Form::textarea('feedback', null, ['class' => 'form-control', 'placeholder' => 'Escribir feedback para el usuario', 'rows' => 5]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 my-4">
                {!! Form::submit('Registrar feedback',['class'=>'btn btn-success py-2 px-3']) !!}
                <a class="btn btn-danger py-2 px-3" href="{{ route('progress.index.role') }}">Atrás</a>
                {!! Form::close() !!}
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
</div>

@endsection