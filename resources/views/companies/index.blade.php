@extends('layouts.master')
@section('header')
    <strong>Company</strong>
@endsection
@section('content')
<div class="card">
    <div class="toolbox">
        <a href="{{url('company/edit/'.$company->id)}}" class='btn btn-primary btn-sm btn-oval'>
            <i class="fa fa-edit"></i> Edit
        </a>
    </div>
        <div class="card-block">
            @component('coms.alert')
            @endcomponent
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Khmer Name</label>
                        <div class="col-sm-9">
                            : {{$company->kh_name}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">English Name</label>
                        <div class="col-sm-9">
                            : {{$company->en_name}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Phone Number</label>
                        <div class="col-sm-9">
                            : {{$company->phone}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Email Address</label>
                        <div class="col-sm-9">
                            : {{$company->email}}
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Website</label>
                        <div class="col-sm-9">
                            : {{$company->website}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Address</label>
                        <div class="col-sm-9">
                            : {{$company->address}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Header Text</label>
                        <div class="col-sm-9">
                            : {{$company->header}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Footer Text</label>
                        <div class="col-sm-9">
                            : {{$company->footer}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3"><strong>Description</strong></label>
                        
                    </div>
                   
                </div>
                <div class="col-sm-6">
                    <p class="text-center">
                        <strong>Company Logo</strong>
                    </p>
                    <div class="text-center">
                        <img src="{{asset($company->logo)}}" alt="{{$company->en_name}}" width='200'>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
         
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
    </script>
@endsection