@extends('layouts.menu')
@section('contenedor')
<div class=" container" style="margin-top: 90px;">

    <div class=" row">

        <div class=" col-md-6 col-lg-4 col-xl-3">
          <div class="card mb-4 shadow-sm" >
            <img src="https://www.elmundodelgato.com/fotos/78/Sin_tA_tulo-3_thumb_380.jpg" class="card-img-top img-fluid" lt="sample">
            <div class="card-body p-2">
                <a href="{{ url('/adopciones/id') }}" class="text-decoration-none"><p class="m-0 h5"><strong>Panquesito</strong> <i class="fas fa-venus text-primary"></i> <i class="fas fa-mars  text-primary"></i></p></a>
            </div>
          </div>
        </div>


    </div>



</div>
@endsection
