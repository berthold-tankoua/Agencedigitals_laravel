@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Tous nos Partenaires
@endsection
<!-- start main container -->
<main id="main" class="p-5">
    <div class="container py-2">
        <div class="box-title text-center wow fadeInUp">
            <h3 class="title ">Nos Partenaires</h3>
            <div class="text-subtitle text-primary">Bénéficiez des services de qualité chez nos différents partenaires
            </div>
        </div>
        <div class="row py-1">
            <div class="col-lg-12">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto text-dark font-weight-bold">
                        Nos Partenaires : <span class="text-success" id="count_props">{{ count($annonces) }}</span>
                    </div>

                </div>

                <div class="row justify-content-content pt-5" id="advancedsearch">
                    @foreach ($annonces as $item)
                        <!-- Start Single Realty 1 -->
                        <div class="col-md-4 col-xl-4 mb-5 post_item">
                            <div class="box-agent style-list hover-img hover-btn-view lg-col-3">
                                <a href="{{ url('advertise/view/' . $item->id . '/' . $item->advert_slug) }}">
                                    <div class="agent_item bg-white  overflow-hidden text-center position-relative">
                                        <div
                                            class=" d-inline-block overflow-hidden p-1  position-relative shadow-sm mt-n2">
                                            <img src="{{ asset($item->advert_thambnail) }}"
                                                class="d-block w-100    slow_7s" alt="{{ $item->advert_title }}" />
                                        </div>
                                        <div class="">
                                            <div class="d-flex align-content-center flex-wrap" style="height: 30px;">
                                                <p class=" text-body w-100 mb-0" style="height:19px;overflow:hidden;">
                                                    {{ $item->advert_title }}</p>
                                            </div>
                                        </div>
                                        <span class="d-flex border-top px-2 text-dark bg-light text_small p-2">
                                            <span class="d-inline-block w-100 "><i class="fas fa-street-view mr-2"></i>
                                                {{ $item->country }} | {{ $item->city }} | {{ $item->street }}</span>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Single Realty 1 -->
                    @endforeach
                </div>
                <nav aria-label="Navigation Pagination">
                    {{ $annonces->links() }}
                </nav>
            </div>



        </div>

    </div>
</main>
<!-- end main container -->
@endsection
