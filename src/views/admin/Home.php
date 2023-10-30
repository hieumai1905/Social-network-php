<?php
    require "Layout-Header-Admin.php";
?>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">All Users</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title"id="count-users">10</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">All Posts</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title" id="count-posts">190</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">Posts exported in month</h5>
                            </div>
                            <div class="card-body">
                                <h6 id="count-posts-per-month" class="card-title">190</h6>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
        <?php
        require "Layout-Footer-Admin.php";
        ?>
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
<script>
    $("#products").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
    });
</script>
</body>

</html>