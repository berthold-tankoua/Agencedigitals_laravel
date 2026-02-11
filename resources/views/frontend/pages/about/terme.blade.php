@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Termes & Conditions
@endsection
<!--=====================================
Breadcrumbs
======================================-->
<div>
    <ul class="breadcrumbs mb-4">
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li>A propos</li>
        </li>
        <li>Termes & Conditions</li>
    </ul>
</div>
<!-- privacy section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                {!! $about->term_condition !!}
            </div>
        </div>
    </div>
</section>
@endsection
