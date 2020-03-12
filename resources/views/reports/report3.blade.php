@extends('layouts.master')
@section('header')
    <strong>Sale Summary</strong>
@endsection
@section('content')
                       
    <div class="card card-gray">
        <div class="toolbox">
            <form action="{{url('report/sale/summary/search')}}">
               <p>
                    From: <input type="date" name='start' value="{{$start}}"> &nbsp;&nbsp;
                    To: <input type="date" name="end" value="{{$end}}"> 
                    <button>View</button>
               </p>
            </form>
        </div>
        <div class="card-block">
            @if(count($sales)>0)
            <a href="{{url('report/sale/summary/print?start='.$start.'&end='.$end)}}" 
                target="_blank" class="btn btn-primary btn-sm btn-oval">
                <i class="fa fa-print"></i> Print
            </a>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>UoM</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @php($total=0)
                    @php($amount=0)
                    @foreach($sales as $s)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$s->code}}</td>
                            <td>{{$s->kh_name}} <br> {{$s->name}}</td>
                            <td>{{$s->total1}}</td>
                            <td>{{$s->uname}}</td>
                            <td>$ {{$s->total2}}</td>
                            <?php $total += $s->total1; ?>
                            <?php $amount += $s->total2; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right">
                            <strong>Total QTY</strong>
                        </td>
                        <td>
                            <strong>{{$total}}</strong>
                        </td>
                        <td class="text-right">
                            <strong>Total Amount</strong>
                        </td>
                        <td>
                            <strong>$ {{$amount}}</strong>
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
            $("#menu_salesummary_report").addClass("active");
			
        })
    </script>
@endsection