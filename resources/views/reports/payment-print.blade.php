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
        {{$start}} - {{$end}}
    </p>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>លេខកូដ</th>
                <th>អតិថិជន</th>
                <th>ហាង</th>
                <th>ថ្ងៃត្រូវបង់</th>
                <th>ប្រាក់ដើម</th>
                <th>ការប្រាក់</th>
                <th>ចំនួនសរុប</th>
                <th>ចំនួនបានបង់</th>
                <th>ថ្ងៃបានបង់</th>
            </tr>
        </thead>
        <tbody>
            @php($i=1)
            @php($total1=0)
            @php($total2=0)
            @php($total3=0)
            @php($total4=0)
            @foreach($payments as $p)
                <tr>
                    <td>{{$i++}}</td>
                    <td>L000{{$p->loan_id}}</td>
                    <td>{{$p->name}} - {{$p->phone}}</td>
                    <td>{{$p->shop_name}}</td>
                    <td>{{$p->pay_date}}</td>
                    <td>$ {{$p->principal_amount}}</td>
                    <td>$ {{$p->interest_amount}}</td>
                    <td>$ {{$p->total_amount}}</td>
                    <td>$ {{$p->paid_amount}}</td>
                    <td>{{$p->paid_date}}</td>
                    <?php
                            $total1 += $p->principal_amount;
                            $total2 += $p->interest_amount;
                            $total3 += $p->paid_amount;
                            $total4 += $p->total_amount;
                    ?>
                </tr>
            @endforeach
           <tr>
               <td colspan="5" class="text-right">
                   <strong class="text-danger">សរុបរួម</strong>
               </td>
               <td>
                   <strong class="text-danger">$ {{$total1}}</strong>
               </td>
               <td>
                    <strong class="text-danger">$ {{$total2}}</strong>
                </td>
                <td>
                    <strong class="text-danger">$ {{$total4}}</strong>
                </td>
                <td colspan="2">
                    <strong class="text-danger">$ {{$total3}}</strong>
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
    <p style="font-size:11px;">{{date('Y-m-d H:i:s')}}</p>
    <script>
        print();
    </script>
</body>
</html>