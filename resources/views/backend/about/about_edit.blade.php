@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | A propos
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Editer </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <input type="hidden" name="id" value="{{ $about->id }}">
                            <input type="hidden" name="old_img" value="{{ $about->about_img }}">
                            <div class="form-group">
                                <h5> Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" id="image" name="about_img" class="form-control">

                                    <img src="" alt="AgenceDigitals" id="showImg">

                                    @error('about_img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Localisation <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="localisation" class="form-control"
                                                value="{{ $about->localisation }}">
                                            @error('localisation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Contact WhatsApp <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ $about->phone }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Email <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="email" class="form-control"
                                                value="{{ $about->email }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Qui Sommes nous.? <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor1" name="about_desc" id="textarea" class="form-control" required>
                                                    {!! $about->about_desc !!}
                                                </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Notre Vision <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor2" name="vision_desc" id="textarea" class="form-control" required rows="15">
                                                    {!! $about->vision_desc !!}
                                                </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Notre Mission <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor3" name="mission_desc" id="textarea" class="form-control" required>
                                                    {!! $about->mission_desc !!}
                                                </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Nos Avantages <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor6" name="advantage" id="textarea" class="form-control" required>
                                                    {!! $about->advantage !!}
                                                </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Termes & Conditions <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor4" name="term_condition" id="textarea" class="form-control" required>
                                                    {!! $about->term_condition !!}
                                                </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Mentions Legales <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor5" name="legal_mention" id="textarea" class="form-control" required rows="20">
                                                    {!! $about->legal_mention !!}
                                                </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 7th row  -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Facebook link <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="flink" class="form-control"
                                                value="{{ $about->facebook_link }}">
                                            @error('flink')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Instagram link <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="ilink" class="form-control"
                                                value="{{ $about->instagram_link }}">
                                            @error('ilink')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Tiktok Link <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="tlink" class="form-control"
                                                value="{{ $about->twitter_link }}">
                                            @error('tlink')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
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

<script>
    CKEDITOR.replace('editor1', options);
    CKEDITOR.replace('editor2', options);
    CKEDITOR.replace('editor3', options);
    CKEDITOR.replace('editor4', options);
    CKEDITOR.replace('editor5', options);
    CKEDITOR.replace('editor6', options);
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
