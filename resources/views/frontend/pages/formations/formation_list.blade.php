@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Nos formations
@endsection
<style>
    body {
        background-color: #f8f9fa;
    }

    .course-card {
        background: #fff;
        transition: 0.3s;
        border-radius: 10px;
        overflow: hidden;
    }

    .course-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .course-card img {
        height: 180px;
        object-fit: cover;
    }

    .course-card h5 {
        font-size: 16px;
        font-weight: 600;
    }

    .course-price {
        font-weight: 700;
        font-size: 18px;
    }

    .category-list li {
        margin-bottom: 12px;
    }

    .category-list a {
        text-decoration: none;
        color: #333;
        font-weight: 500;
    }

    .category-list a:hover {
        color: #0d6efd;
    }

    .rating {
        color: #f4c150;
        font-size: 14px;
    }

    .sidebar-box {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 25px;
    }
</style>
<!-- section begin -->
<section id="subheader" class="jarallax relative">
    <img src="{{ asset('frontend/images/background/2.webp') }}" class="jarallax-img" alt="">
    <div class="container relative z-2">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="clearfix"></div>
                <h1 class="wow fadeInUp h4 mbltitle" data-wow-delay=".4s">Catégories</h1>
                <div class="crumb-wrapper">
                    <ul class="crumb wow fadeInUp" data-wow-delay=".8s">
                        <li><a href="{{ url('/') }}">Accueil</a></li>
                        <li>Catégorie</li>
                        <li class="active">{{ $category->category_name_fr }}</li>
                    </ul>
                </div>
            </div>

            <div class="w-40 abs abs-middle end-0 xs-hide">
                <img src="{{ asset('frontend/images/misc/c2.webp') }}" class="w-100 wow scaleIn" data-wow-duration="2s"
                    alt="">
            </div>
        </div>
    </div>
</section>
<!-- section close -->
<div class="container pt-5 pb-5">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-lg-4">

            <!-- Search -->
            <div class="sidebar-box">
                <h5 class="mb-3">Rechercher</h5>
                <form action="{{ url('formation/search') }}" method="GET">

                    <input type="text" class="form-control mb-3" name="title"
                        placeholder="Ex: Laravel, Marketing...">
                    <button class="btn btn-primary w-100">Rechercher</button>
                </form>
            </div>

            <!-- Categories -->
            <div class="sidebar-box">
                <h5 class="mb-3">Catégories</h5>
                <ul class="list-unstyled category-list">
                    @foreach ($categories as $cat)
                        <li><a href="{{ url('formation/category/' . $cat->id . '/' . $cat->category_slug_fr) }}">{{ $cat->category_name_fr }}
                                <span>({{ $cat->formations->count() }})</span></a>

                        </li>
                    @endforeach
                </ul>
            </div>

        </div>

        <!-- MAIN CONTENT -->
        <div class="col-lg-8">

            <div class="row g-4">

                @foreach ($formations as $formation)
                    <div class="col-md-6">
                        <div class="course-card h-100">
                            <img src="{{ asset($formation->thumbnail) }}" class="w-100" alt="">
                            <div class="p-3">
                                <h5>{{ $formation->name }}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted small mb-1">Par {{ $formation->author }}</p>
                                    <div class="rating mb-2">★★★★☆ (4.5)</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span
                                        class="course-price">{{ App\Utility\Utility::currency_converter($formation->price) }}
                                        {{ App\Utility\Utility::currency_code() }}</span>
                                    <a href="{{ url('formation/details/' . $formation->id . '/' . $formation->slug) }}"
                                        class="btn btn-sm btn-outline-primary">Afficher plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="text-center mt-5">
                <nav>
                    <div class="pagination justify-content-center">

                    </div>
                </nav>
            </div>

        </div>

    </div>

</div>

@endsection
