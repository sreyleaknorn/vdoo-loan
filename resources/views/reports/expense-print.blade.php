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
                <th>ថ្ងៃខ្ចី</th>
                <th>ថ្ងៃចេញប្រាក់</th>
                <th>ចំនួនសរុប</th>
                <th>លេខបុង</th>
                <th>ទូរស័ព្ទ</th>
            </tr>
        </thead>
        <tbody>
            @php($i=1)
            @php($total=0)
            @foreach($loans as $l)
                <tr>
                    <td>{{$i++}}</td>
                    <td>L000{{$l->id}}</td>
                    <td>{{$l->name}}</td>
                    <td>{{$l->shop_name}}</td>
                    <td>{{$l->loan_date}}</td>
                    <td>{{$l->release_date}}</td>
                    <td>$ {{$l->loan_amount}}</td>
                    <td>{{$l->bill_no}}</td>
                    <td>{{$l->model_name}}</td>
                </tr>
                <?php $total += $l->loan_amount; ?>
            @endforeach
           <tr>
               <td colspan="6" class="text-right">
                   <strong class="text-danger">សរុបរួម</strong>
               </td>
               <td colspan="3">
                   <strong class="text-danger">$ {{$total}}</strong>
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