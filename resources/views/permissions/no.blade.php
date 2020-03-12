@extends('layouts.master')
@section('header')
    <strong>Warning</strong>
@endsection
@section('content')
    <div class="card card-gray">
        <div class="toolbox">
            <a href="{{url('role')}}" class="btn btn-warning btn-oval btn-sm"> 
                <i class="fa fa-reply"></i> Back</a>
        </div>
        
        <div class="card-block">
            <p></p>
           <h5 class="text-danger text-center">លោកអ្នកមិនមានសិទ្ធិមើលផ្នែកនេះទេ សូមទំនាក់ទំនងទៅកានអ្នកគ្រប់គ្រងកម្មវិធី!</h5>
           <p></p>
            
        </div>
    </div>
    
@endsection
@section('js')

   <script>
        $(document).ready(function () {
            $("#sidebar-menu li ").removeClass("active open");
			$("#sidebar-menu li ul li").removeClass("active");
			
            $("#menu_security").addClass("active open");
			$("#security_collapse").addClass("collapse in");
            $("#role_id").addClass("active");
			
        })
    </script>
@endsection