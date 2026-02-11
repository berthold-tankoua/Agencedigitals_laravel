@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Nos Services
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Liste des Services <span
                                class="badge badge-danger badge-pill">{{ count($services) }}</span> </h3>
                        <a class="badge badge-primary float-right" href="{{ route('add.service.view') }}">Ajouter un
                            service</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>


                                        <th>Service </th>

                                        <th>Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $item)
                                        <tr>

                                            <td>{{ $item->service_name_fr }}</td>


                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-pill badge-success"> Active </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"> InActive </span>
                                                @endif
                                            </td>
                                            <td width="10%" style="text-align: center !important;">
                                                <a href="{{ route('service.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-pencil" title="Edit Service"></i> </a>
                                                <a href="{{ route('service.delete', $item->id) }}"
                                                    class="btn btn-danger btn-sm" id="delete"
                                                    style="margin-bottom:5px"><i class="fa fa-trash"
                                                        title="Delete Service"></i></a>
                                                @if ($item->status == 1)
                                                    <a href="{{ route('service.inactive', $item->id) }}"
                                                        class="btn btn-danger btn-sm" title="Inactive Now"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-down"></i> </a>
                                                @else
                                                    <a href="{{ route('service.active', $item->id) }}"
                                                        class="btn btn-success btn-sm" title="Active Now"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-up"></i> </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>
@endsection
