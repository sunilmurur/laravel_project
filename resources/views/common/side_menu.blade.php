<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <div class="">
                  

                  <!--  <div class="main-menu-content">
                        <ul>
                            <li class="more-details">
                                <a href="#"><i class="ti-user"></i>View Profile</a>
                                <a href="#!"><i class="ti-settings"></i>Settings</a>
                                <a href="auth-normal-sign-in.html"><i class="ti-layout-sidebar-left"></i>Logout</a>
                            </li>
                        </ul>
                    </div>-->
                </div>
               <!-- <div class="pcoded-search">
                    <span class="searchbar-toggle">  </span>
                    <div class="pcoded-search-box ">
                        <input type="text" placeholder="Search">
                        <span class="search-icon"><i class="ti-search" aria-hidden="true"></i></span>
                    </div>
                </div> -->
                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">DashBoard & Master</div>
                <ul class="pcoded-item pcoded-left-item">
                  <!--  <li class="active">
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li> -->
                      <!--Master Menu -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Master</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{ route('Category.index') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Category</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{ route('Subcategory.index') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Sub Category</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{ route('Pooja.index') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Pooja</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>

                            <li class=" ">
                                <a href="{{ route('Customer.index') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Customer</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>


                            <li class=" ">
                                <a href="{{ route('Valaya.index') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Valaya</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                           
                        </ul>
                    </li>
                      <!--Purchase Menu -->
                     <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Purchase</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{ route('Purchasecategory.index') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Purchase Category</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{ route('Purchasesubcategory.index') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Purchase Sub Category</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{ route('Purchase.create') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Add Purchase</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{ route('Purchase.index') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Purchase Report</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>                           
                        </ul>
                    </li>
                    <!--Sales Menu -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Sales</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{ route('Sales.create') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Add Used(A/K/O)</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li> 
                            <li class=" ">
                                <a href="{{ route('Sales.index') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Used(A/K/O)</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>                            
                        </ul>
                    </li>
                       <!--Donation Menu -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Donation</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{ route('Donation.index') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">View Donation</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li> 
                            <li class=" ">
                                <a href="{{ route('Donation.create') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Add Donation</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>                            
                        </ul>
                    </li>

                        <!--Reports Menu -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Reports</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{ route('Reports.ca_sales_report') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Jama Report</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li> 
                            <li class=" ">
                                <a href="{{ route('Reports.ca_purchase_report') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Karchu Report</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li> 
                            <li class=" ">
                                <a href="{{ route('Reports.ca_ako_jama_report') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">CA AKO Jama Report</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>   
                            <li class=" ">
                                <a href="{{ route('Reports.ca_ako_karchu_report') }}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">CA AKO Karchu Report</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>                          
                        </ul>
                    </li>
                  <!--Seva Pooja -->   
                </ul>
                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Seav Pooja</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="{{ route('Sevapooja.index') }}">
                            <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Seva Pooja</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                    <!--Seva Pooja  Report-->
                        <a href="{{ route('Sevapooja.seva_pooja_report') }}">
                            <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Seva Pooja Report</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>

               <!-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Chart &amp; Maps</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="chart.html">
                            <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Chart</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="map-google.html">
                            <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Maps</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Pages</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="auth-normal-sign-in.html">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Login</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="auth-sign-up.html">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Register</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="sample-page.html">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Sample Page</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>

                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other">Other</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu ">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-direction-alt"></i><b>M</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Menu Levels</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Menu Level 2.1</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="pcoded-hasmenu ">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">Menu Level 2.2</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Menu Level 3.1</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Menu Level 2.3</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>-->
        </nav>