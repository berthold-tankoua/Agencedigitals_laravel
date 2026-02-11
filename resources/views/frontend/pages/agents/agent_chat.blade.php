@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Dashboard
@endsection

<!-- start main container -->

<section class="ps-vendor-dashboard">
    <!-- Preloader Start -->
    @include('frontend.components.agent_header')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5>Bienvenue dans la messagerie</h5>
                        <p>Sélectionnez un utilisateur pour commencer la conversation.</p>
                    </div>
                    <div class="card-body">
                        <div id="app">
                            <chat-message></chat-message>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- end main container -->
@endsection
