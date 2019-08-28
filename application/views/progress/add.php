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
    <form class="form-horizontal" id="form" role="form" method="post" action="<?php echo base_url()."progress/add/".$data['PROCNUMBER']; ?>" enctype="multipart/form-data">
      <div class="box-body">
        <!-- <div class="form-group">
          <label class="col-sm-2 control-label">Nama Kegiatan</label>
          <div class="col-sm-4">
            <select class="form-control select2" name="cmb_proc" id="cmb_proc" style="width: 100%;">
              <option value="">--PILIH NAMA KEGIATAN--</option>
              <?php if(is_array($data['procurementlist'])){ ?>
              <?php foreach($data['procurementlist'] as $plist){ ?>
              <option value="<?php echo $plist['PROCNUMBER']; ?>" <?php if($plist['PROCNUMBER'] == $data['PROCNUMBER']) echo "selected='selected'";?>><?php echo $plist['PROCDESC']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
            <span class="text-red"><?php echo form_error('cmb_proc'); ?></span>
          </div>
        </div> -->

        <div class="form-group">
          <label class="col-sm-2 control-label">Nama Kegiatan</label>
          <div class="col-sm-8">
            <input type="hidden" name="cmb_proctype" id="cmb_proctype" value="<?php echo $data['PROCTYPECODE']; ?>">
            <input type="text" class="form-control" name="txt_procdesc" id="txt_procdesc" value="<?php echo $data['PROCDESC']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_procdesc'); ?></span>
          </div>
        </div>

        <!-- <div class="form-group">
          <label class="col-sm-2 control-label">Progress</label>
          <div class="col-sm-3">
            <select class="form-control select2" name="cmb_progress" id="cmb_progress" style="width: 100%;">
              <option value="">--PILIH PROGRESS--</option>
              <option value="1" <?php if('1' == $data['STEP']) echo "selected='selected'";?>>30%</option>
              <option value="2" <?php if('2' == $data['STEP']) echo "selected='selected'";?>>60%</option>
              <option value="3" <?php if('3' == $data['STEP']) echo "selected='selected'";?>>80%</option>
              <option value="4" <?php if('4' == $data['STEP']) echo "selected='selected'";?>>100%</option>
            </select>
            <span class="text-red"><?php echo form_error('cmb_step'); ?></span>
          </div>
        </div> -->

        <div class="form-group">
          <label class="col-sm-2 control-label">Step</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="txt_step" id="txt_step" maxlength="1" value="<?php echo $data['STEP']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_step'); ?></span>
          </div>
        </div>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th rowspan="2">No</th>
              <th rowspan="2">Komponen<br>Bangunan</th>
              <th rowspan="2">Sub Komponen<br>Bangunan</th>
              <th colspan="11">Progress</th>
              <th rowspan="2">Bobot</th>
            </tr>
            <tr>
              <th>0</th>
              <th>10</th>
              <th>20</th>
              <th>30</th>
              <th>40</th>
              <th>50</th>
              <th>60</th>
              <th>70</th>
              <th>80</th>
              <th>90</th>
              <th>100</th>
            </tr>
          </thead>
          
          <tbody>
            <!-- start edit 12april2016 -->
            <tr>
              <td>1</td>
              <td>Atap</td>
              <td>a. Penutup Atap</td>
              <td><div class="radio"><label><input type="radio" name="rdo_atappenutup" id="rdo_atappenutup0" value="0" onclick="document.getElementById('txt_atappenutup').value = <?php echo $data['ATAPPENUTUP']; ?>; calculate_total();" <?php if(0 <= $data2['RDOATAPPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_atappenutup" id="rdo_atappenutup1" value="1" onclick="document.getElementById('txt_atappenutup').value = Math.round(((10.56/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOATAPPENUTUP']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOATAPPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_atappenutup" id="rdo_atappenutup2" value="2" onclick="document.getElementById('txt_atappenutup').value = Math.round(((10.56/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOATAPPENUTUP']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOATAPPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_atappenutup" id="rdo_atappenutup3" value="3" onclick="document.getElementById('txt_atappenutup').value = Math.round(((10.56/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOATAPPENUTUP']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOATAPPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_atappenutup" id="rdo_atappenutup4" value="4" onclick="document.getElementById('txt_atappenutup').value = Math.round(((10.56/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOATAPPENUTUP']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOATAPPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_atappenutup" id="rdo_atappenutup5" value="5" onclick="document.getElementById('txt_atappenutup').value = Math.round(((10.56/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOATAPPENUTUP']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOATAPPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_atappenutup" id="rdo_atappenutup6" value="6" onclick="document.getElementById('txt_atappenutup').value = Math.round(((10.56/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOATAPPENUTUP']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOATAPPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_atappenutup" id="rdo_atappenutup7" value="7" onclick="document.getElementById('txt_atappenutup').value = Math.round(((10.56/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOATAPPENUTUP']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOATAPPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_atappenutup" id="rdo_atappenutup8" value="8" onclick="document.getElementById('txt_atappenutup').value = Math.round(((10.56/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOATAPPENUTUP']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOATAPPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_atappenutup" id="rdo_atappenutup9" value="9" onclick="document.getElementById('txt_atappenutup').value = Math.round(((10.56/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOATAPPENUTUP']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOATAPPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_atappenutup" id="rdo_atappenutup10" value="10" onclick="document.getElementById('txt_atappenutup').value = Math.round(((10.56/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOATAPPENUTUP']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOATAPPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_atappenutup" id="lc_atappenutup" value="<?php echo $data['RDOATAPPENUTUP']; ?>">
                  <input type="text" class="form-control amount" name="txt_atappenutup" id="txt_atappenutup" value="<?php echo $data['ATAPPENUTUP']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_atappenutup'); ?></span>
                </div>
              </td>
            </tr>
            <!-- end edit 12april2016 -->
            <tr>
              <td></td>
              <td></td>
              <td>b. Rangka Atap</td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataprangka" id="rdo_ataprangka0" value="0" onclick="document.getElementById('txt_ataprangka').value = <?php echo $data['ATAPRANGKA']; ?>; calculate_total();" <?php if(0 <= $data2['RDOATAPRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataprangka" id="rdo_ataprangka1" value="1" onclick="document.getElementById('txt_ataprangka').value = Math.round(((11.62/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOATAPRANGKA']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOATAPRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataprangka" id="rdo_ataprangka2" value="2" onclick="document.getElementById('txt_ataprangka').value = Math.round(((11.62/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOATAPRANGKA']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOATAPRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataprangka" id="rdo_ataprangka3" value="3" onclick="document.getElementById('txt_ataprangka').value = Math.round(((11.62/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOATAPRANGKA']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOATAPRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataprangka" id="rdo_ataprangka4" value="4" onclick="document.getElementById('txt_ataprangka').value = Math.round(((11.62/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOATAPRANGKA']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOATAPRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataprangka" id="rdo_ataprangka5" value="5" onclick="document.getElementById('txt_ataprangka').value = Math.round(((11.62/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOATAPRANGKA']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOATAPRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataprangka" id="rdo_ataprangka6" value="6" onclick="document.getElementById('txt_ataprangka').value = Math.round(((11.62/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOATAPRANGKA']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOATAPRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataprangka" id="rdo_ataprangka7" value="7" onclick="document.getElementById('txt_ataprangka').value = Math.round(((11.62/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOATAPRANGKA']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOATAPRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataprangka" id="rdo_ataprangka8" value="8" onclick="document.getElementById('txt_ataprangka').value = Math.round(((11.62/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOATAPRANGKA']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOATAPRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataprangka" id="rdo_ataprangka9" value="9" onclick="document.getElementById('txt_ataprangka').value = Math.round(((11.62/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOATAPRANGKA']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOATAPRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataprangka" id="rdo_ataprangka10" value="10" onclick="document.getElementById('txt_ataprangka').value = Math.round(((11.62/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOATAPRANGKA']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOATAPRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_ataprangka" id="lc_ataprangka" value="<?php echo $data['RDOATAPRANGKA']; ?>">
                  <input type="text" class="form-control amount" name="txt_ataprangka" id="txt_ataprangka" value="<?php echo $data['ATAPRANGKA']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_ataprangka'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Lis Plang & Talang</td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataplis" id="rdo_ataplis0" value="0" onclick="document.getElementById('txt_ataplis').value = <?php echo $data['ATAPLIS']; ?>; calculate_total();" <?php if(0 <= $data2['RDOATAPLIS']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataplis" id="rdo_ataplis1" value="1" onclick="document.getElementById('txt_ataplis').value = Math.round(((2.06/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOATAPLIS']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOATAPLIS']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataplis" id="rdo_ataplis2" value="2" onclick="document.getElementById('txt_ataplis').value = Math.round(((2.06/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOATAPLIS']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOATAPLIS']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataplis" id="rdo_ataplis3" value="3" onclick="document.getElementById('txt_ataplis').value = Math.round(((2.06/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOATAPLIS']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOATAPLIS']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataplis" id="rdo_ataplis4" value="4" onclick="document.getElementById('txt_ataplis').value = Math.round(((2.06/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOATAPLIS']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOATAPLIS']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataplis" id="rdo_ataplis5" value="5" onclick="document.getElementById('txt_ataplis').value = Math.round(((2.06/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOATAPLIS']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOATAPLIS']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataplis" id="rdo_ataplis6" value="6" onclick="document.getElementById('txt_ataplis').value = Math.round(((2.06/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOATAPLIS']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOATAPLIS']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataplis" id="rdo_ataplis7" value="7" onclick="document.getElementById('txt_ataplis').value = Math.round(((2.06/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOATAPLIS']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOATAPLIS']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataplis" id="rdo_ataplis8" value="8" onclick="document.getElementById('txt_ataplis').value = Math.round(((2.06/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOATAPLIS']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOATAPLIS']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataplis" id="rdo_ataplis9" value="9" onclick="document.getElementById('txt_ataplis').value = Math.round(((2.06/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOATAPLIS']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOATAPLIS']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_ataplis" id="rdo_ataplis10" value="10" onclick="document.getElementById('txt_ataplis').value = Math.round(((2.06/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOATAPLIS']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOATAPLIS']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_ataplis" id="lc_ataplis" value="<?php echo $data['RDOATAPLIS']; ?>">
                  <input type="text" class="form-control amount" name="txt_ataplis" id="txt_ataplis" value="<?php echo $data['ATAPLIS']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_ataplis'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>2</td>
              <td>Plafon</td>
              <td>a. Rangka Plafon</td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonrangka" id="rdo_plafonrangka0" value="0" onclick="document.getElementById('txt_plafonrangka').value = <?php echo $data['PLAFONRANGKA']; ?>; calculate_total();" <?php if(0 <= $data2['RDOPLAFONRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonrangka" id="rdo_plafonrangka1" value="1" onclick="document.getElementById('txt_plafonrangka').value = Math.round(((4.67/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOPLAFONRANGKA']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOPLAFONRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonrangka" id="rdo_plafonrangka2" value="2" onclick="document.getElementById('txt_plafonrangka').value = Math.round(((4.67/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOPLAFONRANGKA']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOPLAFONRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonrangka" id="rdo_plafonrangka3" value="3" onclick="document.getElementById('txt_plafonrangka').value = Math.round(((4.67/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOPLAFONRANGKA']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOPLAFONRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonrangka" id="rdo_plafonrangka4" value="4" onclick="document.getElementById('txt_plafonrangka').value = Math.round(((4.67/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOPLAFONRANGKA']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOPLAFONRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonrangka" id="rdo_plafonrangka5" value="5" onclick="document.getElementById('txt_plafonrangka').value = Math.round(((4.67/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOPLAFONRANGKA']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOPLAFONRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonrangka" id="rdo_plafonrangka6" value="6" onclick="document.getElementById('txt_plafonrangka').value = Math.round(((4.67/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOPLAFONRANGKA']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOPLAFONRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonrangka" id="rdo_plafonrangka7" value="7" onclick="document.getElementById('txt_plafonrangka').value = Math.round(((4.67/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOPLAFONRANGKA']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOPLAFONRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonrangka" id="rdo_plafonrangka8" value="8" onclick="document.getElementById('txt_plafonrangka').value = Math.round(((4.67/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOPLAFONRANGKA']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOPLAFONRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonrangka" id="rdo_plafonrangka9" value="9" onclick="document.getElementById('txt_plafonrangka').value = Math.round(((4.67/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOPLAFONRANGKA']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOPLAFONRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonrangka" id="rdo_plafonrangka10" value="10" onclick="document.getElementById('txt_plafonrangka').value = Math.round(((4.67/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOPLAFONRANGKA']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOPLAFONRANGKA']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_plafonrangka" id="lc_plafonrangka" value="<?php echo $data['RDOPLAFONRANGKA']; ?>">
                  <input type="text" class="form-control amount" name="txt_plafonrangka" id="txt_plafonrangka" value="<?php echo $data['PLAFONRANGKA']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_plafonrangka'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Penutup & Lis Plafon</td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonpenutup" id="rdo_plafonpenutup0" value="0" onclick="document.getElementById('txt_plafonpenutup').value = <?php echo $data['PLAFONPENUTUP']; ?>; calculate_total();" <?php if(0 <= $data2['RDOPLAFONPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonpenutup" id="rdo_plafonpenutup1" value="1" onclick="document.getElementById('txt_plafonpenutup').value = Math.round(((5.06/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOPLAFONPENUTUP']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOPLAFONPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonpenutup" id="rdo_plafonpenutup2" value="2" onclick="document.getElementById('txt_plafonpenutup').value = Math.round(((5.06/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOPLAFONPENUTUP']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOPLAFONPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonpenutup" id="rdo_plafonpenutup3" value="3" onclick="document.getElementById('txt_plafonpenutup').value = Math.round(((5.06/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOPLAFONPENUTUP']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOPLAFONPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonpenutup" id="rdo_plafonpenutup4" value="4" onclick="document.getElementById('txt_plafonpenutup').value = Math.round(((5.06/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOPLAFONPENUTUP']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOPLAFONPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonpenutup" id="rdo_plafonpenutup5" value="5" onclick="document.getElementById('txt_plafonpenutup').value = Math.round(((5.06/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOPLAFONPENUTUP']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOPLAFONPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonpenutup" id="rdo_plafonpenutup6" value="6" onclick="document.getElementById('txt_plafonpenutup').value = Math.round(((5.06/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOPLAFONPENUTUP']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOPLAFONPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonpenutup" id="rdo_plafonpenutup7" value="7" onclick="document.getElementById('txt_plafonpenutup').value = Math.round(((5.06/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOPLAFONPENUTUP']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOPLAFONPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonpenutup" id="rdo_plafonpenutup8" value="8" onclick="document.getElementById('txt_plafonpenutup').value = Math.round(((5.06/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOPLAFONPENUTUP']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOPLAFONPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonpenutup" id="rdo_plafonpenutup9" value="9" onclick="document.getElementById('txt_plafonpenutup').value = Math.round(((5.06/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOPLAFONPENUTUP']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOPLAFONPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafonpenutup" id="rdo_plafonpenutup10" value="10" onclick="document.getElementById('txt_plafonpenutup').value = Math.round(((5.06/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOPLAFONPENUTUP']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOPLAFONPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_plafonpenutup" id="lc_plafonpenutup" value="<?php echo $data['RDOPLAFONPENUTUP']; ?>">
                  <input type="text" class="form-control amount" name="txt_plafonpenutup" id="txt_plafonpenutup" value="<?php echo $data['PLAFONPENUTUP']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_plafonpenutup'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Cat</td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafoncat" id="rdo_plafoncat0" value="0" onclick="document.getElementById('txt_plafoncat').value = <?php echo $data['PLAFONCAT']; ?>; calculate_total();" <?php if(0 <= $data2['RDOPLAFONCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafoncat" id="rdo_plafoncat1" value="1" onclick="document.getElementById('txt_plafoncat').value = Math.round(((1.41/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOPLAFONCAT']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOPLAFONCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafoncat" id="rdo_plafoncat2" value="2" onclick="document.getElementById('txt_plafoncat').value = Math.round(((1.41/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOPLAFONCAT']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOPLAFONCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafoncat" id="rdo_plafoncat3" value="3" onclick="document.getElementById('txt_plafoncat').value = Math.round(((1.41/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOPLAFONCAT']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOPLAFONCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafoncat" id="rdo_plafoncat4" value="4" onclick="document.getElementById('txt_plafoncat').value = Math.round(((1.41/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOPLAFONCAT']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOPLAFONCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafoncat" id="rdo_plafoncat5" value="5" onclick="document.getElementById('txt_plafoncat').value = Math.round(((1.41/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOPLAFONCAT']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOPLAFONCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafoncat" id="rdo_plafoncat6" value="6" onclick="document.getElementById('txt_plafoncat').value = Math.round(((1.41/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOPLAFONCAT']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOPLAFONCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafoncat" id="rdo_plafoncat7" value="7" onclick="document.getElementById('txt_plafoncat').value = Math.round(((1.41/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOPLAFONCAT']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOPLAFONCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafoncat" id="rdo_plafoncat8" value="8" onclick="document.getElementById('txt_plafoncat').value = Math.round(((1.41/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOPLAFONCAT']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOPLAFONCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafoncat" id="rdo_plafoncat9" value="9" onclick="document.getElementById('txt_plafoncat').value = Math.round(((1.41/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOPLAFONCAT']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOPLAFONCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_plafoncat" id="rdo_plafoncat10" value="10" onclick="document.getElementById('txt_plafoncat').value = Math.round(((1.41/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOPLAFONCAT']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOPLAFONCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_plafoncat" id="lc_plafoncat" value="<?php echo $data['RDOPLAFONCAT']; ?>">
                  <input type="text" class="form-control amount" name="txt_plafoncat" id="txt_plafoncat" value="<?php echo $data['PLAFONCAT']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_plafoncat'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>3</td>
              <td>Dinding</td>
              <td>a. Kolom & Balok Ring</td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingkolom" id="rdo_dindingkolom0" value="0" onclick="document.getElementById('txt_dindingkolom').value = <?php echo $data['DINDINGKOLOM']; ?>; calculate_total();" <?php if(0 <= $data2['RDODINDINGKOLOM']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingkolom" id="rdo_dindingkolom1" value="1" onclick="document.getElementById('txt_dindingkolom').value = Math.round(((9.66/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDODINDINGKOLOM']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDODINDINGKOLOM']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingkolom" id="rdo_dindingkolom2" value="2" onclick="document.getElementById('txt_dindingkolom').value = Math.round(((9.66/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDODINDINGKOLOM']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDODINDINGKOLOM']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingkolom" id="rdo_dindingkolom3" value="3" onclick="document.getElementById('txt_dindingkolom').value = Math.round(((9.66/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDODINDINGKOLOM']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDODINDINGKOLOM']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingkolom" id="rdo_dindingkolom4" value="4" onclick="document.getElementById('txt_dindingkolom').value = Math.round(((9.66/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDODINDINGKOLOM']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDODINDINGKOLOM']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingkolom" id="rdo_dindingkolom5" value="5" onclick="document.getElementById('txt_dindingkolom').value = Math.round(((9.66/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDODINDINGKOLOM']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDODINDINGKOLOM']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingkolom" id="rdo_dindingkolom6" value="6" onclick="document.getElementById('txt_dindingkolom').value = Math.round(((9.66/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDODINDINGKOLOM']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDODINDINGKOLOM']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingkolom" id="rdo_dindingkolom7" value="7" onclick="document.getElementById('txt_dindingkolom').value = Math.round(((9.66/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDODINDINGKOLOM']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDODINDINGKOLOM']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingkolom" id="rdo_dindingkolom8" value="8" onclick="document.getElementById('txt_dindingkolom').value = Math.round(((9.66/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDODINDINGKOLOM']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDODINDINGKOLOM']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingkolom" id="rdo_dindingkolom9" value="9" onclick="document.getElementById('txt_dindingkolom').value = Math.round(((9.66/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDODINDINGKOLOM']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDODINDINGKOLOM']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingkolom" id="rdo_dindingkolom10" value="10" onclick="document.getElementById('txt_dindingkolom').value = Math.round(((9.66/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDODINDINGKOLOM']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDODINDINGKOLOM']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_dindingkolom" id="lc_dindingkolom" value="<?php echo $data['RDODINDINGKOLOM']; ?>">
                  <input type="text" class="form-control amount" name="txt_dindingkolom" id="txt_dindingkolom" value="<?php echo $data['DINDINGKOLOM']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_dindingkolom'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Bata/Dinding Pengisi</td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingbata" id="rdo_dindingbata0" value="0" onclick="document.getElementById('txt_dindingbata').value = <?php echo $data['DINDINGBATA']; ?>; calculate_total();" <?php if(0 <= $data2['RDODINDINGBATA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingbata" id="rdo_dindingbata1" value="1" onclick="document.getElementById('txt_dindingbata').value = Math.round(((13.68/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDODINDINGBATA']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDODINDINGBATA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingbata" id="rdo_dindingbata2" value="2" onclick="document.getElementById('txt_dindingbata').value = Math.round(((13.68/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDODINDINGBATA']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDODINDINGBATA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingbata" id="rdo_dindingbata3" value="3" onclick="document.getElementById('txt_dindingbata').value = Math.round(((13.68/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDODINDINGBATA']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDODINDINGBATA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingbata" id="rdo_dindingbata4" value="4" onclick="document.getElementById('txt_dindingbata').value = Math.round(((13.68/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDODINDINGBATA']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDODINDINGBATA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingbata" id="rdo_dindingbata5" value="5" onclick="document.getElementById('txt_dindingbata').value = Math.round(((13.68/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDODINDINGBATA']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDODINDINGBATA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingbata" id="rdo_dindingbata6" value="6" onclick="document.getElementById('txt_dindingbata').value = Math.round(((13.68/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDODINDINGBATA']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDODINDINGBATA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingbata" id="rdo_dindingbata7" value="7" onclick="document.getElementById('txt_dindingbata').value = Math.round(((13.68/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDODINDINGBATA']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDODINDINGBATA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingbata" id="rdo_dindingbata8" value="8" onclick="document.getElementById('txt_dindingbata').value = Math.round(((13.68/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDODINDINGBATA']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDODINDINGBATA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingbata" id="rdo_dindingbata9" value="9" onclick="document.getElementById('txt_dindingbata').value = Math.round(((13.68/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDODINDINGBATA']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDODINDINGBATA']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingbata" id="rdo_dindingbata10" value="10" onclick="document.getElementById('txt_dindingbata').value = Math.round(((13.68/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDODINDINGBATA']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDODINDINGBATA']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_dindingbata" id="lc_dindingbata" value="<?php echo $data['RDODINDINGBATA']; ?>">
                  <input type="text" class="form-control amount" name="txt_dindingbata" id="txt_dindingbata" value="<?php echo $data['DINDINGBATA']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_dindingbata'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Cat</td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingcat" id="rdo_dindingcat0" value="0" onclick="document.getElementById('txt_dindingcat').value = <?php echo $data['DINDINGCAT']; ?>; calculate_total();" <?php if(0 <= $data2['RDODINDINGCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingcat" id="rdo_dindingcat1" value="1" onclick="document.getElementById('txt_dindingcat').value = Math.round(((1.65/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDODINDINGCAT']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDODINDINGCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingcat" id="rdo_dindingcat2" value="2" onclick="document.getElementById('txt_dindingcat').value = Math.round(((1.65/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDODINDINGCAT']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDODINDINGCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingcat" id="rdo_dindingcat3" value="3" onclick="document.getElementById('txt_dindingcat').value = Math.round(((1.65/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDODINDINGCAT']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDODINDINGCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingcat" id="rdo_dindingcat4" value="4" onclick="document.getElementById('txt_dindingcat').value = Math.round(((1.65/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDODINDINGCAT']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDODINDINGCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingcat" id="rdo_dindingcat5" value="5" onclick="document.getElementById('txt_dindingcat').value = Math.round(((1.65/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDODINDINGCAT']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDODINDINGCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingcat" id="rdo_dindingcat6" value="6" onclick="document.getElementById('txt_dindingcat').value = Math.round(((1.65/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDODINDINGCAT']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDODINDINGCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingcat" id="rdo_dindingcat7" value="7" onclick="document.getElementById('txt_dindingcat').value = Math.round(((1.65/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDODINDINGCAT']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDODINDINGCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingcat" id="rdo_dindingcat8" value="8" onclick="document.getElementById('txt_dindingcat').value = Math.round(((1.65/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDODINDINGCAT']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDODINDINGCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingcat" id="rdo_dindingcat9" value="9" onclick="document.getElementById('txt_dindingcat').value = Math.round(((1.65/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDODINDINGCAT']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDODINDINGCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_dindingcat" id="rdo_dindingcat10" value="10" onclick="document.getElementById('txt_dindingcat').value = Math.round(((1.65/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDODINDINGCAT']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDODINDINGCAT']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_dindingcat" id="lc_dindingcat" value="<?php echo $data['RDODINDINGCAT']; ?>">
                  <input type="text" class="form-control amount" name="txt_dindingcat" id="txt_dindingcat" value="<?php echo $data['DINDINGCAT']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_dindingcat'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>4</td>
              <td>Pintu & Jendela</td>
              <td>a. Kusen</td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendelakusen" id="rdo_pintujendelakusen0" value="0" onclick="document.getElementById('txt_pintujendelakusen').value = <?php echo $data['PINTUJENDELAKUSEN']; ?>; calculate_total();" <?php if(0 <= $data2['RDOPINTUJENDELAKUSEN']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendelakusen" id="rdo_pintujendelakusen1" value="1" onclick="document.getElementById('txt_pintujendelakusen').value = Math.round(((2.70/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOPINTUJENDELAKUSEN']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOPINTUJENDELAKUSEN']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendelakusen" id="rdo_pintujendelakusen2" value="2" onclick="document.getElementById('txt_pintujendelakusen').value = Math.round(((2.70/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOPINTUJENDELAKUSEN']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOPINTUJENDELAKUSEN']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendelakusen" id="rdo_pintujendelakusen3" value="3" onclick="document.getElementById('txt_pintujendelakusen').value = Math.round(((2.70/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOPINTUJENDELAKUSEN']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOPINTUJENDELAKUSEN']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendelakusen" id="rdo_pintujendelakusen4" value="4" onclick="document.getElementById('txt_pintujendelakusen').value = Math.round(((2.70/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOPINTUJENDELAKUSEN']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOPINTUJENDELAKUSEN']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendelakusen" id="rdo_pintujendelakusen5" value="5" onclick="document.getElementById('txt_pintujendelakusen').value = Math.round(((2.70/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOPINTUJENDELAKUSEN']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOPINTUJENDELAKUSEN']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendelakusen" id="rdo_pintujendelakusen6" value="6" onclick="document.getElementById('txt_pintujendelakusen').value = Math.round(((2.70/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOPINTUJENDELAKUSEN']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOPINTUJENDELAKUSEN']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendelakusen" id="rdo_pintujendelakusen7" value="7" onclick="document.getElementById('txt_pintujendelakusen').value = Math.round(((2.70/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOPINTUJENDELAKUSEN']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOPINTUJENDELAKUSEN']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendelakusen" id="rdo_pintujendelakusen8" value="8" onclick="document.getElementById('txt_pintujendelakusen').value = Math.round(((2.70/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOPINTUJENDELAKUSEN']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOPINTUJENDELAKUSEN']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendelakusen" id="rdo_pintujendelakusen9" value="9" onclick="document.getElementById('txt_pintujendelakusen').value = Math.round(((2.70/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOPINTUJENDELAKUSEN']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOPINTUJENDELAKUSEN']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendelakusen" id="rdo_pintujendelakusen10" value="10" onclick="document.getElementById('txt_pintujendelakusen').value = Math.round(((2.70/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOPINTUJENDELAKUSEN']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOPINTUJENDELAKUSEN']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_pintujendelakusen" id="lc_pintujendelakusen" value="<?php echo $data['RDOPINTUJENDELAKUSEN']; ?>">
                  <input type="text" class="form-control amount" name="txt_pintujendelakusen" id="txt_pintujendelakusen" value="<?php echo $data['PINTUJENDELAKUSEN']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_pintujendelakusen'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Daun Pintu</td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunp" id="rdo_pintujendeladaunp0" value="0" onclick="document.getElementById('txt_pintujendeladaunp').value = <?php echo $data['PINTUJENDELADAUNP']; ?>; calculate_total();" <?php if(0 <= $data2['RDOPINTUJENDELADAUNP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunp" id="rdo_pintujendeladaunp1" value="1" onclick="document.getElementById('txt_pintujendeladaunp').value = Math.round(((2.47/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOPINTUJENDELADAUNP']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOPINTUJENDELADAUNP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunp" id="rdo_pintujendeladaunp2" value="2" onclick="document.getElementById('txt_pintujendeladaunp').value = Math.round(((2.47/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOPINTUJENDELADAUNP']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOPINTUJENDELADAUNP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunp" id="rdo_pintujendeladaunp3" value="3" onclick="document.getElementById('txt_pintujendeladaunp').value = Math.round(((2.47/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOPINTUJENDELADAUNP']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOPINTUJENDELADAUNP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunp" id="rdo_pintujendeladaunp4" value="4" onclick="document.getElementById('txt_pintujendeladaunp').value = Math.round(((2.47/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOPINTUJENDELADAUNP']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOPINTUJENDELADAUNP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunp" id="rdo_pintujendeladaunp5" value="5" onclick="document.getElementById('txt_pintujendeladaunp').value = Math.round(((2.47/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOPINTUJENDELADAUNP']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOPINTUJENDELADAUNP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunp" id="rdo_pintujendeladaunp6" value="6" onclick="document.getElementById('txt_pintujendeladaunp').value = Math.round(((2.47/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOPINTUJENDELADAUNP']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOPINTUJENDELADAUNP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunp" id="rdo_pintujendeladaunp7" value="7" onclick="document.getElementById('txt_pintujendeladaunp').value = Math.round(((2.47/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOPINTUJENDELADAUNP']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOPINTUJENDELADAUNP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunp" id="rdo_pintujendeladaunp8" value="8" onclick="document.getElementById('txt_pintujendeladaunp').value = Math.round(((2.47/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOPINTUJENDELADAUNP']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOPINTUJENDELADAUNP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunp" id="rdo_pintujendeladaunp9" value="9" onclick="document.getElementById('txt_pintujendeladaunp').value = Math.round(((2.47/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOPINTUJENDELADAUNP']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOPINTUJENDELADAUNP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunp" id="rdo_pintujendeladaunp10" value="10" onclick="document.getElementById('txt_pintujendeladaunp').value = Math.round(((2.47/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOPINTUJENDELADAUNP']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOPINTUJENDELADAUNP']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_pintujendeladaunp" id="lc_pintujendeladaunp" value="<?php echo $data['RDOPINTUJENDELADAUNP']; ?>">
                  <input type="text" class="form-control amount" name="txt_pintujendeladaunp" id="txt_pintujendeladaunp" value="<?php echo $data['PINTUJENDELADAUNP']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_pintujendeladaunp'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Daun Jendela</td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunj" id="rdo_pintujendeladaunj0" value="0" onclick="document.getElementById('txt_pintujendeladaunj').value = <?php echo $data['PINTUJENDELADAUNJ']; ?>; calculate_total();" <?php if(0 <= $data2['RDOPINTUJENDELADAUNJ']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunj" id="rdo_pintujendeladaunj1" value="1" onclick="document.getElementById('txt_pintujendeladaunj').value = Math.round(((5.15/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOPINTUJENDELADAUNJ']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOPINTUJENDELADAUNJ']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunj" id="rdo_pintujendeladaunj2" value="2" onclick="document.getElementById('txt_pintujendeladaunj').value = Math.round(((5.15/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOPINTUJENDELADAUNJ']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOPINTUJENDELADAUNJ']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunj" id="rdo_pintujendeladaunj3" value="3" onclick="document.getElementById('txt_pintujendeladaunj').value = Math.round(((5.15/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOPINTUJENDELADAUNJ']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOPINTUJENDELADAUNJ']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunj" id="rdo_pintujendeladaunj4" value="4" onclick="document.getElementById('txt_pintujendeladaunj').value = Math.round(((5.15/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOPINTUJENDELADAUNJ']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOPINTUJENDELADAUNJ']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunj" id="rdo_pintujendeladaunj5" value="5" onclick="document.getElementById('txt_pintujendeladaunj').value = Math.round(((5.15/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOPINTUJENDELADAUNJ']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOPINTUJENDELADAUNJ']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunj" id="rdo_pintujendeladaunj6" value="6" onclick="document.getElementById('txt_pintujendeladaunj').value = Math.round(((5.15/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOPINTUJENDELADAUNJ']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOPINTUJENDELADAUNJ']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunj" id="rdo_pintujendeladaunj7" value="7" onclick="document.getElementById('txt_pintujendeladaunj').value = Math.round(((5.15/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOPINTUJENDELADAUNJ']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOPINTUJENDELADAUNJ']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunj" id="rdo_pintujendeladaunj8" value="8" onclick="document.getElementById('txt_pintujendeladaunj').value = Math.round(((5.15/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOPINTUJENDELADAUNJ']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOPINTUJENDELADAUNJ']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunj" id="rdo_pintujendeladaunj9" value="9" onclick="document.getElementById('txt_pintujendeladaunj').value = Math.round(((5.15/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOPINTUJENDELADAUNJ']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOPINTUJENDELADAUNJ']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pintujendeladaunj" id="rdo_pintujendeladaunj10" value="10" onclick="document.getElementById('txt_pintujendeladaunj').value = Math.round(((5.15/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOPINTUJENDELADAUNJ']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOPINTUJENDELADAUNJ']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_pintujendeladaunj" id="lc_pintujendeladaunj" value="<?php echo $data['RDOPINTUJENDELADAUNJ']; ?>">
                  <input type="text" class="form-control amount" name="txt_pintujendeladaunj" id="txt_pintujendeladaunj" value="<?php echo $data['PINTUJENDELADAUNJ']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_pintujendeladaunj'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>5</td>
              <td>Lantai</td>
              <td>a. Struktur Bawah</td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaistruktur" id="rdo_lantaistruktur0" value="0" onclick="document.getElementById('txt_lantaistruktur').value = <?php echo $data['LANTAISTRUKTUR']; ?>; calculate_total();" <?php if(0 <= $data2['RDOLANTAISTRUKTUR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaistruktur" id="rdo_lantaistruktur1" value="1" onclick="document.getElementById('txt_lantaistruktur').value = Math.round(((2.89/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOLANTAISTRUKTUR']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOLANTAISTRUKTUR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaistruktur" id="rdo_lantaistruktur2" value="2" onclick="document.getElementById('txt_lantaistruktur').value = Math.round(((2.89/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOLANTAISTRUKTUR']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOLANTAISTRUKTUR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaistruktur" id="rdo_lantaistruktur3" value="3" onclick="document.getElementById('txt_lantaistruktur').value = Math.round(((2.89/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOLANTAISTRUKTUR']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOLANTAISTRUKTUR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaistruktur" id="rdo_lantaistruktur4" value="4" onclick="document.getElementById('txt_lantaistruktur').value = Math.round(((2.89/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOLANTAISTRUKTUR']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOLANTAISTRUKTUR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaistruktur" id="rdo_lantaistruktur5" value="5" onclick="document.getElementById('txt_lantaistruktur').value = Math.round(((2.89/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOLANTAISTRUKTUR']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOLANTAISTRUKTUR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaistruktur" id="rdo_lantaistruktur6" value="6" onclick="document.getElementById('txt_lantaistruktur').value = Math.round(((2.89/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOLANTAISTRUKTUR']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOLANTAISTRUKTUR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaistruktur" id="rdo_lantaistruktur7" value="7" onclick="document.getElementById('txt_lantaistruktur').value = Math.round(((2.89/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOLANTAISTRUKTUR']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOLANTAISTRUKTUR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaistruktur" id="rdo_lantaistruktur8" value="8" onclick="document.getElementById('txt_lantaistruktur').value = Math.round(((2.89/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOLANTAISTRUKTUR']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOLANTAISTRUKTUR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaistruktur" id="rdo_lantaistruktur9" value="9" onclick="document.getElementById('txt_lantaistruktur').value = Math.round(((2.89/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOLANTAISTRUKTUR']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOLANTAISTRUKTUR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaistruktur" id="rdo_lantaistruktur10" value="10" onclick="document.getElementById('txt_lantaistruktur').value = Math.round(((2.89/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOLANTAISTRUKTUR']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOLANTAISTRUKTUR']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_lantaistruktur" id="lc_lantaistruktur" value="<?php echo $data['RDOLANTAISTRUKTUR']; ?>">
                  <input type="text" class="form-control amount" name="txt_lantaistruktur" id="txt_lantaistruktur" value="<?php echo $data['LANTAISTRUKTUR']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_lantaistruktur'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Penutup Lantai</td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaipenutup" id="rdo_lantaipenutup0" value="0" onclick="document.getElementById('txt_lantaipenutup').value = <?php echo $data['LANTAIPENUTUP']; ?>; calculate_total();" <?php if(0 <= $data2['RDOLANTAIPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaipenutup" id="rdo_lantaipenutup1" value="1" onclick="document.getElementById('txt_lantaipenutup').value = Math.round(((8.96/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOLANTAIPENUTUP']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOLANTAIPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaipenutup" id="rdo_lantaipenutup2" value="2" onclick="document.getElementById('txt_lantaipenutup').value = Math.round(((8.96/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOLANTAIPENUTUP']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOLANTAIPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaipenutup" id="rdo_lantaipenutup3" value="3" onclick="document.getElementById('txt_lantaipenutup').value = Math.round(((8.96/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOLANTAIPENUTUP']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOLANTAIPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaipenutup" id="rdo_lantaipenutup4" value="4" onclick="document.getElementById('txt_lantaipenutup').value = Math.round(((8.96/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOLANTAIPENUTUP']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOLANTAIPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaipenutup" id="rdo_lantaipenutup5" value="5" onclick="document.getElementById('txt_lantaipenutup').value = Math.round(((8.96/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOLANTAIPENUTUP']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOLANTAIPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaipenutup" id="rdo_lantaipenutup6" value="6" onclick="document.getElementById('txt_lantaipenutup').value = Math.round(((8.96/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOLANTAIPENUTUP']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOLANTAIPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaipenutup" id="rdo_lantaipenutup7" value="7" onclick="document.getElementById('txt_lantaipenutup').value = Math.round(((8.96/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOLANTAIPENUTUP']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOLANTAIPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaipenutup" id="rdo_lantaipenutup8" value="8" onclick="document.getElementById('txt_lantaipenutup').value = Math.round(((8.96/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOLANTAIPENUTUP']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOLANTAIPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaipenutup" id="rdo_lantaipenutup9" value="9" onclick="document.getElementById('txt_lantaipenutup').value = Math.round(((8.96/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOLANTAIPENUTUP']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOLANTAIPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_lantaipenutup" id="rdo_lantaipenutup10" value="10" onclick="document.getElementById('txt_lantaipenutup').value = Math.round(((8.96/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOLANTAIPENUTUP']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOLANTAIPENUTUP']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_lantaipenutup" id="lc_lantaipenutup" value="<?php echo $data['RDOLANTAIPENUTUP']; ?>">
                  <input type="text" class="form-control amount" name="txt_lantaipenutup" id="txt_lantaipenutup" value="<?php echo $data['LANTAIPENUTUP']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_lantaipenutup'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>6</td>
              <td>Pondasi</td>
              <td>a. Pondasi</td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasi" id="rdo_pondasi0" value="0" onclick="document.getElementById('txt_pondasi').value = <?php echo $data['PONDASI']; ?>; calculate_total();" <?php if(0 <= $data2['RDOPONDASI']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasi" id="rdo_pondasi1" value="1" onclick="document.getElementById('txt_pondasi').value = Math.round(((11.15/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOPONDASI']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOPONDASI']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasi" id="rdo_pondasi2" value="2" onclick="document.getElementById('txt_pondasi').value = Math.round(((11.15/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOPONDASI']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOPONDASI']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasi" id="rdo_pondasi3" value="3" onclick="document.getElementById('txt_pondasi').value = Math.round(((11.15/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOPONDASI']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOPONDASI']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasi" id="rdo_pondasi4" value="4" onclick="document.getElementById('txt_pondasi').value = Math.round(((11.15/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOPONDASI']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOPONDASI']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasi" id="rdo_pondasi5" value="5" onclick="document.getElementById('txt_pondasi').value = Math.round(((11.15/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOPONDASI']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOPONDASI']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasi" id="rdo_pondasi6" value="6" onclick="document.getElementById('txt_pondasi').value = Math.round(((11.15/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOPONDASI']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOPONDASI']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasi" id="rdo_pondasi7" value="7" onclick="document.getElementById('txt_pondasi').value = Math.round(((11.15/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOPONDASI']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOPONDASI']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasi" id="rdo_pondasi8" value="8" onclick="document.getElementById('txt_pondasi').value = Math.round(((11.15/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOPONDASI']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOPONDASI']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasi" id="rdo_pondasi9" value="9" onclick="document.getElementById('txt_pondasi').value = Math.round(((11.15/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOPONDASI']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOPONDASI']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasi" id="rdo_pondasi10" value="10" onclick="document.getElementById('txt_pondasi').value = Math.round(((11.15/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOPONDASI']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOPONDASI']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_pondasi" id="lc_pondasi" value="<?php echo $data['RDOPONDASI']; ?>">
                  <input type="text" class="form-control amount" name="txt_pondasi" id="txt_pondasi" value="<?php echo $data['PONDASI']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_pondasi'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Sloof</td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasisloof" id="rdo_pondasisloof0" value="0" onclick="document.getElementById('txt_pondasisloof').value = <?php echo $data['PONDASISLOOF']; ?>; calculate_total();" <?php if(0 <= $data2['RDOPONDASISLOOF']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasisloof" id="rdo_pondasisloof1" value="1" onclick="document.getElementById('txt_pondasisloof').value = Math.round(((3.30/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOPONDASISLOOF']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOPONDASISLOOF']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasisloof" id="rdo_pondasisloof2" value="2" onclick="document.getElementById('txt_pondasisloof').value = Math.round(((3.30/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOPONDASISLOOF']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOPONDASISLOOF']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasisloof" id="rdo_pondasisloof3" value="3" onclick="document.getElementById('txt_pondasisloof').value = Math.round(((3.30/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOPONDASISLOOF']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOPONDASISLOOF']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasisloof" id="rdo_pondasisloof4" value="4" onclick="document.getElementById('txt_pondasisloof').value = Math.round(((3.30/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOPONDASISLOOF']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOPONDASISLOOF']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasisloof" id="rdo_pondasisloof5" value="5" onclick="document.getElementById('txt_pondasisloof').value = Math.round(((3.30/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOPONDASISLOOF']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOPONDASISLOOF']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasisloof" id="rdo_pondasisloof6" value="6" onclick="document.getElementById('txt_pondasisloof').value = Math.round(((3.30/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOPONDASISLOOF']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOPONDASISLOOF']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasisloof" id="rdo_pondasisloof7" value="7" onclick="document.getElementById('txt_pondasisloof').value = Math.round(((3.30/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOPONDASISLOOF']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOPONDASISLOOF']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasisloof" id="rdo_pondasisloof8" value="8" onclick="document.getElementById('txt_pondasisloof').value = Math.round(((3.30/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOPONDASISLOOF']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOPONDASISLOOF']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasisloof" id="rdo_pondasisloof9" value="9" onclick="document.getElementById('txt_pondasisloof').value = Math.round(((3.30/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOPONDASISLOOF']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOPONDASISLOOF']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_pondasisloof" id="rdo_pondasisloof10" value="10" onclick="document.getElementById('txt_pondasisloof').value = Math.round(((3.30/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOPONDASISLOOF']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOPONDASISLOOF']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_pondasisloof" id="lc_pondasisloof" value="<?php echo $data['RDOPONDASISLOOF']; ?>">
                  <input type="text" class="form-control amount" name="txt_pondasisloof" id="txt_pondasisloof" value="<?php echo $data['PONDASISLOOF']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_pondasisloof'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>7</td>
              <td>Utilitas</td>
              <td>a. Listrik</td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitaslistrik" id="rdo_utilitaslistrik0" value="0" onclick="document.getElementById('txt_utilitaslistrik').value = <?php echo $data['UTILITASLISTRIK']; ?>; calculate_total();" <?php if(0 <= $data2['RDOUTILITASLISTRIK']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitaslistrik" id="rdo_utilitaslistrik1" value="1" onclick="document.getElementById('txt_utilitaslistrik').value = Math.round(((1.79/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOUTILITASLISTRIK']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOUTILITASLISTRIK']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitaslistrik" id="rdo_utilitaslistrik2" value="2" onclick="document.getElementById('txt_utilitaslistrik').value = Math.round(((1.79/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOUTILITASLISTRIK']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOUTILITASLISTRIK']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitaslistrik" id="rdo_utilitaslistrik3" value="3" onclick="document.getElementById('txt_utilitaslistrik').value = Math.round(((1.79/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOUTILITASLISTRIK']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOUTILITASLISTRIK']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitaslistrik" id="rdo_utilitaslistrik4" value="4" onclick="document.getElementById('txt_utilitaslistrik').value = Math.round(((1.79/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOUTILITASLISTRIK']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOUTILITASLISTRIK']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitaslistrik" id="rdo_utilitaslistrik5" value="5" onclick="document.getElementById('txt_utilitaslistrik').value = Math.round(((1.79/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOUTILITASLISTRIK']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOUTILITASLISTRIK']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitaslistrik" id="rdo_utilitaslistrik6" value="6" onclick="document.getElementById('txt_utilitaslistrik').value = Math.round(((1.79/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOUTILITASLISTRIK']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOUTILITASLISTRIK']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitaslistrik" id="rdo_utilitaslistrik7" value="7" onclick="document.getElementById('txt_utilitaslistrik').value = Math.round(((1.79/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOUTILITASLISTRIK']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOUTILITASLISTRIK']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitaslistrik" id="rdo_utilitaslistrik8" value="8" onclick="document.getElementById('txt_utilitaslistrik').value = Math.round(((1.79/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOUTILITASLISTRIK']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOUTILITASLISTRIK']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitaslistrik" id="rdo_utilitaslistrik9" value="9" onclick="document.getElementById('txt_utilitaslistrik').value = Math.round(((1.79/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOUTILITASLISTRIK']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOUTILITASLISTRIK']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitaslistrik" id="rdo_utilitaslistrik10" value="10" onclick="document.getElementById('txt_utilitaslistrik').value = Math.round(((1.79/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOUTILITASLISTRIK']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOUTILITASLISTRIK']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_utilitaslistrik" id="lc_utilitaslistrik" value="<?php echo $data['RDOUTILITASLISTRIK']; ?>">
                  <input type="text" class="form-control amount" name="txt_utilitaslistrik" id="txt_utilitaslistrik" value="<?php echo $data['UTILITASLISTRIK']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_utilitaslistrik'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Instalasi Air Hujan & <br>Pasangan Rabat Beton <br>Keliling Bangunan</td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitasinstalasiair" id="rdo_utilitasinstalasiair0" value="0" onclick="document.getElementById('txt_utilitasinstalasiair').value = <?php echo $data['UTILITASINSTALASIAIR']; ?>; calculate_total();" <?php if(0 <= $data2['RDOUTILITASINSTALASIAIR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitasinstalasiair" id="rdo_utilitasinstalasiair1" value="1" onclick="document.getElementById('txt_utilitasinstalasiair').value = Math.round(((1.22/10)*1) * 100) / 100; calculate_total();" <?php if(1 <= $data['RDOUTILITASINSTALASIAIR']) echo "disabled='disabled'";?> <?php if(1 <= $data2['RDOUTILITASINSTALASIAIR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitasinstalasiair" id="rdo_utilitasinstalasiair2" value="2" onclick="document.getElementById('txt_utilitasinstalasiair').value = Math.round(((1.22/10)*2) * 100) / 100; calculate_total();" <?php if(2 <= $data['RDOUTILITASINSTALASIAIR']) echo "disabled='disabled'";?> <?php if(2 <= $data2['RDOUTILITASINSTALASIAIR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitasinstalasiair" id="rdo_utilitasinstalasiair3" value="3" onclick="document.getElementById('txt_utilitasinstalasiair').value = Math.round(((1.22/10)*3) * 100) / 100; calculate_total();" <?php if(3 <= $data['RDOUTILITASINSTALASIAIR']) echo "disabled='disabled'";?> <?php if(3 <= $data2['RDOUTILITASINSTALASIAIR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitasinstalasiair" id="rdo_utilitasinstalasiair4" value="4" onclick="document.getElementById('txt_utilitasinstalasiair').value = Math.round(((1.22/10)*4) * 100) / 100; calculate_total();" <?php if(4 <= $data['RDOUTILITASINSTALASIAIR']) echo "disabled='disabled'";?> <?php if(4 <= $data2['RDOUTILITASINSTALASIAIR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitasinstalasiair" id="rdo_utilitasinstalasiair5" value="5" onclick="document.getElementById('txt_utilitasinstalasiair').value = Math.round(((1.22/10)*5) * 100) / 100; calculate_total();" <?php if(5 <= $data['RDOUTILITASINSTALASIAIR']) echo "disabled='disabled'";?> <?php if(5 <= $data2['RDOUTILITASINSTALASIAIR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitasinstalasiair" id="rdo_utilitasinstalasiair6" value="6" onclick="document.getElementById('txt_utilitasinstalasiair').value = Math.round(((1.22/10)*6) * 100) / 100; calculate_total();" <?php if(6 <= $data['RDOUTILITASINSTALASIAIR']) echo "disabled='disabled'";?> <?php if(6 <= $data2['RDOUTILITASINSTALASIAIR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitasinstalasiair" id="rdo_utilitasinstalasiair7" value="7" onclick="document.getElementById('txt_utilitasinstalasiair').value = Math.round(((1.22/10)*7) * 100) / 100; calculate_total();" <?php if(7 <= $data['RDOUTILITASINSTALASIAIR']) echo "disabled='disabled'";?> <?php if(7 <= $data2['RDOUTILITASINSTALASIAIR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitasinstalasiair" id="rdo_utilitasinstalasiair8" value="8" onclick="document.getElementById('txt_utilitasinstalasiair').value = Math.round(((1.22/10)*8) * 100) / 100; calculate_total();" <?php if(8 <= $data['RDOUTILITASINSTALASIAIR']) echo "disabled='disabled'";?> <?php if(8 <= $data2['RDOUTILITASINSTALASIAIR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitasinstalasiair" id="rdo_utilitasinstalasiair9" value="9" onclick="document.getElementById('txt_utilitasinstalasiair').value = Math.round(((1.22/10)*9) * 100) / 100; calculate_total();" <?php if(9 <= $data['RDOUTILITASINSTALASIAIR']) echo "disabled='disabled'";?> <?php if(9 <= $data2['RDOUTILITASINSTALASIAIR']) echo "checked='checked'";?>></input></label></div></td>
              <td><div class="radio"><label><input type="radio" name="rdo_utilitasinstalasiair" id="rdo_utilitasinstalasiair10" value="10" onclick="document.getElementById('txt_utilitasinstalasiair').value = Math.round(((1.22/10)*10) * 100) / 100; calculate_total();" <?php if(10 <= $data['RDOUTILITASINSTALASIAIR']) echo "disabled='disabled'";?> <?php if(10 <= $data2['RDOUTILITASINSTALASIAIR']) echo "checked='checked'";?>></input></label></div></td>
              <td>
                <div class="col-sm-6">
                  <input type="hidden" name="lc_utilitasinstalasiair" id="lc_utilitasinstalasiair" value="<?php echo $data['RDOUTILITASINSTALASIAIR']; ?>">
                  <input type="text" class="form-control amount" name="txt_utilitasinstalasiair" id="txt_utilitasinstalasiair" value="<?php echo $data['UTILITASINSTALASIAIR']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_utilitasinstalasiair'); ?></span>
                </div>
              </td>
            </tr>

          </tbody>

          <tfoot>
            <tr>
              <th colspan="2"><div class="form-group"><label class="col-sm-2 control-label">Jumlah</label></div></th>
              <th colspan="12"></th>
              <th>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="txt_total" id="txt_total" value="<?php echo $data['TOTAL']; ?>" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_total'); ?></span>
                </div>
              </th>
            </tr>

            <tr>
              <th colspan="2"><div class="form-group"><label class="col-sm-2 control-label" for="exampleInputFile">Video</label></div></th>
              <th colspan="13">
                <div class="col-sm-10">
                  <input type="file" id="exampleInputFile" name="txt_video">
                  <span class="text-red"><?php echo form_error('txt_video'); ?></span>
                </div>
              </th>
            </tr>
          </tfoot>
        </table>

        <!-- <div class="form-group">
          <label for="exampleInputFile">File input</label>
          <input type="file" id="exampleInputFile">
        </div> -->

        <!-- <div class="form-group">
          <label class="col-sm-2 control-label" for="exampleInputFile">Video</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="exampleInputFile" name="txt_video">
            <span class="text-red"><?php echo form_error('txt_video'); ?></span>
          </div>
        </div> -->

        <div class="form-group">
          <label class="col-sm-2 control-label">Keterangan</label>
          <div class="col-sm-6">
            <textarea class="form-control" rows="3" name="txt_note" id="txt_note" placeholder="Enter ..." maxlength="255"><?php echo $data['NOTE']; ?></textarea>
          </div>
        </div>

      </div><!-- /.box-body -->

      <div class="box-footer">
        <!-- <button type="submit" class="btn btn-danger" name="btn_cancel" id="btn_cancel" value="Batal">Batal</button> -->
        <a class="btn btn-danger" name="btn_cancel" id="btn_cancel" href="<?php echo base_url()."progress"; ?>">Batal</a>
        <button type="submit" class="btn btn-primary pull-right" name="btn_save" id="btn_save" value="Simpan">Simpan</button>
      </div>
    </form>

    <!-- <div id="progress" class="hide">
    <div id="bar"></div>
    <div id="percent">0%</div>
    </div>
    <br/>

    <div id="message"></div> -->

    <!-- <form id="formupload" action="<?php echo site_url('progress/upload'); ?>" class="dropzone dz-clickable">
    </form> -->

  </div><!-- /.box -->
</div><!--/.col (left) -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script type="text/javascript">
  function calculate_total() {
    var total = 0;

    $(".amount").each(function() {
      total += parseFloat(this.value);
    });

    $("#txt_total").val(Math.round(total * 100) / 100);
  }

  $("#form").submit(function(){
    var proctype = $("#cmb_proctype").val();
    var step = parseInt($("#txt_step").val(),10);
    var total = parseFloat($("#txt_total").val(),10);

    if(proctype == "PL01"){
      if(step === 1){
        if(total < 55){
          alert("Total progress yang terlaporkan belum memenuhi bobot progress pada tahap ini");
          return false;
        }
      }
      if(step === 2){
        if(total < 100){
          alert("Total progress yang terlaporkan belum memenuhi bobot progress pada tahap ini");
          return false;
        }
      }
    }
    if(proctype == "PL02"){
      if(step === 1){
        if(total < 30){
          alert("Total progress yang terlaporkan belum memenuhi bobot progress pada tahap ini");
          return false;
        }
      }
      if(step === 2){
        if(total < 60){
          alert("Total progress yang terlaporkan belum memenuhi bobot progress pada tahap ini");
          return false;
        }
      }
      if(step === 3){
        if(total < 80){
          alert("Total progress yang terlaporkan belum memenuhi bobot progress pada tahap ini");
          return false;
        }
      }
      if(step === 4){
        if(total < 100){
          alert("Total progress yang terlaporkan belum memenuhi bobot progress pada tahap ini");
          return false;
        }
      }
    }
  });
</script>