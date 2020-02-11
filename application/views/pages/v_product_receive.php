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
                        <li class="breadcrumb-item"><a href="#">จัดการคลังสินค้า</a></li>
                        <li class="breadcrumb-item active">รับสินค้า</li>
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
                        <button type="button" class="<?php echo ($this->config->item('btn_cancel')); ?>" onclick="reset_form('actionProductForm')"><?php echo ($this->config->item('txt_cancel')); ?></button>
                        <button type="button" class="<?php echo ($this->config->item('btn_save')); ?> float-right submit" onclick="add_product_inv()"><?php echo ($this->config->item('txt_save')); ?></button>
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

    validate();
    opt_product_all();
    datatableProductIn();
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

    $('#inventory_product_name').select2({
        ajax: {
            type: "POST",
            dataType: 'json',
            url: '<?php echo site_url().$this->config->item('ctrl_path')."/Pos_product/get_product_opt/"; ?>',
            // delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term // search term
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
    });
}
// opt category select2 can search

function add_product_inv() {

    var frm_id = ProductReceiveForm;

    if ($(frm_id).valid()) {

        var inventory_id = $("#inventory_id").val();
        var inventory_product_name = $("#inventory_product_name").val();
        var inventory_lot = $("#inventory_lot").val();
        var inventory_produce = $("#inventory_produce").val();
        var inventory_exp = $("#inventory_exp").val();
        var inventory_qty = $("#inventory_qty").val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/ajax_add_product_inv/"; ?>",
            data: {
                inventory_id: inventory_id,
                inventory_product_name: inventory_product_name,
                inventory_lot: inventory_lot,
                inventory_produce: inventory_produce,
                inventory_exp: inventory_exp,
                inventory_qty: inventory_qty
            },
            dataType: "json",
            success: function(data) {
                messege_show(data);
                datatable_show();
            } // End success
        }); // End ajax
    }
    // add&edit product
}
// add_product_inv

function datatableProductIn() {
    reset_form('ProductReceiveForm');

    $("#productReceive_table").dataTable({
        processing: true,
        bDestroy: true,
        language: {url: "<?php echo base_url().$this->config->item('template_path').'plugins/datatables/languages/Thai.json'?>"},
        ajax: {
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_product_in/"; ?>",
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
                
                // messege_show(data);
                // datatable_show();
            } // End success
        }); // End ajax
}
// add_product_qty

</script>