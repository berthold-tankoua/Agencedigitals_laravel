@extends('frontend.main_master')

@section('content')

@section('title')
    AgenceDigitals | {{ $blog->title }}
@endsection
@php
    $reviews = App\Models\Review::orderBy('id', 'DESC')->where('blog_id', $blog->id)->get();
@endphp
<section class="recom-sec theme-bg-white py-5">
    <div class="container">
        <div class="row">
            <!-- left side blog post -->
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="row">
                    <!-- blog post details -->
                    <div class="col-12">
                        <div class="post-wrap">
                            <h2 class="post-head">{{ $blog->title }}</h2>
                            <div class="overflow-hidden hoverShine theme-border-radius">
                                <figure class="mb-0 img-effect">
                                    <img src="{{ asset($blog->blog_img) }}" class="img-fluid" alt="flight-destination"
                                        title="flight-destination">
                                </figure>
                            </div>
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div class="">
                                    <span
                                        class="d-inline-flex p-3 rounded-circle theme-bg-accent-two theme-box-shadow me-3">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <span class="author-info">AgenceDigitals, <span
                                            class="font-small">Auteur</span></span>
                                </div>
                                <span class="font-medium">
                                    <i class="bi bi-calendar-week-fill me-2"></i>
                                    <span
                                        class=" theme-text-accent-one">{{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('d F Y') }}</span>
                                </span>
                            </div>
                            <div>
                                {!! $blog->short_desc !!}
                            </div>
                            <div>
                                {!! $blog->long_desc !!}
                            </div>
                        </div>
                    </div>
                    <!-- blog post social -->

                    <!-- Comment section -->
                    <div class="col-12">
                        <div class="comment-box">
                            <h3 class="comment-head">{{ count($reviews) }} commentaire(s)</h3>
                            <!-- Reply comment form -->
                            <div class="row p-4 my-2">
                                <h4>Laisser un Commentaire</h4>
                                <section class="col-12 comment-form">
                                    <input type="hidden" name="blog_id" id="blog_id" value="{{ $blog->id }}">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="name" id="rname"
                                                    placeholder="Your Name">
                                                <label for="rname">Votre nom</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" name="email" id="remail"
                                                    placeholder="Enter Yourn Email">
                                                <label for="remail">Votre
                                                    Email</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" id="rcomment" rows="3" placeholder="Saisir votre Message"></textarea>
                                    </div>
                                    <input type="hidden" name="rmark" value="5" id="rmark">
                                    <div class="mt-3 custom-button">
                                        <button onclick="StoreBlogReview()"
                                            class="rounded-pill custom-btn-primary font-small button-effect px-4">
                                            Publier votre message</button>
                                    </div>
                                </section>
                            </div>
                            <!-- Comment 1 -->
                            @foreach ($reviews as $review)
                                <ul class="user-comment-card card mb-3 m-3">
                                    <li>
                                        <div class="comment-title">
                                            <div class="userPic">

                                                <span class="userName">{{ $review->name }}</span>
                                            </div>
                                            <div class="comment-meta">
                                                <span>{{ \Carbon\Carbon::parse($review->created_at)->translatedFormat('d F Y') }}</span>

                                            </div>
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-body">
                                                <p>{{ $review->comment }}.</p>
                                            </div>

                                        </div>

                                    </li>
                                </ul>
                            @endforeach
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- blog sidebar -->
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                    <!-- blog search -->
                    <div class="col-12">
                        <div class="input-group input-group-lg mb-5 search-form rounded-pill">
                            <button class="btn rounded-pill"><i class="bi bi-search"></i></button>
                            <input type="text" class="form-control rounded-pill border-0"
                                placeholder="Search a Topic" aria-label="Username">
                        </div>
                    </div>
                    <!-- Trending post Tags  -->
                    @if (count($blogs) > 0)
                        <div class="col-12">
                            <h6 class="blog-list-head">Articles recents</h6>
                            <!-- trending post 01 -->
                            @foreach ($blogs as $blog)
                                <div class="theme-box-shadow theme-border-radius px-4 py-4 theme-bg-white mb-4">
                                    <div class="row g-0">
                                        <div class="col-12 col-xxl-6 overflow-hidden theme-border-radius">
                                            <div class="overflow-hidden">
                                                <figure class="mb-0 img-effect">
                                                    <img src="{{ asset($blog->blog_img) }}" class="img-fluid"
                                                        alt="flight-destination-one" title="flight-destination-one">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xxl-6 align-self-center">
                                            <div class="mt-2 mt-xxl-0 ps-md-0 ps-xxl-3">
                                                <span class="d-flex fw-bold">{{ $blog->title }}</span>
                                                <span class="d-flex font-small fw-normal theme-text-accent-one"
                                                    style="height: 20px;overflow-y:hidden">{!! $blog->short_desc !!}</span>
                                                <a href="{{ url('/blog/' . $blog->id . '/details') }}"
                                                    class="d-inline-flex mt-2 text-link text-link-effect"><span>Lire
                                                        plus</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <hr>
                    <!-- Categories Tags  -->
                    <div class="col-12 mt-1">
                        <h6 class="blog-list-head">Nos Produits</h6>
                        @foreach ($products as $product)
                            <div class="col-12 mb-3">
                                <div class="border border-1 theme-border-radius">
                                    <div class="box h-auto">
                                        <img src="{{ asset($product->product_thambnail) }}" class="img-fluid"
                                            alt="AgenceDigitals image">
                                        <div class="content">
                                            <div class="deal-badge">
                                                @if ($product->discount_price)
                                                    <span class="badge bg-danger">Promotion</span>
                                                @else
                                                    <span class="badge bg-success">Vente</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="content-hover flex-row">
                                            <a href="#" class="quick-btn" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal"><i class="bi bi-eye"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Vue Rapide" id="{{ $product->id }}"
                                                    onclick="productView(this.id)"></i></a>
                                            <div id="{{ $product->id }}" onclick="addToWishlist(this.id)"
                                                class="quick-btn mx-2" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Ajouter au Favoris"><i
                                                    class="bi bi-heart mx-3"></i></div>
                                            <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                class="quick-btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Passer commande"><i class="bi bi-bag"></i></a>
                                        </div>
                                    </div>
                                    <div
                                        class="position-relative p-3 mb-0 theme-border-radius-bottom card-effect theme-bg-white">
                                        <div class="card-box"></div>
                                        <span class="text-warning">
                                            <small>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </small>
                                            <span class="text-muted small "
                                                style="margin-left: 5px;">({{ $product->review_count + 5 }})
                                                Avis</span>
                                        </span><br>
                                        <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                            class="mb-0 pb-2 theme-text-secondary d-inline-flex fs-6 fw-bold mt-2">
                                            {{ $product->product_name }}
                                        </a>

                                        <div class="d-flex justify-content-between align-items-center mt-0">
                                            <div>
                                                @if ($product->discount_price == null)
                                                    <span class="theme-text-secondary "><strong>{{ App\Utility\Utility::currency_converter($product->selling_price) }}
                                                            {{ App\Utility\Utility::currency_code() }}</strong>
                                                        {!! $product->action_type !!}</span>
                                                @else
                                                    <span class="theme-text-secondary"><strong>{{ App\Utility\Utility::currency_converter($product->discount_price) }}
                                                            {{ App\Utility\Utility::currency_code() }}</strong>
                                                        {!! $product->action_type !!} <del class="text-danger"
                                                            style="margin-left: 5px;font-size:12px">{{ App\Utility\Utility::currency_converter($product->selling_price) }}
                                                            {{ App\Utility\Utility::currency_code() }}
                                                            {!! $product->action_type !!}</del></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <span class="d-flex pb-2 font-small theme-text-accent-one">
                                                <span>
                                                    <i class="bi bi-postage me-1"></i>
                                                    @if ($product->store_id)
                                                        <span
                                                            class="d-inline-flex">{{ $product->store->store_name }}</span>
                                                    @else
                                                        <span class="d-inline-flex">AgenceDigitals</span>
                                                    @endif

                                                </span>
                                            </span>
                                            <div class="custom-button"><a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                    class="rounded-pill custom-btn-secondary font-small button-effect d-flex justify-content-center align-items-center add-btn">Commander</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
