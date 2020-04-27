@extends('layouts.menu')
@section('contenedor')


<div class=" container">
    <div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item img-scroll active">
                <img class="d-block w-100" src="{{ asset('imagen/imagen001.jpg')}}" alt="First slide">
                <div class="carousel-captions">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Explicabo ipsum non hic fugit quidem incidunt consectetur ratione et id magni.
                </div>
            </div>
            <div class="carousel-item img-scroll">
                <img class="d-block w-100" src="{{ asset('imagen/imagen002.jpg')}}" alt="Second slide">
                <div class="carousel-captions">
                    ddsdsds
                </div>
            </div>
            <div class="carousel-item img-scroll">
                <img class="d-block w-100" src="{{ asset('imagen/imagen003.jpg')}}" alt="Third slide">
                <div class="carousel-captions">
                    ddsdsds
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="row mt-3">
        <div class="col-8">
            <h3 class=" text-info">Borlita <p class="text-muted h6">Mestizo</p></h3>
        </div>
        <div class="col-3">
            <button class=" btn btn-info">Adoptar</button>
        </div>
        <div class=" col-md-8">
            <div class="row">
                <div class="col-2"><p class="text-info">Edad:</p></div>
                <div class="col-10"><p>2 meses 4 dias</p></div>
                <div class="col-2"><p class="text-info">Sexo:</p></div>
                <div class="col-10"><p>Hembra</p></div>
                <div class="col-2"><p class="text-info">Peso:</p></div>
                <div class="col-10"><p>2.3 kl</p></div>
                <div class="col-2"><p class="text-info">Tamaño:</p></div>
                <div class="col-10"><p>mediano</p></div>
                <div class="col-2"><p class="text-info">Refugio:</p></div>
                <div class="col-10"><a href="#" class="text-decoration-none">Refugio patitas callegeras</a></div>
                <div class="col-12"><p class="text-info">Caracteristicas y cuidado:</p></div>
                <div class="col-11"><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, explicabo laboriosam hic soluta quia fugit mollitia adipisci earum, corporis cumque reiciendis animi vitae qui saepe laudantium quasi non neque aspernatur.</p></div>
                <div class="col-12"><p class="text-info">Descripción:</p></div>
                <div class="col-11"><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, explicabo laboriosam hic soluta quia fugit mollitia adipisci earum, corporis cumque reiciendis animi vitae qui saepe laudantium quasi non neque aspernatur.</p></div>

            </div>
        </div>
        <div class=" col-md-4 pl-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item text-info h5">Salud</li>
                <li class="list-group-item"><i class="fas fa-check text-info"></i> Dapibus ac facilisis in</li>
                <li class="list-group-item"><i class="fas fa-check text-info"></i> Morbi leo risus</li>
                <li class="list-group-item"><i class="fas fa-check text-info"></i> Porta ac consectetur ac</li>
                <li class="list-group-item"><i class="fas fa-check text-info"></i> Vestibulum at eros</li>
              </ul>

        </div>

    </div>
</div>
@endsection

