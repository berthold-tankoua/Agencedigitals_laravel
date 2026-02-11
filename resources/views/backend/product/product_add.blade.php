@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Ajouter un Produit
@endsection


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">

            <div class="box-header with-border">
                <h4 class="box-title">Ajouter Produit </h4>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('add.product.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                <div class="col-12">

                                    <div class="row"> <!-- start 1st row  -->

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Choisir une Compagnie <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="store_id" class="form-control">
                                                        <option value="" selected disabled="">Choisir une
                                                            Compagnie</option>
                                                        @foreach ($stores as $store)
                                                            <option value="{{ $store->id }}">{{ $store->store_name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('store_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Choisir une categorie<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control">
                                                        <option value="" selected="" disabled="">Selection
                                                            de categorie</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->category_name_fr }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col md 4 -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Nom du Produit <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name"
                                                        placeholder="Saisir le nom du produit" class="form-control">
                                                    @error('product_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 2nd row  -->
                                    <hr>
                                    <div class="row"> <!-- start 3RD row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Prix de vente FCFA<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="number" name="selling_price" class="form-control"
                                                        placeholder="saisir Prix de vente ">
                                                    @error('selling_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Prix Promo<span class="text-danger">(optionnel)</span></h5>
                                                <div class="controls">
                                                    <input type="number" name="discount_price" class="form-control"
                                                        placeholder="saisir le prix de promotion">
                                                    @error('discount_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Choisir une Action <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="action_type" class="form-control" required
                                                        oninvalid="this.setCustomValidity('Selectionner une action')"
                                                        oninput="this.setCustomValidity('')">
                                                        <option value="" selected="" disabled="">
                                                            Selectionner une Action</option>
                                                        <option value="" selected>FCFA</option>
                                                        <option value="/m<sup>2</sup>">FCFA/m<sup>2</sup></option>
                                                        <option value="/m<sup>2</sup>">FCFA/m<sup>2</sup></option>
                                                        <option value="/m<sup>lineaire</sup>">FCFA/m<sup>lineaire</sup>
                                                        </option>
                                                    </select>
                                                    @error('action_type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h5>Quantite <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="number" name="product_qty" value="1000"
                                                        class="form-control">
                                                    @error('product_qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Tags Fr <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags" class="form-control"
                                                        value="Produit" data-role="tagsinput">
                                                    @error('product_tags')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Taille Fr <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size" class="form-control"
                                                        value="Aucune" data-role="tagsinput">
                                                    @error('product_size')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Couleur Fr <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color" class="form-control"
                                                        value="Aucune" data-role="tagsinput">
                                                    @error('product_color')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Youtube Link </h5>
                                                <div class="controls">
                                                    <input type="text" name="video_link" class="form-control"
                                                        placeholder="coller lien videoYoutube ">
                                                    @error('video_link')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                    </div> <!-- end 5th row  -->
                                    <hr>
                                    <div class="row"> <!-- start 6th row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Ajouter une video <span class="text-danger">(optionnel)</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="product_video" class="form-control">
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Image Thambnail <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="product_thambnail"
                                                        class="form-control" onChange="mainThamUrl(this)">
                                                    @error('product_thambnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->


                                        <div class="col-md-4">
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

                                    </div> <!-- end 6th row  -->
                                    <hr>
                                    <div class="row"> <!-- start 7th row  -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Description <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="short_descp" style="height: 65px;"
                                                        class="form-control" placeholder="Description">
                                                    @error('short_descp')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Description Fr <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor4" name="long_descp" id="textarea" class="form-control" required>
                                                        Long Description French
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                    </div> <!-- end 7th row  -->

                                    <div class="row"> <!-- 9th row  -->

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <h5>Specification <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="spec_title[]" class="form-control"
                                                        placeholder="titre">
                                                </div>
                                            </div>
                                        </div> <!-- col-md-5//  -->

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <h5>Specification Description <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="spec_desc[]" class="form-control"
                                                        placeholder="description">
                                                </div>
                                            </div>
                                        </div> <!-- col-md-5//  -->

                                        <div class="col-md-2" style="margin-top: 27px !important;">
                                            <span class="btn btn-success btn-md addeventmore">
                                                <i class="fa fa-plus-circle"></i>
                                            </span>
                                        </div> <!-- col-md-2//  -->

                                    </div> <!-- end 9th row  -->

                                    <div class="add_item">

                                    </div> <!-- /.add_item -->

                                    <hr>

                                    <div class="row"> <!-- 10th row  -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_1" name="top_20"
                                                            value="1">
                                                        <label for="checkbox_1">Top 20</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_3" name="special_deals"
                                                            value="2">
                                                        <label for="checkbox_3">Special Deals</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 10th row  -->


                                </div> <!-- end col 12  -->

                                <div> <!-- end row  -->

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info"
                                            value="Ajouter un Produit">
                                    </div>

                        </form> <!-- end form -->

                        <div> <!-- end col  -->
                            <div> <!-- end row  -->

                                <div> <!-- end box-body  -->

                                    <div> <!-- end box  -->

    </section> <!-- end section  -->


    <div style="visibility: hidden;">

        <div class="extra_item_to_add" id="extra_item_to_add">

            <div class="delete_extra_item_to_add" id="delete_extra_item_to_add">

                <div class="row"> <!-- 10th row  -->

                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>Specification Title <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="spec_title[]" class="form-control">
                            </div>
                        </div>
                    </div> <!-- col-md-5//  -->

                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>Specification Description <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="spec_desc[]" class="form-control">
                            </div>
                        </div>
                    </div> <!-- col-md-5//  -->

                    <div class="col-md-2" style="margin-top: 27px !important;">
                        <span class="btn btn-success btn-md addeventmore">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        <span class="btn btn-danger btn-md removeeventmore">
                            <i class="fa fa-minus-circle"></i>
                        </span>
                    </div> <!-- col-md-2//  -->

                </div> <!-- end 10th row  -->

            </div>

        </div>

    </div>

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
                                    .id + '">' + value.subcategory_name + '</option>');
                            });
                        }, //End Of Retrieve Data
                    }); //End Of Ajax Script
                } else {
                    alert('danger');
                } //End Of Condition
            });

            // DEPENDENT DROPDOWN  FOR SubSubCategory

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
                                    value.id + '">' + value.subsubcategory_name + '</option>');
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
