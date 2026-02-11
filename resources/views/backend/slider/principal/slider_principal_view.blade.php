@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Slider-Principal
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!--========================================
            VIEW SLIDER DETAILS
            =========================================-->
            <!--========================================
            ADD SLIDER SECTION
            =========================================-->
            <div class="col-12">
                <div class="box">

                    <div class="box-header">
                        <h4 class="box-title">Ajouter un Slider </h4>
                    </div>

                    <div class="box-body">

                        <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5> Titre Principal<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="slider_title" class="form-control" required>
                                            @error('slider_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- /.col-md-6 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Titre secondaire <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="slider_small" class="form-control"
                                                value="">
                                            @error('slider_small')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- /.col-md-6 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Lien <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="slider_link" class="form-control"
                                                value="">
                                            @error('slider_link')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- /.col-md-6 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Description <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="slider_desc" id="textarea" class="form-control" required>
                                                 Description
                                            </textarea>
                                            @error('slider_desc')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- /.row 1 -->


                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <h5>Slider Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" id="img" name="slider_image_1"
                                                class="form-control" required>
                                            @error('slider_image_1')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <img src="" id="showImg" alt="AgenceDigitals">
                                        </div>
                                    </div>

                                </div> <!-- /.col-md-6 -->

                            </div> <!-- /.row 2 -->

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Ajouter le Slider">
                            </div>
                        </form>
                        <!-- /.form -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-12">
                <div class="box">

                    <div class="box-header">
                        <h4 class="box-title">Slider List <span
                                class="badge badge-danger badge-pill">{{ count($sliders) }}</span> </h4>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">

                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Titre</th>
                                        <th>Description </th>
                                        <th>Status</th>
                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sliders as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($item->slider_image_1) }}"
                                                    style="width: 120px;height: 70px;"></td>
                                            <td>{{ $item->slider_title }}</td>
                                            <td>{{ $item->slider_desc }}</td>

                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-pill badge-success"> Active </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"> InActive </span>
                                                @endif
                                            </td>
                                            <td width="10%" style="text-align: center !important;">
                                                <a href="{{ route('slider.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-pencil" title="Edit Slider"></i></a>
                                                <a href="{{ route('slider.delete', $item->id) }}" id="delete"
                                                    class="btn btn-danger btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-trash" title="Delete Slider"></i></a>
                                                @if ($item->status == 1)
                                                    <a href="{{ route('slider.inactive', $item->id) }}"
                                                        class="btn btn-danger btn-sm" title="Inactive Now"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-down"></i> </a>
                                                @else
                                                    <a href="{{ route('slider.active', $item->id) }}"
                                                        class="btn btn-success btn-sm" title="Active Now"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-up"></i> </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.col-12 -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function() {

        $('#img').change(function(e) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $("#showImg").attr("src", e.target.result).width(100).height(100);
            }

            reader.readAsDataURL(e.target.files[0]);

        });

    });
</script>
@endsection
