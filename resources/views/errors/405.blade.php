@extends('frontend.main_master')

@section('title')
    AgenceDigitals | ressource non trouvée
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center text-center" style="min-height: 100vh;">
            <div class="col-lg-6">

                <div class="card border-0 shadow-lg rounded-4 p-5">

                    <h1 class="fw-semibold mb-3">
                        Oups !
                    </h1>

                    <p class="text-muted mb-4 h4">
                        Désolé, aucune ressource trouvée .
                    </p>

                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                        <i class="bi bi-house-door me-2"></i> Retour à l'accueil
                    </a>

                </div>

            </div>
        </div>
    </div>
@endsection
