@extends('layouts.master')
@section('header')
    <strong>Detail Invoice</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
        
        <a href="{{url('invoice/create')}}" class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-plus-circle"></i> Create
        </a>
        <a href="{{url('invoice/print/'.$invoice->id)}}" class="btn btn-primary btn-oval btn-sm" 
            target="_blank">
            <i class="fa fa-print"></i> Print
        </a>
        <a href="{{url('invoice/delete/'.$invoice->id)}}" class="btn btn-danger btn-oval btn-sm" 
            onclick="return confirm('You want to delete?')">
            <i class="fa fa-trash"></i> Delete
        </a>
        <a href="{{url('invoice')}}" class="btn btn-warning btn-oval btn-sm">
            <i class="fa fa-reply"></i> Back
        </a>
    </div>

	<div class="card-block">
        @component('coms.alert')
        @endcomponent
        <form action="#" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 form-control-label">Invoice No.</label>
                        <div class="col-sm-8">
                            : INV000{{$invoice->id}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 form-control-label">Customer</label>
                        <div class="col-sm-8">
                           : {{$invoice->company_name}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 form-control-label">Invoice Date</label>
                        <div class="col-sm-8">
                            : {{$invoice->invoice_date}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 form-control-label">Due Date</label>
                        <div class="col-sm-8">
                            : {{$invoice->due_date}}
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="row">
                
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 form-control-label">Note</label>
                        <div class="col-sm-8">
                            : {{$invoice->note}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 form-control-label">VAT</label>
                        <div class="col-sm-8">
                            : {{$invoice->vat}}%
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="row">

                <div class="col-sm-6">
                    
                    <h5 class="text-success">Invoice Items</h5>
                </div>
                
            </div>
           
            <p></p>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($items as $p)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$p->name}}</td>
                            <td>{{$p->quantity}} ({{$p->uname}})</td>
                            <td>$ {{$p->unitprice}}</td>
                            <td>{{$p->discount}}%</td>
                            <td>$ {{$p->subtotal}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class='text-right text-primary'>Discount</td>
                        <td class='text-primary'>{{$invoice->discount}}%</td>
                    </tr>
                    <tr>
                        <td colspan="5" class='text-right text-primary'>Total Amount</td>
                        <td class='text-primary'>$ {{$invoice->total}} = KHR {{$invoice->total * $invoice->exchange}}</td>
                    </tr>
                    @if($invoice->vat>0)
                        <tr>
                            <td colspan="5" class="text-right text-danger">
                                VAT ({{$invoice->vat}}%)
                            </td>
                            <td class="text-danger">
                                $ {{$invoice->vat_amount}} = KHR {{$invoice->vat_amount * $invoice->exchange}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right text-danger">
                                Grand Total
                            </td>
                            <td class="text-danger">
                                $ {{$invoice->grand_total}} = KHR {{$invoice->grand_total * $invoice->exchange}}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>
                            Exchange: 1$ = KHR {{$invoice->exchange}}
                        </td>
                        <td colspan="4" class='text-right text-success'>Paid Amount</td>
                        <td class='text-success'>$ {{$invoice->paid}} = KHR {{$invoice->paid * $invoice->exchange}}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class='text-right text-info'>Due Amount</td>
                        <td class='text-info'>$ {{$invoice->due_amount}} = KHR {{$invoice->due_amount * $invoice->exchange}}</td>
                    </tr>
                </tbody>
            </table>
            <h5 class="text-primary">Payments 
                @if($invoice->due_amount > 0)
                <a href="#" class="btn btn-primary btn-sm btn-oval" data-toggle="modal" data-target="#paymentModal">
                        <i class="fa fa-plus"></i>  Add Payment
                </a>
                @endif
            </h5>
            <div class="row">
                <div class="col-sm-8">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($payments as $p)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$p->pay_date}}</td>
                                    <td>$ {{$p->amount}} = KRH {{$p->amount*$invoice->exchange}}</td>
                                    <td> 
                                        <a href="{{url('invoice/payment/delete/'.$p->id)}}" class="text-danger" title="Delete" 
                                            onclick="return confirm('You want to delete?')">
                                            <i class="fa fa-trash"></i> 
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
	</div>
</div>
<!-- Modal for payment option -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="{{url('invoice/payment/save')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <div class="form-group row">
                    <label class="col-sm-3" >Date <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" name="pay_date" required 
                            value="{{date('Y-m-d')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3" title="">Amount($) <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" min="0" step="0.01" class="form-control" name="amount" required 
                            value="{{$invoice->due_amount}}" max="{{$invoice->due_amount}}">
                    </div>
                </div>
               
            </div>
            <div class="modal-footer">
                <div style='padding: 5px'>
                    <button type="submit" class="btn btn-primary btn-sm btn-oval">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <button type="button" class="btn btn-danger btn-sm btn-oval" data-dismiss="modal">
                        <i class="fa fa-close"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </form>
  </div>
</div>  
@endsection

@section('js')
	<script>
        var burl = "{{url('/')}}";
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_income").addClass("active open");
			$("#income_collapse").addClass("collapse in");
            $("#menu_invoice").addClass("active");
        });
       
    </script>
@endsection