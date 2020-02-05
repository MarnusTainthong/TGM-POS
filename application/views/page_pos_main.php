<script>

$(document).ready(function() {
    // $('[data-toggle="tooltip"]').tooltip();
});

function reset_form(form) {
    document.getElementById(form).reset();
    // set_form_ready(form)
    $('input').val("");

    $(":input.form-control").removeClass("error valid");
    $("label.error").remove();

}
// reset form

function messege_show(state) {
    if (state["action_status"] == 1) {
        Swal.fire('บันทึกข้อมูลสำเร็จ', 'บันทึกข้อมูลเข้าสู่ระบบเรียบร้อยแล้ว', 'success')
    } else if (state["action_status"] == 2) {
        Swal.fire('บันทึกข้อมูลไม่สำเร็จ', 'การบันทึกพบข้อผิดพลาดไม่สามารถบันทึกได้', 'warning')
    } else if (state["action_status"] == 3) {
        Swal.fire('บันทึกข้อมูลสำเร็จ', 'ระบบได้บันทึกข้อมูลที่แก้ไขเรียบร้อยแล้ว', 'success')
    } else if (state["action_status"] == 4) {
        Swal.fire('บันทึกข้อมูลไม่สำเร็จ', 'การแก้ไขพบข้อผิดพลาดไม่สามารถบันทึกได้', 'warning')
    }
    // 1 = บันทึกสำเร็จ
    // 2 = บันทึกไม่เสร็จ
    // 3 = แก้ไขสำเร็จ
    // 4 = แก้ไขไม่สำเร็จ

}
</script>

<style>
/* input text error */
.form-control.error {
    border-color: #dc3545;
    padding-right: 2.25rem;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E");
    background-repeat: no-repeat;
    background-position: center right calc(0.375em + 0.1875rem);
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

/* text below input text error */
label.error {
    color: #D8000C;
}

/* input txt success */
.form-control.valid {
    border-color: #28a745;
    padding-right: 2.25rem;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: center right calc(0.375em + 0.1875rem);
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.td_action {
    text-align: center;
    display: flex;
    justify-content: center;
}
/* set elements column center */

/* set table style */
table > thead {
    text-align: center;
}

tbody > tr > td:last-child {
    text-align: center;
    color:#ffffff;
}

.btn-warning, .btn-warning:hover{
    color:#fff;
}
/* btn edit style */
</style>