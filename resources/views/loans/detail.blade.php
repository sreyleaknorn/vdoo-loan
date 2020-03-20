@extends('layouts.master')
@section('header')
    <strong>រំលស់</strong>
@endsection
@section('content')
                       
    <div class="card card-gray">
        <div class="card-header">
            <div class="header-block">
                <p class="title">លម្អិត រំលស់
                    <a href="javascript:history.back();" class="btn btn-primary-outline btn-oval btn-sm mx-left"> 
                        <i class="fa fa-reply"></i> ត្រលប់ក្រោយ</a> 
                    <a href="{{url('loan/print/'.$loan->id)}}" target="_blank" class="btn btn-warning-outline btn-oval btn-sm mx-left">
                        <i class="fa fa-print"></i> បោះពុម្ព
                    </a>
                    <a href="{{url('loan/delete?id='.$loan->id)}}" class="btn btn-danger-outline btn-oval btn-sm mx-left" onclick="return confirm('អ្នកពិតជាចង់លុបទិន្នន័យ?')">
                        <i class="fa fa-trash"></i> លុប
                    </a>
                </p>
            </div>
        </div>
        
        <div class="card-block">
            <div class="col-md-11">
                @component('coms.alert')
				@endcomponent
                
                <form action="#" method="POST" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-sm-6">
							
                            <div class="form-group row">
                                <label for="customer_id" class="col-sm-5 form-control-label">ឈ្មោះអតិថិជន </label>
                                <div class="col-sm-7">
                                    : {{$loan->name}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="customer_id" class="col-sm-5 form-control-label">លេខទូរស័ព្ទអតិថិជន </label>
                                <div class="col-sm-7">
                                    : {{$loan->phone}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="customer_id" class="col-sm-5 form-control-label">ហាងទូរស័ព្ទ </label>
                                <div class="col-sm-7">
                                    : {{$loan->shop_name}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="customer_id" class="col-sm-5 form-control-label">ឈ្មោះទូរស័ព្ទ </label>
                                <div class="col-sm-7">
                                    : {{$loan->model_name}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="customer_id" class="col-sm-5 form-control-label">លេខ​សម្គាល់ </label>
                                <div class="col-sm-7">
                                    : {{$loan->serial}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="customer_id" class="col-sm-5 form-control-label">លេខបុង </label>
                                <div class="col-sm-7">
                                    : {{$loan->bill_no}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="invoice_date" class="col-sm-5 form-control-label">ថ្ងៃខ្ចី</label>
                                <div class="col-sm-7">
                                    : {{$loan->loan_date}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="invoice_date" class="col-sm-5 form-control-label">ថ្ងៃបញ្ចេញប្រាក់</label>
                                <div class="col-sm-7">
                                    : {{$loan->release_date}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="invoice_date" class="col-sm-5 form-control-label">ថ្ងៃចាប់ផ្ដើមការប្រាក់</label>
                                <div class="col-sm-7">
                                    : {{$loan->start_interest_date}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="customer_id" class="col-sm-5 form-control-label">លេខសំគាល់ </label>
                                <div class="col-sm-7">
                                    : L{{sprintf("%04s",$loan->id)}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="due_date" class="col-sm-5 form-control-label">ចំនួនខ្ចី</label>
                                <div class="col-sm-7">
                                    : ${{number_format($loan->loan_amount,3)}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-5 form-control-label">ការប្រាក់ (%)</label>
                                <div class="col-sm-7">
                                    : {{$loan->loan_interest}}%
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-5 form-control-label">ការប្រាក់សរុប</label>
                                <div class="col-sm-7">
                                    : ${{number_format($loan->total_interest,3)}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-5 form-control-label">សរុប</label>
                                <div class="col-sm-7">
                                    : ${{number_format($loan->total_amount,3)}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-5 form-control-label">ប្រាក់បានបង់</label>
                                <div class="col-sm-7">
                                    : ${{number_format($loan->paid_amount,3)}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-5 form-control-label">ប្រាក់នៅខ្វះ</label>
                                <div class="col-sm-7">
                                    : ${{number_format($loan->due_amount,3)}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-5 form-control-label">រយៈពេល</label>
                                <div class="col-sm-7">
                                    : {{$loan->num_repayment . ' ('.$loan->repayment_type.')'}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-5 form-control-label">កំណត់ចំណាំ</label>
                                <div class="col-sm-7">
                                    : {{$loan->note}}
                                </div>
                            </div>
                        </div>
                    </div>
                  
                   <p>&nbsp;</p>
                    <div class="row">

                        <div class="col-sm-6">
                            
                            <h5 class="text-success">តារាងបង់ប្រាក់</h5>
                        </div>
                        
                    </div>
                    <div class="table-flip-scroll">

                        <table class="table table-striped table-sm table-bordered table-hover flip-content">
                            <thead class="flip-header">
                                <tr>
                                    <th>ល រ</th>
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
                            <tbody id="data">
								<?php
									$i = 1;
								?>
                                @foreach($loanschedules as $ls)
									<?php 
										$txt_class = '';
										if($ls->ispaid==1){
											$txt_class = 'text-success';
										}else if($ls->pay_date < date('Y-m-d') && $ls->ispaid == 0){
											$txt_class = 'text-danger';
										}
									?>
									<tr class="{{$txt_class}}">
										<td>{{$i++}}</td>
										<td>{{$ls->pay_date}}</td>
										<td>${{number_format($ls->principal_amount,3)}}</td>
										<td>${{number_format($ls->interest_amount,3)}}</td>
										<td>${{number_format($ls->total_amount,3)}}</td>
										<td>${{number_format($ls->paid_amount,3)}}</td>
										<td>${{number_format($ls->due_amount,3)}}</td>
										<td>{{$ls->paid_date}}</td>
										<td class="action">
											<?php
												if($ls->ispaid == 0){
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
                   
				   
					<p>&nbsp;</p>
                    <div class="row">

                        <div class="col-sm-6">
                            
                            <h5 class="text-success">ប្រាក់បានបង់</h5>
                        </div>
                        
                    </div>
                    <div class="table-flip-scroll">

                        <table class="table table-striped table-sm table-bordered table-hover flip-content">
                            <thead class="flip-header">
                                <tr>
                                    <th>ល រ</th>
                                    <th>ប្រាក់ទទួលបាន</th>
                                    <th>ថ្ងៃទទួលប្រាក់</th>
									<th>សកម្មភាព</th>
                                </tr>
                            </thead>
                            <tbody id="data">
								<?php
									$i = 1;
								?>
                                @foreach($loanpayments as $pm)
									<tr>
										<td>{{$i++}}</td>
										<td>${{number_format($pm->receive_amount,3)}}</td>
										<td>{{$pm->receive_date}}</td>
										<td>
											<a href="{{url('loan/delete_payment?id='.$pm->id)}}" class="btn btn-danger-outline btn-oval btn-sm mx-left" onclick="return confirm('អ្នកពិតជាចង់លុបទិន្នន័យ?')">
											<i class="fa fa-trash"></i> លុប
											</a>
										</td>
									</tr>
								@endforeach
                                
                            </tbody>
                        </table>

                    </div>
					
                </form>
				
                
            </div>
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