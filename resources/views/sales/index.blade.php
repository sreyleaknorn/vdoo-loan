@extends('layouts.master')
@section('header')
<strong>អ្នកលក់</strong>
@endsection
@section('content')
<div class="card card-gray">
    <div class="toolbox">
        <a href="{{url('user/create')}}"class="btn btn-primary btn-oval btn-sm">
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
                                <th>ឈ្មោះ</th>
                                <th>ភេទ</th>
                                <th>លេខទូរស័ព្ទ</th>
                                <th>អ៊ីម៉ែល</th>
                                <th>សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                                                                                        <tr class="odd gradeX">
                                    <td>1</td>
                                    <td>Chheng Y</td>
                                    <td>ស្រី</td>
                                    <td>086956747</td>
                                    <td></td>
                                    <td>
                                        <a href="http://127.0.0.1:8000/user/edit/1" title="Edit" class="text-success"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                        <a href="http://127.0.0.1:8000/user/delete/1" title="Delete" onclick="return confirm('You want to delete?')" class="text-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                                            <tr class="odd gradeX">
                                    <td>2</td>
                                    <td>Account Account</td>
                                    <td>ប្រុស</td>
                                    <td></td>
                                    <td></td>
                                    
                                    <td>
                                        <a href="http://127.0.0.1:8000/user/edit/23" title="Edit" class="text-success"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                        <a href="http://127.0.0.1:8000/user/delete/23" title="Delete" onclick="return confirm('You want to delete?')" class="text-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
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
		$("#menu_sale").addClass('active');
	})
</script>
@endsection