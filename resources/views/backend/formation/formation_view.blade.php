@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Formation
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!--========================================
            ADD CATEGORY SECTION
            =========================================-->

            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h2 class="box-title">Formation</h2>
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
                                    @foreach ($formations as $item)
                                        <tr>
                                            <td><img src="{{ asset($item->thumbnail) }}"
                                                    style="width: 100%; height: 66px;"> </td>

                                            <td>
                                                <p><strong>Auteur:</strong> {{ $item->author }}</p>

                                                <p><strong>Titre:</strong> {{ $item->name }}</p>
                                            </td>

                                            <td style="text-align: center !important;">
                                                <a href="{{ route('formation.edit', $item->id) }}" class="btn btn-info"
                                                    style="margin-right: 5px;"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('formation.delete', $item->id) }}" id="delete"
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

            <div class="col-4">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Ajouter une formation</h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('formation.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Url paiement<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="link" class="form-control" value="Aucune"
                                                required oninvalid="this.setCustomValidity('Saisir un commentaire')"
                                                oninput="this.setCustomValidity('')">
                                            @error('link')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>prix<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="price" class="form-control" value="Aucune"
                                                required oninvalid="this.setCustomValidity('Saisir un commentaire')"
                                                oninput="this.setCustomValidity('')">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Choisir une categorie<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control" required
                                                oninvalid="this.setCustomValidity('Selectionner une categorie')"
                                                oninput="this.setCustomValidity('')">
                                                <option value="" selected="" disabled="">Selection de
                                                    categorie</option>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5> Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" id="image" name="thumbnail" class="form-control"
                                                required oninvalid="this.setCustomValidity('Ajouter une image')"
                                                oninput="this.setCustomValidity('')">

                                            <img src="" alt="AgenceDigitals" id="showImg">

                                            @error('thumbnail')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Titre Principal<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" required
                                                oninvalid="this.setCustomValidity('Saisir le titre principal')"
                                                oninput="this.setCustomValidity('')">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Description <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor3" name="desc" id="textarea" class="form-control" required>
                                               Petite Description French
                                            </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->

                            </div> <!-- end 7th row  -->

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Publier la formation">
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
                $("#showImg").attr("src", e.target.result).width(100).height(60);
            }

            reader.readAsDataURL(e.target.files[0]);

        });

    });
</script>
@endsection
