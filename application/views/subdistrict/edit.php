<div class="col-md-12">
  <!-- general form elements -->
  <div class="box box-primary">

    <!-- <div class="box-header with-border">
      <h3 class="box-title">Quick Example</h3>
    </div> -->
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form" role="form" method="post" action="<?php echo base_url()."subdistrict/edit/".$data['SUBDISTRICTID']; ?>">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Kecamatan</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="txt_subdistrict" id="txt_subdistrict" placeholder="Enter ..." maxlength="100" value="<?php echo $data['SUBDISTRICT']; ?>">
            <span class="text-red"><?php echo form_error('txt_subdistrict'); ?></span>
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