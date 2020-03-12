@extends('layouts.master')
@section('header')
    <strong>Edit Company</strong>
@endsection
@section('content')
<form action="{{url('company/save')}}" method='POST' enctype="multipart/form-data">
    <div class="card">
        <div class="toolbox">
            <button class="btn btn-primary btn-sm btn-oval" type="submit">
                <i class="fa fa-save"></i> Save
            </button>
            <a href="{{url('company')}}" class='btn btn-warning btn-sm btn-oval'>
                <i class="fa fa-reply"></i> Back
            </a>
        </div>
        <div class="card-block">
            @component('coms.alert')
            @endcomponent
                @csrf
                <input type="hidden" name="id" value="{{$company->id}}">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Khmer Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required value="{{$company->kh_name}}"
                                    name="kh_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">English Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="en_name" required value="{{$company->en_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone" value="{{$company->phone}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Email Address</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="{{$company->email}}">
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Website</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="website" value="{{$company->website}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address" value="{{$company->address}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Header Text</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="header" value="{{$company->header}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Footer Text</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="footer" value="{{$company->footer}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3"><strong>Description</strong></label>
                            
                        </div>
                      
                    </div>
                    <div class="col-sm-5">
                        <p class="text-center">
                            <strong>Company Logo</strong>
                        </p>
                        <div class="text-center">
                            <img src="{{asset($company->logo)}}" alt="{{$company->en_name}}" width='200' id="img">
                        </div>
                        <p></p>
                        <div class="text-center">
                            <input type="file" class="form-control" name="logo" accept="image/*" 
                                onchange="preview(event)">
                        </div>
                      
                    </div>
                </div>
        </div>
    </div>
</form>    
@endsection
@section('js')
	<script>
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_config").addClass("active open");
			$("#config_collapse").addClass("collapse in");
            $("#menu_company").addClass("active");
			
        });
        function preview(e){
            var img = document.getElementById('img');
            img.src = URL.createObjectURL(e.target.files[0]);
        }
    </script>
@endsection