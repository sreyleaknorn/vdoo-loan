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
                                <label for="customer_id" class="col-sm-4 form-control-label">ឈ្មោះអតិថិជន </label>
                                <div class="col-sm-8">
                                    : {{$loan->name}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="customer_id" class="col-sm-4 form-control-label">លេខទូរស័ព្ទ </label>
                                <div class="col-sm-8">
                                    : {{$loan->phone}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="customer_id" class="col-sm-4 form-control-label">ហាងទូរស័ព្ទ </label>
                                <div class="col-sm-8">
                                    : {{$loan->shop_name}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="invoice_date" class="col-sm-4 form-control-label">ថ្ងៃខ្ចី</label>
                                <div class="col-sm-8">
                                    : {{$loan->loan_date}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="invoice_date" class="col-sm-4 form-control-label">ថ្ងៃបញ្ចេញប្រាក់</label>
                                <div class="col-sm-8">
                                    : {{$loan->release_date}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="invoice_date" class="col-sm-4 form-control-label">ថ្ងៃចាប់ផ្ដើមការប្រាក់</label>
                                <div class="col-sm-8">
                                    : {{$loan->start_interest_date}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            
                            <div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">ចំនួនខ្ចី</label>
                                <div class="col-sm-8">
                                    : ${{number_format($loan->loan_amount,3)}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">ការប្រាក់ (%)</label>
                                <div class="col-sm-8">
                                    : {{$loan->loan_interest}}%
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">ការប្រាក់សរុប</label>
                                <div class="col-sm-8">
                                    : ${{number_format($loan->total_interest,3)}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">សរុប</label>
                                <div class="col-sm-8">
                                    : ${{number_format($loan->total_amount,3)}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">ប្រាក់បានបង់</label>
                                <div class="col-sm-8">
                                    : ${{number_format($loan->paid_amount,3)}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">ប្រាក់នៅខ្វះ</label>
                                <div class="col-sm-8">
                                    : ${{number_format($loan->due_amount,3)}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-4 form-control-label">រយៈពេល</label>
                                <div class="col-sm-8">
                                    : {{$loan->num_repayment . ' ('.$loan->repayment_type.')'}}
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
                                    <th>ថ្ងៃបង់ប្រាក់</th>
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
									<tr class="{{$ls->ispaid==1?'text-success':''}}">
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
                   
                </form>
				
                
            </div>
        </div>
    </div>
  
<!-- modal for add payment -->
<div class="modal fade" id="modalPayment" tabindex="-1" role="dialog" aria-labelledby="modalPayment" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="{{url('payment/save')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="customer_id" value="">
        <input type="hidden" name="invoice_id" value="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPayment">បង់ប្រាក់</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="pay_date" class="col-sm-3">ថ្ងៃខែ<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" required name="pay_date" id="pay_date" value="{{date('Y-m-d')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-3">ទឹកប្រាក់($) <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" step="0.1" min="0" class="form-control" name="amount" id="amount" required>
                    </div>
                </div>
              
            </div>
            <div class="modal-footer">
                <div style='padding: 5px'>
                    <button type="submit" class="btn btn-primary" >រក្សាទុក</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ចាកចេញ</button>
                </div>
            </div>
        </div>
    </form>
  </div>
</div>                      
@endsection

@section('js')

	<script>
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_loan").addClass("active open");
			$("#config_collapse").addClass("collapse in");
            $("#menu_all_loan").addClass("active");
        });
	
    </script>
@endsection