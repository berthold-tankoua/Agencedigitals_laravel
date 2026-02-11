@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Ajouter un Service
@endsection


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">

            <div class="box-header with-border">
                <h4 class="box-title">Ajouter un Service </h4>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('add.service.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                <div class="col-12">
                                    <div class="row">


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Titre du service <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" required name="service_name_fr"
                                                        placeholder="Saisir un titre" class="form-control">
                                                    @error('service_name_fr')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                    </div>


                                    <div class="row"> <!-- start 8th row  -->

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Description Fr <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor4" name="short_descp_fr" required class="my-editor form-control" id="my-editor2" cols="20"
                                                        rows="10">
                                                    Description
                                                </textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                    </div> <!-- end 8th row  -->

                                </div> <!-- end col 12  -->

                                <div> <!-- end row  -->

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info"
                                            value="Ajouter le Service">
                                    </div>

                        </form> <!-- end form -->

                        <div> <!-- end col  -->
                            <div> <!-- end row  -->

                                <div> <!-- end box-body  -->

                                    <div> <!-- end box  -->

    </section> <!-- end section  -->



</div><!-- end section  -->


<!--===============================
    JS SCRIPT TO PREVIEW THAMBNAIL IMAGE
    ================================-->

<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

@push('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>

<script>
    CKEDITOR.replace('my-editor', options);
    CKEDITOR.replace('my-editor2', options);
</script>
@endpush
