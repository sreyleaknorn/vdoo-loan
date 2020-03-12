@extends('layouts.master')
@section('header')
    <strong>Edit Customer</strong>
@endsection
@section('content')
<form action="{{url('customer/update')}}" method="POST" enctype="multipart/form-data">
<div class="card card-gray">
	<div class="toolbox">
        <button class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-save"></i> Save
        </button>
        <a href="{{url('customer')}}" class="btn btn-warning btn-oval btn-sm">
            <i class="fa fa-reply"></i> Back
        </a>
    </div>
	<div class="card-block">
        @component('coms.alert')
        @endcomponent
            <div class="row">
                <div class="col-sm-7">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$cus->id}}">
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-3">Company (KH)<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="first_name" name="first_name" 
                                value="{{$cus->company_name}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="en_name" class="col-sm-3">Company (EN)<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="en_name" name="en_name" 
                                value="{{$cus->en_name}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3">Person Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="last_name" name="last_name" 
                                value="{{$cus->full_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3">Gender</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="gender" id="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" 
                                value="{{$cus->email}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" 
                                value="{{$cus->phone}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="condition" class="col-sm-3">Condition </label>
                        <div class="col-sm-9">
                            <textarea name="condition" id="condition" cols="30" rows="4" 
                            class="form-control">{{$cus->payment_term}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group row">
                        <label for="vatin" class="col-sm-3">VATIN</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="vatin" name="vatin" 
                                value="{{$cus->vatin}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vat" class="col-sm-3">VAT(%)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="vat" name="vat" 
                                value="{{$cus->vat}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-3">Address (KH)</label>
                        <div class="col-sm-9">
                            <textarea name="address" class='form-control' id="addresss" 
                                cols="30" rows="2">{{$cus->address}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="en_address" class="col-sm-3">Address (EN)</label>
                        <div class="col-sm-9">
                            <textarea name="en_address" class='form-control' id="en_address" 
                                cols="30" rows="2">{{$cus->en_address}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="col-sm-3">Photo</label>
                        <div class="col-sm-9">
                            <input type="file" name="photo" id="photo" class="form-control"
                                onchange="loadFile(event)" >
                            <p style='padding:9px;'>
                                <img src="{{asset($cus->photo)}}" alt="" id="img" width="72">
                            </p>
                        </div>
                    </div>
                   
                </div>
            </div>
	</div>
</div>
</form>

@endsection

@section('js')
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
	<script>
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
            $("#menu_customer").addClass("active");
            CKEDITOR.replace('condition');
        });

        function loadFile(e){
            var output = document.getElementById('img');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
    </script>
@endsection