@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Dashboard
@endsection
<!--=====================================
Breadcrumbs
======================================-->
<div>
    <ul class="breadcrumbs mb-4">
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li>Dashboard</li>
        <li>Bienvenue {{ Auth::user()->name }}</li>
    </ul>
</div>
<!-- my account -->
<div class="my-2">
    <div class="container">
        <div class="row">
            <!-- dashboard nav section -->
            <div class="col-12 col-md-3">
                <div class="d-flex flex-column theme-border-radius bg-light theme-box-shadow">
                    <ul id="dashboard">

                        <li><a href="{{ route('user.dashboard') }}"
                                class="active border-bottom p-3 theme-text-accent-one"><i
                                    class="bi bi-card-list fs-4 me-2 align-middle"></i>
                                Mes Commandes</a>
                        </li>
                        <li><a href="{{ route('user.profil') }}" class="border-bottom p-3 theme-text-accent-one"><i
                                    class="bi bi-person-workspace fs-4 me-2 align-middle"></i>Mon Profil</a>
                        </li>
                        <li><a href="{{ route('user.chat.detail', 1) }}"
                                class="border-bottom p-3 theme-text-accent-one"><i
                                    class="bi bi-chat-left-text fs-4 me-2 align-middle"></i>Mes Discusions</a>
                        </li>
                        <li><a href="{{ route('user.wishlist') }}" class="border-bottom p-3 theme-text-accent-one"><i
                                    class="bi bi-cart fs-4 me-2 align-middle"></i>Mes Favoris</a>
                        </li>
                        <li><a href="{{ route('user.cart') }}" class="border-bottom p-3 theme-text-accent-one"><i
                                    class="bi bi-bag-heart fs-4 me-2 align-middle"></i>Mon panier d'achat</a>
                        </li>

                        <li><a href="{{ route('user.logout') }}" class="border-bottom p-3 theme-text-accent-one"
                                data-bs-toggle="modal" data-bs-target="#exampleModalLogout"><i
                                    class="bi bi-box-arrow-right fs-4 me-2 align-middle"></i>Deconnexion</a>
                        </li>

                    </ul>

                </div>
            </div>
            <!-- dashboard content section -->
            <div class="col-12 col-md-9">
                <div class="d-flex align-self-center align-items-center">
                    <p class="fs-3 mb-3 theme-text-secondary">Mes commandes ({{ count($orders) }})</p>
                </div>
                <!-- my orders section -->
                <div class="table-responsive border-0">
                    <!-- Table -->
                    <table class="table mb-2 text-nowrap">
                        <!-- Table Head -->
                        <thead class="table-light">
                            <tr class="table-warning small">
                                <th class="border-0">Date commande</th>
                                <th class="border-0">No.commande</th>

                                <th class="border-0">Tranche Payée</th>
                                <th class="border-0">Prix Total</th>
                                <th class="border-0">Reste à payer</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="align-middle border-top-0 small">{{ $order->confirmed_date }}</td>
                                    <td class="align-middle border-top-0">
                                        <a href="#"
                                            class="theme-text-secondary small">{{ $order->invoice_no }}</a>
                                    </td>
                                    <td class="align-middle border-top-0 small">
                                        {{ $order->installments_paid }}/{{ $order->installments_count }}
                                    </td>
                                    <td class="align-middle border-top-0 font-bold">
                                        {{ $order->amount }} {{ $order->currency }}
                                    </td>
                                    <td class="align-middle border-top-0 small">
                                        {{ $order->remaining_amount }} {{ $order->currency }}
                                    </td>
                                    <td class="align-middle border-top-0 text-center">
                                        @if ($order->status == 'partial_paid')
                                            <span style="border-radius:5px;color:white;padding:5px;"
                                                class="badge bg-warning">Paiement Partiel Réussi</span>
                                        @elseif($order->status == 'paid')
                                            <span style="border-radius:5px;color:white;padding:5px;"
                                                class="badge bg-success">Paiement Réussi</span>
                                        @elseif($order->status == 'failed')
                                            <span style="border-radius:5px;color:white;padding:5px;"
                                                class="badge bg-danger">Paiement Échouée</span>
                                        @elseif($order->status == 'unpaid')
                                            <span style="border-radius:5px;color:white;padding:5px;"
                                                class="badge bg-secondary">Non payée</span>
                                        @elseif($order->status == 'assigned')
                                            <span style="border-radius:5px;color:white;padding:5px;"
                                                class="badge bg-info">Livreur assigné</span>
                                        @elseif($order->status == 'delivered')
                                            <span style="border-radius:5px;color:white;padding:5px;"
                                                class="badge bg-primary">Commande Livrée</span>
                                        @elseif($order->status == 'pending')
                                            <span style="border-radius:5px;color:white;padding:5px;"
                                                class="badge bg-danger">Paiement Attente</span>
                                        @endif
                                        @if ($order->status != 'paid' && $order->fully_paid == false)
                                            <br>
                                            <a href="{{ route('user.paid.remain.order', $order->id) }}"
                                                style="font-size: 11px"><i class="bi bi-credit-card"></i> Finaliser le
                                                paiement</a>
                                        @endif
                                    </td>
                                    <td class="text-muted align-items-center border-top-0 d-flex flex-column ">
                                        <a href="{{ route('user.order.detail', $order->id) }}"
                                            class="theme-text-secondary" title="Afficher les details de la commande"><i
                                                class="bi bi-eye"></i></a>
                                        @if ($order->status != 'paid' && $order->fully_paid == false)
                                            <a href="{{ route('user.paid.remain.order', $order->id) }}"
                                                class="theme-text-secondary" title="Terminer le paiement"><i
                                                    class="bi bi-wallet2"></i></a>
                                        @endif
                                        @if ($order->status == 'paid' || $order->status == 'partial_paid')
                                            <a href="{{ $order->invoice }}" target="_blank" download
                                                class="theme-text-secondary" title="Telecharger le recu"><i
                                                    class="bi bi-filetype-pdf"></i></a>
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
</div>
@endsection
