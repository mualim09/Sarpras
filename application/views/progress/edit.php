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
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Progress</label>
          <div class="col-sm-3">
            <select class="form-control select2" name="cmb_progress" id="cmb_progress" style="width: 100%;">
              <option value="">--PILIH PROGRESS--</option>
              <option value="1" <?php if('1' == $data['STEP']) echo "selected='selected'";?>>30%</option>
              <option value="2" <?php if('2' == $data['STEP']) echo "selected='selected'";?>>50%</option>
              <option value="3" <?php if('3' == $data['STEP']) echo "selected='selected'";?>>80%</option>
              <option value="4" <?php if('4' == $data['STEP']) echo "selected='selected'";?>>100%</option>
            </select>
            <span class="text-red"><?php echo form_error('cmb_step'); ?></span>
          </div>
        </div>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Komponen<br>Bangunan</th>
              <th>Sub Komponen<br>Bangunan</th>
              <th colspan="10">Progress</th>
              <th>Bobot</th>
            </tr>
          </thead>
          
          <tbody>
            <tr>
              <td>1</td>
              <td>Atap</td>
              <td>a. Penutup Atap</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_atappenutup" id="txt_atappenutup" value="<?php echo $data['ATAPPENUTUP']; ?>">
                  <span class="text-red"><?php echo form_error('txt_atappenutup'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Rangka Atap</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_ataprangka" id="txt_ataprangka" value="<?php echo $data['ATAPRANGKA']; ?>">
                  <span class="text-red"><?php echo form_error('txt_ataprangka'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Lis Plang & Talang</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_ataplis" id="txt_ataplis" value="<?php echo $data['ATAPLIS']; ?>">
                  <span class="text-red"><?php echo form_error('txt_ataplis'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>2</td>
              <td>Plafon</td>
              <td>a. Rangka Plafon</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_plafonrangka" id="txt_plafonrangka" value="<?php echo $data['PLAFONRANGKA']; ?>">
                  <span class="text-red"><?php echo form_error('txt_plafonrangka'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Penutup & Lis Plafon</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_plafonpenutup" id="txt_plafonpenutup" value="<?php echo $data['PLAFONPENUTUP']; ?>">
                  <span class="text-red"><?php echo form_error('txt_plafonpenutup'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Cat</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_plafoncat" id="txt_plafoncat" value="<?php echo $data['PLAFONCAT']; ?>">
                  <span class="text-red"><?php echo form_error('txt_plafoncat'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>3</td>
              <td>Dinding</td>
              <td>a. Kolom & Balok Ring</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_dindingkolom" id="txt_dindingkolom" value="<?php echo $data['DINDINGKOLOM']; ?>">
                  <span class="text-red"><?php echo form_error('txt_dindingkolom'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Bata/Dinding Pengisi</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_dindingbata" id="txt_dindingbata" value="<?php echo $data['DINDINGBATA']; ?>">
                  <span class="text-red"><?php echo form_error('txt_dindingbata'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Cat</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_dindingcat" id="txt_dindingcat" value="<?php echo $data['DINDINGCAT']; ?>">
                  <span class="text-red"><?php echo form_error('txt_dindingcat'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>4</td>
              <td>Pintu & Jendela</td>
              <td>a. Kusen</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_pintujendelakusen" id="txt_pintujendelakusen" value="<?php echo $data['PINTUJENDELAKUSEN']; ?>">
                  <span class="text-red"><?php echo form_error('txt_pintujendelakusen'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Daun Pintu</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_pintujendeladaunp" id="txt_pintujendeladaunp" value="<?php echo $data['PINTUJENDELADAUNP']; ?>">
                  <span class="text-red"><?php echo form_error('txt_pintujendeladaunp'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Daun Jendela</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_pintujendeladaunj" id="txt_pintujendeladaunj" value="<?php echo $data['PINTUJENDELADAUNJ']; ?>">
                  <span class="text-red"><?php echo form_error('txt_pintujendeladaunj'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>5</td>
              <td>Lantai</td>
              <td>a. Struktur Bawah</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_lantaistruktur" id="txt_lantaistruktur" value="<?php echo $data['LANTAISTRUKTUR']; ?>">
                  <span class="text-red"><?php echo form_error('txt_lantaistruktur'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Penutup Lantai</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_lantaipenutup" id="txt_lantaipenutup" value="<?php echo $data['LANTAIPENUTUP']; ?>">
                  <span class="text-red"><?php echo form_error('txt_lantaipenutup'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>6</td>
              <td>Pondasi</td>
              <td>a. Pondasi</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_pondasi" id="txt_pondasi" value="<?php echo $data['PONDASI']; ?>">
                  <span class="text-red"><?php echo form_error('txt_pondasi'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Sloof</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_pondasisloof" id="txt_pondasisloof" value="<?php echo $data['PONDASISLOOF']; ?>">
                  <span class="text-red"><?php echo form_error('txt_pondasisloof'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td>7</td>
              <td>Utilitas</td>
              <td>a. Listrik</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_utilitaslistrik" id="txt_utilitaslistrik" value="<?php echo $data['UTILITASLISTRIK']; ?>">
                  <span class="text-red"><?php echo form_error('txt_utilitaslistrik'); ?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Instalasi Air Hujan & <br>Pasangan Rabat Beton <br>Keliling Bangunan</td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress1" id="cbx_progress1"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress2" id="cbx_progress2"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress3" id="cbx_progress3"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress4" id="cbx_progress4"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress5" id="cbx_progress5"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress6" id="cbx_progress6"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress7" id="cbx_progress7"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress8" id="cbx_progress8"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress9" id="cbx_progress9"></input></label></div></td>
              <td><div class="checkbox"><label><input type="checkbox" name="cbx_progress10" id="cbx_progress10"></input></label></div></td>
              <td>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_utilitasinstalasiair" id="txt_utilitasinstalasiair" value="<?php echo $data['UTILITASINSTALASIAIR']; ?>">
                  <span class="text-red"><?php echo form_error('txt_utilitasinstalasiair'); ?></span>
                </div>
              </td>
            </tr>

          </tbody>

          <tfoot>
            <tr>
              <th colspan="13">Jumlah</th>
              <th>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="txt_total" id="txt_total" value="<?php echo $data['TOTAL']; ?>">
                  <span class="text-red"><?php echo form_error('txt_total'); ?></span>
                </div>
              </th>
            </tr>
          </tfoot>
        </table>
      </div><!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-danger" name="btn_cancel" id="btn_cancel" value="Batal">Batal</button>
        <button type="submit" class="btn btn-primary pull-right" name="btn_save" id="btn_save" value="Simpan">Simpan</button>
      </div>
    </form>
  </div><!-- /.box -->
</div><!--/.col (left) -->