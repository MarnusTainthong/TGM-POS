<?php include dirname(__FILE__) . "/../page_pos_main.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>จัดการคลังสินค้า</h1>
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

            <div class="col-lg-2 col-md-6 col-sm-12">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>รับสินค้า</h3>
                    </div>
                    <a href="<?php echo(site_url().$this->config->item('ctrl_path').'/Pos_store/product_receive_bill/'); ?>" class="small-box-footer">
                        บันทึกข้อมูล <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col lg2 md6 sm12 -->

            <div class="col-lg-3 col-md-6 col-sm-12">
                <!-- small card -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3>บันทึกใบส่งสินค้า</h3>
                    </div>
                    <a href="<?php echo(site_url().$this->config->item('ctrl_path').'/Pos_store/product_deliver_bill/'); ?>" class="small-box-footer">
                        บันทึกข้อมูล <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col lg3 md6 sm12 -->

        </div>
        <!-- ./row -->

        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-8">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header_side')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">รายการสินค้าคงคลัง</h3>
                    </div>
                    <div class="card-body">
                        <!-- body -->

                        <table id="product_table" class="table table-bordered table-striped dataTable table-responsive" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">รหัสอ้างอิง</th>
                                    <th width="20%">ชื่อสินค้า</th>
                                    <th width="10%">จำนวนคงเหลือ</th>
                                    <th width="10%">หน่วยนับ</th>
                                    <th width="5%">เลข Lot</th>
                                    <th width="10%">วันผลิต</th>
                                    <th width="10%">วันหมดอายุ</th>
                                    <th width="15%">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- table -->
                    </div>
                    <!-- /.card-body -->
                    <!-- <div class="overlay dark">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div> -->
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

<script>
$(document).ready(function() {

});
</script>