@extends('layouts.master')
@section('header')
    <strong>Customer Detail</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
        
        <a href="{{url('customer/create')}}" class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-plus-circle"></i> Create
        </a>
        <a href="{{url('customer/edit/'.$cus->id)}}" class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-edit"></i> Edit
        </a>
        <a href="{{url('customer/delete?id='.$cus->id)}}" class="btn btn-danger btn-oval btn-sm" onclick="return confirm('You want to delete?')">
            <i class="fa fa-trash"></i> Delete
        </a>
        <a href="{{url('customer')}}" class="btn btn-warning btn-oval btn-sm">
            <i class="fa fa-reply"></i> Back
        </a>
    </div>
	<div class="card-block">
        
        @component('coms.alert')
        @endcomponent
        <form>
            {{csrf_field()}}
		    <div class="row">
            
                <div class="col-sm-7">
                
                    <div class="form-group row">
                        <label class="col-sm-3">Company (KH)</label>
                        <div class="col-sm-9">
                            : {{$cus->company_name}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Company (en)</label>
                        <div class="col-sm-9">
                            : {{$cus->en_name}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Person Name</label>
                        <div class="col-sm-9">
                            : {{$cus->full_name}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Gender</label>
                        <div class="col-sm-9">
                            : {{$cus->gender}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Email </label>
                        <div class="col-sm-9">
                            : {{$cus->email}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Phone</label>
                        <div class="col-sm-9">
                        : {{$cus->phone}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Condition</label>
                        <div class="col-sm-9">
                        : {!!$cus->payment_term!!}
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-5">
                    <div class="form-group row">
                        <label class="col-sm-3">VATIN</label>
                        <div class="col-sm-9">
                        : {{$cus->vatin}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">VAT(%)</label>
                        <div class="col-sm-9">
                            : {{$cus->vat}}%
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Address (KH)</label>
                        <div class="col-sm-9">
                        : {{$cus->address}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3">Address (EN)</label>
                        <div class="col-sm-9">
                        : {{$cus->en_address}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="col-sm-3"></label>
                        <div class="col-sm-9">
                            <img src="{{asset($cus->photo)}}" alt="" id="img" width="150">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <p>
            <strong>Product Price List</strong>
        </p>
        <table class="table table-bordered table-sm">
            <thead>
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
                <th>Kh Name</th>
                <th>Barcode</th>
                <th>Price($)</th>
                <th>Action</th>
            </thead>
            <tbody>
                @php($i=1)
                @foreach($products as $p)
                    <tr data-id="{{$p->id}}">
                        <td>{{$i++}}</td>
                        <td>{{$p->code}}</td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->kh_name}}</td>
                        <td>{{$p->barcode}}</td>
                        <td>{{$p->price}}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm btn-oval" 
                                onclick="edit(this)">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
	</div>

</div>
@endsection

@section('js')
	<script>
        
        var old_price;
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");

            $("#menu_customer").addClass("active");
        });
        function edit(obj)
        {
           let tr = $(obj).parent().parent();
           let tds = $(tr).children('td');
           old_price = tds[5].innerHTML;
           let input = "<input type='text' value='" + old_price + "'>";
           $(tds[5]).html(input);
           let td = $(obj).parent();
           let btn = "<button type='button' onclick='save(this)'>Save</button> <button type='button' onclick='cancelEdit(this)'>Cancel</button>"
           $(td).html(btn);
        }
        function cancelEdit(obj)
        {
            let btn = "<button type='button' class='btn btn-primary btn-sm btn-oval' onclick='edit(this)'><i class='fa fa-edit'></i></button>";
            let td = $(obj).parent();
            let tr = $(obj).parent().parent();
            let tds = $(tr).children('td');
            $(tds[5]).html(old_price);
            $(td).html(btn);
        }
        function save(obj)
        {
            let btn = "<button type='button' class='btn btn-primary btn-sm btn-oval' onclick='edit(this)'><i class='fa fa-edit'></i></button>";
            let td = $(obj).parent();
            let tr = $(obj).parent().parent();
            let tds = $(tr).children('td');
            let input = $(tds[5]).children('input');
            let new_price = $(input).val();
            let p_id = $(tr).attr('data-id');

            $.ajax({
                type: "GET",
                url: burl +"/set/price/",
                data: {
                    id: p_id,
                    price: new_price
                },
                // beforeSend: function (request) {
                //     return request.setRequestHeader('X-CSRF-TOKEN', $("input[name='_token']").val());
                // },
                success: function (data) {
                   
                    if(data>0)
                    {
                        $(td).html(btn);
                        $(tds[5]).html(new_price);
                    }
                }
            });
        }
    </script>
@endsection