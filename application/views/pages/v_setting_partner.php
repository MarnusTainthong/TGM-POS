<?php include dirname(__FILE__) . "/../page_pos_main.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ตั้งค่าบริษัทคู่ค้า</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">ตั้งค่า</a></li>
                        <li class="breadcrumb-item active">บริษัทคู่ค้า</li>
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
                        <h3 class="card-title">จัดการข้อมูลบริษัทคู่ค้า </h3>
                    </div>
                    <form class="form-horizontal" id="actionPartnerForm" method="post">
                        <div class="card-body">
                            <input type="hidden" class="form-control" id="partner_id" disabled>
                            <div class="form-group row">
                                <label for="partner_Fname_input" class="col-sm-5 col-form-label">ชื่อเต็มบริษัทคู่ค้า <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="partner_Fname_input" id="partner_Fname_input" placeholder="ชื่อเต็มบริษัทคู่ค้า" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="partner_Sname_input" class="col-sm-5 col-form-label">ชื่อย่อบริษัทคู่ค้า <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="partner_Sname_input" id="partner_Sname_input" placeholder="ชื่อย่อบริษัทคู่ค้า" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="partner_brand_input" class="col-sm-5 col-form-label">ชื่อแบรนด์ <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="partner_brand_input" id="partner_brand_input" placeholder="ชื่อแบรนด์" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="partner_desc" class="col-sm-5 col-form-label">รายละเอียด</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="partner_desc" id="partner_desc" rows="2" placeholder="รายลเอียด"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="<?php echo ($this->config->item('btn_cancel')); ?>" onclick="reset_form('actionPartnerForm')"><?php echo ($this->config->item('txt_cancel')); ?></button>
                            <button type="button" class="<?php echo ($this->config->item('btn_save')); ?> float-right submit" onclick="add_partner()"><?php echo ($this->config->item('txt_save')); ?></button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                    <!-- /.form -->
                </div>
                <!-- /.card -->
            </div>
            <!-- lg4 md7 sm12 -->

            <div class="col-md-12 col-sm-12 col-lg-6">
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
                                    <th width="10%">ลำดับ</th>
                                    <th width="30%">ชื่อบริษัท</th>
                                    <th width="20%">ชื่อแบรนด์</th>
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
    reset_form('actionPartnerForm');

    $("#partner_table").dataTable({
        processing: true,
        bDestroy: true,
        language: {url: "<?php echo base_url().$this->config->item('template_path').'plugins/datatables/languages/Thai.json'?>"},
        ajax: {
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/get_partner_show/"; ?>",
            dataSrc: function(data) {
                var return_data = new Array();
                $(data).each(function(seq, data) {
                    return_data.push({
                        "ptr_seq": data.ptr_seq,
                        "ptr_Fname": data.ptr_Fname,
                        "ptr_brand_name": data.ptr_brand_name,
                        "ptr_action": data.ptr_action
                    });
                });
                console.log(return_data);
                return return_data;
            } //end dataSrc
        }, //end ajax
        columns: [
            {data: "ptr_seq"},
            {data: "ptr_Fname"},
            {data: "ptr_brand_name"},
            {data: "ptr_action"}
        ],
        columnDefs: [
            { orderable: false, targets: [-1,-2] }
        ]
    });

}

function add_partner() {

    var frm_id = actionPartnerForm;

    if ($(frm_id).valid()) {

        var partner_id = $("#partner_id").val();
        var partner_Fname = $("#partner_Fname_input").val();
        var partner_Sname = $("#partner_Sname_input").val();
        var partner_brand = $("#partner_brand_input").val();
        var partner_desc = $("#partner_desc").val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/ajax_add_partner/"; ?>",
            data: {
                partner_id: partner_id,
                partner_Fname: partner_Fname,
                partner_Sname: partner_Sname,
                partner_brand: partner_brand,
                partner_desc: partner_desc
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

function edit_partner(partner_id) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/get_partner_by_id/"; ?>",
        data: {partner_id: partner_id},
        dataType: "json",
        success: function(data) {
            // console.log(data);
            $("#partner_id").val(data["partner_id"]);
            $("#partner_Fname_input").val(data["partner_name_full"]);
            $("#partner_Sname_input").val(data["partner_name_short"]);
            $("#partner_brand_input").val(data["partner_brand_name"]);
            $("#partner_desc").val(data["partner_desc"]);
        }
    });
}

function delete_partner(partner_id) {
    
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
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/ajax_del_partner/"; ?>",
            data : {partner_id:partner_id},
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