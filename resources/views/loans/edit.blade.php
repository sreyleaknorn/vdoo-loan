@extends('layouts.master')
@section('header')
<strong>កែប្រែ រំលស់</strong>
@endsection
@section('content')
<form action="{{url('loan/update')}}" method="POST" enctype="multipart/form-data">
	<div class="card card-gray">
		<div class="toolbox">
			<button class="btn btn-primary btn-oval btn-sm">
				<i class="fa fa-save"></i> រក្សាទុក
			</button>
			<a href="javascript:history.back();" class="btn btn-primary-outline btn-oval btn-sm mx-left"> 
                    <i class="fa fa-reply"></i> ត្រលប់ក្រោយ</a> 
		</div>
		<div class="card-block">
			@component('coms.alert')
			@endcomponent
			<div class="row">
				
				<div class="col-sm-7">
					{{csrf_field()}}
					<input type="hidden" name="id" value="{{$loan->id}}" />
					<div class="form-group row">
						<label class="col-sm-3" >អតិថិជន <span class="text-danger">*</span></label>
						<div class="col-sm-6">
							<select name="customer_id" id="customer_id" class="form-control chosen-select">
								
								@foreach($customers as $customer)
                                <option value="{{$customer->id}}" {{$loan->customer_id==$customer->id?'selected':''}}>{{$customer->name}} - {{$customer->phone}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-2 pleft-0">
							<button class="btn btn-primary btn-plus" type="button"  data-toggle="modal" data-target="#ModalAddCustomer">
								<i class="fa fa-plus-circle"></i>
							</button>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3" >ហាងទូរស័ព្ទ <span class="text-danger">*</span></label>
						<div class="col-sm-6">
							<select name="shop_id" id="shop_id" class="form-control chosen-select">
								<option value="">-- ជ្រើសរើស --</option>
								@foreach($phone_shops as $ps)
                                <option value="{{$ps->id}}" {{$loan->shop_id==$ps->id?'selected':''}}>{{$ps->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-2 pleft-0">
							<button class="btn btn-primary btn-plus" type="button"  data-toggle="modal" data-target="#ModalAddShop">
								<i class="fa fa-plus-circle"></i>
							</button>
						</div>
					</div>
					<div class="form-group row">
						<label for="model_name" class="col-sm-3">ឈ្មោះទូរស័ព្ទ </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="model_name" name="model_name" 
                            value="{{$loan->model_name}}">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="serial" class="col-sm-3">លេខ​សម្គាល់ </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="serial" name="serial" 
                            value="{{$loan->serial}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="bill_no" class="col-sm-3">លេខបុង </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="bill_no" name="bill_no" 
                            value="{{$loan->bill_no}}">
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-3" >រំលស់ចំនួន ($)<span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control inputnumber"  min="0"  name="loan_amount" placeholder="" value="{{$loan->loan_amount}}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3" >ការប្រាក់ (%)<span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control inputnumber" id="loan_interest" min="0" max="100" name="loan_interest"
							  value="{{$loan->loan_interest}}" required>
						</div>
					</div>
					
					<div class="form-group row">
                        <label class="col-sm-3">ចំនួនរយៈពេល  <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control inputnumber"  min="1"   name="num_repayment" value="{{$loan->num_repayment}}" required>
						</div>
                        <div class="col-sm-3">
                            <select name="repayment_type" id="repayment_type" class="form-control form-control-select2" data-fouc>
                                <option value="Day" {{$loan->repayment_type=='Day'?'selected':''}}>Day</option>
                                <option value="Week" {{$loan->repayment_type=='Week'?'selected':''}}>Week</option>
                                <option value="Month" {{$loan->repayment_type=='Month'?'selected':''}}>Month</option>
                                <option value="Year" {{$loan->repayment_type=='Year'?'selected':''}}>Year</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
                        <label class="col-sm-3">ថ្ងៃខ្ចី <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="date" name='loan_date' id="loan_date" 
							class='form-control' value="{{$loan->loan_date}}" required>
						</div>
					</div>
					
					<div class="form-group row">
                        <label class="col-sm-3">ចាប់ផ្ដើមការប្រាក់ <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="date" name='start_interest_date' id="start_interest_date" 
							class='form-control' value="{{$loan->start_interest_date}}" required>
						</div>
					</div>
					
                    <div class="form-group row">
                        <label for="note" class="col-sm-3 form-control-label">កំណត់ចំណាំ</label>
                        <div class="col-sm-8">
                            <textarea name="note" id="note" cols="30" rows="1" class="form-control">{{$loan->note}}</textarea>
						</div>
					</div>
					
				</div>
				
				
			</div>
		</div>
	</div>
</form>


<!--- modal add customer -->
<div class="modal fade" id="ModalAddCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">បង្កើតអតិថិជន</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="customer_form">
					{{csrf_field()}}
					<div class="form-group row">
						<label for="name" class="col-sm-3">ឈ្មោះ<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="name" name="name" 
                            value="{{old('name')}}" autofocus required>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="phone" class="col-sm-3">លេខទូរស័ព្ទ </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="phone" name="phone" 
                            value="{{old('phone')}}">
						</div>
					</div>
					
				</form>
			</div>
			
			<div class="modal-footer">
                <div style='padding: 5px'>
                    <button type="submit" class="btn btn-primary" id="add_customer">រក្សាទុក</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="btnclose_modal">ចាកចេញ</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!---.../ modal add customer -->

<!--- modal add shop -->
<div class="modal fade" id="ModalAddShop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">បង្កើតហាងទូរស័ព្ទ</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="shop_form">
					{{csrf_field()}}
					<div class="form-group row">
						<label for="name" class="col-sm-3">ឈ្មោះ<span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="name" name="name" 
								value="{{old('name')}}" autofocus required>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="phone" class="col-sm-3">លេខទូរស័ព្ទ </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="phone" name="phone" 
								value="{{old('phone')}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="address" class="col-sm-3">អាសយដ្ឋាន </label>
						<div class="col-sm-9">
							<textarea class="form-control" id="address" name="address">{{old('address')}}</textarea>
						</div>
					</div>
					
				</form>
			</div>
			
			<div class="modal-footer">
                <div style='padding: 5px'>
                    <button type="submit" class="btn btn-primary" id="add_shop">រក្សាទុក</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="btnclose_modal_shop">ចាកចេញ</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!---.../ modal add shop -->

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
	
	/* add customer */
	/// add customers chosen-select
    $("#add_customer").click(function(event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();

        $.ajax({
            type: "post",
            url: "{{ url('customer/add_customer') }}",
            data: $('#customer_form').serialize(),
            success: function(result){
               $("#customer_id").append(result).trigger("chosen:updated");
               $("#btnclose_modal").click();
            },
            error: function(result){
                alert("Error" + result)
            }
        });
        
    });
	
	/* add shop */
    $("#add_shop").click(function(event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();

        $.ajax({
            type: "post",
            url: "{{ url('phoneshop/add_shop') }}",
            data: $('#shop_form').serialize(),
            success: function(result){
               $("#shop_id").append(result).trigger("chosen:updated");
               $("#btnclose_modal_shop").click();
            },
            error: function(result){
                alert("Error" + result)
            }
        });
        
    });
	
</script>
@endsection