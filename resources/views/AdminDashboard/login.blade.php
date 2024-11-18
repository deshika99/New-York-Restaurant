<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>New York Guest House & Restaurant</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/frontend/img/ny logo.jpg') }}">
    <!-- Template CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="{{ asset('backend/assets/js/vendors/color-modes.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/main.css') }}">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <!-- PDFMake and JSZip for PDF/Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
</head>

    <body>
        <main>
             
            <section class="content-main mt-80 mb-80">
                <div class="card mx-auto card-login">
                    <div class="card-body">
                        <h4 class="card-title mb-4 ml-130">Sign in</h4>
                        <form action="{{ route('staff_login_post') }}" method="POST">
                        @csrf
                            <div class="mb-3">
                                <input class="form-control" placeholder=" email" type="text" name="email" required/>
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                <input class="form-control" placeholder="Password" type="password" name="password" required />
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" checked="" />
                                    <span class="form-check-label">Remember</span>
                                </label>
                            </div>
                            <!-- form-group form-check .// -->
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                            <!-- form-group// -->
                        </form>
                        @if (session('error'))
                            <div>{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('staff_login_post') }}" method="POST">

                        
                        
                    </div>
                </div>
            </section>
            <footer class="main-footer text-center">
                <p class="font-xs">
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    &copy; e-support Technologies Ecommerce Template .
                </p>
                <p class="font-xs mb-30">All rights reserved</p>
            </footer>
        </main>
        <script src="backend/assets/js/vendors/jquery-3.6.0.min.js"></script>
        <script src="backend/assets/js/vendors/bootstrap.bundle.min.js"></script>
        <script src="backend/assets/js/vendors/jquery.fullscreen.min.js"></script>
        <!-- Main Script -->
        <script src="backend/assets/js/main.js?v=6.0" type="text/javascript"></script>
    </body>
</html>
