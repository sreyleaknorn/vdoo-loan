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
            width: 700px;
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
                
                   
                    <div class="row">
                        <div class="col-sm-6" style="width: 50%; float: left;">
							<div class="form-group row">
                                <label for="customer_id" class="col-sm-4 form-control-label">លេខសំគាល់ </label>
                                <div class="col-sm-7">
                                    : <strong>L{{sprintf("%04s",$loan->id)}}</strong>
                                </div>
                            </div>
							<div style="clear: both;"></div>
                            <div class="form-group row">
                                <label for="customer_id" class="col-sm-4 form-control-label">ឈ្មោះអតិថិជន </label>
                                <div class="col-sm-8">
                                    : {{$loan->name}}
                                </div>
                            </div>
							<div style="clear: both;"></div>
							<div class="form-group row">
                                <label for="customer_id" class="col-sm-4 form-control-label">លេខទូរស័ព្ទ </label>
                                <div class="col-sm-8">
                                    : {{$loan->phone}}
                                </div>
                            </div>
							<div style="clear: both;"></div>
							<div class="form-group row">
                                <label for="customer_id" class="col-sm-4 form-control-label">ហាងទូរស័ព្ទ </label>
                                <div class="col-sm-8">
                                    : {{$loan->shop_name}}
                                </div>
                            </div>
							<div style="clear: both;"></div>
							<div class="form-group row">
                                <label for="invoice_date" class="col-sm-4 form-control-label">ថ្ងៃខ្ចី</label>
                                <div class="col-sm-8">
                                    : {{$loan->loan_date}}
                                </div>
                            </div>
							<div style="clear: both;"></div>
							<div class="form-group row">
                                <label for="invoice_date" class="col-sm-4 form-control-label">ថ្ងៃបញ្ចេញប្រាក់</label>
                                <div class="col-sm-8">
                                    : {{$loan->release_date}}
                                </div>
                            </div>
							<div style="clear: both;"></div>
							<div class="form-group row">
                                <label for="invoice_date" class="col-sm-4 form-control-label">ចាប់ផ្ដើមការប្រាក់</label>
                                <div class="col-sm-8">
                                    : {{$loan->start_interest_date}}
                                </div>
                            </div>
							<div style="clear: both;"></div>
                        </div>
                        <div class="col-sm-6" style="width: 50%; float: right;">
                            
                            <div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">ចំនួនខ្ចី</label>
                                <div class="col-sm-8">
                                    : ${{number_format($loan->loan_amount,3)}}
                                </div>
                            </div>
							<div style="clear: both;"></div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">ការប្រាក់ (%)</label>
                                <div class="col-sm-8">
                                    : {{$loan->loan_interest}}%
                                </div>
                            </div>
							<div style="clear: both;"></div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">ការប្រាក់សរុប</label>
                                <div class="col-sm-8">
                                    : ${{number_format($loan->total_interest,3)}}
                                </div>
                            </div>
							<div style="clear: both;"></div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">សរុប</label>
                                <div class="col-sm-8">
                                    : ${{number_format($loan->total_amount,3)}}
                                </div>
                            </div>
							<div style="clear: both;"></div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">រយៈពេល</label>
                                <div class="col-sm-8">
                                    : {{$loan->num_repayment . ' ('.$loan->repayment_type.')'}}
                                </div>
                            </div>
							<div style="clear: both;"></div>
                        </div>
                    </div>
					
					<div style="clear: both;"></div>
                  
                    <div class="row">

                        <div class="col-sm-6">
                            
                            <h5 class="text-success">តារាងបង់ប្រាក់</h5>
                        </div>
                        
                    </div>
                    <div class="table-flip-scroll">

                        <table class="table table-striped table-sm table-bordered table-hover flip-content">
                            <thead class="flip-header">
                                <tr>
                                    <th>ល រ</th>
                                    <th>ថ្ងៃត្រូវបង់</th>
                                    <th>ប្រាក់ដើម</th>
                                    <th>ការប្រាក់</th>
                                    <th>ចំនួនសរុប</th>
                                    <th>ចំនួនបានបង់</th>
                                    <th>ចំនួននៅខ្វះ</th>
                                </tr>
                            </thead>
                            <tbody id="data">
								<?php
									$i = 1;
								?>
                                @foreach($loanschedules as $ls)
									<tr>
										<td>{{$i++}}</td>
										<td>{{$ls->pay_date}}</td>
										<td>${{number_format($ls->principal_amount,3)}}</td>
										<td>${{number_format($ls->interest_amount,3)}}</td>
										<td>${{number_format($ls->total_amount,3)}}</td>
										<td>${{number_format($ls->paid_amount,3)}}</td>
										<td>${{number_format($ls->due_amount,3)}}</td>
									</tr>
								@endforeach
                                
                            </tbody>
                        </table>

                    </div>
                   
                
                
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