@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Commande(s) Payee(s)
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
                        <h3 class="box-title">Commande(s) Payee(s) | En attente de livraison <span
                                class="badge badge-danger badge-pill">{{ count($orders) }}</span> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date </th>
                                        <th>Invoice </th>
                                        <th>Somme_total</th>
                                        <th>Modalité_paiement</th>
                                        <th>Status_paiement</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <td> {{ $order->order_date }} </td>
                                            <td> {{ $order->invoice_no }} </td>
                                            <td> {{ $order->amount }} {{ $order->currency }}</td>
                                            <td class="text-center">
                                                @if ($order->installments_count == 1)
                                                    <span class="bg-info"
                                                        style="border-radius:5px;color:white;padding:5px;">Totalité
                                                    </span>
                                                @else
                                                    <span class="bg-success"
                                                        style="border-radius:5px;color:white;padding:5px;">Échelonné
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($order->status == 'partial_paid')
                                                    <span style="border-radius:5px;color:white;padding:5px;"
                                                        class="badge bg-warning">Partiel</span>
                                                @elseif($order->status == 'paid')
                                                    <span style="border-radius:5px;color:white;padding:5px;"
                                                        class="badge bg-success">Payée</span>
                                                @elseif($order->status == 'failed')
                                                    <span style="border-radius:5px;color:white;padding:5px;"
                                                        class="badge bg-danger">Échouée</span>
                                                @elseif($order->status == 'unpaid')
                                                    <span style="border-radius:5px;color:white;padding:5px;"
                                                        class="badge bg-secondary">Non payée</span>
                                                @elseif($order->status == 'assigned')
                                                    <span style="border-radius:5px;color:white;padding:5px;"
                                                        class="badge bg-info">Livreur assigné</span>
                                                @elseif($order->status == 'delivered')
                                                    <span style="border-radius:5px;color:white;padding:5px;"
                                                        class="badge bg-primary">Livrée</span>
                                                @endif
                                            </td>
                                            <td width="12%" style="text-align: center !important;">
                                                <a href="{{ route('order.details', $order->id) }}"
                                                    title="Afficher les details de la commande"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-eye" title="Order details"></i> </a>
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
            <!-- /.col -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>
@endsection
