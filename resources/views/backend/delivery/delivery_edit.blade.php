@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Editer Livreur
@endsection


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">

            <div class="box-header with-border">
                <h4 class="box-title">Editer un Livreur </h4>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('update.delivery') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="id" value="{{ $delivery->id }}">
                            <input type="hidden" name="old_img" value="{{ $delivery->image }}">

                            <div class="row">

                                <div class="col-12">

                                    <div class="row"> <!-- start 1st row  -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Nom du livreur<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $delivery->name }}">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5> Image de Profil <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="image" class="form-control"
                                                        onChange="mainThamUrl(this)">
                                                    @error('image')
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
                                                    <input type="text" name="contact" class="form-control"
                                                        value="{{ $delivery->phone }}">
                                                    @error('contact')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5> Email <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="email" class="form-control"
                                                        value="{{ $delivery->email }}">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5> Adresse <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="adress" class="form-control"
                                                        value="{{ $delivery->adress }}">
                                                    @error('adress')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 2nd row  -->

                                    <div class="row"> <!-- start 7th row  -->

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5> Description <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor4" name="descp" id="textarea" class="form-control" required>
                                                            {!! $delivery->descp !!}
                                                        </textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                    </div> <!-- end 7th row  -->


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



    <div><!-- end section  -->


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
