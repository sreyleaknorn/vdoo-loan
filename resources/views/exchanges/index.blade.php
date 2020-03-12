@extends('layouts.master')
@section('header')
    <strong>Exchange Rates</strong>
@endsection
@section('css')
    <style>
        .text-muted td{
            color: #aaa;
        }
    </style>
@endsection
@section('content')
<div class="card card-gray">
	
	<div class="card-block">
       @component('coms.alert')
       @endcomponent
		<div class="table-flip-scroll">
			
			<table class="table table-sm table-bordered">
				<thead>
					<tr>
						<th>#</th>
                        <th>Dollar</th>
                        <th>KHR</th>
                        <th>Date Time</th>
                        <th>Username</th>
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
                    @foreach($active as $a)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>$ {{$a->dollar}}</td>
                            <td>KHR {{$a->khr}}</td>
                            <td>{{date_format(date_create($a->create_at), 'Y-m-d h:i:s a')}}</td>
                            <td>{{$a->first_name}} {{$a->last_name}}</td>
                            <td class="action">
                                <a href="{{url('exchange/edit/'.$a->id)}}" class="text-success" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <?php
                        $pagex = @$_GET['page'];
                        if(!$pagex)
                            $pagex = 1;
                        $i = config('app.row') * ($pagex - 1) + 1;
                    ?>
                    @foreach($old as $a)
                        <tr class='text-muted'>
                            <td>{{($i++) + 1}}</td>
                            <td>$ {{$a->dollar}}</td>
                            <td>KHR {{$a->khr}}</td>
                            <td>{{date_format(date_create($a->create_at), 'Y-m-d h:i:s a')}}</td>
                            <td>{{$a->first_name}} {{$a->last_name}}</td>
                            <td class="action">
                               
                            </td>
                        </tr>
                    @endforeach
				</tbody>
			</table>
			{{$old->links()}}
		</div>
		
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
            $("#menu_exchange").addClass("active");
			
        });
    </script>
@endsection