@extends('layouts.master')
@section('header')
<strong>រំលស់ឈប់បង់</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
        
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
							<th>ចំនួនខ្ចី</th>
							<th>ការប្រាក់</th>
							<th>បានបង់</th>
							<th>ថ្ងៃឈប់បង់</th>
							<th>មូលហេតុ</th>
						</tr>
					</thead>
					<tbody>			
						<?php
							$pagex = @$_GET['page'];
							if(!$pagex)
							$pagex = 1;
							$i = config('app.row') * ($pagex - 1) + 1;
						?>
						@foreach($stop_payments as $spm)
							<tr>
								<td>{{$i++}}</td>
								<td>
									<a href="{{url('loan/detail/'.$spm->loan_id )}}"><span class="text-teal"><strong>L{{sprintf("%04s",$spm->loan_id )}}</strong></span></a>   </td>
								<td>{{$spm->name}}</td>
								<td>${{number_format($spm->loan_amount,3)}}</td>
								<td>${{number_format($spm->total_interest,3)}}</td>
								<td>${{number_format($spm->paid_amount,3)}}</td>
								<td>{{$spm->stop_date}}</td>
								<td>{{$spm->reason}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		{{$stop_payments->links()}}
		
		
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
		$("#menu_loan_stop").addClass("active");
	});
	
	</script>
@endsection