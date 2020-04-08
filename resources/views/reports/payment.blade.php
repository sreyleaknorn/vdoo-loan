@extends('layouts.master')
@section('header')
<strong>តារាងប្រាក់បានបង់</strong>
@endsection
@section('content')
<div class="card card-gray">
    <div class="toolbox">
        <div class="toolbox">
            <form action="{{url('report/payment/search')}}" class="form-inline">
                <div class="col-12">
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
                </div>
                
                <div class="col-6">
                    <div class="form-group text-right">
                        <label for="customer_id" class="col-5 text-right">អតិថិជន</label>
                        <div class="col-7">
                             <select name="customer_id" id="customer_id" class="chosen-select">
                            <option value="all" {{$customer_id=='all'?'selected':''}}>-- ទាំងអស់ --</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}" {{$customer_id==$customer->id?'selected':''}}>{{$customer->name}} - {{$customer->phone}}</option>
                            @endforeach
                        </select>
                        </div>
                       
                    </div>
                </div>
                <div class="col-6">
                    <button><i class="fa fa-search"></i> ស្វែងរក</button>
                </div>
            </form>

            <p></p>
        </div>
    </div>
    <div class="card-block">

        @if(count($loanpayments)>0)
        <div class="table-flip-scroll">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-hover flip-content">
                    <thead class="flip-header">
                        <tr>
                            <th>#</th>
                            <th>លេខសំគាល់</th>
                            <th>អតិថិជន</th>
                            <th>ហាង</th>
                            <th>ថ្ងៃទទួលប្រាក់</th>
                            <th>ប្រាក់ទទួលបាន</th>

                        </tr>
                    </thead>
                    <tbody>			
                        @php($i=1)
                        @php($amount=0)

                        @foreach($loanpayments as $pm)

                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                <span class="text-teal"><strong>L{{sprintf("%04s",$pm->loan_id )}}</strong></span>
                            </td>
                            <td>{{$pm->name}}</td>
                            <td>{{$pm->shop_name}}</td>
                            <td>{{$pm->receive_date}}</td>
                            <td>${{number_format($pm->receive_amount,3)}}</td>
                            <?php $amount += $pm->receive_amount; ?>

                        </tr>
                        @endforeach
                        <tr>

                            <td colspan="5" class="text-right">
                                <strong>Total Amount</strong>
                            </td>
                            <td>
                                <strong> ${{number_format($amount,3)}}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <p>&nbsp;</p>

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
        $("#menu_report1").addClass("active");

    })
</script>
@endsection
