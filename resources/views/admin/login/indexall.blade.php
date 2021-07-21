@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid">
        <div class="row layout-header">
            <div class="col-sm-12 header-content">
                <h1>
                    <i class="fas fa-users fa-xs text-white2"></i> Usuarios
                </h1>
                <span class="subtitle">
                    Crear, editar, asignar y eliminar usuarios.
                </span>
            </div>
        </div>
        <div class="row layout-body">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Usuarios
                        </span>
                        <a class="btn btn-success" href="{{ route('login.create') }}">
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
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Email</th>
                                    <th>Tipo de Perfil</th>
                                    <th>Supervisor Asignado</th>
                                    @if(Auth::user()->role==0)
                                    <th colspan=2>Acciones</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                @php
                                    if($user->role == 2){
                                        if($user->parent){
                                            $parent = $user->parent->full_name;
                                            $color = "";
                                        }else{
                                            $parent = "No tiene supervisor asignado";
                                            $color = "text-warning font-bold";
                                        }
                                    }elseif($user->role == 1){
                                        $parent = "Supervisor";
                                        $color = "font-medium";
                                    }
                                @endphp
                                <tr>
                                    <td><img class="img-user" src="{{ asset($user->avatar) }}" alt=""></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ getRole($user->role) }}</td>
                                    <td class="{{ $color }}">{{ $parent }}</td>
                                    @if(Auth::user()->role==0)
                                    <td class="border-right-hidden">
                                        <a class="btn btn-primary text-white btn-sm" href="{{ route('login.edit', $user->id) }}">
                                            <i class="far fa-edit pr-1"></i> Editar
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm btn-eliminar" href="" ideliminar="{{ $user->id }}"><i class="far fa-trash-alt pr-1"></i> Eliminar</a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-12 d-flex justify-content-end">
                            {{ $users->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            {!! Form::open(['route' => ['login.destroy', ''], 'method' => 'DELETE', 'id' => 'form-eliminar']) !!}
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
        var base = '{{ route('login.destroy', '') }}';
        var url = base + '/' +id;
        $('#form-eliminar').attr('action', url);
        $('#deleting').modal('show');
    });
})
</script>

@endsection