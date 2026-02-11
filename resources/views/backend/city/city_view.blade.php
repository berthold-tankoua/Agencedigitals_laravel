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

            <div class="col-8">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Ville List</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Ville</th>
                                        <th>Image</th>
                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cities as $item)
                                        <tr>
                                            <td>{{ $item->city_name_fr }}</td>
                                            <td style="text-align: center !important;"><img
                                                    src="{{ asset($item->image) }}" style="width: 100px;height: 100px;">
                                            </td>
                                            <td width="30%" style="text-align: center !important;">
                                                <a href="{{ route('city.edit', $item->id) }}" class="btn btn-info"
                                                    style="margin-right: 5px;"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('city.delete', $item->id) }}" id="delete"
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
                ADD city SECTION
                =========================================-->
            <div class="col-4">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Ajouter une ville </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('city.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <h5>Nom de la ville <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="city_name_fr" class="form-control" required
                                        oninvalid="this.setCustomValidity('Saisir le nom de la ville')"
                                        oninput="this.setCustomValidity('')">
                                    @error('city_name_fr')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="image" class="form-control" required
                                        oninvalid="this.setCustomValidity('Ajouter une image')"
                                        oninput="this.setCustomValidity('')">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Ajouter une Ville">
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
