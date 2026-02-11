@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Rendez-vous
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Mes Rendez-vous </h4>
                        <a href="{{ route('appointment.view') }}" class="btn btn-primary"> Mes heures</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date Reservation</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $item)
                                        <tr>
                                            <td>

                                                <p>{{ Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                                                    {{ $item->time }}</p>

                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                {{ $item->email }}
                                            </td>
                                            <td>{{ $item->phone }}</td>

                                            <td style="text-align: center !important;">
                                                <a href="{{ route('booking.delete', $item->id) }}" id="delete"
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
