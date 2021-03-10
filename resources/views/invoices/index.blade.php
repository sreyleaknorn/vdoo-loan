@extends('layouts.master')
@section('header')
<strong>វិក័យប័ត្រ</strong>
@endsection
@section('content')
<div class="card card-gray">
    <div class="toolbox">
        <a href="{{url('land/create')}}"class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-plus-circle"></i> បង្កើត
		</a>
	</div>
	<div class="card-block">
		@component('coms.alert')
		@endcomponent
		<div class="table-flip-scroll">
			<div class="table-responsive">
				<div class="table-flip-scroll">

                    <table class="table table-striped table-sm table-bordered table-hover flip-content">
                        <thead class="flip-header">
                            <tr>
                                <th>#</th>
                                <th>លេខកូដ</th>
                                <th>ថ្ងៃខែឆ្នាំ</th>
                                <th>អតិថិជន</th>
                                <th>ចំនួនសរុប</th>
                                <th>ចំនួនបានបង់</th>
                                <th>ចំនួននៅខ្វះ</th>
                                <th>សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                                   
                        </tbody>
                    </table>
                    
                </div>
			</div>
		</div>
		<p>&nbsp;</p>
		
	</div>
</div>

@endsection

@section('js')
<script>
	$(document).ready(function () {
		$("#sidebar-menu li").removeClass('active');
		$("#menu_invoice").addClass('active');
	})
</script>
@endsection