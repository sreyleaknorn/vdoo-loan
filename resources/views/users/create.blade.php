@extends('layouts.master')
@section('header')
    <strong> Create User</strong>
@endsection
@section('content')
<form action="{{url('user/save')}}" method="POST" enctype="multipart/form-data">
    <div class="card card-gray">
        <div class="toolbox">
            <button type="submit" class="btn btn-oval btn-primary btn-sm"> 
                    <i class="fa fa-save "></i> Save</button>
            <a href="{{url('user')}}" class="btn btn-warning btn-oval btn-sm"> 
                <i class="fa fa-reply"></i> Back</a>
        </div>
        <div class="card-block">
            <div class="card card-block sameheight-item" >
               @component('coms.alert')
			   @endcomponent
                <div class="row">
                    <div class="col-sm-7">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-4">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="first_name" name="first_name" 
                                    value="{{old('first_name')}}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-4">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="last_name" name="last_name" 
                                    value="{{old('last_name')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-sm-4">Gender</label>
                            <div class="col-sm-8">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4">Phone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="username" class="col-sm-4">Username <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username" name="username" 
                                    value="{{old('username')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4">Password <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="cpassword" class="col-sm-4">Confirm Password <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group row">
                            <label for="role" class="col-sm-3">Role <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="role_id" class="form-control" id="role" required>
                                    <option value="">-- Select --</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="fom-group row">
                            <label for="photo" class="col-sm-3">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control"  name="photo" onchange="loadFile(event)">
                                <br>
                                <img src="" id="img" width="72">
                            </div>
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
            $("#menu_user").addClass("active");
			
        });
        function loadFile(e){
            var output = document.getElementById('img');
            output.width = 170;
            output.src = URL.createObjectURL(e.target.files[0]);
        }
    </script>
@endsection