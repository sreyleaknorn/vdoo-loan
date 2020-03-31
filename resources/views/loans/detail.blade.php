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
                    <a href="{{url('loan/print/'.$loan->id)}}" target="_blank" class="btn btn-success-outline btn-oval btn-sm mx-left">
                        <i class="fa fa-print"></i> បោះពុម្ព
                    </a>
					<?php 
						if($loan->status == 'new' || $loan->status == 'paying'){
					?>
					<a href="{{url('loan/stopped?id='.$loan->id)}}" class="btn btn-warning-outline btn-oval btn-sm mx-left" type="button"  data-toggle="modal" data-target="#stopPayment" >
                        <i class="fa fa-times-circle"></i>​ ឈប់បង់
                    </a>
						<?php } ?>
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
                                <label for="invoice_date" class="col-sm-5 form-control-label">ថ្ងៃចាប់ផ្ដើមការប្រាក់</label>
                                <div class="col-sm-7">
                                    : {{$loan->start_interest_date}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-5 form-control-label">កំណត់ចំណាំ</label>
                                <div class="col-sm-7">
                                    : {{$loan->note}}
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
                                <label for="due_date" class="col-sm-5 form-control-label">ថ្ងៃបង់បញ្ចប់</label>
                                <div class="col-sm-7">
                                    : {{$loan->paid_date}}
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="due_date" class="col-sm-5 form-control-label">ស្ថានភាព</label>
                                <div class="col-sm-7">
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
                                    : <span class="badge {{$color}}">{{$status}}</span>
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
                            <tbody >
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
					
					@if(count($loanpayments) < 1)
						<div class="alert alert-warning">
						   មិនទាន់មានការបង់ប្រាក់ទេ។
						</div>

					@endif
					@if(count($loanpayments) > 0)
                    <div class="table-flip-scroll">

                        <table class="table table-striped table-sm table-bordered table-hover flip-content">
                            <thead class="flip-header">
                                <tr>
                                    <th>ល រ</th>
                                    <th>ប្រាក់ទទួលបាន</th>
                                    <th>ថ្ងៃទទួលប្រាក់</th>
                                    <th>កំណត់ចំណាំ</th>
									<th>សកម្មភាព</th>
                                </tr>
                            </thead>
                            <tbody >
								<?php
									$i = 1;
								?>
                                @foreach($loanpayments as $pm)
									<tr>
										<td>{{$i++}}</td>
										<td>${{number_format($pm->receive_amount,3)}}</td>
										<td>{{$pm->receive_date}}</td>
										<td>{{$pm->note}}</td>
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
					@endif
					
					@if(count($stop_payments) > 0)
					<p>&nbsp;</p>
                    <div class="row">

                        <div class="col-sm-6">
                            
                            <h5 class="text-danger">ឈប់បង់ប្រាក់</h5>
                        </div>
                        
                    </div>
                    <div class="table-flip-scroll">

                        <table class="table table-striped table-sm table-bordered table-hover flip-content">
                            
                            <tbody >
								<?php
									$i = 1;
								?>
                                @foreach($stop_payments as $spm)
									<tr>
										<td><strong>ថ្ងៃឈប់</strong></td>
										<td>{{$spm->stop_date}}</td>
									</tr>
									<tr>
										<td><strong>មូលហេតុ</strong></td>
										<td>{{$spm->reason}}</td>
									</tr>
								@endforeach
                                
                            </tbody>
                        </table>

                    </div>
					@endif
            </div>
        </div>
    </div>
	
	
	<!--- modal add shop -->
<div class="modal fade" id="stopPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{url('loan/save_stopped')}}" method="POST" enctype="multipart/form-data">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ឈប់បង់ប្រាក់</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
					{{csrf_field()}}
					<input type="hidden" name="loan_id" value="{{$loan->id}}"/>
					<div class="form-group row">
						<label for="stop_date" class="col-sm-3">ថ្ងៃឈប់<span class="text-danger">*</span> </label>
						<div class="col-sm-9">
							<input type="date" name='stop_date' id="stop_date" 
							class='form-control' value="{{date('Y-m-d')}}" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="reason" class="col-sm-3">មូលហេតុ </label>
						<div class="col-sm-9">
							<textarea class="form-control" id="reason" name="reason">{{old('reason')}}</textarea>
						</div>
					</div>
					
				
			</div>
			
			<div class="modal-footer">
                <div style='padding: 5px'>
                    <button type="submit" class="btn btn-primary" id="add_shop">រក្សាទុក</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="btnclose_modal_shop">ចាកចេញ</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<!---.../ modal stopPayment -->
                  
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