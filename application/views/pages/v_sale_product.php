<?php include dirname(__FILE__) . "/../page_pos_main.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ขายสินค้าหน้าร้าน (เงินสด)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">จัดการหลังร้าน</a></li>
                        <li class="breadcrumb-item active">จัดการคลังสินค้า</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        <input class="form-control form-control-lg" type="text" placeholder="ระบุชื่อสินค้า หรือบาร์โค้ด" id="select_product_show">
                        <input class="form-control" type="hidden" id="select_product_id">
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- ./card -->
                <div class="card">
                    <div class="card-body ">

                        <table class="table table-hover" id="product_table">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th style="display:none;">id</th>
                                    <th width="20%">ชื่อสินค้า</th>
                                    <th width="10%">จำนวน</th>
                                    <th width="10%">หน่วยนับ</th>
                                    <th width="10%">ราคา</th>
                                    <th width="10%">ราคารวม</th>
                                    <th width="10%">ดำเนินการ</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- table -->

                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- ./card -->
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-md-5 col-sm-12">

                <div class="info-box mb-3 bg-info">
                    <span class="mt-3">
                        <h3><b>ยอดรวม</b></h3>
                    </span>
                    <div class="info-box-content">
                        <h1><center><b>
                            <span class="info-box-number mt-2" id="text_total_price">
                                -
                            </span>
                        </b></center></h1>
                    </div>
                    <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                    <!-- /.info-box-content -->
                </div>
                <!-- ./info-box -->

                <div class="card card-outline card-danger">
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="inputBillno" class="col-sm-4 col-form-label">เลขที่บิล</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="bill_no" placeholder="เลขที่บิล" disabled>
                                </div>
                            </div>
                            <!-- ./row -->

                            <div class="form-group row">
                                <label for="inputSaleTime" class="col-sm-4 col-form-label">เวลาทำการขาย</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputSaleTime" placeholder="เวลาทำการขาย" disabled>
                                </div>
                            </div>
                            <!-- ./row -->

                            <div class="form-group row">
                                <label for="inputSeller" class="col-sm-4 col-form-label">ผู้ขาย</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputSeller" placeholder="ผู้ขาย" disabled>
                                </div>
                            </div>
                            <!-- ./row -->
                        </form>
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- ./card -->
            </div>
            <!-- ./col -->

        </div>
        <!-- ./row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
$(document).ready(function() {

    $("#select_product_show").autocomplete({
        source: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_product/get_prodect_opt_sale/"; ?>",
        select: function(event, ui) {

            if (ui.item.id == -1) {
                $("#select_product_show").addClass('is-invalid');
            }else{
                $("#select_product_show").removeClass('is-invalid');
                add_item(ui.item.id);
            }
            $("#select_product_id").val(ui.item.id);
        },
        autoFocus: true
    });
    // autocomplete
    check_data_empty();
    
    $("#sale_qty").focus(function (e) { 
        alert('focus');
        
    });

});

function add_item(product_id) {
    
    $.ajax({
        type: "POST",
        url: "<?php echo site_url().$this->config->item('ctrl_path')."/Pos_product/get_product_to_cart/"; ?>",
        data: {product_id : product_id},
        dataType: "JSON",
        success: function (response) {

            $("#select_product_show").val("");
            $("#select_product_show").focus();
             

            if ($("#product_table tbody tr").is('#tr_nodata')) {
                
                var html = '<tr>';
                    html += '<td>'+'1.'+'</td>';
                    html += '<td style="display:none;">'+response['product_id']+'</td>';
                    html += '<td>'+response['product_name_th']+'</td>';
                    html += '<td id="sale_qty" contenteditable onblur="change_qty('+response['product_id']+')">'+'1'+'</td>';
                    html += '<td><center>'+response['unit_name_th']+'</center></td>';
                    html += '<td><center><span class="badge bg-success" id="price_sale">'+response['product_retail_price']+'</span></center></td>';
                    html += '<td><center><span class="badge bg-primary" id="price_total">'+response['product_retail_price']+'</span></center></td>';
                    html += '<td><center><span class="badge badge-success" onclick="increase_qty('+response['product_id']+')"><i class="<?php echo($this->config->item('icon_increase')); ?>"></i></span> '+
                                        '<span class="badge badge-warning" onclick="decrease_qty('+response['product_id']+')"><i class="<?php echo($this->config->item('icon_decrease')); ?>"></i></span> '+
                                        '<span class="badge badge-danger" onclick="delete_item('+response['product_id']+')"><i class="<?php echo($this->config->item('icon_delete')); ?>"></i></span></center></td>';
                    html += '</tr>';

                $("#product_table tbody:last-child").html(html);
            }else{
                var found_data = false;

                $('#product_table tbody tr').each(function(index, tr) {
    
                    var product_id = $(this).find("td").eq(1).html(); 

                    if (response['product_id'] == product_id) {
                        var value_qty = $(this).find("td").eq(3).html();
                        value_qty = parseFloat(value_qty)+1;
                        $(this).find("td").eq(3).html(value_qty);
                        
                        var value_sale = $(this).find("#price_sale").text();
                        value_sale = parseFloat(value_sale);
                        var value_total = value_qty*value_sale;
                        $(this).find("#price_total").text(value_total);
                        found_data = true;

                    }

                });

                if (found_data == false) {
                    $("#product_table tbody:last-child").append(
                        '<tr>'+
                            '<td>'+set_number()+'</td>'+
                            '<td style="display:none;">'+response['product_id']+'</td>'+
                            '<td>'+response['product_name_th']+'</td>'+
                            '<td id="sale_qty" contenteditable onblur="change_qty('+response['product_id']+')">'+'1'+'</td>'+
                            '<td><center>'+response['unit_name_th']+'</center></td>'+
                            '<td><center><span class="badge bg-success" id="price_sale">'+response['product_retail_price']+'</span></center></td>'+
                            '<td><center><span class="badge bg-primary" id="price_total">'+response['product_retail_price']+'</span></center></td>'+
                            '<td><center><span class="badge badge-success" onclick="increase_qty('+response['product_id']+')"><i class="<?php echo($this->config->item('icon_increase')); ?>"></i></span> '+
                                        '<span class="badge badge-warning" onclick="decrease_qty('+response['product_id']+')"><i class="<?php echo($this->config->item('icon_decrease')); ?>"></i></span> '+
                                        '<span class="badge badge-danger" onclick="delete_item('+response['product_id']+')"><i class="<?php echo($this->config->item('icon_delete')); ?>"></i></span></center></td>'+
                        '</tr>'
                    );
                }

            }
            sum_total();
        }
    });
}
// add_item

function set_number() {
    var table_len = $("#product_table tbody tr").length;
    // console.log(table_len);
    return table_len+1+'.';
}
// set_number for item seq

function check_data_empty() {
    var table_len = $("#product_table tbody tr").length;
    if (table_len == 0) {
        $("#product_table tbody:last-child").append(
            '<tr id="tr_nodata">'+
                '<td colspan="7"><center>ไม่มีสินค้าในตะกร้า</center></td>'+
            '</tr>'
        );
    }
}
// check_data_empty

function increase_qty(product_id) {
    $('#product_table tbody tr').each(function(index, tr) {
        var product_id_set = $(this).find("td").eq(1).html(); 

        if (product_id == product_id_set) {
            var value_qty = $(this).find("td").eq(3).html();
            value_qty = parseFloat(value_qty)+1;
            $(this).find("td").eq(3).html(value_qty);
            
            var value_sale = $(this).find("#price_sale").text();
            value_sale = parseFloat(value_sale);
            var value_total = value_qty*value_sale;
            $(this).find("#price_total").text(value_total);

        }

    });
    sum_total();
}
// increase_qty

function decrease_qty(product_id) {
    $('#product_table tbody tr').each(function(index, tr) {
        var product_id_set = $(this).find("td").eq(1).html(); 

        if (product_id == product_id_set) {
            var value_qty = $(this).find("td").eq(3).html();
            value_qty = parseFloat(value_qty)-1;
            $(this).find("td").eq(3).html(value_qty);
            
            var value_sale = $(this).find("#price_sale").text();
            value_sale = parseFloat(value_sale);
            var value_total = value_qty*value_sale;
            $(this).find("#price_total").text(value_total);

            if (parseFloat(value_qty) < 1) {
                value_qty = 0;
                $(this).find("td").eq(3).html(value_qty);
                $(this).find("#price_total").text(value_qty);
                delete_item(product_id);
            }
            // ถ้า <= 1 เรียก fn del

        }

    });
    sum_total();
}
// decrease_qty

function change_qty(product_id) {
    $('#product_table tbody tr').each(function(index, tr) {
        var product_id_set = $(this).find("td").eq(1).html(); 

        if (product_id == product_id_set) {
            var value_qty = $(this).find("td").eq(3).html();

            if ($.isNumeric(value_qty)) {
                if (parseFloat(value_qty) <= 0) {
                    delete_item(product_id);
                }
                // ตรวจสอบค่าต่ำกว่าหรือเท่ากับ 0
            }else {
                value_qty = 1.0;
            }
            // ใช่ตัวเลขหรือไม่
            value_qty = parseFloat(value_qty);
            $(this).find("td").eq(3).html(value_qty);
            
            var value_sale = $(this).find("#price_sale").text();
            value_sale = parseFloat(value_sale);
            var value_total = value_qty*value_sale;
            $(this).find("#price_total").text(value_total);

        }

    });
    sum_total();
}
// change_qty

function delete_item(product_id) {
    var num_row = 1;
    $('#product_table tbody tr').each(function(index, tr) {
    
        var product_id_check = $(this).find("td").eq(1).html(); 

        if (product_id == product_id_check) {
            $(tr).remove();
        }
        // check tr ที่จะลบ

    });
    $('#product_table tbody tr').each(function(index, tr) {
    
        $(this).find("td").eq(0).html(num_row); 
        num_row++;

    });
    sum_total();
    check_data_empty();
}
// delete_item

function sum_total() {
    tr_length = $("#product_table tbody tr").length;
    
    var price_total = parseFloat(0);
    if (tr_length < 1) {
        price_total = 0;
    }else{
        $('#product_table tbody tr').each(function(index, tr) {
        
            price_total += parseFloat($(this).find("#price_total").text());
    
        });
    }
    
    $("#text_total_price").text(price_total);
    $("#text_total_price").digits();
}
// sum_total

</script>

<style>

#sale_qty{
    text-align: center;
}

</style>