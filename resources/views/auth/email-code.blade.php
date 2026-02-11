@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Verification de votre Email
@endsection
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <!-- travel insurance section -->
                <div class="theme-box-shadow rounded-5 theme-bg-white p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <div class="theme-bg-secondary p-3 rounded-circle"><i
                                    class="bi bi-person-bounding-box lh-1 fs-4 theme-text-accent-two"></i></div>

                        </div>
                        <div class="flex-grow-1 ms-3">
                            <span class="fs-4 fw-bold">Verification de votre Email</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <form action="{{ route('user.email.verify') }}" method="POST" class="needs-validation"
                            novalidate>

                            @if (session('fail'))
                                <div class="alert alert-danger">
                                    {{ Session('fail') }}
                                </div>
                            @endif

                            @csrf

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control rounded-pill" id="code" name="email_code"
                                    required="Saisir votre Code" placeholder="Saisir le Code recu par E-mail"
                                    placeholder="Saisir le code recu">
                                <label for="code">Saisir le code recu</label>
                                <span class="text-danger">
                                    @error('email_code')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <a class="mb-2" href="{{ route('user.view-resend-code') }}">Renvoyer le code</a>

                            <div class="custom-button">
                                <button type="submit"
                                    class="rounded-pill custom-btn-primary font-small button-effect px-4">Valider</button>

                            </div>
                        </form>
                        <br><a class="float-left" title="Revenir en arriere"
                            href="{{ route('user.forget-password') }}">Retour à la page précédente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
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
