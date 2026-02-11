@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Editer un Produit
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">

            <div class="box-header with-border">
                <h4 class="box-title">Editer un Produit </h4>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div class="row">
                    <div class="col">

                        <form method="post" action="{{ route('product.update') }}" enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                <div class="col-12">
                                    <input type="hidden" name="store_id" value="{{ $product->store_id }}">

                                    <input type="hidden" name="id" value="{{ $product->id }}">

                                    <div class="row"> <!-- start 1st row  -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Choisir une Compagnie <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="store_id" class="form-control">
                                                        <option value="" selected disabled="">Choisir une
                                                            Compagnie</option>
                                                        @foreach ($stores as $store)
                                                            <option value="{{ $store->id }}"
                                                                {{ $store->id == $product->store_id ? 'selected' : '' }}>
                                                                {{ $store->store_name }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('store_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Choix de la categorie<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control">
                                                        <option value="" selected="" disabled="">Choisir une
                                                            categorie</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                                {{ $category->category_name_fr }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <h5>Nom du Produit <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name" class="form-control"
                                                        value="{{ $product->product_name }}">
                                                    @error('product_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 1st row  -->
                                    <hr>
                                    <div class="row"> <!-- start 5th row  -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Prix de vente <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price" class="form-control"
                                                        value="{{ $product->selling_price }}">
                                                    @error('selling_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Prix promo<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price" class="form-control"
                                                        value="{{ $product->discount_price }}">
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

                                                        <option value="{{ $product->action_type }}" selected disabled>
                                                            FCFA{!! $product->action_type !!}</option>
                                                        <option value="">FCFA</option>
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
                                                <h5> Quantite <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_qty" class="form-control"
                                                        value="{{ $product->product_qty }}">
                                                    @error('product_qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 5th row  -->
                                    <hr>
                                    <div class="row"> <!-- start 4th row  -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Tags Fr <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags" class="form-control"
                                                        value="{{ $product->product_tags }}" data-role="tagsinput">
                                                    @error('product_tags_hin')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Taille <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size" class="form-control"
                                                        value="{{ $product->product_size }}" data-role="tagsinput">
                                                    @error('product_size')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Couleur <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color" class="form-control"
                                                        value="{{ $product->product_color }}" data-role="tagsinput">
                                                    @error('product_color')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 4th row  -->
                                    <hr>
                                    <div class="row"> <!-- start 6th row  -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Image Principal <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="hidden" name="old_image" class="form-control"
                                                        value="{{ $product->product_thambnail }}">
                                                    <input type="file" name="product_thambnail"
                                                        class="form-control" onChange="mainThamUrl(this)">
                                                    @error('product_thambnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Multiple Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="multi_img[]" class="form-control"
                                                        multiple="" id="multiImg">
                                                    @error('multi_img')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="row" id="preview_img"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 6th row  -->

                                    <div class="row"> <!-- start 7th row  -->


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Courte Description <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp" id="textarea" class="form-control" required>
                                                        {{ $product->short_descp }}
                                                        </textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Longue Description <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor2" name="long_descp" rows="10" cols="80">
                                                        {!! $product->long_descp !!}
                                                        </textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                    </div> <!-- end 7th row  -->

                                    <hr>

                                    <div class="row"> <!-- 9th row  -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_5" name="top_20"
                                                            value="1">
                                                        <label for="checkbox_5">Top 20</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_5" name="special_deals"
                                                            value="1">
                                                        <label for="checkbox_5">Special Deals</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 9th row  -->

                                </div> <!-- end col-12  -->

                            </div>
                            <!-- end row -->

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                    value="Mettre a jour le produit">
                            </div>

                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>


<!--===============================
    AJAX JS SCRIPT DEPENDANT DROPDOWN
    ================================-->

<script type="text/javascript">
    // DEPENDENT DROPDOWN FOR SUBCATEGORY

    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subsubcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subcategory_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        // DEPENDENT DROPDOWN  FOR subsubcategory

        $('select[name="subcategory_id"]').on('change', function() {
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{ url('/category/sub-subcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subsubcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subsubcategory_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

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
@endsection
