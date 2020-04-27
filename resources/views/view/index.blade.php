@extends('layouts.menu')
@section('contenedor')

<div id="carouselExampleIndicators" class="carousel slide mt-5 " data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item img-scroll active">
            <img src="{{ asset('imagen/imagen003.jpg')}}">
        </div>
        <div class="carousel-item img-scroll">
            <img src="{{ asset('imagen/imagen001.jpg')}}">
        </div>
        <div class="carousel-item img-scroll">
            <img src="{{ asset('imagen/imagen002.jpg')}}">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="text-center mt-5">
    <p class=" h3">Disfruta de lo nuestro!</p>
    <p>
        Todas las empresas registradas en esta pagina ayudan a los refugios de mascotas de Santa Cruz de la Sierra.
    </p>
</div>
<div class=" container">
    <div class=" row">

        <div class=" col-md-6 col-lg-4 col-xl-3">
          <div class="card mb-4 shadow-sm">
            <img src="https://mdbootstrap.com/img/Photos/Others/food.jpg" class="card-img-top img-fluid" alt="sample">
            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>


    </div>
</div>


@endsection

