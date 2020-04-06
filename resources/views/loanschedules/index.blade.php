@extends('layouts.master')
@section('header')
<strong>តារាងប្រាក់ត្រូវបង់</strong>
@endsection
@section('content')
<div class="card card-gray">
    <div class="toolbox">
        <form action="{{url('search-all')}}">
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
        <form action="{{url('search')}}">
            អតិថិជន: <input type="text" name='q' placeholder="ឈ្មោះ ឬលេខទូរស័ព្ទ" value="{{$q}}">
            <button><i class="fa fa-search"></i> ស្វែងរក</button>
        </form>
        <p></p>
    </div>
    <div class="card-block">

        @component('coms.alert')
        @endcomponent
        

        <div class="table-flip-scroll">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-hover flip-content">
                    <thead class="flip-header" >
                        <tr>
                            <th>#</th>
                            <th>លេខសំគាល់</th>
                            <th>អតិថិជន</th>
                            <th>ហាង</th>
                            <th>ថ្ងៃត្រូវបង់</th>
                            <th>ប្រាក់ដើម</th>
                            <th>ការប្រាក់</th>
                            <th>ចំនួនសរុប</th>
                            <th>ចំនួនបានបង់</th>
                            <th>ចំនួននៅខ្វះ</th>
                            <th>ថ្ងៃបានបង់</th>
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
                        @foreach($loanschedules as $ls)
                        <?php
                        $txt_class = '';
                        if ($ls->pay_date < date('Y-m-d') && $ls->ispaid == 0) {
                            $txt_class = 'text-danger';
                        }
                        ?>
                        <tr class="{{$txt_class}}" >
                            <td>{{$i++}}</td>
                            <td>
                                <a href="{{url('loan/detail/'.$ls->loan_id )}}"><span class="text-teal"><strong>L{{sprintf("%04s",$ls->loan_id )}}</strong></span></a>   
                            </td>
                            <td>{{$ls->name}}</td>
                            <td>{{$ls->shop_name}}</td>
                            <td>{{$ls->pay_date}}</td>
                            <td>${{number_format($ls->principal_amount,3)}}</td>
                            <td>${{number_format($ls->interest_amount,3)}}</td>
                            <td>${{number_format($ls->total_amount,3)}}</td>
                            <td>${{number_format($ls->paid_amount,3)}}</td>
                            <td>${{number_format($ls->due_amount,3)}}</td>
                            <td>{{$ls->paid_date}}</td>
                            <td class="action">
                                <?php
                                if ($ls->ispaid == 0) {
                                    ?>
                                    <a href="{{url('loan/pay/'.$ls->id)}}" class="btn btn-primary-outline btn-oval btn-sm mx-left"> 
                                        <i class="fa fa-dollar"></i> បង់ប្រាក់</a>
                                        <?php
                                    }
                                    ?>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <p>&nbsp;</p>
        
        {{ $loanschedules->appends(request()->input())->links() }}

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
        $("#menu_all_loanschedule").addClass("active");
    });

</script>
@endsection	