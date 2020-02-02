<?php include dirname(__FILE__) . "/../page_pos_main.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>ตั้งค่าประเภทสินค้า</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <!-- Default box -->
            <div class="<?php echo ($this->config->item('card_header')); ?>">
                <div class="card-header">
                    <h3 class="card-title">จัดการข้อมูลประเภทสินค้า</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal">
                        <div class="form-group row">
                            <label for="inputCategory" class="col-sm-4 col-form-label">ชื่อประเภทสินค้าภาษาไทย</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="ใส่ชื่อประเภทสินค้า">
                            </div>
                        </div>
                    </form>
                    <!-- /.form -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" class="<?php echo($this->config->item('btn_cancel'));?>"><?php echo($this->config->item('txt_cancel'));?></button>
                    <button type="submit" class="<?php echo($this->config->item('btn_save'));?> float-right"><?php echo($this->config->item('txt_save'));?></button>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            </div>
            <!-- md6 sm12 -->




            <div class="col-md-4 col-sm-12">
                <!-- Default box -->
            <div class="<?php echo ($this->config->item('card_header_side')); ?>">
                <div class="card-header">
                    <h3 class="card-title">จัดการข้อมูลประเภทสินค้า</h3>
                </div>
                <div class="card-body">
                    <!-- body -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- md6 sm12 -->
        </div>
        <!-- ./row -->





    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
