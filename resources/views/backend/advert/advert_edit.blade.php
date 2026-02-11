@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Ajouter une annonce
@endsection


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">

            <div class="box-header with-border">
                <h4 class="box-title">Editer une annonce </h4>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('update.advert') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="row">
                                <input type="hidden" name="id" value="{{ $advert->id }}">
                                <input type="hidden" name="old_img" value="{{ $advert->advert_thambnail }}">
                                <input type="hidden" name="old_video" value="{{ $advert->advert_video }}">
                                <input type="hidden" name="old_profil" value="{{ $advert->profil_pic }}">
                                <div class="col-12">
                                    <h1 style="font-size: 25px;">UTILISATEUR</h1>
                                    <div class="row"> <!-- start 1st row  -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Image de Profil<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="profil_pic" class="form-control"
                                                        onChange="mainThamUrl(this)">
                                                    @error('profil_pic')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Nom & Prenom <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $advert->name }}">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Email' <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $advert->email }}">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Contact <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="contact" class="form-control"
                                                        value="{{ $advert->contact }}">
                                                    @error('contact')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 2nd row  -->
                                    <h1 style="font-size: 25px;">PRESENTATION</h1>
                                    <div class="row"> <!-- start 1st row  -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Domaine <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="type" class="form-control">

                                                        <option value="{{ $advert->type }}" selected>
                                                            {{ $advert->type }}</option>
                                                        <option value="Aucun">Aucun</option>
                                                        <option value="Centre commercial">Centre commercial</option>
                                                        <option value="meublé">meublé</option>
                                                    </select>
                                                    @error('type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Titre de l'annonce' <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="advert_title" class="form-control"
                                                        value="{{ $advert->advert_title }}">
                                                    @error('advert_title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Ajouter une video <span class="text-danger">(optionnel)</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="advert_video" class="form-control">
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Image Principal <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="advert_thambnail" class="form-control"
                                                        onChange="mainThamUrl(this)">
                                                    @error('advert_thambnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 2nd row  -->
                                    <div class="row"> <!-- start 7th row  -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Description <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor4" name="short_descp_fr" id="textarea" class="form-control">
                                                        {!! $advert->short_descp !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Longue Description <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor2" name="long_descp_fr" id="textarea" class="form-control">
                                                        {!! $advert->long_descp !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                    </div> <!-- end 7th row  -->

                                    <!-- end 10th row  -->
                                    <h1 style="font-size: 25px;">GALLERIE</h1>
                                    <div class="row"> <!-- start 6th row  -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Multiple Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="multi_img[]" class="form-control"
                                                        multiple="" id="multiImg">
                                                    @error('multi_img')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div id="preview_img">

                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Tags Fr <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="advert_tags_fr" class="form-control"
                                                        value="{{ $advert->advert_tags }}" data-role="tagsinput">
                                                    @error('advert_tags_fr')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 6th row  -->
                                    <h1 style="font-size: 25px;">LOCALISATION</h1>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Pays <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="country" class="form-control"
                                                        value="{{ $advert->country }}">
                                                    @error('country')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Ville <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="city" class="form-control"
                                                        value="{{ $advert->city }}">
                                                    @error('city')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Quartier <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="street" class="form-control"
                                                        value="{{ $advert->street }}">
                                                    @error('street')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- /.add_item -->

                                    <hr>


                                </div> <!-- end col 12  -->

                                <div> <!-- end row  -->

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Ajouter ">
                                    </div>

                        </form> <!-- end form -->
                        <div> <!-- end col  -->
                            <div> <!-- end row  -->
                                <div> <!-- end box-body  -->

                                    <div> <!-- end box  -->

    </section> <!-- end section  -->

    <div><!-- end section  -->


        <!--===============================
    AJAX JS SCRIPT DEPENDANT DROPDOWN
    ================================-->

        <script type="text/javascript">
            // DEPENDENT DROPDOWN FOR SUBCATEGORY

            $('select[name="category_id"]').on('change', function(e) {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/category/subcategories/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append('<option value="' + value
                                    .id + '">' + value.subcategory_name_fr + '</option>');
                            });
                        }, //End Of Retrieve Data
                    }); //End Of Ajax Script
                } else {
                    alert('danger');
                } //End Of Condition
            });

            // DEPENDENT DROPDOWN  FOR SUBSUBCATEGORY

            $('select[name="subcategory_id"]').on('change', function() {
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        url: "{{ url('/category/sub-subcategory/ajax') }}/" + subcategory_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subsubcategory_id"]').html('');
                            var d = $('select[name="subsubcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subsubcategory_id"]').append('<option value="' +
                                    value.id + '">' + value.subsubcategory_name_fr + '</option>'
                                    );
                            });
                        }, //End Of Retrieve Data
                    }); //End Of Ajax Script
                } else {
                    alert('danger');
                } //End Of Condition
            });
        </script>

        <!--===============================
    JS SCRIPT TO PREVIEW THAMBNAIL IMAGE
    ================================-->

        <script type="text/javascript">
            function mainThamUrl(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
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

        <!--===============================
    AJAX JS SCRIPT FOR ADD MULTIPLE SPECIFICATIONS
    ================================-->

        <script type="text/javascript">
            $(document).ready(function() {
                var counter = 0;
                $(document).on('click', '.addeventmore', function() {
                    var extra_item_to_add = $("#extra_item_to_add").html();
                    $('.add_item').append(extra_item_to_add);
                    counter++;
                }); //End to add item
                $(document).on('click', '.removeeventmore', function() {
                    $(this).closest(".delete_extra_item_to_add").remove();
                    counter--
                }); //End remove item
            }); //End Initialize Jquery Script
        </script>
    @endsection

    @push('scripts')
        <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

        <script>
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            };
        </script>

        <script>
            CKEDITOR.replace('my-editor', options);
            CKEDITOR.replace('my-editor2', options);
        </script>
    @endpush
