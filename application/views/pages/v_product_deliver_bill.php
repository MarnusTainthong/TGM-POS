<?php include dirname(__FILE__) . "/../page_pos_main.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>บันทึกใบส่งสินค้า</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo site_url().$this->config->item('ctrl_path').'/Pos_store/mange_store'; ?>">จัดการคลังสินค้า</a></li>
                        <li class="breadcrumb-item active">บันทึกใบส่งสินค้า</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-7 col-sm-12 col-lg-4" id="div_save_product">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">บันทึกข้อมูลใบส่งสินค้า</h3>
                    </div>
                    <div class="card-body">

                        <form class="form-horizontal" id="ProductReceiveForm" method="post">

                            <input type="hidden" class="form-control" id="inventory_id" disabled>

                            <div class="form-group row">
                                <label for="inventory_product_name" class="col-sm-5 col-form-label">ชื่อสินค้า <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <select name="inventory_product_name" id="inventory_product_name" class="form-control" required></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inventory_lot" class="col-sm-5 col-form-label">หมายเลข Lot <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="inventory_lot" id="inventory_lot" placeholder="หมายเลข Lot" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inventory_produce" class="col-sm-5 col-form-label">วันที่ผลิต <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" name="inventory_produce" id="inventory_produce" placeholder="วันที่ผลิต" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inventory_exp" class="col-sm-5 col-form-label">วันหมดอายุ <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" name="inventory_exp" id="inventory_exp" placeholder="วันหมดอายุ" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inventory_qty" class="col-sm-5 col-form-label">จำนวนรับเข้า <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-lg" name="inventory_qty" id="inventory_qty" placeholder="จำนวนรับเข้า" required>
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="<?php echo ($this->config->item('btn_cancel')); ?>" onclick="reset_form('ProductReceiveForm'); opt_product_all();"><?php echo ($this->config->item('txt_cancel')); ?></button>
                        <button type="button" class="<?php echo ($this->config->item('btn_save')); ?> float-right submit" onclick="save_product_qty()"><?php echo ($this->config->item('txt_save')); ?></button>
                    </div>
                    <!-- /.card-footer -->
                    </form>
                    <!-- /.form -->
                    <div class="overlay dark" id="loading_input">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- lg4 md7 sm12 -->

            <div class="col-md-12 col-sm-12 col-lg-6">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header_side')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">รายการใบส่งสินค้า</h3>
                    </div>
                    <div class="card-body">
                        <!-- body -->
                        <table id="productReceive_table" class="table table-bordered table-striped dataTable table-responsive" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">เลขที่บิลรับสินค้า</th>
                                    <th width="15%">ชื่อผู้ตรวจนับ</th>
                                    <th width="10%">วันที่สร้างบิล</th>
                                    <th width="15%">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- table -->
                    </div>
                    <!-- /.card-body -->
                    <div class="overlay dark">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- lg8 md12 sm12 -->
        </div>
        <!-- ./row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
    <i class="fas fa-chevron-up"></i>
</a>

<script>
$(document).ready(function() {

});
</script>