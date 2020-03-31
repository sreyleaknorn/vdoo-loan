@extends('layouts.master')
@section('header')
<strong>បង់ប្រាក់</strong>
@endsection
@section('content')
<form action="{{url('loan/save_payment')}}" method="POST" id="paymentForm" enctype="multipart/form-data">
	<div class="card card-gray">
		<div class="toolbox">
			<button class="btn btn-primary btn-oval btn-sm">
				<i class="fa fa-save"></i> រក្សាទុក
			</button>
			<a href="javascript:history.back();" class="btn btn-warning btn-oval btn-sm">
				<i class="fa fa-reply"></i> ត្រលប់ក្រោយ
			</a>
			<a href="{{url('loan/pay/'.$schedules->id.'?payment=all&loan_id='.$schedules->loan_id)}}" class="btn btn-success btn-oval btn-sm">
				<i class="fa fa-dollar"></i> បង់ទាំងអស់ 
			</a>
		</div>
		<div class="card-block">
			@component('coms.alert')
			@endcomponent
			<div class="row">
				
				<div class="col-sm-7">
					
					{{csrf_field()}}
					<input type="hidden" name="customer_id" value="{{$schedules->customer_id}}" />
                    <input type="hidden" name="loan_id" value="{{$schedules->loan_id}}" />
                    <input type="hidden" name="loanschedule_id" value="{{$schedules->id}}" />
                    <input type="hidden" name="paid_amount" value="{{$schedules->paid_amount}}" />
					<?php 
						$due_amount = 0;
						
						if(isset($_GET['payment']) && isset($_GET['loan_id'])){
							
							?>
							<div class="form-group row">
								<div class="col-sm-12">
									<div class="alert alert-warning">
									រំលស់នេះនឹងត្រូវបានបញ្ចប់!
									</div>
								</div>
							</div>
							<?php
							foreach($loanschedules as $ls){
								$due_amount += $ls->due_amount;
							}
							
							}else {
							
							$due_amount = $schedules->due_amount;
							
						}
					?>
					
					<div class="form-group row">
						<label class="col-sm-3">ថ្ងៃបង់ប្រាក់*</label>
						<div class="col-sm-8">
							<input type="date" name='receive_date' id="receive_date" 
							class='form-control' value="{{date('Y-m-d')}}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3" >ចំនួនត្រូវបង់<span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control inputnumber"   name="due_amount" id="due_amount"  value="{{$due_amount}}" readonly>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-3" >ចំនួនទទួលបាន<span class="text-danger">*</span></label>
						<div class="col-sm-8">
							
							<input type="text" class="form-control inputnumber"   name="receive_amount" id="receive_amount"  value="{{$due_amount}}" required >
						</div>
					</div>
					
					<div class="form-group row">
						<label for="note" class="col-sm-3 form-control-label">កំណត់ចំណាំ</label>
						<div class="col-sm-8">
							<textarea name="note" id="note" cols="30" rows="1" class="form-control"></textarea>
						</div>
					</div>
					
					<?php 
						
						
						if(isset($_GET['payment']) && isset($_GET['loan_id'])){
							
						?>
						<!-- <div class="form-group row">
							<label for="note" class="col-sm-3 form-control-label">&nbsp;</label>
							<div class="col-sm-8">
								<div>
									<label>
										<input class="radio" name="ispaid" type="radio" value="1" checked>
										<span>បង់បញ្ចប់</span>
									</label>
									<label>
										<input class="radio" name="ispaid" type="radio" value="0" >
										<span>កែតារាងថ្មី</span>
									</label>
									
								</div>
							</div>
						</div>
						<div class="form-group row " id="change_schedule" style="display:none;">
							<label for="note" class="col-sm-3 form-control-label">ប្រាក់ដើមនៅខ្វះ</label>
							<div class="col-sm-8">
								<input class="form-control inputnumber"  name="new_pr_amount" id="new_pr_amount" >
							</div>
						</div> -->
						
						<br/><p><strong> ចំនួនដែលនៅខ្វះទាំងអស់</strong></p>
						<table class="table table-sm">
							<thead>
								<tr>
									<th>លេខ.</th>
									<th>ថ្ងៃត្រូវបង់</th>
									<th>ប្រាក់ដើម</th>
									<th>ការប្រាក់</th>
									<th>ចំនួននៅខ្វះ</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="data">
								<?php 
									$i = 1;
									echo '<input type="hidden" name="all_payment" value="1" />';	
									foreach($loanschedules as $ls){
										
									?>
									<tr>
										<td>
											{{$i++}} 
											<input type="hidden" name="all_due_amount[]" value="{{$ls->due_amount}}" />
											<input type="hidden" name="all_paid_amount[]" value="{{$ls->paid_amount}}" />
											<input type="hidden" name="sch_id[]" value="{{$ls->id}}" />
										</td>
										<td>{{$ls->pay_date}}</td>
										<td>{{$ls->principal_amount}}</td>
										<td>{{$ls->interest_amount}}</td>
										<td>{{$ls->due_amount}}</td>
										<!-- <td><button class='btn btn-danger btn-sm' type='button' onclick='deleteItem(this)'>ដកចេញ</button></td> -->
									</tr>
									<?php
									}
									echo '</tbody></table>';
									
									}else {
									
									echo '<input type="hidden" name="all_payment" value="0" />';
								}
							?>
							
						</div>
						
						
					</div>
				</div>
			</div>
		</form>
		
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
			
			
			
			$('.inputnumber').keypress(function(event) {
				if (event.which != 46 && (event.which < 47 || event.which > 59))
				{
					event.preventDefault();
					if ((event.which == 46) && ($(this).indexOf('.') != -1)) {
						event.preventDefault();
					}
				}
			});
			
			
			// find total
			function getTotal()
			{
				let trs = $("#data tr");
				let total = 0;
				for(let i=0; i<trs.length;i++)
				{
					let tds = $(trs[i]).children("td");
					total += Number($(tds[2]).html());
					
				}
				
				$("#due_amount").val(total);
				$("#receive_amount").val(total);
			}
			
			// function to remove an item
			function deleteItem(obj)
			{
				let con = confirm("តើអ្នកពិតជាចង់លុបមែនទេ?");
				if(con)
				{
					$(obj).parent().parent().remove();
					getTotal();
				}
			}
			$("#paymentForm").on('submit', (function (e) {
				
				var all_payment = $(":input[name='all_payment']").val();
				//e.preventDefault();
				var receive_amount = parseFloat($("#receive_amount").val());
				var due_amount = parseFloat($("#due_amount").val());
				if(receive_amount > due_amount ){
					alert('ចំនួនទទួលបានត្រូវតែតូចជាង ឫស្មើរចំនួនត្រូវបង់!');
					return false;
					}else {
					return true;
				}
			}));
			
			/*
			$('input[type=radio][name=ispaid]').change(function() {
				if (this.value == 1) {
					$("#change_schedule").hide();
				}
				else {
					$("#change_schedule").show();
				}
			}); */
			
		</script>
	@endsection		