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
                            @if(Auth::user()->role != $activity->user->role)
                            <p>
                                <span class="name-supervisor">Feedback del supervisor: </span>
                                <span class="name-text">{{ ($activity->feedback!=NULL)?$activity->feedback:'Sin retroalimentación ...' }}</span>
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
        <div class="row show-timeline mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        @foreach ($activity->progress as $i)
                        @php
                            $color = ($i->percentage==100)?'bg-success':'bg-primary'
                        @endphp
                        <div class="resume-item">
                            <p>
                                <span class="name">Progreso: </span>
                                <div class="progress mb-2">
                                    <div class="progress-bar {{ $color }}" role="progressbar" style="width: {{ $i->percentage }}%;" aria-valuenow="{{ $i->percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $i->percentage }}%</div>
                                </div>
                            </p>
                            <p>
                                <span class="name">Fecha de creación: </span>
                                <span class="name-text">{!! \Carbon\Carbon::parse($i->created_at)->format('d/m/Y H:i:s') !!}</span>
                            </p>
                            @if($i->file!=NULL)
                            <p>
                                <span class="name">Archivo: </span>
                                <span class="name-text">
                                    <a href="{{ $i->file }}" target="_blank">Click aquí para ver/descargar</a>
                                </span>
                            </p>
                            @endif
                            <p>
                                <span class="name">Observación del usuario: </span>
                                <span class="name-text">{{ ($i->observation!=NULL)?$i->observation:'Sin comentarios ...' }}</span>
                            </p>
                            @if(Auth::user()->role != $activity->user->role)
                            <p>
                                <span class="name">Feedback del supervisor: </span>
                                <span class="name-text">{{ ($i->feedback!=NULL)?$i->feedback:'Sin retroalimentación ...' }}</span>
                            </p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-12 mt-4 mb-1">
                <a class="btn btn-danger py-2 px-3" href="{{ url()->previous() }}">Atrás</a>
                {!! Form::close() !!}
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
</div>

@endsection