<?php include dirname(__FILE__) . "/../page_pos_main.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ขายสินค้าหน้าร้าน</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">จัดการหลังร้าน</a></li>
                        <li class="breadcrumb-item active">จัดการคลังสินค้า</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        <input class="form-control form-control-lg" type="text" placeholder="ระบุชื่อสินค้า หรือบาร์โค้ด">
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-body">
                        <table id="product_sum_qty_table" class="table table-bordered table-striped dataTable table-responsive" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">รหัสอ้างอิง</th>
                                    <th width="20%">ชื่อสินค้า</th>
                                    <th width="10%">จำนวน</th>
                                    <th width="10%">หน่วยนับ</th>
                                    <th width="15%">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- table -->
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- ./card -->
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-md-4 col-sm-12">

                <div class="info-box mb-3 bg-info">
                    <span class="mt-3">
                        <h3><b>ยอดรวม</b></h3>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-number mt-2" id="text_total_price">
                            <h1><b><center>163,921</center></b></h1>
                        </span>
                    </div>
                    <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                    <!-- /.info-box-content -->
                </div>
                <!-- ./info-box -->

                <div class="card card-outline card-danger">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputBillno" class="col-sm-4 col-form-label">เลขที่บิล</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="bill_no" placeholder="เลขที่บิล">
                            </div>
                        </div>
                        <!-- ./row -->



                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>
                        <!-- ./row -->

                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- ./card -->
            </div>
            <!-- ./col -->

        </div>
        <!-- ./row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
$(document).ready(function() {
    //
});
</script>