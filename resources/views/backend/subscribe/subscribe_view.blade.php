@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Abonnement
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Abonnement List <span
                                class="badge badge-danger badge-pill">{{ count($subscriptions) }}</span> </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prix</th>
                                        <th>Duree</th>
                                        <th>Avantage</th>
                                        <th>Desavantae</th>
                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriptions as $item)
                                        <tr>
                                            <td>{{ $item->offer_title }}</td>
                                            <td>{{ $item->price }} XAF</td>
                                            <td>{{ $item->validity - 1 }} Jours</td>
                                            <td>{{ $item->advantage }}</td>
                                            <td>{{ $item->disadvantage }}</td>
                                            <td style="text-align: center !important;">
                                                <a href="{{ route('subscription.edit', $item->id) }}"
                                                    class="btn btn-info" style="margin-right: 5px;"><i
                                                        class="fa fa-pencil"></i></a>

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
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Ajouter Abonnement </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('subscription.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <h5>Nom de la subscription<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="offer_title" class="form-control">
                                            @error('offer_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h5>Prix de forfait<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="price" class="form-control">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="listing">Nombre de Listing</label>
                                        <input type="number" min="0" name="listing" id="listing"
                                            class="form-control" value="0" />
                                        @error('listing')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="percent">Pourcentage Percu</label>
                                        <input type="number" min="0" name="percent" id="percent"
                                            class="form-control" value="0" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="validity">Duree du forfait</label>
                                        <input type="number" min="0" name="validity" id="validity"
                                            class="form-control" value="0" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Petite Description<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="desc_fr" class="form-control">
                                            @error('desc_fr')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Avantages <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="advantage" class="form-control" value="Aucun"
                                                data-role="tagsinput">
                                            @error('advantage')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Desavantages <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="disadvantage" class="form-control"
                                                value="Aucun" data-role="tagsinput">
                                            @error('disadvantage')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Ajouter un Abonnement">
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
