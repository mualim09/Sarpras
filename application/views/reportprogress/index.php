<div class="col-md-12">
  <div class="box box-primary">

  <?php if($this->session->flashdata('successalert')){?>
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4>  <i class="icon fa fa-check"></i> Selesai!</h4>
      <?php echo $this->session->flashdata('successalert'); ?>
    </div>
  <?php } else if($this->session->flashdata('erroralert')){?>
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Maaf!</h4>
      <?php echo $this->session->flashdata('erroralert'); ?>
    </div>
  <?php } ?>

    <div class="box-header with-border">
      
    </div><!-- /.box-header -->
    <div class="box-body">
      <table id="report" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nokeg</th>
            <th>Kegiatan</th>
            <th>Kecamatan</th>
            <th>NilaiKontrak</th>
            <th>TglSPK</th>
            <th>HK</th>
            <th>TglSelesai</th>
            <th>Pengawas</th>
            <th>Pelaksana</th>
            <th>ProgressAkhir</th>
            <!-- <th>NilaiKontrak</th> -->
          </tr>
        </thead>
        <tbody>
        <?php $x=1; ?>
        <?php foreach ($list as $list) { ?>
          <tr class="<?php if($list['SCHOOLLEVEL'] == "SD"){ echo "label-danger"; }elseif($list['SCHOOLLEVEL'] == "SMP"){ echo "label-primary"; }else{ echo "bg-gray-active"; } ?>">
            <td valign="middle"><?php echo $x++; ?></td>
            <td valign="middle"><?php echo $list['PROCNUMBER']; ?></td>
            <td valign="middle"><?php echo $list['PROCDESC']; ?></td>
            <td valign="middle"><?php echo $list['SUBDISTRICT']; ?></td>
            <td valign="middle">Rp. <?php echo $list['CONTRACTVALUE']; ?>
            <td valign="middle"><?php echo $list['CONTRACTDATE']; ?></td>
            <td valign="middle"><?php echo $list['NUMBEROFDAYS']; ?></td>
            <td valign="middle"><?php echo $list['ENDDATE']; ?></td>
            <td valign="middle"><?php echo $list['SVNAME']; ?></td>
            <td valign="middle"><?php echo $list['PVNAME']; ?></td>
            <td valign="middle"><?php echo $list['TOTAL']; ?> %</td>
            <!-- <td valign="middle">Rp. <?php echo $list['SUBCONTRACTVALUE']; ?></td> -->
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->