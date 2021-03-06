<!DOCTYPE html>
<?php //echo "<pre>";print_r($this->config->config['admin_js']); ?>
<?php //echo $this->config['config']['admin_js']; ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo $this->back_assets;?>bootstrap/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="<?php echo $this->back_assets;?>font-awesome.min.css"> -->
        <!-- <link rel="stylesheet" href="<?php echo $this->back_assets;?>ionicons.min.css"> -->
        <link rel="stylesheet" href="<?php echo $this->back_assets; ?>dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo $this->back_assets; ?>plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?php echo $this->back_assets;?>css/style.css">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a class="text-center">
                    <img src="<?php echo $this->back_assets.'dist/img/logo.png'; ?>" class="" width="100px"/>
                </a>
                <!-- <br/><br/> -->
                <!-- <a>FORGOT PASSWORD</a> -->
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Enter Email And Get Link For Change Password</p>
                    
                <?php if(isset($msg)): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $msg;?>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success');?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php endif; ?>

                <form name="frmlogin" id="frmlogin" action="<?php echo base_url(ADMINPATH.'forgotpassword')?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <span id="email_error" class="error"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <a href="<?php echo base_url().ADMINPATH; ?>login">Login</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <input type="submit" name="submit" value="Send" id="login_button" class="btn btn-warning btn-block btn-flat"/>
                        </div>
                    </div>
                </form>

          <!--    <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                  Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                  Google+</a>
              </div>-->
              <!-- /.social-auth-links -->

            </div>
        </div>

        <script src="<?php echo $this->back_assets; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="<?php echo $this->back_assets; ?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $this->back_assets;?>plugins/iCheck/icheck.min.js"></script>
        <script src="<?php echo $this->back_assets;?>js/jquery.validate.js"></script>

        <script>
            $(function () {
              $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
              });
            });
        </script>
        <script type="text/javascript">
            $().ready(function() {
                $("#frmlogin").validate({
                    rules: 
                    {
                        email: 
                        {
                            required: true,
                            email: true,
                        },
                    },
                    messages: 
                    {},
                    errorPlacement: function(error, element) {
                        if(element.attr("name") === "email") {
                            $("#email_error").html(error);
                        } else if(element.attr("name") === "password") {
                            $("#password_error").html(error);
                        }else{
                            error.insertAfter(element);
                        }
                    }
                });
            });
        </script>

        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>

    </body>
</html>
