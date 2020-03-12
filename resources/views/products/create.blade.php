@extends('layouts.master')
@section('css')
	<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
@endsection
@section('header')
	<strong>Create Product</strong>
@endsection
@section('content')
<form action="{{url('product/save')}}" method="POST" enctype="multipart/form-data">
<div class="card card-gray">
	<div class="toolbox">
		<button class="btn btn-primary btn-oval btn-sm" type="submit">
			<i class="fa fa-save"></i> Save
		</button>
		<a href="{{url('product')}}"class="btn btn-warning btn-oval btn-sm">
			<i class="fa fa-reply"></i> Back
		</a>
	</div>
	<div class="card-block">
        <div class="col-md-12">
			@component('coms.alert')
			@endcomponent
        </div>
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-6">
				<div class="form-group row">
					<label for="code" class="col-sm-3">Code</label>
					<div class="col-sm-9">
						<input type="text" class="form-control"  name="code" id="code" value="{{old('code')}}" >
					</div>
				</div>
                <div class="form-group row">
					<label for="name" class="col-sm-3">Name <span class="text-danger">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" required autofocus >
					</div>
                </div>
				<div class="form-group row">
					<label for="kh_name" class="col-sm-3">Kh Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="kh_name" id="kh_name" value="{{old('kh_name')}}" >
					</div>
                </div>
				<div class="form-group row">
					<label for="barcode" class="col-sm-3">Barcode</label>
					<div class="col-sm-9">
						<input type="text" class="form-control"  name="barcode" id="barcode" value="{{old('barcode')}}" >
					</div>
                </div>
                <div class="form-group row">
					<label for="price" class="col-sm-3">Price ($) </label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="price" id="price" value="0" >
					</div>
                </div>

				
                <div class="form-group row">
					<label for="category" class="col-sm-3">
						Category
					</label>
					<div class="col-sm-9">
						<div class="row">
							<div class="col-sm-11" style='padding-right: 1px'>
								<select name="category" id="category" class="form-control chosen-select">
									<option value="">-- Select --</option>
									@foreach($categories as $cat)
										<option value="{{$cat->id}}">{{$cat->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-1" style='padding-left: 0'>
								
								<button class="btn btn-primary btn-add" type='button' data-toggle='modal' 
									data-target='#catModal'>+</button>
								
							</div>
						</div>
					</div>
				</div>

            </div>
            <div class="col-sm-6">
				<div class="form-group row">
					<label for="discount" class="col-sm-3">Discount (%) </label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="discount" id="discount" value="0" >
					</div>
                </div>
				<div class="form-group row">
					<label for="unit" class="col-sm-3">Unit</label>
					<div class="col-sm-7">
							<div class="row">
								<div class="col-sm-11" style='padding-right: 1px'>
									<select name="unit" id="unit" class="form-control chosen-select" required>
										<option value="">-- Select --</option>
										@foreach($units as $unit)
											<option value="{{$unit->id}}">{{$unit->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-1" style='padding-left: 0'>
									<button class="btn btn-primary btn-add" type='button' data-toggle='modal' 
										data-target='#unitModal'>+</button>
								</div>
							</div>
						
					</div>
				</div>
				
				<div class="form-group row">
					<label for="description" class="col-sm-3">Description</label>
					<div class="col-sm-7">
						<textarea name="description" id="description" rows="3" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="photo" class="col-sm-3">Photo</label>
					<div class="col-sm-7">
					<input type="file" class="form-control" name="photo" id="photo" 
						accept="image/x-png,image/gif,image/jpeg" onchange="preview(event)">
						<br>
						<img src="" alt="" id="img" width="120">
					</div>
				</div>
			
            </div>
		</div>
    </div>
   
</div>
</form>
<!-- Modal to create new category -->
<div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="catModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="#">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <div class="form-group row">
                    <label for="name" class="col-sm-3">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="catname">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div style='padding: 5px'>
					<button type="button" class="btn btn-primary btn-sm  btn-oval" id="btn" 
						onclick="saveCat()"> <i class="fa fa-save"></i> Save</button>
					<button type="button" class="btn btn-danger btn-sm btn-oval" 
						data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </div>
        </div>
    </form>
  </div>
</div> 
<!-- Modal to create new unit -->
<div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="unitModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <form action="#">
		  <div class="modal-content">
			  <div class="modal-header">
				  <h5 class="modal-title">Create Unit</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
				  </button>
			  </div>
			  <div class="modal-body">
				  <div class="form-group row">
					  <label for="uname" class="col-sm-3">Name <span class="text-danger">*</span></label>
					  <div class="col-sm-9">
						  <input type="text" class="form-control form-control-sm" id="uname">
					  </div>
				  </div>
				 
			  </div>
			  <div class="modal-footer">
				  <div style='padding: 5px'>
					  <button type="button" class="btn btn-primary btn-sm  btn-oval" id="btn" 
						  onclick="saveUnit()"><i class="fa fa-save"> Save</i></button>
					  <button type="button" class="btn btn-danger btn-sm btn-oval" 
						  data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
				  </div>
			  </div>
		  </div>
	  </form>
	</div>
  </div> 
@endsection
@section('js')
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/product.js')}}"></script>
<script>
	var burl = "{{url('/')}}";
	$(document).ready(function(){
		$("#sidebar-menu li").removeClass('active');
		$("#menu_product").addClass('active');
		$('#supplier').select2();
	});
	function preview(e){
		var img = document.getElementById('img');
		img.src = URL.createObjectURL(e.target.files[0]);
	}

</script>
@endsection