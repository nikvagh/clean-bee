<aside class="main-sidebar">
  <?php
  // echo "<pre>";
  // print_r($this->admin->loginData->name);
  // echo "</pre>";
  ?>
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <?php
        // if (file_exists(PROFILE_PATH . 'thumb/120x120_' . $this->session->userdata('loginData')->profile_pic)) {
        //   $profile_pic = base_url() . PROFILE_PATH . 'thumb/120x120_' . $this->session->userdata('loginData')->profile_pic;
        // } else {
          $profile_pic = $this->back_assets . 'dist/img/avatar5.png';
        // }
        ?>
        <img src="<?php echo $profile_pic; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p class="text-uppercase"><?php echo $this->admin->loginData->email; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form -->
    <!-- <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form> -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->

    <?php $page_selected = $this->uri->segment(2); ?>

    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>

      <li class="<?php if ($page_selected == 'dashboard' || $page_selected == '') { echo 'active'; } ?>">
        <a href="<?php echo base_url() . ADMINPATH; ?>dashboard">
          <!-- <i class="fa fa-dashboard"></i>  -->
          <img src="<?php echo $this->back_assets . 'dist/img/icons/Dashboard.png'; ?>" width="20px" /> &nbsp;
          <span>Dashboard <?php //echo $this->uri->segment(2); ?></span>
        </a>
      </li>

      <li class="<?php if ($page_selected == 'admin_users' || $page_selected == '') { echo 'active'; } ?>">
        <a href="<?php echo base_url() . ADMINPATH; ?>admin_users">
          <!-- <i class="fa fa-dashboard"></i>  -->
          <img src="<?php echo $this->back_assets . 'dist/img/icons/Dashboard.png'; ?>" width="20px" /> &nbsp;
          <span>Admin Users <?php //echo $this->uri->segment(2); ?></span>
        </a>
      </li>

      <?php
        $numbertype_acc = $this->accessibility->check_access1('numbertype');
        $numbersubtype_acc = $this->accessibility->check_access1('numbersubtype');
      ?>

      <?php if ($numbertype_acc || $numbersubtype_acc) { ?>
        <li class="treeview <?php if ($page_selected == 'all_orders' || $page_selected == 'cash_orders') { echo 'active'; } ?>">
          <a href="#">
            <img src="<?php //echo $this->back_assets . 'dist/img/icons/Number Type.png'; ?>" width="20px" /> &nbsp;
            <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($numbertype_acc) { ?>
              <li class="<?php if ($page_selected == 'numbertype') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>numbertype"><i class="fa fa-circle-o"></i> All Orders </a>
              </li>
            <?php } ?>
            <?php if ($numbersubtype_acc) { ?>
              <li class="<?php if ($page_selected == 'numbersubtype') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>numbersubtype"><i class="fa fa-circle-o"></i> Cash Orders</a>
              </li>
            <?php } ?>
            <?php if ($numbersubtype_acc) { ?>
              <li class="<?php if ($page_selected == 'numbersubtype') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>numbersubtype"><i class="fa fa-circle-o"></i> Discount Codes</a>
              </li>
            <?php } ?>
            <?php if ($numbersubtype_acc) { ?>
              <li class="<?php if ($page_selected == 'numbersubtype') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>numbersubtype"><i class="fa fa-circle-o"></i> Order Histories</a>
              </li>
            <?php } ?>
            <?php if ($numbersubtype_acc) { ?>
              <li class="<?php if ($page_selected == 'numbersubtype') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>numbersubtype"><i class="fa fa-circle-o"></i> Payments</a>
              </li>
            <?php } ?>
            <?php if ($numbersubtype_acc) { ?>
              <li class="<?php if ($page_selected == 'numbersubtype') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>numbersubtype"><i class="fa fa-circle-o"></i> Reported Orders</a>
              </li>
            <?php } ?>
          </ul>
        </li>
      <?php } ?>

      <?php if ($numbertype_acc || $numbersubtype_acc) { ?>
        <li class="treeview <?php if ($page_selected == 'all_orders' || $page_selected == 'cash_orders') { echo 'active'; } ?>">
          <a href="#">
            <img src="<?php //echo $this->back_assets . 'dist/img/icons/Number Type.png'; ?>" width="20px" /> &nbsp;
            <span>Vendors</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($numbertype_acc) { ?>
              <li class="<?php if ($page_selected == 'numbertype') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>numbertype"><i class="fa fa-circle-o"></i> All Vendors </a>
              </li>
            <?php } ?>
            <?php if ($numbersubtype_acc) { ?>
              <li class="<?php if ($page_selected == 'numbersubtype') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>numbersubtype"><i class="fa fa-circle-o"></i> Vendor Payments</a>
              </li>
            <?php } ?>
            <?php if ($numbersubtype_acc) { ?>
              <li class="<?php if ($page_selected == 'numbersubtype') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>numbersubtype"><i class="fa fa-circle-o"></i> Vendor Shops</a>
              </li>
            <?php } ?>
          </ul>
        </li>
      <?php } ?>

      <?php if ($this->accessibility->check_access1('contents')) { ?>
        <li class="<?php if ($page_selected == 'contents') { echo 'active'; } ?>">
          <a href="<?php echo base_url() . ADMINPATH; ?>contents">
            <!-- <i class="fa fa-hand-paper-o"></i>  -->
            <img src="<?php echo $this->back_assets . 'dist/img/icons/Bid.png'; ?>" width="20px" /> &nbsp;
            <span>Contents</span>
          </a>
        </li>
      <?php } ?>

      <?php if ($numbertype_acc || $numbersubtype_acc) { ?>
        <li class="treeview <?php if ($page_selected == 'all_orders' || $page_selected == 'cash_orders') { echo 'active'; } ?>">
          <a href="#">
            <img src="<?php //echo $this->back_assets . 'dist/img/icons/Number Type.png'; ?>" width="20px" /> &nbsp;
            <span>Services</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($numbertype_acc) { ?>
              <li class="<?php if ($page_selected == 'capabilities') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>capabilities"><i class="fa fa-circle-o"></i> Capabilities </a>
              </li>
            <?php } ?>
            <?php if ($laundries_acc) { ?>
              <li class="<?php if ($page_selected == 'laundries') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>laundries"><i class="fa fa-circle-o"></i> Laundries</a>
              </li>
            <?php } ?>
          </ul>
        </li>
      <?php } ?>

      <?php if ($this->accessibility->check_access1('slots')) { ?>
        <li class="<?php if ($page_selected == 'slots') { echo 'active'; } ?>">
          <a href="<?php echo base_url() . ADMINPATH; ?>slots">
            <!-- <i class="fa fa-credit-card"></i>  -->
            <img src="<?php echo $this->back_assets . 'dist/img/icons/Fees.png'; ?>" width="20px" /> &nbsp;
            <span>Slots</span>
          </a>
        </li>
      <?php } ?>

      <?php if ($numbertype_acc || $numbersubtype_acc) { ?>
        <li class="treeview <?php if ($page_selected == 'customers' || $page_selected == 'cash_orders') { echo 'active'; } ?>">
          <a href="#">
            <img src="<?php //echo $this->back_assets . 'dist/img/icons/Number Type.png'; ?>" width="20px" /> &nbsp;
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($numbertype_acc) { ?>
              <li class="<?php if ($page_selected == 'customers') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>customers"><i class="fa fa-circle-o"></i> Customers </a>
              </li>
            <?php } ?>
            <?php if ($laundries_acc) { ?>
              <li class="<?php if ($page_selected == 'laundries') { echo 'active'; } ?>">
                <a href="<?php echo base_url() . ADMINPATH; ?>laundries"><i class="fa fa-circle-o"></i> Laundries</a>
              </li>
            <?php } ?>
          </ul>
        </li>
      <?php } ?>

      <?php if ($this->accessibility->check_access1('setting')) { ?>
        <li class="<?php if ($page_selected == 'setting') { echo 'active'; } ?>">
          <a href="<?php echo base_url() . ADMINPATH; ?>setting">
            <!-- <i class="fa fa-gear"></i>  -->
            <img src="<?php echo $this->back_assets . 'dist/img/icons/Settings.png'; ?>" width="20px" /> &nbsp;
            <span>Settings</span>
          </a>
        </li>
      <?php } ?>

      <!-- <li class="">
          <a data-target="#print_modal" data-toggle="modal" style="cursor: pointer;">
            <img src="<?php echo $this->back_assets . 'dist/img/icons/Advertisment.png'; ?>" width="20px" /> &nbsp;
            <span>Notification</span>
          </a>
      </li> -->

    </ul>

  </section>
  <!-- /.sidebar -->
</aside>