@extends('layouts.master')
@section('header')
    <strong>រំលស់</strong>
@endsection
@section('content')
<div class="card card-gray">
	<div class="toolbox">
        <a href="{{url('loan/create')}}"class="btn btn-primary btn-oval btn-sm">
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
                    <th>អតិថិជន</th>
                    <th>ហាងទូរស័ព្ទ</th>
                    <th>ម៉ូដែលទូរស័ព្ទ</th>
                    <th>ចំនួនខ្ចី</th>
                    <th>ការប្រាក់</th>
                    <th>សរុប</th>
                    <th>បានបង់</th>
                    <th>នៅខ្វះ</th>
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
                @foreach($loans as $loan)
                    <tr>
                        <td>{{$i++}}</td>
                        <td><a href="{{url('loan/detail/'.$loan->id)}}">{{$loan->name}}</a></td>
                        <td>{{$loan->model_name}}</td>
                        <td>{{$loan->shop_name}}</td>
                        <td>${{number_format($loan->loan_amount,3)}}</td>
                        <td>{{$loan->loan_interest}}%</td>
                        <td>${{number_format($loan->total_amount,3)}}</td>
                        <td>${{number_format($loan->paid_amount,3)}}</td>
                        <td>${{number_format($loan->due_amount,3)}}</td>
                        <td class="action">
                            <a href="{{url('loan/delete?id='.$loan->id)}}" title="Delete" class='text-danger'
                             onclick="return confirm('You want to delete?')">
                                <i class="fa fa-trash"></i>
                            </a>&nbsp;
                            <a href="{{url('loan/edit/'.$loan->id)}}" class="text-success" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$loans->links()}}
		
	</div>
</div>
@endsection

@section('js')
	<script>
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_loan").addClass("active open");
			$("#config_collapse").addClass("collapse in");
            $("#menu_all_loan").addClass("active");
        });
	
    </script>
@endsection