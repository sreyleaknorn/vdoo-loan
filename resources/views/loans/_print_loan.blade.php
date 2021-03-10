<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>រំលស់</title>
		<style>
			@font-face{
            font-family: kh;
            src: url("{{asset('fonts/KhmerOSmuollight.ttf')}}");
			}
			@font-face{
            font-family: khos;
            src: url("{{asset('fonts/KhmerOSsiemreap.ttf')}}");
			}
			html, body{
            padding: 0;
            margin: 0;
			font-family: khos;
			}
			td, span, th, p, strong, u{
            font-family: khos;
			}
			.box{
            width: 1200px;
            height: 630px;
            border: 0px solid #ccc;
            margin: 0 auto;
            padding: 15px;
            position: relative;
			}
			.tbl{
            width: 100%;
            font-size: 11px;
			}
			.table{
            width: 100%;
            border-spacing: 0;
            border: 1px solid #ccc;
			}
			.table thead tr th{
            font-size: 13px;
            text-align: left;
            border-bottom: 1px solid #888;
			
            border-right: 1px solid #ccc;
            padding: 2px 4px;
			}
			.table thead tr th span{
            font-size: 11px;
			}
			.table thead tr th:last-child{
            border-right: none;
			}
			.table tbody tr td{
            font-size: 13px;
            border-bottom: 1px solid #ccc;
            border-right: 1px solid #ccc;
            padding-left: 4px;
			}
			.table tbody tr td:last-child{
            border-right: none;
			}
			.table tbody tr:last-child td{
            border-bottom: none;
			}
			tr.total td{
            font-weight: bold;
            padding: 2px 4px;
            border-bottom: none!important;
			}
			.h1{
            text-align: center;
            font-size: 32px;
            letter-spacing: 3px;
            padding: 0;
            font-family: kh;
            color: #cfb44c;
			}
			.h3{
            font-size: 22px;
            text-align: center;
            letter-spacing: 2px;
            margin-top: -25px;
            color: #cfb44c;
			}
			.watermark{
			position: absolute;
			top: 300px;
			left: 120px;
			z-index: -9999;
			opacity: 0.2;
			}
			.col-sm-4 {
			width: 40%;
			float: left;
			}
			.col-sm-8 {
			width: 60%;
			float: right;
			}
		</style>
	</head>
	<body>
        
		<div class="box">
			<div class="watermark">
				<img src="{{asset($com->logo)}}" alt="" width="380">
			</div>
			<table class="tbl">
				<tr>
					<td style="width:160px">
						<img src="{{asset($com->logo)}}" alt="" width="150">
					</td>
					<td>
						<h1 class='h1'>{{$com->kh_name}}</h1>
						<h3 class="h3">{{$com->en_name}}</h3>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center; padding-top: 3px; font-size: 10px; font-style:italic">អាស័យដ្ឋាន: {{$com->address}}<br> ទូរស័ព្ទ: {{$com->phone}}</td>
				</tr>
			</table>
			<hr>
			<h3 style="text-align:center;"><u>បង់រំលស់</u></h3>
			
			<div class="card-block">
				<div class="col-md-11">
					
					
                    @if(count($loans) > 0)
                    <?php 
						$num_sch_arr = array();
						foreach($loans as $loan){
							$num_sch_arr[] =  DB::table('loanschedules')->where('loanschedules.active', 1)->where('loan_id',$loan->id)->orderBy('pay_date', 'ASC')->count();
						}
						$num_col =  max($num_sch_arr);
					?>
                    <div class="table-flip-scroll">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered table-hover flip-content">
                                <thead class="flip-header">
                                    <tr>
                                        <th>#</th>
                                        <th>លេខសំគាល់</th>
                                        <th>អតិថិជន</th>
                                        <th>លេខទូរស័ព្ទ</th>
                                        <th>ហាងទូរស័ព្ទ</th>
                                        <th>ជំពាក់</th>
                                        @for($x = 1;$x<=$num_col;$x++)
                                        <th>លើកទី{{$x}}</th>
                                        @endfor
                                        <th>ស្ថានភាព</th>
                                        
									</tr>
								</thead>
                                <tbody>			
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
											$schedules = DB::table('loanschedules')->where('loanschedules.active', 1)->where('loan_id', $loan->id)->orderBy('pay_date', 'ASC')->get();
										?>
										
                                        <td>{{$i++}}</td>
                                        <td>
										<a href="{{url('loan/detail/'.$loan->id)}}"><span class="text-teal"><strong>L{{sprintf("%04s",$loan->id)}}</strong></span></a>   </td>
                                        <td><a href="{{url('loan/detail/'.$loan->id)}}">{{$loan->name}}</a></td>
                                        <td>{{$loan->phone}}</td>
                                        <td>{{$loan->shop_name}}</td>
                                        <td>${{number_format($loan->due_amount,3)}}</td>
                                        
                                        @foreach($schedules as $sch)
                                        <td>${{number_format($sch->due_amount,3)}}</td>
                                        @endforeach
                                        <?php
                                            $s = $num_col -  count($schedules);
                                            if($s > 0){
                                                for($ss = 1;$ss<=$s;$ss++){
                                                    echo '<td></td>';
												}
											}
										?>
                                        <td><span class="badge {{$color}}">{{$status}}</span></td>
                                        
									</tr>
                                    @endforeach
								</tbody>
							</table>
						</div>
					</div>
					
                    @else
					មិនមានទិន្នន័យ
                    @endif
					
					
				</div>
			</div>
		</div>
		<script>
			window.onload = function(){
				print();
			}
		</script>
	</body>
</html>	