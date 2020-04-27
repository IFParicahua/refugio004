@extends('layouts.menu')
@section('contenedor')
<div class=" container mt-5 pt-5">
    <div class="row">
        <div class="col-6 col-lg-4 col-xl-3">
            <div class="card mb-4 shadow-sm" >
                <a href="{{ url('/refugios/id') }}">
                    <img class=" card-img-ref" src="https://www.cssscript.com/demo/justified-flow-gallery/img/erik-jan-leusink-O7ePLfRRlBs-unsplash.jpg" alt="Card image cap">
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
