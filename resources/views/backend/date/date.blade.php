@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Date
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Nos Dates </h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Heure</th>

                                        <th>Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dates as $item)
                                        <tr>
                                            <td> {{ $item->time }}</td>

                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-pill badge-success"> Active </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"> InActive </span>
                                                @endif
                                            </td>
                                            <td style="text-align: center !important;">

                                                @if ($item->status == 1)
                                                    <a href="{{ route('appointment.inactive', $item->id) }}"
                                                        class="btn btn-danger btn-sm" title="Desactiver l'heure"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-down"></i> </a>
                                                @elseif ($item->status == 0)
                                                    <a href="{{ route('appointment.active', $item->id) }}"
                                                        class="btn btn-success btn-sm" title="Activer l'heure"
                                                        style="margin-bottom:5px"><i class="fa fa-arrow-up"></i> </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <input type="submit" class="close" data-dismiss="modal" aria-label="Close" value="x">

                    </input>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.inactive.msg') }}" method="POST">
                        @csrf
                        <input type="hidden" name="store_id" id="store_id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Message <span class="text-danger">*</span></h5><br>
                                <div class="controls">
                                    <textarea name="msg" id="textarea" class="form-control" rows="5">
                                    Laisser un message
                                </textarea>
                                </div>
                            </div>
                        </div> <!-- end col md 6 -->
                        <input type="submit" value="Envoyer message">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    <script>
        function InactiveMsgView(id) {

            $('#store_id').val(id);
        }
    </script>
</div>
@endsection
