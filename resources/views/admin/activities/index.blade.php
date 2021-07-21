@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid">
        <div class="row layout-header">
            <div class="col-sm-12 header-content">
                <h1>
                    <i class="fas fa-tasks fa-xs text-white2"></i> Actividad
                </h1>
                <span class="subtitle">
                    Crear, editar y eliminar actividades.
                </span>
            </div>
        </div>
        <div class="row layout-body">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Actividades
                        </span>
                        <div class="d-flex">
                            <select class="custom-select mr-2" id="complete">
                                <option value="">Filtrar...</option>
                                <option value="2" @if (2==request()->get('complete')) selected @endif>Todos</option>
                                <option value="0" @if (0==request()->get('complete')) selected @endif>Pendiente</option>
                                <option value="1" @if (1==request()->get('complete')) selected @endif>Finalizado</option>
                            </select> 
                            <a class="btn btn-success" href="{{ route('activities.create') }}">
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
                                    <th>Nombre</th>
                                    <th>Tarea</th>
                                    <th>Fecha de inicio</th>
                                    <th>Fecha de fin</th>
                                    <th>Comentarios</th>
                                    <th>Tipo de entregable</th>
                                    <th>Archivo</th>
                                    <th>Progreso</th>
                                    <th>Status</th>
                                    @if(Auth::user()->role!=0)<th>Retroalimentación</th>@endif
                                    <th>Usuario asignado</th>
                                    <th>Fecha de creación</th>
                                    @php
                                        $col = (Auth::user()->role<2)?'4':'3'
                                    @endphp
                                    <th colspan={{ $col }}>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $activity)
                                @php $color = ($activity->complete==1)?'success text-white':'primary' @endphp
                                @php $color2 = ($activity->complete==1)?'font-bold text-success':'' @endphp
                                @if ($activity->file != NULL)
                                    @php 
                                        $var = '<a href="'.asset($activity->file).'" target="_blank">Click para ver archivo</a>'; 
                                    @endphp
                                @else
                                    @php $var = ""; @endphp
                                @endif
                                <tr>
                                    <td>{{ $activity->name }}</td>
                                    <td>{{ $activity->task }}</td>
                                    <td>{!! \Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') !!}</td>
                                    <td>{!! \Carbon\Carbon::parse($activity->end_date)->format('d/m/Y') !!}</td>
                                    <td>{{ $activity->observation }}</td>
                                    <td>{{ $activity->type->name }}</td>
                                    <td>{!! $var !!}</td>
                                    <td>
                                        @php $perc = 0 @endphp
                                        @foreach ($activity->progress as $item)
                                            @if($loop->last)
                                                @php $perc = $item->percentage @endphp
                                            @endif
                                        @endforeach
                                        <div class="progress">
                                            <div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{ $perc }}%;" aria-valuenow="{{ $perc }}" aria-valuemin="0" aria-valuemax="100">{{ $perc }}%</div>
                                        </div>
                                    </td>
                                    <td class="{{ $color2 }}">{{ $activity->status->name }}</td>
                                    @if(Auth::user()->role!=0)<td>{{ $activity->feedback }}</td>@endif
                                    <td>{{ $activity->user->full_name }}</td>
                                    <td>{!! \Carbon\Carbon::parse($activity->created_at)->format('d/m/Y H:i:s') !!}</td>
                                    <td class="border-right-hidden">
                                        <a class="btn btn-success text-white btn-sm" href="{{ route('activities.show', $activity->id) }}" data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                    <td class="border-right-hidden">
                                        @if($activity->complete==0)
                                        <a class="btn btn-warning text-white btn-sm" href="{{ route('progress.create', ['k' => encrypt($activity->id)]) }}" data-toggle="tooltip" data-placement="top" title="Añadir avance">
                                            <i class="fas fa-folder-plus"></i>
                                        </a>
                                        @endif
                                    </td>
                                    @php $style = (Auth::user()->role<1)?'border-right-hidden':'' @endphp
                                    <td class="{{ $style }}">
                                        <a class="btn btn-primary text-white btn-sm" href="{{ route('activities.edit', $activity->id) }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    @if(Auth::user()->role<1)
                                    <td>
                                        <a class="btn btn-danger btn-sm btn-eliminar" href="" ideliminar="{{ $activity->id }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-12 d-flex justify-content-end">
                            {{ $activities->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
</div>

<div class="modal fade" id="deleting" tabindex="-1" role="dialog" aria-labelledby="deletingLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fas fa-exclamation-circle fa-5x text-warning mb-3"></i>
            <p class="mb-0 font-bold first">¿Estás seguro?</p>
            <p class="mb-0 font-light second">El registro seleccionado será eliminado y no podrá recuperarse.</p>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            {!! Form::open(['route' => ['activities.destroy', ''], 'method' => 'DELETE', 'id' => 'form-eliminar']) !!}
                <button class="btn btn-danger">
                    Sí, eliminar
                </button>                           
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
@endsection

@section('script')

<script>
$('document').ready(function(){
    $('.btn-eliminar').click(function(e){
        e.preventDefault();
        var id = $(this).attr('ideliminar');
        var base = '{{ route('activities.destroy', '') }}';
        var url = base + '/' +id;
        $('#form-eliminar').attr('action', url);
        $('#deleting').modal('show');
    });

    $('#complete').change(function(){
        $val = $(this).val();
        $link = "{{ route('activities.index') }}";
        if($val)
        {
            window.location.href = $link + "?complete=" + $val;
        }
        
    });
})
</script>

@endsection