@extends('admin.admin_master')

@section('admin')

@section('title')
Admin - Profile
@endsection

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <!-- {{ asset('') }} -->
		<!-- {{ Auth::guard('admin')->user()->name }} -->
				  <div class="box box-widget widget-user">
                      <div class="d d-flex justify-content-between">
                      <h4 class="  m-lg-3">  Admin name : {{$admindata->name}}</h4>
					  
                      </div>
                  <h4 class="widget-user-desc m-lg-3">  Admin email : {{$admindata->email}}</h4>
					  <div class="box-body text-center pb-50">
						<a href="#"> 
						  <img class="" src="{{ asset('frontend/logo.png') }}" width="200px" height="200px">
						</a>
					  </div>

					  <ul class="box-body flexbox flex-justified text-center" data-overlay="4">
                        <li><a href="{{route('admin.profile_edit')}}" style="width:150px" class="btn btn-primary mb-5 float-end">Edit Profil</a> </li>
					  </ul>
					</div>				


				</div>

        </div>
    </section>
    <!-- /.content -->

@endsection