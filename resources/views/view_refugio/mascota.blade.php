@extends('layouts.menu_refugio')
@section('contenedor')

<div class=" container-fluid">
    <div class="d-flex bd-highlight">
      <div class="ml-auto p-2 bd-highlight">
          <button class=" btn btn-info btn-sm" data-toggle="modal" data-target="#modal_new_mascota" ><i class="fas fa-plus"></i>Ingreso</button>
          <button class=" btn btn-info btn-sm" data-toggle="modal" data-target="#modal_new_rescate" ><i class="fas fa-plus"></i>Rescatada</button>
      </div>
    </div>
    <div class="row justify-content-center">
        @forelse ($estado_adopcion as $est_adop)
            <label for=""></label>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card mb-3 text-white border-0" style="background-color: #96deda;height: 100px;">
                  <div class="row no-gutters">
                    <div class="col-9 col-md-8">
                      <div class="card-body p-1 p-md-3 pr-0 pr-md-0">
                        <p class="card-title">{{$est_adop->nom_estado_mascota}}</p>
                        <h2>{{$est_adop->estado}}</h2>
                      </div>
                    </div>
                    <div class="col-3 col-md-4 align-items-center p-1 p-md-3">
                        <img src="{{ asset('imagen/'.$est_adop->icon)}}" class="card-img " style="object-fit: container;" alt="...">
                        </i></p>
                    </div>
                  </div>
                </div>
            </div>
        @empty
            <label for="">Espacios basios!!</label>
        @endforelse
    </div>

    <div class="row">
        @forelse ($mascotas as $mascota)
        <div class="col-md-6 col-lg-4 col-xl-2">
            <div class="card mb-3">
              <div class="row no-gutters">
                <div class="col-12">
                  <img src="{{ asset('images/'.$mascota->img_mascota)}}" class="card-img " style="object-fit: cover;height: 236px" alt="...">
                </div>
                <div class="col-12">
                  <div class="card-body">
                    <p class="card-title m-0 text-uppercase">{{$mascota->galeriaMascota->nom_mascota}}</p>
                  </div>
                  <div class=" card-footer d-flex justify-content-between align-items-center">
                    <span class="badge badge-pill badge-primary">{{$mascota->galeriaMascota->MascotaEstado->nom_estado_mascota}}</span>
                    <a href="mascota/info/{{encrypt($mascota->galeriaMascota->id)}}" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i>Información</a>
                  </div>
                </div>
              </div>
            </div>
        </div>
        @empty
        <div class="alert alert-danger" role="alert">
            No hay datos Registrados!
          </div>
        @endforelse
    </div>
</div>

<div class=" modal fade" id="modal_new_mascota">
    <div class=" modal-dialog modal-xl">
        <div class=" modal-content">
            <div class="modal-header bg-info text-white">
                Registro de mascota ingresada
            </div>
            <div class=" modal-body">
                <form action="{{url ('mascota/save')}}" method="post" id="formmascotasave" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-5 modal-img">
                                    <img src="{{ asset('images/perfilPerros.png')}}" id="img-perfil" alt="" class=" img-fluid img-modal">
                                    <div class="modal-btn btn btn-lg btn-primary">
                                        <p><i class="fas fa-camera"></i> Actualizar</p>
                                        <input type="file" id="txtperfil" name="txtperfil" accept="image/x-png, image/jpeg" />
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class=" form-group">
                                        <label for="">Nombre de la mascota:</label>
                                        <input type="text" name="txtnombre" id="txtnombre" class=" form-control form-control-sm">
                                        <div class="invalid-feedback" id="error-nombre"></div>
                                    </div>
                                    <div class=" form-group">
                                        <label for="">Nacio el:</label>
                                        <input type="date" name="txtdate" id="txtdate" class=" form-control form-control-sm" >
                                        <div class="invalid-feedback" id="error-date"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 pr-1 pl-1">
                                    <div class=" form-group">
                                        <label for="">Genero</label>
                                        <select class="custom-select custom-select-sm" name="txtsexo" id="txtsexo">
                                            <option value="macho" >Macho</option>
                                            <option value="hembra" >Hembra</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 pr-1 pl-1">
                                    <div class=" form-group">
                                        <label for="">Especie</label>
                                        <select class="custom-select custom-select-sm" name="txtespecie" id="txtespecie" onchange="search_size(this.value, '_add')">
                                            @switch(Auth::user()->personaUser->refugio->pktipo)
                                                @case(1)
                                                    <option value="Gatos">Gato</option>
                                                    @break
                                                @case(2)
                                                    <option value="Perros">Perro</option>
                                                    @break
                                                @default
                                                    <option value="" >Elija..</option>
                                                    <option value="Perros">Perro</option>
                                                    <option value="Gatos" >Gato</option>
                                            @endswitch
                                        </select>
                                        <small class="text-muted">(Elija primero)</small>
                                        <div class="invalid-feedback" id="error-especie"></div>
                                    </div>
                                </div>
                                <div class="col-3 pr-1">
                                    <div class=" form-group">
                                        <label for="">Tamaño</label>
                                        <select class="custom-select custom-select-sm" name="txtsize_add" id="txtsize_add">
                                            @foreach ($sizes as $size)
                                                @if ($size->especie == $tipo_refugio)
                                                    <option value="{{$size->id}}">{{$size->size}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 pl-1">
                                    <div class=" form-group">
                                        <label for="">Peso(Kg):</label>
                                        <input type="number" step="any" name="txtpeso" id="txtpeso" class=" form-control form-control-sm" >
                                        <div class="invalid-feedback" id="error-peso"></div>
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group">
                                <img src="{{ asset('imagen/petsize.jpg')}}" class="img-fluid" style="height: 70px; width: 466px;">
                            </div>
                            <div class=" form-group">
                                <label for="">Raza:</label>
                                <input type="text" name="txtraza" id="txtraza" class=" form-control form-control-sm" onkeyup="search_raza(this.value, 'raza')">
                                <input type="text" name="txtidraza" id="txtidraza" hidden>
                                <div class="invalid-feedback" id="error-raza"></div>
                                <div id="search_raza_div">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class=" form-group">
                                <label for="">Responsable <small>(ópcional)</small></label>
                                <input type="text" class=" form-control form-control-sm" id="txtresponsable_persona" name="txtresponsable_persona" onkeyup="search_people(this.value, 'persona')">
                                <input type="text" id="txtid_responsable_persona" name="txtid_responsable_persona" hidden>
                                <div id="search_responsable_persona_div"></div>
                            </div>
                            <div class=" form-group">
                                <label for="">Recomendaciones para su cuidado <small>(ópcional)</small></label>
                                <textarea name="txtindicacion" id="txtindicacion" cols="10" rows="10" class=" form-control form-control-sm" style="height: 90px;" maxlength="499"></textarea>
                                <div class="invalid-feedback" id="error-indicacion"></div>
                            </div>
                            <div class=" form-group">
                                <label for="">Descripción sobre el comportamiento de la mascota <small>(ópcional)</small></label>
                                <textarea name="txtdetalle" id="txtdetalle" cols="10" rows="10" class=" form-control form-control-sm" style="height: 90px;" maxlength="499"></textarea>
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

<div class=" modal fade" id="modal_new_rescate">
    <div class=" modal-dialog modal-xl">
        <div class=" modal-content">
            <div class="modal-header bg-info text-white">
                Registro de mascota rescatada
            </div>
            <div class=" modal-body">
                <form action="{{url ('rescate/save')}}" method="post" id="formrescatesave" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col">
                                    <div class=" form-group">
                                        <label for="">Nombre de la mascota:</label>
                                        <input type="text" name="txtnombre_rescate" id="txtnombre_rescate" class=" form-control form-control-sm">
                                        <div class="invalid-feedback" id="error-nombre-rescate"></div>
                                    </div>
                                    <div class=" form-group">
                                        <label for="">Nacio el:</label>
                                        <input type="date" name="txtdate_rescate" id="txtdate_rescate" class=" form-control form-control-sm" >
                                        <div class="invalid-feedback" id="error-date-rescate"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 pr-1 pl-1">
                                    <div class=" form-group">
                                        <label for="">Genero</label>
                                        <select class="custom-select custom-select-sm" name="txtsexo_rescate" id="txtsexo_rescate">
                                            <option value="macho" >Macho</option>
                                            <option value="hembra" >Hembra</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 pr-1 pl-1">
                                    <div class=" form-group">
                                        <label for="">Especie</label>
                                        <select class="custom-select custom-select-sm" name="txtespecie_rescate" id="txtespecie_rescate" onchange="search_size(this.value, '_recate')">
                                            @switch(Auth::user()->personaUser->refugio->pktipo)
                                                @case(1)
                                                    <option value="Gatos">Gato</option>
                                                    @break
                                                @case(2)
                                                    <option value="Perros">Perro</option>
                                                    @break
                                                @default
                                                    <option value="" >Elija..</option>
                                                    <option value="Perros">Perro</option>
                                                    <option value="Gatos" >Gato</option>
                                            @endswitch
                                        </select>
                                        <small class="text-muted">(Elija primero)</small>
                                        <div class="invalid-feedback" id="error-especie_rescate"></div>
                                    </div>
                                </div>
                                <div class="col-3 pr-1">
                                    <div class=" form-group">
                                        <label for="">Tamaño</label>
                                        <select class="custom-select custom-select-sm" name="txtsize_recate" id="txtsize_recate">
                                            @foreach ($sizes as $size)
                                                @if ($size->especie == $tipo_refugio)
                                                    <option value="{{$size->id}}">{{$size->size}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 pl-1">
                                    <div class=" form-group">
                                        <label for="">Peso(Kg):</label>
                                        <input type="number" step="any" name="txtpeso_rescate" id="txtpeso_rescate" class=" form-control form-control-sm" >
                                        <div class="invalid-feedback" id="error-peso_rescate"></div>
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group">
                                <img src="{{ asset('imagen/petsize.jpg')}}" class="img-fluid" style="height: 70px; width: 466px;">
                            </div>
                            <div class=" form-group">
                                <label for="">Raza:</label>
                                <input type="text" name="txtraza_rescate" id="txtraza_rescate" class=" form-control form-control-sm" onkeyup="search_raza(this.value, 'raza_rescate')">
                                <input type="text" name="txtidraza_rescate" id="txtidraza_rescate" hidden>
                                <div class="invalid-feedback" id="error-raza_rescate"></div>
                                <div id="search_raza_rescate_div">
                                </div>
                            </div>
                            <div class=" form-group">
                                <label for="">Responsable <small>(ópcional)</small></label>
                                <input type="text" class=" form-control form-control-sm" id="txtresponsable_rescate" name="txtresponsable_rescate" onkeyup="search_people(this.value, 'rescate')">
                                <input type="text" id="txtid_responsable_rescate" name="txtid_responsable_rescate" hidden>
                                <div id="search_responsable_rescate_div"></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">Fecha de Rescate</label>
                                <input type="date" class=" form-control form-control-sm" name="txtfecha_rescate" id="txtfecha_rescate">
                                <div class="invalid-feedback" id="error-fecha_rescate"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Lugar de rescate</label>
                                <input type="text" class=" form-control form-control-sm" name="txtlugar_rescate" id="txtlugar_rescate">
                                <div class="invalid-feedback" id="error-lugar_rescate"></div>
                            </div>
                            <div class=" form-group">
                                <label for="">Detalle de Salud <small>(ópcional)</small></label>
                                <textarea name="txtsalud" id="txtsalud" cols="10" rows="10" class=" form-control form-control-sm" style="height: 90px;" maxlength="499"></textarea>
                                <div class="invalid-feedback" id="error-salud"></div>
                            </div>
                            <div class=" form-group">
                                <label for="">Historia del rescate <small>(ópcional)</small></label>
                                <textarea name="txthistoria" id="txthistoria" cols="10" rows="10" class=" form-control form-control-sm" style="height: 90px;" maxlength="499"></textarea>
                                <div class="invalid-feedback" id="error-historia"></div>
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-sm btn-info" onclick="validar_mascota_rescate()">Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('txtperfil').onchange = function () {
            var reader = new FileReader();
            reader.onload = function (e) {
            document.getElementById("img-perfil").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    function search_size(e , a){
        $("#txtsize"+a).empty();
        var query = e;
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('size.search') }}",
            method: "POST",
            data: {query: query, _token: _token},
            success: function (data) {
                $("#txtsize"+a).append(data);
            }
        });
    }
    function validar_mascota(){
        $.ajax({
            url: "{{ route('mascota.validar') }}",
            method: "POST",
            data: $('#formmascotasave').serialize(),
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
                    $( "#formmascotasave" ).submit();
                }
            }
        });
    }

    function validar_mascota_rescate(){
        $.ajax({
            url: "{{ route('rescate.validar') }}",
            method: "POST",
            data: $('#formrescatesave').serialize(),
            success: function (data) {
                if ((data.nombre).length > 0) {
                    error_view('nombre-rescate', data.nombre)
                }
                if ((data.date).length > 0) {
                    error_view('date-rescate', data.date)
                }
                if ((data.especie).length > 0) {
                    error_view('especie_rescate', data.especie)
                }
                if ((data.peso).length > 0) {
                    error_view('peso_rescate', data.peso)
                }
                if ((data.idraza).length > 0 ) {
                    error_view('raza_rescate', data.idraza)
                }
                if ((data.fecharescate).length > 0 ) {
                    error_view('fecha_rescate', data.fecharescate)
                }
                if ((data.lugarescate).length > 0 ) {
                    error_view('lugar_rescate', data.lugarescate)
                }
                if ((data.salud).length > 0 ) {
                    error_view('salud', data.salud)
                }
                if ((data.historia).length > 0 ) {
                    error_view('historia', data.historia)
                }
                if((data.nombre).length == 0 && (data.date).length == 0 && (data.especie).length == 0 && (data.peso).length == 0 && (data.idraza).length == 0 && (data.fecharescate).length == 0 && (data.lugarescate).length == 0 && (data.salud).length == 0 && (data.historia).length == 0){
                    $( "#formrescatesave" ).submit();
                }
            }
        });
    }

    function error_view(e ,i){
        $("#txt"+e).addClass( "is-invalid" );
        $("#error-"+e).fadeIn();
        $("#error-"+e).html(i);
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
    $(document).on('click', '.caja-raza_rescate', function () {
        $('#txtraza_rescate').val($(this).text());
        $('#txtidraza_rescate').val($(this).attr("id"));
        $('#search_raza_rescate_div').fadeOut();
    });

    function search_people(e, a){
        var query = e;
        $('#txtid_responsable_'+a).val(' ');
        if (query != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('persona.search') }}",
                method: "POST",
                data: {query: query, class:a, _token: _token},
                success: function (data) {
                    $('#search_responsable_'+a+'_div').fadeIn();
                    $('#search_responsable_'+a+'_div').html(data);
                }
            });
        }else{
            $('#search_responsable_'+a+'_div').fadeOut();
        }
    }

    $(document).on('click', '.responsable_persona', function () {
        $('#txtresponsable_persona').val($(this).text());
        $('#txtid_responsable_persona').val($(this).attr("id"));
        $('#search_responsable_persona_div').fadeOut();
    });
    $(document).on('click', '.responsable_rescate', function () {
        $('#txtresponsable_rescate').val($(this).text());
        $('#txtid_responsable_rescate').val($(this).attr("id"));
        $('#search_responsable_rescate_div').fadeOut();
    });
</script>
@endsection
