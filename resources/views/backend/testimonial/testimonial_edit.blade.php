@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Commentaire
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!--========================================
            ADD Commentaire SECTION
            =========================================-->
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Editer </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('testimonial.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $testimonial->id }}">
                            {{-- <input type="hidden" name="old_img" value="{{$Commentaire->Commentaire_img}}"> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Nom <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $testimonial->name }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Metier<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="job" class="form-control"
                                                value="{{ $testimonial->job }}">
                                            @error('job')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Description <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor3" name="comment" id="textarea" class="form-control" required>
                                                {!! $testimonial->comment !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 7th row  -->

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
