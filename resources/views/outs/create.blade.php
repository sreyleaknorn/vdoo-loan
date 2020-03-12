@extends('layouts.master')
@section('header')
    <strong>Create Stock Out</strong>
@endsection
@section('content')
<form action="{{url('out/save')}}" method="POST" enctype="multipart/form-data" 
    autocomplete="off">
<div class="card card-gray">
	<div class="toolbox">
        <button type="button" onclick="save()" class="btn btn-oval btn-primary btn-sm"> 
            <i class="fa fa-save "></i> Save</button>
        <a href="{{url('out')}}" class="btn btn-warning btn-oval btn-sm">
            <i class="fa fa-reply"></i> Back
        </a>
    </div>
	<div class="card-block">
        <div class="col-md-12">
			@component('coms.alert')
            @endcomponent
        </div>
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="date_out" class="col-sm-4">Date Out<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="date" name='date_out' id="date_out" autocomplete="off"
                                class='form-control form-control-sm' value="{{date('Y-m-d')}}" required>
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="reference" class="col-sm-4">Reference</label>
                        <div class="col-sm-8">
                            <input type="text" class='form-control form-control-sm' id="reference">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="description" class="col-sm-4">Description</label>
                        <div class="col-sm-8">
                            <textarea name="description" cols="30" 
                                rows="1" class='form-control form-control-sm' id="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h5>Product</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <select name="item" id="item" class="my-input chosen-select" onchange="getUnit()">
                        <option value="">--Select--</option>
                        @foreach($products as $p)
                            <option value="{{$p->id}}" pname="{{$p->name}}" punit="{{$p->uname}}">{{$p->name}} - {{$p->kh_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" placeholder='QTY' id='qty'>
                </div>
                <div class="col-sm-2">
                   <input type="text" class="form-control" readonly value="" id="unit">
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-primary btn-oval" id='btnAdd' 
                        onclick="addItem()" type='button'>Add</button>
                </div>
            </div>
            <p></p>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="data">
                    
                </tbody>
            </table>
    </div>
   
</div>
</form>     
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
                    <label for="item1" class="col-sm-3">Product<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                       
						<select name="item1" class="form-control chosen-select" id="item1" required  onchange="getUnit1()">
							<option value="">-- Select --</option>
							@foreach($products as $p)
                                <option value="{{$p->name}}" data-id="{{$p->id}}" punit="{{$p->uname}}"
                                    pname="{{$p->name}}">{{$p->name}} - {{$p->kh_name}}</option>
                            @endforeach
						</select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="qty1" class="col-sm-3">Quantity</label>
                    <div class="col-sm-8">
                        <input type="number" step="0.1" min="0" class="form-control" name="qty1" id="qty1" value="1">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="unit1" class="col-sm-3">Unit</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="unit1" id="unit1" readonly>
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
                        <label class="col-sm-3" >Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id='pcode' >
                        </div>
                    </div>
                      <div class="form-group row">
                          <label class="col-sm-3" >Product Name <span class="text-danger">*</span></label>
                          <div class="col-sm-8">
                              <input type="text" class="form-control" id='pname' required>
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
                        <label class="col-sm-3" >Category</label>
                        <div class="col-sm-8">
                            <select name="pcategory" id="pcategory" class="form-control chosen-select">
                                <option value="">-- Select --</option>
                                @foreach($pcats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <div style='padding: 5px'>
                          <button type="button" class="btn btn-primary btn-sm btn-oval" id="btn" onclick="saveProduct()">Save</button>
                          <button type="button" class="btn btn-danger btn-sm btn-oval" data-dismiss="modal">Close</button>
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
	$(document).ready(function(){
		$("#sidebar-menu li ").removeClass("active open");

        $("#menu_stockout").addClass("active");
        $('#qty').keypress(function (e) {
            var key = e.which;
            if(key == 13)  // the enter key code
            {
                $('#btnAdd').click();
                return false;  
            }
        }); 
	});
    
	// function to add item to table
    function addItem()
    {
        let item = $("#item :selected").attr('pname');
        let qty = $("#qty").val();
        let unit = $("#unit").val();
        let id = $("#item").val();
        if(item=="" || qty=='')
        {
            alert("Please input data correctly!");
        }
        else{
            
            // add item to table
            let trs = $("#data tr");
            let html = "<tr data-id='" + id + "'>";
            html += "<td>" + item + "</td>";
            html += "<td>" + qty + "</td>";
            html += "<td>" + unit + "</td>";
            
            html += "<td>" + "<button class='btn btn-danger btn-sm btn-oval' type='button' onclick='deleteItem(this)'>Delete</button>&nbsp;";
            html +=  "<button class='btn btn-primary btn-sm btn-oval' type='button' onclick='editItem(this)'>Edit</button>";
            html += "</tr>";
            if(trs.length>0)
            {
                $("#data tr:last").after(html);
            }
            else{
                $("#data").html(html);
            }
            // clear text box
            $("#item").val("");
            $("#qty").val("");
            $("#unit").val("");
            $("#item").trigger("chosen:updated");
        }
    }
    // function to remove an item
    function deleteItem(obj)
    {
        let con = confirm("You want to delete?");
        if(con)
        {
            $(obj).parent().parent().remove();
        }
    }
    // function to load edit form
    function editItem(obj)
    {
        //remove active class from all row
        $("#data tr").removeClass('active');
        let tr = $(obj).parent().parent();
        let id = $(tr).attr('data-id');
        // add class active to the current edit row
        $(tr).addClass('active');
        let tds = $(tr).children("td");
        let item = $(tds[0]).html();
        let qty = $(tds[1]).html();
        let unit = $(tds[2]).html();
        
        $("#item1").val(item);
        $("#qty1").val(qty);
        $("#unit1").val(unit);
        $("#item1").trigger("chosen:updated");
        $("#item1 :selected").attr('data-id', id);
        $("#editModal").modal('show');
    }
    // save edit item back to table
    function saveItem()
    {
        let id = $("#item1 :selected").attr('data-id');
        
        let item = $("#item1 :selected").attr('pname');
        let qty = $("#qty1").val();
        let unit = $("#unit1").val();
        
        if(item=="" || qty=='')
        {
            alert("Please input data correctly!");
        }
        else{
            $("#data tr.active").attr('data-id', id);
            let tds = $("#data tr.active td");

            tds[0].innerHTML = item;
            tds[1].innerHTML = qty;
            tds[2].innerHTML = unit;
            
            // clear text box
            $("#item1").val("");
            $("#qty1").val("1");
            $("#unit1").val("");
            $("#item1").trigger('chosen:updated');
            $("#editModal").modal("hide");
        }
        
    }
        
    // function to save stock in to db
    function save()
    {
        let master = {
            date_out: $("#date_out").val(),
            description: $("#description").val(),
            reference: $("#reference").val()
        };
        let items = [];
        let trs = $("#data tr");

        // check data
        if($("#date_in").val()=='')
        {
            alert("Please choose a date in!");
        }
       
        else if(trs.length<=0)
        {
            alert("Please choose product item!");
        }
        else{

            for(let i=0;i<trs.length;i++)
            {
                let id = $(trs[i]).attr('data-id');

                let tds = $(trs[i]).children("td");
                let item = {
                    product_id: id,
                    qty: $(tds[1]).html(),
                    
                };
                items.push(item);
            }

            // save to database
            let data = {stock_out: master, items: items};
            
            $.ajax({
                type: "POST",
                url: burl +"/out/save",
                data: data,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                },
                success: function (sms) {

                    if(sms>0)
                    {
                        location.href = burl + "/out/detail/" + sms;
                    }
                    
                    else{
                        alert('Fail to save data, please check again!');
                    }
                }
            });
            
            
        }
        
    }
    // get price of item
    function getUnit()
    {
        let unit = $("#item :selected").attr('punit');
        $('#unit').val(unit);
        $('#qty').focus();
    }
    // get price of item
    function getUnit1()
    {
        let unit = $("#item1 :selected").attr('punit');
        $('#unit1').val(unit);
        $('#qty1').focus();
    }

</script>
@endsection
