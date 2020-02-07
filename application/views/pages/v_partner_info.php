<?php include dirname(__FILE__) . "/../page_pos_main.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><span id="title_text">company name</span></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">ตั้งค่า</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url().$this->config->item('ctrl_path').'/Pos_setting/set_partner'; ?>">บริษัทคู่ค้า</a></li>
                        <li class="breadcrumb-item active"><span id="breadcrumb_text">company name</span></li>
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
                        <h3 class="card-title">ข้อมูลบริษัทคู่ค้า </h3>
                    </div>
                    <form class="form-horizontal" id="actionPartnerForm" method="post">
                        <div class="card-body">
                            <input type="hidden" class="form-control" id="partner_id" disabled>
                            <div class="form-group row">
                                <label for="partner_Fname_input" class="col-sm-5 col-form-label">ชื่อเต็มบริษัทคู่ค้า <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="partner_Fname_input" id="partner_Fname_input" placeholder="ชื่อเต็มบริษัทคู่ค้า">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="partner_Sname_input" class="col-sm-5 col-form-label">ชื่อย่อบริษัทคู่ค้า <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="partner_Sname_input" id="partner_Sname_input" placeholder="ชื่อย่อบริษัทคู่ค้า">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="partner_brand_input" class="col-sm-5 col-form-label">ชื่อแบรนด์ <?php echo($this->config->item('formMark')); ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="partner_brand_input" id="partner_brand_input" placeholder="ชื่อแบรนด์">
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
                        </div>
                        <!-- /.card-footer -->
                    </form>
                    <!-- /.form -->
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

    var partner_id = <?php echo($partner_id); ?>;
    $.ajax({
        type : "POST",
        url : "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_setting/get_partner_by_id/"; ?>",
        data : {partner_id:partner_id},
        dataType : "json",
        success : function(data){
            $("#partner_id").val(data["partner_id"]);
            $("#partner_Fname_input").val(data["partner_name_full"]);
            $("#partner_Sname_input").val(data["partner_name_short"]);
            $("#partner_brand_input").val(data["partner_brand_name"]);
            $("#partner_desc").val(data["partner_desc"]);

            $("#title_text").text(data["partner_name_full"]);
            $("#breadcrumb_text").text(data["partner_name_full"]);
            
            $("#actionPartnerForm :input").prop("disabled",true);
        }
    });

    
}

</script>