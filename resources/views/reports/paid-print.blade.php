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
    <h5 class='text-center'>របាយការណ៍រំលស់បានបញ្ចប់</h5>
    <p class="text-center">
        {{$start}} - {{$end}}  {{count($loans)}}
    </p>
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