@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Connexion
@endsection

<!-- signin section -->
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="theme-box-shadow rounded-5 theme-bg-white p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <div class="theme-bg-secondary p-3 rounded-circle">
                                <i class="bi bi-unlock lh-1 fs-4 theme-text-accent-two"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <span class="fs-4 fw-bold">Se connecter</span>
                            <p class="font-medium mb-0 theme-text-accent-one">Saisir votre email & mot de passe pour
                                vous connecter
                            </p>
                        </div>
                    </div>
                    <div class="col-12">
                        <form class="needs-validation" action="{{ route('user.two.factor.check') }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-center">
                                @if (session('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session('fail') }}
                                    </div>
                                @endif
                            </div>
                            <br>
                            <div class="form-floating mb-4">
                                <input type="email" id="email" name="email" class="form-control rounded-pill"
                                    id="exampleInputEmailAdd" placeholder="Enter Your Email" required>
                                <label class="form-label">Saisir votre Email</label>

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
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" checked value="true"
                                        name="Remember_me" id="Remember_me">
                                    <label class="form-check-label" for="Remember_me">Se souvenir de moi</label>
                                </div>
                                <a href="{{ route('user.forget-password') }}" class="font-small">Mot passe oublie.?</a>
                            </div>
                            <div class="mb-3 custom-button">
                                <div id="loginNotif" class="d-flex align-items-center "
                                    style="display: none !important">
                                    <div class="d-flex align-items-center">
                                        <div class="spinner-border text-primary me-2" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <p class="ml-2" style="margin-top: 4px">Votre email de confirmation est en
                                            cours d’envoi...</p>
                                    </div>
                                </div><br>
                                <button type="submit" id="loginSubmit"
                                    class="rounded-pill custom-btn-primary h4 button-effect px-4">Se connecter</button>
                                <span class="font-medium">
                                    <span class="mx-3 text-uppercase">ou</span>
                                    <a href="{{ url('/user/register') }}" class="ps-1">Creer un compte</a>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 text-center">
                        <span class="login-app-title">Ou continuer avec</span>
                        <ul class="login-app" onclick="NotAvailable()">
                            <li><a href="#" class="fb" title="google"></a></li>
                            <li><a href="#" class="go" title="Facebook"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- login page -->
        </div>
    </div>
</div>
<script>
    $('#loginForm').on('submit', function() {
        $('#loginNotif').show();
        document.getElementById('loginNotif').style.display = 'block !important';
        $('#loginSubmit').hide();
    });

    function showpassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection
