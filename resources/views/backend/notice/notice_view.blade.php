@extends('admin.admin_master')

@section('admin')

@section('title')
Cisrep | Notice
@endsection

  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
            <div class="row">

                <div class="col-8">
                    <div class="box">
                        <div class="box-header">						
                            <h4 class="box-title">Notice List</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="complex_header" class="table table-striped table-bordered display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product FR</th>
                                            <th>Youtube Links</th>
                                            <th>Status</th>
                                            <th style="text-align: center !important;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($notices as $item)
                                        <tr>
                                        <td><img src="{{ asset($item->product->product_thambnail) }}" style="width: 120px;height: 100px;"></td>
                                            <td>{{$item->product->product_name_fr}}</td>
                                            <td>{{$item->ytb_link}}</td>
                                            <td>
                                             @if($item->status == 1)
                                                <span class="badge badge-pill badge-success"> Active </span>
                                             @else
                                                <span class="badge badge-pill badge-danger"> InActive </span>
                                             @endif
                                            </td>
                                            <td width="10%" style="text-align: center !important;">
                                            <a href="{{route('notice.edit',$item->id)}}" class="btn btn-info" style="margin-bottom:5px"><i class="fa fa-pencil"></i></a>
                                            <a href="{{route('notice.delete',$item->id)}}" id="delete" class="btn btn-danger" style="margin-bottom:5px"><i class="fa fa-trash"></i></a>
                                            @if($item->status == 1)
                                                <a href="{{ route('notice.inactive',$item->id) }}" class="btn btn-danger btn-sm" title="Inactive Now" style="margin-bottom:5px"><i class="fa fa-arrow-down"></i> </a>
                                             @else
                                                <a href="{{ route('notice.active',$item->id) }}" class="btn btn-success btn-sm" title="Active Now" style="margin-bottom:5px"><i class="fa fa-arrow-up"></i> </a>
                                            @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!--========================================
                ADD BRAND SECTION 
                =========================================-->
                <div class="col-4">
                    <div class="box">
                        <div class="box-header">						
                            <h4 class="box-title">Add Notice </h4>
                        </div>
                        <div class="box-body">
                            <form action="{{route('notice.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf	

                                <div class="form-group">
                                    <h5>Select Product <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select id="select" name="product_id" required class="form-control">
                                            <option value="" selected disabled>Select Product</option>
                                            @foreach($products as $item)
                                                <option value="{{$item->id}}">{{$item->product_name_fr}} </option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>				
                                <div class="form-group">
                                    <h5>Youtube link <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="ytb_link" class="form-control" value="">
                                        @error('ytb_link')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Add"> 
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

@endsection