<div class="col-md-12">
  <!-- general form elements -->
  <div class="box box-primary">

    <!-- <div class="box-header with-border">
      <h3 class="box-title">Quick Example</h3>
    </div> -->
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form" role="form" method="post" action="<?php echo base_url()."procurementtype/edit/".$data['PROCTYPECODE']; ?>">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Kode</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="txt_proctypecode" id="txt_proctypecode" placeholder="Enter ..." maxlength="4" value="<?php echo $data['PROCTYPECODE']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_proctypecode'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Tipe Pengadaan</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="txt_proctypedesc" id="txt_proctypedesc" placeholder="Enter ..." maxlength="30" value="<?php echo $data['PROCTYPEDESC']; ?>">
            <span class="text-red"><?php echo form_error('txt_proctypedesc'); ?></span>
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