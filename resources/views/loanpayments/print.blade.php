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
            width: 600px;
            height: 430px;
            border: 0px solid #ccc;
            margin: 0 auto;
            padding: 15px;
            position: relative;
        }
        .tbl{
            width: 100%;
            font-size: 14px;
        }
        .table{
            width: 100%;
            border-spacing: 0;
            border: 0px solid #ccc;
        }
        
        .table thead tr th span{
            font-size: 11px;
        }
        .table thead tr th:last-child{
            border-right: none;
        }
        .table tbody tr td{
            font-size: 18px;
			 padding: 5px;
            border-bottom: 0px solid #ccc;
            border-right: 0px solid #ccc;
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
            padding: 20px;
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
        <h3 style="text-align:center;"><u>បង្កាន់ដៃបង់ប្រាក់</u></h3>
		
        <div class="card-block">
            <div class="col-md-11">
                
                   
					<div class="table-flip-scroll">

                        <table class="table table-striped table-sm table-bordered table-hover flip-content">
                            
                            <tbody>
								<tr>
									<td style="width: 50%;text-align:right;">ឈ្មោះអតិថិជន </td>
									<td style="text-align:center;">:</td>
									<td>{{$loanpayment->name}} </td>
                                </tr>
								<tr>
									<td style="width: 50%;text-align:right;">លេខទូរស័ព្ទ </td>
									<td style="text-align:center;">:</td>
									<td> {{$loanpayment->phone}}</td>
                                </tr>
								<tr>
									<td style="width: 50%;text-align:right;">ថ្ងៃបង់ប្រាក់ </td>
									<td style="text-align:center;">:</td>
									<td>{{$loanpayment->receive_date}} </td>
                                </tr>
								<tr>
									<td style="width: 50%;text-align:right;">ចំនួនប្រាក់បានបង់ </td>
									<td style="text-align:center;">:</td>
									<td> <strong>${{number_format($loanpayment->receive_amount,3)}}</strong> </td>
                                </tr>
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