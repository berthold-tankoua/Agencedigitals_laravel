@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Ville
@endsection

<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Editer une Ville </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('city.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $city->id }}">
                            <input type="hidden" name="old_img" value="{{ $city->image }}">
                            <div class="form-group">
                                <h5>Nom de la ville <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="city_name_fr" class="form-control"
                                        value="{{ $city->city_name_fr }}">
                                    @error('city_name_fr')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="image" class="form-control" value="">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Mettre a Jour">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

<!-- /.content-wrapper -->
@endsection
