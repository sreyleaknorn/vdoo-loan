<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Payment Report Printing | Vdoo ERP</title>
		<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
		<style>
			@font-face{
            font-family: kh;
            src: url('{{asset('fonts/KhmerOSmuollight.ttf')}}');
			}
			@font-face{
            font-family: kh1;
            src: url('{{asset('fonts/KhmerOSsiemreap.ttf')}}');
			}
			.khmoul{
            font-family: kh;
			}
			.kh{
            font-family: kh1;
			}
			th, td, div, p, span, label{
            font-family: kh1;
			}
		</style>
	</head>
	<body>
		<table class="table">
			<tr>
				<td style="width: 200px" class='text-center'>
					<img src="{{asset($com->logo)}}" alt="" width="120">
				</td>
				<td class='text-center'>
					<p></p>
					<h4 class="text-primary khmoul">{{$com->kh_name}}</h4>
					<h5>{{$com->en_name}}</h5>
					<p>{{$com->address}}</p>
				</td>
				<td style='width:100px'></td>
			</tr>
		</table>
		<hr>
		<h5 class='text-center'>តារាងប្រាក់ត្រូវបង់</h5>
		@if($q == '')
			<p class="text-center">
			{{$start}} - {{$end}} 
			
			</p>
			@if($s_name != '')
				<p  class="text-center"> ហាង​ :  {{$s_name}} </p>
			@endif
		@endif	
		<table class="table table-sm table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>លេខសំគាល់</th>
					<th>អតិថិជន</th>
					<th>ហាង</th>
					<th>ថ្ងៃត្រូវបង់</th>
					<th>ប្រាក់ដើម</th>
					<th>ការប្រាក់</th>
					<th>ចំនួនសរុប</th>
					<th>ចំនួនបានបង់</th>
					<th>ចំនួននៅខ្វះ</th>
					<th>ថ្ងៃបានបង់</th>
					
				</tr>
			</thead>
			<tbody>
				@php($i=1)
				@foreach($loanschedules as $ls)
				<?php
					$txt_class = '';
					if ($ls->pay_date < date('Y-m-d') && $ls->ispaid == 0) {
						$txt_class = 'text-danger';
					}
				?>
				<tr class="{{$txt_class}}" >
					<td>{{$i++}}</td>
					<td>
						<a href="{{url('loan/detail/'.$ls->loan_id )}}"><span class="text-teal"><strong>L{{sprintf("%04s",$ls->loan_id )}}</strong></span></a>   
					</td>
					<td>{{$ls->name}}</td>
					<td>{{$ls->shop_name}}</td>
					<td>{{$ls->pay_date}}</td>
					<td>${{number_format($ls->principal_amount,3)}}</td>
					<td>${{number_format($ls->interest_amount,3)}}</td>
					<td>${{number_format($ls->total_amount,3)}}</td>
					<td>${{number_format($ls->paid_amount,3)}}</td>
					<td>${{number_format($ls->due_amount,3)}}</td>
					<td>{{$ls->paid_date}}</td>
					
				</tr>
				@endforeach
			</tbody>
		</table>
		
		
		<table width="100%">
			<tr>
				<td class='text-center'>
					Prepared By <br><br>
					______________
				</td>
				<td class='text-center'>
					Approved By <br><br>
					______________
				</td>
			</tr>
		</table>
		<p>&nbsp;</p>
		<script>
			print();
		</script>
	</body>
</html>