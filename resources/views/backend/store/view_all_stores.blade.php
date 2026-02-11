@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Tous nos Compagnies
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Nos Compagnies <span
                                class="badge badge-danger badge-pill">{{ count($stores) }}</span> </h3>
                        <div class="d-flex">
                            <a href="{{ route('all.store.inactive') }}" class="btn btn-danger btn-sm"
                                title="Inactive Now" style="margin-right:8px"><i class="fa fa-arrow-down"></i>Desactivé
                                tous les Compagnies </a>
                            <a href="{{ route('all.store.active') }}" class="btn btn-success btn-sm" title="Active Now"
                                style="margin-right:5px"><i class="fa fa-arrow-up"></i> Activé tous les Compagnies</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image </th>

                                        <th>Informations </th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stores as $item)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ asset($item->store_thambnail) }}"
                                                    style="width: 65px; height: 65px;">
                                                <hr>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-pill badge-success"> Active </span>
                                                @elseif($item->status == 2)
                                                    <span class="badge badge-pill badge-info"> Attente </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"> Inactive </span>
                                                @endif
                                                <hr>
                                                {{ $item->created_at->format('d/m/Y') }}
                                            </td>

                                            <td>
                                                <p>Nom : <strong>{{ $item->store_name }}</strong></p>

                                                <p>Contact : <a
                                                        href="tel:{{ $item->store_contact }}">{{ $item->store_contact }}</a>
                                                </p>
                                                <p>Email : <a
                                                        href="mailto:{{ $item->store_email }}">{{ $item->store_email }}</a>
                                                </p>
                                                <p>Adresse : <strong>{{ $item->store_adress }}</strong></p>
                                            </td>


                                            <td width="10%" style="text-align: center !important;">
                                                <a href="{{ route('store.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-pencil"
                                                        title="Editer l'agent ou le proprietaire"></i> </a>
                                                <a href="{{ route('store.delete', $item->id) }}"
                                                    class="btn btn-danger btn-sm" id="delete"
                                                    style="margin-bottom:5px"><i class="fa fa-trash"
                                                        title="Supprimer l'agent ou le proprietaire"></i></a>
                                                @if ($item->status == 1)
                                                    <a href="{{ route('store.inactive', $item->id) }}"
                                                        class="btn btn-danger btn-sm" title="Desactiver le compte agent"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-down"></i> </a>
                                                    <span class="btn btn-primary btn-sm mt-1" id="{{ $item->id }}"
                                                        onclick="InactiveMsgView(this.id)" data-toggle="modal"
                                                        data-target="#exampleModal"
                                                        title="Desactiver le compte agent et envoyer un message"><i
                                                            class="fa fa-arrow-down"></i></span>
                                                @elseif ($item->status == 0)
                                                    <a href="{{ route('store.active', $item->id) }}"
                                                        class="btn btn-success btn-sm" title="Activer le compte agent"
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
