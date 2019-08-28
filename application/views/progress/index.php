<div class="col-md-12">
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

    <div class="box-header with-border">
      <!-- <a class="btn btn-primary" href="<?php echo base_url()."progress/entryadd"; ?>">
        <i class="fa fa-plus"></i> Tambah Data
      </a> -->
      <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#select-procurement">
        <i class="fa fa-plus"></i> Tambah Data
      </a>
    </div><!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <!-- <th>Aksi</th> -->
            <th>No</th>
            <th>NoKeg</th>
            <th>Kegiatan</th>
            <!-- <th>Kecamatan</th> -->
            <th>Tipe</th>
            <th>Level</th>
            <th colspan="4">Progress</th>
            <!-- <th>Tanggal Selesai</th> -->
            <!-- <th>Tgl. Jatuh Tempo</th> -->
            <!-- <th>TglLapor</th> -->
            <!-- <th>Pengawas</th> -->
            <!-- <th>Penyedia Jasa</th> -->
          </tr>
        </thead>
        <tbody>
        <?php $x=1; ?>
        <?php foreach ($list as $list) { ?>
          <tr>
            <!-- <td valign="middle">
              <a class="btn btn-xs btn-primary" href="<?php echo base_url()."progress/view/".$list['PROGRESSID']; ?>"><i class="fa fa-eye"></i></a>
            <?php if($this->session->userdata('LEVEL') != 'USER'){ ?>
              <a class="btn btn-xs btn-danger" href="#" data-href="<?php echo base_url()."progress/delete/".$list['PROGRESSID']; ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
            <?php } ?>
            </td> -->
            <td valign="middle"><?php echo $x++; ?></td>
            <td valign="middle"><?php echo $list['PROCNUMBER']; ?></td>
            <td valign="middle"><?php echo $list['PROCDESC']; ?></td>
            <!-- <td valign="middle"><?php echo $list['SUBDISTRICT']; ?></td> -->
            <td valign="middle"><?php echo $list['PROCTYPEDESC']; ?></td>
            <td valign="middle"><?php echo $list['SCHOOLLEVEL']; ?></td>
            <!-- <td valign="middle"><?php echo $list['STEP']; ?></td> -->
            <!-- <td valign="middle"><?php echo $list['ENDDATE']; ?></td> -->
            <!-- <td valign="middle"><?php echo $list['DUEDATE']; ?></td> -->
            <!-- <td valign="middle"><?php echo $list['CREATED']; ?></td> -->
            <!-- <td valign="middle"><?php echo $list['SVNAME']; ?></td> -->
            <!-- <td valign="middle"><?php echo $list['PVNAME']; ?></td> -->
            
            <?php for ($j=0; $j<count($list2); $j++) { ?>
              <?php if($list['PROCNUMBER']==$list2[$j]['PROCNUMBER']){ ?>
                <td align="center" valign="middle" <?php if($list2[$j]['PROCTYPECODE']=="PL01"){ echo "colspan='2'"; if($list2[$j]['STEP']=="1"){ echo "class='bg-aqua disabled'"; }else{ echo "class='bg-light-blue-active'"; } }else{ if($list2[$j]['STEP']=="1"){ echo "class='bg-aqua disabled'"; }elseif($list2[$j]['STEP']=="2"){ echo "class='bg-aqua'"; }elseif($list2[$j]['STEP']=="3"){ echo "class='bg-aqua-active'"; }else{ echo "class='bg-light-blue-active'"; } } ?>><a href="<?php echo base_url()."progress/view/".$list2[$j]['PROGRESSID']; ?>" ><span class="label"><?php echo $list2[$j]['TOTAL']."%"; ?></span></a></td>
              <?php } ?>
            <?php } ?>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->

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

<div class="modal fade" id="select-procurement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih Kegiatan</h4>
      </div>

      <form class="form-horizontal" id="form" role="form" method="post" action="<?php echo base_url()."progress/entryadd"; ?>">
        <div class="box-body">
        <?php if($this->session->userdata('LEVEL') != "USER"){ ?>
          <div class="form-group">
            <label class="col-sm-4 control-label">Konsultan Pengawas</label>
            <div class="col-sm-6">
              <select class="form-control select2" name="cmb_sv" id="cmb_sv" style="width: 100%;">
                <option value="">--ALL--</option>
                <?php if(is_array($supervisorlist)){ ?>
                <?php foreach($supervisorlist as $svlist){ ?>
                <option value="<?php echo $svlist['SVCODE']; ?>"><?php echo $svlist['SVNAME']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
              <span class="text-red"><?php echo form_error('cmb_sv'); ?></span>
            </div>
          </div>
        <?php } ?>
          <div class="form-group">
            <label class="col-sm-4 control-label">Nama Kegiatan</label>
            <div class="col-sm-6">
              <select class="form-control select2" name="cmb_proc" id="cmb_proc" style="width: 130%;">
                <option value="">--PILIH NAMA KEGIATAN--</option>
                <?php if(is_array($procurementlist)){ ?>
                <?php foreach($procurementlist as $plist){ 
                 $proctype = "";
                  if ($plist['PROCTYPECODE'] == "PL01") {
                    $proctype = "PL";
                  }else{
                    $proctype = "LELANG";
                  }
                 ?>
                <option value="<?php echo $plist['PROCNUMBER']; ?>"><?php echo $plist['PROCDESC']." (".$proctype.")"; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
              <span class="text-red"><?php echo form_error('cmb_proc'); ?></span>
            </div>
          </div>
        </div><!-- /.box-body -->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>      

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#cmb_sv").change(function(){
      var svcode = $("#cmb_sv").val();
      $.ajax({
       type : "POST",
       // url  : "<?php echo site_url('progress/getprocurement'); ?>",
       url  : "<?php echo base_url(); ?>progress/getprocurement",
       data : "svcode=" + svcode,
       success: function(data){
        // $("#cmb_proc").html("");
        $("#cmb_proc").empty()
        $("#cmb_proc").html(data);
       }
     });
    });
  });

  $("#form").submit(function(){
    var proc = $.trim($("#cmb_proc").val());
    if(proc === ""){
      alert("Kegiatan belum dipilih");
      return false;
    }
  });
</script>