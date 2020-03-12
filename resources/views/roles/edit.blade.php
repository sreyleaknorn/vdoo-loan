@extends('layouts.master')
@section('header')
    <strong>Edit Role</strong>
@endsection
@section('content')
<form action="{{url('role/update')}}" method="POST">                
    <div class="card card-gray">
        <div class="toolbox">
            <button type="submit" name="submit" class="btn btn-oval btn-primary btn-sm"> 
                <i class="fa fa-save "></i> Save</button>
            <a href="{{url('role')}}" class="btn btn-warning btn-oval btn-sm"> 
                <i class="fa fa-reply"></i> Back</a>
        </div>
        <div class="card-block">
            <div class="col-md-6">
               @component('coms.alert')
               @endcomponent
                
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$roles->id}}">
                <div class="form-group row">
                    <label for="Name" class="col-sm-4 form-control-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="name" class="form-control" id="Name" name="name" placeholder="Name" value="{{$roles->name}}" required autofocus>
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
			
            $("#menu_security").addClass("active open");
			$("#security_collapse").addClass("collapse in");
            $("#role_id").addClass("active");
			
        })
    </script>
@endsection

