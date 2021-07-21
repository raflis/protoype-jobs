@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid">
        <div class="row layout-header">
            <div class="col-sm-12 header-content">
                <h1>
                    <i class="fas fa-forward fa-xs text-white2"></i> Avance
                </h1>
                <span class="subtitle">
                    Crear, editar y eliminar avances.
                </span>
            </div>
        </div>
        <div class="row layout-body">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Crear avances
                        </span>
                    </div>
                    {!! Form::open(['route' => 'progress.store', 'id' => 'form100', 'name' => 'form100', 'files' => true]) !!}
                    <div class="card-body row">
                        <div class="col-sm-12">
                            @include('admin.includes.alert')
                        </div>
                        @include('admin.progress.partials.form')
                    </div>
                </div>
            </div>
            <div class="col-sm-12 my-4">
                <span class="d-block mb-3 font-semibold"><code>*</code> Campos Obligatorios</span>
                {!! Form::submit('Guardar cambios',['class'=>'btn btn-success py-2 px-3']) !!}
                <a class="btn btn-danger py-2 px-3" href="{{ route('progress.index') }}">Atrás</a>
                {!! Form::close() !!}
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
</div>

<div class="modal fade" id="confirm100" tabindex="-1" role="dialog" aria-labelledby="deletingLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fas fa-check-circle fa-5x text-success mb-3"></i>
            <p class="mb-0 font-bold first">¿Estás seguro?</p>
            <p class="mb-0 font-light second">Al ingresar 100% de avance la actividad se completará y cerrará automáticamente.</p>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button class="btn-100x btn btn-success" onClick="click100();">Sí, confirmar</button>                           
        </div>
      </div>
    </div>
</div>

@endsection

@section('script')

<script>

function click100()
{
    $('#confirm100').modal('hide');
    $('.loading').css({'display':'unset'});
    $('#loader').css({'display':'unset'});
    $('.loading').css({'visibility':'visible'});
    $('#loader').css({'visibility':'visible'});
    document.form100.submit();
}

$('document').ready(function(){

    @if(request()->get('k'))
    $('.percentage-get').html('<span class="text-primary">El avance actual es de {{ $percentage - 1 }}%</span> <span class="font-light font-italiz pl-2">Recuerda ingresar un % de avance mayor al indicado.</span>');
    $('#percentage').attr('min', {{ $percentage }});
    @endif

    $('#activity_id').change(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{ route('progress.maxpercentage') }}',
            data: {'activity_id': $(this).val()},
            dataType: 'json',
            beforeSend: function() {
                $('.loading').css({'display':'unset'});
                $('#loader').css({'display':'unset'});
                $('.loading').css({'visibility':'visible'});
                $('#loader').css({'visibility':'visible'});
            },
            success: function (data) {
                $('.percentage-get').html('<span class="text-primary">El avance actual es de ' + data + '%</span> <span class="font-light font-italiz pl-2">Recuerda ingresar un % de avance mayor al indicado.</span>');
                $('#percentage').attr('min', data + 1);
                setTimeout(function(){$('.loading').css({'display':'none'});}, 500);
                setTimeout(function(){$('#loader').css({'display':'none'});}, 500);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    });
    
    $('form').submit(function(e){
        e.preventDefault();
        var percentage = $('input[id=percentage]').val();
        //var datoss = $('form#form100').serialize();
        //console.log(datoss);
        if(percentage==100){
            $('#confirm100').modal('toggle');
        }else{
            this.submit();
        }
    });
    
})
</script>

@endsection