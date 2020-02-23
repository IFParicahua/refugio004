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
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class=" form-group">
                    <input type="text" name="" id="" class=" form-control" placeholder="Nombre">
                </div>
                <div class=" form-group">
                    <input type="text" name="" id="" class=" form-control" placeholder="Apellidos">
                </div>
                <div class="form-group">
                    <input type="text" name="" id="" class=" form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="" id="" class=" form-control" placeholder="Contraseña">
                </div>
                <div class="form-group">
                    <input type="text" name="" id="" class=" form-control" placeholder="Dirección">
                </div>
                <div class="row">
                    <div class=" form-group col-6">
                        <input type="text" name="" id="" class=" form-control" placeholder="CI">
                    </div>
                    <div class=" form-group col-6">
                        <input type="text" name="" id="" class=" form-control" placeholder="Telefono">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <input type="date" name="" id="" class=" form-control" placeholder="Nadido en">
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
