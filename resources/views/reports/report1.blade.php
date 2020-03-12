@extends('layouts.master')
@section('header')
    <strong>Stock Balance Report</strong>
@endsection
@section('content')
                       
    <div class="card card-gray">
        <div class="toolbox">
            <a href="{{url('report/onhand/print')}}" class="btn btn-primary btn-sm btn-oval" target="_blank">
                <i class="fa fa-print"></i> Print
            </a>
        </div>
        <div class="card-block">
           
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Barcode</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>UoM</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($products as $p)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$p->barcode}}</td>
                            <td>{{$p->code}}</td>
                            <td>{{$p->kh_name}} <br> {{$p->name}}</td>
                            <td>{{$p->onhand}}</td>
                            <td>{{$p->uname}}</td>
                            <td>{{$p->cname}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
                           
@endsection

@section('js')
	<script>
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_report").addClass("active open");
			$("#report_collapse").addClass("collapse in");
            $("#menu_onhand_report").addClass("active");
			
        })
    </script>
@endsection