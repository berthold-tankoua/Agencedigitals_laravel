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
                        <h4 class="box-title">Demande D'annonce </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>profil</th>
                                        <th>Img</th>
                                        <th>Utilisateur</th>
                                        <th>Domaine</th>
                                        <th>Expire</th>
                                        <th>Status</th>
                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($adverts as $item)
                                        <tr>
                                            <td><img src="{{ asset($item->profil_pic) }}"
                                                    style="width: 50px; height: 50px;"> </td>
                                            <td> <img src="{{ asset($item->advert_thambnail) }}"
                                                    style="width: 50; height: 50px;"> </td>
                                            <td>
                                                <p>Nom : {{ $item->name }}</p>
                                                <p>Email : {{ $item->email }}</p>
                                                <p>Contact : {{ $item->contact }}</p>
                                            </td>
                                            <td>
                                                {{ $item->type }}
                                            </td>
                                            @php
                                                if (empty($item->expiry_date)) {
                                                    # code...
                                                    $diff = '';
                                                } else {
                                                    # code...
                                                    $created = \Carbon\carbon::now();
                                                    $expiry = \Carbon\carbon::CreateFromFormat(
                                                        'Y-m-d H:s:i',
                                                        $item->expiry_date,
                                                    );
                                                    $diff = $created->diffIndays($expiry);
                                                }
                                            @endphp
                                            <td>{{ $diff }} Jour(s)</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-pill badge-success"> Active </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"> InActive </span>
                                                @endif
                                            </td>
                                            <td style="text-align: center !important;">
                                                <a href="{{ route('advert.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm" style="margin-bottom:5px"><i
                                                        class="fa fa-pencil" title="Editer"></i> </a>
                                                @if ($item->status == 1)
                                                    <a href="{{ route('advert.inactive', $item->id) }}"
                                                        class="btn btn-danger btn-sm" title="Desactiver le compte agent"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-down"></i> </a>
                                                @elseif ($item->status == 0)
                                                    <a href="{{ route('advert.active', $item->id) }}"
                                                        class="btn btn-success btn-sm" title="Activer le compte agent"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-up"></i> </a>
                                                @endif
                                                <a href="{{ route('advert.delete', $item->id) }}" id="delete"
                                                    class="btn btn-danger" style="margin-right: 5px;"><i
                                                        class="fa fa-trash"></i></a>

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
