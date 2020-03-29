
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Vdoo Sale | Vdoo ERP</title>
        <meta name="description" content="Vdoo ERP Software Solutions">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/vendor.css')}}">
        <link rel="stylesheet" href="{{asset('css/app-green.css')}}">
        <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}" >
        <link rel="stylesheet" href="{{asset('css/custom.css')}}" >
        <link rel="stylesheet" href="{{asset('css/component-chosen.css')}}" >
		<link href="https://fonts.googleapis.com/css?family=Battambang&display=swap" rel="stylesheet">
		
		<style>

                body {
               font-family: Battambang , Arial, Helvetica, sans-serif;
            }
              
			.table tr {
			white-space: nowrap;
			}
		</style>
        @yield('css')
    </head>
    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse d-lg-none d-xl-none">
                        <button class="collapse-btn" id="sidebar-collapse-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                        
                    </div>
                    <div class="header-block header-block-search">
                        @yield('header')
                    </div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('{{asset(Auth::user()->photo)}}')">
                                    </div>
                                    <span class="name">{{Auth::user()->username}}</span>
                                </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="{{url('user/profile')}}">
                                        <i class="fa fa-user icon"></i> Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{url('logout')}}">
                                        <i class="fa fa-power-off icon"></i> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <a href="{{url('/')}}">
                                    <img src="{{asset('images/logo.png')}}" alt="">
                                    Vdoo
                                </a>
                            </div>
                        </div>
                        <nav class="menu">
                            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                                <li id='menu_dashboard'>
                                    <a href="{{url('/')}}">
                                        ​១. ទំព័រដើម </a>
                                </li>
                                <li id='menu_customer'>
                                    <a href="{{url('/customer')}}">
                                        ​២. អតិថិជន </a>
                                </li>
								<li id='menu_phone_shop'>
                                    <a href="{{url('/phoneshop')}}">
                                        ​៣.  ហាងទូរស័ព្ទ</a>
                                </li>
								
								<li id="menu_loan">
                                    <a href=""> ៤. រំលស់ <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav" id="loan_collapse">
                                        
                                        <li id="menu_all_loan">
                                            <a href="{{url('/loan')}}">
													៤.១. រំលស់
                                            </a>
                                        </li>
										<li id="menu_all_loanschedule">
                                            <a href="{{url('/loanschedule')}}">
													៤.២. តារាងប្រាក់ត្រូវបង់
                                            </a>
                                        </li>
										<li id="menu_all_loanpayment">
                                            <a href="{{url('/loanpayment')}}">
													៤.៣. តារាងប្រាក់បានបង់
                                            </a>
                                        </li>
										<li id="menu_all_paytoday">
                                            <a href="{{url('loanschedule/today')}}">
													៤.៤. តារាងត្រូវបង់ថ្ងៃនេះ
                                            </a>
                                        </li>
										<li id="menu_schedule_late">
                                            <a href="{{url('loanschedule/late')}}">
													៤.៥. តារាងហួសថ្ងៃបង់
                                            </a>
                                        </li>
										<li id="menu_loan_stop">
                                            <a href="{{url('loan/stopped')}}">
													៤.៦.​ រំលស់ឈប់បង់ 
                                            </a>
                                        </li>
                                    </ul>
                                </li>
								<li id="menu_config">
                                    <a href="">
                                        ​៥. ​កំណត់ <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav" id="config_collapse">
                                        
                                        <li id="menu_company">
                                            <a href="{{url('company')}}">
                                                ​៥.១ ក្រុមហ៊ុន
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li  id="menu_security">
                                    <a href="">
                                        ​៦. ​កំណត់សុវត្ថិភាព  <i class="fa arrow"></i>
									</a>
                                    <ul class="sidebar-nav"  id="security_collapse">
                                        <li id='menu_user'>
                                            <a href="{{url('user')}}">៦.១ អ្នកប្រើប្រាស់</a>
                                        </li>
                                        <li id="role_id">
                                            <a href="{{url('role')}}">៦.២ សិទ្ធប្រើប្រាស់</a>
										</li>
										
									</ul>
                                </li>
                                <li  id="menu_report">
                                    <a href="">
                                        ​៧. របាយការណ៍  <i class="fa arrow"></i>
									</a>
                                    <ul class="sidebar-nav"  id="report_collapse">
                                        <li id='menu_report1'>
                                            <a href="#">៧.១ របាយការណ៍បង់ប្រាក់</a>
                                        </li>
                                        
									</ul>
								</li>
                            </ul>
                        </nav>
                    </div>
                    <footer class="sidebar-footer">
                        <ul class="sidebar-menu metismenu" id="customize-menu">
                            <li>
                                <a href="#">
                                    Copy&copy; {{date('Y')}} 
                                </a>
                            </li>
                        </ul>
                    </footer>
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
                <div class="mobile-menu-handle"></div>
                <article class="content dashboard-page">
                    <section class="section">
                        @yield('content')
                    </section>
                   
                </article>
                <footer class="footer">
                    
                    <div class="footer-block author">
                        <ul>
                            <li> Powered by <a href="http://vdooerp.com" target="_blank">Vdoo Freelance Team</a>
                            </li>
                            
                        </ul>
                    </div>
                </footer>
               
            </div>
        </div>
               <!-- Reference block for JS -->
               <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script>
            var burl = "{{url('/')}}";
           
        </script>
        <script src="{{asset('js/vendor.js')}}"></script>
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('js/chosen.jquery.js')}}"></script>
		<script src="{{asset('js/chosen.init.js')}}"></script>
        @yield('js')
    </body>
</html>