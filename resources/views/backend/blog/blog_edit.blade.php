@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Blog
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!--========================================
            ADD BLOG SECTION
            =========================================-->
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Editer </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('blog.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $blog->id }}">
                            <input type="hidden" name="old_img" value="{{ $blog->blog_img }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Nom de L'auteur<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="author" class="form-control"
                                                value="{{ $blog->author }}">
                                            @error('author')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Commentaire de l'auteur<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="author_note" class="form-control"
                                                value="{{ $blog->author_note }}">
                                            @error('author_note')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5> Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" id="image" name="blog_img" class="form-control">

                                    <img src="" alt="AgenceDigitals" id="showImg">

                                    @error('blog_img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Titre Principal<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="title1" class="form-control"
                                        value="{{ $blog->title1 }}">
                                    @error('title1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Description <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor3" name="short_desc" id="textarea" class="form-control" required>
                                               {!! $blog->short_desc !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>TEXTE <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor4" name="long_desc" id="textarea" class="form-control" required>
                                                {!! $blog->long_desc !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 7th row  -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Tags <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="tags" class="form-control"
                                            value="{{ $blog->tags }}" data-role="tagsinput">
                                        @error('tags')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Mettre a Jour">
                            </div>
                        </form>
                    </div>
                </div> <!-- /.box -->
            </div> <!-- /.col-12 2 end -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

<!-- /.content-wrapper -->


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
