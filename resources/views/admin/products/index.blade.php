@extends('admin.layouts.admin_master')
@section('content')


  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">
		  <div class="row">



			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Product List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="text-align: center">Image </th>
								<th style="text-align: center">Product Name</th>
								<th style="text-align: center">Barcode</th>
								<th style="text-align: center">Quantity </th>
								<th style="text-align: center">Action</th>

							</tr>
						</thead>
						<tbody>
	 @foreach($products as $item)
	 <tr>
		<td style="text-align: center"> <img src="{{ asset($item->product_thambnail) }}" style="width: 60px; height: 50px;">  </td>
		<td style="text-align: center">{{ $item->product_name}}</td>
		 <td style="text-align: center"></td>
		 <td style="text-align: center">{{ $item->product_qty }}</td>
		<td style="text-align: center">
 <a href="{{route('admin.edit.products', $item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>
 <a href="#" class="btn btn-danger" title="Delete Data" id="delete">
 	<i class="fa fa-trash"></i></a>
		</td>

	 </tr>
	  @endforeach
						</tbody>

					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->


			</div>
			<!-- /.col -->





		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>




@endsection
