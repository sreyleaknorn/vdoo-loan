@extends('layouts.master')
@section('header')
<strong>រំលស់</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
        <a href="{{url('loan/create')}}"class="btn btn-primary btn-oval btn-sm">
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
							<th>លេខសំគាល់</th>
							<th>អតិថិជន</th>
							<th>ហាងទូរស័ព្ទ</th>
							<th>ម៉ូដែលទូរស័ព្ទ</th>
							<th>ចំនួនខ្ចី</th>
							<th>ការប្រាក់</th>
							<th>សរុប</th>
							<th>បានបង់</th>
							<th>នៅខ្វះ</th>
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
						@foreach($loans as $loan)
						<tr>
							<td>{{$i++}}</td>
							<td>
							<a href="{{url('loan/detail/'.$loan->id)}}"><span class="text-teal"><strong>L{{sprintf("%04s",$loan->id)}}</strong></span></a>   </td>
							<td><a href="{{url('loan/detail/'.$loan->id)}}">{{$loan->name}}</a></td>
							<td>{{$loan->model_name}}</td>
							<td>{{$loan->shop_name}}</td>
							<td>${{number_format($loan->loan_amount,3)}}</td>
							<td>{{$loan->loan_interest}}%</td>
							<td>${{number_format($loan->total_amount,3)}}</td>
							<td>${{number_format($loan->paid_amount,3)}}</td>
							<td>${{number_format($loan->due_amount,3)}}</td>
							<td class="action">
								<a href="{{url('loan/delete?id='.$loan->id)}}" title="Delete" class='text-danger'
								onclick="return confirm('អ្នកពិតជាចង់លុបទិន្នន័យ?')">
									<i class="fa fa-trash"></i>
								</a>&nbsp;
								
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		{{$loans->links()}}
		
		
	</div>
</div>
@endsection

@section('js')
<script>
	$(document).ready(function () {
		$("#sidebar-menu li ").removeClass("active open");
		$("#sidebar-menu li ul li").removeClass("active");
		
		$("#menu_loan").addClass("active open");
		$("#loan_collapse").addClass("collapse in");
		$("#menu_all_loan").addClass("active");
	});
	
	</script>
@endsection