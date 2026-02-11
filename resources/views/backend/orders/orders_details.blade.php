@extends('admin.admin_master')

@section('admin')

@section('title')
    AgenceDigitals | Détails de la commande
@endsection

<div class="container py-4">
    <section class="content">
        <div class="row">
            <!-- Bloc Livraison -->
            <div class="col-md-6 mb-3">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">📦 Détails de livraison</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Facture :</strong> {{ $order->invoice_no }}</p>
                        <p><strong>Date commande :</strong> {{ $order->order_date }}</p>

                        <p><strong>Nom :</strong> {{ $order->name }}</p>
                        <p><strong>Téléphone :</strong> {{ $order->phone }}</p>
                        <p><strong>Email :</strong> {{ $order->email }}</p>
                        <p><strong>Localisation:</strong> {{ $order->country }}, {{ $order->town }},
                            {{ $order->quarter }}</p>
                        <p><strong>Notes:</strong> {{ $order->notes }}</p>
                    </div>
                </div>
            </div>

            <!-- Bloc Commande -->
            <div class="col-md-6 mb-3">
                <div class="card shadow rounded">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">🛒 Détails de la commande</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Plateforme Paiement :</strong> {{ $order->payment_method }}</p>
                        <p><strong>Modalité_paiement :</strong>
                            @if ($order->installments_count == 1)
                                <span>Totalité (1 tranche) </span>
                            @else
                                <span>Échelonné (3 tranches) </span>
                            @endif
                        </p>

                        <p><strong>Prix Total :</strong> <span class="text-success fw-bold h4"> {{ $order->amount }}
                                {{ $order->currency }}</span></p>
                        <p><strong>Tranche Payee :</strong>
                            {{ $order->installments_paid }}/{{ $order->installments_count }}</p>
                        <p><strong>Reste à payer :</strong> <span class="text-success fw-bold h4">
                                {{ $order->remaining_amount }} {{ $order->currency }}</span></p>
                        <p>
                            <strong>Statut de la Commande:</strong>
                            @if ($order->status == 'partial_paid')
                                <span class="badge bg-warning">Partiel</span>
                            @elseif($order->status == 'paid')
                                <span class="badge bg-success">Payée</span>
                            @elseif($order->status == 'failed')
                                <span class="badge bg-danger">Échouée</span>
                            @elseif($order->status == 'unpaid')
                                <span class="badge bg-secondary">Non payée</span>
                            @elseif($order->status == 'assigned')
                                <span class="badge bg-info">Livreur assigné le {{ $order->picked_date }}</span>
                            @elseif($order->status == 'delivered')
                                <span class="badge bg-primary">Livrée</span>
                            @endif
                        </p>

                        @if ($order->confirmed_date)
                            <div class="d-flex gap-2 mt-3">
                                @if ($order->status == 'assigned')
                                    <a href="{{ route('ship-success', $order->id) }}"
                                        class="btn btn-primary flex-fill">✅ Livraison effectuée</a>
                                @else
                                    <a href="{{ route('paid-ship', $order->id) }}" class="btn btn-success flex-fill">📦
                                        Assigner un livreur</a>
                                @endif

                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bloc Produits -->
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">🛍️ Produits commandés</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0 text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Nom</th>

                                    <th>Couleur</th>
                                    <th>Taille</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItem as $item)
                                    <tr>
                                        <td><img src="{{ asset($item->product->product_thambnail) }}" height="60"
                                                width="70" class="rounded"></td>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td>{{ $item->color }}</td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td><strong>{{ $item->price }} {{ $item->currency }}</strong></td>
                                        <td class="text-center">
                                            @if ($item->status == 1)
                                                ✅
                                            @else
                                                🕓
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
