@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Candidatures
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
                        <h3 class="box-title">Liste des Candidatures <span
                                class="badge badge-danger badge-pill">{{ count($jobs) }}</span> </h3>
                        <a class="btn btn-primary float-right " href="{{ route('add.job.view') }}">Ajouter un emploi</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Emploi </th>

                                        <th>Information </th>
                                        <th>Fichiers </th>

                                        <th>Status </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $item)
                                        <tr>
                                            <td>
                                                <p><strong>Poste: </strong> {{ $item->career->job_name }}</p>
                                            </td>

                                            <td>
                                                <p><strong>email: </strong> {{ $item->email }}</p>
                                                <p><strong>contact: </strong> {{ $item->phone }}</p>
                                            </td>

                                            <td>
                                                <p><strong>CV: </strong> <a
                                                        href="{{ asset($item->cv_doc) }}">Afficher</a></p>
                                                <p><strong>Lettre: </strong> <a
                                                        href="{{ asset($item->letter_doc) }}">Afficher</a></p>
                                            </td>

                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-pill badge-success"> Active </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"> InActive </span>
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
