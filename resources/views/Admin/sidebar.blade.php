<!-- resources/views/partials/sidebar.blade.php -->
<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="index.html" class="brand-wrap">
            <img src="{{ asset('backend/assets/imgs/Logo.png') }}" class="logo" alt="Nest Dashboard" style="margin-left: 50%;" />
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
                <ul class="menu-aside">
                    <li class="menu-item active">
                        <a class="menu-link" href="index.html">
                            <i class="icon material-icons md-home"></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item has-submenu">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-person"></i>
                            <span class="text">Customers</span>
                        </a>
                        <div class="submenu">
                            
                            <a href="{{ route('apartments') }}">Customer List</a>
                        </div>
                    </li>
                    <li class="menu-item has-submenu">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-person"></i>
                            <span class="text">Suppliers</span>
                        </a>
                        <div class="submenu">
                            
                            <a href="{{ route('apartments') }}">Supplier List</a>
                        </div>
                    </li>
                    <li class="menu-item has-submenu">
                        <a class="menu-link" href="#" >
                            <i class="icon material-icons md-shopping_bag"></i>
                            <span class="text">Apartments & Rooms</span>
                        </a>
                        <div class="submenu">
                            
                            <a href="{{ route('apartments') }}">Apartment Management</a>
                            <a href="{{ route('apartments') }}">Floor Management</a>
                            <a href="{{ route('apartments') }}">Room Type Managment</a>
                            <a href="{{ route('apartments') }}">Room Management</a>
                            
                        </div>
                    </li>
                    
                    
                </ul>
                <hr />
                
                <br />
                <br />
            </nav>
</aside>
