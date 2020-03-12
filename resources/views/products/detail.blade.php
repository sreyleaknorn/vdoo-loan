@extends('layouts.master')
@section('header')
	<strong>Product Detail</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
		
		<a href="{{url('product/create')}}"class="btn btn-primary btn-oval btn-sm">
			<i class="fa fa-plus-circle"></i> Create
		</a>
		<a href="{{url('product/edit/'.$p->id)}}" class="btn btn-primary btn-oval btn-sm">
			<i class="fa fa-edit"></i> Edit
		</a>
		<a href="{{url('product/delete?id='.$p->id)}}" class="btn btn-danger btn-oval btn-sm" 
			onclick="return confirm('You want to delete?')">
			<i class="fa fa-trash"></i> Delete
		</a>
		<a href="{{url('product')}}" class="btn btn-warning btn-oval btn-sm">
			<i class="fa fa-reply"></i> Back
		</a>
	</div>
	<div class="card-block">
		@component('coms.alert')
		@endcomponent
        <form>
        <div class="row">
            <div class="col-sm-6">
                
                <div class="form-group row">
					<label class="col-sm-3 form-control-label">Code</label>
					<div class="col-sm-9">
                        : {{$p->code}}
					</div>
                </div>
                <div class="form-group row">
					<label class="col-sm-3 form-control-label">Name</label>
					<div class="col-sm-9">
                        : {{$p->name}}
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 form-control-label">Kh Name</label>
					<div class="col-sm-9">
						: {{$p->kh_name}}
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 form-control-label">Barcode</label>
					<div class="col-sm-9">
                        : {{$p->barcode}}
					</div>
                </div>
                <div class="form-group row">
					<label class="col-sm-3 form-control-label">Price</label>
					<div class="col-sm-9">
                        : $ {{$p->price}}
					</div>
                </div>
                
                <div class="form-group row">
					<label class="col-sm-3 form-control-label">Category</label>
					<div class="col-sm-9">
						: {{$p->cname}}
					</div>
                </div>
				<div class="form-group row">
					<label class="col-sm-3">Discount</label>
					<div class="col-sm-9">
						: {{$p->discount}}%
					</div>
				</div>`
				<div class="form-group row">
					<label class="col-sm-3">Description</label>
					<div class="col-sm-9">
                        : {{$p->description}}
					</div>
				</div>
				
            </div>
            <div class="col-sm-5">
				<div class="form-group row">
					<label class="col-sm-3">Onhand</label>
					<div class="col-sm-9">
                        : {{$p->onhand}} ({{$p->uname}})
					</div>
				</div>
				<div class="form-group row">
					
					<div class="col-sm-9">
						<a href="#" data-toggle='modal' data-target='#view' 
							onclick="preview('{{asset($p->photo)}}')">
							<img src="{{asset($p->photo)}}" alt="" width="150">
						</a>
					</div>
				</div>
				
				
				<p>
					<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($p->barcode, 'C39', 2, 42)}}" width="150" height="50"/>
				</p>
				
            </div>
		</div>
		
		</form>
    </div>
   
</div>
<!-- Modal to view image -->
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="#" method="POST">
			<div class="modal-content">
			<div style="padding: 3px; text-align:right">
				<button type="button" class="btn btn-danger btn-sm btn-oval" 
				data-dismiss="modal">X</button>	
			</div>	
				<div class="modal-body">
				<img src="" alt="" width="100%" id='preview'>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
@section('js')
<script>
	$(document).ready(function(){
		$("#sidebar-menu li").removeClass('active');
		$("#menu_product").addClass('active');
		
	});
	function preview(url)
	{
		$('#preview').attr('src', url);
		
	}
</script>
@endsection