@extends('layouts.master')
@section('header')
<strong>តារាងប្រាក់បានបង់</strong>
@endsection
@section('content')
<div class="card card-gray">
    <div class="toolbox">
        <div class="toolbox">
            <form action="{{url('payment/search')}}">
                ហាងទូរស័ព្ទ: <select name="shop" id="shop" style="padding: 5px 2px;font-size:12px">
                    <option value="all" {{$sh=='all'?'selected':''}}>-- ទាំងអស់ --</option>
                    @foreach($shops as $s)
                    <option value="{{$s->id}}" {{$sh==$s->id?'selected':''}}>{{$s->name}} - {{$s->phone}}</option>
                    @endforeach
                </select>
                ចាប់ពី: 
                <input type="date" name='start' value="{{$start}}" required> 
                ដល់: 
                <input type="date" name='end' value="{{$end}}" required>
                <button><i class="fa fa-search"></i> ស្វែងរក</button>
            </form>
            <p></p>
            
            <p></p>
        </div>
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
                            <th>លេខសំគាល់</th>
                            <th>អតិថិជន</th>
                            <!-- <th>ហាង</th> -->
                            <th>ប្រាក់ទទួលបាន</th>
                            <th>ថ្ងៃទទួលប្រាក់</th>
                            <th>សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody>			
                        <?php
                        $pagex = @$_GET['page'];
                        if (!$pagex)
                            $pagex = 1;
                        $i = config('app.row') * ($pagex - 1) + 1;
                        ?>
                        @foreach($loanpayments as $pm)

                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                <a href="{{url('loan/detail/'.$pm->loan_id )}}"><span class="text-teal"><strong>L{{sprintf("%04s",$pm->loan_id )}}</strong></span></a>   
                            </td>
                            <td>{{$pm->name}}</td>
                            <!-- <td>{{$pm->shop_name}}</td> -->
                            <td>${{number_format($pm->receive_amount,3)}}</td>
                            <td>{{$pm->receive_date}}</td>
                            <td>

                                <a  target="_new" href="{{url('loanpayment/print/'.$pm->loan_id)}}" title="Print" class="btn btn-success-outline btn-oval btn-sm mx-left" >
                                    <i class="fa fa-print"></i> 
                                </a>
                                <a href="{{url('loan/delete_payment?id='.$pm->id)}}" class="btn btn-danger-outline btn-oval btn-sm mx-left" onclick="return confirm('អ្នកពិតជាចង់លុបទិន្នន័យ?')">
                                    <i class="fa fa-trash"></i> លុប
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <p>&nbsp;</p>
        
        {{ $loanpayments->appends(request()->input())->links() }}


    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $("#sidebar-menu li ").removeClass("active open");
        $("#sidebar-menu li ul li").removeClass("active");

        $("#menu_loan").addClass("active open");
        $("#loan_collapse").addClass("collapse in");
        $("#menu_all_loanpayment").addClass("active");
    });

</script>
@endsection