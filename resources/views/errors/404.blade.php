@extends('frontend.main_master')

@section('title')
    AgenceDigitals | Page non trouvée
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center text-center" style="min-height: 100vh;">
            <div class="col-lg-6">

                <div class="card border-0 shadow-lg rounded-4 p-5">

                    <h1 class="display-1 fw-bold text-primary">404</h1>

                    <h4 class="fw-semibold mb-3">
                        Oups ! Page introuvable
                    </h4>

                    <p class="text-muted mb-4">
                        Désolé, la page que vous recherchez n'existe pas .
                    </p>

                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                        <i class="bi bi-house-door me-2"></i> Retour à l'accueil
                    </a>

                </div>

            </div>
        </div>
    </div>
@endsection
