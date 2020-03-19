@extends('layouts.master')
@section('header')
<strong>បង់ប្រាក់</strong>
@endsection
@section('content')
<form action="{{url('loan/save_payment')}}" method="POST" enctype="multipart/form-data">
	<div class="card card-gray">
		<div class="toolbox">
			<button class="btn btn-primary btn-oval btn-sm">
				<i class="fa fa-save"></i> រក្សាទុក
			</button>
			<a href="javascript:history.back();" class="btn btn-warning btn-oval btn-sm">
				<i class="fa fa-reply"></i> ត្រលប់ក្រោយ
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
							<input type="text" class="form-control inputnumber"   name="due_amount" id="due_amount"  value="{{$schedules->due_amount}}" readonly>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-3" >ចំនួនទទួលបាន<span class="text-danger">*</span></label>
						<div class="col-sm-8">
							
							<input type="text" class="form-control inputnumber"   name="receive_amount" id="receive_amount"  value="{{$schedules->due_amount}}" required>
						</div>
					</div>
					
                    <div class="form-group row">
                        <label for="note" class="col-sm-3 form-control-label">កំណត់ចំណាំ</label>
                        <div class="col-sm-8">
                            <textarea name="note" id="note" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
                
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
			$("#config_collapse").addClass("collapse in");
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
	
</script>
@endsection