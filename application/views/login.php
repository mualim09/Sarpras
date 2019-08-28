<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIP4 | Login</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontlogin/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontlogin/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontlogin/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontlogin/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/Logo.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/Logo.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/Logo.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/Logo.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/Logo.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
            
            <div class="inner-bg">
                <div class="container">
                    
                    <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                    <img alt="" src="<?php echo base_url(); ?>assets/Logo.png" style="padding-top: 10px;" >
                    </div>
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h3>Sistem Informasi Pengendalian Pembangunan Prasarana Pendidikan </b><br>
              Bidang Sarana Prasarana </h3>
              <h4>Dinas Pendidikan Kabupaten Bogor</h4>
                        <!--     <div class="description">
                                <p>
                                    This is a free responsive <strong>"login and register forms"</strong> template made with Bootstrap. 
                                    Download it on <a href="http://azmind.com" target="_blank"><strong>AZMIND</strong></a>, 
                                    customize and use it as you like!
                                </p>
                            </div> -->
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-5">
                            
                            <div class="form-box">
                            <?php if($this->session->flashdata('erroralert')){?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Maaf!</h4>
                                    <?php echo $this->session->flashdata('erroralert'); ?>
                                </div>
                            <?php } ?>
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Silahkan Login</h3>
                                        <p>Masukan Username dan Password:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-key"></i>
                                    </div>
                                </div>


                                <div class="form-bottom">
                                    <form role="form" action="<?php echo base_url(); ?>login/login" method="post" class="login-form">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-username">Username</label>
                                            <input type="text" name="txt_username" placeholder="Username..." class="form-username form-control" 
                                            value="<?php echo $data['USERNAME']; ?>" id="txt_username">
                                            <span class="text-red"><?php echo form_error('txt_username'); ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-password">Password</label>
                                            <input type="password" name="txt_password" placeholder="Password..." class="form-password form-control" id="txt_password" value="<?php echo $data['PASSWORD']; ?>">
                                             <span class="text-red"><?php echo form_error('txt_password'); ?></span>
                                        </div>
                                        <button type="submit" name="btn_login" id="btn_login" class="btn" value="Log In">Log In</button>
                                    </form>
                                </div>
                            </div>
                 <!--        
                            <div class="social-login">
                                <h3>...or login with:</h3>
                                <div class="social-login-buttons">
                                    <a class="btn btn-link-1 btn-link-1-facebook" href="#">
                                        <i class="fa fa-facebook"></i> Facebook
                                    </a>
                                    <a class="btn btn-link-1 btn-link-1-twitter" href="#">
                                        <i class="fa fa-twitter"></i> Twitter
                                    </a>
                                    <a class="btn btn-link-1 btn-link-1-google-plus" href="#">
                                        <i class="fa fa-google-plus"></i> Google Plus
                                    </a>
                                </div>
                            </div> -->
                            
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                            
                        <div class="col-sm-6">
                        <div class="form-box"> 
                                    <div class="panel-body">
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Informasi Umum
                              </a>
                            </h4>
                          </div>
                          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                            <?php if ($data['list']==NULL) { ?>
                                Belum ada konten
                            <?php } else { ?>
                                <?php foreach ($data['list'] as $list) { ?>
                                    <?php echo $list['ARTICLE']; ?>
                                    <br>
                                <?php } ?>
                            <?php } ?>
                            </div>
                          </div>
                        </div>
                  
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Download
                              </a>
                            </h4>
                          </div>
                          <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                              Belum ada konten
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                            
   <!--                          <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Sign up now</h3>
                                        <p>Fill in the form below to get instant access:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" action="" method="post" class="registration-form">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-first-name">First name</label>
                                            <input type="text" name="form-first-name" placeholder="First name..." class="form-first-name form-control" id="form-first-name">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-last-name">Last name</label>
                                            <input type="text" name="form-last-name" placeholder="Last name..." class="form-last-name form-control" id="form-last-name">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">Email</label>
                                            <input type="text" name="form-email" placeholder="Email..." class="form-email form-control" id="form-email">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-about-yourself">About yourself</label>
                                            <textarea name="form-about-yourself" placeholder="About yourself..." 
                                                        class="form-about-yourself form-control" id="form-about-yourself"></textarea>
                                        </div>
                                        <button type="submit" class="btn">Sign me up!</button>
                                    </form>
                                </div>
                            </div> -->
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="footer-border"></div>
                    <center>&copy; 2016 Simple Project | All Rights Reserved. <br>
                    Dinas Pendidikan Kabupaten Bogor |
                    Bidang Sarana Prasarana |
                    JL. Nyaman No. 1 Kelurahan Tengah Kec. Cibinong |
                    Telp. (021) 8753191-8765405 Cibinong 16914 <br>
                    Kabupaten Bogor</center>

                        <p>Powered by <a href="http://azmind.com" target="_blank"><strong>AZMIND</strong></a></p>
                    </div>
                    
                </div>
            </div>
        </footer>

        <!-- Javascript -->
        <script src="<?php echo base_url(); ?>assets/frontlogin/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontlogin/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/frontlogin/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>