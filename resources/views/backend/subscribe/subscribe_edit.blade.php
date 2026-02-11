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
            <!--========================================
            ADD CATEGORY SECTION
            =========================================-->
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Editer Abonnement </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('subscription.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $subscription->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Nom de la subscription<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="offer_title" class="form-control"
                                                value="{{ $subscription->offer_title }}">
                                            @error('offer_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Prix de subscription<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="integer" name="price" class="form-control"
                                                value="{{ $subscription->price }}">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="listing">Nombre de publication</label>
                                        <input type="number" min="0" name="listing" id="listing"
                                            class="form-control" value="{{ $subscription->listing }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="percent">Pourcentage Percu</label>
                                        <input type="number" min="0" name="percent" id="percent"
                                            class="form-control" value="{{ $subscription->percent }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="validity">Duree du forfait</label>
                                        <input type="number" min="0" name="validity" id="validity"
                                            class="form-control" value="{{ $subscription->validity }}" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Petite Description<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="desc_fr" class="form-control"
                                                value="{{ $subscription->desc_fr }}">
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
                                            <input type="text" name="advantage" class="form-control"
                                                value="{{ $subscription->advantage }}" data-role="tagsinput">
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
                                                value="{{ $subscription->disadvantage }}" data-role="tagsinput">
                                            @error('disadvantage')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Mettre a Jour">
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
