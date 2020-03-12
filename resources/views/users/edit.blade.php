@extends('layouts.master')
@section('header')
    <strong>Edit User</strong>
@endsection
@section('content')
<form action="{{url('user/update')}}" method="POST" enctype="multipart/form-data">
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
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-4 form-control-label">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="first_name" name="first_name" 
                                    value="{{$user->first_name}}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-4 form-control-label">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="last_name" name="last_name" 
                                    value="{{$user->last_name}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-sm-4 form-control-label">Gender</label>
                            <div class="col-sm-8">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="Male" {{$user->gender=='Male'?'selected':''}}>Male</option>
                                    <option value="Female" {{$user->gender=='Female'?'selected':''}}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 form-control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 form-control-label">Phone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 form-control-label">Username <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username" name="username" 
                                    value="{{$user->username}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 form-control-label">Password</label>
                            <div class="col-sm-8">
                                <span class="small-text">Keep it blank to use the old password.</span>
                                <input type="password" class="form-control" id="password" name="password" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group row">
                            <label for="role" class="col-sm-3 form-control-label">Role <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select name="role_id" class="form-control" id="role" required>
                                    <option value="">-- Select --</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{$user->role_id==$role->id?'selected':''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="col-sm-3">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control"  name="photo" onchange="loadFile(event)">
                                <br>
                                <img src="{{asset($user->photo)}}" id="img" width="72">
                                
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