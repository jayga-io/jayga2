<div class="header">
    <div class="header-left">
        <a href="{{route('adminhome')}}" class="logo"> <img src="{{asset('assets/img/logo/Jayga Logo-02.png')}}" width="50"
                height="70" alt="logo"> <span class="logoclass">Jayga Admin</span> </a>
        <a href="index.php" class="logo logo-small"> <img src="assets/img/hotel_logo.png" alt="Logo" width="30"
                height="30"> </a>
    </div>
    <a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
    <a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
    <ul class="nav user-menu">
        <li class="nav-item dropdown noti-dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <i class="fe fe-bell"></i> <span
                    class="badge badge-pill"></span> </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header"> <span class="notification-title">Notifications</span> </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="{{ route('pendinglisting') }}">
                                <div class="media">
                                    <div class="media-body">


                                        <p class="noti-details">No new listing found</p>



                                    </div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="topnav-dropdown-footer"> <a href="#"></a> </div>
            </div>
        </li>
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span class="user-img"><img
                        class="rounded-circle" src="assets/img/logo/jayga-appicon1.png" width="31" alt=""></span> </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <!-- <div class="avatar avatar-sm"> <img src="assets/img/logo/jayga_app_small.png" alt="User Image" class="avatar-img rounded-circle"> </div> -->
                    <div class="user-text">

                        <h6>Welcome, ADMIN ({{ Session::get('admin')}})</h6>
                        <p class="text-muted mb-0">Administrator</p>
                    </div>
                </div>
                <a class="dropdown-item" href="profile.php">My Profile</a>
                <a class="dropdown-item" href="settings.php">Account Settings</a>
                <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
            </div>
        </li>
    </ul>
    <div class="top-nav-search">
        <form>
            <input type="text" class="form-control" placeholder="Search here">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li> <a href="/admin"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>

                <li class="list-divider"></li>
                <li >
                    @if (DB::table('listings')->where('isApproved', false)->where('isActive', true)->count() > 0)
                        <a href="{{ route('pendinglisting') }}">Pending Listings
                            <span class="badge badge-pill badge-danger">
                                <small>({{DB::table('listings')->where('isApproved', false)->where('isActive', true)->count()}})</small>
                            
                            </span>
                        </a>
                    @else
                        <a href="{{ route('pendinglisting') }}">Pending Listings</a>
                    @endif
                   
                    
                </li>
                
                <li >
                    @if (DB::table('withdraws')->where('status', false)->count() > 0)
                        <a href="{{route('withdraw_req')}}">Withdraw Requests 
                            <span class="badge badge-pill badge-danger">
                                <small>({{DB::table('withdraws')->where('status', false)->count()}})</small>
                            
                            </span>
                        </a>
                    @else
                        <a href="{{route('withdraw_req')}}">Withdraw Requests </a>
                    @endif
                    
                </li>
                <li >

                    @if (DB::table('refunds')->where('isPaid', false)->count() > 0)
                        <a href="{{route('show_refunds')}}">Refund Requests
                            <span class="badge badge-pill badge-danger">
                                <small>({{DB::table('refunds')->where('isPaid', false)->count()}})</small>
                            
                            </span>
                        </a>
                    @else
                        <a href="{{route('show_refunds')}}">Refund Requests</a> 
                    @endif
                    
                </li>

                <li class="list-divider"></li>
                <li>
                    <a href="{{route('getvouchars')}}"><i class="fas fa-tag"></i><span>Vouchars</span></a>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span> Booking </span> <span
                            class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="{{route('pendingbooking')}}"> Pending Bookings </a></li>

                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Listings </span> <span
                            class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">

                        <li><a href="{{route('all_listings')}}"> All Listing </a></li>

                        <li><a href="{{ route('addlisting')}}"> Create a listing </a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('adminamenities')}}"><i class="fas fa-list"></i><span>Amenities</span></a>
                </li>
                <li>
                    <a href="{{route('adminrestrictions')}}"><i class="fas fa-stop"></i><span>Restrictions</span></a>
                </li>
                <!-- 
                
                <li class="submenu"> <a href="#"><i class="fas fa-key"></i> <span> Stays </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="all-rooms.php">All Stays </a></li>
                        <li><a href="edit-room.php"> Edit Stays </a></li>
                        <li><a href="add-room.php"> Add Stays </a></li>
                    </ul>
                </li>
                
                -->

                <!-- <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Staff </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="all-staff.php">All Staff </a></li>
                        <li><a href="edit-staff.php"> Edit Staff </a></li>
                        <li><a href="add-staff.php"> Add Staff </a></li>
                    </ul>
                </li> -->
                <!-- <li> <a href="pricing.php"><i class="far fa-money-bill-alt"></i> <span>Pricing</span></a> </li>
                <li class="submenu"> <a href="#"><i class="fas fa-share-alt"></i> <span> Apps </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="chat.php"><i class="fas fa-comments"></i><span> Chat </span></a></li>
                        <li class="submenu"> <a href="#"><i class="fas fa-video camera"></i> <span> Calls </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a href="voice-call.php"> Voice Call </a></li>
                                <li><a href="video-call.php"> Video Call </a></li>
                                <li><a href="incoming-call.php"> Incoming Call </a></li>
                            </ul>
                        </li>
                        <li class="submenu"> <a href="#"><i class="fas fa-envelope"></i> <span> Email </span> <span class="menu-arrow"></span></a>
                            <ul class="submenu_class" style="display: none;">
                                <li><a href="compose.php">Compose Mail </a></li>
                                <li><a href="inbox.php"> Inbox </a></li>
                                <li><a href="mail-veiw.php"> Mail Veiw </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="employees.php">Employees List </a></li>
                        <li><a href="leaves.php">Leaves </a></li>
                        <li><a href="holidays.php">Holidays </a></li>
                        <li><a href="attendance.php">Attendance </a></li>
                    </ul>
                </li> -->

                <!--
                    <li class="submenu"> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="invoices.php">Invoices </a></li>
                        <li><a href="payments.php">Payments </a></li>
                        <li><a href="expenses.php">Expenses </a></li>
                        <li><a href="taxes.php">Taxes </a></li>
                        <li><a href="provident-fund.php">Provident Fund </a></li>
                    </ul>
                    </li>
                    -->


                <!-- <li class="submenu"> <a href="#"><i class="fas fa-book"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="salary.php">Employee Salary </a></li>
                        <li><a href="salary-veiw.php">Payslip </a></li>
                    </ul>
                </li> -->
                <!-- <li> <a href="calendar.php"><i class="fas fa-calendar-alt"></i> <span>Calendar</span></a> </li> -->
                <!-- <li class="submenu"> <a href="#"><i class="fe fe-table"></i> <span> Blog </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="blog.php">Blog </a></li>
                        <li><a href="blog-details.php">Blog Veiw </a></li>
                        <li><a href="add-blog.php">Add Blog </a></li>
                        <li><a href="edit-blog.php">Edit Blog </a></li>
                    </ul>
                </li> -->
                <!-- <li> <a href="assets.php"><i class="fas fa-cube"></i> <span>Assests</span></a> </li> -->
                <li> <a href="#"><i class="far fa-bell"></i> <span>Experiences</span></a> </li>
                <li class="submenu"> <a href="#"><i class="fe fe-user"></i> <span> Users </span><span
                    class="menu-arrow"></span></a> 
                
                    <ul class="submenu_class">
                        <li><a href="{{route('allusers')}}"> All Users </a></li>
                        <li><a href="{{route('allhosts')}}"> Hosts </a></li>
                    </ul>
                
                </li>
                <li class="submenu"> <a href="#"><i class="fe fe-table"></i> <span> Reports </span> <span
                            class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="{{route('getallreports')}}">Add Report Category </a></li>
                        <li><a href="{{route('showuserreports')}}">Reports </a></li>
                    </ul>
                </li>

                <li class="list-divider"></li>

                <li class="submenu">
                    <a href="#"><i class="fe fe-table"></i> <span> Storage </span><span
                        class="menu-arrow"></span></a>
                    <ul class="submenu_class">
                        <li><a href="{{route('additionalservices')}}">Additional Services</a></li>
                        <li><a href="{{route('inventorytypes')}}">Inventory Types</a></li>
                    </ul>
                </li>



                <li> <a href="{{route('userfeedback')}}"><i class="fas fa-cog"></i> <span>User Feedbacks</span></a> </li>

               
                <!-- <li class="list-divider"></li>
                <li class="menu-title mt-3"> <span>UI ELEMENTS</span> </li>
                <li class="submenu"> <a href="#"><i class="fas fa-laptop"></i> <span> Components </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="uikit.php">UI Kit </a></li>
                        <li><a href="typography.php">Typography </a></li>
                        <li><a href="tabs.php">Tabs </a></li>
                    </ul>
                </li> -->
                <!-- <li class="submenu"> <a href="#"><i class="fas fa-edit"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="form-basic-inputs.php">Basic Input </a></li>
                        <li><a href="form-input-groups.php">Input Groups </a></li>
                        <li><a href="form-horizontal.php">Horizontal Form </a></li>
                        <li><a href="form-vertical.php">Vertical Form </a></li>
                    </ul>
                </li> -->
                <!-- <li class="submenu"> <a href="#"><i class="fas fa-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="tables-basic.php">Basic Table </a></li>
                        <li><a href="tables-datatables.php">Data Table </a></li>
                    </ul>
                </li>
                <li class="list-divider"></li>
                <li class="menu-title mt-3"> <span>EXTRAS</span> </li> -->
                <!-- <li class="submenu"> <a href="#"><i class="fas fa-columns"></i> <span> Pages </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="login.php">Login </a></li>
                        <li><a href="register.php">Register </a></li>
                        <li><a href="forgot-password.php">Forgot Password </a></li>
                        <li><a href="change-password.php">Change Password </a></li>
                        <li><a href="lock-screen.php">Lockscreen </a></li>
                        <li><a href="profile.php">Profile </a></li>
                        <li><a href="gallery.php">Gallery </a></li>
                        <li><a href="error-404.php">404 Error </a></li>
                        <li><a href="error-500.php">500 Error </a></li>
                        <li><a href="blank-page.php">Blank Page </a></li>
                    </ul>
                </li> -->
                <!-- <li class="submenu"> <a href="#"><i class="fas fa-share-alt"></i> <span> Multi Level </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="">Level 1 </a></li>
                        <li><a href="">Level 2 </a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</div>