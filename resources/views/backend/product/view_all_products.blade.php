@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Tous nos produits
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
                        <h3 class="box-title">Product List <span
                                class="badge badge-danger badge-pill">{{ count($products) }}</span> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image </th>
                                        <th>Produit </th>
                                        <th>Informations </th>
                                        <th>Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td> <img src="{{ asset($item->product_thambnail) }}"
                                                    style="width: 90px; height: 65px;"> </td>
                                            <td>
                                                <p><strong>Nom:</strong> {{ $item->product_name }}</p>
                                                <p><strong>Compagnie:</strong>
                                                    @if ($item->store_id)
                                                        {{ $item->store->store_name }}
                                                    @else
                                                        AgenceDigitals
                                                    @endif
                                                </p>
                                                <p><strong>Categorie:</strong> {{ $item->category->category_name_fr }}
                                                </p>
                                            </td>

                                            <td>
                                                <p><strong>Prix vente:</strong> {{ $item->selling_price }}
                                                    FCFA{!! $item->action_type !!}</p>
                                                @if ($item->discount_price)
                                                    <p><strong>Prix Promo:</strong> {{ $item->discount_price }}
                                                        FCFA{!! $item->action_type !!}</p>
                                                @endif
                                                <p><strong>Quantite:</strong> {{ $item->product_qty }}</p>
                                            </td>

                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-pill badge-success"> Active </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"> InActive </span>
                                                @endif
                                            </td>
                                            <td width="10%" style="text-align: center !important;">
                                                <a href="{{ route('product.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-pencil" title="Edit Product"></i> </a>
                                                <a href="{{ route('product.delete', $item->id) }}"
                                                    class="btn btn-danger btn-sm" id="delete"
                                                    style="margin-bottom:5px"><i class="fa fa-trash"
                                                        title="Delete Product"></i></a>
                                                @if ($item->status == 1)
                                                    <a href="{{ route('product.inactive', $item->id) }}"
                                                        class="btn btn-danger btn-sm" title="Inactive Now"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-down"></i> </a>
                                                @else
                                                    <a href="{{ route('product.active', $item->id) }}"
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
