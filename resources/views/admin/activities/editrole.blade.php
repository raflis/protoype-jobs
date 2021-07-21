@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid">
        <div class="row show-header">
            <div class="col-sm-12">
                <h1>
                    <i class="fas fa-tasks fa-xs"></i> <span>Actividad</span>
                </h1>
            </div>
        </div>
        <div class="row show-content mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Detalle
                        </span>
                    </div>
                    <div class="card-body row">
                        <div class="col-sm-12">
                            @include('admin.includes.alert')
                        </div>
                        <div class="col-sm-12">
                            <p>
                                <span class="name">Nombre del proyecto: </span>
                                <span class="name-text">{{ $activity->name }}</span>
                            </p>
                            <p>
                                <span class="name">Descripción de la tarea: </span>
                                <span class="name-text">{{ $activity->task }}</span>
                            </p>
                            <p>
                                <span class="name">Observaciones del usuario: </span>
                                <span class="name-text">{{ ($activity->observation!=NULL)?$activity->observation:'Sin comentarios ...' }}</span>
                            </p>
                            @if($activity->file!=NULL)
                            <p>
                                <span class="name">Archivo del proyecto: </span>
                                <span class="name-text">
                                    <a href="{{ $activity->file }}" target="_blank">Click aquí para ver/descargar</a>
                                </span>
                            </p>
                            @endif
                            <p>
                                <span class="name">Fecha de inicio: </span>
                                <span class="name-text">{!! \Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') !!}</span>
                            </p>
                            <p>
                                <span class="name">Fecha de fin: </span>
                                <span class="name-text">{!! \Carbon\Carbon::parse($activity->end_date)->format('d/m/Y') !!}</span>
                            </p>
                            <p>
                                @php
                                $end = \Carbon\Carbon::parse($activity->end_date);
                                $start = \Carbon\Carbon::parse($activity->start_date);
                                $days = ($end->diffInDays($start)==0)?'El mismo día':($end->diffInDays($start)==1)?'1 día':$start->diffInDays($end).' días';
                                @endphp
                                <span class="name">Días de plazo: </span>
                                <span class="name-text">{{ $days }}</span>
                            </p>
                            <hr>
                            <p>
                                <span class="name-user">Usuario asignado: </span>
                                <span class="name-text-user">{{ ucwords($activity->user->full_name) }}</span>
                            </p>
                            @if($activity->user->parent)
                            <p>
                                <span class="name-user">Supervisor asignado: </span>
                                <span class="name-text-user">{{ ucwords($activity->user->parent->full_name) }}</span>
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
                    {!! Form::model($activity, ['route' => ['activities.update.role', $activity->id], 'method' => 'PUT']) !!}
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
                <a class="btn btn-danger py-2 px-3" href="{{ route('activities.index.role') }}">Atrás</a>
                {!! Form::close() !!}
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
</div>

@endsection