@extends('frontend.main_master')

@section('title')
    AgenceDigitals | Détail de la commande
@endsection

@section('content')
    <!--=====================================
    Breadcrumbs
    ======================================-->
    <div>
        <ul class="breadcrumbs mb-4">
            <li><a href="{{ url('/') }}">Accueil</a></li>
            <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
            <li>Détail de la commande</li>
        </ul>
    </div>
    <div class="my-5">
        <div class="container">
            <div class="row justify-content-center">

                <!-- Contenu principal -->
                <div class="col-12 col-md-10">

                    <div class="d-flex align-items-center mb-3">
                        <p class="fs-3 theme-text-secondary">Suivi de la commande <strong>#{{ $order->invoice_no }}</strong>
                        </p>
                    </div>

                    <!-- Statut de la commande -->
                    <div class="theme-box-shadow theme-border-radius theme-bg-white mb-3 p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="fs-5 mb-0">Statut de la commande</p>
                                    <span class="fs-5">
                                        @if ($order->status == 'assigned')
                                            75
                                        @elseif ($order->status == 'delivered')
                                            100
                                        @elseif ($order->status == 'paid' || $order->status == 'partial_paid')
                                            50
                                        @elseif ($order->status == 'failed')
                                            25
                                        @endif%
                                    </span>
                                </div>

                                <!-- Barre de progression -->
                                <span class="d-flex profile">
                                    <span
                                        class="@if ($order->status == 'assigned') complete-75
                             @elseif($order->status == 'delivered') complete-100
                             @elseif($order->status == 'paid' || $order->status == 'partial_paid') complete-50
                             @elseif($order->status == 'failed') complete-25 @endif">
                                    </span>
                                </span>

                                <p class="my-3 theme-text-accent-one font-medium">Notifications de la commande</p>
                            </div>
                        </div>

                        <!-- Détails de progression -->
                        @if ($order->status == 'delivered')
                            <div class="row g-0 p-3 theme-bg-accent-two theme-border-radius">
                                <div class="col-12 col-md-4">
                                    <div>
                                        <i class="bi bi-check-circle-fill fs-4 me-2 text-success align-middle"></i>
                                        <span class="font-medium">
                                            @if ($order->installments_count == 1)
                                                Paiement effectué
                                            @else
                                                Paiement partiel effectué
                                            @endif
                                        </span>
                                    </div>
                                    <span class="theme-text-accent-one font-medium">Date :
                                        {{ $order->confirmed_date }}</span>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div>
                                        <i class="bi bi-check-circle-fill fs-4 me-2 text-success align-middle"></i>
                                        <span class="font-medium">Livreur attribué</span>
                                    </div>
                                    <span class="theme-text-accent-one font-medium">Date : {{ $order->picked_date }}</span>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div>
                                        <i class="bi bi-check-circle-fill fs-4 me-2 text-success align-middle"></i>
                                        <span class="font-medium">Commande livrée</span>
                                    </div>
                                    <span class="theme-text-accent-one font-medium">Date :
                                        {{ $order->delivered_date }}</span>
                                </div>
                            </div>
                        @elseif ($order->status == 'assigned')
                            <div class="row g-0 p-3 theme-bg-accent-two theme-border-radius">
                                <div class="col-12 col-md-4">
                                    <div>
                                        <i class="bi bi-check-circle-fill fs-4 me-2 text-success align-middle"></i>
                                        <span class="font-medium">
                                            @if ($order->installments_count == 1)
                                                Paiement effectué
                                            @else
                                                Paiement partiel effectué
                                            @endif
                                        </span>
                                    </div>
                                    <span class="theme-text-accent-one font-medium">Date :
                                        {{ $order->confirmed_date }}</span>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div>
                                        <i class="bi bi-check-circle-fill fs-4 me-2 text-success align-middle"></i>
                                        <span class="font-medium">Livreur attribué</span>
                                    </div>
                                    <span class="theme-text-accent-one font-medium">Date : {{ $order->picked_date }}</span>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div>
                                        <i class="bi bi-hourglass-split fs-4 me-2 text-secondary align-middle"></i>
                                        <span class="font-medium">Commande en cours de livraison</span>
                                    </div>
                                    <span class="theme-text-accent-one font-medium">Date : En attente</span>
                                </div>
                            </div>
                        @elseif ($order->status == 'paid' || $order->status == 'partial_paid')
                            <div class="row g-0 p-3 theme-bg-accent-two theme-border-radius">
                                <div class="col-12 col-md-4">
                                    <div>
                                        <i class="bi bi-check-circle-fill fs-4 me-2 text-success align-middle"></i>
                                        <span class="font-medium">
                                            @if ($order->installments_count == 1)
                                                Paiement effectué
                                            @else
                                                Paiement partiel effectué
                                            @endif
                                        </span>
                                    </div>
                                    <span class="theme-text-accent-one font-medium">Date :
                                        {{ $order->confirmed_date }}</span>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div>
                                        <i class="bi bi-hourglass-split fs-4 me-2 text-secondary align-middle"></i>
                                        <span class="font-medium">Livreur en attente d’attribution</span>
                                    </div>
                                    <span class="theme-text-accent-one font-medium">Date : En attente</span>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div>
                                        <i class="bi bi-hourglass-split fs-4 me-2 text-secondary align-middle"></i>
                                        <span class="font-medium">Commande en attente de livraison</span>
                                    </div>
                                    <span class="theme-text-accent-one font-medium">Date : En attente</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Détails de la commande -->
                    <div class="theme-box-shadow theme-border-radius theme-bg-white mb-3 p-3">
                        <div class="d-flex align-items-center mb-3">
                            <p class="fs-3 theme-text-secondary mb-0">Détails de la commande</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0">
                                <thead class="table-light">
                                    <tr class="table-warning small">
                                        <th class="border-0">Image</th>
                                        <th class="border-0">Produit</th>
                                        <th class="border-0">Code</th>
                                        <th class="border-0">Quantité</th>
                                        <th class="border-0">Prix unitaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItems as $item)
                                        <tr>
                                            <td class="align-middle border-top-0 w-0">
                                                <a
                                                    href="{{ url('product/details/' . $item->product->id . '/' . $item->product->product_slug) }}">
                                                    <img src="{{ asset($item->product->product_thambnail) }}"
                                                        alt="Image du produit" class="whishlist-thumb">
                                                </a>
                                            </td>
                                            <td class="align-middle border-top-0 small">
                                                <a href="{{ url('product/details/' . $item->product->id . '/' . $item->product->product_slug) }}"
                                                    class="theme-text-secondary">{{ $item->product->product_name }}</a>
                                            </td>
                                            <td class="align-middle border-top-0 small">{{ $item->product->product_code }}
                                            </td>
                                            <td class="align-middle border-top-0 small">{{ $item->qty }}</td>
                                            <td class="align-middle border-top-0 small">{{ $item->price }}
                                                {{ $item->currency }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
