@extends('layouts.master')
@section('header')
    <strong>Edit Exchange</strong>
@endsection
@section('content')
<form action="{{url('exchange/save')}}" method="POST">
<div class="card card-gray">
	<div class="toolbox">
        <button class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-save"></i> Save
        </button>
        <a href="{{url('exchange')}}"class="btn btn-warning btn-oval btn-sm">
            <i class="fa fa-reply"></i> Back
        </a>
    </div>
	<div class="card-block">
		<div class="row">
            <div class="col-sm-8">
               @component('coms.alert')
               @endcomponent
                {{csrf_field()}}
                <input type="hidden" name='id' value="{{$exc->id}}">
                <div class="form-group row">
                    <label for="name" class="col-sm-3">Dollar</label>
                    <div class="col-sm-9">
                        $ {{$exc->dollar}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3">KHR <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="khr" 
                            value="{{$exc->khr}}" required autofocus>
                    </div>
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
            $("#menu_exchange").addClass("active");
			
        })
    </script>
@endsection