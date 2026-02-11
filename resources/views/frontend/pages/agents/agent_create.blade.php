@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Creation de la Boutique
@endsection
<!-- start main container -->
<main class="bg-light bg_parallax" style="background-image: url({{ asset('frontend/assets/img/1920x1000.jpg') }})">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class='py-5 px-3 px-md-5 my-3 col-lg-10 col-xl-8 shadow bg-white text-left'>
                <div class="text-center">
                    <a class="main_brand d-inline-block" href="index.html" title="MaxRealty - Home">
                        <img class="d-block w-100" src="assets/img/brand-black.png" alt="AgenceDigitals"
                            title="" />
                    </a>
                    <h2 class="font-weight-bold h4">Création de votre compte</h2>
                    <p class="tagline text-body mb-3">Veuillez renseigner les informations requises afin de créer votre
                        compte.</p>
                </div>
                <form id="agentForm" action="{{ route('agent.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="row mt-2">

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Email <span class="text-danger">*</span></label>
                                <div class="controls">
                                    <input type="text" name="store_email" value="{{ Auth::user()->email }}"
                                        class="form-control" required
                                        oninvalid="this.setCustomValidity('Saisir votre mail')"
                                        oninput="this.setCustomValidity('')">
                                    @error('store_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!-- end col md 6 -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Contact whatsApp <span class="text-danger">*</span></label>
                                <div class="controls">
                                    <input type="text" name="store_contact" value="{{ Auth::user()->phone }}"
                                        class="form-control" required
                                        oninvalid="this.setCustomValidity('Saisir votre contact')"
                                        oninput="this.setCustomValidity('')">
                                    @error('store_contact')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!-- end col md 6 -->
                    </div>
                    <hr>
                    <div class="text-left text-muted imovel_content ">
                        <div class="row"> <!-- start 1st row  -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Catégorie Disponible <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <select name="agent_category" id="agent_cat" class="form-control" required
                                            oninvalid="this.setCustomValidity('Selectionner une categorie')"
                                            oninput="this.setCustomValidity('')">
                                            <option value="Proprietaire_immobilier" selected>Proprietaire Immobilier
                                            </option>
                                        </select>
                                        @error('agent_category')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Image de profil <span class="text-danger">(Optionnel)</span></label>
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
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Pseudo ou nom d'utilisateur du propriétaire <span
                                            class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="store_name"
                                            placeholder="Saisir un Pseudo ou nom d'utilisateur" class="form-control"
                                            autocomplete="off" required
                                            oninvalid="this.setCustomValidity('Saisir le nom ou pseudo de votre agence')"
                                            oninput="this.setCustomValidity('')">
                                        @error('store_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Localisation du propriétaire <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="store_adress" class="form-control" required
                                            oninvalid="this.setCustomValidity('Saisir la localisation de votre agence')"
                                            oninput="this.setCustomValidity('')"
                                            placeholder="EX : Pays, Ville, Quartier">
                                        @error('store_adress')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                        </div> <!-- end 1st row  -->

                        <div class="row"> <!-- start 2nd row  -->
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Document(s) a fournir (Image ou PDF) <span
                                            class="text-danger">*</span></label><br>
                                    <span class="text-danger"> <strong>Carte National D'itentite (CNI) ou Registre de
                                            Commerce</strong></span>
                                    <div id="doc_img" class="d-none">
                                        <span class="text-danger" id="bailleur"> <strong>Carte National D'itentite
                                                (CNI)</strong> </span>
                                        <span class="text-danger" id="agent"> <strong>Carte National D'itentite
                                                (CNI) ou Registre de Commerce</strong></span>
                                        <span class="text-danger" id="agentagree"> <strong>Registre de Commerce &
                                                Agrement</strong> </span>
                                        <span class="text-danger" id="proprietaire"> <strong>Carte National D'itentite
                                                (CNI) ou Registre de Commerce</strong></span>
                                        <span class="text-danger" id="proprietaireagree"> <strong> Carte National
                                                D'itentite (CNI) ou Registre de Commerce</strong></span>
                                    </div>
                                    <div class="controls">
                                        <input type="file" name="agent_doc[]" class="form-control" multiple=""
                                            id="multiImg" required
                                            oninvalid="this.setCustomValidity('Inserer un document | CNI ou Registre de Commerce')"
                                            oninput="this.setCustomValidity('')" accept="image/*,application/pdf">
                                        @error('agent_doc')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div id="preview_img" class="mt-2">

                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->

                        </div> <!-- end 2nd row  -->

                        <div class="row"> <!-- 3th row  -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Nom du reseau social <span class="text-danger">(Optionnel)</span></label>
                                    <div class="controls">
                                        <input type="text" name="spec_title[]" class="form-control"
                                            value="Facebook">
                                    </div>
                                </div>
                            </div> <!-- col-md-5//  -->

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label> Lien de la page <span class="text-danger">(Optionnel)</span></label>
                                    <div class="controls">
                                        <input type="text" name="spec_desc[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Nom du reseau social <span class="text-danger">(Optionnel)</span></label>
                                    <div class="controls">
                                        <input type="text" name="spec_title[]" class="form-control"
                                            value="Instagram">
                                    </div>
                                </div>
                            </div> <!-- col-md-5//  -->

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label> Lien de la page <span class="text-danger">(Optionnel)</span></label>
                                    <div class="controls">
                                        <input type="text" name="spec_desc[]" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end 3th row  -->
                    </div>
                    <div>
                        <div id="agentnotif" class="d-flex align-items-center" style="display: none !important">
                            <div class="spinner-border text-primary me-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <h4 class="ml-2">Creation du compte en cours</h4>
                        </div>
                        <button id="agentsubmit" type="submit" class="btn btn-block btn-primary py-3">Valider les
                            Informations</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

</main>
<script>
    $('#agentForm').on('submit', function() {
        $('#agentnotif').show();
        document.getElementById('agentnotif').style.display = 'block !important';
        $('#agentsubmit').hide();
    });
    $(function() {
        $('#bailleur').hide();
        $('#agent').hide();
        $('#agentagree').hide();
        $('#promoteur').hide();
        $('#promoteuragree').hide();
        // $('#agent_cat').change(function(){
        //     if($('#agent_cat').val() == 'Bailleur') {
        //         $('#doc_img').show();
        //         $('#bailleur').show();
        //     } else {
        //         $('#bailleur').hide();
        //     }
        //     if($('#agent_cat').val() == 'Agent_immobilier') {
        //         $('#doc_img').show();
        //         $('#agent').show();
        //     } else {
        //         $('#agent').hide();
        //     }
        //     if($('#agent_cat').val() == 'Agent_immobilier_agree') {
        //         $('#doc_img').show();
        //         $('#agentagree').show();
        //     } else {
        //         $('#agentagree').hide();
        //     }
        //     if($('#agent_cat').val() == 'Promoteur_immobilier') {
        //         $('#doc_img').show();
        //         $('#promoteur').show();
        //     } else {
        //         $('#promoteur').hide();
        //     }
        //     if($('#agent_cat').val() == 'Promoteur_immobilier_agree') {
        //         $('#doc_img').show();
        //         $('#promoteuragree').show();
        //     } else {
        //         $('#promoteuragree').hide();
        //     }
        // });
    });
</script>
<!--===============================
    JS SCRIPT TO PREVIEW MULTI-IMAGE
    ================================-->

<script>
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                            .type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src',
                                        e.target.result).width(80)
                                    .height(80); //create image element
                                $('#preview_img').append(
                                    img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>
<!-- end main container -->
@endsection
