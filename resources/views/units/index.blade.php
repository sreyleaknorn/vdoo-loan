@extends('layouts.master')
@section('header')
    <strong>Units</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
        <a href="{{url('unit/create')}}" class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-plus-circle"></i> Create
        </a>
    </div>
	<div class="card-block">
       @component('coms.alert')
       @endcomponent
       <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>			
            <?php
                $pagex = @$_GET['page'];
                if(!$pagex) $pagex = 1;
                $i = config('app.row') * ($pagex - 1) + 1;
            ?>
            @foreach($units as $unit)
                <tr>
                    <td>{{$i++}}</td>
                    <td title="code={{$unit->id}}">{{$unit->name}}</td>
                    <td class="action">
                        <a href="{{url('unit/delete', $unit->id)}}" title="Delete" class='text-danger'
                         onclick="return confirm('You want to delete?')">
                            <i class="fa fa-trash"></i>
                        </a>&nbsp;
                        <a href="{{url('unit/edit', $unit->id)}}" class="text-success" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$units->links()}}
		
	</div>
</div>
@endsection

@section('js')
	<script>
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_config").addClass("active open");
			$("#config_collapse").addClass("collapse in");
            $("#menu_unit").addClass("active");
			
        });
    </script>
@endsection