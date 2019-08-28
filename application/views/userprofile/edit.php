<div class="col-md-12">
  <!-- general form elements -->
  <div class="box box-primary">

    <!-- <div class="box-header with-border">
      <h3 class="box-title">Quick Example</h3>
    </div> -->
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form" role="form" method="post" action="<?php echo base_url()."userprofile/edit/".$data['USERCODE']; ?>">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Kode User</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="txt_usercode" id="txt_usercode" placeholder="Enter ..." maxlength="8" value="<?php echo $data['USERCODE']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_usercode'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="txt_name" id="txt_name" placeholder="Enter ..." maxlength="100" value="<?php echo $data['NAME']; ?>">
            <span class="text-red"><?php echo form_error('txt_name'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Alamat</label>
          <div class="col-sm-6">
            <textarea class="form-control" rows="3" name="txt_address" id="txt_address" placeholder="Enter ..." maxlength="255"><?php echo $data['ADDRESS']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">No. Telepon</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="txt_phonenumber" id="txt_phonenumber" placeholder="Enter ..." maxlength="15" value="<?php echo $data['PHONENUMBER']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Konsultan Pengawas</label>
          <div class="col-sm-4">
            <select class="form-control select2" name="cmb_sv" id="cmb_sv" style="width: 100%;">
              <option value="">--PILIH KONSULTAN PENGAWAS--</option>
              <?php if(is_array($data['supervisorlist'])){ ?>
                <?php foreach($data['supervisorlist'] as $svlist){ ?>
                  <option value="<?php echo $svlist['SVCODE']; ?>" <?php if($svlist['SVCODE'] == $data['SVCODE']) echo "selected='selected'";?>><?php echo $svlist['SVNAME']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
            <span class="text-red"><?php echo form_error('cmb_sv'); ?></span>
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