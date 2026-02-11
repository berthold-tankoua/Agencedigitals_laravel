@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Editer Compagnie
@endsection


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">

            <div class="box-header with-border">
                <h4 class="box-title">Editer une compagnie </h4>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('update.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="id" value="{{ $store->id }}">
                            <input type="hidden" name="old_img" value="{{ $store->store_thambnail }}">

                            <div class="row">

                                <div class="col-12">

                                    <div class="row"> <!-- start 1st row  -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Nom de L' <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="store_name" class="form-control"
                                                        value="{{ $store->store_name }}">
                                                    @error('store_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5> Image de Profil <span class="text-danger">*</span></h5>
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

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5> Contact <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="store_contact" class="form-control"
                                                        value="{{ $store->store_contact }}">
                                                    @error('store_contact')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5> Email <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="store_email" class="form-control"
                                                        value="{{ $store->store_email }}">
                                                    @error('store_email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5> Adresse <span class="text-danger">*</span></h5>
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

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5> Description French <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor4" name="store_descp_fr" id="textarea" class="form-control" required>
                                                            {!! $store->store_descp_fr !!}
                                                        </textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                    </div> <!-- end 7th row  -->
                                    @php
                                        $socials = App\Models\SocialNetwork::where('store_id', $store->id)->get();
                                    @endphp
                                    @foreach ($socials as $item)
                                        <div class="row"> <!-- 9th row  -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Nom du reseau social <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="spec_title[]" class="form-control"
                                                            value="{{ $item->network_name }}">
                                                    </div>
                                                </div>
                                            </div> <!-- col-md-5//  -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Reseau social Lien <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="spec_desc[]" class="form-control"
                                                            value="{{ $item->network_link }}">
                                                    </div>
                                                </div>
                                            </div> <!-- col-md-5//  -->

                                        </div> <!-- end 9th row  -->
                                    @endforeach
                                    <div class="add_item">

                                    </div> <!-- /.add_item -->

                                    <hr>

                                </div> <!-- end col 12  -->

                                <div> <!-- end row  -->

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Mettre a jour">
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
