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
<div class=" container imagen-body">
    <div class="row justify-content-center ">
        <div class=" col-12  col-md-5 mx-auto" >
            <h2 class=" text-center">Registro</h2>
            <br>
            <form action="{{url('activista/create')}}" method="POST">
                @csrf
                <div class=" form-group">
                    <input type="text" name="txtnombre" id="txtnombre" class=" form-control @error('txtnombre') is-invalid @enderror" placeholder="Nombre" required maxlength="255" value="{{ old('txtnombre') }}">
                    @error('txtnombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class=" form-group">
                    <input type="text" name="txtapellido" id="txtapellido" class=" form-control @error('txtapellido') is-invalid @enderror" placeholder="Apellidos" required maxlength="255" value="{{ old('txtapellido') }}">
                    @error('txtapellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" name="txtemail" id="txtemail" class=" form-control @error('txtemail') is-invalid @enderror" placeholder="Email" required maxlength="255" value="{{ old('txtemail') }}">
                    @error('txtemail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="txtpassword" id="txtpassword" class=" form-control @error('txtpassword') is-invalid @enderror" placeholder="Contraseña" required minlength="8" value="{{ old('txtpassword') }}">
                    @error('txtpassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="txtdireccion" id="txtdireccion" class=" form-control @error('txtdireccion') is-invalid @enderror" placeholder="Dirección" required maxlength="500" value="{{ old('txtdireccion') }}">
                    @error('txtdireccion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class=" form-group col-6">
                        <input type="text" name="txtci" id="txtci" class=" form-control @error('txtci') is-invalid @enderror" placeholder="CI" required value="{{ old('txtci') }}">
                        @error('txtci')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class=" form-group col-6">
                        <input type="text" name="txtelefono" id="txtelefono" class=" form-control @error('txtelefono') is-invalid @enderror" placeholder="Telefono" required value="{{ old('txtelefono') }}">
                        @error('txtelefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <input type="date" name="txtnacimiento" id="txtnacimiento" class=" form-control @error('txtnacimiento') is-invalid @enderror" placeholder="Nadido en" required value="{{ old('txtnacimiento') }}">
                        <small>Fecha de Nacimiento</small>
                        @error('txtnacimiento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <select class="custom-select  @error('txtsexo') is-invalid @enderror" name="txtsexo" id="txtsexo" value="{{ old('txtsexo') }}">
                          <option value="">Sexo...</option>
                          <option value="f" {{ old('txtsexo') ==  'Femenino' ? 'selected' : '' }}>Femenino</option>
                          <option value="m" {{ old('txtsexo') ==  'Masculino' ? 'selected' : '' }}>Masculino</option>
                          <option value="o" {{ old('txtsexo') ==  'Otro' ? 'selected' : '' }}>Otro</option>
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
