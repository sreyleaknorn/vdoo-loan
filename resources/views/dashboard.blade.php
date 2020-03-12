@extends('layouts.master')
@section('header')
    <strong>Dashboard</strong>
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
    <div class="col col-12 col-sm-12 col-md-5 col-xl-5 stats-col">
        <div class="card sameheight-item stats" data-exclude="xs" style="height: 322.6px;">
            <div class="card-block">
                <div class="title-block">
                    <h4 class="title text-success"> 
                        <a href="{{url('customer')}}" class="text-success">Customers</a>    
                    </h4>
                </div>
                <hr>
                <div class="row row-sm stats-container">
                    <div class="col-12 col-sm-6 stat-col">
                        <div class="stat-icon">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                        <div class="stat text-primary">
                            <div class="value"> 0 </div>
                            <div class="name"> Today </div>
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
                            <div class="value">  </div>
                            <div class="name"> This Month </div>
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
                            <div class="value"> 0 </div>
                            <div class="name"> This Year </div>
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
                            <div class="value">  </div>
                            <div class="name"> So Far</div>
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
                        <a href="{{url('invoice')}}" class="text-success">Due Invoices</a>
                    </h4>
                </div>
                <div class="row row-sm stats-container">
                    <table class="table table-sm mytbl">
                        <thead>
                            <tr>
                                <th>Invoice#</th>
                                <th>Customer</th>
                                <th>Due Date</th>
                                <th>Due Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                    <a href="#" class='text-sm text-success'>View All >></a>
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
                    <h4 class="title text-danger"> Payments</h4>
                    </p>
                </div>
                <hr>
                <div class="row row-sm stats-container">
                    <div class="col-12 col-sm-6 stat-col">
                        <div class="stat-icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <div class="stat text-primary">
                            <div class="value"> $ 0 </div>
                            <div class="name"> Today </div>
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
                            <div class="value"> $ 0 </div>
                            <div class="name"> This Month </div>
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
                            <div class="value"> $ 0 </div>
                            <div class="name"> This Year </div>
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
                            <div class="value"> $ 0 </div>
                            <div class="name"> So Far</div>
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
                    <h4 class="title">Quick Actions</h4>
                    </p>
                </div>
                
                <div class="row  stats-container">
                    <div class="col-sm-6">
                       <ul>
                           <li>
                               <a href="{{url('invoice/create')}}" class="text-success">Create Invoice</a>
                           </li>
                           <li>
                                <a href="{{url('customer/create')}}" class="text-success">Create Customer</a>
                            </li>
                            <li>
                                <a href="{{url('product/create')}}" class="text-success">Create Product</a>
                            </li>
                            <li>
                                <a href="{{url('in/create')}}" class="text-success">Create Stock In</a>
                            </li>
                            <li>
                                <a href="{{url('out/create')}}" class="text-success">Create Stock Out</a>
                            </li>
                       </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul>
                            <li>
                                <a href="{{url('category/create')}}" class="text-primary">Create Category</a>
                            </li>
                            <li>
                                 <a href="{{url('unit/create')}}" class="text-primary">Create UoM</a>
                             </li>
                             <li>
                                 <a href="{{url('exchange')}}" class="text-primary">Exchange Rate</a>
                             </li>
                             <li>
                                 <a href="{{url('user/create')}}" class="text-primary">Create User</a>
                             </li>
                             <li>
                                 <a href="{{url('role/create')}}" class="text-primary">Create Role</a>
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