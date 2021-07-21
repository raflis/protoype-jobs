@extends('admin.login.master')

@section('content')
<section class="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-5 mt-3">
                @include('admin.includes.alert')
            </div>
            <div class="col-md-12"></div>
            <div class="col-sm-12 col-md-5">
                <div class="card shadow-lg border-0 rounded-lg mt-3">
                    <div class="card-header">
                        <h3 class="my-4">Inicio de sesión</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'login.post']) !!}

                        <div class="form-group">
                            {{ Form::label('email', 'Email:') }}
                            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'Ingresa un email']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Contraseña:') }}
                            {{ Form::password('password', ['class' => 'form-control', 'placeholder'=>'Ingresa un contraseña']) }}
                        </div>

                        {!! Form::submit('Iniciar sesión',['class'=>'btn btn-primary btn-login mt-2 col-12 py-2']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3>Copyright © Dennis Ormeño</h3>
            </div>
        </div>
    </div>
</section>
@endsection