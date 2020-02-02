<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url('/Dashboard'); ?>" class="brand-link">
      <img src="<?php echo base_url() . $this->config->item('template_path') . 'dist/images/tgm.png' ?>"
           alt="AdminLTE Logo"
           class="brand-image elevation-3"
           >
      <span class="brand-text font-weight-light"><?php echo ($this->config->item('sys_name_th')); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
			   with font-awesome or any other icon font library -->
			<li class="nav-item">
            <a href="<?php echo site_url('/Dashboard'); ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
		  </li>


		  <li class="nav-item">
            <a href="#" class="nav-link">
			  <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                ขายหน้าร้าน
              </p>
            </a>
		  </li>

		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-store"></i>
              <p>
                จัดการหลังร้าน
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>จัดการสินค้า</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>จัดการคลังสินค้า</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
              ตั้งค่า
              </p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('/Setting/category'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ประเภทสินค้า</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo site_url('/Setting/unit'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>หน่วยนับ</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo site_url('/Setting/brand'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>แบรนด์</p>
                </a>
              </li>

            </ul>
          </li>

        </ul>
        <!-- /.ul -->
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>