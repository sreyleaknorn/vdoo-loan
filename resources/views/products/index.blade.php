@extends('layouts.master')
@section('header')
	<strong>Products</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
		<div class="row">
			<div class="col-sm-3">
				
				<a href="{{url('product/create')}}"class="btn btn-primary btn-oval btn-sm">
					<i class="fa fa-plus-circle"></i> Create
				</a>
				
			</div>
			<div class="col-sm-8">
				<form action="{{url('product/search')}}" method="GET">
					Search:
					<input type="text" name='q' value='{{$q}}'>
					<button>Find</button>
				</form>
			</div>
		</div>
	</div>
	<div class="card-block">
		@component('coms.alert')
		@endcomponent
		<table class="table table-sm table-bordered">
			<thead>
				<tr>
					<th>#</th>

					<th>Code</th>
					<th>Barcode</th>
					<th>Name</th>
					<th>Kh Name</th>
					<th>Price</th>
					<th>Onhand</th>
					<th>Unit</th>
					<th>Category</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$pagex = @$_GET['page'];
					if(!$pagex)
						$pagex = 1;
					$i = config('app.row') * ($pagex - 1) + 1;
				?>
				@foreach($products as $p)
					<tr>
						<td>{{$i++}}</td>

						<td>
							<a href="{{url('product/detail/'. $p->id)}}">
								{{$p->code}}
							</a>
						</td>
						<td>{{$p->barcode}}</td>
						<td>
							<a href="{{url('product/detail/'. $p->id)}}">
								{{$p->name}}
							</a>
						</td>
						<td>{{$p->kh_name}}</td>
						<td>${{$p->price}}</td>
						<td>{{$p->onhand}}</td>
						<td>{{$p->uname}}</td>
						<td>{{$p->cname}}</td>
						<td class='action'>
							<a href="{{url('product/delete?id='.$p->id)}}" title="Delete" class='text-danger'
							 onclick="return confirm('You want to delete?')">
								<i class="fa fa-trash"></i>
							</a>&nbsp;
							<a href="{{url('product/edit/'.$p->id)}}" class="text-success" title="Edit">
								<i class="fa fa-edit"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $products->appends(request()->except('q'))->links() }}
	</div>
</div>

@endsection
@section('js')
<script>
	$(document).ready(function(){
		$("#sidebar-menu li").removeClass('active');
		$("#menu_product").addClass('active');
	});

</script>
@endsection
