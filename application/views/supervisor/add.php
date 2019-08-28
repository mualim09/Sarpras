<div class="col-md-12">
  <!-- general form elements -->
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

    <!-- <div class="box-header with-border">
      <h3 class="box-title">Quick Example</h3>
    </div> -->
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form" role="form" method="post" action="<?php echo base_url()."supervisor/add"; ?>">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Kode</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="txt_svcode" id="txt_svcode" placeholder="Enter ..." maxlength="8" value="<?php echo $data['SVCODE']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_svcode'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="txt_svname" id="txt_svname" placeholder="Enter ..." maxlength="100" value="<?php echo $data['SVNAME']; ?>">
            <span class="text-red"><?php echo form_error('txt_svname'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Alamat</label>
          <div class="col-sm-6">
            <textarea class="form-control" rows="3" name="txt_svaddress" id="txt_svaddress" placeholder="Enter ..." maxlength="255"><?php echo $data['SVADDRESS']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">No. Telepon</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="txt_svphonenumber" id="txt_svphonenumber" placeholder="Enter ..." maxlength="15" value="<?php echo $data['SVPHONENUMBER']; ?>">
          </div>
        </div>
      </div><!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-danger" name="btn_cancel" id="btn_cancel" value="Batal">Batal</button>
        <button type="submit" class="btn btn-primary pull-right" name="btn_save" id="btn_save" value="Simpan">Simpan</button>
      </div>
    </form>
  </div><!-- /.box -->
</div><!--/.col (left) -->