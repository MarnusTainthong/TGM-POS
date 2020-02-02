<?php include(dirname(__FILE__)."/page_pos_main.php"); ?>
<!-- include to handle page -->

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b><?php echo ($this->config->item('sys_name_en')); ?></b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">เข้าสู่ระบบเพื่อใช้งานระบบ</p>

      <form action="<?php echo site_url()."/Authen/check_login";?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" name="username" id="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<script>
$(document).ready(function () {

    

});


</script>