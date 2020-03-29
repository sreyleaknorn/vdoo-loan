@extends('layouts.master')
@section('header')
    <strong>ទំព័រមុខ</strong>
@endsection
@section('css')
    <style>
        .mytbl thead tr th{
            font-size: 14px;
        }
        .mytbl tbody tr td{
            font-size: 13px;
        }
    </style>
@endsection
@section('content')
<div class="row sameheight-container">
    <div class="col col-12 col-sm-12 col-md-12 col-xl-12 stats-col">
        <div class="card sameheight-item stats" data-exclude="xs" style="height: 322.6px;">
            <div class="card-block">
                <div class="title-block">
                    <h4 class="title text-success"> 
                        <span class="text-danger">ស្វែងរកអតិថិជន ត្រូវបង់ប្រាក់</span>
                    </h4>
                </div>
                <hr>
                <div class="row row-sm stats-container">
                    <div class="col-sm-12">
                        <form action="{{url('search-all')}}">
                            ហាងទូរស័ព្ទ: <select name="shop" id="shop" style="padding: 5px 2px;font-size:12px">
                                <option value="all">-- ទាំងអស់ --</option>
                                @foreach($shops as $s)
                                    <option value="{{$s->id}}">{{$s->name}} - {{$s->phone}}</option>
                                @endforeach
                            </select>
                            ចាប់ពី: 
                            <input type="date" name='start' value="{{date('Y-m-d')}}" required> 
                            ដល់: 
                            <input type="date" name='end' value="{{date('Y-m-d')}}" required>
                            <button><i class="fa fa-search"></i> ស្វែងរក</button>
                        </form>
                        <p></p>
                        <form action="{{url('search')}}">
                            អតិថិជន: <input type="text" name='q' placeholder="ឈ្មោះ ឬលេខទូរស័ព្ទ">
                            <button><i class="fa fa-search"></i> ស្វែងរក</button>
                        </form>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row sameheight-container">
    <div class="col col-12 col-sm-12 col-md-5 col-xl-5 stats-col">
        <div class="card sameheight-item stats" data-exclude="xs" style="height: 322.6px;">
            <div class="card-block">
                <div class="title-block">
                    <h4 class="title text-success"> 
                        <a href="{{url('customer')}}" class="text-success">អតិថិជន</a>    
                    </h4>
                </div>
                <hr>
                <div class="row row-sm stats-container">
                    <div class="col-12 col-sm-6 stat-col">
                        <div class="stat-icon">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                        <div class="stat text-primary">
                            <div class="value"> {{$c1}} <small>នាក់</small></div>
                            <div class="name"> ថ្ងៃនេះ </div>
                        </div>
                        <div class="progress stat-progress">
                            <div class="progress-bar" style="width: 50%;"></div>
                        </div>
                    </div>
                   
                    <div class="col-12 col-sm-6  stat-col">
                        <div class="stat-icon">
                            <i class="fa fa-circle"></i>
                        </div>
                        <div class="stat text-success">
                            <div class="value"> {{$c2}} <small>នាក់</small></div>
                            <div class="name"> ខែនេះ </div>
                        </div>
                        <div class="progress stat-progress">
                            <div class="progress-bar" style="width: 50%;"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6  stat-col">
                        <div class="stat-icon">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                        <div class="stat text-info">
                            <div class="value"> {{$c3}} <small>នាក់</small></div>
                            <div class="name"> ឆ្នាំនេះ </div>
                        </div>
                        <div class="progress stat-progress">
                            <div class="progress-bar" style="width: 50%;"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6  stat-col">
                        <div class="stat-icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="stat">
                            <div class="value"> {{$c4}} <small>នាក់</small></div>
                            <div class="name"> សរុបរួម</div>
                        </div>
                        <div class="progress stat-progress">
                            <div class="progress-bar" style="width: 50%;"></div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

    <div class="col col-12 col-sm-12 col-md-7 col-xl-7 stats-col">
        <div class="card sameheight-item stats" data-exclude="xs" style="height: 322.6px;">
            <div class="card-block">
                <div class="title-block">
                    <h4 class="title text-success">
                        <a href="{{url('invoice')}}" class="text-success">អតិថិជនត្រូវបង់ថ្ងៃនេះ</a>
                    </h4>
                </div>
                <div class="row row-sm stats-container">
                    <table class="table table-sm mytbl">
                        <thead>
                            <tr>
                                <th>កូដ</th>
                                <th>អតិថិជន</th>
                                <th>ហាង</th>
                                <th>ត្រូវបង់</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $n)
                                <tr>
                                    <td>
                                        <a href="{{url('loan/detail/'.$n->loan_id)}}">L000{{$n->loan_id}}</a>
                                    </td>
                                    <td>{{$n->name}} - {{$n->phone}}</td>
                                    <td>{{$n->shop_name}}</td>
                                    <td>$ {{$n->total_amount}}</td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>                 
</div>

<div class="row sameheight-container">
<div class="col col-12 col-sm-12 col-md-5 col-xl-5 stats-col">
        <div class="card sameheight-item stats" data-exclude="xs" style="height: 322.6px;">
            <div class="card-block">
                <div class="title-block">
                    <h4 class="title text-danger"> ប្រាក់បានបង់</h4>
                    </p>
                </div>
                <hr>
                <div class="row row-sm stats-container">
                    <div class="col-12 col-sm-6 stat-col">
                        <div class="stat-icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <div class="stat text-primary">
                            <div class="value"> $ {{$p1}} </div>
                            <div class="name"> ថ្ងៃនេះ </div>
                        </div>
                        <div class="progress stat-progress">
                            <div class="progress-bar" style="width: 50%;"></div>
                        </div>
                    </div>
                   
                    <div class="col-12 col-sm-6  stat-col">
                        <div class="stat-icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <div class="stat text-success">
                            <div class="value"> $ {{$p2}} </div>
                            <div class="name"> ខែនេះ </div>
                        </div>
                        <div class="progress stat-progress">
                            <div class="progress-bar" style="width: 50%;"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6  stat-col">
                        <div class="stat-icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <div class="stat text-info">
                            <div class="value"> $ {{$p3}} </div>
                            <div class="name"> ឆ្នាំនេះ </div>
                        </div>
                        <div class="progress stat-progress">
                            <div class="progress-bar" style="width: 50%;"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6  stat-col">
                        <div class="stat-icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <div class="stat">
                            <div class="value"> $ {{$p4}} </div>
                            <div class="name"> សរុបរួម</div>
                        </div>
                        <div class="progress stat-progress">
                            <div class="progress-bar" style="width: 50%;"></div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>       
    <div class="col col-12 col-sm-12 col-md-7 col-xl-7 stats-col">
        <div class="card sameheight-item stats" data-exclude="xs" style="height: 322.6px;">
            <div class="card-block">
                <div class="title-block">
                    <h4 class="title">មុខងារសំខាន់ៗ</h4>
                    </p>
                </div>
                
                <div class="row  stats-container">
                    <div class="col-sm-6">
                       <ul>
                           <li>
                               <a href="{{url('loan/create')}}" class="text-success">បង្កើតរំលស់</a>
                           </li>
                           <li>
                                <a href="{{url('customer/create')}}" class="text-success">បង្កើតអតិថិជន</a>
                            </li>
                            <li>
                                <a href="{{url('phoneshop/create')}}" class="text-success">បង្កើតហាងទូរស័ព្ទ</a>
                            </li>
                       </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul>
                            <li>
                                <a href="{{url('company')}}" class="text-primary">ព័ត៌មានក្រុមហ៊ុន</a>
                            </li>
                           
                             <li>
                                 <a href="{{url('user/create')}}" class="text-primary">បង្កើតអ្នកប្រើប្រាស់</a>
                             </li>
                             <li>
                                 <a href="{{url('role/create')}}" class="text-primary">បង្កើតតួនាទី</a>
                             </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

             
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#sidebar-menu li").removeClass('active');
            $("#menu_dashboard").addClass('active');
        });
    </script>
@stop