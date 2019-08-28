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
            <li class="treeview <?php if($currentpage =='procurement' || $currentpage =='procurementSD' || $currentpage =='procurementSMP' || $currentpage =='procurementSMA'){echo 'active';}?>">
              <a href="<?php echo base_url(); ?>procurement">
                <i class="fa fa-edit"></i> <span>DATA KEGIATAN</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($currentpage =='procurementSD'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>procurement/level/SD">
                    <i class="fa fa-circle-o"></i> SD
                  </a>
                </li>
                <li class="<?php if($currentpage =='procurementSMP'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>procurement/level/SMP">
                    <i class="fa fa-circle-o"></i> SMP
                  </a>
                </li>
                <li class="<?php if($currentpage =='procurementSMA'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>procurement/level/SMA">
                    <i class="fa fa-circle-o"></i> SMA
                  </a>
                </li>
              </ul>
            </li>
            <li class="<?php if($currentpage =='progress'){echo 'active';}?>">
              <a href="<?php echo base_url(); ?>progress">
                <i class="fa fa-tasks"></i> <span>DATA PROGRESS</span>
              </a>
            </li>
            <li class="treeview <?php if($currentpage =='report' || $currentpage =='reportSD' || $currentpage =='reportSMP' || $currentpage =='reportSMA'){echo 'active';}?>">
              <a href="<?php echo base_url(); ?>report">
                <i class="fa fa-edit"></i> <span>REPORT PROGRESS</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($currentpage =='reportSD'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>report/level/SD">
                    <i class="fa fa-circle-o"></i> SD
                  </a>
                </li>
                <li class="<?php if($currentpage =='reportSMP'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>report/level/SMP">
                    <i class="fa fa-circle-o"></i> SMP
                  </a>
                </li>
                <li class="<?php if($currentpage =='reportSMA'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>report/level/SMA">
                    <i class="fa fa-circle-o"></i> SMA
                  </a>
                </li>
              </ul>
            </li>
            <li class="treeview <?php if($currentpage =='subdistrict' || $currentpage =='procurementtype' || $currentpage =='provider' || $currentpage =='supervisor'){echo 'active';}?>">
              <a href="#">
                <i class="fa fa-database"></i>
                <span>MASTER</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($currentpage =='subdistrict'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>subdistrict">
                    <i class="fa fa-circle-o"></i> DATA KECAMATAN
                  </a>
                </li>
                <li class="<?php if($currentpage =='procurementtype'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>procurementtype">
                    <i class="fa fa-circle-o"></i> DATA TIPE PENGADAAN
                  </a>
                </li>
                <li class="<?php if($currentpage =='provider'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>provider">
                    <i class="fa fa-circle-o"></i> DATA PENYEDIA JASA
                  </a>
                </li>
                <li class="<?php if($currentpage =='supervisor'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>supervisor">
                    <i class="fa fa-circle-o"></i> DATA KONSULTAN PENGAWAS
                  </a>
                </li>
              </ul>
            </li>
            <li class="treeview <?php if($currentpage =='useraccess' || $currentpage =='userprofile' || $currentpage =='article'){echo 'active';}?>">
              <a href="#">
                <i class="fa  fa-gear"></i>
                <span>SISTEM</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($currentpage =='useraccess'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>useraccess">
                    <i class="fa fa-circle-o"></i> DATA AKSES USER
                  </a>
                </li>
                <li class="<?php if($currentpage =='userprofile'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>userprofile">
                    <i class="fa fa-circle-o"></i> DATA PROFIL USER
                  </a>
                </li>
                <li class="<?php if($currentpage =='article'){echo 'active';}?>">
                  <a href="<?php echo base_url(); ?>article">
                    <i class="fa fa-circle-o"></i> PENGUMUMAN
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>