<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>files/image/profile/user.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('NAME'); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->userdata('SVNAME'); ?></a>
      </div>
    </div>
    <!-- search form -->
          <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU UTAMA</li>
            <li class="<?php if($currentpage =='dashboard'){echo 'active';}?>">
              <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
              </a>
            </li>
            <li class="<?php if($currentpage =='procurement'){echo 'active';}?>">
              <a href="<?php echo base_url(); ?>procurement">
                <i class="fa fa-edit"></i> <span>DATA KEGIATAN</span>
              </a>
            </li>
            <li class="<?php if($currentpage =='progress'){echo 'active';}?>">
              <a href="<?php echo base_url(); ?>progress">
                <i class="fa fa-tasks"></i> <span>DATA PROGRESS</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>