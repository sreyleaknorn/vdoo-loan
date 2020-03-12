@extends('layouts.master')
@section('header')
    <strong>Create Invoice</strong>
@endsection
@section('content')
<div class="card card-gray">
    <div class="toolbox">
        <button type="button" onclick="save()" class="btn btn-oval btn-primary btn-sm"> 
            <i class="fa fa-save "></i> Save
        </button>
        <a href="{{url('invoice')}}"class="btn btn-warning btn-oval btn-sm">
            <i class="fa fa-reply"></i> Back
        </a>
    </div>
	<div class="card-block" id='app'>
        @component('coms.alert')
        @endcomponent
        <form action="#" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="customer_id" class="col-sm-4 form-control-label">Customer <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select name="customer_id" id="customer_id" class="form-control chosen-select" onchange="getVat()">
                                <option value="">--Select--</option>
                                @foreach($customers as $c)
                                    <option value="{{$c->id}}">{{$c->company_name}} - {{$c->phone}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="bill_no" class="col-sm-4 form-control-label">Invoice No.</label>
                        <div class="col-sm-8">
                            <input type="text" name='bill_no' id="bill_no" 
                                class='form-control' value="INV000{{$inv+1}}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="invoice_date" class="col-sm-4 form-control-label">Invoice Date<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="date" name='invoice_date' id="invoice_date" 
                                class='form-control' value="{{date('Y-m-d')}}" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="due_date" class="col-sm-4 form-control-label">Due Date</label>
                        <div class="col-sm-8">
                            <input type="date" name='due_date' id="due_date" 
                                class='form-control' value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    
                    <div class="form-group row">
                        <label for="category" class="col-sm-4 form-control-label">Reference</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name='reference' id='reference'>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="note" class="col-sm-4 form-control-label">Note</label>
                        <div class="col-sm-8">
                            <textarea name="note" id="note" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="vat" class="col-sm-4 form-control-label">VAT(%)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="vat" id='vat' 
                                value="0">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="g_discount" class="col-sm-4 form-control-label">Discount(%)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="g_discount" id='g_discount' 
                                value="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-6">
                    
                    <h5 class="text-success">Invoice Items</h5>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <select name="product" id="product" class="form-control chosen-select"  onchange="getPrice()">
                        <option value="">--Select--</option>
                        @foreach($products as $p)
                            <option value="{{$p->id}}">{{$p->name}} - {{$p->kh_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 col-xs-12" id='bbx'>
                    <input type="text" id="quantity" placeholder='Qty' title="Quantity" size="8">
                    <input type="text" id="unit" placeholder='Unit' title="Unit" disabled size="9">
                    <input type="text" id="price" placeholder='Price' title="Price" size="8">
                    <input type="text" id='discount' placeholder="Discount(%)" title="Discount" size="9">
                    <button type="button" onclick="addItem()"> Add </button>
                </div>
                
            </div>
            <p></p>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Price($)</th>
                        <th>Discount(%)</th>
                        <th>Subtotal($)</th>
                        <th style="width:150px">Action</th>
                    </tr>
                </thead>
                <tbody id="data">
                    
                </tbody>
                <tr>
                    <td colspan="7">
                        <p></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        
                        Exchange: 1$ = KHR <span id="exc">{{$exc->khr}}</span>
                    </td>
                    <td colspan="4" class="text-right">
                        <strong class="text-danger">
                            Total: &nbsp;&nbsp;$ <span id="total">0</span>
                            <span id="total_kh"></span>
                    
                        </strong>
                    </td>
                </tr>
            </table>
          
        </form>
	</div>
</div>

<!-- Modal for edit option -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="#">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                <label for="product1" class="col-sm-3">Item<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <select name="product1" id="product1" class="form-control chosen-select" onchange="getPrice1()" required>
                            <option value=""> --ជ្រើសរើស-- </option>
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->name}} - {{$product->kh_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="quanity1" class="col-sm-3" >Quantity</label>
                    <div class="col-sm-8">
                        <input type="number" step="0.1" min="1" class="form-control" name="quanity1" id="quanity1">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="quanity1" class="col-sm-3" >Unit</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="unit1" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price1" class="col-sm-3" title="">Price($)</label>
                    <div class="col-sm-8">
                        <input type="number" step="1" min="0" class="form-control" name="price1" id="price1">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="discount1" class="col-sm-3">Discount(%)</label>
                    <div class="col-sm-8">
                        <input type="number" step="0.1" min="0" class="form-control" name="discount1" id="discount1" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div style='padding: 5px'>
                    <button type="button" class="btn btn-primary btn-sm btn-oval" id="btn" onclick="saveItem()">
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
 <!-- customer modal  -->
 <div class="modal fade" id="vendorModal" tabindex="-1" role="dialog" aria-labelledby="vendorModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="#">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                   
                </div>
                <div class="form-group row">
                    <label class="col-sm-3" >Company Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id='vcompany' required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3" >Full Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id='vfull_name' required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3" >Email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id='vemail'>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3" >Phone</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id='vphone'>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3" >Address</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id='vaddress'>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div style='padding: 5px'>
                    <button type="button" class="btn btn-primary" id="btn" onclick="saveCustomer()">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
  </div>
</div> 


<!-- Product modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="#">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                   
                </div>
                <div class="form-group row">
                    <label class="col-sm-3" >Product Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id='pname' required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3" >Code</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id='pcode' >
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3" >Category <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <select name="pcategory" id="pcategory" class="form-control chosen-select">
                            <option value="">-- Select --</option>
                            @foreach($pcats as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3" >Unit <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <select name="punit" id="punit" class="form-control chosen-select">
                            <option value="">-- Select --</option>
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3" >Type <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <select name="ptype" id="ptype" class="form-control">
                           <option value="stockable">Stockable</option>
                           <option value="service">Service</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div style='padding: 5px'>
                    <button type="button" class="btn btn-primary" id="btn" onclick="saveProduct()">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
  </div>
</div> 
@endsection

@section('js')
    <script src="{{asset('js/invoice.js')}}"></script>
   
	<script>
         var burl = "{{url('/')}}";
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
            $("#menu_invoice").addClass("active");
        });
       
    </script>

@endsection