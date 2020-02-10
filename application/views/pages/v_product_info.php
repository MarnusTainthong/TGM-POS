<?php include dirname(__FILE__) . "/../page_pos_main.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><span id="title_text">รายการข้อมูลสินค้า</span></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">จัดการหลังร้าน</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url().$this->config->item('ctrl_path').'/Pos_product/mange_product'; ?>">จัดการสินค้า</a></li>
                        <li class="breadcrumb-item active"><span id="breadcrumb_text">ข้อมูลสินค้ารายการ</span></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-7 col-sm-12 col-lg-4">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">ข้อมูลสินค้า </h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" id="actionProductForm" method="post">
                            <input type="hidden" class="form-control" id="product_id" disabled>
                            <div class="form-group row">
                                <label for="product_name_th_ip" class="col-sm-5 col-form-label">ชื่อสินค้าภาษาไทย <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="product_name_th_ip" id="product_name_th_ip" placeholder="ชื่อสินค้าภาษาไทย">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_name_en_ip" class="col-sm-5 col-form-label">ชื่อสินค้าภาษาอังกฤษ <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="product_name_en_ip" id="product_name_en_ip" placeholder="ชื่อสินค้าภาษาอังกฤษ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_desc_ip" class="col-sm-5 col-form-label">รายละเอียดสินค้า </label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="product_desc_ip" id="product_desc_ip" rows="2" placeholder="รายละเอียดสินค้า"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_sku_ip" class="col-sm-5 col-form-label">รหัสอ้างอิง</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="product_sku_ip" id="product_sku_ip" placeholder="รหัสอ้างอิง">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="producct_barcode_ip" class="col-sm-5 col-form-label">รหัส barcode</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="producct_barcode_ip" id="producct_barcode_ip" placeholder="รหัส barcode">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_category_ip" class="col-sm-5 col-form-label">หมวดหมู่สินค้า <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="product_category_ip" id="product_category_ip" placeholder="หมวดหมู่สินค้า">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_price_ip" class="col-sm-5 col-form-label">ราคาขาย (บาท) <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="product_price_ip" id="product_price_ip" placeholder="ราคาขาย (บาท)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_supplier_ip" class="col-sm-5 col-form-label">ตัวแทนจำหน่าย <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="product_supplier_ip" id="product_supplier_ip" placeholder="ตัวแทนจำหน่าย">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_unit" class="col-sm-5 col-form-label">หน่วยนับ <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="product_unit_ip" id="product_unit_ip" placeholder="หน่วยนับ">
                                </div>
                            </div>
                        </form>
                        <!-- /.form -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card-footer">
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- lg4 md7 sm12 -->
</div>
<!-- ./row -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
$(document).ready(function() {
    set_data();
});

function set_data() {

    var product_id = <?php echo($product_id); ?> ;
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_product/get_product_by_id/"; ?>",
        data: {
            product_id: product_id
        },
        dataType: "json",
        success: function(data) {
            $("#product_id").val(data["product_id"]);
            $("#product_name_th_ip").val(data["product_name_th"]);
            $("#product_name_en_ip").val(data["product_name_en"]);
            $("#product_desc_ip").val(data["product_details"]);
            $("#product_sku_ip").val(data["product_sku"]);
            $("#producct_barcode_ip").val(data["product_barcode"]);
            $("#product_price_ip").val(data["product_retail_price"]);
            get_category_show(data["product_category_id"]);
            get_partner_show(data["product_partner_id"]);
            get_unit_show(data["product_unit_id"]);

            // $("#title_text").text(data["product_name_th"]);
            // $("#breadcrumb_text").text(data["product_name_th"]);

            $("#actionProductForm :input").prop("disabled", true);
        }
    });
}

function get_category_show(category_id) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/get_category_by_id/"; ?>",
        data: {
            category_id: category_id
        },
        dataType: "json",
        success: function(data) {
            $("#product_category_ip").val(data["category_name"]);
        }
    });
}
// get category show

function get_partner_show(partner_id) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/get_partner_by_id/"; ?>",
        data: {
            partner_id: partner_id
        },
        dataType: "json",
        success: function(data) {
            $("#product_supplier_ip").val("("+data["partner_brand_name"]+") "+data["partner_name_full"]);
        }
    });
}
// get partner show

function get_unit_show(unit_id) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/get_unit_by_id/"; ?>",
        data: {
            unit_id: unit_id
        },
        dataType: "json",
        success: function(data) {
            $("#product_unit_ip").val(data["unit_name_th"]+" ("+data["unit_name_en"]+")");
        }
    });
}

</script>