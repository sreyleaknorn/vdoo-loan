@extends('layouts.master')
@section('header')
    <strong>Invoices</strong>
@endsection
@section('content')
<div class="card card-gray">
    <div class="toolbox">
        <a href="{{url('invoice/create')}}"class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-plus-circle"></i> Create
        </a>
    </div>
	<div class="card-block">
       @component('coms.alert')
       @endcomponent
       <table class="table table-sm table-bordered">
        <thead class="flip-header">
            <tr>
                <th>#</th>
                <th>Invoice #</th>
                <th>Date</th>
                <th>Due Date</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Due Amount</th>
                <th>Discount(%)</th>
                <th>Customer</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>			
            <?php
                $pagex = @$_GET['page'];
                if(!$pagex)
                    $pagex = 1;
                $i = config('app.row') * ($pagex - 1) + 1;
            ?>
            @foreach($invoices as $p)
                <tr>
                    <td>{{$i++}}</td>
                    <td>
                        <a href="{{url('invoice/detail/'.$p->id)}}">INV00{{$p->id}}</a>
                    </td>
                    <td>{{$p->invoice_date}}</td>
                    <td>{{$p->due_date}}</td>
                    <td>$ {{$p->grand_total}}</td>
                    <td>$ {{$p->paid}}</td>
                    <td>$ {{$p->due_amount}}</td>
                    <td>{{$p->discount}}%</td>
                    <td>{{$p->company_name}}</td>
                    <td>
                        @if($p->due_amount>0)
                            <span class="badge badge-danger">Due</span>
                        @else
                        <span class="badge badge-success">Paid</span>
                        @endif
                    </td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$invoices->links()}}
	</div>
</div>
@endsection

@section('js')
	<script>
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
            $("#menu_invoice").addClass("active");
        })
    </script>
@endsection