@extends('admin.admin_master')

@section('admin')

@section('title')
Cisrep | Subcategory
@endsection
  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-8">
				<div class="box">
					<div class="box-header">
						<h4 class="box-title">SubCategory List <span class="badge badge-danger badge-pill">{{ count($subcategories) }}</span></h4>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="complex_header" class="table table-striped table-bordered display" style="width:100%">
								<thead>
									<tr>
                                        <th>Category</th>

										<th>SubCategory FR</th>
										<th style="text-align: center !important;">Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($subcategories as $item)
									<tr>
                                    <td>{{$item->category->category_name_fr}}</td>
										<td>{{$item->subcategory_name_fr}}</td>
										<td width="20%" style="text-align: center !important;">
                                         <a href="{{route('subcategory.edit',$item->id)}}" class="btn btn-info" style="margin-bottom: 5px;" ><i class="fa fa-pencil"></i></a>
                                         <a href="{{route('subcategory.delete',$item->id)}}" id="delete" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
                                        </td>
									</tr>
                                    @endforeach
								</tbody>

							</table>
						</div>
					</div>
				</div>
			</div>

			{{--===========================================
            Add Subcategory Section
            ============================================--}}
            <div class="col-4">
				<div class="box">
					<div class="box-header">
						<h4 class="box-title">Add SubCategory </h4>
					</div>
					<div class="box-body">
					<form action="{{route('subcategory.store')}}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<h5>Select Category <span class="text-danger">*</span></h5>
							<div class="controls">
								<select id="select" name="category_id" required class="form-control">
									<option value="" selected disabled>Select Category</option>
									@foreach($categories as $item)
										<option value="{{$item->id}}">{{$item->category_name_fr}} </option>
									@endforeach
								</select>
								@error('category_id')
									<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<h5>SubCategory Name FR <span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="subcategory_name_fr" class="form-control" value="">
								@error('subcategory_name_fr')
									<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
						</div>

						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="Add Subactegory">
						</div>
					</form>
					</div>
				</div>
			</div>

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
