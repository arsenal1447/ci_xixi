========================西西美图 v3.0 发布日志=========================

在v2.0的基础上主要增加了系统管理功能，包括：

1 简单的会员中心。

2 简单的SNS功能：关注功能（不完善）、私信功能（不完善）、系统通知（不完善）。

3 自定义头像上传功能。头像图片会上传到upload文件夹下的user文件夹下面。请确保次路径可读写。

4 页面布局：最小宽度定义为768px，首页最小列定义为4。

5 标签列表页面。

6 详情页面做了简单的调整。URL改为记录ID。页面右边显示相关图片列表。

7 去除了注册的手机号和昵称选项。用户名不再限制中文。

8 首页：现在的首页只显示图片和三个按键。希望有设计大神帮我设计下首页的布局。

9 修正 v2.0中发现的已知错误。

自定也功能：

上传图片的大小和数量限制：dist/js/upload.js 70 - 72行
  fileNumLimit        ： 单次上传的最大图片数 默认 100张
  fileSizeLimit       ： 单次上传图片的最大大小 默认 100M
  fileSingleSizeLimit ： 单张图片的最大大小 默认 1M

安装方法：

    1 安装数据库。创建一个新的数据库，然后导入 xixi.sql 。

    2 设置数据库信息。在 application/config/database.php 中：
      $db['default']['hostname'] = 'localhost';  //服务器地址
      $db['default']['username'] = '';           //MYSQL 用户名
      $db['default']['password'] = '';           //MYSQL 密码
      $db['default']['database'] = '';           //数据库名称

    3 网站基础设置。在 application/config/config.php 中：
      $config['base_url'] = '';  //网站地址 正确格式：http://yourweb.com/
      $config['url_suffix'] = '';  //伪静态地址后缀 正确格式: .html .php .htm 或者为空

    4 上传所有文件到服务器。保证upload文件夹的可写入权限。

    数据库中没有默认管理员，需要注册一个新的用户，再去数据库中为此用户赋管理员权限。

    方法：xi_users表user_status字段修改为1。

    次程序没有单独的后台管理系统。使用管理员账户登录后。可进去管理中心进行管理。

    只有登录后才可以上传图像。

    程序中还存在很多问题和细节的不完善。希望使用者及时反馈。作者会尽量在第一时间修正。

    对应程序有任何的建议也欢迎与作者联系。

伪静态问题：

    再强调下，此程序基于CodeIgniter与Bootstrap搭建。
    
    服务器端需要伪静态的支持。

    目前作者只使用用LINUX下的LNMP环境，在此环境下可直接使用WP的伪静态规则。

    其他服务器的伪静态方法请自行解决。可去CodeIgniter的官方论坛找下。

    这个问题不要再来问我了。如果你安装后除了首页其他页面都404错误，说明你的伪静态没有设置好。

数据库问题

    如果出现：

    Unable to connect to your database server using the provided settings.

    Filename: D:\phpStudy\WWW\1\system\database\DB_driver.php

    Line Number: 124

    说明数据库没有配置正确。请重新检查application/config/database.php的配置是否正确。

程序演示:http://i.hbdx.cc/
作者主页:http://hbdx.cc/
联系作者:
        QQ 416509859
        微信 haibingdaxia
        微博 海兵大侠
讨论群  :104790493

———— 2014-08-01

========================西西美图 v2.0 发布日志=========================

在v1.0的基础上主要增加了系统管理功能，包括：

1 基础设置。网站名称、关键字、网站描述

2 图片审核功能。新发布的图片不会直接展示在网站首页，需要管理员在后台审核。
  此功能还需要继续完善。

3 图片管理功能。可以删除已审核过的图片。

4 会员管理功能。

5 分类管理功能。

6 标签管理功能。可以删除已存在的标签。

7 首页增加LightBox效果。

8 增加了二级分类功能。

9 优化了收藏和赞功能。使用收藏必须要先登录。现在还没用个人中心，所以暂时看不到自己收藏的图片。点赞功能不需要登录，是根据用户的IP地址来的。热门图片就是根据赞的次数排序的。

10 上传页面不再显示全部的已有标签，而是显示使用次数最多的10个。

11 修改了一下跳转方法。一般来说不需要给出提示信息的都会直接跳转到下一个页面，如果出错或者异常，则会显示3秒的提示信息，再跳转到下个页面。

12 瀑布流图片的显示宽度修改为220。参考了大部分的瀑布流网站，基本是这个宽度。

13 优化了一下首页的显示效果。鼠标经过图片的时候出现遮罩层，可以进行灯箱、详情、点赞、收藏。

安装方法请仔细阅读v1.0发布日志。

数据库中没有添加默认用户，需要手动注册一个用户。

将某个用户设为管理员需要手动修改数据库中xi_users表的user_status字段，从0改为1。

下个版本增加用户资料编辑功能后会改进此处。

数据库更新：

表xi_catalogue新增字段cat_father 类型varchar 长度64 默认值 "顶级"。

表xi_picture新增字段pic_status 类型int 长度11 默认 0。

之前已发布的由于pic_status为0，为未审核状态，首页不能显示。

可以到管理中心先审核。

或者使用下面的语句全部审核：

UPDATE `xi_picture` SET `pic_status`=1 WHERE 1

从v1.0升级的用户，请在数据库中添加此字段。

并且执行下面的SQL语句添加系统设置的初始信息。

INSERT INTO `xi_systeminfo` (`ID`, `sys_title`, `sys_value`) VALUES
(1, 'webtitle', '西西美图'),
(2, 'keywords', '图片,瀑布流,图片系统,php,开源,Bootstrap,CodeIgniter'),
(3, 'description', '基于Bootstrap与CodeIgniter的php瀑布流图片系统');

添加后可以去系统设置中修改

另外还需要将你要设为管理员的用户的表xi_users的user_status字段从0修改为1。

然后重新上传application dist system三个文件夹中的所有文件。

只有使用管理员用户登录才可以看到管理中心，并进行网站管理。

欢迎大家反馈意见和建议。我将尽快修正和完善。

By dolphin 2014-05-21

========================西西美图 v1.0 发布日志=========================

本程序使用PHP与MYSQL在CodeIgniter + Bootstrap + jQuery的基础上开发而成。

需要伪静态的支持。Apache可直接使用根目录下的.htaccess文件。LNMP集成环境可使用WordPress的规则。

本程序暂时没有后台，使用本程序需要能熟练操作数据库和一定的代码阅读能力。

本程序完全是作者的个人作品。现免费发布，希望能收集广大源码爱好者对本程序的建议，以帮助作者完成程序。

本程序会无限期的更新下去，但不对开发进度做保证。

使用方法：

    1 安装数据库。创建一个新的数据库，然后导入 xixi.sql 。

    2 设置数据库信息。在 application/config/database.php 中：
      $db['default']['hostname'] = 'localhost';  //服务器地址
      $db['default']['username'] = '';           //MYSQL 用户名
      $db['default']['password'] = '';           //MYSQL 密码
      $db['default']['database'] = '';           //数据库名称

    3 网站基础设置。在 application/config/config.php 中：
      $config['base_url'] = '';  //网站地址 正确格式：http://yourweb.com/
      $config['url_suffix'] = '';  //伪静态地址后缀 正确格式: .html .php .htm 或者为空

    4 上传所有文件到服务器。保证upload文件夹的可写入权限。

    数据库中没有默认用户，需要注册。只有登录后才可以上传图像。

    数据库中有默认的分类和标签，对应的表是：xi_catalogue和xi_tags。可自行增加删除修改。

    使用如下的SQL语句来新增分类:

    INSERT INTO `xi_catalogue` (`ID`, `cat_name`, `cat_another_name`, `cat_icon`) VALUES (NULL, '明星', 'superstar', 'icon-star');

    其中cat_name是显示的分类名称。cat_another_name是显示在URL中的字段。cat_icon是分类前面的小图标。

    图标代码选择地址：http://www.bootcss.com/p/font-awesome/

    要用那个图标就把对应的标示填到cat_icon中。

    标签在发布的时候可以勾选已用标签或者填写新的标签。新标签会自动加入数据库，下一次就可以选择了。

    有任何的使用问题请加讨论群。

程序演示:http://i.hbdx.cc/
作者主页:http://hbdx.cc/
联系作者:QQ 416509859
讨论群  :104790493



