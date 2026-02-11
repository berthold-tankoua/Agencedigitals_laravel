@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Mention Legale
@endsection
@php
    $about = App\Models\About::findOrFail(1);
@endphp
<!--=====================================
Breadcrumbs
======================================-->
<div>
    <ul class="breadcrumbs mb-4">
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li>A propos</li>
        </li>
        <li>Mention Legale</li>
    </ul>
</div>
<!-- privacy section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                {!! $about->legal_mention !!}
            </div>
        </div>
    </div>
</section>
@endsection
