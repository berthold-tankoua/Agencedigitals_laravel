<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('frontend/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('frontend/logo.png') }}" type="image/x-icon">
    <title>Admin | Connexion</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/') }}../assets/css/font-awesome.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/font-awesome.css') }}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/vendor_components/bootstrap/dist/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/style2.css') }}">
    {{-- <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen"> --}}
    <link id="color" rel="stylesheet" href="{{ asset('backend/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <style>
        .toast {
            background-color: #030303 !important;
        }

        .toast-info {
            background-color: #3276b1 !important;
        }

        .toast-info2 {
            background-color: #2f96b4 !important;
        }

        .toast-error {
            background-color: #bd362f !important;
        }

        .toast-success {
            background-color: #51a351 !important;
        }

        .toast-warning {
            background-color: #f89406 !important;
        }
    </style>
    <style>
        @media (max-width: 768px) {
            .user_login-img {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-7 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo text-start" href="index.html">
                                <h1 style="color:black">AgenceDigitals <span style="color: rgb(252, 184, 0);">Connexion
                                        </p>
                                </h1>
                            </a></div>
                        <div class="login-main">

                            <form action="{{ route('admin.check') }}" method="POST" class="theme-form">

                                @if (session('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session('fail') }}
                                    </div>
                                @endif

                                @csrf

                                <h4 style="text-align: center;">Se connecter a votre compte</h4>
                                <p style="text-align: center;">Entrer votre Email & Mot de passe</p>

                                <div class="form-group">
                                    <label class="col-form-label">Addresse Email </label>
                                    <input class="form-control" type="email" name="email" required=""
                                        placeholder="Test@gmail.com">

                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Mot de passe</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" id="password" type="password" name="password"
                                            required="" placeholder="*********">
                                        <div class="show-hide" onclick="showpassword()" style="cursor: pointer;">
                                            Afficher</div>
                                    </div>
                                    <span class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group mb-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="checkbox p-0">
                                            <input id="checkbox1" type="checkbox" id="remember_me" name="remember_me"
                                                value="remember_me">
                                            <label class="text-muted" for="checkbox1">Se souvenir de moi</label>
                                        </div>
                                        <div class="checkbox p-0">
                                            <a href="{{ route('admin.forget-password') }}">Mot de passe oublié.?</a>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block w-100" type="submit"
                                        style="background: #fcb800 !important; border: 1px solid #fcb800 !important; ">Se
                                        Connecter</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {{ asset('backend/') }} --}}
        <!-- latest jquery-->
        <script src="{{ asset('backend/../assets/jquery-3.5.1.min.js') }}"></script>
        <!-- Bootstrap js-->
        <script src="{{ asset('backend/vendor_components/bootstrap/dist/js/bootstrap.css') }}"></script>
        <!-- scrollbar js-->
        <!-- Sidebar jquery-->
        <script src="{{ asset('backend/../assets/config.js') }}"></script>
        <!-- Plugins JS start-->
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="{{ asset('backend/../assets/script.js') }}"></script>
        <!-- login js-->
        <!-- Plugin used-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            @if (Session::has('message'))

                var type = "{{ Session::get('alert-type', 'info') }}";
                switch (type) {
                    case 'info':
                        toastr.info(" {{ Session::get('message') }} ")
                        break;

                    case 'success':
                        toastr.success(" {{ Session::get('message') }} ")
                        break;

                    case 'warning':
                        toastr.warning(" {{ Session::get('message') }} ")
                        break;

                    case 'error':
                        toastr.error(" {{ Session::get('message') }} ")
                        break;
                }
            @endif
        </script>

    </div>
</body>
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

</html>
