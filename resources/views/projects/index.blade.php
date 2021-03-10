@extends('layouts.master')
@section('header')
<strong>គម្រោង</strong>
@endsection
@section('content')
<div class="card card-gray">
    <div class="toolbox">
        <a href="{{url('project/create')}}"class="btn btn-primary btn-oval btn-sm">
            <i class="fa fa-plus-circle"></i> បង្កើត
        </a>

        
    </div>
    <div class="card-block">

        @component('coms.alert')
        @endcomponent
        <div class="table-flip-scroll">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-hover flip-content">
                    <thead class="flip-header">
                        <tr>
                            <th>#</th>
                            <th>លេខកូដ</th>
                            <th>ឈ្មោះ</th>
                            <th>អាស័យដ្ឋាន</th>
                            <th>ផ្សេងៗ</th>
							<th>សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody>			
                                                                        
                        <tr>
                            <td>1</td>
                            <td>
                                <a href="http://127.0.0.1:8000/loan/detail/4"><span class="text-teal"><strong>A0001</strong></span></a>   </td>
                            <td><a href="http://127.0.0.1:8000/loan/detail/4">Yu Dalin</a></td>
                            <td>ជាប់ផ្លូវជាតិលេខ51 ស្ថិតនៅភូមិលំហាចឃុំម្កាក់ស្រុកអង្គស្នួលខេត្តកណ្ដាល</td>
                            <td></td>
                            <td class="action">
								<a href="http://127.0.0.1:8000/customer/delete?id=1" title="Delete" class="text-danger" onclick="return confirm('អ្នកពិតជាចង់លុបទិន្នន័យ?')">
									<i class="fa fa-trash"></i>
								</a>&nbsp;
								<a href="http://127.0.0.1:8000/customer/edit/1" class="text-success" title="Edit">
									<i class="fa fa-edit"></i>
								</a>
							</td>
                        </tr>
                        <tr>
                            
                            <td>2</td>
                            <td>
                                <a href="http://127.0.0.1:8000/loan/detail/2"><span class="text-teal"><strong>A0002</strong></span></a>   </td>
                            <td><a href="http://127.0.0.1:8000/loan/detail/2">Sreyleak</a></td>
                            <td>ភូមិស្តុកអក ឃុំចាន់សែន ស្រុកឧដុង្គ ខេត្តកំពុងស្ពឺ</td>
                            <td></td>
                            <td class="action">
								<a href="http://127.0.0.1:8000/customer/delete?id=1" title="Delete" class="text-danger" onclick="return confirm('អ្នកពិតជាចង់លុបទិន្នន័យ?')">
									<i class="fa fa-trash"></i>
								</a>&nbsp;
								<a href="http://127.0.0.1:8000/customer/edit/1" class="text-success" title="Edit">
									<i class="fa fa-edit"></i>
								</a>
							</td>
                        </tr>
                   </tbody>
                </table>
            </div>
        </div>
       
          

    </div>
</div>
@endsection

@section('js')
<script>
	$(document).ready(function () {
		$("#sidebar-menu li").removeClass('active');
		$("#menu_project").addClass('active');
	})
</script>
@endsection