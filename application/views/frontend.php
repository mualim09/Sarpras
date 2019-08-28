<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIP4</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/ionicons/css/ionicons.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
    <!-- date_picker_bootstrap -->
    <link href="<?php echo base_url(); ?>assets/date_picker_bootstrap/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
      <img alt="" src="<?php echo base_url(); ?>assets/Logo.png" style="padding-top: 10px;" >
    </div>
      <p class="navbar-text"><b>Sistem Informasi Pengendalian Pembangunan Prasarana Pendidikan </b><br>
                            Bidang Sarana Prasarana  <br>
                            Dinas Pendidikan Kabupaten Bogor
      </p>
       <div class="navbar-right" style="padding-top: 30px; padding-right:20px">
          <a href="<?php echo base_url();?>login">

<button type="submit" class="btn btn-primary"><i class="fa fa-lock"  ></i> Login</button> </a>
       </div>
    </div>
    </nav>


    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><span class="glyphicon glyphicon-th-list"></span> Status Kegiatan</h3>
            </div>   
            <div class="panel-body">
                
                 <div class="dataTable_wrapper" style="width:auto;">
                                <table class="table table-striped table-bordered table-hover" id="example1">
                                    <thead>
                                      <tr>
                                            <th>IDKeg</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Kecamatan</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Konsultan Pengawas</th>
                                            <th>Jenis Kegiatan Lelang/PL</th>
                                            <th>Progres Fisik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                
                                        <tr>
                                          <td colspan="" rowspan="" headers="">9002</td>
                                          <td colspan="" rowspan="" headers="">Pembangungan KM/WC Tegalwaru 03</td>
                                          <td colspan="" rowspan="" headers="">Cileungsi</td>
                                          <td colspan="" rowspan="" headers="">25 April 2016</td>
                                          <td colspan="" rowspan="" headers="">CV. Kinarya Teknika</td>
                                          <td colspan="" rowspan="" headers="">Lelang</td>
                                          <td colspan="" rowspan="" headers="">30 %</td>
                                        </tr>

                                        <tr>
                                          <td colspan="" rowspan="" headers="">9003</td>
                                          <td colspan="" rowspan="" headers="">Pembangungan KM/WC Tegalwaru 03</td>
                                          <td colspan="" rowspan="" headers="">Cileungsi</td>
                                          <td colspan="" rowspan="" headers="">25 April 2016</td>
                                          <td colspan="" rowspan="" headers="">CV. Kinarya Teknika</td>
                                          <td colspan="" rowspan="" headers="">Lelang</td>
                                          <td colspan="" rowspan="" headers="">80 %</td>
                                        </tr>

                                        <tr>
                                          <td colspan="" rowspan="" headers="">9004</td>
                                          <td colspan="" rowspan="" headers="">Pembangungan KM/WC Tegalwaru 03</td>
                                          <td colspan="" rowspan="" headers="">Cileungsi</td>
                                          <td colspan="" rowspan="" headers="">25 April 2016</td>
                                          <td colspan="" rowspan="" headers="">CV. Kinarya Teknika</td>
                                          <td colspan="" rowspan="" headers="">Lelang</td>
                                          <td colspan="" rowspan="" headers="">60 %</td>
                                        </tr>

                                        <tr>
                                          <td colspan="" rowspan="" headers="">9005</td>
                                          <td colspan="" rowspan="" headers="">Pembangungan KM/WC Tegalwaru 03</td>
                                          <td colspan="" rowspan="" headers="">Cileungsi</td>
                                          <td colspan="" rowspan="" headers="">25 April 2016</td>
                                          <td colspan="" rowspan="" headers="">CV. Kinarya Teknika</td>
                                          <td colspan="" rowspan="" headers="">Lelang</td>
                                          <td colspan="" rowspan="" headers="">45 %</td>
                                        </tr>

                                        <tr>
                                          <td colspan="" rowspan="" headers="">9006</td>
                                          <td colspan="" rowspan="" headers="">Pembangungan KM/WC Tegalwaru 03</td>
                                          <td colspan="" rowspan="" headers="">Cileungsi</td>
                                          <td colspan="" rowspan="" headers="">25 April 2016</td>
                                          <td colspan="" rowspan="" headers="">CV. Kinarya Teknika</td>
                                          <td colspan="" rowspan="" headers="">Lelang</td>
                                          <td colspan="" rowspan="" headers="">70 %</td>
                                        </tr>

                                        <tr>
                                          <td colspan="" rowspan="" headers="">9007</td>
                                          <td colspan="" rowspan="" headers="">Pembangungan KM/WC Tegalwaru 03</td>
                                          <td colspan="" rowspan="" headers="">Cileungsi</td>
                                          <td colspan="" rowspan="" headers="">25 April 2016</td>
                                          <td colspan="" rowspan="" headers="">CV. Kinarya Teknika</td>
                                          <td colspan="" rowspan="" headers="">Lelang</td>
                                          <td colspan="" rowspan="" headers="">80 %</td>
                                        </tr>

                                        <tr>
                                          <td colspan="" rowspan="" headers="">9008</td>
                                          <td colspan="" rowspan="" headers="">Pembangungan KM/WC Tegalwaru 03</td>
                                          <td colspan="" rowspan="" headers="">Cileungsi</td>
                                          <td colspan="" rowspan="" headers="">25 April 2016</td>
                                          <td colspan="" rowspan="" headers="">CV. Kinarya Teknika</td>
                                          <td colspan="" rowspan="" headers="">Lelang</td>
                                          <td colspan="" rowspan="" headers="">65 %</td>
                                        </tr>

                                        <tr>
                                          <td colspan="" rowspan="" headers="">9009</td>
                                          <td colspan="" rowspan="" headers="">Pembangungan KM/WC Tegalwaru 03</td>
                                          <td colspan="" rowspan="" headers="">Cileungsi</td>
                                          <td colspan="" rowspan="" headers="">25 April 2016</td>
                                          <td colspan="" rowspan="" headers="">CV. Kinarya Teknika</td>
                                          <td colspan="" rowspan="" headers="">Lelang</td>
                                          <td colspan="" rowspan="" headers="">100 %</td>
                                        </tr>

                                        
                               
                                    </tbody>
                                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

 <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <center>&copy; 2016 Simple Project | All Rights Reserved. <br>
                    Dinas Pendidikan Kabupaten Bogor |
                    Bidang Sarana Prasarana |
                    JL. Nyaman No. 1 Kelurahan Tengah Kec. Cibinong |
                    Telp. (021) 8753191-8765405 Cibinong 16914 <br>
                    Kabupaten Bogor</center>
                </div>
                    
               
            </div>
        </div>

    </footer>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
    <!-- date_picker_bootstrap -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/date_picker_bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/date_picker_bootstrap/js/locales/bootstrap-datetimepicker.id.js"charset="UTF-8"></script>

    <!-- Fungsi datepickier yang digunakan -->
    <script type="text/javascript">
     $('.datepicker').datetimepicker({
            language:  'id',
            weekStart: 1,
            todayBtn:  1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      minView: 2,
      forceParse: 0
        });
    </script>

    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        $(".select2").select2();
      });
    </script>

    <script type="text/javascript">
      $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    </script>

    <script type="text/javascript">
      function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
          return true;
      }
    </script>

    <script>
      $(function () {
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
      });
    </script>
  </body>
</html>