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
                        <li class="breadcrumb-item active">รับสินค้า</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-2 col-md-6 col-sm6">

                <div class="card card-info card-outline">
                    <div class="card-body">
                        <p class="card-text">
                            <button type="button" class="btn btn-lg btn-primary" onclick="show_dialog()"><i class="<?php echo($this->config->item('icon_add')); ?>"></i> เพิ่มบิลรับสินค้า</button>
                        </p>
                    </div>
                </div>


            </div>
            <!-- ./lg4 md6 sm4 -->
        </div>
        <!-- ./row -->

        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-6">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header_side')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">รายการบิลรับสินค้า</h3>
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
    datatable_show();
});

async function show_dialog() {
    const { value: checker_name } = await Swal.fire({
        title: 'กรุณาใส่ชื่อผู้ตรวจนับ',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: '<?php echo $this->config->item('swal_cf_txt');?>',
        cancelButtonText: '<?php echo $this->config->item('swal_cc_txt');?>',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: '#218838',
        inputValidator: (value) => {
            if (!value) {
                return 'กรุณาใส่ชื่อผู้ตรวจนับ'
            }
        }
    })
    if (checker_name) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/ajax_add_inv_bill/"; ?>",
            data: { checker_name: checker_name },
            dataType: "json",
            success: function(data) {
                messege_show(data);
                console.log(data);
                datatable_show();
            } // End success
        }); // End ajax
    } // if
}
// show_dialog

function datatable_show(){
    $("#productReceive_table").dataTable({
        processing: true,
        bDestroy: true,
        language: {url: "<?php echo base_url().$this->config->item('template_path').'plugins/datatables/languages/Thai.json'?>"},
        ajax: {
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_invb_show/"; ?>",
            dataSrc: function(data) {
                var return_data = new Array();
                $(data).each(function(seq, data) {
                    return_data.push({
                        "invb_seq": data.invb_seq,
                        "invb_bill_no": data.invb_bill_no,
                        "invb_resp": data.invb_resp,
                        "invb_date": data.invb_date,
                        "invb_action": data.invb_action
                    });
                    $(".overlay").remove();
                });
                console.log(return_data);
                return return_data;
            } //end dataSrc
        }, //end ajax
        columns: [
            {data: "invb_seq"},
            {data: "invb_bill_no"},
            {data: "invb_resp"},
            {data: "invb_date"},
            {data: "invb_action"}
        ],
        columnDefs: [
            { orderable: false, targets: [-1,-2,-3,-4] }
        ]
    });
}
// datatable_show

 function edit_resp(invb_id) {

    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/get_invb_by_id/"; ?>",
        data: {invb_id: invb_id},
        dataType: "json",
        success: function(data) {
            console.log(data);
            edit_resp_with_alert(data['invb_id'],data['invb_responsible'])
        }//success
    }); //ajax
    
}

async function edit_resp_with_alert(invb_id,invb_resp) {
    const { value: checker_name } = await Swal.fire({
        title: 'กรุณาใส่ชื่อผู้ตรวจนับ',
        input: 'text',
        inputValue: invb_resp,
        showCancelButton: true,
        confirmButtonText: '<?php echo $this->config->item('swal_cf_txt');?>',
        cancelButtonText: '<?php echo $this->config->item('swal_cc_txt');?>',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: '#218838',
        inputValidator: (value) => {
            if (!value) {
                return 'กรุณาใส่ชื่อผู้ตรวจนับ'
            }
        }
    })
    if (checker_name) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_store/ajax_add_inv_bill/"; ?>",
            data: {checker_name:checker_name,invb_id:invb_id },
            dataType: "json",
            success: function(data) {
                console.log(data);
                messege_show(data);
                datatable_show();
            } // End success
        }); // End ajax
    } // if
}
// edit_resp_with_alert

</script>