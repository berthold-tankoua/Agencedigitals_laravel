<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="author" content="Brecht">
    <meta name="keywords"
        content="AgenceDigitals, agent digital freelance, création site web, refonte site web, agents IA, automatisation, marketing digital, vente formations en ligne, solutions digitales, visibilité en ligne, accompagnement digital">
    <meta name="description"
        content="AgenceDigitals, votre partenaire digital freelance. Je vous accompagne dans la création et la modernisation de sites web, l’automatisation avec agents IA, le marketing digital et la vente de formations en ligne.">

    <meta name="robots" content="index, follow" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="AgenceDigitals | votre partenaire digital pour réussir en ligne">
    <meta property="og:description"
        content="Découvrez comment AgenceDigitals peut vous aider à créer des sites web modernes, automatiser vos processus avec des agents intelligents, améliorer votre visibilité en ligne et vendre vos formations digitales.">
    <meta property="og:image" content="{{ asset('frontend/img/og-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="AgenceDigitals - Création web, IA, automatisation & formations digitales">
    <meta name="twitter:description"
        content="AgenceDigitals vous accompagne dans vos projets digitaux : sites web, agents IA, automatisation, marketing et vente de formations en ligne pour développer votre activité efficacement.">
    <meta name="twitter:image" content="{{ asset('frontend/img/og-image.jpg') }}">


    <!-- Favicons -->
    <link href="{{ asset('frontend/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('frontend/img/favicon.png') }}" rel="apple-touch-icon">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('frontend/img/favicon.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- ✅ Fonts optimisées avec display=swap -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- CSS Files
    ================================================== -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="{{ asset('frontend/css/vendors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/coloring.css') }}" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="{{ asset('frontend/css/colors/scheme-01.css') }}" rel="stylesheet" type="text/css">

    <!-- ✅ CSS non critiques en preload async -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@22.0.2/build/css/intlTelInput.css">

</head>

<body>
    <div id="wrapper">
        <a href="#" id="back-to-top"></a>

        <!-- header begin -->

        @include('frontend.components.header')
        <!-- End Main Header -->

        <!-- Master Main -->
        @yield('content')
        <!-- End Master Main -->

        @include('frontend.components.connection_check')


        <!-- footer -->
        @include('frontend.components.footer')

        <!-- footer close -->
    </div>

    <!-- overlay content begin -->
    <div id="extra-wrap">
        <div id="btn-close">
            <span></span>
            <span></span>
        </div>

        <div id="extra-content">

            <div class="spacer-30-line"></div>

            <h5 class="mb-3"> Services</h5>

            <ul class="ul-check">
                @php
                    $services = App\Models\Service::orderBy('service_name_fr', 'ASC')->get();
                @endphp

                @foreach ($services as $service)
                    <li><a href="{{ url('service/details/' . $service->id . '/' . $service->service_slug_fr) }}">
                            {{ $service->service_name_fr }}</a>
                    </li>
                @endforeach

            </ul>


            <div class="spacer-30-line"></div>

            <h5>Contact Us</h5>
            <div><i class="icofont-clock-time me-2"></i>Lundi - Vendredi | 08:00 H - 18:00 H</div>
            <div><i class="icofont-location-pin me-2"></i>Ajax, Ontario, Canada </div>
            <div><i class="icofont-envelope me-2"></i>contact@agencedigitals.com</div>

            <div class="spacer-30-line"></div>

            <h5>A propos</h5>
            <p>Unlock the full potential of your online presence with Seoly, where innovation meets optimization. In
                today's digital landscape, visibility is paramount, and our tailored SEO solutions are crafted to ensure
                your brand shines brightly amidst the competition.</p>

            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
    <!-- overlay content end -->


    <!-- Javascript Files
    ================================================== -->
    <script src="{{ asset('frontend/js/vendors.js') }}"></script>
    <script src="{{ asset('frontend/js/designesia.js') }}"></script>
    <script src="{{ asset('frontend/js/custom-marquee.js') }}"></script>

    <!-- JS CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@22.0.2/build/js/intlTelInput.min.js"></script>
    <!-- TOAST MSG  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- PWA  -->
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function(reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>

    <script>
        let bipEvent = null;
        window.addEventListener("beforeinstallprompt", event => {
            event.preventDefault();
            bipEvent = event;
        })

        document.querySelector("#btnInstall").addEventListener("click", event => {
            if (bipEvent) {
                bipEvent.prompt();
            } else {
                // incompatible browser, your PWA is not passing the criteria, the user has already installed the PWA
                //TODO: show the user information on how to install the app
                alert(
                    "Pour installer l'application, recherchez Ajouter à l'écran d'accueil ou Installer dans le menu de votre navigateur."
                );
            }
        })

        function installPwa() {
            if (bipEvent) {
                bipEvent.prompt();
            } else {
                alert(
                    "Pour installer l'application, recherchez Ajouter à l'écran d'accueil ou Installer dans le menu de votre navigateur."
                );
            }
        }
    </script>
    <!-- Geolocalisation -->
    <script>
        function getLocation() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        console.log("Latitude :", latitude);
                        console.log("Longitude :", longitude);

                        // Tu peux ensuite envoyer ces infos à ton backend ou afficher sur une carte
                    },
                    function(error) {
                        console.error("Erreur de géolocalisation :", error.message);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    }
                );
            } else {
                alert("La géolocalisation n’est pas supportée par votre navigateur.");
            }
        }
    </script>

    <!-- Notification Push -->
    <script>
        function notificationPush() {
            // Vérifions si le navigateur prend en charge les notifications
            if (!("Notification" in window)) {
                console.log("Ce navigateur ne prend pas en charge la notification de bureau");
            } else {
                console.log("Ce navigateur prend  en charge la notification de bureau");
            }
            if (Notification.permission !== "denied") {
                Notification.requestPermission().then((permission) => {
                    // Si l'utilisateur accepte, créons une notification
                    if (permission === "granted") {
                        console.log('access autorise');
                        navigator.serviceWorker.ready.then((sw) => {
                            sw.pushManager.subscribe({
                                userVisibleOnly: true,
                                applicationServerKey: "BLjvdpMnqRjyg1U34Z3aRoPeRZQZ1NgZhYVeRxub-_Gs-1YDC1Q0u90fNBIMdOv0XQdoNmLZ5Ptnmhn6So5LEX8"
                            }).then((subscription) => {
                                console.log('push inscription reusi')
                                fetch("api/push-subscribe", {
                                    method: "post",
                                    body: JSON.stringify(subscription)
                                });
                            })
                        })
                    } else {
                        console.log('access refuse');
                    }
                });
            }
        }

        notificationPush();
    </script>

    <script>
        const defaultLang = "fr"; // langue de base du site

        // Charger Google Translate
        function loadGoogleTranslate() {
            const script = document.createElement("script");
            script.src = "//translate.google.com/translate_a/element.js?cb=initGoogleTranslate";
            document.head.appendChild(script);
        }

        // Initialiser le widget
        function initGoogleTranslate() {
            new google.translate.TranslateElement({
                pageLanguage: defaultLang,
                includedLanguages: "fr,en",
                autoDisplay: false
            }, "google_translate_element");
        }

        // Définir cookie Google Translate
        function setLanguage(lang) {
            const value = `/fr/${lang}`;

            // Définir le cookie standard
            document.cookie = `googtrans=${value}; path=/`;

            // Facultatif : ajouter le cookie avec le domaine (utile si sous-domaine)
            const hostname = window.location.hostname;

            // S'assurer que ce n’est pas localhost
            if (!hostname.includes("localhost") && hostname.split('.').length >= 2) {
                const rootDomain = '.' + hostname.split('.').slice(-2).join('.');
                document.cookie = `googtrans=${value}; path=/; domain=${rootDomain}`;
            }

            location.reload();
        }

        // Écoute sur les boutons
        $(document).ready(function() {
            loadGoogleTranslate();

            $("[data-lang]").on("click", function() {
                const selectedLang = $(this).attr("data-lang");
                setLanguage(selectedLang);
            });
        });
    </script>

    <script>
        // Supprime les éléments dans les iframes Google après chargement
        function hideGoogleTranslateBar() {
            const interval = setInterval(() => {
                const bannerFrame = document.querySelector("iframe.goog-te-banner-frame");
                const menuFrame = document.querySelector("iframe.goog-te-menu-frame");

                if (bannerFrame) bannerFrame.style.display = "none";
                if (menuFrame) menuFrame.style.display = "none";

                // Supprime le margin ajouté au body par Google
                if (document.body.style.top) {
                    document.body.style.top = "0px";
                }
            }, 500); // Réessaye toutes les 500ms

            // Stoppe l'intervalle après 10 secondes
            setTimeout(() => clearInterval(interval), 10000);
        }

        document.addEventListener("DOMContentLoaded", hideGoogleTranslateBar);
    </script>

    <!-- Tosat Alert -->
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

</body>

</html>
