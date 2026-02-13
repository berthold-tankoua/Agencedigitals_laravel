        <footer class="footer-light">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-4 col-sm-6">
                        <h5>À propos</h5>

                        <p>{!! $about->desc1 !!}</p>

                        <div class="social-icons mb-sm-30">
                            <a href="{{ $about->facebook_link }}"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="{{ $about->instagram_link }}"><i class="fa-brands fa-instagram"></i></a>
                            <a href="{{ $about->linkedin_link }}"><i class="fa-brands fa-x-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 order-lg-1 order-sm-2">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    <h5>Liens utiles</h5>
                                    <ul>
                                        <li><a href="{{ url('/') }}">Accueil</a></li>
                                        <li><a href="{{ url('/service/list') }}">Services</a></li>

                                        <li><a href="{{ url('/about') }}">A propos</a></li>
                                        <li><a href="{{ url('/formation/list') }}">Formations</a></li>
                                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    <h5>Nos services</h5>
                                    <ul>
                                        @php
                                            $categories = App\Models\Category::orderBy(
                                                'category_name_fr',
                                                'ASC',
                                            )->get();
                                        @endphp
                                        <ul>
                                            @foreach ($categories as $category)
                                                <li><a
                                                        href="{{ url('service/category/' . $category->id . '/' . $category->category_slug_fr) }}">{{ $category->category_name_fr }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 order-lg-2 order-sm-1">
                        <div class="widget">
                            <div class="fw-bold text-dark"><i class="icofont-location-pin me-2 id-color"></i>
                                Localisation</div>
                            {{ $about->localisation }}

                            <div class="spacer-20"></div>

                            <div class="fw-bold text-dark"><i class="icofont-envelope me-2 id-color"></i>Envoyer un
                                message</div>
                            {{ $about->email }}

                            <div class="spacer-20"></div>

                            <div class="fw-bold text-dark"><i class="icofont-envelope me-2 id-color"></i>Appeler
                                le</div>
                            {{ $about->phone }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="de-flex">
                                <div class="de-flex-col">
                                    Copyright 2025 - AgenceDigitals by Brecht Tankoua
                                </div>
                                <ul class="menu-simple">
                                    <li><a href="#">Termes & Conditions</a></li>
                                    <li><a href="#">Politique de Confidentialité</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
