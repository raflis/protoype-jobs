@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid profile">
        <div class="row show-header">
            <div class="col-sm-12">
                <h1>
                    <i class="fas fa-tachometer-alt fa-xs"></i> <span>Dashboard</span>
                </h1>
            </div>
        </div>
        <div class="row mt-3 dashboard">
            @if(Auth::user()->role==0)
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-primary mb-1">
                                    Usuarios totales
                                </div>
                                <div class="hx">
                                    {{ $usuarios }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="fas fa-users text-gray2 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-primary mb-1">
                                    Usuarios normales
                                </div>
                                <div class="hx">
                                    {{ $usuarios_normales }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="far fa-user text-gray2 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-primary mb-1">
                                    Supervisores
                                </div>
                                <div class="hx">
                                    {{ $usuarios_supervisores }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="fas fa-user-shield text-gray2 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(Auth::user()->role==1)
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-primary mb-1">
                                    Mis usuarios asignados
                                </div>
                                <div class="hx">
                                    {{ $usuarios_asignados }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="fas fa-user-tag text-gray2 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-primary mb-1">
                                    Mis actividades
                                </div>
                                <div class="hx">
                                    {{ $actividades }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="fas fa-tasks text-gray2 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-primary mb-1">
                                    Mis actividades pendientes
                                </div>
                                <div class="hx">
                                    {{ $actividades_pendientes }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="fas fa-spinner text-gray2 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-success mb-1">
                                    Mis actividades finalizadas
                                </div>
                                <div class="hx">
                                    {{ $actividades_finalizadas }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="fas fa-check-square text-gray2 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::user()->role==1)
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-danger mb-1">
                                    Feedback pendientes en actividades
                                </div>
                                <div class="hx">
                                    {{ $feedback_pendientes_actividades }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="fas fa-tachometer-alt text-gray2 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-danger mb-1">
                                    Feedback pendientes en avances
                                </div>
                                <div class="hx">
                                    {{ $feedback_pendientes_avances }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="fas fa-tachometer-alt text-gray2 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection