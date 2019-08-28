<div class="col-md-6">
  <!-- general form elements -->
  <div class="box box-primary pre-scrollable" style="height: 800px">
    <!-- form start -->
    <form class="form-horizontal" id="form" role="form" action="#">
      <div class="box-body">

        <div class="form-group">
          <label class="col-sm-5 control-label">Nama Kegiatan</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" name="txt_procdesc" id="txt_procdesc" value="<?php echo $data['PROCDESC']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_procdesc'); ?></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Kecamatan</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" name="txt_subdistrict" id="txt_subdistrict" value="<?php echo $data['SUBDISTRICT']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_subdistrict'); ?></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Level Sekolah</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="txt_schoollevel" id="txt_schoollevel" value="<?php echo $data['SCHOOLLEVEL']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_schoollevel'); ?></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Step</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="txt_step" id="txt_step" maxlength="1" value="<?php echo $data['STEP']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_step'); ?></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Konsultan Pengawas</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" name="txt_svname" id="txt_svname" value="<?php echo $data['SVNAME']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_svname'); ?></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Penyedia Jasa</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" name="txt_pvname" id="txt_pvname" value="<?php echo $data['PVNAME']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_pvname'); ?></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Tgl. Perhitungan Teknis</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="txt_duedate" id="txt_duedate" value="<?php echo $data['DUEDATE']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_duedate'); ?></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Tgl. Pelaporan</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="txt_created" id="txt_created" value="<?php echo $data['CREATED']; ?>" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_created'); ?></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Realisasi Keuangan yang ditagihkan sesuai Nilai Termin</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" name="txt_subcontractvalue" id="txt_subcontractvalue" value="" readonly="readonly">
            <span class="text-red"><?php echo form_error('txt_subcontractvalue'); ?></span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-5 control-label">Keterangan</label>
          <div class="col-sm-7">
            <textarea class="form-control" rows="3" name="txt_note" id="txt_note" placeholder="Enter ..." maxlength="255" readonly="readonly"><?php echo $data['NOTE']; ?></textarea>
          </div>
        </div>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Komponen<br>Bangunan</th>
              <th>Sub Komponen<br>Bangunan</th>
              <th>Progress</th>
              <th>Value</th>
            </tr>
          </thead>
          
          <tbody>
            <!-- start edit 12april2016 -->
            <tr>
              <td>1</td>
              <td>Atap</td>
              <td>a. Penutup Atap</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOATAPPENUTUP'] <= 3){echo "progress-bar-danger";}elseif($data['RDOATAPPENUTUP'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOATAPPENUTUP'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOATAPPENUTUP'] == 0){echo "0%";}else{echo $data['RDOATAPPENUTUP']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOATAPPENUTUP'] <= 3){echo "bg-red";}elseif($data['RDOATAPPENUTUP'] <= 6){echo "bg-yellow";}elseif($data['RDOATAPPENUTUP'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOATAPPENUTUP'] == 0){echo "0%";}else{echo $data['RDOATAPPENUTUP']."0%";} ?></span></td>
            </tr>
            <!-- end edit 12april2016 -->
            <tr>
              <td></td>
              <td></td>
              <td>b. Rangka Atap</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOATAPRANGKA'] <= 3){echo "progress-bar-danger";}elseif($data['RDOATAPRANGKA'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOATAPRANGKA'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOATAPRANGKA'] == 0){echo "0%";}else{echo $data['RDOATAPRANGKA']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOATAPRANGKA'] <= 3){echo "bg-red";}elseif($data['RDOATAPRANGKA'] <= 6){echo "bg-yellow";}elseif($data['RDOATAPRANGKA'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOATAPRANGKA'] == 0){echo "0%";}else{echo $data['RDOATAPRANGKA']."0%";} ?></span></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Lis Plang & Talang</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOATAPLIS'] <= 3){echo "progress-bar-danger";}elseif($data['RDOATAPLIS'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOATAPLIS'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOATAPLIS'] == 0){echo "0%";}else{echo $data['RDOATAPLIS']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOATAPLIS'] <= 3){echo "bg-red";}elseif($data['RDOATAPLIS'] <= 6){echo "bg-yellow";}elseif($data['RDOATAPLIS'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOATAPLIS'] == 0){echo "0%";}else{echo $data['RDOATAPLIS']."0%";} ?></span></td>
            </tr>

            <tr>
              <td>2</td>
              <td>Plafon</td>
              <td>a. Rangka Plafon</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOPLAFONRANGKA'] <= 3){echo "progress-bar-danger";}elseif($data['RDOPLAFONRANGKA'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOPLAFONRANGKA'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOPLAFONRANGKA'] == 0){echo "0%";}else{echo $data['RDOPLAFONRANGKA']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOPLAFONRANGKA'] <= 3){echo "bg-red";}elseif($data['RDOPLAFONRANGKA'] <= 6){echo "bg-yellow";}elseif($data['RDOPLAFONRANGKA'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOPLAFONRANGKA'] == 0){echo "0%";}else{echo $data['RDOPLAFONRANGKA']."0%";} ?></span></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Penutup & Lis Plafon</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOPLAFONPENUTUP'] <= 3){echo "progress-bar-danger";}elseif($data['RDOPLAFONPENUTUP'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOPLAFONPENUTUP'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOPLAFONPENUTUP'] == 0){echo "0%";}else{echo $data['RDOPLAFONPENUTUP']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOPLAFONPENUTUP'] <= 3){echo "bg-red";}elseif($data['RDOPLAFONPENUTUP'] <= 6){echo "bg-yellow";}elseif($data['RDOPLAFONPENUTUP'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOPLAFONPENUTUP'] == 0){echo "0%";}else{echo $data['RDOPLAFONPENUTUP']."0%";} ?></span></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Cat</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOPLAFONCAT'] <= 3){echo "progress-bar-danger";}elseif($data['RDOPLAFONCAT'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOPLAFONCAT'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOPLAFONCAT'] == 0){echo "0%";}else{echo $data['RDOPLAFONCAT']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOPLAFONCAT'] <= 3){echo "bg-red";}elseif($data['RDOPLAFONCAT'] <= 6){echo "bg-yellow";}elseif($data['RDOPLAFONCAT'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOPLAFONCAT'] == 0){echo "0%";}else{echo $data['RDOPLAFONCAT']."0%";} ?></span></td>
            </tr>

            <tr>
              <td>3</td>
              <td>Dinding</td>
              <td>a. Kolom & Balok Ring</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDODINDINGKOLOM'] <= 3){echo "progress-bar-danger";}elseif($data['RDODINDINGKOLOM'] <= 6){echo "progress-bar-yellow";}elseif($data['RDODINDINGKOLOM'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDODINDINGKOLOM'] == 0){echo "0%";}else{echo $data['RDODINDINGKOLOM']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDODINDINGKOLOM'] <= 3){echo "bg-red";}elseif($data['RDODINDINGKOLOM'] <= 6){echo "bg-yellow";}elseif($data['RDODINDINGKOLOM'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDODINDINGKOLOM'] == 0){echo "0%";}else{echo $data['RDODINDINGKOLOM']."0%";} ?></span></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Bata/Dinding Pengisi</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDODINDINGBATA'] <= 3){echo "progress-bar-danger";}elseif($data['RDODINDINGBATA'] <= 6){echo "progress-bar-yellow";}elseif($data['RDODINDINGBATA'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDODINDINGBATA'] == 0){echo "0%";}else{echo $data['RDODINDINGBATA']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDODINDINGBATA'] <= 3){echo "bg-red";}elseif($data['RDODINDINGBATA'] <= 6){echo "bg-yellow";}elseif($data['RDODINDINGBATA'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDODINDINGBATA'] == 0){echo "0%";}else{echo $data['RDODINDINGBATA']."0%";} ?></span></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Cat</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDODINDINGCAT'] <= 3){echo "progress-bar-danger";}elseif($data['RDODINDINGCAT'] <= 6){echo "progress-bar-yellow";}elseif($data['RDODINDINGCAT'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDODINDINGCAT'] == 0){echo "0%";}else{echo $data['RDODINDINGCAT']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDODINDINGCAT'] <= 3){echo "bg-red";}elseif($data['RDODINDINGCAT'] <= 6){echo "bg-yellow";}elseif($data['RDODINDINGCAT'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDODINDINGCAT'] == 0){echo "0%";}else{echo $data['RDODINDINGCAT']."0%";} ?></span></td>
            </tr>

            <tr>
              <td>4</td>
              <td>Pintu & Jendela</td>
              <td>a. Kusen</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOPINTUJENDELAKUSEN'] <= 3){echo "progress-bar-danger";}elseif($data['RDOPINTUJENDELAKUSEN'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOPINTUJENDELAKUSEN'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOPINTUJENDELAKUSEN'] == 0){echo "0%";}else{echo $data['RDOPINTUJENDELAKUSEN']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOPINTUJENDELAKUSEN'] <= 3){echo "bg-red";}elseif($data['RDOPINTUJENDELAKUSEN'] <= 6){echo "bg-yellow";}elseif($data['RDOPINTUJENDELAKUSEN'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOPINTUJENDELAKUSEN'] == 0){echo "0%";}else{echo $data['RDOPINTUJENDELAKUSEN']."0%";} ?></span></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Daun Pintu</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOPINTUJENDELADAUNP'] <= 3){echo "progress-bar-danger";}elseif($data['RDOPINTUJENDELADAUNP'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOPINTUJENDELADAUNP'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOPINTUJENDELADAUNP'] == 0){echo "0%";}else{echo $data['RDOPINTUJENDELADAUNP']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOPINTUJENDELADAUNP'] <= 3){echo "bg-red";}elseif($data['RDOPINTUJENDELADAUNP'] <= 6){echo "bg-yellow";}elseif($data['RDOPINTUJENDELADAUNP'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOPINTUJENDELADAUNP'] == 0){echo "0%";}else{echo $data['RDOPINTUJENDELADAUNP']."0%";} ?></span></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>c. Daun Jendela</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOPINTUJENDELADAUNJ'] <= 3){echo "progress-bar-danger";}elseif($data['RDOPINTUJENDELADAUNJ'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOPINTUJENDELADAUNJ'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOPINTUJENDELADAUNJ'] == 0){echo "0%";}else{echo $data['RDOPINTUJENDELADAUNJ']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOPINTUJENDELADAUNJ'] <= 3){echo "bg-red";}elseif($data['RDOPINTUJENDELADAUNJ'] <= 6){echo "bg-yellow";}elseif($data['RDOPINTUJENDELADAUNJ'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOPINTUJENDELADAUNJ'] == 0){echo "0%";}else{echo $data['RDOPINTUJENDELADAUNJ']."0%";} ?></span></td>
            </tr>

            <tr>
              <td>5</td>
              <td>Lantai</td>
              <td>a. Struktur Bawah</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOLANTAISTRUKTUR'] <= 3){echo "progress-bar-danger";}elseif($data['RDOLANTAISTRUKTUR'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOLANTAISTRUKTUR'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOLANTAISTRUKTUR'] == 0){echo "0%";}else{echo $data['RDOLANTAISTRUKTUR']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOLANTAISTRUKTUR'] <= 3){echo "bg-red";}elseif($data['RDOLANTAISTRUKTUR'] <= 6){echo "bg-yellow";}elseif($data['RDOLANTAISTRUKTUR'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOLANTAISTRUKTUR'] == 0){echo "0%";}else{echo $data['RDOLANTAISTRUKTUR']."0%";} ?></span></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Penutup Lantai</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOLANTAIPENUTUP'] <= 3){echo "progress-bar-danger";}elseif($data['RDOLANTAIPENUTUP'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOLANTAIPENUTUP'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOLANTAIPENUTUP'] == 0){echo "0%";}else{echo $data['RDOLANTAIPENUTUP']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOLANTAIPENUTUP'] <= 3){echo "bg-red";}elseif($data['RDOLANTAIPENUTUP'] <= 6){echo "bg-yellow";}elseif($data['RDOLANTAIPENUTUP'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOLANTAIPENUTUP'] == 0){echo "0%";}else{echo $data['RDOLANTAIPENUTUP']."0%";} ?></span></td>
            </tr>

            <tr>
              <td>6</td>
              <td>Pondasi</td>
              <td>a. Pondasi</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOPONDASI'] <= 3){echo "progress-bar-danger";}elseif($data['RDOPONDASI'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOPONDASI'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOPONDASI'] == 0){echo "0%";}else{echo $data['RDOPONDASI']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOPONDASI'] <= 3){echo "bg-red";}elseif($data['RDOPONDASI'] <= 6){echo "bg-yellow";}elseif($data['RDOPONDASI'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOPONDASI'] == 0){echo "0%";}else{echo $data['RDOPONDASI']."0%";} ?></span></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Sloof</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOPONDASISLOOF'] <= 3){echo "progress-bar-danger";}elseif($data['RDOPONDASISLOOF'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOPONDASISLOOF'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOPONDASISLOOF'] == 0){echo "0%";}else{echo $data['RDOPONDASISLOOF']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOPONDASISLOOF'] <= 3){echo "bg-red";}elseif($data['RDOPONDASISLOOF'] <= 6){echo "bg-yellow";}elseif($data['RDOPONDASISLOOF'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOPONDASISLOOF'] == 0){echo "0%";}else{echo $data['RDOPONDASISLOOF']."0%";} ?></span></td>
            </tr>

            <tr>
              <td>7</td>
              <td>Utilitas</td>
              <td>a. Listrik</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOUTILITASLISTRIK'] <= 3){echo "progress-bar-danger";}elseif($data['RDOUTILITASLISTRIK'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOUTILITASLISTRIK'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOUTILITASLISTRIK'] == 0){echo "0%";}else{echo $data['RDOUTILITASLISTRIK']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOUTILITASLISTRIK'] <= 3){echo "bg-red";}elseif($data['RDOUTILITASLISTRIK'] <= 6){echo "bg-yellow";}elseif($data['RDOUTILITASLISTRIK'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOUTILITASLISTRIK'] == 0){echo "0%";}else{echo $data['RDOUTILITASLISTRIK']."0%";} ?></span></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td>b. Instalasi Air Hujan & <br>Pasangan Rabat Beton <br>Keliling Bangunan</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar <?php if($data['RDOUTILITASINSTALASIAIR'] <= 3){echo "progress-bar-danger";}elseif($data['RDOUTILITASINSTALASIAIR'] <= 6){echo "progress-bar-yellow";}elseif($data['RDOUTILITASINSTALASIAIR'] <= 8){echo "progress-bar-success";}else{echo "progress-bar-primary";} ?>" style="width: <?php if($data['RDOUTILITASINSTALASIAIR'] == 0){echo "0%";}else{echo $data['RDOUTILITASINSTALASIAIR']."0%";} ?>"></div>
                </div>
              </td>
              <td><span class="badge <?php if($data['RDOUTILITASINSTALASIAIR'] <= 3){echo "bg-red";}elseif($data['RDOUTILITASINSTALASIAIR'] <= 6){echo "bg-yellow";}elseif($data['RDOUTILITASINSTALASIAIR'] <= 8){echo "bg-green";}else{echo "bg-light-blue";} ?>"><?php if($data['RDOUTILITASINSTALASIAIR'] == 0){echo "0%";}else{echo $data['RDOUTILITASINSTALASIAIR']."0%";} ?></span></td>
            </tr>

          </tbody>

          <tfoot>
            <tr>
              <th colspan="2"><div class="form-group"><label class="col-sm-2 control-label">Jumlah</label></div></th>
              <th colspan="2"></th>
              <th>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="txt_total" id="txt_total" value="<?php echo $data['TOTAL']; ?>%" readonly="readonly" style="text-align:right;">
                  <span class="text-red"><?php echo form_error('txt_total'); ?></span>
                </div>
              </th>
            </tr>
          </tfoot>
        </table>

      </div><!-- /.box-body -->

      
    </form>

  </div><!-- /.box -->
</div><!--/.col (left) -->

<div class="col-md-6">
  <!-- <div class="box box-primary">
    <video width="500" height="350" controls>
      <source src="<?php echo base_url()."files/video/".$data['VIDEO']; ?>" type="video/mp4" />
      <source src="application/views/web/videostreaming/video2.ogv" type="video/ogg" />
      <source src="application/views/web/videostreaming/video2.flv" type="video/flv" />
    </video>
  </div> -->
  <div class="box box-primary">
  <div align="center" class="embed-responsive embed-responsive-16by9">
    <!-- <video autoplay loop class="embed-responsive-item"> -->
    <video class="embed-responsive-item" controls>
        <source src="<?php echo base_url()."files/video/".$data['VIDEO']; ?>" type=<?php echo $data['FILETYPE']; ?>>
    </video>
  </div>
  </div>
</div>

<div class="col-md-12">
  <div class="box-footer">
    <!-- <button type="submit" class="btn btn-danger" name="btn_cancel" id="btn_cancel" value="Batal">Batal</button> -->
    <a class="btn btn-primary" name="btn_cancel" id="btn_cancel" href="<?php echo base_url()."progress"; ?>">Kembali</a>
    <?php if($this->session->userdata('LEVEL') != 'USER'){ ?>
      <a class="btn btn-danger pull-right" href="#" data-href="<?php echo base_url()."progress/delete/".$data['PROGRESSID']; ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i>   Hapus</a>
    <?php } ?>
    <!-- <button type="submit" class="btn btn-primary pull-right" name="btn_save" id="btn_save" value="Simpan">Simpan</button> -->
  </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Peringatan</h4>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
        <a class="btn btn-danger btn-ok">Ya</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var proctype = "<?php echo $data['PROCTYPECODE']; ?>";
    var step = parseInt($("#txt_step").val(),10);
    var subvalue = "";

    if(proctype == "PL01"){
      if(step === 1){
        subvalue = "50% x Rp. " + "<?php echo $data['CONTRACTVALUE']; ?>" + " = Rp. " + "<?php echo $data['SUBCONTRACTVALUE']; ?>";
      }
      if(step === 2){
        subvalue = "50% x Rp. " + "<?php echo $data['CONTRACTVALUE']; ?>" + " = Rp. " + "<?php echo $data['SUBCONTRACTVALUE']; ?>";
      }
    }
    if(proctype == "PL02"){
      if(step === 1){
        subvalue = "25% x Rp. " + "<?php echo $data['CONTRACTVALUE']; ?>" + " = Rp. " + "<?php echo $data['SUBCONTRACTVALUE']; ?>";
      }
      if(step === 2){
        subvalue = "30% x Rp. " + "<?php echo $data['CONTRACTVALUE']; ?>" + " = Rp. " + "<?php echo $data['SUBCONTRACTVALUE']; ?>";
      }
      if(step === 3){
        subvalue = "20% x Rp. " + "<?php echo $data['CONTRACTVALUE']; ?>" + " = Rp. " + "<?php echo $data['SUBCONTRACTVALUE']; ?>";
      }
      if(step === 4){
        subvalue = "25% x Rp. " + "<?php echo $data['CONTRACTVALUE']; ?>" + " = Rp. " + "<?php echo $data['SUBCONTRACTVALUE']; ?>";
      }
    }


    $("#txt_subcontractvalue").val(subvalue);
  });
</script>