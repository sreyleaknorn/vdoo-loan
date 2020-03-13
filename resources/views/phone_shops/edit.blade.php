@extends('layouts.master')
@section('header')
    <strong>កែប្រែ ហាងទូរស័ព្ទ</strong>
@endsection
@section('content')
<form action="{{url('phoneshop/update')}}" method="POST" enctype="multipart/form-data">
<div class="card card-gray">
	<div class="toolbox">
        <button class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-save"></i> រក្សាទុក
        </button>
        <a href="{{url('phoneshop')}}" class="btn btn-warning btn-oval btn-sm">
            <i class="fa fa-reply"></i> ត្រលប់ក្រោយ
        </a>
    </div>
	<div class="card-block">
        @component('coms.alert')
        @endcomponent
            <div class="row">
                <div class="col-sm-7">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$ps->id}}">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3">ឈ្មោះ<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" 
                                value="{{$ps->name}}" required>
                        </div>
                    </div>
					<div class="form-group row">
                        <label for="name" class="col-sm-3">លេខទូរស័ព្ទ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" 
                                value="{{$ps->phone}}">
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="address" class="col-sm-3">អាសយដ្ឋាន </label>
                    <div class="col-sm-9">
						<textarea class="form-control" id="address" name="address">{{$ps->address}}</textarea>
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