@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Toutes les Annonces
@endsection
<!-- start main container -->
<main id="main" class="p-5">
    <div class="container py-2">
        <div class="box-title text-center wow fadeInUp">
            <h3 class="title">Nos Annonces</h3>
            <div class="text-subtitle text-primary">Contactez nos intermédiaires qui sont prêts à vous aider dans le
                choix de votre future propriété !</div>
        </div>
        <div class="row py-1">
            <div class="col-lg-12">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto text-dark font-weight-bold">
                        Nombre d'Annonce trouvee(s) : <span class="text-success"
                            id="count_props">{{ count($annonces) }}</span>
                    </div>
                    {{-- <div class="col-auto">
                                <div class="btn-group">
                                    <button
                                        class="btn btn-outline-primary btn-lg py-3 dropdown-toggle text_small"
                                        type="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Order By
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right text-right p-0 shadow-sm rounded-0">
                                        <a class="dropdown-item text_small px-2 py-3" href="JavaScript:Void(0);">Price ASC</a>
                                        <a class="dropdown-item text_small px-2 py-3" href="JavaScript:Void(0);">Price DESC</a>
                                        <a class="dropdown-item text_small px-2 py-3" href="JavaScript:Void(0);">More seen</a>
                                        <a class="dropdown-item text_small px-2 py-3" href="JavaScript:Void(0);">More News</a>
                                    </div>
                                </div>
                            </div> --}}
                </div>

                <div class="row justify-content-content pt-5" id="advancedsearch">
                    @foreach ($annonces as $item)
                        <!-- Start Single Realty 1 -->
                        <div class="col-md-4 col-xl-4 mb-5 post_item">
                            <div class="ml-2 agent_item overflow-hidden text-left position-relative pl-3">
                                <section class="bg-white p-3 px-lg-4 pt-4 border d-print-none" style="height: 100%;">
                                    <header class="border-bottom border-dark mb-4">
                                        <h5 class="text-dark font-weight-bold mb-3">{{ $item->titre }}</h5>
                                    </header>
                                    <div class="text-muted" style="height: 150px;overflow:hidden;overflow-y:scroll;">
                                        {!! $item->desc !!}
                                    </div>
                                    <span class="d-flex border-top px-2 text-dark bg-light text_small p-2">
                                        <span class="d-inline-block w-100 "><i
                                                class="fas fa-street-view mr-2"></i>{{ $item->location }} </span>
                                    </span>
                                </section>
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
