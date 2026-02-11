@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Verification de l'email
@endsection
<!-- signin section -->
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <!-- forgot password section -->
                <div class="theme-box-shadow rounded-5 theme-bg-white p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <div class="theme-bg-accent-two p-3 rounded-circle"><i class="bi bi-lock-fill lh-1 fs-4"></i>
                            </div>

                        </div>
                        <div class="flex-grow-1 ms-3">
                            <span class="fs-4 fw-bold">Verification de l'email</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <form action="{{ route('user.two.factor.check') }}" method="POST" class="needs-validation"
                            novalidate>
                            @if (session('fail'))
                                <div class="alert alert-danger">
                                    {{ Session('fail') }}
                                </div>
                            @endif
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Saisir votre Email">
                                <label for="email">Saisir votre Email</label>
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="custom-button">
                                <button type="submit"
                                    class="rounded-pill custom-btn-primary font-small button-effect px-4">Envoyer le
                                    code par Email</button>
                            </div>
                        </form>
                        <br><a class="float-left" title="Revenir en arriere" href="{{ route('user.login') }}">Retour à
                            la page précédente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
