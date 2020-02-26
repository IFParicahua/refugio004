@extends('layouts.menu')
<style>
    body {
        background: url({{ asset('imagen/fondo02.jpg')}}) no-repeat   center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        }
    .texto-date{
        font-size:12px
    }
</style>
@section('contenedor')
<div class=" container">
    <div class="row justify-content-center ">
        <div class=" col-12  col-md-5 mx-auto" >
            <h2 class=" text-center">Registro</h2>
            <br>
            <form action="{{ url('empresa/create') }}" method="post">
                @csrf
                <h5 class=" text-center">Empresa</h5>
                <div class=" form-group">
                    <input type="text" name="txtrazon_social" id="txtrazon_social" class="form-control @error('txtrazon_social') is-invalid @enderror " required maxlength="255" value="{{ old('txtrazon_social') }}" placeholder="Razón Social">
                    @error('txtrazon_social')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <select class="custom-select @error('txtrubro') is-invalid @enderror" name="txtrubro" id="txtrubro" required>
                        <option value="">Se identifica con....</option>
                        @forelse ($rubros as $rubro)
                        <option value="{{$rubro->id}}">{{$rubro->desc_rubro}}</option>
                        @empty
                        <option value="0">No hay rubros en el sistema</option>
                        @endforelse
                    </select>
                    @error('txtrubro')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class=" form-group">
                    <textarea class="form-control" placeholder="Descripcion de la empresa...." id="txtdescripcion" name="txtdescripcion" maxlength="500">{{old('txtdescripcion')}}</textarea>
                </div>
                <div class="form-group">
                    <input type="email" name="txtemail" id="txtemail" class=" form-control @error('txtemail') is-invalid @enderror" required maxlength="255" value="{{ old('txtemail') }}" placeholder="Email">
                    @error('txtemail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="txtpassword" id="txtpassword" class=" form-control @error('txtpassword') is-invalid @enderror" required minlength="8" value="{{ old('txtpassword') }}" placeholder="Contraseña">
                    @error('txtpassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="txtdireccion_emp" id="txtdireccion_emp" class=" form-control @error('txtdireccion_emp') is-invalid @enderror" required maxlength="500" value="{{ old('txtdireccion_emp') }}" placeholder="Dirección de la Empresa">
                    @error('txtdireccion_emp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class=" form-group col-6">
                        <input type="text" name="txtsigla" id="txtsigla" class=" form-control @error('txtsigla') is-invalid @enderror" required maxlength="10" value="{{ old('txtsigla') }}" placeholder="Sigla">
                        @error('txtsigla')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class=" form-group col-6">
                        <input type="text" name="txtnit" id="txtnit" class=" form-control @error('txtnit') is-invalid @enderror" required maxlength="50" value="{{ old('txtnit') }}" placeholder="NIT">
                        @error('txtnit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <h5 class=" text-center">Representante</h5>
                <div class="form-group">
                    <input type="text" name="txtnombre" id="txtnombre" class="form-control @error('txtnombre') is-invalid @enderror" required maxlength="255" value="{{ old('txtnombre') }}" placeholder="Nombre">
                    @error('txtnombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="txtapellido" id="txtapellido" class="form-control @error('txtapellido') is-invalid @enderror" required maxlength="255" value="{{ old('txtapellido') }}" placeholder="Apellido">
                    @error('txtapellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="txtdireccion" id="txtdireccion" class="form-control @error('txtdireccion') is-invalid @enderror" required maxlength="500" value="{{ old('txtdireccion') }}" placeholder="Dirección Personal">
                    @error('txtdireccion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <input type="text" name="txtci" id="txtci" class="form-control @error('txtci') is-invalid @enderror" required maxlength="20" value="{{ old('txtci') }}" placeholder="CI">
                        @error('txtci')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <input type="number" name="txttelefono" id="txttelefono" class="form-control @error('txttelefono') is-invalid @enderror" required value="{{ old('txttelefono') }}" placeholder="Teléfono">
                        @error('txttelefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <input type="date" name="txtdate" id="txtdate" class=" form-control @error('txtdate') is-invalid @enderror" required value="{{ old('txtdate') }}">
                        <small>Fecha de Nacimiento</small>
                        @error('txtdate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <select class="custom-select @error('txtsexo') is-invalid @enderror" name="txtsexo" id="txtsexo" required >
                            <option selected>Sexo...</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Otro">Otro</option>
                        </select>
                        @error('txtsexo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn-lg btn text-white mx-auto btn-block col-9" style="border-radius:60px; background: #b28dff">Registrarse</button>
            </form>
        </div>
    </div>

</div>
@endsection

