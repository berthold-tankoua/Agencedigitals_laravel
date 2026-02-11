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
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Editer Devise </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('currency.update') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <input type="hidden" name="id" value="{{ $currency->id }}">
                            <div class="form-group">
                                <h5>Nom de la devise<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control" required
                                        oninvalid="this.setCustomValidity('Saisir le nom de la devise')"
                                        oninput="this.setCustomValidity('')" value="{{ $currency->name }}">
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
                                        oninput="this.setCustomValidity('')" value="{{ $currency->code }}">
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Symbole de la devise<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="symbol" class="form-control"
                                        value="{{ $currency->symbol }}">
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
                                        oninput="this.setCustomValidity('')" value="{{ $currency->exchange_rate }}">
                                    @error('exchange_rate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Status<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="status"class="form-control">
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>

                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Mettre a jour">
                            </div>

                        </form>
                        <!-- /.form -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<!--=================================
    JS SCRIPT TO PREVIEW SLIDER
    ==================================-->

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
