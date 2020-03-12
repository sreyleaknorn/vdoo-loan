@extends('layouts.master')
@section('header')
    <strong>My Profile</strong>
@endsection
@section('content')
<form action="{{url('user/profile/update')}}" method="POST" enctype="multipart/form-data">
<div class="card card-gray">
    <div class="toolbox">
        <button type="submit" name="submit" class="btn btn-oval btn-primary btn-sm"> 
            <i class="fa fa-save "></i> Save</button>
    </div>
	<div class="card-block" >
        <div class="row">
            <div class="col-md-7">
                @component('coms.alert')
                @endcomponent
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="name" class="col-sm-4">First Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="name" class="form-control" id="name" name="first_name" 
                            value="{{$user->first_name}}" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-sm-4">Last Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="name" class="form-control" id="last_name" name="last_name" 
                            value="{{$user->last_name}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gender" class="col-sm-4">Gender</label>
                    <div class="col-sm-8">
                        <select name="gender" id="gender" class="form-control">
                            <option value="Male" {{$user->gender=='Male'?'selected':''}}>Male</option>
                            <option value="Female" {{$user->gender=='Female'?'selected':''}}>Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Username" class="col-sm-4">Username</label>
                    <div class="col-sm-8">
                       {{$user->username}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-4">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="Email" name="email" 
                            value="{{$user->email}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-4">Phone</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Password" class="col-sm-4">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="Password" name="password">
                        <p class="text-small">Keep it blank to use the old password!</p>
                    </div>
                </div>
               
            </div>
            <div class="col-sm-5">
                <div class="form-group row">
                    <label  class="col-sm-3">Role</label>
                    <div class="col-sm-8">
                        {{$user->rname}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="photo" class="col-sm-3">Photo </label>
                    <div class="col-sm-8">
                        <input type="file" id="photo" name="photo" onchange="preview(event)">
                        <div style="margin-top: 9px">
                            <img src="{{asset($user->photo)}}" alt="" width="150" id='img'>
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
        function preview(evt)
        {
            let img = document.getElementById('img');
            img.src = URL.createObjectURL(evt.target.files[0]);
        }
    </script>
@endsection
