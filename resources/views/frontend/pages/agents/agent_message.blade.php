@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Dashboard
@endsection

<!-- start main container -->
<main class="bg-light">
    <section class="container">

        <!-- Preloader Start -->
        @include('frontend.components.agent_header')

        <div class="container py-5">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-body wrap-table">
                            <div class="table-responsive">
                                <table id="complex_header" class="table table-striped table-bordered display"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Client</th>

                                            <th>Publication</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th style="text-align: center !important;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_msg as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <p>Nom: {{ $item->name }}</p>
                                                    <p>WhatsApp : <a target="_blank" rel="noopener noreferrer"
                                                            href="https://wa.me/{{ $item->phone }}/?text=Bonjour ">{{ $item->phone }}</a>
                                                    </p>

                                                </td>

                                                <td>
                                                    <a href="{{ $item->link }}">Voir Lien</a>
                                                </td>
                                                <td>
                                                    <p class="text-wrap" style="width:200px">{{ $item->message }}</p>
                                                </td>
                                                <td>
                                                    @if ($item->status = 0)
                                                        <span class="bg-danger"
                                                            style="border-radius: 5px;padding: 5px;color:white;font-size:12px">Attente</span>
                                                    @else
                                                        <span class="bg-success"
                                                            style="border-radius: 5px;padding: 5px;color:white;font-size:12px">Repondu</span>
                                                    @endif

                                                </td>
                                                <td style="text-align: center !important;">
                                                    <a href="{{ route('agent.chat.response', $item->id) }}"
                                                        style="margin-right: 5px;color:rgb(8, 89, 240)"
                                                        title="Repondre au message"><i
                                                            class="fa fa-message"></i></a><br>
                                                    <a href="{{ route('client.message.delete', $item->id) }}"
                                                        id="delete" style="margin-right: 5px;color:red"
                                                        title="Supprimer le message"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.col-md-6 1 end -->
            </div>
        </div>
    </section>
</main>
<!-- end main container -->
@endsection
