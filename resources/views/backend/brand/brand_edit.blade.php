@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Marque
@endsection

<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Editer une Marque </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('brand.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $brand->id }}">
                            <div class="form-group">
                                <h5>brand Name FR <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="brand_name_fr" class="form-control"
                                        value="{{ $brand->brand_name_fr }}">
                                    @error('brand_name_fr')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Brand Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="brand_image" class="form-control" value="">
                                    @error('brand_image')
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
