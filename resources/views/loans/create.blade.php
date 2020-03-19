@extends('layouts.master')
@section('header')
<strong>បង្កើត រំលស់</strong>
@endsection
@section('content')
<form action="{{url('loan/save')}}" method="POST" enctype="multipart/form-data">
	<div class="card card-gray">
		<div class="toolbox">
			<button class="btn btn-primary btn-oval btn-sm">
				<i class="fa fa-save"></i> រក្សាទុក
			</button>
			<a href="{{url('loan')}}" class="btn btn-warning btn-oval btn-sm">
				<i class="fa fa-reply"></i> ត្រលប់ក្រោយ
			</a>
		</div>
		<div class="card-block">
			@component('coms.alert')
			@endcomponent
			<div class="row">
				
				<div class="col-sm-7">
					
					{{csrf_field()}}
					<div class="form-group row">
						<label class="col-sm-3" >អតិថិជន <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select name="customer_id" id="customer_id" class="form-control chosen-select">
								<option value="">-- ជ្រើសរើស --</option>
								@foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-3" >ហាងទូរស័ព្ទ <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select name="shop_id" id="shop_id" class="form-control chosen-select">
								<option value="">-- ជ្រើសរើស --</option>
								@foreach($phone_shops as $ps)
                                <option value="{{$ps->id}}">{{$ps->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="model_name" class="col-sm-3">ទូរស័ព្ទ </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="model_name" name="model_name" 
                            value="{{old('model_name')}}">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="serial" class="col-sm-3">លេខ​សម្គាល់ </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="serial" name="serial" 
                            value="{{old('serial')}}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3" >រំលស់ចំនួន ($)<span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control inputnumber"  min="0"  name="loan_amount" placeholder="" value="{{old('loan_amount')}}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3" >ការប្រាក់ (%)<span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control inputnumber" id="loan_interest" min="0" max="100" name="loan_interest"  value="{{old('loan_interest')}}" required>
						</div>
					</div>
					
					<div class="form-group row">
                        <label class="col-sm-3">ចំនួនរយៈពេល  </label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control inputnumber"  min="0"  name="num_repayment" value="{{old('num_repayment')}}" required>
						</div>
                        <div class="col-sm-3">
                            <select name="repayment_type" id="repayment_type" class="form-control form-control-select2" data-fouc>
                                <option value="Day">Day</option>
                                <option value="Week" >Week</option>
                                <option value="Month" selected>Month</option>
                                <option value="Year">Year</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
                        <label class="col-sm-3">ថ្ងៃខ្ចី *</label>
                        <div class="col-sm-8">
                            <input type="date" name='loan_date' id="loan_date" 
							class='form-control' value="{{date('Y-m-d')}}" required>
						</div>
					</div>
					<div class="form-group row">
                        <label class="col-sm-3">ថ្ងៃបញ្ចេញប្រាក់ *</label>
                        <div class="col-sm-8">
                            <input type="date" name='release_date' id="release_date" 
							class='form-control' value="{{date('Y-m-d')}}" required>
						</div>
					</div>
					<div class="form-group row">
                        <label class="col-sm-3">ចាប់ផ្ដើមការប្រាក់ *</label>
                        <div class="col-sm-8">
                            <input type="date" name='start_interest_date' id="start_interest_date" 
							class='form-control' value="{{date('Y-m-d')}}" required>
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