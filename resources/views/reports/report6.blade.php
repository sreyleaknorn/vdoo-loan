@extends('layouts.master')
@section('header')
    <strong>Stock Out Detail</strong>
@endsection
@section('content')
                       
    <div class="card card-gray">
        <div class="toolbox">
            <form action="{{url('report/out/search')}}">
               <p>
                    Product: <select name="product">
                        <option value="all"> --All-- </option>
                        @foreach($products as $p)
                            <option value="{{$p->id}}" {{$p->id==$pid?'selected':''}}>{{$p->name}} - {{$p->kh_name}}</option>
                        @endforeach
                    </select>
                    From: <input type="date" name='start' value="{{$start}}"> &nbsp;&nbsp;
                    To: <input type="date" name="end" value="{{$end}}"> 
                    <button>View</button>
               </p>
            </form>
        </div>
        <div class="card-block">
            @if(count($outs)>0)
            <a href="{{url('report/out/print?pid='.$pid .'&start='.$start.'&end='.$end)}}" 
                target="_blank" class="btn btn-primary btn-sm btn-oval">
                <i class="fa fa-print"></i> Print
            </a>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Ref.</th>
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
                            <td>{{$o->out_date}}</td>
                            <td>{{$o->reference}}</td>
                            <td>{{$o->code}}</td>
                            <td>{{$o->kh_name}} <br> {{$o->name}}</td>
                            <td>{{$o->quantity}}</td>
                            <td>{{$o->uname}}</td>
                            <?php $total +=$o->quantity; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-right" colspan="5">
                            <strong>Total QTY</strong>
                        </td>
                        <td colspan="2">
                            <strong>{{$total}}</strong>
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
            $("#menu_stockout_report").addClass("active");
			
        })
    </script>
@endsection