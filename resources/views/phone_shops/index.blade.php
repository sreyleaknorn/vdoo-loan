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
		<table class="table table-sm table-bordered">
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
                    if(!$pagex)
                        $pagex = 1;
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
                            <a href="{{url('phoneshop/delete?id='.$ps->id)}}" title="Delete" class='text-danger'
                             onclick="return confirm('You want to delete?')">
                                <i class="fa fa-trash"></i>
                            </a>&nbsp;
                            <a href="{{url('phoneshop/edit/'.$ps->id)}}" class="text-success" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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