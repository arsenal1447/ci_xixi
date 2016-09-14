<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->system_model->get_webtitle() ?></title>
    <meta name="keywords" content="<?php echo $this->system_model->get_keywords() ?>" />
    <meta name="description" content="<?php echo $this->system_model->get_description() ?>" />
    <meta name="author" content="root@dolphin" />
    <meta name="copyright" content="© http://hbdx.cc" />
    <link rel="icon" href="favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/bootstrap.min.css') ?>">
    <!-- <link href="http://cdn.bootcss.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/font-awesome.min.css') ?>">
    <!-- <link href="http://cdn.bootcss.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/signin.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/webuploader.css') ?>">
    <!-- <link href="http://cdn.bootcss.com/webuploader/0.1.1/webuploader.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/upload.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/normalize.css') ?>">
    <!-- <link href="http://cdn.bootcss.com/normalize/3.0.1/normalize.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/green.css') ?>">
    <!-- <link href="http://cdn.bootcss.com/iCheck/1.0.1/skins/minimal/green.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/css/lightbox.css') ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo base_url('dist/js/jquery-1.10.2.min.js') ?>"></script>
    <!--<script src="http://cdn.bootcss.com/jquery/2.1.0/jquery.min.js"></script>-->
    <script src="<?php echo base_url('dist/js/icheck.min.js') ?>"></script>
    <!--<script src="http://cdn.bootcss.com/iCheck/1.0.1/icheck.min.js"></script>-->
    <script>var Home = "<?php echo base_url() ?>"</script>
  </head>
  <body>
    <div class="wrap">
      <nav class="navbar navbar-default border navbar-fixed-top" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="font-size: 14px; color: #009933; font-weight: bold;" href="<?php echo base_url() ?>"><?php echo $this->system_model->get_webtitle() ?></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown dropdown-large">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-align-justify icon-large"></i></a>
              <ul class="dropdown-menu dropdown-menu-large row">
                <li class="col-sm-4">
                  <ul>
                  <li><a href="<?php echo site_url('popular') ?>"><span class="header">最热</span></a></li>
                  <li class="divider"></li>
                  <?php
                  $query = $this->catalogue_model->catalogue();
                  foreach ($query as $key => $value) {
                    $catalogue_url = base_url('catalogue') . '/' . $value['cat_another_name'];
                    if($key % 3 == 0) {
                  ?>
                  <li><a href="<?php echo $catalogue_url ?>"><?php echo $value['cat_name'] ?></a></li>
                  <li class="divider"></li>
                  <?php } } ?> 
                  </ul>
                </li>
                <li class="col-sm-4">
                  <ul>
                    <li><a href="<?php echo site_url('make') ?>"><span class="header">标签列表</span></a></li>
                    <li class="divider"></li>
                  <?php
                  $query = $this->catalogue_model->catalogue();
                  foreach ($query as $key => $value) {
                    $catalogue_url = base_url('catalogue') . '/' . $value['cat_another_name'];
                    if($key % 3 == 1) {
                  ?>
                  <li><a href="<?php echo $catalogue_url ?>"><?php echo $value['cat_name'] ?></a></li>
                  <li class="divider"></li>
                  <?php } } ?> 
                  </ul>
                </li>
                <li class="col-sm-4">
                  <ul>
                  <?php
                  $query = $this->catalogue_model->catalogue();
                  foreach ($query as $key => $value) {
                    $catalogue_url = base_url('catalogue') . '/' . $value['cat_another_name'];
                    if($key % 3 == 2) {
                  ?>
                  <li><a href="<?php echo $catalogue_url ?>"><?php echo $value['cat_name'] ?></a></li>
                  <li class="divider"></li>
                  <?php } } ?> 
                  </ul>
                </li>
              </ul>
            </li>
          </ul>

          <div class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" id="search" value="<?php echo $search ?>" class="form-control border" placeholder="Search" onkeypress="EnterSearch()">
            </div>
            <button type="submit" class="btn btn-default border" onClick="Search()">Search</button>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <?php if( $this->session->userdata('online') ) { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle right-border" data-toggle="dropdown"><i class="icon-plus icon-large"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo site_url('upload') ?>"><i class="icon-upload-alt"></i> 本地上传</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-link"></i> 网络分享</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-list-alt"></i> 创建专辑</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url('letter') ?>" class="right-border"><i class="icon-envelope icon-large"></i></a></li>
            <li><a href="<?php echo base_url('notice') ?>" class="right-border"><i class="icon-volume-up icon-large"></i></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle right-border-last" data-toggle="dropdown"><i class="icon-user icon-large"></i></a>
              <ul class="dropdown-menu" role="menu">
                <?php
                  $username = $this->session->userdata('Username');
                  if ($this->user_model->is_admin($username)) {
                ?>
                <li><a href="<?php echo site_url('admin') ?>"><i class="icon-key"></i> 管理中心</a></li>
                <li class="divider"></li>
                <?php } ?>
                <li><a href="<?php echo base_url('user/index') . '/' . $username ?>"><i class="icon-home"></i> 我的主页</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url('user/atten') . '/' . $username ?>"><i class="icon-eye-open"></i> 我的关注</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url('user/follow') . '/' . $username ?>"><i class="icon-leaf"></i> 我的粉丝</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-cog"></i> 账号设置</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url('logout') ?>"><i class="icon-signout"></i> 退出登录</a></li>
              </ul>
            </li>
            <li><a></a></li>
            <?php } else { ?>
            <a type="button" class="btn btn-success border navbar-btn" href="<?php echo site_url('register') ?>">注册</a>
            <a type="button" class="btn btn-success border navbar-btn" href="<?php echo site_url('login') ?>">登录</a>
            <?php } ?> 
          </ul>
        </div>
      </nav>
<script>
/********取得搜索框****************/
var search = document.getElementById("search");
/********搜索按钮响应函数**********/
function Search() {
    if (search.value != "") {
      window.location.href = Home + "search/" + search.value;
    }
}
/********搜索框回车响应函数********/
function EnterSearch() {
  if (event.keyCode == 13 && search.value != "") {
    window.location.href = Home + "search/" + search.value;
  }
}
</script>