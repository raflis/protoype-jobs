@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid">
        <div class="row layout-header">
            <div class="col-sm-12 header-content">
                <h1>
                    <i class="far fa-file-archive fa-xs text-white2"></i> Tipo de archivos
                </h1>
                <span class="subtitle">
                    Crear, editar y eliminar tipo de archivos.
                </span>
            </div>
        </div>
        <div class="row layout-body">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Tipo de archivos
                        </span>
                        <a class="btn btn-success" href="{{ route('types.create') }}">
                            <span class="icon">
                                <i class="fas fa-plus px-2 py-1"></i>
                            </span>
                            <span class="text px-2 py-1">
                                Crear
                            </span>
                        </a>
                    </div>
                    <div class="card-body row">
                        <div class="col-sm-12">
                            @include('admin.includes.alert')
                        </div>
                        <table class="table table-hover table-sm table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>Nombre completo</th>
                                    <th>Nombre corto</th>
                                    <th>Fecha de creación</th>
                                    <th colspan=2>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $type)
                                <tr>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->short_name }}</td>
                                    <td>{!! \Carbon\Carbon::parse($type->created_at)->format('d/m/Y H:i:s') !!}</td>
                                    <td class="border-right-hidden">
                                        <a class="btn btn-primary text-white btn-sm" href="{{ route('types.edit', $type->id) }}">
                                            <i class="far fa-edit pr-1"></i> Editar
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm btn-eliminar" href="" ideliminar="{{ $type->id }}"><i class="far fa-trash-alt pr-1"></i> Eliminar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-12 d-flex justify-content-end">
                            {{ $types->render() }}
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
            {!! Form::open(['route' => ['types.destroy', ''], 'method' => 'DELETE', 'id' => 'form-eliminar']) !!}
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
        var base = '{{ route('types.destroy', '') }}';
        var url = base + '/' +id;
        $('#form-eliminar').attr('action', url);
        $('#deleting').modal('show');
    });
})
</script>

@endsection