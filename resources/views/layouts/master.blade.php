
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
                                        1. Dashboard</a>
                                </li>
                                <li id="menu_invoice">
                                    <a href="{{url('invoice')}}">2. Invoices</a>
                                </li>
                                <li id="menu_customer">
                                    <a href="{{url('customer')}}">3. Customers</a>
                                </li>
                                <li id="menu_product">
                                    <a href="{{url('product')}}">4. Products</a>
                                </li>
                                <li id="menu_stockin">
                                    <a href="{{url('in')}}">5. Stock In</a>
                                </li>
                                <li id="menu_stockout">
                                    <a href="{{url('out')}}">6. Stock Out</a>
                                </li>
                                <li id="menu_report">
                                    <a href="">
                                        7. Reports <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav" id="report_collapse">
                                        <li id="menu_onhand_report">
                                            <a href="{{url('report/onhand')}}">
                                                7.1 Stock Balance
                                            </a>
                                        </li>
                                        <li id="menu_sale_report">
                                            <a href="{{url('report/sale')}}">
                                                7.2 Sale Detail
                                            </a>
                                        </li>
                                        <li id="menu_salesummary_report">
                                            <a href="{{url('report/sale/summary')}}">
                                                7.3 Sale Summary
                                            </a>
                                        </li>
                                        <li id="menu_salecustomer_report">
                                            <a href="{{url('report/customer')}}">
                                                7.4 Sale By Customer
                                            </a>
                                        </li>
                                        <li id="menu_stockin_report">
                                            <a href="{{url('report/in')}}">
                                                7.5 Stock In Detail
                                            </a>
                                        </li>
                                        <li id="menu_stockin_summary">
                                            <a href="{{url('report/in/summary')}}">
                                                7.6 Stock In Summary
                                            </a>
                                        </li>
                                        <li id="menu_stockout_report">
                                            <a href="{{url('report/out')}}">
                                                7.7 Stock Out Detail
                                            </a>
                                        </li>
                                        <li id="menu_stockout_summary">
                                            <a href="{{url('report/out/summary')}}">
                                                7.8 Stock Out Summary
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li id="menu_config">
                                    <a href="">
                                        8. Settings <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav" id="config_collapse">
                                        <li id="menu_category">
                                            <a href="{{route('category.index')}}">8.1 Category</a>
                                        </li>
                                        <li id="menu_unit">
                                            <a href="{{url('unit')}}">8.2 Unit</a>
                                        </li>
                                        <li id="menu_exchange">
                                            <a href="{{url('exchange')}}">8.3 Exchange</a>
                                        </li>
                                        <li id="menu_company">
                                            <a href="{{url('company')}}">
                                                8.4 Company
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li  id="menu_security">
                                    <a href="">
                                        9. Security <i class="fa arrow"></i>
									</a>
                                    <ul class="sidebar-nav"  id="security_collapse">
                                        <li id='menu_user'>
                                            <a href="{{url('user')}}">9.1 Users</a>
                                        </li>
                                        <li id="role_id">
                                            <a href="{{url('role')}}">9.2 Roles</a>
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