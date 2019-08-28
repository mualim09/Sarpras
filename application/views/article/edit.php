<div class="col-md-12">
  <!-- general form elements -->
  <div class="box box-primary">

    <!-- <div class="box-header with-border">
      <h3 class="box-title">Quick Example</h3>
    </div> -->
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" id="form" role="form" method="post" action="<?php echo base_url()."article/edit/".$data['ARTICLEID']; ?>">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Judul</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="txt_title" id="txt_title" placeholder="Enter ..." maxlength="255" value="<?php echo $data['TITLE']; ?>">
            <span class="text-red"><?php echo form_error('txt_title'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Pengumuman</label>
          <div class="col-sm-10">
            <!-- <input type="text" class="form-control" name="txt_article" id="txt_article" placeholder="Enter ..." value="<?php echo $data['ARTICLE']; ?>"> -->
            <!-- <textarea id="editor1" name="txt_article" rows="10" cols="80" placeholder="Enter ..."><?php echo $data['ARTICLE']; ?></textarea> -->
            <textarea class="textarea" id="txt_article" name="txt_article" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $data['ARTICLE']; ?></textarea>
            <span class="text-red"><?php echo form_error('txt_article'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Tanggal Mulai</label>
          <div class="col-sm-3">
            <div class="date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
              <input class="form-control datepicker" data-date-format="yyyy-mm-dd" type="text" name="dtx_startdate" id="dtx_startdate" value="<?php echo $data['STARTDATE']; ?>">
            </div>
            <input type="hidden" id="dtp_input1" value="">
            <span class="text-red"><?php echo form_error('dtx_startdate'); ?></span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Tanggal Selesai</label>
          <div class="col-sm-3">
            <div class="date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
              <input class="form-control datepicker" data-date-format="yyyy-mm-dd" type="text" name="dtx_enddate" id="dtx_enddate" value="<?php echo $data['ENDDATE']; ?>">
            </div>
            <input type="hidden" id="dtp_input1" value="">
            <span class="text-red"><?php echo form_error('dtx_enddate'); ?></span>
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