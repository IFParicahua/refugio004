@extends('layouts.menu')

@section('contenedor')
<div class=" container mt-0 mb-0 pt-0 pb-0 mt-md-5 mb-md-5 pt-md-5 pb-md-5">
    <div class="card-deck mb-3 text-center">
        <div class="card mb-3" >
            <div class="row no-gutters">
              <div class="col-4 col-md-12">
                <img src="{{ asset('imagen/18771.jpg')}}" class="card-img-top h-100" style="object-fit: cover">
              </div>
              <div class="col-8 col-md-12">
                <div class="card-body">
                  <h5 class="card-title">Empresa</h5>
                <p class="card-text">Todas las empresas sin importar el rubro pueden registrarse aquí.</p>
                <a href="{{ url('registro-empresa') }}" class="btn btn-primary btn-sm">Registrar</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-3" >
            <div class="row no-gutters">
              <div class="col-4 col-md-12">
                <img src="{{ asset('imagen/21260.jpg')}}" class="card-img-top h-100" style="object-fit: cover">
              </div>
              <div class="col-8 col-md-12">
                <div class="card-body">
                  <h5 class="card-title">Refugio</h5>
                <p class="card-text">Todos los refugios de mascotas pueden registrarse aquí.</p>
                <a href="{{ url('registro-refugio') }}" class="btn btn-primary btn-sm">Registrar</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-3" >
            <div class="row no-gutters">
              <div class="col-4 col-md-12">
                <img src="{{ asset('imagen/30388.jpg')}}" class="card-img-top h-100" style="object-fit: cover">
              </div>
              <div class="col-8 col-md-12">
                <div class="card-body">
                  <h5 class="card-title">Activista.</h5>
                <p class="card-text">Si amas a los animales y no perteneces a un refugio o empresa registrate aquí.</p>
                <a href="{{ url('registro-activista') }}" class="btn btn-primary btn-sm">Registrar</a>
                </div>
              </div>
            </div>
          </div>
    </div>

</div>

@endsection
