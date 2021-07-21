@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid">
        <div class="row layout-header">
            <div class="col-sm-12 header-content">
                <h1>
                    <i class="fas fa-forward fa-xs text-white2"></i> Avance de usuarios asignados
                </h1>
                <span class="subtitle">
                    Dar feedback
                </span>
            </div>
        </div>
        <div class="row layout-body">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Avances
                        </span>
                        <div class="d-flex">
                            <select class="custom-select mr-2" id="users">
                                <option value="">Filtrar...</option>
                                @php $rq=(request()->get('user'))?decrypt(request()->get('user')):'' @endphp
                                @foreach ($users as $i)
                                    <option @if ($i->id==$rq) selected @endif value="{{ encrypt($i->id) }}">{{ ucwords($i->full_name) }}</option>
                                @endforeach
                            </select>
                            <a class="btn btn-success" href="{{ route('progress.excel', ['nameuser' => request('user')]) }}">
                                <span class="icon">
                                    <i class="fas fa-download px-2 py-1"></i>
                                </span>
                                <span class="text px-2 py-1">
                                    Descargar
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
                                    <th>Días de plazo</th>
                                    <th>Archivo</th>
                                    <th>Progreso</th>
                                    <th>Comentarios</th>
                                    <th>Retroalimentación</th>
                                    <th>Status</th>
                                    <th>Usuario asignado</th>
                                    <th>Fecha de creación</th>
                                    <th colspan=3>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($progress as $progres)
                                @php $colortext = ($progres->activity->complete==1)?'font-bold text-success':'' @endphp
                                @php 
                                    $end = \Carbon\Carbon::parse($progres->activity->end_date);
                                    $start = \Carbon\Carbon::parse($progres->activity->start_date);
                                    $days = ($end->diffInDays($start)==0)?'El mismo día':($end->diffInDays($start)==1)?'1 día':$start->diffInDays($end).' días';
                                @endphp
                                @if ($progres->file != NULL)
                                    @php 
                                        $var = '<a href="'.asset($progres->file).'" target="_blank">Click para ver archivo</a>'; 
                                    @endphp
                                @else
                                    @php $var = ""; @endphp
                                @endif
                                @php $color = ($progres->percentage==100)?'bg-success text-white':'bg-primary' @endphp
                                <tr>
                                    <td>{{ $progres->activity->name }}</td>
                                    <td>{{ $progres->activity->task }}</td>
                                    <td>{!! \Carbon\Carbon::parse($progres->activity->start_date)->format('d/m/Y') !!}</td>
                                    <td>{!! \Carbon\Carbon::parse($progres->activity->end_date)->format('d/m/Y') !!}</td>
                                    <td>{{ $days }}</td>
                                    <td>{!! $var !!}</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar {{ $color }}" role="progressbar" style="width: {{ $progres->percentage }}%;" aria-valuenow="{{ $progres->percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $progres->percentage }}%</div>
                                        </div>
                                    </td>
                                    <td>{{ $progres->observation }}</td>
                                    <td>{{ $progres->feedback }}</td>
                                    <td class="{{ $colortext }}">{{ $progres->activity->status->name }}</td>
                                    <td>{{ ucwords($progres->activity->user->full_name) }}</td>
                                    <td>{!! \Carbon\Carbon::parse($progres->created_at)->format('d/m/Y H:i:s') !!}</td>
                                    <td class="border-right-hidden">
                                        <a class="btn btn-success text-white btn-sm" href="{{ route('activities.show', $progres->activity_id) }}" data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                    @php $style = (Auth::user()->role<2)?'border-right-hidden':'' @endphp
                                    <td class="{{ $style }}">
                                        @if(Auth::user()->role==0 && $progres->activity->user->role==1)
                                        <a class="btn btn-primary text-white btn-sm" href="{{ route('progress.edit.role', encrypt($progres->id)) }}" data-toggle="tooltip" data-placement="top" title="Dar feedback">
                                            <i class="fas fa-comment-medical"></i>
                                        </a>
                                        @elseif(Auth::user()->role==1 && $progres->activity->user->role==2)
                                        <a class="btn btn-primary text-white btn-sm" href="{{ route('progress.edit.role', encrypt($progres->id)) }}" data-toggle="tooltip" data-placement="top" title="Dar feedback">
                                            <i class="fas fa-comment-medical"></i>
                                        </a>
                                        @endif
                                    </td>
                                    @if(Auth::user()->role<2)
                                    <td>
                                        <a class="btn btn-danger btn-sm btn-eliminar" href="" ideliminar="{{ $progres->id }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-12 d-flex justify-content-end">
                            {{ $progress->render() }}
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
            {!! Form::open(['route' => ['progress.destroy', ''], 'method' => 'DELETE', 'id' => 'form-eliminar']) !!}
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
        var base = '{{ route('progress.destroy', '') }}';
        var url = base + '/' +id;
        $('#form-eliminar').attr('action', url);
        $('#deleting').modal('show');
    });

    $('#users').change(function(){
        $val = $(this).val();
        $link = "{{ route('progress.index.role') }}";
        if($val)
        {
            window.location.href = $link + "?user=" + $val;
        }
        
    });
})
</script>

@endsection