@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Tous nos Articles
@endsection

<!--=====================================
Breadcrumbs
======================================-->
<div>
    <ul class="breadcrumbs mb-4">
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li>AgenceDigitals</li>
        <li>Articles</li>
    </ul>
</div>
<!-- start main container -->
<section class="theme-bg-white py-3">
    <div class="container">
        <!-- blog post -->
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-12 col-lg-6 mb-4">
                    <div class="news-card row g-0">
                        <div class="col-12 col-lg-6">
                            <div class="theme-box-shadow theme-border-radius overflow-hidden position-relative">
                                <figure class="mb-0 img-effect">
                                    <img src="{{ asset($blog->blog_img) }}" class="img-fluid"
                                        alt="AgenceDigitals article">
                                </figure>
                                <div class="date-tags position-absolute">
                                    <div class="flood-effect">
                                        <a href="{{ url('/blog/' . $blog->id . '/details') }}"
                                            class="font-small text-white">Lire l'article</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('/blog/' . $blog->id . '/details') }}"
                            class="p-2 p-lg-2 p-xl-4 col-12 col-lg-6">
                            <h2 class="fs-5 fw-bold mb-3" style="font-size: 16px !important">{{ $blog->title }}</h2>
                            <div class="text-dark mb-2 " style="height: 100px;overflow-y:hidden">
                                {!! $blog->short_desc !!}
                            </div>
                            <ul class="d-flex flex-row mb-2">
                                <li class="small pe-3">
                                    <div class="theme-text-accent-one"> <i class="bi bi-person pe-2"></i> AgenceDigitals
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="theme-text-accent-one"> <i
                                            class="bi bi-calendar-week pe-2"></i>{{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('d F Y') }}
                                    </div>
                                </li>
                            </ul>

                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12 mt-5">
                <nav aria-label="Page navigation example">
                    <div class="pagination justify-content-center">

                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- end main container -->
@endsection
