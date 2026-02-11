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
            ADD CATEGORY SECTION
            =========================================-->
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Ajouter un article </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Nom de L'auteur<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="author" class="form-control"
                                                value="AgenceDigitals" required
                                                oninvalid="this.setCustomValidity('Saisir le nom de l auteur')"
                                                oninput="this.setCustomValidity('')">
                                            @error('author')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Commentaire de l'auteur<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="author_note" class="form-control" value="Aucune"
                                                required oninvalid="this.setCustomValidity('Saisir un commentaire')"
                                                oninput="this.setCustomValidity('')">
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
                                    <input type="file" id="image" name="blog_img" class="form-control" required
                                        oninvalid="this.setCustomValidity('Ajouter une image')"
                                        oninput="this.setCustomValidity('')">

                                    <img src="" alt="AgenceDigitals" id="showImg">

                                    @error('blog_img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Titre Principal<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="title1" class="form-control" required
                                        oninvalid="this.setCustomValidity('Saisir le titre principal')"
                                        oninput="this.setCustomValidity('')">
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
                                               Petite Description French
                                            </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>TEXTE <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor4" name="long_desc" id="textarea" class="form-control" required>
                                                Texte French
                                            </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 7th row  -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Tags <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="tags" class="form-control" value="Aucun"
                                            data-role="tagsinput">
                                        @error('tags')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Publier le blog">
                            </div>
                        </form>
                    </div>
                </div> <!-- /.box -->
            </div> <!-- /.col-12 2 end -->

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Article </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Image</th>

                                        <th>Informations</th>


                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $item)
                                        <tr>
                                            <td><img src="{{ asset($item->blog_img) }}"
                                                    style="width: 60px; height: 50px;"> </td>


                                            <td>
                                                <p><strong>Auteur:</strong> {{ $item->author }}</p>
                                                <p><strong>Date:</strong> {{ $item->type }}</p>
                                                <p><strong>Titre:</strong> {{ $item->title }}</p>
                                            </td>

                                            <td style="text-align: center !important;">
                                                <a href="{{ route('blog.edit', $item->id) }}" class="btn btn-info"
                                                    style="margin-right: 5px;"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('blog.delete', $item->id) }}" id="delete"
                                                    class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- /.col-md-6 1 end -->
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
