<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>DK Mart</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="backend/assets/imgs/theme/favicon.svg" />
        <!-- Template CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <script src="{{ asset('backend/assets/js/vendors/color-modes.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('backend/assets/css/main.css') }}">
    </head>

    <body>
        <div class="screen-overlay"></div>
        
        @include('AdminDashboard.Sidebar')


        <main class="main-wrap">

            @include('AdminDashboard.Header')
           
            <section class="content-main">
            @yield('content')
   
            </section>

            <footer class="main-footer font-xs">
                <div class="row pb-30 pt-15">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        &copy; Nest - HTML Ecommerce Template .
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end">All rights reserved</div>
                    </div>
                </div>
            </footer>
        </main>
        <!-- Include Vendor Scripts -->
        <script src="{{ asset('backend/assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/select2.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/jquery.fullscreen.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/chart.js') }}"></script>

        <!-- Main Script -->
        <script src="{{ asset('backend/assets/js/main.js?v=6.0') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/custom-chart.js') }}" type="text/javascript"></script>
        

    </body>
</html>
