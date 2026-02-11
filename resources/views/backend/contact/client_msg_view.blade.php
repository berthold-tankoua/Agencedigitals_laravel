@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Message
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Message </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>

                                        <th>Agents</th>

                                        <th>Informations</th>
                                        <th>Lien</th>
                                        <th>Messages</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $item)
                                        @php
                                            $store = App\Models\Store::where('id', $item->store_id)->first();
                                        @endphp
                                        @if ($store)
                                            <tr>
                                                <td>
                                                    <p><strong>Recu le:</strong>
                                                        {{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                                    </p>
                                                    <hr>
                                                    <p><strong>Agence:</strong> {{ $item->store->store_name }}</p>
                                                    WhatsApp : <a target="_blank" rel="noopener noreferrer"
                                                        href="https://wa.me/{{ $item->phone }}/?text=j aimerai en savoir plus sur votre Agence ">Contacter
                                                        le vendeur</a><br>
                                                </td>

                                                <td>
                                                    Nom: {{ $item->name }} <br>
                                                    Email: {{ $item->email }} <br>
                                                    Contact: {{ $item->phone }}
                                                </td>
                                                <td>
                                                    <a href="{{ $item->link }}">Voir Lien</a>
                                                </td>
                                                <td style="width: 25%;">{{ $item->message }}</td>

                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- /.col-md-6 1 end -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

<!-- /.content-wrapper -->


<script type="text/javascript">
    $(document).ready(function() {

        $('#image').change(function(e) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $("#showImg").attr("src", e.target.result).width(80).height(80);
            }

            reader.readAsDataURL(e.target.files[0]);

        });

    });
</script>
@endsection
