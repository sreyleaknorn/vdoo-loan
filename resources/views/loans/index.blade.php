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

        <form action="{{url('loan/search')}}">
            <p>
                ហាងទូរស័ព្ទ: <select name="shop" style="padding: 5px 2px;font-size:12px">
                    <option value="all"> --ទាំងអស់-- </option>
                    @foreach($shops as $s)
                    <option value="{{$s->id}}" {{$s->id==$sh?'selected':''}}>{{$s->name}}</option>
                    @endforeach
                </select>
                 ស្ថានភាព: <select name="status" style="padding: 5px 2px;font-size:12px">
                    <option value="all"> --ទាំងអស់-- </option>
                    <option value="new" {{$status=='new'?'selected':''}}>ថ្មី</option>
                    <option value="paying" {{$status=='paying'?'selected':''}}>កំពុងបង់</option>
                    <option value="paid" {{$status=='paid'?'selected':''}}>បានបញ្ចប់</option>
                    <option value="stopped" {{$status=='stopped'?'selected':''}}>ឈប់បង់</option>
                </select>
                អតិថិជន: <input type="text" name='cus' placeholder="ឈ្មោះ ឬលេខទូរស័ព្ទ" value="{{$cus}}">
                <button>ស្វែងរក</button>
            </p>
        </form>
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
                            <th>ហាងទូរស័ព្ទ</th>
                            <th>ឈ្មោះទូរស័ព្ទ</th>
                            <th>ចំនួនខ្ចី</th>
                            <th>ការប្រាក់</th>
                            <th>សរុប</th>
                            <th>បានបង់</th>
                            <th>នៅខ្វះ</th>
                            <th>ស្ថានភាព</th>
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
                        @foreach($loans as $loan)
                        <tr>
                            <?php
                            $status = $loan->status;
                            $color = '';
                            switch ($status) {
                                case "new":
                                    $status = "ថ្មី";
                                    $color = 'badge-primary';
                                    break;
                                case "paying":
                                    $status = "កំពុងបង់";
                                    $color = 'badge-warning';
                                    break;
                                case "paid":
                                    $status = "បានបញ្ចប់";
                                    $color = 'badge-success';
                                    break;
                                default:
                                    $color = 'badge-danger';
                                    $status = "ឈប់បង់";
                            }
                            ?>

                            <td>{{$i++}}</td>
                            <td>
                                <a href="{{url('loan/detail/'.$loan->id)}}"><span class="text-teal"><strong>L{{sprintf("%04s",$loan->id)}}</strong></span></a>   </td>
                            <td><a href="{{url('loan/detail/'.$loan->id)}}">{{$loan->name}}</a></td>
                            <td>{{$loan->model_name}}</td>
                            <td>{{$loan->shop_name}}</td>
                            <td>${{number_format($loan->loan_amount,3)}}</td>
                            <td>{{$loan->loan_interest}}%</td>
                            <td>${{number_format($loan->total_amount,3)}}</td>
                            <td>${{number_format($loan->paid_amount,3)}}</td>
                            <td>${{number_format($loan->due_amount,3)}}</td>
                            <td><span class="badge {{$color}}">{{$status}}</span></td>
                            <td class="action">
                                <a target="_new" href="{{url('loan/print/'.$loan->id)}}" title="Print" class='text-success'
                                   >
                                    <i class="fa fa-print"></i>
                                </a>&nbsp;
                                @if($loan->status == 'new')
                                <a href="{{url('loan/edit/'.$loan->id)}}" title="Edit" class='text-warning'
                                   >
                                    <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                @endif
                                
                                <a href="{{url('loan/delete?id='.$loan->id)}}" title="Delete" class='text-danger'
                                   onclick="return confirm('Are you sure to delete?')">
                                    <i class="fa fa-trash"></i>
                                </a>&nbsp;

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
       
          {{ $loans->appends(request()->input())->links() }}

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
        $("#menu_all_loan").addClass("active");
    });

</script>
@endsection