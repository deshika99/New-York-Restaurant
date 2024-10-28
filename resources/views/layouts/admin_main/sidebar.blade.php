<style>

  /* --------------------- titles ---------------------- */
.section-heading {
  margin-bottom: 40px;
  margin-top: 0;
}
.section-heading p {
  max-width: 600px;
  margin: auto;
}

.section-title {
  font-weight: 500;
}

.title-text {
  margin-top: 45px;
  margin-bottom: 20px;
}

.b {
  font-weight: 600;
}
    .rtl {
        direction: rtl;
    }

    .ltr {
        direction: ltr;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: "Quicksand", sans-serif;
        color: #495057;
        font-weight: 800;
        line-height: 1.5;
    }

    h1 {
        font-size: 36px;
    }

    h2 {
        font-size: 30px;
    }

    h3 {
        font-size: 24px;
    }

    h4 {
        font-size: 18px;
    }

    h5 {
        font-size: 15px;
    }

    h6 {
        font-size: 14px;
    }

    p {
        font-size: 14px;
        font-weight: 400;
        line-height: 24px;
        margin-bottom: 5px;
    }

    p:last-child {
        margin-bottom: 0;
    }

    a,
    button {
        text-decoration: none;
        cursor: pointer;
    }

    b {
        font-weight: 500;
    }

    .card-title {
        color: #383e50 !important;
    }

    .text-body {
        color: #4f5d77 !important;
    }

    .menu-aside {
        list-style: none;
        margin: 1rem;
        padding: 0;
    }

    .menu-aside a {
        display: block;
        text-decoration: none;
        font-family: "Quicksand", sans-serif;
        font-weight: 600;
    }

    .menu-aside .menu-item {
        margin-bottom: 5px;
    }

    .menu-aside .menu-item .icon {
        color: #adb5bd;
        margin-right: 10px;
        font-size: 24px;
    }

    .menu-aside .menu-item.active .icon {
        color: #bd0f0f;
    }

    .menu-aside .menu-item.active .menu-link {
        background-color: rgba(189, 15, 15, 0.2);
    }

    .menu-aside .menu-item.active .submenu a.active {
        color: #bd0f0f !important;
    }

    .menu-aside .menu-link {
        padding: 10px;
        font-weight: 800;
        font-size: 13px;
        color: #292f46;
        border-radius: 0.5rem;
        position: relative;
        line-height: 1;
        display: flex;
        align-items: center;
    }

    .menu-aside .menu-link:hover {
        transition: 0.2s linear;
        background-color: #e9ecef;
    }

    .menu-aside .submenu {
        margin-left: 44px;
        display: none;
        margin-top: 10px;
    }

    .menu-aside .submenu a {
        color: #6c757d;
        padding: 5px 0 5px 15px;
        transition-duration: 0.3s;
        position: relative;
        margin-left: 5px;
    }

    .menu-aside .submenu a:hover {
        color: #000;
        transition-duration: 0.3s;
    }

    .menu-aside .submenu a:before {
        content: "";
        width: 5px;
        height: 5px;
        position: absolute;
        background-color: #adb5bd;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 50%;
    }

    .menu-aside .menu-item.active .submenu {
        display: block;
    }

    .menu-aside .menu-item.has-submenu > .menu-link:after {
        display: inline-block;
        position: absolute;
        right: 10px;
        top: 15px;
        margin-top: 0.6em;
        vertical-align: middle;
        content: "";
        border-top: 5px solid #adb5bd;
        border-right: 5px solid transparent;
        border-bottom: 0;
        border-left: 5px solid transparent;
    }

    .nav-pills .nav-link {
        color: #6c757d;
        font-weight: 500;
    }

    .nav-pills .nav-link:hover {
        color: #1e2231;
        background-color: rgba(173, 181, 189, 0.15);
    }

    body {
        position: relative;
        min-height: 100vh;
        overflow-x: hidden;
    }

    body.offcanvas-active {
        overflow: hidden;
    }

    .main-wrap {
        margin-left: 300px;
        background-color: #f8f9fa;
        position: relative;
    }
    .main-wrap .content-main {
        min-height: calc(100vh - 60px);
    }

    .content-main {
        padding: 30px 3%;
        margin-left: auto;
        margin-right: auto;
        background-color: #f8f9fa;
        min-height: calc(100vh - 60px);
    }

    .dropdown-menu-end {
        right: 0 !important;
    }

    .navbar-aside {
        max-width: 300px;
        display: block;
        position: fixed;
        top: 0;
        bottom: 0;
        width: 100%;
        overflow-y: auto;
        background-color: #fff;
        box-shadow: none;
        z-index: 10;
        border-right: 1px solid #dee2e6;
    }
    .navbar-aside .aside-top {
        padding: 12px 0.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #eee;
        min-height: 72px;
    }
    .navbar-aside .aside-top .brand-wrap {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        display: inline-block;
    }
    .navbar-aside .aside-top .logo {
        max-width: 120px;
        margin-top: 5px;
        min-width: 120px;
    }

    .main-header {
        padding-left: 3%;
        padding-right: 3%;
        min-height: 72px;
        background-color: #fff;
        box-shadow: 0 0.75rem 1.5rem rgba(18, 38, 63, 0.03);
        border-bottom: 1px solid #dee2e6;
    }
    .main-header .nav {
        align-items: center;
    }
    .main-header .nav-item > a {
        color: #6c757d;
        display: block;
        text-decoration: none;
        position: relative;
        padding: 0 10px;
    }
    .main-header .nav-item > a .badge {
        position: absolute;
        right: 2px;
        top: -5px;
        color: #ffffff;
        height: 16px;
        width: 16px;
        font-weight: 500;
        font-size: 10px;
        text-align: center;
        line-height: 17px;
        display: block;
        padding: 0;
        background-color: #bd0f0f;
    }
    .main-header .nav-item.dropdown {
        margin-right: 5px;
    }
    .main-header .nav-link:hover {
        background-color: transparent;
        color: #bd0f0f;
    }
    .main-header .col-search {
        flex-grow: 0.5;
    }
    .main-header .col-nav {
        display: flex;
        align-items: center;
    }
    .main-header .brand-wrap img.logo {
        max-width: 130px;
        margin-top: 5px;
    }

    .nav-item img.rounded-circle {
        border: 2px solid #eee;
    }
    .nav-item img.rounded-circle:hover {
        border-color:#bd0f0f;
    }

    .content-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 30px;
    }
    .content-header .content-title {
        margin-bottom: 0;
    }

    .inner {
        padding: 1rem;
    }

    body.aside-mini .main-wrap {
        margin-left: 80px;
    }
    body.aside-mini .navbar-aside {
        max-width: 80px;
        overflow: visible;
        position: absolute;
        min-height: 100%;
        bottom: auto;
        overflow: unset !important;
    }
    body.aside-mini .navbar-aside .aside-top {
        text-align: center;
    }
    body.aside-mini .navbar-aside .aside-top > div {
        flex-grow: 1;
    }
    body.aside-mini .navbar-aside .brand-wrap,
    body.aside-mini .navbar-aside .logo {
        display: none;
    }

    .searchform {
  position: relative;
}
.searchform input {
  max-width: 300px;
  height: 42px;
}
.searchform button {
  border-radius: 0 4px 4px 0;
  border: 0;
  background-color: #f4f5f9;
  box-shadow: 0 !important;
  width: 70px;
  height: 42px;
}
.searchform button:hover {
  background-color: #bd0f0f;
}
.searchform button:hover i {
  color: #fff;
}
.searchform .btn-light {
  box-shadow: none !important;
  border-left: 1px solid #e1e1e1;
}

.form-check-input:checked {
  background-color: #bd0f0f;
  border-color: #bd0f0f;
}
/* ITEM LIST */
.itemlist {
  border-bottom: 1px solid #dee2e6;
  align-items: center;
  width: 100%;
  padding: 0.5rem 0.5rem;
}
.itemlist:hover {
  background-color: rgba(var(--bs-emphasis-color-rgb), 0.075);
}

/* ITEMSIDE */
.itemside {
  position: relative;
  display: flex;
  width: 100%;
  align-items: center;
}
.itemside .aside, .itemside .left {
  position: relative;
  flex-shrink: 0;
}
.itemside .info {
  padding-left: 15px;
  padding-right: 7px;
}
.itemside p {
  margin-bottom: 0;
}
.itemside .title {
  display: block;
  margin-bottom: 5px;
}
.itemside a.title:hover {
  color: #bd0f0f;
}

a.itemside {
  color: initial;
  text-decoration: none;
}
a.itemside:hover .title {
  text-decoration: underline;
}
.navbar-aside .aside-top .logo {
  max-width: 35px;
  margin-top: 5px;
  min-width: 10px;
}



</style>


<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="index.html" class="brand-wrap">
            <img src="backend/assets/imgs/theme/logo.png" class="logo" alt="Nest Dashboard">
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
                <a class="menu-link" href="page-products-list.html">
                    <i class="icon material-icons md-shopping_bag"></i>
                    <span class="text">Customer Section</span>
                </a>
            </li>
            <li class="menu-item has-submenu">
                <a class="menu-link" href="page-orders-1.html">
                    <i class="icon material-icons md-shopping_cart"></i>
                    <span class="text">Order Management</span>
                </a>
            </li>
            <li class="menu-item has-submenu">
                <a class="menu-link" href="page-sellers-cards.html">
                    <i class="icon material-icons md-store"></i>
                    <span class="text">Report</span>
                </a>
            </li>
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-settings"></i>
                    <span class="text">Settings</span>
                </a>
            </li>
        </ul>
        <br />
        <br />
    </nav>
</aside>
<main class="main-wrap">
<header class="main-header navbar">
                <div class="col-search">
                    <form class="searchform">
                        <div class="input-group">
                            <input list="search_terms" type="text" class="form-control" placeholder="Search term" />
                            <button class="btn btn-light bg" type="button"><i class="material-icons md-search"></i></button>
                        </div>
                        <datalist id="search_terms">
                            <option value="Products"></option>
                            <option value="New orders"></option>
                            <option value="Apple iphone"></option>
                            <option value="Ahmed Hassan"></option>
                        </datalist>
                    </form>
                </div>
                <div class="col-nav">
                    <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link btn-icon" href="#">
                                <i class="material-icons md-notifications animation-shake"></i>
                                <span class="badge rounded-pill">3</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
                        </li>
                        <li class="dropdown nav-item">
                            <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownLanguage" aria-expanded="false"><i class="material-icons md-public"></i></a>
                            <div class="dropdown-menu dropdown-menu-start" aria-labelledby="dropdownLanguage">
                                <a class="dropdown-item text-danger" href="#"><img src="backend/assets/imgs/theme/flag-us.png" alt="English" />English</a>
                                <a class="dropdown-item" href="#"><img src="backend/assets/imgs/theme/flag-fr.png" alt="Français" />Français</a>
                                <a class="dropdown-item" href="#"><img src="backend/assets/imgs/theme/flag-jp.png" alt="Français" />日本語</a>
                                <a class="dropdown-item" href="#"><img src="backend/assets/imgs/theme/flag-cn.png" alt="Français" />中国人</a>
                            </div>
                        </li>
                        <li class="dropdown nav-item">
                            <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="backend/assets/imgs/people/avatar-2.png" alt="User" /></a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                                <a class="dropdown-item" href="#"><i class="material-icons md-perm_identity"></i>Edit Profile</a>
                                <a class="dropdown-item" href="#"><i class="material-icons md-settings"></i>Account Settings</a>
                                <a class="dropdown-item" href="#"><i class="material-icons md-account_balance_wallet"></i>Wallet</a>
                                <a class="dropdown-item" href="#"><i class="material-icons md-receipt"></i>Billing</a>
                                <a class="dropdown-item" href="#"><i class="material-icons md-help_outline"></i>Help center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#"><i class="material-icons md-exit_to_app"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>
