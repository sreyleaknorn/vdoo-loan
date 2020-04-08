@extends('layouts.master')
@section('header')
<<<<<<< HEAD
<strong>តារាងប្រាក់បានបង់</strong>
@endsection
@section('content')
<div class="card card-gray">
    <div class="toolbox">
        <div class="toolbox">
            <form action="{{url('report/payment/search')}}" class="form-inline">
                <div class="col-12">
                    ហាងទូរស័ព្ទ: <select name="shop" id="shop" style="padding: 5px 2px;font-size:12px">
                        <option value="all" {{$sh=='all'?'selected':''}}>-- ទាំងអស់ --</option>
                        @foreach($shops as $s)
                        <option value="{{$s->id}}" {{$sh==$s->id?'selected':''}}>{{$s->name}} - {{$s->phone}}</option>
                        @endforeach
                    </select>

                    ចាប់ពី: 
                    <input type="date" name='start' value="{{$start}}" required> 
                    ដល់: 
                    <input type="date" name='end' value="{{$end}}" required>
                </div>
                
                <div class="col-6">
                    <div class="form-group text-right">
                        <label for="customer_id" class="col-5 text-right">អតិថិជន</label>
                        <div class="col-7">
                             <select name="customer_id" id="customer_id" class="chosen-select">
                            <option value="all" {{$customer_id=='all'?'selected':''}}>-- ទាំងអស់ --</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}" {{$customer_id==$customer->id?'selected':''}}>{{$customer->name}} - {{$customer->phone}}</option>
                            @endforeach
                        </select>
                        </div>
                       
                    </div>
                </div>
                <div class="col-6">
                    <button><i class="fa fa-search"></i> ស្វែងរក</button>
                </div>
            </form>

            <p></p>
        </div>
    </div>
    <div class="card-block">

        @if(count($loanpayments)>0)
        <div class="table-flip-scroll">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-hover flip-content">
                    <thead class="flip-header">
                        <tr>
                            <th>#</th>
                            <th>លេខសំគាល់</th>
                            <th>អតិថិជន</th>
                            <th>ហាង</th>
                            <th>ថ្ងៃទទួលប្រាក់</th>
                            <th>ប្រាក់ទទួលបាន</th>

                        </tr>
                    </thead>
                    <tbody>			
                        @php($i=1)
                        @php($amount=0)

                        @foreach($loanpayments as $pm)

                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                <span class="text-teal"><strong>L{{sprintf("%04s",$pm->loan_id )}}</strong></span>
                            </td>
                            <td>{{$pm->name}}</td>
                            <td>{{$pm->shop_name}}</td>
                            <td>{{$pm->receive_date}}</td>
                            <td>${{number_format($pm->receive_amount,3)}}</td>
                            <?php $amount += $pm->receive_amount; ?>

                        </tr>
                        @endforeach
                        <tr>

                            <td colspan="5" class="text-right">
                                <strong>Total Amount</strong>
                            </td>
                            <td>
                                <strong> ${{number_format($amount,3)}}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <p>&nbsp;</p>

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
    $(document).ready(function () {
        $("#sidebar-menu li ").removeClass("active open");
        $("#sidebar-menu li ul li").removeClass("active");

        $("#menu_report").addClass("active open");
        $("#report_collapse").addClass("collapse in");
        $("#menu_report1").addClass("active");

    })
</script>
@endsection
=======
    <strong>របាយការណ៍បង់ប្រាក់</strong>
@endsection
@section('content')
                       
    <div class="card card-gray">
        <div class="toolbox">
            <form action="{{url('report/payment/search')}}">
               <p>
                    ហាងទូរស័ព្ទ: <select name="shop">
                        <option value="all"> --All-- </option>
                        @foreach($shops as $s)
                            <option value="{{$s->id}}" {{$s->id==$sh?'selected':''}}>{{$s->name}}</option>
                        @endforeach
                    </select>
                    From: <input type="date" name='start' value="{{$start}}"> &nbsp;&nbsp;
                    To: <input type="date" name="end" value="{{$end}}"> 
                    <button>View</button>
               </p>
            </form>
        </div>
        <div class="card-block">
            @if(count($payments)>0)
            <a href="{{url('report/payment/print?sid='.$sh .'&start='.$start.'&end='.$end)}}" 
                target="_blank" class="btn btn-primary btn-sm btn-oval">
                <i class="fa fa-print"></i> Print
            </a>
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
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_report").addClass("active open");
			$("#report_collapse").addClass("collapse in");
            $("#menu_report1").addClass("active");
			
        })
    </script>
@endsection
>>>>>>> 50fc076d8ff8003104d22169c02eb8114259f4e3
