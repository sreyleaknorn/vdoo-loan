<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Out Printing | Vdoo ERP</title>
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
    <div class="container">
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
        <h5 class='text-center'>Stock Out Summary</h5>
        <p class="text-center">
            {{$start}} - {{$end}}
        </p>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>UoM</th>
                </tr>
            </thead>
            <tbody>
                @php($i=1)
                @php($total=0)
                @foreach($outs as $o)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$o->code}}</td>
                        <td>{{$o->kh_name}} <br> {{$o->name}}</td>
                        <td>{{$o->total}}</td>
                        <td>{{$o->uname}}</td>
                        <?php $total +=$o->total; ?>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-right">
                        <strong>Total QTY</strong>
                    </td>
                    <td colspan="2">
                        <strong>{{$total}}</strong>
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
    </div>
    <script>
        print();
    </script>
</body>
</html>