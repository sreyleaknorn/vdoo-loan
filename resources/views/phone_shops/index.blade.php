@extends('layouts.master')
@section('header')
<strong>ហាងទូរស័ព្ទ</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
        <a href="{{url('phoneshop/create')}}"class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-plus-circle"></i> បង្កើត
		</a>
	</div>
	<div class="card-block">
		
        @component('coms.alert')
        @endcomponent
		<div class="table-flip-scroll">
			<div class="table-responsive">
				<table class="table table-sm table-striped table-bordered table-hover flip-content">
					<thead class="flip-header">
						<tr>
							<th>#</th>
							<th>ឈ្មោះ</th>
							<th>លេខទូរស័ព្ទ</th>
							<th>អាសយដ្ឋាន</th>
							<th>សកម្មភាព</th>
						</tr>
					</thead>
					<tbody>			
						<?php
      $pagex = @$_GET['page'];
      if (!$pagex) {
          $pagex = 1;
      }
      $i = config('app.row') * ($pagex - 1) + 1;
      ?>
						@foreach($phone_shops as $ps)
						<tr>
							<td>{{$i++}}</td>
							<td>
								{{$ps->name}}
							</td>
							
							<td>{{$ps->phone}}</td>
							<td>{{$ps->address}}</td>
							
							<td class="action">
								<!-- <a href="{{url('loan/search?shop='.$ps->id.'&status=all&cus=')}}" class="btn btn-success-outline btn-oval btn-sm mx-left" > 
                                        រំលស់</a> -->
								<a href="{{url('schedule/shop/'.$ps->id)}}" class="btn btn-primary-outline btn-oval btn-sm mx-left" > 
                                        តារាងបង់ប្រាក់</a>
								&nbsp;		
								<a href="{{url('phoneshop/edit/'.$ps->id)}}" class="text-warning" title="Edit">
									<i class="fa fa-edit"></i>
								</a>
								&nbsp;
								<a href="{{url('phoneshop/delete?id='.$ps->id)}}" title="Delete" class='text-danger'
								onclick="return confirm('អ្នកពិតជាចង់លុបទិន្នន័យ?')">
									<i class="fa fa-trash"></i>
								</a>&nbsp;

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<p>&nbsp;</p>
		{{$phone_shops->links()}}
		
		
	</div>
</div>
@endsection

@section('js')
<script>
	$(document).ready(function () {
		$("#sidebar-menu li").removeClass('active');
		$("#menu_phone_shop").addClass('active');
	})
</script>
@endsection