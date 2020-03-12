@extends('layouts.master')
@section('header')
    <strong>Stock Out Detail</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
        <a href="{{url('out/create')}}" class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-plus-circle"></i> Create
        </a>
        <a href="{{url('out/print/' . $out->id)}}" target="_blank"
            class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-print"></i> Print
        </a>
        <a href="{{url('out/delete/'.$out->id)}}" class="btn btn-danger btn-sm btn-oval" 
            onclick="return confirm('You want to delete?')">
            <i class="fa fa-trash"></i> Delete
        </a>
        <a href="{{url('out')}}" class="btn btn-warning btn-oval btn-sm">
            <i class="fa fa-reply"></i> Back
        </a>
       
    </div>
	<div class="card-block">
      
        <form >
            {{csrf_field()}}
            <input type="hidden" id="id" value="{{$out->id}}">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 form-control-label">Date Out</label>
                        <div class="col-sm-8">
                            <span id="lb_out_date">{{$out->out_date}}</span>
                            <input type="date" class="form-control hide" value="{{$out->out_date}}" id="out_date">
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4">Reference</label>
                        <div class="col-sm-8">
                            <span id="lb_reference">{{$out->reference}}</span>
                            <input type="text" class="form-control hide" id="reference" value="{{$out->reference}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4">Out By</label>
                        <div class="col-sm-8">
                            {{$out->first_name}} {{$out->last_name}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4">Description</label>
                        <div class="col-sm-8">
                            <span id="lb_description">{{$out->description}}</span>
                            <input type="text" class="form-control hide" id="description" value="{{$out->description}}">
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <button class="btn btn-primary btn-sm btn-oval" type="button"
                        id='btnEdit' onclick="editMaster()">
                        <i class="fa fa-edit"></i> Edit 
                    </button>
                    <button class="btn btn-primary btn-sm btn-oval hide" type="button" 
                        id='btnSave' onclick="saveMaster()">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <button class="btn btn-danger btn-sm btn-oval hide" type="button" 
                        id='btnCancel' onclick="cancelMaster()">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-2">
                    <h5>Products</h5>
                </div>
               <div class="col-sm-3">
                   <button class="btn btn-primary btn-sm btn-oval" type="button" data-toggle='modal' data-target='#itemModal'>
                       <i class="fa fa-plus-circle"></i> Add
                   </button>
               </div>
            </div>

            <table class="table table-sm table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="data">
                    @php($i=1)
                    @foreach($details as $d)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$d->name}} - {{$d->kh_name}}</td>
                            <td>{{$d->quantity}}</td>
                            <td>{{$d->uname}}</td>
                            <td class="action">
                                <a href="#" class="text-danger" title="Delete" onclick="deleteDetail(event,this,{{$d->id}})">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>  
        </form>
    </div>
   
</div>      
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <form action="#">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Add Item</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                    <input type="hidden" value="{{$out->id}}" id="id">
                    <input type="hidden" value="{{$out->out_date}}" id="out_date">
                  <div class="form-group row">
                      <label class="col-sm-3" >Product Name<span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                          <select name="product" id="product" class="form-control chosen-select">
                              <option value=""></option>
                              @foreach($products as $p)
                                    <option value="{{$p->id}}" pname="{{$p->name}}"
                                        uname="{{$p->uname}}">
                                        {{$p->name}} - {{$p->kh_name}}
                                    </option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-3" >Quantity <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" id='quantity' required>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <div style='padding: 5px'>
                      <button type="button" class="btn btn-primary btn-sm btn-oval" id="btn" 
                        onclick="addItem()"><i class="fa fa-save"></i> Save</button>
                      <button type="button" class="btn btn-danger btn-sm btn-oval" data-dismiss="modal">
                          <i class="fa fa-times"></i> Close</button>
                  </div>
              </div>
          </div>
      </form>
    </div>
</div> 
@endsection
@section('js')
<script>
	$(document).ready(function(){
		$("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
            $("#menu_stockout").addClass("active");
	});
    function editMaster()
    {
        $("#lb_out_date").addClass('hide');
        $("#out_date").removeClass('hide');
       
        $("#lb_reference").addClass('hide');
        $("#reference").removeClass('hide');
       
        $("#lb_description").addClass('hide');
        $("#description").removeClass('hide');
        $("#btnEdit").addClass('hide');
        $("#btnSave").removeClass('hide');
        $("#btnCancel").removeClass('hide');
    }
    function cancelMaster()
    {
        $("#lb_out_date").removeClass('hide');
        $("#out_date").addClass('hide');
       
        $("#lb_reference").removeClass('hide');
        $("#reference").addClass('hide');
        $("#lb_description").removeClass('hide');
        $("#description").addClass('hide');
        $("#btnEdit").removeClass('hide');
        $("#btnSave").addClass('hide');
        $("#btnCancel").addClass('hide');
    }
    function saveMaster()
    {
        let data = {
            id: $("#id").val(),
            out_date: $("#out_date").val(),
            description: $("#description").val(),
            reference: $("#reference").val()
           
        };
        let con = confirm('You want to save changes?');
        if(con)
        {
            $.ajax({
                type: "POST",
                url: burl +"/out/save/master",
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
                        alert("Fail to save stock, please check again!");
                    }
                }
            });
        }
        
    }
    function deleteDetail(evt, obj, id)
    {
        evt.preventDefault();
        let con = confirm('You want to delete?');
        if(con)
        {
            $.ajax({
            type: 'GET',
            url: burl + "/out/detail/delete/" + id,
            success: function(sms)
            {
                if(sms>0)
                {
                    $(obj).parent().parent().remove();
                }
                else{
                    alert('Fail to remove data!');
                }
            }
        });
        }
        
    }
    function addItem()
    {
        let pid = $("#product").val();
        let pname = $("#product :selected").attr('pname');
        let uname = $("#product :selected").attr('uname');
        let out_id = $("#id").val();
        let qty = $("#quantity").val();
        let out_date = $("#out_date").val();
        $.ajax({
                type: "POST",
                url: burl +"/out/item/save",
                data: {
                    out_id: out_id,
                    product_id: pid,
                    quantity: qty,
                    out_date: out_date
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                },
                success: function (sms) {
                    if(sms>0)
                    {
                        location.reload();
                    }
                    else{
                        alert("Fail to add new item, please check again!");
                    }
                }
            });
    }
</script>
@endsection