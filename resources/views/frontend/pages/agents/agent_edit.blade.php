@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Dashboard
@endsection

<!-- start main container -->
<main id="main">
    <section class="ps-vendor-dashboard">
        <!-- Preloader Start -->
        @include('frontend.components.agent_header')
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class='py-5 px-3 px-md-5 col-md-9 shadow bg-white text-left'>
                    <div class="text-center">
                        <h2 class="font-weight-bold h4 text-uppercase">Édition du compte</h2>
                        <p class="tagline text-body mb-3">Veuillez mettre à jour vos données personnelles si nécessaire.!
                        </p>
                    </div>
                    <form class="" action="{{ route('update.agent') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" value="{{ $store->id }}">
                        <input type="hidden" name="old_img" value="{{ $store->store_thambnail }}">

                        <div class="row mt-2">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label>Utilisateur <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <p>{{ Auth::user()->name }}</p>
                                        <input type="hidden" name="user_id" class="form-control"
                                            value="{{ Auth::id() }}">
                                        @error('user_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label>Abonnement <span class="text-danger">*</span></label>
                                    <p>{{ $store->subscription->offer_title }}</p>
                                    <div class="controls">

                                        @error('subscription_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                        </div>
                        <hr>
                        <div class="row"> <!-- start 1st row  -->
                            <div class="col-md-6 mb-2 ">
                                <img src="{{ asset($store->store_thambnail) }}" style="width:75px;height:75px "
                                    alt="AgenceDigitals">
                            </div> <!-- end col md 6 -->
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label>Agence Profil Pic <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="file" name="store_thambnail" class="form-control"
                                            onChange="mainThamUrl(this)">
                                        @error('store_thambnail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <img src="" id="mainThmb">
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->

                        </div> <!-- end 1st row  -->

                        <div class="row"> <!-- start 2nd row  -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Nom de L'agence <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="store_name" class="form-control"
                                            value="{{ $store->store_name }}">
                                        @error('store_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Agence Contact <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="store_contact" class="form-control"
                                            value="{{ $store->store_contact }}">
                                        @error('store_contact')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Agence Email <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="store_email" class="form-control"
                                            value="{{ $store->store_email }}">
                                        @error('store_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Localisation de l'Agence <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="store_adress" class="form-control"
                                            value="{{ $store->store_adress }}">
                                        @error('store_adress')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                        </div> <!-- end 2nd row  -->

                        <div class="row"> <!-- start 7th row  -->

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Short Description French <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <textarea id="editor4" name="store_descp_fr" id="textarea" class="form-control" rows="10" required>
                                                {!! $store->store_descp_fr !!}
                                            </textarea>
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->

                        </div> <!-- end 7th row  -->
                        @php
                            $socials = App\Models\SocialNetwork::where('store_id', $store->id)->get();
                        @endphp
                        @foreach ($socials as $social)
                            <div class="row"> <!-- 9th row  -->

                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Nom du reseau social <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="spec_title[]" class="form-control"
                                                value="{{ $social->network_name }}">
                                        </div>
                                    </div>
                                </div> <!-- col-md-5//  -->

                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label> Lien de la page <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="spec_desc[]" class="form-control"
                                                value="{{ $social->network_link }}">
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end 9th row  -->
                        @endforeach
                        <br>

                        <button type="submit" class="btn btn-block btn-primary py-3">Mettre a jour mes
                            informations</button>
                    </form>
                </div>

            </div>
        </div>

    </section>
</main>
<!-- end main container -->
@endsection
