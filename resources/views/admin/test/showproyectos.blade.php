@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid test">
        <div class="row show-header">
            <div class="col-sm-12">
                <h1>
                    <i class="fas fa-tasks fa-xs"></i> <span>Detalles del proyecto</span>
                </h1>
            </div>
        </div>
        <div class="row show-content mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Proyecto
                        </span>
                    </div>
                    <div class="card-body row proyecto">
                        <div class="col-sm-12">
                            @include('admin.includes.alert')
                        </div>
                        <div class="col-sm-12">
                            <p>
                                <span class="name">Nombre del proyecto: </span>
                                <span class="name-text">Requerimiento Home indicadores</span>
                            </p>
                            <p>
                                <span class="name">Cliente: </span>
                                <span class="name-text">Diners</span>
                            </p>
                            <p>
                                <span class="name">Tipo: </span>
                                <span class="name-text">One Shot</span>
                            </p>
                            <p>
                                <span class="name">Respons. COM: </span>
                                <span class="name-text">Alejandro Tarazona</span>
                            </p>
                            <p>
                                <span class="name">Respons. UI/UX: </span>
                                <span class="name-text">Diego Gomez</span>
                            </p>
                            <p>
                                <span class="name">Respons. TI: </span>
                                <span class="name-text">Jimmy Luna</span>
                            </p>
                            <p>
                                <span class="name">Alcance: </span>
                                <span class="name-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam consectetur itaque sint est minima repudiandae aut non expedita repellendus in. Doloremque et odio debitis enim atque commodi vitae soluta? Facilis!</span>
                            </p>
                            <p>
                                <span class="name">Restricciones: </span>
                                <span class="name-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque, fugiat. Nemo dignissimos atque quod ipsa et aliquam expedita modi reiciendis, error autem perferendis voluptates eaque nostrum eveniet quaerat quos? Sed!</span>
                            </p>
                            <p>
                                <span class="name">Fecha de inicio: </span>
                                <span class="name-text">23-07-2021</span>
                            </p>
                            <p>
                                <span class="name">Fecha de fin: </span>
                                <span class="name-text">29-07-2021</span>
                            </p>
                            <p>
                                <span class="name">Monto: </span>
                                <span class="name-text">$ 8, 900</span>
                            </p>
                            <p>
                                <span class="name">Avance: </span>
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">33%</div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row show-timeline mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active a1" id="componente-tab" data-toggle="tab" href="#componente" role="tab" aria-controls="componente" aria-selected="true">Componentes</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link a2" id="funcionalidad-tab" data-toggle="tab" href="#funcionalidad" role="tab" aria-controls="funcionalidad" aria-selected="false">Funcionalidades</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link a3" id="actividad-tab" data-toggle="tab" href="#actividad" role="tab" aria-controls="actividad" aria-selected="false">Actividades</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade pl-2 show active" id="componente" role="tabpanel" aria-labelledby="componente-tab">
                                <p>
                                    <span class="name">Nombre: </span>
                                    <span class="name-text">Nativo Cliente</span>
                                </p>
                                <p>
                                    <span class="name">Descripción: </span>
                                    <span class="name-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque fuga labore soluta doloribus aut laborum. Soluta vel sint fugit iste quam explicabo praesentium provident incidunt officiis. Sunt tempora nobis aut!</span>
                                </p>
                                <p>
                                    <span class="name">Horas estimadas: </span>
                                    <span class="name-text">13 horas</span>
                                </p>
                                <p>
                                    <span class="name">Horas reales usadas: </span>
                                    <span class="name-text">12 horas</span>
                                </p>
                                <p>
                                    <span class="name">Avance: </span>
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                </p>
                                <p style="margin-top:9px">
                                    <a class="btn btn-dark btn-sm btn-func" data-toggle="tab" href="" role="tab">
                                        <i class="far fa-eye pr-2" style="margin-top:3.4px"></i> Ver Funcionalidades
                                    </a>
                                </p>
                                <hr>
                                <p>
                                    <span class="name">Nombre: </span>
                                    <span class="name-text">Nativo Chofer</span>
                                </p>
                                <p>
                                    <span class="name">Descripción: </span>
                                    <span class="name-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque fuga labore soluta doloribus aut laborum. Soluta vel sint fugit iste quam explicabo praesentium provident incidunt officiis. Sunt tempora nobis aut!</span>
                                </p>
                                <p>
                                    <span class="name">Horas estimadas: </span>
                                    <span class="name-text">24 horas</span>
                                </p>
                                <p>
                                    <span class="name">Horas reales usadas: </span>
                                    <span class="name-text">40 horas</span>
                                </p>
                                <p>
                                    <span class="name">Avance: </span>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                </p>
                                <p style="margin-top:9px">
                                    <a class="btn btn-dark btn-sm btn-func" data-toggle="tab" href="" role="tab">
                                        <i class="far fa-eye pr-2" style="margin-top:3.4px"></i> Ver Funcionalidades
                                    </a>
                                </p>
                                <hr>
                                <p>
                                    <span class="name">Nombre: </span>
                                    <span class="name-text">Web Admin</span>
                                </p>
                                <p>
                                    <span class="name">Descripción: </span>
                                    <span class="name-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque fuga labore soluta doloribus aut laborum. Soluta vel sint fugit iste quam explicabo praesentium provident incidunt officiis. Sunt tempora nobis aut!</span>
                                </p>
                                <p>
                                    <span class="name">Horas estimadas: </span>
                                    <span class="name-text">41 horas</span>
                                </p>
                                <p>
                                    <span class="name">Horas reales usadas: </span>
                                    <span class="name-text">22 horas</span>
                                </p>
                                <p>
                                    <span class="name">Avance: </span>
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 8%;" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100">8%</div>
                                </p>
                                <p style="margin-top:9px">
                                    <a class="btn btn-dark btn-sm btn-func" data-toggle="tab" href="" role="tab">
                                        <i class="far fa-eye pr-2" style="margin-top:3.4px"></i> Ver Funcionalidades
                                    </a>
                                </p>
                            </div>
                            <div class="tab-pane fade pl-2" id="funcionalidad" role="tabpanel" aria-labelledby="funcionalidad-tab">
                                <p>
                                    <span class="name">Nombre: </span>
                                    <span class="name-text">Login</span>
                                </p>
                                <p>
                                    <span class="name">Descripción: </span>
                                    <span class="name-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt ipsa et doloribus, vel.</span>
                                </p>
                                <p>
                                    <span class="name">Responsable: </span>
                                    <span class="name-text">Kenyi</span>
                                </p>
                                <p>
                                    <span class="name">Entregable: </span>
                                    <span class="name-text">E1</span>
                                </p>
                                <p>
                                    <span class="name">Perfil: </span>
                                    <span class="name-text">iOs</span>
                                </p>
                                <p>
                                    <span class="name">Estado: </span>
                                    <span class="name-text">Pendiente</span>
                                </p>
                                <p>
                                    <span class="name">Horas estimadas: </span>
                                    <span class="name-text">8 horas</span>
                                </p>
                                <p>
                                    <span class="name">Horas reales usadas: </span>
                                    <span class="name-text">11 horas</span>
                                </p>
                                <p>
                                    <span class="name">Avance: </span>
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">33%</div>
                                </p>
                                <p style="margin-top: 9px">
                                    <a class="btn btn-dark btn-sm btn-act" data-toggle="tab" href="" role="tab">
                                        <i class="far fa-eye pr-2" style="margin-top:3.4px"></i> Ver Actividades
                                    </a>
                                </p>
                                <hr>

                                <p>
                                    <span class="name">Nombre: </span>
                                    <span class="name-text">Pedido</span>
                                </p>
                                <p>
                                    <span class="name">Descripción: </span>
                                    <span class="name-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt ipsa et doloribus, vel.</span>
                                </p>
                                <p>
                                    <span class="name">Responsable: </span>
                                    <span class="name-text">Kenyi</span>
                                </p>
                                <p>
                                    <span class="name">Entregable: </span>
                                    <span class="name-text">E1</span>
                                </p>
                                <p>
                                    <span class="name">Perfil: </span>
                                    <span class="name-text">iOs</span>
                                </p>
                                <p>
                                    <span class="name">Estado: </span>
                                    <span class="name-text">Pendiente</span>
                                </p>
                                <p>
                                    <span class="name">Horas estimadas: </span>
                                    <span class="name-text">5 horas</span>
                                </p>
                                <p>
                                    <span class="name">Horas reales usadas: </span>
                                    <span class="name-text">3 horas</span>
                                </p>
                                <p>
                                    <span class="name">Avance: </span>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                </p>
                                <p style="margin-top: 9px">
                                    <a class="btn btn-dark btn-sm btn-act" data-toggle="tab" href="" role="tab">
                                        <i class="far fa-eye pr-2" style="margin-top:3.4px"></i> Ver Actividades
                                    </a>
                                </p>
                                <hr>

                            </div>
                            <div class="tab-pane fade pl-2" id="actividad" role="tabpanel" aria-labelledby="actividad-tab">
                                <p>
                                    <span class="name">Nombre: </span>
                                    <span class="name-text">Login IOS</span>
                                </p>
                                <p>
                                    <span class="name">Descripción: </span>
                                    <span class="name-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque fuga labore soluta doloribus aut laborum. Soluta vel sint fugit iste quam explicabo praesentium provident incidunt officiis. Sunt tempora nobis aut!</span>
                                </p>
                                <p>
                                    <span class="name">Tipo de actividad: </span>
                                    <span class="name-text">Requerimiento</span>
                                </p>
                                <p>
                                    <span class="name">Responsable: </span>
                                    <span class="name-text">Kenyi</span>
                                </p>
                                <p>
                                    <span class="name">Horas estimadas: </span>
                                    <span class="name-text">3 horas</span>
                                </p>
                                <p>
                                    <span class="name">Horas reales usadas: </span>
                                    <span class="name-text">4 horas</span>
                                </p>
                                <p>
                                    <span class="name">Estado: </span>
                                    <span class="name-text text-success font-medium">Finalizado</span>
                                </p>
                                <p>
                                    <span class="name" data-toggle="modal" data-target="#details">
                                        Ver Detalle
                                    </span>
                                </p>
                                <hr>
                                <p>
                                    <span class="name">Nombre: </span>
                                    <span class="name-text">Login Android</span>
                                </p>
                                <p>
                                    <span class="name">Descripción: </span>
                                    <span class="name-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque fuga labore soluta doloribus aut laborum. Soluta vel sint fugit iste quam explicabo praesentium provident incidunt officiis. Sunt tempora nobis aut!</span>
                                </p>
                                <p>
                                    <span class="name">Tipo de actividad: </span>
                                    <span class="name-text">Requerimiento</span>
                                </p>
                                <p>
                                    <span class="name">Responsable: </span>
                                    <span class="name-text">Renzo</span>
                                </p>
                                <p>
                                    <span class="name">Horas estimadas: </span>
                                    <span class="name-text">5 horas</span>
                                </p>
                                <p>
                                    <span class="name">Horas reales usadas: </span>
                                    <span class="name-text">2 horas</span>
                                </p>
                                <p>
                                    <span class="name">Estado: </span>
                                    <span class="name-text text-danger font-medium">Pendiente</span>
                                </p>
                                <hr>
                                <p>
                                    <span class="name">Nombre: </span>
                                    <span class="name-text">Otro</span>
                                </p>
                                <p>
                                    <span class="name">Descripción: </span>
                                    <span class="name-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque fuga labore soluta doloribus aut laborum. Soluta vel sint fugit iste quam explicabo praesentium provident incidunt officiis. Sunt tempora nobis aut!</span>
                                </p>
                                <p>
                                    <span class="name">Tipo de actividad: </span>
                                    <span class="name-text">Requerimiento</span>
                                </p>
                                <p>
                                    <span class="name">Responsable: </span>
                                    <span class="name-text">Renzo</span>
                                </p>
                                <p>
                                    <span class="name">Horas estimadas: </span>
                                    <span class="name-text">8 horas</span>
                                </p>
                                <p>
                                    <span class="name">Horas reales usadas: </span>
                                    <span class="name-text">1 horas</span>
                                </p>
                                <p>
                                    <span class="name">Estado: </span>
                                    <span class="name-text text-danger font-medium">Pendiente</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('admin.includes.footer')
    </div>
</div>

<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="changeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changeLabel">Detalle de la Actividad</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>
                <span class="name">Nombre de la actividad: </span>
                <span class="name-text">Login IOS</span>
            </p>
        </div>
      </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $('document').ready(function(){
        $('.btn-func').click(function(e){
            e.preventDefault();
            $('#myTab a[href="#funcionalidad"]').tab('show');
        });

        $('.btn-act').click(function(e){
            e.preventDefault();
            $('#myTab a[href="#actividad"]').tab('show');
        });
    })
</script>

@endsection