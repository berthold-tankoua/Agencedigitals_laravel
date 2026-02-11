@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Devise
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Devise List <span
                                class="badge badge-danger badge-pill">{{ count($currencies) }}</span> </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>code</th>
                                        <th>Prix(XAF)</th>
                                        <th>Status</th>
                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currencies as $item)
                                        <tr>

                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->symbol }} | {{ $item->code }}</td>
                                            <td>{{ $item->exchange_rate }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td style="text-align: center !important;">
                                                <a href="{{ route('currency.edit', $item->id) }}" class="btn btn-info"
                                                    style="margin-right: 5px;"><i class="fa fa-pencil"></i></a>
                                                {{-- <a href="{{route('category.delete',$item->id)}}" id="delete" class="btn btn-danger" ><i class="fa fa-trash"></i></a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- /.col-md-6 1 end -->


            <!--========================================
            ADD CATEGORY SECTION
            =========================================-->
            <div class="col-4">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Ajouter une Devise </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('currency.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Nom de la devise<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control" required
                                        oninvalid="this.setCustomValidity('Saisir le nom de la devise')"
                                        oninput="this.setCustomValidity('')">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Code de la devise<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="code" class="form-control" required
                                        oninvalid="this.setCustomValidity('Saisir le code de la devise')"
                                        oninput="this.setCustomValidity('')">
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Symbole de la devise<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="symbol" class="form-control">
                                    @error('symbol')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Valeur en FCFA<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="" name="exchange_rate" class="form-control" required
                                        oninvalid="this.setCustomValidity('Saisir la valeur en FCFA')"
                                        oninput="this.setCustomValidity('')">
                                    @error('exchange_rate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Ajouter une devise">
                            </div>
                        </form>
                    </div>
                </div> <!-- /.box -->
            </div> <!-- /.col-12 2 end -->

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
