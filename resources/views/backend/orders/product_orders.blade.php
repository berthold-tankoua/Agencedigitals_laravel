@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Commandes
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
                        <h3 class="box-title">
                            🛒 Produits commandés validées
                            <span class="badge badge-danger badge-pill">{{ count($orderProducts) }}</span>
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
                                    @foreach ($orderProducts as $key => $order)
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
                                                <p style="font-size: 20px">✅</p>
                                            </td>
                                            <td width="12%" style="text-align: center !important;">
                                                <a href="{{ route('orders.byProduct', $order->product) }}"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-eye" title="Afficher les details"></i> </a>
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
