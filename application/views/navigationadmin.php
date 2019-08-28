<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Konsultan Pengawas</a>
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
            <li class="treeview <?php if($currentpage =='useraccess' || $currentpage =='userprofile'){echo 'active';}?>">
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
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>