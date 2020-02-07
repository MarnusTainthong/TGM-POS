<?php include dirname(__FILE__) . "/../page_pos_main.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ตั้งค่าหน่วยนับ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">ตั้งค่า</a></li>
                        <li class="breadcrumb-item active">หน่วยนับ</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-6 col-sm-12 col-lg-3">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">จัดการข้อมูลหน่วยนับ</h3>
                    </div>
                    <form class="form-horizontal" id="actionUnitForm" method="post">
                        <div class="card-body">
                            <input type="hidden" class="form-control" id="unit_id" disabled>
                            <div class="form-group row">
                                <label for="unit_name_th_input" class="col-sm-5 col-form-label">ชื่อหน่วยนับภาษาไทย <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="unit_name_th_input" id="unit_name_th_input" placeholder="ใส่ชื่อหน่วยนับภาษาไทย" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit_name_en_input" class="col-sm-5 col-form-label">ชื่อหน่วยนับภาษาอังกฤษ <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="unit_name_en_input" id="unit_name_en_input" placeholder="ใส่หน่วยนับภาษาอังกฤษ" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="<?php echo ($this->config->item('btn_cancel')); ?>" onclick="reset_form('actionUnitForm')"><?php echo ($this->config->item('txt_cancel')); ?></button>
                            <button type="button" class="<?php echo ($this->config->item('btn_save')); ?> float-right submit" onclick="add_unit()"><?php echo ($this->config->item('txt_save')); ?></button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                    <!-- /.form -->
                </div>
                <!-- /.card -->
            </div>
            <!-- ls3 md6 sm12 -->

            <div class="col-md-12 col-sm-12 col-lg-5">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header_side')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">รายการหน่วยนับ</h3>
                    </div>
                    <div class="card-body">
                        <!-- body -->

                        <table id="unit_table" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10%">ลำดับ</th>
                                    <th>ชื่อภาษาไทย</th>
                                    <th>ชื่อภาษาอังกฤษ</th>
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
            <!-- md6 sm12 -->
        </div>
        <!-- ./row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
$(document).ready(function() {
    datatable_show();
});


function datatable_show() {
    reset_form('actionUnitForm');

    $("#unit_table").dataTable({
        processing: true,
        bDestroy: true,
        language: {url: "<?php echo base_url().$this->config->item('template_path').'plugins/datatables/languages/Thai.json'?>"},
        ajax: {
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/get_unit_show/"; ?>",
            dataSrc: function(data) {
                var return_data = new Array();
                $(data).each(function(seq, data) {
                    return_data.push({
                        "unt_seq": data.unt_seq,
                        "unt_name_th": data.unt_name_th,
                        "unt_name_en": data.unt_name_en,
                        "unt_action": data.unt_action
                    });
                });
                console.log(return_data);
                return return_data;
            } //end dataSrc
        }, //end ajax
        columns: [
            {data: "unt_seq"},
            {data: "unt_name_th"},
            {data: "unt_name_en"},
            {data: "unt_action"}
        ],
        columnDefs: [
            { orderable: false, targets: [-1,-2,-3] }
        ]
    });

}

function add_unit() {

    var frm_id = actionUnitForm;

    if ($(frm_id).valid()) {

        var unit_id = $("#unit_id").val();
        var unit_name_th = $("#unit_name_th_input").val();
        var unit_name_en = $("#unit_name_en_input").val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/ajax_add_unit/"; ?>",
            data: {
                unit_id: unit_id,
                unit_name_th: unit_name_th,
                unit_name_en: unit_name_en
            },
            dataType: "json",
            success: function(data) {
                // console.log(data);
                messege_show(data);
                datatable_show(); //refresh datatable
            } // End success
        }); // End ajax
    }
}

function edit_unit(unit_id) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/get_unit_by_id/"; ?>",
        data: {unit_id: unit_id},
        dataType: "json",
        success: function(data) {
            // console.log(data);
            $("#unit_id").val(data["unit_id"]);
            $("#unit_name_th_input").val(data["unit_name_th"]);
            $("#unit_name_en_input").val(data["unit_name_en"]);
        }
    });
}

function delete_unit(unit_id) {

    
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
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/ajax_del_unit/"; ?>",
            data : {unit_id:unit_id},
            dataType : "json",
            success : function(data){
                datatable_show();
                messege_show(data);
            }
        });//end ajax
    }
});



}
</script>