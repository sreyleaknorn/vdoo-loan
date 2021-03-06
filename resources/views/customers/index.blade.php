@extends('layouts.master')
@section('header')
<strong>អតិថិជន</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
        <a href="{{url('customer/create')}}"class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-plus-circle"></i> បង្កើត
		</a>
	</div>
	<div class="card-block">
		
		@component('coms.alert')
		@endcomponent
		<div class="table-flip-scroll">
			<div class="table-responsive">
				<table class="table table-sm table-striped table-bordered table-hover flip-content">
					<thead class="flip-header">
						<tr>
							<th>#</th>
							<th>ឈ្មោះ</th>
							<th>លេខទូរស័ព្ទ</th>
							<th>សកម្មភាព</th>
						</tr>
					</thead>
					<tbody>			
						<?php
							$pagex = @$_GET['page'];
							if(!$pagex)
							$pagex = 1;
							$i = config('app.row') * ($pagex - 1) + 1;
						?>
						@foreach($customers as $cat)
						<tr>
							<td>{{$i++}}</td>
							<td>
								{{$cat->name}}
							</td>
							
							<td>{{$cat->phone}}</td>
							
							<td class="action">
								<a href="{{url('customer/delete?id='.$cat->id)}}" title="Delete" class='text-danger'
								onclick="return confirm('អ្នកពិតជាចង់លុបទិន្នន័យ?')">
									<i class="fa fa-trash"></i>
								</a>&nbsp;
								<a href="{{url('customer/edit/'.$cat->id)}}" class="text-success" title="Edit">
									<i class="fa fa-edit"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<p>&nbsp;</p>
		{{$customers->links()}}
		
		
	</div>
</div>
@endsection

@section('js')
<script>
	$(document).ready(function () {
		$("#sidebar-menu li").removeClass('active');
		$("#menu_customer").addClass('active');
	})
</script>
@endsection