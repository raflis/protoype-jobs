@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid profile">
        <div class="row show-header">
            <div class="col-sm-12">
                <h1>
                    <i class="fas fa-user-cog fa-xs"></i> <span>Configuración de la cuenta - Perfil</span>
                </h1>
            </div>
        </div>
        <div class="row show-content mt-3 foto">
            <div class="col-sm-12 col-md-4">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Foto de perfil
                        </span>
                    </div>
                    <div class="card-body imagen">
                        <div>
                            <img class="shadow img-perfil" src="{{ asset($profile->avatar) }}" alt="">
                        </div>
                        <div class="form-group col-sm-12 mt-2 px-0">
                            <span class="font-light" style="font-size:.8rem">Subir imagen con dimensión cuadrada no mayor a 2MB</span>
                            {!! Form::open(['route' => 'profile.index', 'files' => true, 'id' => 'form-avatar']) !!}
                            {{ Form::file('avatar', ['class' => 'form-control-file mt-1', 'accept'=>'image/*', 'style' => 'font-size:.9rem']) }}
                            {!! Form::close() !!}
                            <span id="loading-text" class="loading-text"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Detalle de la cuenta
                        </span>
                    </div>
                    {!! Form::model($profile, ['route' => ['profile.update', $profile->id], 'method' => 'PUT', 'files' => true]) !!}
                    <div class="card-body row">
                        <div class="col-sm-12">
                            @include('admin.includes.alert')
                        </div>
                        <div class="form-group col-sm-6">
                            {{ Form::label('name', 'Nombre:') }} <code>*</code>
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su nombre']) }}
                        </div>
                        
                        <div class="form-group col-sm-6">
                          {{ Form::label('lastname', 'Apellido:') }} <code>*</code>
                          {{ Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su apellido']) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('password', 'Nueva Contraseña:') }}
                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingrese una contraseña', 'minlength' => 8]) }}
                        </div>
                          
                        <div class="form-group col-sm-6">
                        {{ Form::label('repassword', 'Repita la nueva contraseña:') }}
                        {{ Form::password('repassword', ['class' => 'form-control', 'placeholder' => 'Repita nuevamente la contraseña', 'minlength' => 8]) }}
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 my-4 px-0">
                    {!! Form::submit('Actualizar cambios',['class'=>'btn btn-success btn-sm py-2 px-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>

$(function(){
    $("input[name=avatar]").on("change", function(e){
        var formData = new FormData(document.getElementById("form-avatar"));
        //console.log(formData);
        $.ajax({
            url: "{{ route('profile.update.image') }}",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $("#loading-text").removeClass().addClass('loading-text').html("Cargando imagen...");
            }
        })
            .done(function(res){
                $('#loading-text').removeClass().addClass('loading-text-success');
                $("#loading-text").html("Actualizado correctamente");
                setTimeout(function() {
                    $("#loading-text").html("");
                },3000);
                $(".img-perfil").attr('src', '../' + res);
                $(".avatar").attr('src', '../' + res);
                $(".avatar2").attr('src', '../' + res);
            });
    });
});

</script>

@endsection