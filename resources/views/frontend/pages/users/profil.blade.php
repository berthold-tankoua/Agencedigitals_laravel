@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Dashboard
@endsection
<!--=====================================
Breadcrumbs
======================================-->
<div>
    <ul class="breadcrumbs mb-4">
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
        <li>Mon profil</li>
    </ul>
</div>
<!-- my account -->
<div class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <!-- dashboard content section -->
            <form method="post" action="{{ route('user.update.profil') }}" class="col-12 col-md-9">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <div class="d-flex align-self-center align-items-center">
                    <p class="fs-1 mb-3 theme-text-secondary">Mon Profil</p>
                </div>

                <!-- profile information section -->
                <div class="theme-box-shadow theme-border-radius theme-bg-white mb-3">
                    <div class="row g-0">
                        <div class="col-12 col-md-12">
                            <div class="d-flex justify-content-between align-items-center border-bottom p-3">
                                <div class="mb-0">
                                    <span class="d-flex fw-bold">Profile</span>
                                    <span class="theme-text-accent-one font-small">Information Basique
                                    </span>
                                </div>
                                <p class="border border-secondary rounded-pill py-2 px-3 theme-text-accent-one"><i
                                        class="bi bi-pencil me-2"></i>Edition</p>
                            </div>
                        </div>
                    </div>
                    <!-- information section -->
                    <div class="row g-0 px-3 ">
                        <div class="col-12 border-bottom py-3">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <span class="font-medium text-uppercase theme-text-accent-one">Nom & Prenom</span>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 border-bottom py-3">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <span class="font-medium text-uppercase theme-text-accent-one">Telephone</span>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- login information section -->
                <div class="theme-box-shadow theme-border-radius theme-bg-white mb-3" id="details">
                    <div class="row g-0">
                        <div class="col-12 col-md-12">
                            <div class="d-flex justify-content-between align-items-center border-bottom p-3">
                                <div class="mb-0">
                                    <span class="d-flex fw-bold">Connexion Details</span>
                                    <span class="theme-text-accent-one font-small">Email & mot de passe
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- login details -->
                    <div class="row g-0 px-3 ">

                        <div class="col-12 border-bottom py-3">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <span class="font-medium text-uppercase theme-text-accent-one">Email
                                    </span>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="email" class="form-control" name="email"
                                        value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-3">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <span class="font-medium text-uppercase theme-text-accent-one">Mot de passe</span>
                                </div>
                                <div class="col-12 col-md-9 d-flex align-items-center ">
                                    <span class="font-medium ">**********</span>
                                    <a class="ms-3" href="{{ route('user.forget-password') }}">Modifier mon mot de
                                        passe</a>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row mt-3 mb-4">

                            <div class="col-12 col-md-8">
                                <input class="btn btn-primary" type="submit" class="form-control"
                                    value="Mettre a jour le compte">
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
@endsection
