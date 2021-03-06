@extends('layouts.master')
@section('header')
    <strong>Stock Out</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
        <div class="row" >
            <div class="col-sm-3">
                <a href="{{url('out/create')}}" class="btn btn-primary btn-oval btn-sm">
                    <i class="fa fa-plus-circle"></i> Create
                </a>
            </div>
            <div class="col-sm-4">
                <form action="{{url('out/search')}}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-sm" 
                            placeholder="Search" value="{{$q}}" name="q">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                Search
                            </button> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<div class="card-block">
		@component('coms.alert')
        @endcomponent
		<table class="table table-sm table-bordered table-hover flip-content">
            <thead class="flip-header">
                <tr>
                    <th>#</th>
                    <th>Date Out</th>
                    <th>Reference</th>
                    <th>Out By</th>
                    <th>Description</th>
                    
                </tr>
            </thead>
            <tbody>			
                <?php
                    $pagex = @$_GET['page'];
                    if(!$pagex)
                        $pagex = 1;
                    $i = config('app.row') * ($pagex - 1) + 1;
                ?>
                @foreach($outs as $p)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <a href="{{url('out/detail/'.$p->id)}}">{{$p->out_date}}</a>
                        </td>
                        <td>{{$p->reference}}</td>
                        <td>{{$p->first_name}} {{$p->last_name}}</td>
                        <td>{{$p->description}}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $outs->appends(request()->except('q'))->links() }}
	</div>
</div>
@endsection
@section('js')
<script>
	$(document).ready(function(){
        $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_stockout").addClass("active");
		
	});
	
</script>
@endsection