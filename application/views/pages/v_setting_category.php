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
                    <form class="form-horizontal" id="actionCategoryForm" method="post">
                        <div class="card-body">
                            <input type="hidden" class="form-control" id="category_id" disabled>
                            <div class="form-group row">
                                <label for="category_name_input" class="col-sm-4 col-form-label">ชื่อประเภทสินค้าภาษาไทย</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="category_name_input" id="category_name_input" placeholder="ใส่ชื่อประเภทสินค้า" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="<?php echo ($this->config->item('btn_cancel')); ?>" onclick="reset_form('actionCategoryForm')"><?php echo ($this->config->item('txt_cancel')); ?></button>
                            <button type="button" class="<?php echo ($this->config->item('btn_save')); ?> float-right submit" onclick="add_category()"><?php echo ($this->config->item('txt_save')); ?></button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                    <!-- /.form -->
                </div>
                <!-- /.card -->
            </div>
            <!-- md6 sm12 -->

            <div class="col-md-5 col-sm-12">
                <!-- Default box -->
                <div class="<?php echo ($this->config->item('card_header_side')); ?>">
                    <div class="card-header">
                        <h3 class="card-title">รายการประเภทสินค้า</h3>
                    </div>
                    <div class="card-body">
                        <!-- body -->

                        <table id="category_table" class="table table-bordered table-striped dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10%">ลำดับ</th>
                                    <th>ชื่อประเภทสินค้า</th>
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
    // $('#category_table').DataTable();
    datatable_show();

});


function datatable_show() {
    
    $("#category_table").dataTable({
        processing: true,
        bDestroy: true,
        ajax:{
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/get_category_show/"; ?>",
            dataSrc : function(data){
                var return_data = new Array();
                $(data).each(function(seq, data ) {
				    return_data.push({
                       "ctg_seq" : data.ctg_seq,
                       "ctg_name" : data.ctg_name,
                       "ctg_action" : data.ctg_action
                   });
                });
                console.log(return_data);             
                return return_data;
            }//end dataSrc
    }, //end ajax
    "columns" :[
        {"data": "ctg_seq"},
        {"data": "ctg_name"},
        {"data": "ctg_action"}
    ]
    });

}

function add_category() {

    var frm_id = category_name_input;

    if ($(frm_id).valid()) {
        var category_name = $("#category_name_input").val();
        var category_id = $("#category_id").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/ajax_add_category/"; ?>",
            data: {
                category_name: category_name,
                category_id: category_id
            },
            dataType: "json",
            success: function(data) {
               console.log(data);
               messege_show(data);
               datatable_show(); //regresh datatable
            } // End success
        }); // End ajax

    }

}
</script>