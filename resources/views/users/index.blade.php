@extends('layouts.master')
@section('header')
    <strong>Users</strong>
@endsection
@section('content')
                        
    <div class="card card-gray">
        <div class="toolbox">
            <a href="{{url('user/create')}}"class="btn btn-primary btn-oval btn-sm">
                <i class="fa fa-plus-circle"></i> Create</a>
        </div>
        <div class="card-block">
                <div class="table-flip-scroll">

                    <table class="table table-striped table-sm table-bordered table-hover flip-content">
                        <thead class="flip-header">
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pagex = @$_GET['page'];
                            if(!$pagex)
                                $pagex = 1;
                            $i = config('app.row') * ($pagex - 1) + 1;
                            ?>
                            @foreach($users as $user)
                                <tr class="odd gradeX">
                                    <td>{{$i++}}</td>
                                    <td><img src="{{asset($user->photo)}}" width="27"/></td>
                                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                                    <td>{{$user->gender}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->role_name}}</td>
                                    
                                    <td>
                                        <a href="{{url('user/edit/'.$user->id)}}" title="Edit" class="text-success"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                        <a href="{{url('user/delete/'.$user->id)}}" title="Delete" onclick="return confirm('You want to delete?')" class="text-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            
        </div>
    </div>
                           
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_security").addClass("active open");
			$("#security_collapse").addClass("collapse in");
            $("#menu_user").addClass("active");
			
        })
    </script>
@endsection