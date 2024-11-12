<aside class="navbar-aside" id="offcanvas_aside">
            <div class="aside-top">
                <a href="#" class="brand-wrap">
                    <img src="/frontend/img/ny logo.jpg" class="logo" alt="DK-Mart" />
                </a>
                <span>New York Guest House & Restaurant (PVT) LTD</span>
                <div>
                    <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
                </div>
            </div>
            <nav>
                <ul class="menu-aside">
                    <li class="menu-item {{ request()->routeIs('admin') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('admin') }}">
                            <i class="icon material-icons md-home"></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>       
                    
                    <li class="menu-item has-submenu {{ request()->is('admin/apartments*') || request()->is('admin/floors*') || request()->is('admin/room-types*') || request()->is('admin/rooms*') ? 'active' : '' }}">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-apartment"></i>
                            <span class="text">Apartments and Rooms</span>
                        </a>
                        <div class="submenu {{ request()->is('admin/apartments*') || request()->is('admin/floors*') || request()->is('admin/room-types*') || request()->is('admin/rooms*') ? 'show' : '' }}">
                            <a href="{{ route('apartment_management') }}" class="{{ request()->is('admin/apartments') ? 'active' : '' }}">
                                Apartment Management
                            </a>
                            <a href="{{ route('floor_management') }}" class="{{ request()->is('admin/floors') ? 'active' : '' }}">
                                Floor Management
                            </a>
                            <a href="{{ route('room_type_management') }}" class="{{ request()->is('admin/room-types') ? 'active' : '' }}">
                                Room Type Management
                            </a>
                            <a href="{{ route('room_management') }}" class="{{ request()->is('admin/rooms') ? 'active' : '' }}">
                                Room Management
                            </a>
                        </div>
                    </li>

                    <li class="menu-item has-submenu {{ request()->is('admin/customers*') ? 'active' : '' }}">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-people"></i>
                            <span class="text">Customer Section</span>
                        </a>
                        <div class="submenu {{ request()->is('admin/customers*') ? 'show' : '' }}">
                            <a href="{{ route('customers.create') }}" class="{{ request()->is('admin/customers/create') ? 'active' : '' }}">
                                Add Customer
                            </a>
                            <a href="{{ route('customers.showlist') }}" class="{{ request()->is('admin/customers') ? 'active' : '' }}">
                                All Customers
                            </a>
                        </div>
                    </li>




                    


                    <li class="menu-item has-submenu">
                        <a class="menu-link" href="page-orders-1.html">
                            <i class="icon material-icons md-shopping_cart"></i>
                            <span class="text">Order Management</span>
                        </a>
                        <div class="submenu">
                            <a href="page-form-product-1.html">Add Booking</a>
                        </div>
                    </li>

                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('viewOnlineBookings') }}">
                            <i class="icon material-icons md-event"></i>
                            <span class="text">Online Bookings</span>
                        </a>
                    </li> 

                    <li class="menu-item">
                        <a class="menu-link" href="{{route('viewOfficeBookings')}}">
                            <i class="icon material-icons md-beenhere"></i>
                            <span class="text">In-Office Bookings</span>
                        </a>
                    </li>


                    <li class="menu-item has-submenu {{ request()->is('admin/staff*') || request()->is('admin/position*') || request()->is('admin/department*') ? 'active' : '' }}">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-group"></i>
                            <span class="text">Staff</span>
                        </a>
                        <div class="submenu {{ request()->is('admin/staff*') || request()->is('admin/position*') || request()->is('admin/department*') ? 'active' : '' }}">
                            <a href="{{ route('staff_management') }}" class="{{ request()->is('admin/staff') ? 'active' : '' }}">
                                Staff Management                
                            </a>
                            <a href="{{ route('position_management') }}" class="{{ request()->is('admin/position') ? 'active' : '' }}">
                                Position Management
                            </a>
                            <a href="{{ route('department_management') }}" class="{{ request()->is('admin/department') ? 'active' : '' }}">
                                Department Management 
                            </a>
                        </div>
                    </li>


                    


                    <!-- <li class="menu-item has-submenu">
                        <a class="menu-link" href="page-orders-1.html">
                            <i class="icon material-icons md-shopping_cart"></i>
                            <span class="text">Orders</span>
                        </a>
                        <div class="submenu">
                            <a href="page-orders-1.html">Order list 1</a>
                            <a href="page-orders-2.html">Order list 2</a>
                            <a href="page-orders-detail.html">Order detail</a>
                        </div>
                    </li>
                    <li class="menu-item has-submenu">
                        <a class="menu-link" href="page-sellers-cards.html">
                            <i class="icon material-icons md-store"></i>
                            <span class="text">Sellers</span>
                        </a>
                        <div class="submenu">
                            <a href="page-sellers-cards.html">Sellers cards</a>
                            <a href="page-sellers-list.html">Sellers list</a>
                            <a href="page-seller-detail.html">Seller profile</a>
                        </div>
                    </li>
                    <li class="menu-item has-submenu">
                        <a class="menu-link" href="page-form-product-1.html">
                            <i class="icon material-icons md-add_box"></i>
                            <span class="text">Add product</span>
                        </a>
                        <div class="submenu">
                            <a href="page-form-product-1.html">Add product 1</a>
                            <a href="page-form-product-2.html">Add product 2</a>
                            <a href="page-form-product-3.html">Add product 3</a>
                            <a href="page-form-product-4.html">Add product 4</a>
                        </div>
                    </li>
                    <li class="menu-item has-submenu">
                        <a class="menu-link" href="page-transactions-1.html">
                            <i class="icon material-icons md-monetization_on"></i>
                            <span class="text">Transactions</span>
                        </a>
                        <div class="submenu">
                            <a href="page-transactions-1.html">Transaction 1</a>
                            <a href="page-transactions-2.html">Transaction 2</a>
                        </div>
                    </li>
                    <li class="menu-item has-submenu">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-person"></i>
                            <span class="text">Account</span>
                        </a>
                        <div class="submenu">
                            <a href="page-account-login.html">User login</a>
                            <a href="page-account-register.html">User registration</a>
                            <a href="page-error-404.html">Error 404</a>
                        </div>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="page-reviews.html">
                            <i class="icon material-icons md-comment"></i>
                            <span class="text">Reviews</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="page-brands.html"> <i class="icon material-icons md-stars"></i> <span class="text">Brands</span> </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" disabled href="#">
                            <i class="icon material-icons md-pie_chart"></i>
                            <span class="text">Statistics</span>
                        </a>
                    </li> -->
                </ul>
                <hr />
                <ul class="menu-aside">
                    <li class="menu-item has-submenu">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-settings"></i>
                            <span class="text">Settings</span>
                        </a>
                        <div class="submenu">
                            <a href="page-settings-1.html">Setting sample 1</a>
                            <a href="page-settings-2.html">Setting sample 2</a>
                        </div>
                    </li>
                    <!-- <li class="menu-item">
                        <a class="menu-link" href="page-blank.html">
                            <i class="icon material-icons md-local_offer"></i>
                            <span class="text"> Starter page </span>
                        </a>
                    </li> -->
                </ul>
                <br />
                <br />
            </nav>
        </aside>

