<div class="col-md-12">
  <!-- general form elements -->
  <div class="box box-primary">

    <!-- <div class="box-header with-border">
      <h3 class="box-title">Quick Example</h3>
    </div> -->
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form" role="form" method="post" action="<?php echo base_url()."provider/edit/".$data['PVCODE']; ?>">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Kode</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="txt_pvcode" id="txt_pvcode" placeholder="Enter ..." maxlength="8" value="<?php echo $data['PVCODE']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_pvcode'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="txt_pvname" id="txt_pvname" placeholder="Enter ..." maxlength="100" value="<?php echo $data['PVNAME']; ?>">
            <span class="text-red"><?php echo form_error('txt_pvname'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Alamat</label>
          <div class="col-sm-6">
            <textarea class="form-control" rows="3" name="txt_pvaddress" id="txt_pvaddress" placeholder="Enter ..." maxlength="255"><?php echo $data['PVADDRESS']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">No. Telepon</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="txt_pvphonenumber" id="txt_pvphonenumber" placeholder="Enter ..." maxlength="15" value="<?php echo $data['PVPHONENUMBER']; ?>">
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