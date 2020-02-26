@extends('layouts.menu_user')
@section('contenedor')
    <div class=" container rounded shadow p-3">
        <div class="row">
            <div class="col-md-3 ml-5 ml-md-0" >
                <form action="{{url('perfil/save')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="profile-img ml-5">
                        <img src="{{ asset('images/'.Auth::user()->imagen_perfil)}}" id="img-perfil" class="img-fluid" style="width:180px;height:180px;">
                        <div class="file btn btn-lg btn-primary">
                            <p>Cambiar Foto</p>
                            <input type="file" id="file_perfil" name="file_perfil" accept="image/x-png, image/jpeg" />
                        </div>
                    </div>
                    <button type="submit" id="btn-save" name="btn-save" class=" btn btn-info btn-sm d-none">Guardar Cambios</button>
                </form>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-8 col-md-9">
                        <h5> {{ Auth::user()->personaUser->empresa->razonsocial}}</h5>
                    </div>
                    <div class="col-4 col-md-3">
                        <button type="button" class="btn btn-sm btn-outline-secondary profile-edit-btn border-0" data-toggle="modal" data-target="#modal-editar-empresa" >Editar Perfil de la Empresa</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p class="h6 text-muted">{{ Auth::user()->personaUser->empresa->sigla}}</p>
                    </div>
                    <div class="col-3">
                        <p class="h6 text-muted"><strong>NIT </strong> {{ Auth::user()->personaUser->empresa->nit}}</p>
                    </div>
                    <div class="col-6">
                        <p class="h6 text-muted"><i class="far fa-envelope"></i>{{Auth::user()->email}}</p>
                    </div>
                </div>
                <p><strong>Dirección </strong>{{ Auth::user()->personaUser->empresa->dir_empresa}}</p>
                <p><strong>Descripción </strong>{{ Auth::user()->personaUser->empresa->desc_empresa}}</p>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-6">
                        <h5 class=" mb-3">Representante<button type="button" class="btn btn-sm btn-outline-secondary profile-edit-btn border-0" data-toggle="modal" data-target="#modal-editar" >Editar datos del Representante</button>
                        </h5>
                        <p><strong>Nombre y Apellido:</strong>{{Auth::user()->personaUser->nom_persona.' '.Auth::user()->personaUser->apellido}}</p>
                        <p><strong>CI:</strong> {{Auth::user()->personaUser->CI}}</p>
                        <p><strong>Genero:</strong> {{Auth::user()->personaUser->genero_persona}}</p>
                        <p><strong>Nacio el:</strong> {{Auth::user()->personaUser->f_nac_persona}}</p>
                        <p><strong>Teléfono:</strong> {{Auth::user()->personaUser->telefono}}</p>
                        <p><strong>Dirección:</strong> {{Auth::user()->personaUser->dir_persona}}</p>
                    </div>
                    <div class="col-6">
                        <p><strong>Enlaces</strong> <button type="button" class="btn btn-sm btn-outline-secondary profile-edit-btn border-0" data-toggle="modal" data-target="#modal-enlace">Agregar Link</button></p>
                        @forelse ($enlaces as $enlace)
                            <button type="button" class="btn btn-outline-secondary border-0 btn-sm" onclick="editar_link({{$enlace->id}} , '{{$enlace->link}} ', '{{$enlace->identificador}}')"><i class="far fa-edit"></i></button>
                            <a class="btn btn-outline-secondary border-0 btn-sm" data-toggle="tooltip" title="Eliminar" href="{{url ('enlace/'.$enlace->id.'/delete')}}" data-confirm="¿Desea eliminar el enlace {{$enlace->identificador}}?"><i class="far fa-trash-alt"></i></a>
                            <a href="{{$enlace->link}}">{{$enlace->identificador}}</a>
                            <br/>
                        @empty
                            <div class="alert alert-primary" role="alert">
                              No tiene enlaces guardados.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL ENLACE EDITAR --}}
    <div class="modal fade" id="modal-enlace-editar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    Editar enlace
                </div>
                <form action="{{url ('enlace/editar')}}" method="post" id="formupdatelink">
                    {!! csrf_field() !!}
                <input type="text" id="txtid_edit" name="txtid_edit" value="{{old('txtid_edit')}}" hidden>
                    <div class=" modal-body">
                        <div class=" form-group">
                            <label for="">Identificador:</label>
                            <input type="text" id="txtedit-identificador" name="txtedit-identificador" value="{{ old('txtedit-identificador') }}" class=" form-control form-control-sm @error('txtidentificadoredit') is-invalid @enderror" maxlength="55">
                            <div class="invalid-feedback" id="erroredit-identificador"></div>

                        </div>
                        <div class=" form-group">
                            <label for="">Enlace:</label>
                            <input type="text" id="txtedit-enlace" name="txtedit-enlace" value="{{ old('txtedit-enlace') }}" class=" form-control form-control-sm @error('txtenlaceedit') is-invalid @enderror" maxlength="255">
                            <div class="invalid-feedback" id="erroredit-identificador"></div>

                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" onclick="validar_enlace('update')" class="btn btn-info">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- MODAL ENLACE --}}
    <div class="modal fade" id="modal-enlace">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    Agregar enlace
                </div>

                <form action="{{url ('enlace/save')}}" method="post" id="formsavelink">
                    {!! csrf_field() !!}
                    <div class=" modal-body">
                        <div class=" form-group">
                            <label for="">Identificador:</label>
                            <input type="text" id="txtidentificador" name="txtidentificador" class=" form-control form-control-sm @error('txtidentificador') is-invalid @enderror" value="{{ old('txtidentificador') }}" maxlength="55">
                            <div class="invalid-feedback" id="error-identificador"></div>

                        </div>
                        <div class=" form-group">
                            <label for="">Enlace:</label>
                            <input type="text" id="txtenlace" name="txtenlace" class=" form-control form-control-sm @error('txtenlace') is-invalid @enderror" value="{{ old('txtenlace') }}" maxlength="255">
                            <div class="invalid-feedback" id="error-enlace"></div>

                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-info" onclick="validar_enlace('save')">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- MODAL EDITAR PERFIL --}}
    <div class="modal fade" id="modal-editar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    Editar Perfil
                </div>
                <form action="{{url ('persona/editar')}}" method="post" id="formeditarpersona">
                    {!! csrf_field() !!}
                    <div class=" modal-body">
                        <div class=" form-group">
                            <label for="">Nombre:</label>
                            <input type="text" id="txtnombre" name="txtnombre" class=" form-control form-control-sm" value="{{ Auth::user()->personaUser->nom_persona}}">
                            <div class="invalid-feedback" id="error-nombre"></div>
                        </div>
                        <div class=" form-group">
                            <label for="">Apellido:</label>
                            <input type="text" id="txtapellido" name="txtapellido" class=" form-control form-control-sm" value="{{Auth::user()->personaUser->apellido}}">
                            <div class="invalid-feedback" id="error-apellido"></div>
                        </div>
                        <div class=" form-group">
                            <label for="">Dirección:</label>
                            <input type="text" id="txtdireccion" name="txtdireccion" class=" form-control form-control-sm" value="{{Auth::user()->personaUser->dir_persona}}">
                            <div class="invalid-feedback" id="error-direccion"></div>
                        </div>
                        <div class="row">
                            <div class=" form-group col-6">
                                <label for="">CI:</label>
                                <input type="text" id="txtci" name="txtci" class=" form-control form-control-sm" value="{{Auth::user()->personaUser->CI}}">
                                <div class="invalid-feedback" id="error-ci"></div>
                            </div>
                            <div class=" form-group col-6">
                                <label for="">Teléfono:</label>
                                <input type="text" id="txtelefono" name="txttelefono" class=" form-control form-control-sm" value="{{Auth::user()->personaUser->telefono}}">
                                <div class="invalid-feedback" id="error-telefono"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" form-group col-6">
                                <label for="">Nacio el:</label>
                                <input type="text" id="txtdate" name="txtdate" class=" form-control form-control-sm" value="{{Auth::user()->personaUser->f_nac_persona}}">
                                <div class="invalid-feedback" id="error-date"></div>
                            </div>
                            <div class=" form-group col-6">
                                <label for="">Genero:</label>
                                <select class="custom-select" id="txtgenero" name="txtgenero"  required>
                                    @if (Auth::user()->personaUser->genero_persona == 'Femenino')
                                        <option value="Femenino">Femenino</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Otro">Otro</option>
                                    @else
                                        @if (Auth::user()->personaUser->genero_persona == 'Masculino')
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                        @else
                                        <option value="Otro">Otro</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Masculino">Masculino</option>
                                        @endif
                                    @endif
                                </select>
                                <div class="invalid-feedback" id="error-genero"></div>
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-info" onclick="validar_persona()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- MODAL EDITAR Empresa --}}
    <div class="modal fade" id="modal-editar-empresa">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    Editar Perfil de la Empresa
                </div>
                <form action="{{url ('empresa/editar')}}" method="post" id="formeditarempresa">
                    {!! csrf_field() !!}
                    <div class=" modal-body">
                        <div class=" form-group">
                            <label for="">Razón Social:</label>
                            <input type="text" id="txtrazonsocial" name="txtrazonsocial" class=" form-control form-control-sm" value="{{ Auth::user()->personaUser->empresa->razonsocial}}">
                            <div class="invalid-feedback" id="error-razonsocial"></div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">Email:</label>
                                <input type="text" id="txtemail" name="txtemail" class=" form-control form-control-sm" value="{{Auth::user()->email}}">
                                <div class="invalid-feedback" id="error-email"></div>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Contraseña:</label>
                                <input type="password" id="txtpassword" name="txtpassword" class=" form-control form-control-sm" value="**********">
                                <div class="invalid-feedback" id="error-password"></div>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="">Dirección:</label>
                            <input type="text" id="txtdireccionemp" name="txtdireccionemp" class=" form-control form-control-sm" value="{{ Auth::user()->personaUser->empresa->dir_empresa}}">
                            <div class="invalid-feedback" id="error-direccionemp"></div>
                        </div>
                        <div class=" form-group">
                            <label for="">Descripción:</label>
                            <input type="text" id="txtdescripcion" name="txtdescripcion" class=" form-control form-control-sm" value="{{ Auth::user()->personaUser->empresa->desc_empresa}}">
                            <div class="invalid-feedback" id="error-descripcion"></div>
                        </div>
                        <div class="row">
                            <div class=" form-group col-6">
                                <label for="">Sigla:</label>
                                <input type="text" id="txtsigla" name="txtsigla" class=" form-control form-control-sm" value="{{ Auth::user()->personaUser->empresa->sigla}}">
                                <div class="invalid-feedback" id="error-sigla"></div>
                            </div>
                            <div class="form-group col-6">
                                <label for="">NIT:</label>
                                <input type="text" id="txtnit" name="txtnit" class=" form-control form-control-sm" value="{{ Auth::user()->personaUser->empresa->nit}}">
                                <div class="invalid-feedback" id="error-nit"></div>
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-info" onclick="validar_empresa()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('a[data-confirm]').click(function (ev) {
                var href = $(this).attr('href');
                if (!$('#dataConfirmModal').length) {
                    $('body').append('<div class="modal fade in" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancelar</button><a style="color: #ffffff" class="btn btn-primary btn-fill" id="dataConfirmOK">Aceptar</a></div></div></div></div>');
                }
                $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
                $('#dataConfirmOK').attr('href', href);
                $('#dataConfirmModal').modal({show: true});
                return false;
            });
        });
        function validar_empresa(){
            $.ajax({
                url: "{{ route('empresa.validar') }}",
                method: "POST",
                data: $('#formeditarempresa').serialize(),
                success: function (data) {
                    if ((data.razonsocial).length > 0) {
                        error_view('razonsocial', data.razonsocial)
                    }
                    if ((data.email).length > 0) {
                        error_view('email', data.email)
                    }
                    if ((data.password).length > 0) {
                        error_view('password', data.password)
                    }
                    if ((data.direccionemp).length > 0) {
                        error_view('direccionemp', data.direccionemp)
                    }
                    if ((data.descripcion).length > 0) {
                        error_view('descripcion', data.descripcion)
                    }
                    if ((data.sigla).length > 0) {
                        error_view('sigla', data.sigla)
                    }
                    if ((data.nit).length > 0) {
                        error_view('nit', data.nit)
                    }
                    if((data.razonsocial).length == 0 && (data.email).length == 0 && (data.password).length == 0 && (data.direccionemp).length == 0 && (data.descripcion).length == 0 && (data.sigla).length == 0 && (data.nit).length == 0){
                        $( "#formeditarempresa" ).submit();
                    }
                }
            });
        }

        function error_view(e ,i){
            $("#txt"+e).addClass( "is-invalid" );
            $("#error-"+e).fadeIn();
            $("#error-"+e).html(i);
        }
        function editar_link(ids, links, identifis) {
            var id = ids;
            var link = links;
            var identifi = identifis;
            var valor = $("#link-editar").hasClass("d-none")
            $('#txtid_edit').val(id);
            $('#txtedit-identificador').val(identifi);
            $('#txtedit-enlace').val(link);
            $('#modal-enlace-editar').modal('show');
        }
        function validar_enlace(o){
            if(o == 'save'){
                var enlace = $('#txtenlace').val();
                var identificador = $('#txtidentificador').val();
            }else{
                var enlace = $('#txtedit-enlace').val();
                var identificador = $('#txtedit-identificador').val();
            }
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('enlace.validar') }}",
                method: "POST",
                data: {enlace: enlace, identificador: identificador, _token: _token},
                success: function (data) {
                    if ((data.enlace).length > 0) {
                        error_view_link('enlace', data.enlace, o)
                    }
                    if ((data.identificador).length > 0) {
                        error_view_link('identificador', data.identificador, o)
                    }
                    if((data.enlace).length == 0 && (data.identificador).length == 0){
                        if (o == 'save') {
                            $( "#formsavelink" ).submit();
                        }else{
                            $( "#formupdatelink" ).submit();
                        }
                    }
                }
            });
        }
        function error_view_link(e ,i, o){
            if (o == 'save') {
                $("#txt"+e).addClass( "is-invalid" );
                $("#error-"+e).fadeIn();
                $("#error-"+e).html(i);
            }else{
                $("#txtedit"+e).addClass( "is-invalid" );
                $("#erroredit-"+e).fadeIn();
                $("#erroredit-"+e).html(i);
            }
        }
        document.getElementById('file_perfil').onchange = function () {
            var reader = new FileReader();
            reader.onload = function (e) {
            document.getElementById("img-perfil").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
            $("#btn-save").removeClass( "d-none" );
        }

        function validar_persona(){
            $.ajax({
                url: "{{ route('persona.validar') }}",
                method: "POST",
                data: $('#formeditarpersona').serialize(),
                success: function (data) {
                    if ((data.nombre).length > 0) {
                        error_view('nombre', data.nombre)
                    }
                    if ((data.apellido).length > 0) {
                        error_view('apellido', data.apellido)
                    }
                    if ((data.direccion).length > 0) {
                        error_view('direccion', data.direccion)
                    }
                    if ((data.ci).length > 0) {
                        error_view('ci', data.ci)
                    }
                    if ((data.telefono).length > 0) {
                        error_view('telefono', data.telefono)
                    }
                    if ((data.date).length > 0) {
                        error_view('date', data.date)
                    }
                    if ((data.genero).length > 0) {
                        error_view('genero', data.genero)
                    }
                    if((data.date).length == 0 && (data.nombre).length == 0 && (data.apellido).length == 0 &&  (data.direccion).length == 0 && (data.ci).length == 0 && (data.telefono).length == 0 && (data.genero).length == 0){
                        $( "#formeditarpersona" ).submit();
                    }
                }
            });
        }
    </script>
@endsection
