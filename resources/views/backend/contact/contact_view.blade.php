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

                                        <th>Informations</th>
                                        <th>Message</th>
                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $item)
                                        <tr>

                                            <td style="width: 40%">
                                                <p><strong>Recu le:
                                                    </strong>{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                                </p>
                                                <hr>
                                                <p><Strong>Nom:</Strong> {{ $item->name }}</p>
                                                <p><Strong>Email:</Strong> {{ $item->email }}</p>
                                                <p><strong>Tel: </strong><a href="tel:{{ $item->phone }}"></a>
                                                    {{ $item->phone }}</p>
                                            </td>

                                            <td>
                                                <p><strong>Objet:</strong> {{ $item->subject }}</p>
                                                <hr>
                                                {{ $item->message }}
                                            </td>
                                            <td style="text-align: center !important;">
                                                <a href="{{ route('message.delete', $item->id) }}" id="delete"
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
