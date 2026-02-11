@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Nos emplois
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
                        <h3 class="box-title">Liste des Emplois <span
                                class="badge badge-danger badge-pill">{{ count($jobs) }}</span> </h3>
                        <a class="btn btn-primary float-right " href="{{ route('add.job.view') }}">Ajouter un emploi</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image </th>

                                        <th>Information </th>
                                        <th>Candidature </th>

                                        <th>Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $item)
                                        <tr>
                                            <td> <img src="{{ asset($item->job_thambnail) }}"
                                                    style="width: 80px; height: 50px;"> </td>

                                            <td>
                                                <p><strong>Poste: </strong> {{ $item->job_name }}</p>
                                                <p><strong>Lieux: </strong> {{ $item->localisation }}</p>
                                            </td>
                                            @php
                                                $count = App\Models\CareerApply::where('career_id', $item->id)->get();
                                            @endphp
                                            <td>
                                                <p><Strong>{{ count($count) }}</Strong> Candidat(s)</p>
                                            </td>

                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-pill badge-success"> Active </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"> InActive </span>
                                                @endif
                                            </td>
                                            <td width="10%" style="text-align: center !important;">
                                                <a href="{{ route('job.apply.view', $item->id) }}"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-eye" title="Afficher les candidatures"></i> </a>
                                                <a href="{{ route('job.edit', $item->id) }}" class="btn btn-info btn-sm"
                                                    style="margin-bottom:5px"><i class="fa fa-pencil"
                                                        title="Editer job"></i> </a>
                                                <a href="{{ route('job.delete', $item->id) }}"
                                                    class="btn btn-danger btn-sm" id="delete"
                                                    style="margin-bottom:5px"><i class="fa fa-trash"
                                                        title="Delete job"></i></a>
                                                @if ($item->status == 1)
                                                    <a href="{{ route('job.inactive', $item->id) }}"
                                                        class="btn btn-danger btn-sm" title="Inactive Now"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-down"></i> </a>
                                                @else
                                                    <a href="{{ route('job.active', $item->id) }}"
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
