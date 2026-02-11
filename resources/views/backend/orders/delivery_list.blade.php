@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Choix du livreur
@endsection

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row justify-content-center">

            <div class="col-7"><br><br>
                <div class="box shadow-sm">
                    <div class="box-header">
                        <h4 class="box-title">
                            🚚 Assigner un livreur
                        </h4>
                        <p class="text-muted mt-1">
                            Sélectionnez un livreur pour cette commande 🧾
                        </p>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('assign.deliver') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-4">
                                <h5>👤 Sélectionner un livreur <span class="text-danger">*</span></h5>
                                <p class="text-danger">
                                    ✉️ Un mail de notification sera envoyé au livreur sélectionné.
                                </p>
                                <input type="hidden" name="orderId" value="{{ $order }}">
                                <div class="controls">
                                    <select id="select" name="delivery_id" required class="form-control">
                                        <option value="" selected disabled>🔽 Choisir un livreur</option>
                                        @foreach ($delivers as $item)
                                            @php
                                                $pending = App\Models\Order::where('delivery_id', $item->id)
                                                    ->where('status', 'assigned')
                                                    ->count();
                                            @endphp
                                            <option value="{{ $item->id }}">
                                                🚴‍♂️ {{ $item->name }} | 📦 {{ $pending }} livraison(s) en cours
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <input type="submit" class="btn btn-rounded btn-info px-4"
                                    value="✅ Valider le livreur">

                                </input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
