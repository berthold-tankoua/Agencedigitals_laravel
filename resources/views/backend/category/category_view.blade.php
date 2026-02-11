@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Nos Categories
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Categorie List <span
                                class="badge badge-danger badge-pill">{{ count($categories) }}</span> </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Categorie FR</th>
                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $item)
                                        <tr>
                                            <td style="text-align: center !important;"><img
                                                    src="{{ asset($item->category_image) }}" alt="category image"
                                                    style="width: 10; height: 100px;"></td>
                                            <td>{{ $item->category_name_fr }}</td>
                                            <td style="text-align: center !important;">
                                                <a href="{{ route('category.edit', $item->id) }}" class="btn btn-info"
                                                    style="margin-right: 5px;"><i class="fa fa-pencil"></i></a>
                                                {{-- <a href="{{route('category.delete',$item->id)}}" id="delete" class="btn btn-danger" ><i class="fa fa-trash"></i></a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- /.col-md-6 1 end -->


            <!--========================================
            ADD CATEGORY SECTION
            =========================================-->
            <div class="col-4">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Ajouter Categorie </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Nom de la Categorie<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_name_fr" class="form-control" required
                                        oninvalid="this.setCustomValidity('Saisir le nom de la categorie')"
                                        oninput="this.setCustomValidity('')">
                                    @error('category_name_fr')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Categorie Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" id="image" name="category_image" class="form-control"
                                        required oninvalid="this.setCustomValidity('Ajouter une image')"
                                        oninput="this.setCustomValidity('')">

                                    <img src="" alt="AgenceDigitals" id="showImg">

                                    @error('category_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Ajouter une categorie">
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
