@extends('inventory::layouts.master')

@section('content')
<div class="card card-gray">
	<div class="card-header">
		<div class="header-block">
			<p class="title"> Pending Stock Requests
				<a href="{{url('inventory')}}" class="btn btn-primary-outline btn-oval btn-sm mx-left">
                    <i class="fa fa-reply"></i> {{trans('inventory::labels.back')}}
                </a>
			</p>
		</div>
	</div>
    <hr>
	<div class="card-block">
		<div class="table-flip-scroll">
			
			<table class="table table-sm table-bordered table-hover flip-content">
				<thead class="flip-header">
					<tr>
						<th>#</th>
						<th>{{trans('inventory::labels.date')}}</th>
                        <th>{{trans('inventory::labels.request_code')}}</th>
                        <th>{{trans('inventory::labels.approve_by')}}</th>
                        <th>{{trans('inventory::labels.department')}}</th>
						
					</tr>
				</thead>
				<tbody>			
					@php($i=1)
                    @foreach($outs as $p)
                        <tr>
							<td>{{$i++}}</td>
							<td>
                                <a href="{{url('inventory/request/detail/'.$p->id)}}">{{$p->request_date}}</a>
                            </td>
							<td>{{$p->request_code}}</td>
                            <td>
                                {{$p->first_name}} {{$p->last_name}}
                            </td>
                            <td>{{$p->dname}}</td>
                          
                        </tr>
                    @endforeach
				</tbody>
			</table>
		</div>
		
	</div>
</div>
@endsection
@section('js')
<script>
	$(document).ready(function(){
        $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_dashboard").addClass("active");
		
	});
	
</script>
@endsection