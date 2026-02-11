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
            <!--========================================
            ADD annonce SECTION
            =========================================-->
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Ajouter Annonce </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('annonce.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Selectionner un Utilisateur <span class="text-danger">(Optionnel)</span></h5>
                                <div class="controls">
                                    <select name="user_id" class="form-control">
                                        <option value="" selected="" disabled="">Selectionner un utilisateur
                                        </option>
                                        @php
                                            $users = App\Models\User::orderBy('id', 'DESC')->get();
                                        @endphp
                                        @foreach ($users as $item)
                                            <option value="{{ $item->user_id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Selectionner une Categorie <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="category_id" class="form-control" required
                                        oninvalid="this.setCustomValidity('Selectionner une categorie')"
                                        oninput="this.setCustomValidity('')">
                                        <option value="" selected="" disabled="">Selectionner Categorie
                                        </option>
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
                                    <input type="text" name="titre" class="form-control" required
                                        oninvalid="this.setCustomValidity('Saisir le titre')"
                                        oninput="this.setCustomValidity('')">
                                    @error('titre')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Localisation<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="location" class="form-control" required
                                        oninvalid="this.setCustomValidity('Saisir le nom de la categorie')"
                                        oninput="this.setCustomValidity('')">
                                    @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Description <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <textarea id="editor4" name="desc" id="textarea" class="form-control">
                                        Petite Description
                                    </textarea>
                                    @error('desc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Ajouter une annonce">
                            </div>
                        </form>
                    </div>
                </div> <!-- /.box -->
            </div> <!-- /.col-12 2 end -->

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Annonce List <span
                                class="badge badge-danger badge-pill">{{ count($annonces) }}</span> </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Desc</th>
                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($annonces as $item)
                                        <tr>
                                            <td>{{ $item->titre }}</td>
                                            <td>{{ $item->desc }}</td>
                                            <td style="text-align: center !important;">
                                                <a href="{{ route('annonce.edit', $item->id) }}" class="btn btn-info"
                                                    style="margin-right: 5px;"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('annonce.delete', $item->id) }}" id="delete"
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
