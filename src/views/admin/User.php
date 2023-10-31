<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management</title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/public/static/css/fontawesome.all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/public/static/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/public/static/css/responsive.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/public/static/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/admin/dash-board" class="nav-link"><b>Home</b></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/starter.html" class="brand-link">
            <img src="/public/static/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Admin O la la</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="/admin/dash-board" class="nav-link">
                            <span class="nav-icon badge">P</span>
                            <p>[Dashboard]</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/users" class="nav-link active">
                            <span class="nav-icon badge">U</span>
                            <p>[UsersPage]</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/logout" class="nav-link">
                            <span class="nav-icon badge">L</span>
                            <p>[Logout]</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dash-board">Home</a></li>
                            <li class="breadcrumb-item active">[Users]</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="products" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center;">STT</th>
                                        <th style="text-align: center;">Username</th>
                                        <th style="text-align: center;">Email</th>
                                        <th style="text-align: center;">Phone</th>
                                        <th style="text-align: center;">Options</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body-content">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="container" style="margin-top: 9px;">
        <div class="row">
            <div class="col-sm-12 col-md-7" style="margin-left:72px;">
                <div class="dataTables_paginate paging_simple_numbers" id="products_paginate">
                    <ul class="pagination">
                        <li class="paginate_button page-item previous disabled" id="products_previous"><a href="#"
                                                                                                          aria-controls="products"
                                                                                                          data-dt-idx="0"
                                                                                                          tabindex="0"
                                                                                                          class="page-link">Previous</a>
                        </li>
                        <li class="paginate_button page-item next disabled" id="products_next"><a href="#"
                                                                                                  aria-controls="products"
                                                                                                  data-dt-idx="1"
                                                                                                  tabindex="0"
                                                                                                  class="page-link">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            From <a href="https://github.com/thanhminhmr" target="_blank">N01</a>
            and <a href="https://github.com/HMit19">N05</a> with love
        </div>
        Created by <a href="https://adminlte.io">N01!</a>.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/public/static/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/public/static/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/public/static/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/public/static/js/jquery.dataTables.min.js"></script>
<script src="/public/static/js/dataTables.bootstrap4.min.js"></script>
<script src="/public/static/js/dataTables.responsive.min.js"></script>
<script src="/public/static/js/responsive.bootstrap4.min.js"></script>
<script src="/public/assets/js/hm/Admin-User-page.js"></script>
<!--<script>-->
<!--    $("#products").DataTable({-->
<!--        "paging": true,-->
<!--        "lengthChange": false,-->
<!--        "searching": true,-->
<!--        "ordering": true,-->
<!--        "info": true,-->
<!--        "autoWidth": true,-->
<!--        "responsive": true,-->
<!--    });-->
<!--</script>-->
</body>
</html>