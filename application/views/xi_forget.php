<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>忘记密码</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/normalize.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/reglog.css') ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url('dist/js/jquery-1.10.2.min.js') ?>"></script>
  </head>
<body class="eternity-form">
    <section class="colorBg3 colorBg">
        <div class="container">
            <div class="forgot-password-section">
                <?php 
                  $attr = array('role' => 'form');
                  echo form_open('password', $attr);
                ?>
                <div class="section-title">
                    <h3>忘记密码</h3>
                </div>
                <div class="forgot-content">
                    <form>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="icon-user"></i></span>
                                <input type="text" class="form-control " placeholder="Username" required="required">
                            </div>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="icon-envelope"></i></span>
                                <input type="email" class="form-control " placeholder="Email Id" required="required">
                            </div>
                        </div>
                        <div class="forget-form-action clearfix">
                            <a class="btn btn-success pull-left blue-btn" href="<?php echo site_url('login') ?>">返回登录</a>
                            <button type="submit" class="btn btn-success pull-right green-btn">提交</button>
                        </div>
                    </form>
                </div>
                </form>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(function () {
 			$(".form-control").focus(function () {
                $(this).closest(".textbox-wrap").addClass("focused");
            }).blur(function () {
                $(this).closest(".textbox-wrap").removeClass("focused");
            });
        });
    </script>
</body>
</html>