@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Annonce
@endsection



<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Editer Annonce </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('update.annonce') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $annonce->id }}">
                            <div class="form-group">
                                <h5>Selectionner une Categorie <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="category_id" class="form-control" required
                                        oninvalid="this.setCustomValidity('Selectionner une categorie')"
                                        oninput="this.setCustomValidity('')">
                                        <option value="{{ $annonce->category_id }}" selected>
                                            {{ $annonce->category->category_name_fr }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name_fr }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Titre<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="titre" class="form-control"
                                        value="{{ $annonce->titre }}">
                                    @error('titre')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Localisation<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="location" class="form-control"
                                        value="{{ $annonce->location }}">
                                    @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Description <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <textarea id="editor4" name="desc" id="textarea" class="form-control">
                                            {!! $annonce->desc !!}
                                        </textarea>
                                    @error('desc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Mettre a jour">
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
