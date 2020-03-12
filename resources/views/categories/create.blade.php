@extends('layouts.master')
@section('header')
    <strong>Create Category</strong>
@endsection
@section('content')
<form action="{{route('category.store')}}" method="POST">
<div class="card card-gray">
	<div class="toolbox">
        <button class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-save"></i> Save
        </button>
        <a href="{{url('category')}}"class="btn btn-warning btn-oval btn-sm">
            <i class="fa fa-reply"></i> Back
        </a>
    </div>
	<div class="card-block">
		<div class="row">
            <div class="col-sm-8">
               @component('coms.alert')
               @endcomponent
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="name" class="col-sm-3">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" 
                            value="{{old('name')}}" required autofocus>
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
            $("#menu_category").addClass("active");
			
        })
    </script>
@endsection