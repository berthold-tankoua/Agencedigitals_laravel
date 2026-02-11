@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Pourquoi nous choisir
@endsection



<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Editer les informations</h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('choose.us.update') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="old_img" value="{{ $item->slider_image }}">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <h5> Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" id="image" name="slider_image"
                                                class="form-control">

                                            @error('slider_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <img src="{{ asset($item->slider_image) }}" style="width: 100px;height: 135px;">
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Presentation ou Description</h5>
                                        <div class="controls">
                                            <textarea name="description" id="textarea" class="form-control" required rows="5">
                                                    {{ $item->description }}
                                                </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 7th row  -->
                            <hr>

                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-12">
                                    <h5>icone</h5>
                                    <div class="form-group">
                                        <input type="text" name="icon" class="form-control me-2"
                                            value="{{ $item->icon }}">
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 7th row  -->
                            <br>
                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-4">
                                    <h5>Element</h5>
                                    <div class="form-group">
                                        <input type="text" name="desc1" class="form-control me-2"
                                            value="{{ $item->desc1 }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Element 2</h5>
                                    <div class="form-group">
                                        <input type="text" name="desc2" class="form-control me-2"
                                            value="{{ $item->desc2 }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Element 3</h5>
                                    <div class="form-group">
                                        <input type="text" name="desc3" class="form-control me-2"
                                            value="{{ $item->desc3 }}">
                                    </div>
                                </div>
                            </div> <!-- end 7th row  -->
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

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>

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
