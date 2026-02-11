@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Inscription
@endsection
<style>
    .password_required ul {
        list-style: none;
    }

    .password_required {
        margin-top: 15px;
        display: none;
    }

    .password_required ul li {
        color: red;
    }

    .password_required ul li.active {
        color: green;
    }

    .password_required ul li span:before {
        content: "❌"
    }

    .password_required ul li.active span:before {
        content: "✅";
    }
</style>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="theme-box-shadow rounded-5 theme-bg-white p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <div class="theme-bg-secondary p-3 rounded-circle"><i
                                    class="bi bi-person-plus lh-1 fs-4 theme-text-accent-two"></i></div>

                        </div>
                        <div class="flex-grow-1 ms-3">
                            <span class="fs-4 fw-bold">Créer un compte AgenceDigitals</span>
                            <p class="font-medium mb-0 theme-text-accent-one">
                                Veuillez vous connecter afin d’accéder à vos informations.
                            </p>
                        </div>
                    </div>
                    <div class="col-12">
                        <form class="needs-validation" action="{{ route('user.create') }}" method="POST"
                            autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <div>
                                    <label for="name">Saisir votre nom</label>
                                    <input type="text" class="form-control rounded-pill" id="name"
                                        name="name" placeholder="Saisir votre nom & prenom">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <div>
                                    <label for="email">Saisir votre Email </label>
                                    <input type="email" class="form-control rounded-pill" id="email"
                                        name="email" placeholder="Saisir votre Email ">

                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <div>
                                    <label for="phone">Saisir votre Contact WhatsApp </label>
                                    <input class="form-control rounded-pill" type="tel" id="phone"
                                        name="phone" placeholder="Saisir votre Contact WhatsApp ">

                                    <span class="text-danger">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <input type="hidden" name="user_phone" id="user_phone">
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <div class="postion-relative">
                                    <label for="password">Saisir votre mot de passe</label>
                                    <input type="password" class="form-control rounded-pill" id="password"
                                        name="password" placeholder="Saisir votre mot de passe">
                                    <i class="fas fa-eye position-absolute" onclick="showpassword()"
                                        title="Afficher le mot de passe"
                                        style="cursor: pointer;right:20px;top:35px"></i>
                                </div>
                                <div class="password_required">
                                    <ul>
                                        <li class="lowercase"><span></span> Le mot de passe doit contenir des lettres
                                            Miniscules</li>
                                        <li class="capital"><span></span> Le mot de passe doit contenir une lettre
                                            Majiscule</li>
                                        <li class="number"><span></span> Le mot de passe doit contenir un Chiffre</li>
                                        <li class="special"><span></span> Le mot de passe doit contenir un caractere
                                            special (@)</li>
                                        <li class="character"><span></span> Le mot de passe doit contenir au moins 5
                                            caracteres</li>
                                    </ul>
                                </div>
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheckMain" value="1"
                                    required
                                    oninvalid="this.setCustomValidity('Accepter les termes de confidentialites')"
                                    oninput="this.setCustomValidity('')">
                                <label class="form-check-label font-small" for="exampleCheckMain">
                                    En cliquant sur s’inscrire, je comprends et j’accepte les
                                    <a href="{{ url('/termes-conditions') }}">Conditions générales</a> et la
                                    <a href="{{ url('/termes-conditions') }}">Politique de confidentialité</a> .
                                </label>
                            </div>
                            <div class="mb-3 custom-button">
                                <button type="submit" class="rounded-pill custom-btn-primary  button-effect px-4 h5">Je
                                    m’inscris</button><br>
                            </div>
                            <span class="font-medium">
                                <span class="mx-3">Vous avez deja un compte.?</span>
                                <a href="{{ url('/user/login') }}" class="">Se connecter</a>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showpassword() {
        var x = document.getElementById("password");
        var y = document.getElementById("cpassword");
        if (x.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }
    $('#password').on('focus', function() {
        $('.password_required').slideDown()
    })
    $('#password').on('blur', function() {
        $('.password_required').slideUp()
    })
    $('#password').on('keyup', function() {
        passvalue = $(this).val();
        if (passvalue.match(/[a-z]/g)) {
            $('.lowercase').addClass('active');
        } else {
            $('.lowercase').removeClass('active');
        }
        if (passvalue.match(/[A-Z]/g)) {
            $('.capital').addClass('active');
        } else {
            $('.capital').removeClass('active');
        }
        if (passvalue.match(/[0-9]/g)) {
            $('.number').addClass('active');
        } else {
            $('.number').removeClass('active');
        }
        if (passvalue.match(/[!@#$%&^*]/g)) {
            $('.special').addClass('active');
        } else {
            $('.special').removeClass('active');
        }
        if (passvalue.length == 5 || passvalue.length > 5) {
            $('.character').addClass('active');
        } else {
            $('.character').removeClass('active');
        }
    })
</script>
@endsection
