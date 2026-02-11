@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Tous nos Livreurs
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
                        <h3 class="box-title">Nos Livreurs <span
                                class="badge badge-danger badge-pill">{{ count($delivers) }}</span> </h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image </th>

                                        <th>Informations </th>
                                        <th>Livraison</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($delivers as $item)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ asset($item->image) }}" class="rounded-circle shadow-sm"
                                                    style="width: 65px; height: 65px; object-fit: cover;">
                                                <div class="small text-muted mt-2">
                                                    Créé le {{ $item->created_at->format('d/m/Y') }}
                                                </div>
                                            </td>
                                            <td>
                                                <p><i class="fa fa-user"></i> <strong>{{ $item->name }}</strong></p>
                                                <p>📞 <a href="tel:{{ $item->phone }}">{{ $item->phone }}</a></p>
                                                <p>✉️ <a href="mailto:{{ $item->email }}">{{ $item->email }}</a></p>
                                                <p>📍 <span class="">{{ $item->adress }}</span></p>
                                            </td>
                                            <td>
                                                @php
                                                    $delivered = App\Models\Order::where('delivery_id', $item->id)
                                                        ->where('status', 'delivered')
                                                        ->count();
                                                    $pending = App\Models\Order::where('delivery_id', $item->id)
                                                        ->where('status', 'assigned')
                                                        ->count();
                                                @endphp
                                                <span class="badge bg-warning text-dark">
                                                    {{ $pending }} En cours
                                                </span>
                                                <br>
                                                <span class="badge bg-success mt-1">
                                                    {{ $delivered }} Terminées
                                                </span>
                                            </td>
                                            <td width="10%" style="text-align: center !important;">
                                                <a href="{{ route('delivery.order', $item->id) }}"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-eye" title="Afficher les livraisons"></i> </a>
                                                <a href="{{ route('delivery.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-pencil" title="Editer le livreur"></i> </a>
                                                @if ($item->status == 1)
                                                    <a href="{{ route('delivery.inactive', $item->id) }}"
                                                        class="btn btn-danger btn-sm" title="Desactiver le compte agent"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-down"></i> </a>
                                                    <span class="btn btn-primary btn-sm mt-1" id="{{ $item->id }}"
                                                        onclick="InactiveMsgView(this.id)" data-toggle="modal"
                                                        data-target="#exampleModal"
                                                        title="Desactiver le compte agent et envoyer un message"><i
                                                            class="fa fa-arrow-down"></i></span>
                                                @elseif ($item->status == 0)
                                                    <a href="{{ route('delivery.active', $item->id) }}"
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
