@extends('layouts.master')
@section('header')

<strong>រំលស់បានបញ្ចប់</strong>
@endsection

@section('content')

<div class="card card-gray">
	<div class="toolbox">
		<form action="{{url('report/paid/search')}}">
			<p>
				ហាងទូរស័ព្ទ: <select name="shop">
					<option value="all"> --All-- </option>
					@foreach($shops as $s)
					<option value="{{$s->id}}" {{$s->id==$sh?'selected':''}}>{{$s->name}}</option>
					@endforeach
				</select>
				បានបញ្ចប់ ចាប់ពីថ្ងៃ: <input type="date" name='start' value="{{$start}}"> &nbsp;&nbsp;
				ដល់ថ្ងៃ: <input type="date" name="end" value="{{$end}}">
				<button>ស្វែងរក</button>
			</p>
		</form>
	</div>
	<div class="card-block">
		@if(count($loans)>0)
		<a href="{{url('report/paid/print?shop='.$sh .'&start='.$start.'&end='.$end)}}" target="_blank" class="btn btn-primary btn-sm btn-oval">
			<i class="fa fa-print"></i> Print
		</a>
		<table class="table table-sm table-striped table-bordered table-hover flip-content">
                    <thead class="flip-header">
                        <tr>
                            <th>#</th>
                            <th>លេខសំគាល់</th>
                            <th>អតិថិជន</th>
                            <th>ហាងទូរស័ព្ទ</th>
                            <th>ចំនួនខ្ចី</th>
							<th>ការប្រាក់</th>
                            <th>សរុប</th>
                            <th>បានបង់</th>
							<th>ថ្ងៃបញ្ចប់</th>
                        </tr>
                    </thead>
                    <tbody>		
					@php($total1=0)
				@php($total2=0)
				@php($total3=0)
				@php($total4=0)	
                        <?php
                        $pagex = @$_GET['page'];
                        if (!$pagex)
                            $pagex = 1;
                        $i = config('app.row') * ($pagex - 1) + 1;
                        ?>
                        @foreach($loans as $loan)
                        <tr>
                            <?php
                            $status = $loan->status;
                            $color = '';
                            switch ($status) {
                                case "new":
                                    $status = "ថ្មី";
                                    $color = 'badge-primary';
                                    break;
                                case "paying":
                                    $status = "កំពុងបង់";
                                    $color = 'badge-warning';
                                    break;
                                case "paid":
                                    $status = "បានបញ្ចប់";
                                    $color = 'badge-success';
                                    break;
                                default:
                                    $color = 'badge-danger';
                                    $status = "ឈប់បង់";
                            }
                            ?>

                            <td>{{$i++}}</td>
                            <td>
                                <a href="{{url('loan/detail/'.$loan->id)}}"><span class="text-teal"><strong>L{{sprintf("%04s",$loan->id)}}</strong></span></a>   </td>
                            <td><a href="{{url('loan/detail/'.$loan->id)}}">{{$loan->name}}</a></td>
                            <td>{{$loan->shop_name}}</td>
                            <td>${{number_format($loan->loan_amount,3)}}</td>
							<td>${{number_format($loan->total_interest,3)}}</td>
                            <td>${{number_format($loan->total_amount,3)}}</td>
                            <td>${{number_format($loan->paid_amount,3)}}</td>
                            <td>{{$loan->paid_date}}</td>
							<?php 
								$total1 += $loan->loan_amount;
								$total2 += $loan->total_interest;
								$total3 += $loan->total_amount;
								$total4 += $loan->paid_amount;
							?>
                        </tr>
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
							<td colspan="5" class="text-right">
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
		$("#menu_report3").addClass("active");
		
	})
</script>
@endsection
