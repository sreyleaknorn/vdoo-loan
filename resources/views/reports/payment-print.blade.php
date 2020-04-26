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
    <h5 class='text-center'>របាយការណ៍បង់ប្រាក់</h5>
    <p class="text-center">
        {{$start}} - {{$end}}  {{count($payments)}}
    </p>
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