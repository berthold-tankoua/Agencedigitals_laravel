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

            <div class="col-8">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Marque List</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Brand FR</th>
                                        <th>Image</th>
                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $item)
                                        <tr>
                                            <td>{{ $item->brand_name_fr }}</td>
                                            <td><img src="{{ url('upload/brands/' . $item->brand_image) }}"
                                                    style="width: 70px;height: 40px;"></td>
                                            <td width="30%" style="text-align: center !important;">
                                                <a href="{{ route('brand.edit', $item->id) }}" class="btn btn-info"
                                                    style="margin-right: 5px;"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('brand.delete', $item->id) }}" id="delete"
                                                    class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--========================================
                ADD BRAND SECTION
                =========================================-->
            <div class="col-4">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Add Brand </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <h5>brand Name FR <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="brand_name_fr" class="form-control" value="">
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
                                <input type="submit" class="btn btn-rounded btn-info" value="Ajouter une Marque">
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
@endsection
