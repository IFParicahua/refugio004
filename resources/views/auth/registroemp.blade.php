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
            <form action="{{ route('register') }}" method="post">
                @csrf
                <h5 class=" text-center">Empresa</h5>
                <div class=" form-group">
                    <input type="text" name="" id="" class=" form-control" placeholder="Razón Social">
                </div>
                <div class="form-group">
                    <input type="text" name="" id="" class=" form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="" id="" class=" form-control" placeholder="Contraseña">
                </div>
                <div class="form-group">
                    <input type="text" name="" id="" class=" form-control" placeholder="Dirección de la Empresa">
                </div>
                <div class="row">
                    <div class=" form-group col-6">
                        <input type="text" name="" id="" class=" form-control" placeholder="Sigla">
                    </div>
                    <div class=" form-group col-6">
                        <input type="text" name="" id="" class=" form-control" placeholder="NIT">
                    </div>
                </div>
                <h5 class=" text-center">Representante</h5>
                <div class="form-group"><input type="text" name="" id="" class="form-control" placeholder="Nombre"></div>
                <div class="form-group"><input type="text" name="" id="" class="form-control" placeholder="Apellido"></div>
                <div class="form-group"><input type="text" name="" id="" class="form-control" placeholder="Dirección Personal"></div>
                <div class="row">
                    <div class="form-group col-6"><input type="text" name="" id="" class="form-control" placeholder="CI"></div>
                    <div class="form-group col-6"><input type="text" name="" id="" class="form-control" placeholder="Teléfono"></div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <input type="date" name="" id="" class=" form-control">
                        <small>Fecha de Nacimiento</small>
                    </div>
                    <div class="form-group col-6">
                        <select class="custom-select" name="sexo" id="sexo">
                            <option selected>Sexo...</option>
                            <option value="f">Femenino</option>
                            <option value="m">Masculino</option>
                            <option value="o">Otro</option>
                          </select>
                    </div>
                </div>
                <button type="submit" class="btn-lg btn text-white mx-auto btn-block col-9" style="border-radius:60px; background: #b28dff">Registrarse</button>
            </form>
        </div>
    </div>

</div>
@endsection

