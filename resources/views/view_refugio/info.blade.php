@extends('layouts.menu_refugio')
@section('contenedor')
<div class=" container-fluid">
    <div class="row">
        <div class=" col-md-5 col-lg-4 col-xl-3" >
            <div class=" ml-0 ml-md-2">
                <img src="{{ asset('images/'.$portada->img_mascota)}}"  class="img-fluid w-100" style="object-fit: cover;height: 300px;">
            </div>
        </div>
        <div class=" col-md-7 col-lg-8 col-xl-8 ">
            <div class="row">
                <div class="col-12 col-md-8">
                    <h4 class="text-uppercase">{{$pet->nom_mascota}}</h4>
                </div>
                <div class="col-12 col-md-2">
                    <a href="{{url ('mascota/'.$pet->id.'/procedimiento')}}" class="btn btn-sm btn-outline-secondary profile-edit-btn border-0" data-paso="¿La mascota ahora esta en {{$proceso}}?">Siguiente procedimiento</a>
                </div>
                <div class="col-12 col-md-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary profile-edit-btn border-0" data-toggle="modal" data-target="#modal_edit_mascota" >Editar Perfil</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <p class="h6 text-muted">{{$pet->especie.' '.$pet->genero}}</p>
                            <p class=" text-muted">{{'La mascota esta en:'.$pet->MascotaEstado->nom_estado_mascota}}</p>
                        </div>
                        <div class="col-6 col-md-3">
                            <p><strong>Edad:</strong>
                                @forelse ($mascotas as $mascota)
                                    @if ($mascota->year > 0)
                                        {{$mascota->year.' años '.$mascota->month.' meses '.$mascota->day.' días'}}
                                    @else
                                        @if ($mascota->month > 0)
                                            {{$mascota->month.' mes '.$mascota->day.' días'}}
                                        @else
                                            {{$mascota->day.' días'}}
                                        @endif
                                    @endif
                                @empty
                                    <div class="alert alert-primary" role="alert">
                                      No hay datos registrados.
                                    </div>
                                @endforelse
                            <p><strong>Raza:</strong> {{$pet->MascotaRaza->nom_raza}}</p>
                        </div>
                        <div class="col-6 col-md-3">
                            <p><strong>Peso:</strong> {{$pet->peso}}</p>
                            <p><strong>Tamaño:</strong> {{$pet->MascotaSize->size}}</p>
                        </div>
                        <div class="col-12">
                            @if (!empty($pet->Persona->id))
                                <p><strong>Responsable:</strong> {{$pet->Persona->nom_persona.' '.$pet->Persona->apellido}}</p>
                            @endif
                            <p><strong>Comportamiento:</strong> {{$pet->desc_mascota}}</p>
                            <p><strong>Recomendaciones:</strong> {{$pet->indicacion_cuidado}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col-12">
            <div class="profile-head">
                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="home" aria-selected="true">Galeria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="profile" aria-selected="false">Historial</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tab-content profile-tab">
                <div class="tab-pane fade show active" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                    <div class="row">
                        <div class="ml-auto p-2 bd-highlight">
                            <div class="div_file pt-1 pb-1 pl-2 pr-2 m-0">
                                <p class="texto-file m-0"><i class="fas fa-plus"></i> Subir Fotos</p>
                                <form action="{{url ('mascota/foto')}}" method="post" id="formgallery" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <input type="text" value="{{$portada->pkmascota}}" id="pkmascota" name="pkmascota" hidden>
                                    <input type="file" class="form-control file-item" id="txtgaleria" name="txtgaleria" accept="image/x-png, image/jpeg">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @forelse ($fotos as $foto)
                            <div class="col-md-6 col-lg-4 col-xl-3 p-0 button-container">
                              <img src="{{ asset('images/'.$foto->img_mascota)}}" class=" img-fluid w-100" style="object-fit: cover;height: 280px;" alt="...">
                              @if ($foto->prioridad == '1')
                              <a href="{{url ('mascota/'.$foto->id.'/foto')}}" class="btn btn-danger btn-sm" data-confirmar="¿Desea eliminar la foto?"><i class="fas fa-trash-alt"></i></a>
                              @endif
                            </div>
                        @empty
                            <div class="alert alert-primary" role="alert">
                            No hay fotos en la galeria!
                          </div>
                        @endforelse
                    </div>
                </div>
                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                    <div class="row">
                        <div class="ml-auto p-2 bd-highlight">
                            <button type="button" class="btn btn-sm btn-outline-secondary profile-edit-btn border-0" data-toggle="modal" data-target="#modal_historial_save" ><i class="fas fa-plus"></i>Agregar Historial</button>
                        </div>
                    </div>
                    <div class="row justify-content-around">
                        <div class="col-12 col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item active pt-1 pb-1">Resumen clínica</li>
                                @forelse ($historias as $historia)
                                <li class="list-group-item d-flex justify-content-between align-items-center pt-1 pb-1">
                                    {{$historia->desc_historial_mascota}}
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success btn-sm" id="edit-item" data-id="{{$historia->id}}" data-historia="{{$historia->desc_historial_mascota}}"><i class="far fa-edit"></i></button>
                                        <a class="btn btn-danger btn-sm" data-toggle="tooltip" title="Eliminar"
                                        href="{{url ('historial/'.$historia->id.'/delete')}}"
                                        data-confirm="¿Desea eliminar la historia '{{$historia->desc_historial_mascota}}'?"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </li>
                                @empty
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    No hay datos!
                                </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class=" modal fade" id="modal_historial_save">
    <div class=" modal-dialog">
        <div class=" modal-content">
            <div class="modal-header bg-info text-white">
                Registro del historial de la mascota
            </div>
            <div class=" modal-body">
                <form action="{{url ('historial/save')}}" method="post">
                    {!! csrf_field() !!}
                    <div class=" form-group">
                        <input type="text" class=" form-control" id="historial" name="historial" required>
                    </div>
                    <input type="text" id="idmascota" name="idmascota" value="{{$pet->id}}" hidden>
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-info">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class=" modal fade" id="modal_historial_edit">
    <div class=" modal-dialog">
        <div class=" modal-content">
            <div class="modal-header bg-info text-white">
                Edición del historial de la mascota
            </div>
            <div class=" modal-body">
                <form action="{{url ('historial/edit')}}" method="post">
                    {!! csrf_field() !!}
                    <div class=" form-group">
                        <input type="text" class=" form-control" id="edit_historial" name="edit_historial" required>
                    </div>
                    <input type="text" id="idhistorial" name="idhistorial" hidden>
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-info">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class=" modal fade" id="modal_edit_mascota">
    <div class=" modal-dialog modal-xl">
        <div class=" modal-content">
            <div class="modal-header bg-info text-white">
                Editar datos de la mascota
            </div>
            <div class=" modal-body">
                <form action="{{url ('mascota/edit')}}" method="post" id="formmascotaedit" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="text" id="idmascota" name="idmascota" value="{{$pet->id}}" hidden>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-5 modal-img">
                                    <img src="{{ asset('images/'.$portada->img_mascota)}}" id="img-perfil" alt="" class=" img-fluid img-modal w-100">
                                    <div class="modal-btn btn btn-lg btn-primary">
                                        <p><i class="fas fa-camera"></i> Actualizar</p>
                                        <input type="file" id="txtperfil" name="txtperfil" accept="image/x-png, image/jpeg" />
                                    </div>
                                </div>

                                <div class="col-7">
                                    <div class=" form-group">
                                        <label for="">Nombre de la mascota:</label>
                                        <input type="text" name="txtnombre" id="txtnombre" class=" form-control form-control-sm" value="{{$pet->nom_mascota}}">
                                        <div class="invalid-feedback" id="error-nombre"></div>
                                    </div>
                                    <div class=" form-group">
                                        <label for="">Nacio el:</label>
                                        <input type="date" name="txtdate" id="txtdate" class=" form-control form-control-sm" value="{{$pet->f_nacimiento}}" >
                                        <div class="invalid-feedback" id="error-date"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 pr-1 pl-1">
                                    <div class=" form-group">
                                        <label for="">Genero</label>
                                        <select class="custom-select custom-select-sm" name="txtsexo" id="txtsexo">
                                            <option value="{{$pet->genero}}">{{$pet->genero}}</option>
                                            <option value="macho" >Macho</option>
                                            <option value="hembra" >Hembra</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 pr-1 pl-1">
                                    <div class=" form-group">
                                        <label for="">Especie</label>
                                        <select class="custom-select custom-select-sm" name="txtespecie" id="txtespecie" onchange="search_size()">
                                            <option value="{{$pet->especie}}">{{$pet->especie}}</option>
                                            @switch(Auth::user()->personaUser->refugio->pktipo)
                                                @case(3)
                                                    <option value="" >Elija..</option>
                                                    <option value="Perros">Perro</option>
                                                    <option value="Gatos" >Gato</option>
                                                    @break
                                            @endswitch
                                        </select>
                                        <small class="text-muted">(Elija primero)</small>
                                        <div class="invalid-feedback" id="error-especie"></div>
                                    </div>
                                </div>
                                <div class="col-3 pr-1">
                                    <div class=" form-group">
                                        <label for="">Tamaño</label>
                                        <select class="custom-select custom-select-sm" name="txtsize" id="txtsize">
                                            <option value="{{$pet->pksize}}">{{$pet->MascotaSize->size}}</option>
                                            @foreach ($sizes as $size)
                                                @if ($size->especie == ($pet->especie.'s') && $size->id != $pet->pksize)
                                                    <option value="{{$size->id}}">{{$size->size}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 pl-1">
                                    <div class=" form-group">
                                        <label for="">Peso(Kg):</label>
                                        <input type="number" step="any" name="txtpeso" id="txtpeso" class=" form-control form-control-sm" value="{{$pet->peso}}">
                                        <div class="invalid-feedback" id="error-peso"></div>
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group">
                                <img src="{{ asset('imagen/petsize.jpg')}}" class="img-fluid" style="height: 70px; width: 466px;">
                            </div>
                            <div class=" form-group">
                                <label for="">Raza:</label>
                                <input type="text" name="txtraza" id="txtraza" class=" form-control form-control-sm" value="{{$pet->MascotaRaza->nom_raza}}" onkeyup="search_raza(this.value, 'raza')">
                                <input type="text" name="txtidraza" id="txtidraza" value="{{$pet->pkraza}}" hidden>
                                <div class="invalid-feedback" id="error-raza"></div>
                                <div id="search_raza_div">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class=" form-group">
                                <label for="">Recomendaciones para su cuidado</label>
                                <textarea name="txtindicacion" id="txtindicacion" cols="10" rows="10" class=" form-control form-control-sm" style="height: 90px;" maxlength="499">{{$pet->indicacion_cuidado}}</textarea>
                                <div class="invalid-feedback" id="error_indicacion"></div>
                                <div class="invalid-feedback" id="error-indicacion"></div>
                            </div>
                            <div class=" form-group">
                                <label for="">Descripción sobre el comportamiento de la mascota</label>
                                <textarea name="txtdetalle" id="txtdetalle" cols="10" rows="10" class=" form-control form-control-sm" style="height: 90px;" maxlength="499">{{$pet->desc_mascota}}</textarea>
                                <div class="invalid-feedback" id="error_detalle"></div>
                                <div class="invalid-feedback" id="error-detalle"></div>
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-sm btn-info" onclick="validar_mascota()">Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
            $('a[data-confirm]').click(function (ev) {
                var href = $(this).attr('href');
                if (!$('#dataConfirmModal').length) {
                    $('body').append('<div class="modal fade in" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-sm btn-default btn-fill" data-dismiss="modal">Cancelar</button><a style="color: #ffffff" class="btn btn-sm btn-primary btn-fill" id="dataConfirmOK">Aceptar</a></div></div></div></div>');
                }
                $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
                $('#dataConfirmOK').attr('href', href);
                $('#dataConfirmModal').modal({show: true});
                return false;
            });
            $('a[data-confirmar]').click(function (ev) {
                var href = $(this).attr('href');
                if (!$('#dataConfirmModal').length) {
                    $('body').append('<div class="modal fade in" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-sm btn-default btn-fill" data-dismiss="modal">Cancelar</button><a style="color: #ffffff" class="btn btn-sm btn-primary btn-fill" id="dataConfirmOK">Aceptar</a></div></div></div></div>');
                }
                $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirmar'));
                $('#dataConfirmOK').attr('href', href);
                $('#dataConfirmModal').modal({show: true});
                return false;
            });
            $('a[data-paso]').click(function (ev) {
                var href = $(this).attr('href');
                if (!$('#dataConfirmModal').length) {
                    $('body').append('<div class="modal fade in" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-sm btn-default btn-fill" data-dismiss="modal">Cancelar</button><a style="color: #ffffff" class="btn btn-sm btn-primary btn-fill" id="dataConfirmOK">Aceptar</a></div></div></div></div>');
                }
                $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-paso'));
                $('#dataConfirmOK').attr('href', href);
                $('#dataConfirmModal').modal({show: true});
                return false;
            });
        });
    function validar_mascota(){
        $.ajax({
            url: "{{ route('mascota.validar') }}",
            method: "POST",
            data: $('#formmascotaedit').serialize(),
            success: function (data) {
                if ((data.nombre).length > 0) {
                    error_view('nombre', data.nombre)
                }
                if ((data.date).length > 0) {
                    error_view('date', data.date)
                }
                if ((data.especie).length > 0) {
                    error_view('especie', data.especie)
                }
                if ((data.peso).length > 0) {
                    error_view('peso', data.peso)
                }
                if ((data.idraza).length > 0 ) {
                    error_view('raza', data.idraza)
                }
                if ((data.recomendacion).length > 0 ) {
                    error_view('indicacion', data.recomendacion)
                }
                if ((data.detalles).length > 0 ) {
                    error_view('detalle', data.detalles)
                }
                if((data.nombre).length == 0 && (data.date).length == 0 && (data.especie).length == 0 && (data.peso).length == 0 && (data.idraza).length == 0 && (data.recomendacion).length == 0 && (data.detalles).length == 0){
                    $( "#formmascotaedit" ).submit();
                }
            }
        });
    }
    function error_view(e ,i){
        $("#txt"+e).addClass( "is-invalid" );
        $("#error-"+e).fadeIn();
        $("#error-"+e).html(i);
    }
    $(document).on('click', "#edit-item", function () {
        var id = $(this).data("id");
        var historia = $(this).data("historia");
        $('#edit_historial').val(historia);
        $('#idhistorial').val(id);
        $("#modal_historial_edit").modal('show');
    });
    document.getElementById('txtperfil').onchange = function () {
        var reader = new FileReader();
        reader.onload = function (e) {
        document.getElementById("img-perfil").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    }
    document.getElementById('txtgaleria').onchange = function () {
        $( "#formgallery" ).submit();
    }
    function search_size(){
        $("#txtsize").empty();
        var query = $('#txtespecie').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('size.search') }}",
            method: "POST",
            data: {query: query, _token: _token},
            success: function (data) {
                $("#txtsize").append(data);            }
        });
    }

    function search_raza(e, a){
        var query = e;
        $('#txtid'+a).val(' ');
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('raza.search') }}",
                method: "POST",
                data: {query: query, class:a , _token: _token},
                success: function (data) {
                    $('#search_'+a+'_div').fadeIn();
                    $('#search_'+a+'_div').html(data);
                }
            });
        }
    }

    $(document).on('click', '.caja-raza', function () {
        $('#txtraza').val($(this).text());
        $('#txtidraza').val($(this).attr("id"));
        $('#search_raza_div').fadeOut();
    });
</script>
@endsection
