<?php include dirname(__FILE__) . "/../page_pos_main.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>จัดการสินค้า</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">จัดการหลังร้าน</a></li>
                        <li class="breadcrumb-item active">จัดการสินค้า</li>
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
                        <h3 class="card-title">จัดการข้อมูลสินค้า</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" id="actionProductForm" method="post">
                            <input type="hidden" class="form-control" id="product_id" disabled>
                            <div class="form-group row">
                                <label for="product_name_th_ip" class="col-sm-5 col-form-label">ชื่อสินค้าภาษาไทย <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="product_name_th_ip" id="product_name_th_ip" placeholder="ชื่อสินค้าภาษาไทย" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_name_en_ip" class="col-sm-5 col-form-label">ชื่อสินค้าภาษาอังกฤษ <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="product_name_en_ip" id="product_name_en_ip" placeholder="ชื่อสินค้าภาษาอังกฤษ" required>
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
                                    <!-- <input type="text" class="form-control" name="product_category_ip" id="product_category_ip" placeholder="หมวดหมู่สินค้า" required> -->
                                    <select name="product_category_ip" id="product_category_ip" class="form-control" required></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_price_ip" class="col-sm-5 col-form-label">ราคาขาย (บาท) <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="product_price_ip" id="product_price_ip" placeholder="ราคาขาย (บาท)" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_supplier_ip" class="col-sm-5 col-form-label">ตัวแทนจำหน่าย <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <select name="product_supplier_ip" id="product_supplier_ip" class="form-control" required></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_unit" class="col-sm-5 col-form-label">หน่วยนับ <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <select name="product_unit_ip" id="product_unit_ip" class="form-control" required></select>

                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="<?php echo ($this->config->item('btn_cancel')); ?>" onclick="reset_form('actionProductForm')"><?php echo ($this->config->item('txt_cancel')); ?></button>
                        <button type="button" class="<?php echo ($this->config->item('btn_save')); ?> float-right submit" onclick="add_product()"><?php echo ($this->config->item('txt_save')); ?></button>
                    </div>
                    <!-- /.card-footer -->
                    </form>
                    <!-- /.form -->
                </div>
                <!-- /.card -->
            </div>
            <!-- lg4 md7 sm12 -->

            <div class="col-md-12 col-sm-12 col-lg-8">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header_side')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">รายการบริษัทคู่ค้า </h3>
                    </div>
                    <div class="card-body">
                        <!-- body -->

                        <div class="overlay dark">
                            <i class="fas fa-2x fa-sync-alt"></i>
                        </div>

                        <table id="product_table" class="table table-bordered table-striped dataTable table-responsive" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">รหัสอ้างอิง</th>
                                    <th width="20%">ชื่อสินค้า</th>
                                    <th width="10%">หน่วยนับ</th>
                                    <th width="5%">ราคา (บาท)</th>
                                    <th width="5%">บาร์โค๊ด</th>
                                    <th width="15%">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- table -->
                    </div>
                    <!-- /.card-body -->
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
    datatable_show();
    opt_category();
    opt_partner();
    opt_unit();
    validate();
});

function opt_category() {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_category_opt/"; ?>",
        dataType: "json",
        success: function (response) {
            $("#product_category_ip").html(response);
        }
    });
}
// opt category

function opt_partner() {
    $.ajax({
        type : "POST",
        url : "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_partner_opt/"; ?>",
        dataType : "json",
        success : function(data){
            $("#product_supplier_ip").html(data);
        }
    });
}
// opt supplier

function opt_unit() {
    $.ajax({
        type: "POST",
        url : "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_unit_opt/"; ?>",
        dataType: "json",
        success: function (response) {
            $("#product_unit_ip").html(response);
        }
    });
}
// opt unit

function validate() {
    jQuery.validator.addMethod("pdct_name_thRegex", function(value, element) {
        // return this.optional(element) || /^[a-z]+$/g.test(value);
        return this.optional(element) || /^[ก-๏()*0-9\s]+$/g.test(value);
    }, "กรุณาใส่ชื่อสินค้าภาษาไทย ใส่ () * ได้");
    jQuery.validator.addMethod("pdct_name_enRegex", function(value, element) {
        // return this.optional(element) || /^[a-z]+$/g.test(value);
        return this.optional(element) || /^[a-zA-z()*0-9\s]+$/g.test(value);
    }, "กรุณาใส่ชื่อสินค้าภาษาอังกฤษ ใส่ () * ได้");

    $("#actionProductForm").validate({
        rules: {
            product_name_th_ip: { 
                required: true,
                pdct_name_thRegex: true 
            },
            product_name_en_ip: { 
                required: true,
                pdct_name_enRegex: true 
            },
            product_price_ip: { 
                required: true,
                number: true
            }
         },
         messages: {
            product_name_th_ip: { lettersonly: "กรุณาใส่ชื่อสินค้าภาษาไทย" },
            product_name_en_ip: { lettersonly: "กรุณาใส่ชื่อสินค้าภาษาอังกฤษ" },
            product_price_ip: { number: "กรุณาใส่ตัวเลขหรือทศนิยม" }
         }
    });
}

function datatable_show() {
    reset_form('actionProductForm');

    $("#product_table").dataTable({
        processing: true,
        bDestroy: true,
        language: {url: "<?php echo base_url().$this->config->item('template_path').'plugins/datatables/languages/Thai.json'?>"},
        ajax: {
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_product_show/"; ?>",
            dataSrc: function(data) {
                var return_data = new Array();
                $(data).each(function(seq, data) {
                    return_data.push({
                        "pdct_seq": data.pdct_seq,
                        "pdct_sku": data.pdct_sku,
                        "pdct_name": data.pdct_name,
                        "pdct_unit": data.pdct_unit,
                        "pdct_price": data.pdct_price,
                        "pdct_barcode": data.pdct_barcode,
                        "pdct_action": data.pdct_action
                    });
                    $(".overlay").remove();
                });
                console.log(return_data);
                return return_data;
            } //end dataSrc
        }, //end ajax
        columns: [
            {data: "pdct_seq"},
            {data: "pdct_sku"},
            {data: "pdct_name"},
            {data: "pdct_unit"},
            {data: "pdct_price"},
            {data: "pdct_barcode"},
            {data: "pdct_action"}
        ],
        columnDefs: [
            { orderable: false, targets: [-1,-2,-3,-4] }
        ]
    });

}

function add_product() {

    var frm_id = actionProductForm;

    if ($(frm_id).valid()) {

        var product_id = $("#product_id").val();
        var product_name_th = $("#product_name_th_ip").val();
        var product_name_en = $("#product_name_en_ip").val();
        var product_desc = $("#product_desc_ip").val();
        var product_sku = $("#product_sku_ip").val();
        var producct_barcode = $("#producct_barcode_ip").val();
        var product_category = $("#product_category_ip").val();
        var product_price = $("#product_price_ip").val();
        var product_supplier = $("#product_supplier_ip").val();
        var product_unit = $("#product_unit_ip").val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/ajax_add_product/"; ?>",
            data: {
                product_id: product_id,
                product_name_th: product_name_th,
                product_name_en: product_name_en,
                product_desc: product_desc,
                product_sku: product_sku,
                producct_barcode: producct_barcode,
                product_category: product_category,
                product_price: product_price,
                product_supplier: product_supplier,
                product_unit: product_unit
            },
            dataType: "json",
            success: function(data) {
                messege_show(data);
                datatable_show();
            } // End success
        }); // End ajax
    }
}

function edit_product(product_id) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_product_by_id/"; ?>",
        data: {product_id: product_id},
        dataType: "json",
        success: function(data) {
            $("#product_id").val(data["product_id"]);
            $("#product_name_th_ip").val(data["product_name_th"]);
            $("#product_name_en_ip").val(data["product_name_en"]);
            $("#product_desc_ip").val(data["product_details"]);
            $("#product_sku_ip").val(data["product_sku"]);
            $("#producct_barcode_ip").val(data["product_barcode"]);
            $("#product_price_ip").val(data["product_retail_price"]);
            //dropdown select
            select_opt_category(data["product_category_id"]);
            select_opt_partner(data["product_partner_id"]);
            select_opt_unit(data["product_unit_id"]);
        }
    });
}
// edit_product

function select_opt_category(ctg_id) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_category_opt_select/"; ?>",
        data: {ctg_id:ctg_id},
        dataType: "json",
        success: function (response) {
            $("#product_category_ip").html(response);
        }
    });
}
// select_opt_category

function select_opt_partner(ptr_id) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_partner_opt_select/"; ?>",
        data: {ptr_id:ptr_id},
        dataType: "json",
        success: function (response) {
            $("#product_supplier_ip").html(response);
        }
    });
}
// select_opt_partner

function select_opt_unit(unt_id) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_unit_opt_select/"; ?>",
        data: {unt_id:unt_id},
        dataType: "json",
        success: function (response) {
            $("#product_unit_ip").html(response);
        }
    });
}
// select opt unit

function delete_partner(partner_id) {
    
// swal.fire({
//     title: 'คุณต้องการลบข้อมูลใช่หรือไม่ ?',
//     text: "หากลบแล้วข้อมูลจะไม่สามารถกู้คืนได้อีก !",
//     type: 'warning',
//     confirmButtonText: '<?php echo $this->config->item('swal_cf_txt');?>',
//     cancelButtonText: '<?php echo $this->config->item('swal_cc_txt');?>',
//     showCancelButton: true,
//     reverseButtons: true,
//     confirmButtonColor: '#dc3545'
// }).then((result) => {
//     if (result.value) {
//         $.ajax({
//             type : "POST",
//             url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/ajax_del_partner/"; ?>",
//             data : {partner_id:partner_id},
//             dataType : "json",
//             success : function(data){
//                 datatable_show();
//                 messege_show(data);
//             }
//         });//end ajax
//     }
// });

}
</script>