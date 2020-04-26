@extends('layouts.master')
@section('header')

<strong>តារាងប្រាក់បានបង់</strong>
@endsection

@section('content')

<div class="card card-gray">
	<div class="toolbox">
		<form action="{{url('report/payment/search')}}">
			<p>
				ហាងទូរស័ព្ទ: <select name="shop">
					<option value="all"> --All-- </option>
					@foreach($shops as $s)
					<option value="{{$s->id}}" {{$s->id==$sh?'selected':''}}>{{$s->name}}</option>
					@endforeach
				</select>
				From: <input type="date" name='start' value="{{$start}}"> &nbsp;&nbsp;
				To: <input type="date" name="end" value="{{$end}}">
				<button>View</button>
			</p>
		</form>
	</div>
	<div class="card-block">
		@if(count($payments)>0)
		<a href="{{url('report/payment/print?shop='.$sh .'&start='.$start.'&end='.$end)}}" target="_blank" class="btn btn-primary btn-sm btn-oval">
			<i class="fa fa-print"></i> Print
		</a>
		
		
		<table class="table table-sm table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>លេខកូដ</th>
					<th>អតិថិជន</th>
					<th>ហាង</th>
					<!-- <th>ថ្ងៃត្រូវបង់</th> -->
					<th>ប្រាក់ដើម</th>
					<th>ការប្រាក់</th>
					<th>ចំនួនសរុប</th>
					<th>ចំនួនបានបង់</th>
					<!-- <th>ថ្ងៃបានបង់</th> -->
				</tr>
			</thead>
			<tbody>
				@php($i=1)
				@php($total1=0)
				@php($total2=0)
				@php($total3=0)
				@php($total4=0)
				@php($schedules=array())
				@php($loan_arr=array())
				@php($principal_arr=array())
				@php($interest_arr=array())
				@php($total_arr=array())
				@php($paid_arr=array())
				@php($cust_name=array())
				@php($shop_arr=array())
				
				@foreach($payments as $p)
				
				
				<?php 
					
					if (array_search($p->loan_id, $loan_arr) === FALSE) {
						$loan_arr[] = $p->loan_id;
						$schedules[] = $p->loanschedule_id;
						$cust_name[$p->loan_id] = $p->name.' - '.$p->phone;
						$shop_arr[$p->loan_id] = $p->shop_name;
						$principal_arr[$p->loan_id] = $p->principal_amount;
						$interest_arr[$p->loan_id] = $p->interest_amount;
						$total_arr[$p->loan_id] = $p->total_amount;
						$paid_arr[$p->loan_id] = $p->receive_amount;
						}else {
						if (array_search($p->loanschedule_id, $schedules) === FALSE) {
							$schedules[] = $p->loanschedule_id;
							
							$principal_arr[$p->loan_id] += $p->principal_amount;
							$interest_arr[$p->loan_id] += $p->interest_amount;
							$total_arr[$p->loan_id] += $p->total_amount;
							
							} else {
							$dubplicate = 1;
						}
						$paid_arr[$p->loan_id] += $p->receive_amount;
					}
				?>
				@endforeach
				
				
				@php($s=1)
				@foreach($loan_arr as $loan_id)
                <tr>
				<td>{{$s++}}</td>
				<td>
					<a href="{{url('loan/detail/'.$loan_id)}}"><span class="text-teal"><strong>L{{sprintf("%04s",$loan_id)}}</strong></span></a>   </td>
				<td>{{$cust_name[$loan_id]}}</td>
				<td>{{$shop_arr[$loan_id]}}</td>
				<!-- <td>{{$p->pay_date}}</td> -->
				
				<td>$ {{number_format($principal_arr[$loan_id],3)}}</td>
				<td>$ {{number_format($interest_arr[$loan_id],3)}}</td>
				<td>$ {{number_format($total_arr[$loan_id], 3)}}</td>
				
				<td>$ {{number_format($paid_arr[$loan_id], 3)}}</td>
                </tr>
                <?php 
                    $total1 += $principal_arr[$loan_id];
                    $total2 += $interest_arr[$loan_id];
                    $total3 += $total_arr[$loan_id];
                    $total4 += $paid_arr[$loan_id];
                ?>
				@endforeach
				<tr>
					<td colspan="4" class="text-right">
						<strong class="text-danger">សរុបរួម</strong>
					</td>
					<td>
						<strong class="text-danger">$ {{number_format($total1,3)}}</strong>
					</td>
					<td>
						<strong class="text-danger">$ {{number_format($total2, 3)}}</strong>
					</td>
					<td>
						<strong class="text-danger">$ {{number_format($total3, 3)}}</strong>
					</td>
					<td colspan="2">
						<strong class="text-danger">$ {{number_format($total4, 3)}}</strong>
					</td>
				</tr>
				<?php $revenue =  $total4 - $total1; ?>
						<tr>
							<td colspan="4" class="text-right">
								<strong class="text-success">ប្រាក់ចំនេញ</strong>
							</td>
							<td colspan="5">
								<strong class="text-success">$ {{number_format($revenue, 3)}}</strong>
							</td>
						</tr>
			</tbody>
		</table>
		
		@else
		<p>
			No data found!
		</p>
		@endif
	</div>
</div>

@endsection

@section('js')
<script>
	$(document).ready(function() {
		$("#sidebar-menu li ").removeClass("active open");
		$("#sidebar-menu li ul li").removeClass("active");
		
		$("#menu_report").addClass("active open");
		$("#report_collapse").addClass("collapse in");
		$("#menu_report1").addClass("active");
		
	})
</script>
@endsection
