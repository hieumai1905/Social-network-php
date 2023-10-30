<?php
require "Layout-Header-Admin.php";
?>
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
                        <div id="products_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="products"
                                           class="table table-bordered table-striped dataTable no-footer dtr-inline"
                                           aria-describedby="products_info" style="width: 1602px;">
                                        <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="products"
                                                rowspan="1" colspan="1" style="width: 313px;" aria-sort="ascending"
                                                aria-label="STT: activate to sort column descending">
                                                ID
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="products" rowspan="1"
                                                colspan="1" style="width: 305px;"
                                                aria-label="Username: activate to sort column ascending">
                                                Name
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="products" rowspan="1"
                                                colspan="1" style="width: 331px;"
                                                aria-label="Email: activate to sort column ascending">
                                                Email
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="products" rowspan="1"
                                                colspan="1" style="width: 178px;"
                                                aria-label="Phone: activate to sort column ascending">
                                                Status
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="products" rowspan="1"
                                                colspan="1" style="width: 326px;"
                                                aria-label="Options: activate to sort column ascending">
                                                Options
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="show-user-body">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
<!--<script src="~/assets/hm/page-user.js"></script>-->
</body>

</html>