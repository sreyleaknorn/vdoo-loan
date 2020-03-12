@extends('layouts.master')
@section('header')
    <strong>Customers</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
        <a href="{{url('customer/create')}}"class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-plus-circle"></i> Create
        </a>
    </div>
	<div class="card-block">
        @component('coms.alert')
        @endcomponent
		<table class="table table-sm table-bordered">
            <thead class="flip-header">
                <tr>
                    <th>#</th>
                    <th>Company Name</th>
                    <th>Person Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
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
                @foreach($customers as $cat)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <a href="{{url('customer/detail/'.$cat->id)}}">
                                {{$cat->company_name}}
                            </a>
                        </td>
                        <td>
                            <a href="{{url('customer/detail/'.$cat->id)}}">
                                {{$cat->full_name}}
                            </a>
                        </td>
                        <td>{{$cat->gender}}</td>
                        <td>{{$cat->email}}</td>
                        <td>{{$cat->phone}}</td>
                        
                        <td class="action">
                            <a href="{{url('customer/delete?id='.$cat->id)}}" title="Delete" class='text-danger'
                             onclick="return confirm('You want to delete?')">
                                <i class="fa fa-trash"></i>
                            </a>&nbsp;
                            <a href="{{url('customer/edit/'.$cat->id)}}" class="text-success" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$customers->links()}}
		
	</div>
</div>
@endsection

@section('js')
	<script>
        $(document).ready(function () {
            $("#sidebar-menu li").removeClass('active');
		    $("#menu_customer").addClass('active');
        })
    </script>
@endsection