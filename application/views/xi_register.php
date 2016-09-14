<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>注册</title>
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
    <section class="colorBg2 colorBg">
        <div class="container">
            <div class="registration-form-section">
                <?php 
                  $attr = array('role' => 'form');
                  echo form_open('register', $attr);
                ?>
                    <div class="section-title reg-header" >
                        <h3>注册账号</h3>
                        <?php echo validation_errors(); ?>
                    </div>
                    <div class="clearfix">
                        <div class="col-sm-6 registration-left-section">
                            <div class="reg-content">
                                <div class="textbox-wrap">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                                        <input type="text" class="form-control" name="username" autocomplete="off" value="<?php echo set_value('username'); ?>" onpaste="return false" oncontextmenu="return false" required="true" maxlength="12" placeholder="用户名" autofocus="true">
                                    </div>
                                </div>
                                <div class="textbox-wrap">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-envelope"></i></span>
                                        <input type="email" class="form-control" name="email" autocomplete="off" value="<?php echo set_value('email'); ?>"  required="true" placeholder="邮箱">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 registration-right-section" data-animation="fadeInUp">
                            <div class="reg-content">
                                <div class="textbox-wrap">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-key"></i></span>
                                        <input type="password" class="form-control" name="password" autocomplete="off" placeholder="密码" onpaste="return false" oncontextmenu="return false" required="true">
                                    </div>
                                </div>
                                <div class="textbox-wrap">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-key"></i></span>
                                        <input type="password" class="form-control" name="passconf" autocomplete="off" placeholder="确认密码" onpaste="return false" oncontextmenu="return false" required="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="registration-form-action clearfix">
                        <a href="<?php echo site_url('login') ?>" class="btn btn-success pull-left blue-btn">返回登录</a>
                        <button type="submit" class="btn btn-success pull-right green-btn ">注册</button>
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
        function CheckUickName( value ){
        //var show = document.getElementById('iptNickNameTip');
        var reg = new RegExp("^[\\u4E00-\\u9FA5\\uF900-\\uFA2D]+$");
        if( value.length < 2 ) {
            show.className = "onError";
            show.innerHTML = "昵称长度错误";
            return false;
        } else {
            if( reg.test(value) ) {
                show.className = "onCorrect";
                return true;
            } else {
                show.className = "onError";
                show.innerHTML = "昵称格式不正确";
                return false;
            }
        }
    }
    </script>
</body>
</html>