	<div class="container top" style="margin-bottom: 100px;">
        <div class="row">
    		<div class="user-details">
                <div class="user-image">
                	<div class="row">
                    	<div class="col-xs-2"><img src="<?php echo $picture ?>" class="img-thumbnail"></div>
                    	<div class="col-xs-6" style="margin-top: 50px;">
                    		<h3><?php echo $username ?></h3>
                    		<h4><a href="<?php echo base_url('user/follow') . '/' . $username ?>"><span id="follownum"><?php echo $follow_to ?></span> <small>粉丝</small></a>
                             | 
                             <a href="<?php echo base_url('user/atten') . '/' . $username ?>"><?php echo $follow_form ?> <small>关注</small></a></h4>
                            <?php if($setting != "") { ?>
                            <a type="button" class="btn btn-success btn-sm border" href="<?php echo base_url('setting') ?>">编辑资料</a>
                            <?php } ?>
                    	</div>
                    	<div class="col-xs-4" style="margin-top: 100px;">
                    		<a type="button" class="btn btn-success btn-circle-lg" onClick="Follow('<?php echo $username ?>')"><p id="follow"><?php if($follow) { echo "取消关注"; } else { echo "关注"; } ?></p></a>
                    		<a type="button" class="btn btn-success btn-circle-lg" data-toggle="modal" data-target="#letterModal"><i class="icon-envelope icon-large"></i></a>
                    	</div>
                    </div>
                </div>
                <div class="user-info-block">
                    <ul class="navigation">
                        <li class="<?php if($active == 'album') { ?> active <?php } ?>">
                            <a href="<?php echo base_url('user/album/' . $username) ?>">专辑</a>
                        </li >
                        <li class="<?php if($active == 'picture') { ?> active <?php } ?>">
    						<a href="<?php echo base_url('user/picture/' . $username) ?>">图片</a>
                        </li>
                        <li class="<?php if($active == 'collect') { ?> active <?php } ?>">
    						<a href="<?php echo base_url('user/collect/' . $username) ?>">收藏</a>
                        </li>
                        <li class="<?php if($active == 'atten') { ?> active <?php } ?>">
                            <a href="<?php echo base_url('user/atten/' . $username) ?>">关注</a>
                        </li>
                        <li class="<?php if($active == 'follow') { ?> active <?php } ?>">
                            <a href="<?php echo base_url('user/follow/' . $username) ?>">粉丝</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" style="margin-top:100px;" id="letterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">给<?php echo $username ?>发私信</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="alert alert-info border" id="lettermeaasge"></div>
                        <textarea class="form-control input-lg border" id="letter" maxlength="512" autocomplete="off" required="true"></textarea>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default border" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary border" onClick="SendLetter('<?php echo $username ?>')">发送</button>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#lettermeaasge').hide();
	function Follow (username) {
		$.get("<?php echo base_url('user/addfollow') . '/' ?>" + username,function(data){
			$.each($.parseJSON(data), function(idx, obj) {
				var num = $('#follownum').html();
				if (obj.is_follow) {
					$('#follow').html("取消关注");
					num++;					
				} else {
					$('#follow').html("关注");
					num--;
				};
				$('#follownum').html(num);
				
			});
		});
	}
    function SendLetter (username) {
        var text = $('#letter').val();
        $.get("<?php echo base_url('letter/send') . '/' ?>" + username + "/" + text,function(data){
            $.each($.parseJSON(data), function(idx, obj) {
                switch(obj.static){
                    case 0:
                        $('#lettermeaasge').show();
                        $('#lettermeaasge').html('私信发送成功。');
                        $('#letter').val('');
                        break;
                    case 1:
                        $('#lettermeaasge').show();
                        $('#lettermeaasge').html('你不用给自己发私信。');
                        break; 
                    case 2:
                        window.location.href = "<?php echo base_url('login') ?>"
                        break; 
                    case 3:
                        $('#lettermeaasge').show();
                        $('#lettermeaasge').html('私信发送失败，请重新发送。');
                        break;
                    default:
                        break;
                }
            });
        });
    }
</script>