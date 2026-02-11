@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | {{ $advertise->advert_title }}
@endsection
<!-- start main container -->
<main class="bg-light container" id="main">
    <article class="border-bottom pb-3">
        <input type="hidden" name="advertise_id" id="advertise_id" value="{{ $advertise->id }}">
        @php
            $muliimgs = App\Models\MultiImg::where('advert_id', $advertise->id)->orderBy('id', 'DESC')->limit(5)->get();
        @endphp
        <!-- Modal -->
        <!-- End Modal -->
        <div class="row ">
            <div class="col-lg-4 order-0 position-relative">
                <div class="row justify-content-center" data-toggle="modal" data-target="#exampleModal">
                    <div class="p-3" style="margin:1px;max-width:100%;max-height:auto !important;overflow:hidden;">
                        <img src="{{ asset($advertise->advert_thambnail) }}" style="width: 100%;">
                    </div>
                </div>

            </div>
            <header class="col-lg-4 py-4 order-3 order-lg-2  pr-lg-5">
                <div>
                    <section class="bg-white p-3  border mb-4">
                        <header class="border-bottom border-dark mb-4">
                            <h4 class="text-dark mb-3">{{ $advertise->advert_title }}</h4>
                        </header>
                        <div class="text-muted">
                            {!! $advertise->short_descp !!}
                        </div>
                    </section>
                </div>
            </header>
            <div class="col-lg-4 order-lg-3 d-print-none pt-lg-0">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-12 mb-4">
                        <section class="bg-white border p-3 px-lg-4 pt-4">
                            <header class="text-right border-bottom border-dark pb-3 mb-4">
                                <h6 class="text-dark font-weight-bold mb-0">Aimez vous cette Publication.?</h6>
                                <p class="tagline mb-0 text-muted">
                                    Talk directly to me!
                                </p>
                            </header>
                            <div
                                class="agent_item bg-white border border-back-50 overflow-hidden text-center position-relative">
                                <div class="d-block bg_cover position-relative agent_bg mb-n3"
                                    style="background-image: url(assets/img/600x600.jpg);"></div>

                                <div class="px-3 pb-3">
                                    <div class="d-flex align-content-center flex-wrap" style="height: 70px;">
                                        <p class="h5 font-weight-bold text-body w-100 mb-0">{{ $advertise->name }}</p>
                                        <p class="text_small w-100 mb-0"></p>
                                    </div>
                                </div>

                                <div class="agent_item_content slow_3s px-3 pb-3">
                                    <div class="d-flex justify-content-between w-100">
                                        <a class="btn btn-lg btn-outline-secondary flex-grow-1" data-toggle="tooltip"
                                            data-placement="top" target="_blank" rel="noopener noreferrer"
                                            href="https://wa.me/{{ $advertise->contact }}/?text= Je suis interesse par cette annonce et j'aimerais en savoir plus: https://AgenceDigitals.com/advertise/view/{{ $advertise->id }}/{{ $advertise->advertise_slug }} "
                                            title="Nous ecrire sur WhatsApp">
                                            <i class="fab fa-whatsapp fa-2x"></i>
                                        </a>

                                        <a class="btn btn-lg btn-outline-secondary flex-grow-1 mx-1"
                                            data-toggle="tooltip" data-placement="top" target="_blank"
                                            rel="noopener noreferrer" href="mailto:{{ $advertise->email }}"
                                            title="Envoyer un Email a AgenceDigitals">
                                            <i class="far fa-envelope fa-2x"></i>
                                        </a>

                                        <div class="btn btn-lg btn-outline-secondary flex-grow-1" data-toggle="tooltip"
                                            data-placement="top" onclick="showcontact()"
                                            title="Afficher le contact de l agent">
                                            <i class="fas fa-phone-alt fa-2x"></i>
                                        </div>
                                    </div><br>
                                    <div id="show_contact" style="display:none;color:rgb(39, 38, 38)">
                                        <p>Contact : <strong>{{ $advertise->contact }}</strong></p>
                                        <span style="font-size: 12px;">Veuillez s'il vous plait mentionner à l'agent que
                                            vous avez vu son annonce sur AgenceDigitals</span>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>

                </div>
            </div>
            <div class="col-12 order-lg-4">
                <div class="container py-5">
                    <div class="row py-3">
                        <div class="col-lg-7 col-xl-8">
                            <section class="bg-white p-3 px-lg-4 pt-4 pb-5 border mb-4">
                                <header class="border-bottom border-dark mb-4">
                                    <h4 class="text-dark font-weight-bold mb-3">Localisation</h4>
                                </header>
                                <p class="text-body"><i class="far fa-map"></i> {{ $advertise->country }},
                                    {{ $advertise->city }}, {{ $advertise->street }}</p>
                            </section>
                            @if (!empty($advertise->advert_video))
                                <section class="bg-white p-3 px-lg-4 pt-4 pb-5 border mb-4 d-print-none">
                                    <header class="border-bottom border-dark mb-4">
                                        <h4 class="text-dark font-weight-bold mb-3">Visionner la video</h4>
                                    </header><br>
                                    <a href="{{ asset($advertise->advert_video) }}">Telecharger la Video</a><br>
                                    <div class="text-muted">

                                        <div class="embed-responsive embed-responsive-16by9 mb-3">

                                            <video autoplay>
                                                <source src="{{ asset($advertise->advert_video) }}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </section>
                            @endif
                            <section class="bg-white p-3 px-lg-4 pt-4 pb-5 border mb-4">
                                <header class="border-bottom border-dark mb-4">
                                    <h4 class="text-dark font-weight-bold mb-3">Description detaillée</h4>
                                </header>
                                <div class="text-muted">
                                    {!! $advertise->long_descp !!}
                                </div>
                            </section>
                            <section class="bg-white p-3 px-lg-4 pt-4 pb-5 border mb-4">
                                <header class="border-bottom border-dark mb-4">
                                    <h4 class="text-dark font-weight-bold mb-3">Images</h4>
                                </header>
                                <div
                                    class="text-center text-muted text_small imovel_content d-flex flex-wrap justify-content-around align-items-center">
                                    <div class="row ">

                                        <div class="col-lg-12 order-0 position-relative">
                                            <div class="row justify-content-center" data-toggle="modal"
                                                data-target="#exampleModal">
                                                @foreach ($muliimgs as $img)
                                                    <div
                                                        style="margin:1px;max-width:30%;max-height:235px !important;overflow:hidden;">
                                                        <img src="{{ asset($img->photo_name) }}" style="width: 100%;">
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </section>
                        </div>

                        <!--sidebar-->

                    </div>
                </div>
            </div>

        </div>

    </article>

</main>
<!-- end main container -->
<script>
    $("#UserSendMsg").click(function(e) {
        e.preventDefault();
        user_name = $("#user_name").val();
        user_email = $("#user_email").val();
        user_phone = $("#user_phone").val();
        user_indicatif = $("#user_indicatif").val();
        store_id = $("#store_id").val();
        property_id = $("#property_id").val();
        user_message = $("#user_message").val();
        link = $("#link").val();

        var data = new FormData();
        data.append('user_name', user_name);
        data.append('user_email', user_email);
        data.append('user_phone', user_phone);
        data.append('user_indicatif', user_indicatif);
        data.append('store_id', store_id);
        data.append('property_id', property_id);
        data.append('link', link);
        data.append('user_message', user_message);

        $.ajax({
            url: "/client/send/msg",
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }

            }

        }); // end ajax

    }); // end one
</script>
@endsection
