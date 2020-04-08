@extends('layouts.master')
@section('header')
    <strong>របាយការណ៍បង់ប្រាក់</strong>
@endsection
@section('content')
                       
    <div class="card card-gray">
        <div class="toolbox">
            <form action="{{url('report/expense/search')}}">
               <p>
                    ហាងទូរស័ព្ទ: <select name="shop">
                        <option value="all"> --All-- </option>
                        @foreach($shops as $s)
                            <option value="{{$s->id}}" {{$s->id==$sh?'selected':''}}>{{$s->name}}</option>
                        @endforeach
                    </select>
                    From: <input type="date" name='start' value="{{$start}}"> &nbsp;&nbsp;
                    To: <input type="date" name="end" value="{{$end}}"> 
                    <button>View</button>
               </p>
            </form>
        </div>
        <div class="card-block">
            @if(count($loans)>0)
            <a href="{{url('report/expense/print?sid='.$sh .'&start='.$start.'&end='.$end)}}" 
                target="_blank" class="btn btn-primary btn-sm btn-oval">
                <i class="fa fa-print"></i> Print
            </a>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>លេខកូដ</th>
                        <th>អតិថិជន</th>
                        <th>ហាង</th>
                        <th>ថ្ងៃខ្ចី</th>
                        <th>ថ្ងៃចេញប្រាក់</th>
                        <th>ចំនួនសរុប</th>
                        <th>លេខបុង</th>
                        <th>ទូរស័ព្ទ</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @php($total=0)
                    @foreach($loans as $l)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>L000{{$l->id}}</td>
                            <td>{{$l->name}}</td>
                            <td>{{$l->shop_name}}</td>
                            <td>{{$l->loan_date}}</td>
                            <td>{{$l->release_date}}</td>
                            <td>$ {{$l->loan_amount}}</td>
                            <td>{{$l->bill_no}}</td>
                            <td>{{$l->model_name}}</td>
                        </tr>
                        <?php $total += $l->loan_amount; ?>
                    @endforeach
                   <tr>
                       <td colspan="6" class="text-right">
                           <strong class="text-danger">សរុបរួម</strong>
                       </td>
                       <td colspan="3">
                           <strong class="text-danger">$ {{$total}}</strong>
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
            $("#menu_report2").addClass("active");
			
        })
    </script>
@endsection