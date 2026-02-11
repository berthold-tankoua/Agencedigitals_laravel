@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Dashboard
@endsection
<div class="ps-breadcrumb">

    <div class="container">

        <ul class="breadcrumb">

            <li><a href="{{ url('/') }}">Acceuil</a></li>

            <li>Agent</li>
            <li>Dashboard</li>

        </ul>

    </div>

</div>
<!-- start main container -->
<main class="bg-light">
    <section class="ps-vendor-dashboard">

        <!-- Preloader Start -->
        @include('frontend.components.agent_header')

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <p style="background-color: red;padding:8px;color:white;font-size:22px">Votre Compte Agent est
                        Inactive...! </p><br>

                    <a href="{{ url('/user/subscription/view') }}" style="color:black;cursor:pointer;">Renouveler son
                        Abonnement</a>


                </div>
            </div>
        </div>
    </section>
</main>
<!-- end main container -->
@endsection
