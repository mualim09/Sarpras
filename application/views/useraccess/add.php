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
    <form class="form-horizontal" id="form" role="form" method="post" action="<?php echo base_url()."useraccess/add"; ?>">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Username</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="txt_username" id="txt_username" placeholder="Enter ..." maxlength="50" value="<?php echo $data['USERNAME']; ?>">
            <span class="text-red"><?php echo form_error('txt_username'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Password</label>
          <div class="col-sm-3">
          <div class="input-group">
            <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Enter ..." maxlength="50" value="<?php echo $data['PASSWORD']; ?>">
            <!-- <span class="input-group-addon"><i class="fa fa-check"></i></span> -->
            <div class="input-group-btn">
              <button class="btn btn-info btn-flat" type="button" name="btn_viewpassword" id="btn_viewpassword"><i class="fa fa-eye"></i></button>
            </div><!-- /btn-group -->
            <span class="text-red"><?php echo form_error('txt_password'); ?></span>
          </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Level</label>
          <div class="col-sm-3">
            <select class="form-control select2" name="cmb_level" id="cmb_level" style="width: 100%;">
              <option value="">--PILIH LEVEL--</option>
              <option value="SUPERADMIN" <?php if('SUPERADMIN' == $data['LEVEL']) echo "selected='selected'";?>>SUPERADMIN</option>
              <option value="ADMINSD" <?php if('ADMINSD' == $data['LEVEL']) echo "selected='selected'";?>>ADMIN SD</option>
              <option value="ADMINSMP" <?php if('ADMINSMP' == $data['LEVEL']) echo "selected='selected'";?>>ADMIN SMP</option>
              <option value="ADMINSMA" <?php if('ADMINSMA' == $data['LEVEL']) echo "selected='selected'";?>>ADMIN SMA/SMK</option>
              <option value="USER" <?php if('USER' == $data['LEVEL']) echo "selected='selected'";?>>USER</option>
            </select>
            <span class="text-red"><?php echo form_error('cmb_level'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">User</label>
          <div class="col-sm-3">
            <select class="form-control select2" name="cmb_usercode" id="cmb_usercode" style="width: 100%;">
              <option value="">--PILIH USER--</option>
              <?php if(is_array($data['userlist'])){ ?>
                <?php foreach($data['userlist'] as $ulist){ ?>
                  <option value="<?php echo $ulist['USERCODE']; ?>" <?php if($ulist['USERCODE'] == $data['USERCODE']) echo "selected='selected'";?>><?php echo $ulist['NAME']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
            <span class="text-red"><?php echo form_error('cmb_usercode'); ?></span>
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

<script type="text/javascript">
  (function() {

  try {

    // switch the password field to text, then back to password to see if it supports
    // changing the field type (IE9+, and all other browsers do). then switch it back.
    var passwordField = document.getElementById('txt_password');
    passwordField.type = 'text';
    passwordField.type = 'password';
    
    // if it does support changing the field type then add the event handler and make
    // the button visible. if the browser doesn't support it, then this is bypassed
    // and code execution continues in the catch() section below
    var togglePasswordField = document.getElementById('btn_viewpassword');
    togglePasswordField.addEventListener('click', togglePasswordFieldClicked, false);
    togglePasswordField.style.display = 'inline';
    
  }
  catch(err) {

  }

})();

function togglePasswordFieldClicked() {

  var passwordField = document.getElementById('txt_password');
  var value = passwordField.value;

  if(passwordField.type == 'password') {
    passwordField.type = 'text';
  }
  else {
    passwordField.type = 'password';
  }
  
  passwordField.value = value;

} 
</script>