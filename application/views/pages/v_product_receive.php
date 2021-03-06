<?php include dirname(__FILE__) . "/../page_pos_main.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>รับสินค้าเข้าคลัง</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo site_url().$this->config->item('ctrl_path').'/Pos_store/mange_store'; ?>">จัดการคลังสินค้า</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url().$this->config->item('ctrl_path').'/Pos_store/product_receive_bill'; ?>">รับสินค้า</a></li>
                        <li class="breadcrumb-item active">บันทึกผล</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="<?php echo($this->config->item('icon_user')); ?>"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><strong>ผู้ตรวจนับ</strong></span>
                        <span class="info-box-text" id="span_resp_name">ชื่อชื่อ</span>
                    </div>
                </div>
                <!-- ./info-box -->
            </div>
            <!-- ./col -->
        </div>
        <!-- ./row -->

        <div class="row">
            <div class="col-md-7 col-sm-12 col-lg-4" id="div_save_product">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">บันทึกข้อมูลสินค้า</h3>
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

            <div class="col-md-12 col-sm-12 col-lg-8">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header_side')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">รายการสินค้า</h3>
                    </div>
                    <div class="card-body">
                        <!-- body -->
                        <table id="productReceive_table" class="table table-bordered table-striped dataTable table-responsive" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">รหัสอ้างอิง</th>
                                    <th width="20%">ชื่อสินค้า</th>
                                    <th width="10%">จำนวนรับ</th>
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
                    <div class="overlay dark" id="loading_datatables">
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
    validate();
    set_data();
    
});

function validate() {

    $("#ProductReceiveForm").validate({
        rules: {
            inventory_lot: {
                required: true,
                digits: true
            },
            inventory_qty: {
                required: true,
                number: true
            }
        },
        messages: {
            inventory_lot: {
                digits: "กรุณาใส่เลขจำนวนเต็ม"
            },
            inventory_qty: {
                number: "กรุณาใส่เลขจำนวนเต็มหรือทศนิยม"
            }
        }
    });

}
// jQuery validate

function opt_product_all() {
    $("option:first").remove();
    $('#inventory_lot').prop( "disabled", false );
    $('#inventory_produce').prop( "disabled", false );
    $('#inventory_exp').prop( "disabled", false );

    var invb_id = <?php echo($invb_id); ?>


    $('#inventory_product_name').select2({
        ajax: {
            type: "POST",
            dataType: 'json',
            // data: invb_id,
            url: '<?php echo site_url().$this->config->item('ctrl_path')."/Pos_product/get_product_opt_not_use/"; ?>',
            // delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term, // search term
                    invb_id
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true,
            width: "100%"
        },
        language: "th",
        placeholder: "เลือกสินค้า",
    });
}
// opt category select2 can search

function set_data() {

    var invb_id = <?php echo($invb_id); ?>
    
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_invb_by_id/"; ?>",
        data: {invb_id: invb_id},
        dataType: "json",
        success: function(data) {
            console.log(data);
            $('#span_resp_name').text(data['invb_responsible']);
            opt_product_all();
            $("#loading_input").remove();
            datatableProductIn();
        } // End success
    }); // End ajax
}
// set_data

function save_product_qty() {

    var frm_id = ProductReceiveForm;
    var invb_id = <?php echo($invb_id); ?>
    

    if ($(frm_id).valid()) {

        var inventory_id = $("#inventory_id").val();
        var inventory_product_name = $("#inventory_product_name").val();
        var inventory_lot = $("#inventory_lot").val();
        var inventory_produce = $("#inventory_produce").val();
        var inventory_exp = $("#inventory_exp").val();
        var inventory_qty = $("#inventory_qty").val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/ajax_add_product_qty/"; ?>",
            data: {
                inventory_id: inventory_id,
                inventory_product_name: inventory_product_name,
                inventory_lot: inventory_lot,
                inventory_produce: inventory_produce,
                inventory_exp: inventory_exp,
                inventory_qty: inventory_qty,
                invb_id:invb_id
            },
            dataType: "json",
            success: function(data) {
                messege_show(data);
                datatableProductIn();
            } // End success
        }); // End ajax
    }
    // add&edit product
}
// add_product_qty to db

function delete_product_qty(inventory_id) {
    swal.fire({
    title: 'คุณต้องการลบข้อมูลใช่หรือไม่ ?',
    text: "หากลบแล้วข้อมูลจะไม่สามารถกู้คืนได้อีก !",
    type: 'warning',
    confirmButtonText: '<?php echo $this->config->item('swal_cf_txt');?>',
    cancelButtonText: '<?php echo $this->config->item('swal_cc_txt');?>',
    showCancelButton: true,
    reverseButtons: true,
    confirmButtonColor: '#dc3545'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type : "POST",
                url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/ajax_del_product_qty/"; ?>",
                data : {inventory_id:inventory_id},
                dataType : "json",
                success : function(data){
                    datatableProductIn();
                    messege_show(data);
                }
            });//end ajax
        }
    });
}
// delete_product_qty

function datatableProductIn() {
    reset_form('ProductReceiveForm');
    var invb_id = <?php echo($invb_id); ?>

    $("#productReceive_table").dataTable({
        processing: true,
        bDestroy: true,
        language: {url: "<?php echo base_url().$this->config->item('template_path').'plugins/datatables/languages/Thai.json'?>"},
        ajax: {
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_product_in/"; ?>",
            data: {invb_id: invb_id},
            dataType: "json",
            dataSrc: function(data) {
                var return_data = new Array();
                $(data).each(function(seq, data) {
                    return_data.push({
                        "pdct_seq": data.pdct_seq,
                        "pdct_sku": data.pdct_sku,
                        "pdct_name": data.pdct_name,
                        "pdct_qty": data.pdct_qty,
                        "pdct_unit": data.pdct_unit,
                        "pdct_lot": data.pdct_lot,
                        "pdct_produce": data.pdct_produce,
                        "pdct_exp": data.pdct_exp,
                        "pdct_action": data.pdct_action
                    });
                });
                console.log(return_data);
                $("#loading_datatables").remove();
                return return_data;
            } //end dataSrc
        }, //end ajax
        columns: [
            {data: "pdct_seq"},
            {data: "pdct_sku"},
            {data: "pdct_name"},
            {data: "pdct_qty"},
            {data: "pdct_unit"},
            {data: "pdct_lot"},
            {data: "pdct_produce"},
            {data: "pdct_exp"},
            {data: "pdct_action"}
        ],
        columnDefs: [
            { orderable: false, targets: [-1,-4,-5,-6] }
        ]
    });
}
// datatableProductIn

function add_product_qty(inventory_id) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_inv_by_id/"; ?>",
        data: {inventory_id: inventory_id},
        dataType: "json",
        success: function(data) {
            console.log(data);
            $('#inventory_id').val("");
            $('#inventory_lot').val(data["inventory_lot"]);
            $('#inventory_lot').prop( "disabled", true );
            $('#inventory_produce').val(data["inventory_produce"]);
            $('#inventory_produce').prop( "disabled", true );
            $('#inventory_exp').val(data["inventory_exp"]);
            $('#inventory_exp').prop( "disabled", true );
            get_product_opt_select(data["inventory_product_id"])
            $("#inventory_qty").focus();
        } // End success
    }); // End ajax
}
// add_product_qty

function edit_product_qty(inventory_id) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_inv_by_id/"; ?>",
        data: {inventory_id: inventory_id},
        dataType: "json",
        success: function(data) {
            console.log(data);
            $('#inventory_id').val(data["inventory_id"]);
            $('#inventory_lot').val(data["inventory_lot"]);
            $('#inventory_lot').prop( "disabled", false );
            $('#inventory_produce').val(data["inventory_produce"]);
            $('#inventory_produce').prop( "disabled", false );
            $('#inventory_exp').val(data["inventory_exp"]);
            $('#inventory_exp').prop( "disabled", false );
            get_product_opt_select(data["inventory_product_id"])
            $('#inventory_qty').val(data["inventory_qty"]);
            $("#inventory_qty").focus();
        } // End success
    }); // End ajax
}
// edit_product_qty

function get_product_opt_select(product_id) {
    $.ajax({
        type : "POST",
        url: '<?php echo site_url().$this->config->item('ctrl_path')."/Pos_product/get_product_opt_by_id/"; ?>',
        data : {product_id:product_id},
        dataType : "json",
        success : function(data){
            $("#inventory_product_name").html(data);
            $("#inventory_product_name").select2({minimumResultsForSearch: Infinity,language: "th",width: '100%'});
            $(".overlay").remove();
        }
    });
}
// get_product_opt_select



</script>