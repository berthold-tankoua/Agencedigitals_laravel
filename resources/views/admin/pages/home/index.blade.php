@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Dashboard
@endsection


@php
    $users = App\Models\User::get();
    $formations = App\Models\Formation::get();
    $orders = App\Models\Order::where('status', 'paid')

        ->orderBy('id', 'DESC')
        ->get();
    $delivered = App\Models\Order::where('status', 'delivered')->get();
@endphp
<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <i class="text-primary mr-0 font-size-24 mdi mdi-account-circle"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Utilisateur(s)</p>
                            <h3 class="text-white mb-0 font-weight-500">{{ count($users) }} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-cart"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Commande(s) Livrée(s) </p>
                            <h3 class="text-white mb-0 font-weight-500">{{ count($delivered) }} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-danger-light rounded w-60 h-60">
                            <i class="text-danger mr-0 font-size-24 mdi mdi-alert"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Commande(s) Attente </p>
                            <h3 class="text-white mb-0 font-weight-500">{{ count($orders) }} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-danger-light rounded w-60 h-60">
                            <i class="text-danger mr-0 font-size-24 mdi mdi-folder"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">formation(s)</p>
                            <h3 class="text-white mb-0 font-weight-500">{{ count($formations) }} </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            🛒 Produits commandés en Attente
                            <span class="badge badge-danger badge-pill">{{ count($orders) }}</span>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#️⃣</th>
                                        <th>🖼️ Image</th>
                                        <th>📂 Catégorie</th>
                                        <th>🏷️ Produit</th>
                                        <th>📦 Quantité</th>
                                        <th>Statut</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td class="text-center" style="width: 20%"><img
                                                    src="{{ asset($order->product->product_thambnail) }}" height="100"
                                                    width="90%" class="rounded"></td>
                                            <td class="text-center"> {{ $order->product->category->category_name_fr }}
                                            </td>
                                            <td class="text-center"> {{ $order->product->product_name }} </td>
                                            <td class="text-center"> {{ $order->total_qty }} </td>
                                            <td class="text-center">
                                                <p style="font-size: 20px">🕓</p>
                                            </td>
                                            <td width="12%" style="text-align: center !important;">
                                                <a href="{{ route('orders.byProduct', $order->product) }}"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-eye" title="Afficher les details"></i> </a>
                                                <a href="{{ route('order.product.update', $order->product) }}"
                                                    class="btn btn-success btn-sm" title="Marquer le produit comme vu"
                                                    style="margin-bottom:5px"><i class="fa fa-check"></i></a>
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

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Commande(s) en Attente <span
                                class="badge badge-danger badge-pill">{{ count($orders) }}</span> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date </th>
                                        <th>No Commande </th>
                                        <th>Somme_total</th>
                                        <th>Tranche_payée</th>
                                        <th>Status_paiement</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <td> {{ $order->confirmed_date }} </td>
                                            <td> {{ $order->invoice_no }} </td>
                                            <td> {{ $order->amount }} {{ $order->currency }}</td>
                                            <td class="text-center">
                                                <strong>{{ $order->installments_paid }}/{{ $order->installments_count }}</strong>
                                            </td>
                                            <td class="text-center">
                                                @if ($order->status == 'partial_paid')
                                                    <span style="border-radius:5px;color:white;padding:5px;"
                                                        class="badge bg-warning">Paiement Partiel</span>
                                                @elseif($order->status == 'paid')
                                                    <span style="border-radius:5px;color:white;padding:5px;"
                                                        class="badge bg-success">Paiement Total</span>
                                                @endif
                                            </td>
                                            <td width="12%" style="text-align: center !important;">
                                                <a href="{{ route('order.details', $order->id) }}"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-eye" title="Afficher les details"></i> </a>
                                                <!-- <a href="" class="btn btn-danger btn-sm" id="delete" style="margin-bottom:5px"><i class="fa fa-trash" title="Delete Order"></i></a> -->
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

        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
