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
                    <form class="form-horizontal" id="actionProductForm" method="post">
                        <div class="card-body">
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
                                    <input type="text" class="form-control" name="product_sku_ip" id="product_sku_ip" placeholder="รหัสอ้างอิง" >
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
                            <button type="button" class="<?php echo ($this->config->item('btn_cancel')); ?>" onclick="reset_form('actionPartnerForm')"><?php echo ($this->config->item('txt_cancel')); ?></button>
                            <button type="button" class="<?php echo ($this->config->item('btn_save')); ?> float-right submit" onclick="add_product()"><?php echo ($this->config->item('txt_save')); ?></button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                    <!-- /.form -->
                </div>
                <!-- /.card -->
            </div>
            <!-- lg4 md7 sm12 -->

            <div class="col-md-12 col-sm-12 col-lg-7">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header_side')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">รายการบริษัทคู่ค้า </h3>
                    </div>
                    <div class="card-body">
                        <!-- body -->

                        <table id="partner_table" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">รหัสอ้างอิง</th>
                                    <th width="30%">ชื่อสินค้า</th>
                                    <th width="10%">หน่วยนับ</th>
                                    <th width="10%">ราคา (บาท)</th>
                                    <th width="20%">ดำเนินการ</th>
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
            <!-- lg7 md12 sm12 -->
        </div>
        <!-- ./row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
$(document).ready(function() {
    // datatable_show();
    opt_category();
    opt_partner();
    opt_unit();
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

function datatable_show() {
    // reset_form('actionPartnerForm');

    // $("#partner_table").dataTable({
    //     processing: true,
    //     bDestroy: true,
    //     language: {url: "<?php echo base_url().$this->config->item('template_path').'plugins/datatables/languages/Thai.json'?>"},
    //     ajax: {
    //         type: "POST",
    //         url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/get_partner_show/"; ?>",
    //         dataSrc: function(data) {
    //             var return_data = new Array();
    //             $(data).each(function(seq, data) {
    //                 return_data.push({
    //                     "ptr_seq": data.ptr_seq,
    //                     "ptr_Fname": data.ptr_Fname,
    //                     "ptr_brand_name": data.ptr_brand_name,
    //                     "ptr_action": data.ptr_action
    //                 });
    //             });
    //             console.log(return_data);
    //             return return_data;
    //         } //end dataSrc
    //     }, //end ajax
    //     columns: [
    //         {data: "ptr_seq"},
    //         {data: "ptr_Fname"},
    //         {data: "ptr_brand_name"},
    //         {data: "ptr_action"}
    //     ],
    //     columnDefs: [
    //         { orderable: false, targets: [-1,-2] }
    //     ]
    // });

}

function add_product() {

    var frm_id = actionProductForm;

    if ($(frm_id).valid()) {

    //     var partner_id = $("#partner_id").val();
    //     var partner_Fname = $("#partner_Fname_input").val();
    //     var partner_Sname = $("#partner_Sname_input").val();
    //     var partner_brand = $("#partner_brand_input").val();
    //     var partner_desc = $("#partner_desc").val();

    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/ajax_add_partner/"; ?>",
    //         data: {
    //             partner_id: partner_id,
    //             partner_Fname: partner_Fname,
    //             partner_Sname: partner_Sname,
    //             partner_brand: partner_brand,
    //             partner_desc: partner_desc
    //         },
    //         dataType: "json",
    //         success: function(data) {
    //             // console.log(data);
    //             messege_show(data);
    //             datatable_show(); //refresh datatable
    //         } // End success
    //     }); // End ajax
    }
}

function edit_partner(partner_id) {
    // $.ajax({
    //     type: "POST",
    //     url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/get_partner_by_id/"; ?>",
    //     data: {partner_id: partner_id},
    //     dataType: "json",
    //     success: function(data) {
    //         // console.log(data);
    //         $("#partner_id").val(data["partner_id"]);
    //         $("#partner_Fname_input").val(data["partner_name_full"]);
    //         $("#partner_Sname_input").val(data["partner_name_short"]);
    //         $("#partner_brand_input").val(data["partner_brand_name"]);
    //         $("#partner_desc").val(data["partner_desc"]);
    //     }
    // });
}

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