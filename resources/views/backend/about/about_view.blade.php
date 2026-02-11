@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | A propos
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">A Propos </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Localisation</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Social Media</th>


                                        <th style="text-align: center !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($abouts as $item)
                                        <tr>
                                            <td>{{ $item->country }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <p>Instagram : {{ $item->instagram_link }} </p>
                                                <p>Facebook : {{ $item->facebook_link }}</p>
                                                <p>Twitter : {{ $item->twitter_link }}</p>
                                            </td>
                                            <td style="text-align: center !important;">
                                                <a href="{{ route('about.edit', $item->id) }}" class="btn btn-info"
                                                    style="margin-right: 5px;"><i class="fa fa-pencil"></i></a>

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
            <div class="col-12" style="display: none;">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Ajouter </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5> Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" id="image" name="about_img" class="form-control">

                                    <img src="" alt="AgenceDigitals" id="showImg">

                                    @error('about_img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Pays <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="country" class="form-control">
                                            @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Telephone <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="phone" class="form-control">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Email <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="email" class="form-control">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Qui Sommes nous.? <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor3" name="desc1" id="textarea" class="form-control" required>
                                                Longue Description French
                                            </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Notre Vision <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor4" name="desc2" id="textarea" class="form-control" required>
                                                Courte Description French
                                            </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Notre Mission <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea id="editor1" name="desc3" id="textarea" class="form-control" required>
                                                Courte Description French
                                            </textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 7th row  -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Facebook link <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="flink" class="form-control">
                                            @error('flink')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Instagram link <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="ilink" class="form-control">
                                            @error('ilink')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Twitter Link <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="tlink" class="form-control">
                                            @error('tlink')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Ajouter">
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
