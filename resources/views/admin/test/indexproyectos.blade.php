@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid">
        <div class="row layout-header">
            <div class="col-sm-12 header-content">
                <h1>
                    <i class="fas fa-forward fa-xs text-white2"></i> Proyectos
                </h1>
                <span class="subtitle">
                    descripción lorem ipsus.
                </span>
            </div>
        </div>
        <div class="row layout-body">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Proyectos
                        </span>
                        <div class="d-flex">
                            <a class="btn btn-sm btn-success" href="{{ route('proyectos') }}">
                                <span class="icon">
                                    <i class="fas fa-plus px-2 py-1"></i>
                                </span>
                                <span class="text px-2 py-1">
                                    Crear
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-sm-12">
                            @include('admin.includes.alert')
                        </div>
                        <table class="table table-hover table-sm table-bordered table-responsive activities">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Monto</th>
                                    <th>Fecha de inicio</th>
                                    <th>Fecha de fin</th>
                                    <th colspan=2>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Diners</td>
                                    <td>Home indicadores</td>
                                    <td>One Shot</td>
                                    <td>Por Iniciar</td>
                                    <td>$ 8 ,900</td>
                                    <td>31-07-2021</td>
                                    <td>30-08-2021</td>
                                    <td style="width:130px">
                                        <a class="btn btn-success text-white btn-sm" href="{{ route('proyectos.show') }}">
                                            <i class="far fa-eye pr-2" style="margin-top:3.4px"></i> Ver detalle
                                        </a>
                                    </td>
                                    <td style="width:210px">
                                        <a class="btn btn-dark btn-sm" href="{{ route('componentes') }}" style="width: 100%">
                                            <i class="fas fa-plus pr-2" style="margin-top:3.4px"></i> Agregar Componente
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
</div>

@endsection