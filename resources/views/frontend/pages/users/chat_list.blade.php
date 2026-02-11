@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Messagerie
@endsection

<!-- start main container -->

<section class="ps-vendor-dashboard"><br>
    <!-- Preloader Start -->
    <div class="text-primary text-underline " style="margin-left: 25px;">
        <a href="{{ url()->previous() }}" class="m body-1 text-primary text-underline"><i
                class="fas fa-chevron-circle-left"></i> Revenir en Arriere</a>
    </div>
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
