@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Editer formation
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
                        <h4 class="box-title">Modifier une formation</h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('formation.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $formation->id }}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Nom de L'auteur<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="author" class="form-control"
                                                value="{{ $formation->author }}" required
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
                                            <input type="text" name="link" class="form-control"
                                                value="{{ $formation->payment_link }}" required
                                                oninvalid="this.setCustomValidity('Saisir un commentaire')"
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
                                            <input type="text" name="price" class="form-control"
                                                value="{{ $formation->price }}" required
                                                oninvalid="this.setCustomValidity('Saisir un commentaire')"
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
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $formation->category_id ? 'selected' : '' }}>
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

                                            <img src="{{ asset($formation->thumbnail) }}" alt="AgenceDigitals"
                                                id="showImg">

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
                                                oninput="this.setCustomValidity('')" value="{{ $formation->name }}">
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
                                               {!! $formation->desc !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->

                            </div> <!-- end 7th row  -->

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info"
                                    value="Mettre à jour la formation">
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
