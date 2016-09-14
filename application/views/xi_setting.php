    <script src="<?php echo base_url('dist/js/swfobject.js') ?>"></script>
    <script src="<?php echo base_url('dist/js/fullAvatarEditor.js') ?>"></script>
	<div style="width:630px;margin: 100px auto;">
		<div>
			<p id="swfContainer">
                本组件需要安装Flash Player后才可使用，请从<a href="http://www.adobe.com/go/getflashplayer">这里</a>下载安装。
			</p>
		</div>
    </div>
	<script type="text/javascript">
        swfobject.addDomLoadEvent(function () {
            var swf = new fullAvatarEditor("swfContainer", {
				    id                 : 'swf',
				    src_url            : "<?php echo $image ?>",
					upload_url         : "<?php echo base_url('setting/upload') ?>",
					src_upload         : 1,
					tab_visible        : false,
					button_upload_text : '上传',
					avatar_sizes       : "150*150|70*70|32*32",
					avatar_sizes_desc  : "150*150像素|70*70像素|32*32像素"
				}, function (json) {
				 	if (json.code == 5)
				    {
				        switch(json.type)
				        {
				            case 0:
				                window.location.href = "<?php echo base_url('user/index/' . $user) ?>";
				            break;
				            case 1:
				                alert('头像上传失败，原因：' + json.content.msg);
				            break;
				            case 2:
				                alert('头像上传失败，原因：指定的上传地址不存在或有问题！');
				            break;
				            case 3:
				                alert('头像上传失败，原因：发生了安全性错误！');
				            break;
				        }
				    }
				}
			);
        });
    </script>
</div>