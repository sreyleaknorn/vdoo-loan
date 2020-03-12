@extends('layouts.master')
@section('header')
    <strong>Roles</strong>
@endsection
@section('content')
                       
    <div class="card card-gray">
        <div class="toolbox">
            <a href="{{url('role/create')}}" class="btn btn-primary btn-oval btn-sm">
                <i class="fa fa-plus-circle"></i> Create</a>
        </div>
        <div class="card-block">
            @component('coms.alert')
            @endcomponent
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $pagex = @$_GET['page'];
                        if(!$pagex) $pagex = 1;
                        $i = config('app.row') * ($pagex - 1) + 1;
                    ?>
                    @foreach($roles as $role)
                        <tr class="odd gradeX">
                            <td>{{$i++}}</td>
                            <td>
                                <a href="{{url('role/permission/'.$role->id)}}">{{$role->name}}</a>
                            </td>
                            <td>
                                
                                <a href="{{url('role/edit/'.$role->id)}}" title="Edit" class="text-success"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                <a href="{{url('role/delete/'.$role->id)}}" title="Delete" 
                                    onclick="return confirm('You want to delete?')" class="text-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$roles->links()}}
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
            $("#role_id").addClass("active");
			
        })
    </script>
@endsection