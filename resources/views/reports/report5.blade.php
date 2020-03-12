@extends('layouts.master')
@section('header')
    <strong>Stock In Summary</strong>
@endsection
@section('content')
                       
    <div class="card card-gray">
        <div class="toolbox">
            <form action="{{url('report/in/summary/search')}}">
               <p>
                    From: <input type="date" name='start' value="{{$start}}"> &nbsp;&nbsp;
                    To: <input type="date" name="end" value="{{$end}}"> 
                    <button>View</button>
               </p>
            </form>
        </div>
        <div class="card-block">
            @if(count($ins)>0)
            <a href="{{url('report/in/summary/print?start='.$start.'&end='.$end)}}" 
                target="_blank" class="btn btn-primary btn-sm btn-oval">
                <i class="fa fa-print"></i> Print
            </a>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>UoM</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @php($total=0)
                    @foreach($ins as $in)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$in->code}}</td>
                            <td>{{$in->kh_name}} <br> {{$in->name}}</td>
                            <td>{{$in->total}}</td>
                            <td>{{$in->uname}}</td>
                            <?php $total +=$in->total; ?>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right">
                            <strong>Total QTY</strong>
                        </td>
                        <td colspan="2">
                            <strong>{{$total}}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            @else
                <p>
                    No data found!
                </p>
            @endif
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
            $("#menu_stockin_summary").addClass("active");
			
        })
    </script>
@endsection