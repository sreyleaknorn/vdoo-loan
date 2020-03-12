@extends('invoicing::layouts.master')
@section('header')
    <strong>Payments</strong>
@endsection
@section('content')
<div class="card card-gray">
	
	<div class="card-block">
        
		<table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice No.</th>
                    <th>Total</th>
                    <th>Pay Date</th>
                    <th>Paid Amount</th>
                    <th>Method</th>
                    <th>Customer</th>
                </tr>
            </thead>
            <tbody>			
                <?php
                    $pagex = @$_GET['page'];
                    if(!$pagex)
                        $pagex = 1;
                    $i = config('app.row') * ($pagex - 1) + 1;
                ?>
                @foreach($payments as $p)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <a href="{{url('invoicing/invoice/detail/'.$p->invoice_id)}}">INV00{{$p->invoice_id}}</a>
                        </td>
                        <td>$ {{$p->total}}</td>
                        <td>{{$p->pay_date}}</td>
                        <td>$ {{$p->amount}}</td>
                        <td>{{$p->method}}</td>
                        <td>{{$p->company_name}}</td>
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$payments->links()}}
		
	</div>
</div>
@endsection

@section('js')
	<script>
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_income").addClass("active open");
			$("#income_collapse").addClass("collapse in");
            $("#menu_payment").addClass("active");
        })
    </script>
@endsection