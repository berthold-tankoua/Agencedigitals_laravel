@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Commandes
@endsection

<div class="container-full">
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-12">

                <h2 class="text-center my-4">
                    Commandes contenant le produit :
                    <strong class="text-primary">
                        {{ strtoupper($grouped->first()[0]->product->product_name ?? '') }}
                    </strong>
                </h2>

                @foreach ($grouped as $orderId => $items)
                    @php
                        $order = $items[0]['order'];
                    @endphp

                    <div class="card mb-5 border-0 shadow-lg rounded-3">
                        <div
                            class="card-header bg-gradient bg-dark text-white d-flex justify-content-between align-items-center py-3">
                            <div>
                                <h5 class="mb-0">
                                    🧾 <strong>Commande #{{ $order['id'] }}</strong>
                                </h5>
                                <p>
                                    👤 <b>{{ $order['name'] ?? '—' }}</b> |
                                    📧 {{ $order['email'] ?? '—' }}
                                </p>
                            </div>

                            <div class="text-end">
                                @if ($order['status'] === 'paid')
                                    <span class="badge bg-success fs-6">💰 Payé</span>
                                @elseif($order['status'] === 'partial_paid')
                                    <span class="badge bg-warning text-dark fs-6">💸 Partiellement payé</span>
                                @else
                                    <span class="badge bg-secondary fs-6">⏳ En attente</span>
                                @endif
                                <div class="mt-1">
                                    🗓️ <small>Confirmée le : <b>{{ $order['confirmed_date'] ?? '—' }}</b></small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-bordered table-striped mb-0 align-middle text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#️⃣</th>
                                        <th>🏗️ Produit</th>
                                        <th>📦 Quantité</th>
                                        <th>💵 Prix</th>
                                        <th>💱 Devise</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td><b>{{ $item['id'] }}</b></td>
                                            <td>{{ ucfirst($item['product']['product_name'] ?? '') }}</td>
                                            <td>{{ $item['qty'] }}</td>
                                            <td>{{ number_format($item['price'], 0, ',', ' ') }}</td>
                                            <td>{{ $item['currency'] }}</td>
                                            <td>
                                                <a href="{{ route('order.details', $order->id) }}"
                                                    title="Afficher les details de la commande"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-eye" title="Order details"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach

                <div class="text-center mt-4">
                    <a href="" class="btn btn-secondary px-4 py-2">
                        ⬅️ Retour aux commandes
                    </a>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
