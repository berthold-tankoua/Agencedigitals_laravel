@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Hors Connexion
@endsection
<style>
    .error-page {
        min-height: 75vh;
        background: linear-gradient(45deg, #0d6efd 0%, #0dcaf0 100%);
    }

    .error-container {
        max-width: 800px;
    }

    .error-code {
        font-size: 12rem;
        font-weight: 900;
        background: linear-gradient(to right, #fff, rgba(255, 255, 255, 0.5));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: pulse 2s infinite;
    }

    .error-message {
        color: rgba(255, 255, 255, 0.9);
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .btn-glass {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        transition: all 0.3s ease;
    }

    .btn-glass:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
    }
</style>
<div class="error-page d-flex align-items-center justify-content-center">
    <div class="error-container text-center p-4">
        <h1 class="error-code mb-2" style="font-size:55px">ERREUR</h1><br>

        <p class="lead error-message mb-5">Vérifiez votre connexion Internet OU Page introuvable.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('/') }}" class="btn btn-glass px-4 py-2">Page d’accueil</a>
            <button onclick="reloadPage()"class="btn btn-glass px-4 py-2">Actualiser</button>
        </div>
    </div>
</div>
<!-- End #main -->
@endsection
