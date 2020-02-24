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
            <form action="{{ url('refugio/create') }}" method="post">
                @csrf
                <h5 class=" text-center">Refugio</h5>
                <div class=" form-group">
                    <input type="text" name="txtnom_refugio" id="txtnom_refugio" class=" form-control @error('txtnom_refugio') is-invalid @enderror" required maxlength="255" value="{{ old('txtnom_refugio') }}" placeholder="Nombre del Refugio">
                    @error('txtnom_refugio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
                    <input type="text" name="txtdir_refugio" id="txtdir_refugio" class=" form-control @error('txtdir_refugio') is-invalid @enderror" required maxlength="500" value="{{ old('txtdir_refugio') }}" placeholder="Dirección del Refugio">
                    @error('txtdir_refugio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class=" form-group col-6">
                        <input type="number" name="txtcapacidad" id="txtcapacidad" class=" form-control @error('txtcapacidad') is-invalid @enderror" required value="{{ old('txtcapacidad') }}" placeholder="Capacidad">
                        @error('txtcapacidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class=" form-group col-6">
                        <select class="custom-select @error('txtipo') is-invalid @enderror" name="txtipo" id="txtipo" required>
                            <option value="">Tipo...</option>
                            @forelse ($tipos as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->tipo_refugio}}</option>
                            @empty
                                <option value="">No hay datos...</option>
                            @endforelse
                        </select>
                        @error('txtipo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class=" form-group">
                    <textarea class="form-control @error('txtdescripcion') is-invalid @enderror" required maxlength="500" placeholder="Descripcion del Refugio...." id="txtdescripcion" name="txtdescripcion">{{ old('txtdescripcion') }}</textarea>
                    @error('txtdescripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
                        <input type="number" name="txtelefono" id="txtelefono" class="form-control @error('txtelefono') is-invalid @enderror" required value="{{ old('txtelefono') }}" placeholder="Teléfono">
                        @error('txtelefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <input type="date" name="txtdate" id="txtdate" class=" form-control @error('txtdate') is-invalid @enderror" required>
                        <small>Fecha de Nacimiento</small>
                        @error('txtdate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <select class="custom-select @error('txtsexo') is-invalid @enderror" name="txtsexo" id="txtsexo" required>
                          <option selected>Sexo...</option>
                          <option value="f">Femenino</option>
                          <option value="m">Masculino</option>
                          <option value="o">Otro</option>
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

