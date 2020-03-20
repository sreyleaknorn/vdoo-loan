@extends('layouts.master')
@section('header')
    <strong>Sale By Customer</strong>
@endsection
@section('content')
                       
    <div class="card card-gray">
        <div class="toolbox">
            <form action="{{url('report/customer/search')}}">
               <p>
                    Customer: <select name="customer">
                        @foreach($customers as $p)
                            <option value="{{$p->id}}" {{$p->id==$cid?'selected':''}}>{{$p->company_name}}</option>
                        @endforeach
                    </select>
                    From: <input type="date" name='start' value="{{$start}}"> &nbsp;&nbsp;
                    To: <input type="date" name="end" value="{{$end}}"> 
                    <button>View</button>
               </p>
            </form>
        </div>
        <div class="card-block">
            @if(count($sales)>0)
            <div class="row">
                <div class="col-sm-3">
                    <a href="{{url('report/customer/print?cid='.$cid .'&start='.$start.'&end='.$end)}}" 
                        target="_blank" class="btn btn-primary btn-sm btn-oval">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
                <div class="col-sm-8">
                   <strong>
                    Customer: {{$customer->company_name}} - {{$customer->en_name}}
                   </strong>
                </div>
            </div>

            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice#</th>
                        <th>Date</th>
                        <th>Ref. / PO.</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>UoM</th>
                        <th>Unitprice</th>
                        <th>Discount</th>
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
                            <td>INV00{{$s->inv_no}}</td>
                            <td>{{$s->invoice_date}}</td>
                            <td>{{$s->reference}}</td>
                            <td>{{$s->kh_name}} <br> {{$s->name}}</td>
                            <td>{{$s->quantity}}</td>
                            <td>{{$s->uname}}</td>
                            <td>$ {{$s->unitprice}}</td>
                            <td>{{$s->discount}}%</td>
                            <td>$ {{$s->subtotal}}</td>
                            <?php $total += $s->quantity; ?>
                            <?php $amount += $s->subtotal; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="text-right">
                            <strong>Total QTY</strong>
                        </td>
                        <td>
                            <strong>{{$total}}</strong>
                        </td>
                        <td colspan="3" class="text-right">
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
            $("#menu_salecustomer_report").addClass("active");
			
        })
    </script>
@endsection