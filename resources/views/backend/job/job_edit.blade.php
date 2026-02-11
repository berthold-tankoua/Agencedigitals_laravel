@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Emploi
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">

            <div class="box-header with-border">
                <h4 class="box-title">Edit job </h4>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('job.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-12">

                                    <input type="hidden" name="id" value="{{ $job->id }}">
                                    <input type="hidden" name="old_img" value="{{ $job->job_thambnail }}">
                                    <div class="row"> <!-- start 2nd row  -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="job_thambnail"
                                                        placeholder="Inserer une Image" class="form-control"
                                                        onChange="mainThamUrl(this)">
                                                    @error('job_thambnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Titre <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="job_name" class="form-control"
                                                        value="{{ $job->job_name }}">
                                                    @error('job_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <h5>Lieux<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="localisation" class="form-control"
                                                        value="{{ $job->localisation }}">
                                                    @error('localisation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 2nd row  -->

                                    <div class="row"> <!-- start 7th row  -->


                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <textarea id="editor4" name="descp" class="form-control" required>
                                                        {{ $job->descp }}
                                                        </textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                    </div> <!-- end 7th row  -->

                                </div> <!-- end col-12  -->

                            </div>
                            <!-- end row -->

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Mettre a jour">
                            </div>

                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>



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
