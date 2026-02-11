@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Slider-Principal
@endsection



<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Editer Slider </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('slider.update') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <input type="hidden" name="id" value="{{ $slider->id }}">
                            <input type="hidden" name="old_img_1" value="{{ $slider->slider_image_1 }}">
                            <input type="hidden" name="old_img_2" value="{{ $slider->slider_image_2 }}">
                            <div class="row">

                                <div class="col-md-8">

                                    <div class="form-group">
                                        <h5>Titre Principal <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="slider_title" class="form-control"
                                                value="{{ $slider->slider_title }}">
                                            @error('slider_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div> <!-- /.col-md-6 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Selectionner une taille ou police <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="font_size" class="form-control" required
                                                oninvalid="this.setCustomValidity('Selectionner une taille')"
                                                oninput="this.setCustomValidity('')">
                                                <option value="" selected="" disabled="">Selectionner taille
                                                </option>
                                                <option selected value="{{ $slider->font_size }}">
                                                    {{ $slider->font_size }}</option>
                                                <option value="h1">
                                                    <h1>h1 (plus grande taille)</h1>
                                                </option>
                                                <option value="h2">
                                                    <h2>h2</h2>
                                                </option>
                                                <option value="h3">
                                                    <h3>h3</h3>
                                                </option>
                                                <option value="h4">
                                                    <h4>h4</h4>
                                                </option>
                                                <option value="h5">
                                                    <h5>h5</h5>
                                                </option>
                                                <option value="h6">
                                                    <h6>h6 (plus petite taille)</h6>
                                                </option>

                                            </select>
                                            @error('font_size')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Titre secondaire 1<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="slider_small1" class="form-control"
                                                value="{{ $slider->slider_small1 }}">
                                            @error('slider_small1')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- /.col-md-6 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Titre secondaire 2<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="slider_small2" class="form-control"
                                                value="{{ $slider->slider_small2 }}">
                                            @error('slider_small2')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- /.col-md-6 -->


                            </div> <!-- /.row 1 -->


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Description <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="slider_desc" class="form-control"
                                                value="{{ $slider->slider_desc }}">
                                            @error('slider_desc')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <h5>Image principal <span class="text-danger"> Dimension (1900x900px)</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="file" id="img" name="slider_image_1"
                                                class="form-control">
                                            @error('slider_image_1')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                </div> <!-- /.col-md-6 -->
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <h5>Image secondaire <span class="text-danger"> Dimension (1900x900px)</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="file" id="img" name="slider_image_2"
                                                class="form-control">
                                            @error('slider_image_2')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                </div> <!-- /.col-md-6 -->
                            </div> <!-- /.row 2 -->


                            <br>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Mettre a jour">
                            </div>

                        </form>
                        <!-- /.form -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<!--=================================
    JS SCRIPT TO PREVIEW SLIDER
    ==================================-->

<script type="text/javascript">
    $(document).ready(function() {

        $('#image').change(function(e) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $("#showImg").attr("src", e.target.result).width(80).height(80);
            }

            reader.readAsDataURL(e.target.files[0]);

        });

    });
</script>
@endsection
