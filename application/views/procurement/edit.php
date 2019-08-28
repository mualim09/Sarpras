<div class="col-md-12">
  <!-- general form elements -->
  <div class="box box-primary">

    <!-- <div class="box-header with-border">
      <h3 class="box-title">Quick Example</h3>
    </div> -->
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form" role="form" method="post" action="<?php echo base_url()."procurement/edit/".$data['PROCNUMBER']; ?>">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">ID Kegiatan</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="txt_procnumber" id="txt_procnumber" placeholder="Enter ..." maxlength="10" value="<?php echo $data['PROCNUMBER']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_procnumber'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nama Kegiatan</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="txt_procdesc" id="txt_procdesc" placeholder="Enter ..." maxlength="255" value="<?php echo $data['PROCDESC']; ?>">
            <span class="text-red"><?php echo form_error('txt_procdesc'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Kecamatan</label>
          <div class="col-sm-4">
            <select class="form-control" name="cmb_subdistrict" id="cmb_subdistrict" style="width: 100%;">
              <option value="-">--PILIH KECAMATAN--</option>
              <?php if(is_array($data['subdistrictlist'])){ ?>
                <?php foreach($data['subdistrictlist'] as $slist){ ?>
                  <option value="<?php echo $slist['SUBDISTRICTID']; ?>" <?php if($slist['SUBDISTRICTID'] == $data['SUBDISTRICTID']) echo "selected='selected'";?>><?php echo $slist['SUBDISTRICT']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
            <span class="text-red"><?php echo form_error('cmb_subdistrict'); ?></span>
          </div>
        </div>
        <?php if($this->session->userdata('LEVEL') == "SUPERADMIN"){?>
          <div class="form-group">
            <label class="col-sm-2 control-label">Level Sekolah</label>
            <div class="col-sm-3">
              <select class="form-control" name="cmb_schoollevel" id="cmb_schoollevel" style="width: 100%;">
                <option value="-">--PILIH LEVEL SEKOLAH--</option>
                <option value="SD" <?php if('SD' == $data['SCHOOLLEVEL']) echo "selected='selected'";?>>SD</option>
                <option value="SMP" <?php if('SMP' == $data['SCHOOLLEVEL']) echo "selected='selected'";?>>SMP</option>
                <option value="SMA" <?php if('SMA' == $data['SCHOOLLEVEL']) echo "selected='selected'";?>>SMA/SMK</option>
              </select>
              <span class="text-red"><?php echo form_error('cmb_schoollevel'); ?></span>
            </div>
          </div>
        <?php } ?>
        <?php if($this->session->userdata('LEVEL') == "ADMINSD" || $this->session->userdata('LEVEL') == "ADMINSMP" || $this->session->userdata('LEVEL') == "ADMINSMA"){?>
          <div class="form-group">
            <label class="col-sm-2 control-label">Level Sekolah</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="cmb_schoollevel" id="cmb_schoollevel" value="<?php echo $data['SCHOOLLEVEL']; ?>" readonly="readonly">
              <span class="text-red"><?php echo form_error('cmb_schoollevel'); ?></span>
            </div>
          </div>
        <?php } ?>
        <!-- <div class="form-group">
          <label class="col-sm-2 control-label">Alamat</label>
          <div class="col-sm-6">
            <textarea class="form-control" rows="3" name="txt_proclocation" id="txt_proclocation" placeholder="Enter ..." maxlength="255"><?php echo $data['PROCLOCATION']; ?></textarea>
          </div>
        </div> -->
        <div class="form-group">
          <label class="col-sm-2 control-label">Penyedia Jasa</label>
          <div class="col-sm-4">
            <select class="form-control" name="cmb_pv" id="cmb_pv" style="width: 100%;">
              <option value="-">--PILIH PENYEDIA JASA--</option>
              <?php if(is_array($data['providerlist'])){ ?>
                <?php foreach($data['providerlist'] as $pvlist){ ?>
                  <option value="<?php echo $pvlist['PVCODE']; ?>" <?php if($pvlist['PVCODE'] == $data['PVCODE']) echo "selected='selected'";?>><?php echo $pvlist['PVNAME']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
            <span class="text-red"><?php echo form_error('cmb_pv'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nilai Kontrak</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="txt_contractvalue" id="txt_contractvalue" placeholder="Enter ..." maxlength="15" value="<?php echo $data['CONTRACTVALUE']; ?>" onkeypress="return isNumberKey(event)">
            <span class="text-red"><?php echo form_error('txt_contractvalue'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Waktu Pelaksanaan</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="txt_numberofdays" id="txt_numberofdays" placeholder="Enter ..." maxlength="15" value="<?php echo $data['NUMBEROFDAYS']; ?>" onkeypress="return isNumberKey(event)">
            <span class="text-red"><?php echo form_error('txt_numberofdays'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Tanggal Kontrak</label>
          <div class="col-sm-3">
            <div class="date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
              <input class="form-control datepicker" data-date-format="dd-mm-yyyy" type="text" name="dtx_contractdate" id="dtx_contractdate" value="<?php echo $data['CONTRACTDATE']; ?>" onchange="getdate()">
            </div>
            <input type="hidden" id="dtp_input1" value="">
            <span class="text-red"><?php echo form_error('dtx_contractdate'); ?></span>
          </div>
        </div>
        <!-- <div class="form-group">
          <label class="col-sm-2 control-label">Tanggal SMPK</label>
          <div class="col-sm-3">
            <div class="date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
              <input class="form-control datepicker" data-date-format="yyyy-mm-dd" type="text" name="dtx_smpkdate" id="dtx_smpkdate" value="<?php echo $data['SMPKDATE']; ?>">
            </div>
            <input type="hidden" id="dtp_input1" value="">
            <span class="text-red"><?php echo form_error('dtx_smpkdate'); ?></span>
          </div>
        </div> -->
        <!-- <div class="form-group">
          <label class="col-sm-2 control-label">Tanggal Selesai</label>
          <div class="col-sm-3">
            <div class="date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
              <input class="form-control datepicker" data-date-format="yyyy-mm-dd" type="text" name="dtx_enddate" id="dtx_enddate" value="<?php echo $data['ENDDATE']; ?>" readonly="readonly">
            </div>
            <input type="hidden" id="dtp_input1" value="">
            <span class="text-red"><?php echo form_error('dtx_enddate'); ?></span>
          </div>
        </div> -->
        <div class="form-group">
          <label class="col-sm-2 control-label">Tanggal Selesai</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="dtx_enddate" id="dtx_enddate" value="<?php echo $data['ENDDATE']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('dtx_enddate'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Konsultan Pengawas</label>
          <div class="col-sm-4">
            <select class="form-control" name="cmb_sv" id="cmb_sv" style="width: 100%;">
              <option value="-">--PILIH KONSULTAN PENGAWAS--</option>
              <?php if(is_array($data['supervisorlist'])){ ?>
                <?php foreach($data['supervisorlist'] as $svlist){ ?>
                  <option value="<?php echo $svlist['SVCODE']; ?>" <?php if($svlist['SVCODE'] == $data['SVCODE']) echo "selected='selected'";?>><?php echo $svlist['SVNAME']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
            <span class="text-red"><?php echo form_error('cmb_sv'); ?></span>
          </div>
        </div>
        <!-- <div class="form-group">
          <input type="hidden" name="cmb_proctype" id="cmb_proctype" value="<?php echo $data['PROCTYPECODE']; ?>">
          <label class="col-sm-2 control-label">Jenis Kegiatan</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="txt_proctype" id="txt_proctype" maxlength="255" value="<?php echo $data['PROCTYPEDESC']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('cmb_proctype'); ?></span>
          </div>
        </div> -->
        <div class="form-group">
          <label class="col-sm-2 control-label">Jenis Kegiatan</label>
          <div class="col-sm-4">
            <select class="form-control" name="cmb_proctype" id="cmb_proctype" style="width: 100%;">
              <option value="-">--PILIH JENIS KEGIATAN--</option>
              <?php if(is_array($data['procurementtypelist'])){ ?>
                <?php foreach($data['procurementtypelist'] as $ptlist){ ?>
                  <option value="<?php echo $ptlist['PROCTYPECODE']; ?>" <?php if($ptlist['PROCTYPECODE'] == $data['PROCTYPECODE']) echo "selected='selected'";?>><?php echo $ptlist['PROCTYPEDESC']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
            <span class="text-red"><?php echo form_error('cmb_proctype'); ?></span>
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

<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
  // $("#txt_contractvalue").keyup(function() {
  //   var contractvalue = parseInt($("#txt_contractvalue").val(),10);

  //   if(contractvalue > 0){
  //     if(contractvalue > 100000000){
  //       $("#cmb_proctype").val("PL02");
  //       $("#txt_proctype").val("PENGADAAN LELANG");
  //     }else{
  //       $("#cmb_proctype").val("PL01");
  //       $("#txt_proctype").val("PENGADAAN LANGSUNG");
  //     }
  //   }else{
  //     $("#cmb_proctype").val("");
  //     $("#txt_proctype").val("");
  //   }
  // });

  function getdate() {
    var startdate = document.getElementById('dtx_contractdate').value;
    var nod = document.getElementById('txt_numberofdays').value;

    if(nod == "" || nod < 1){
      nod = 0;
      document.getElementById('txt_numberofdays').value = 1;
    }else{
      nod = (parseInt(document.getElementById('txt_numberofdays').value,10)-1);
    }

 
    // var date = new Date(startdate);
    var parts = startdate.split("-");
    var date = new Date(parts[2] + "-" + parts[1] + "-" + parts[0]);
    var enddate = new Date(date);
 
    enddate.setDate(enddate.getDate() + nod);
 
    var dd = enddate.getDate();
    var mm = enddate.getMonth() + 1;
    var yyyy = enddate.getFullYear();

    if(dd < 10){
      dd = "0" + dd;
    }

    if(mm < 10){
      mm = "0" + mm;
    }
 
    var formatteddate = dd + '-' + mm + '-' + yyyy;
    document.getElementById('dtx_enddate').value = formatteddate;
  }
</script>