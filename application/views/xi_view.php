<?php if($show) { ?>
	<div class="container top">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<div class="maincontent">
				
					<h4 class="text-center"><b><?php echo $name ?></b></h4>
					<div class="row">
						<div class="col-xs-2">
							<img class="img-circle" style="float: right;" src="<?php echo $picture ?>">
						</div>
						<div class="col-xs-10">
							<p>
								<a href="<?php echo base_url('user/index') . '/' . $user ?>"><?php echo $user ?></a>
							</p>
							<p>
								<a type="button" class="btn btn-success btn-sm border" onClick="Follow('<?php echo $user ?>')"><span id="follow"><?php if($follow) { echo "取消关注"; } else { echo "关注"; } ?></span></a>
							</p>
							浏览：<?php echo $view ?><?php echo nbs(4) ?>
							标签：
							<?php
							    $tag  = explode (" ", $tags);
							    if(count($tag) > 0) {
							    	$fir_tag = $tag[0];
							    }
							    if(count($tag) > 1) {
							    	$sec_tag = $tag[1];
							    } else {
							    	$sec_tag = $fir_tag;
							    }

							    for ($i = 0; $i < count($tag); $i++) {
							?>
								<a href="<?php echo base_url('tag') . '/' . $tag[$i] ?>"><?php echo $tag[$i] ?></a>
							<?php } ?>
							<?php echo nbs(4) ?>
							日期：<?php echo $date ?>
						</div>
					</div>
				
				<p class="text-center">
					<a href="<?php echo $url ?>" target="_blank"><img style="max-width: 100%;" src="<?php echo $url ?>"></a>
				</p>
				<p><em><?php echo $text ?></em></p>
				<a style="cursor: pointer;" onClick="Love('<?php echo $uuid ?>')"><i class="icon-heart"></i><span id="collect"> <?php if($is_love) { echo "取消收藏"; } else { echo "收藏"; } ?> <?php echo $collect ?></span></a><?php echo nbs(4) ?>
				<a style="cursor: pointer;">分享 <span id="share"><?php echo $share ?></span></a><?php echo nbs(4) ?> 
				<a style="cursor: pointer;" onClick="Like('<?php echo $uuid ?>')"><i class="icon-thumbs-up"></i><span id="like"> <?php if($is_like) { echo "取消赞"; } else { echo "赞"; } ?> <?php echo $like ?></span></a><?php echo nbs(4) ?>
			</div>
			<div class="maincontent">
					<?php
						$query = $this->message_model->pic_message($uuid);
						foreach ($query as $value) {
					?>
					<p class="text-left">
						<?php
							$pic = 'upload/user/' . $this->user_model->picture($value['msg_user']) . '_3.jpg';
							if (file_exists($pic)) {
								$pic_u = base_url('upload/user/' . $this->user_model->picture($value['msg_user']) . '_3.jpg');
							} else {
								$pic_u = base_url('upload/user/default_3.jpg');
							}
						?>
						<img class="img-circle" src="<?php echo $pic_u ?>">
						<strong><?php echo $value['msg_user'] ?></strong>
					</p>
					<blockquote><p class="text-left"><?php echo $value['msg_text'] ?></p></blockquote>
					<p class="text-right"><?php echo $value['msg_datetime'] ?></p>
					<hr>
					<?php } ?>
				<?php 
	                $attr = array('role' => 'form');
	                echo form_open('message');
	            ?>
						<textarea class="form-control" rows="5" name="message" value="<?php echo set_value('message'); ?>"></textarea>
						<input type="text" name="view" value="<?php echo $uuid ?>" style="display:none;">
						<input type="text" name="viewid" value="<?php echo $id ?>" style="display:none;">
						<?php echo validation_errors(); ?>
						<div class="text-right" style="margin-top:10px;">
							<button class="btn btn-primary border" type="submit">发布</button>
						</div>
					</form>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="info">
				<ul>
					<li>
					<?php if ($pres) { ?>
						<a type="button" class="btn btn-default btn-circle" id="Btnprse" href="<?php echo base_url('view') . '/' . $pres ?>"><i class="icon-chevron-left"></i></a><?php echo nbs(4) ?>
					<?php } ?>
					<?php if ($next <= $this->pic_model->max_id()) { ?>
						<a type="button" class="btn btn-default btn-circle" id="Btnnext" href="<?php echo base_url('view') . '/' . $next ?>"><i class="icon-chevron-right"></i></i></a>
					<?php } ?> 
					</li>
					<li><b>使用键盘左右键快速翻页</b></li>
					<li><b>你可能感兴趣</b></li>
					<li>
						<div class="row maincontent" >
							<div class="col-xs-6">
							<?php
							$images = $this->pic_model->alltag($fir_tag);
							foreach ($images as $img) {
							?>
								<a href="<?php echo base_url('view') . '/' . $img['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo base_url() . $img['pic_url'] ?>"></a>
							<?php } ?>
							</div>
							<div class="col-xs-6">
							<?php
							$images = $this->pic_model->alltag($sec_tag);
							foreach ($images as $img) {
							?>
								<a href="<?php echo base_url('view') . '/' . $img['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo base_url() . $img['pic_url'] ?>"></a>
							<?php } ?>
							</div>
						</div>
					</li>
					<li><b>随机推荐</b></li>
					<li>
						<div class="row maincontent" >
							<div class="col-xs-6">
							<?php
							$hots = $this->pic_model->random();
							foreach ($hots as $hot) {
							?>
								<a href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo base_url() . $hot['pic_url'] ?>"></a>
							<?php } ?>
							</div>
							<div class="col-xs-6">
							<?php
							$hots = $this->pic_model->random();
							foreach ($hots as $hot) {
							?>
								<a href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo base_url() . $hot['pic_url'] ?>"></a>
							<?php } ?>
							</div>
						</div>
					</li>
					<li><b>今日热门推荐</b></li>
					<li>
						<div class="row maincontent" >
							<div class="col-xs-6">
							<?php
							$hots = $this->pic_model->todayhot();
							foreach ($hots as $hot) {
							?>
								<a href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo base_url() . $hot['pic_url'] ?>"></a>
							<?php } ?>
							</div>
							<div class="col-xs-6">
							<?php
							$hots = $this->pic_model->todayhot2();
							foreach ($hots as $hot) {
							?>
								<a href="<?php echo base_url('view') . '/' . $hot['ID'] ?>"><img style="width: 120px;margin-top:5px;" src="<?php echo base_url() . $hot['pic_url'] ?>"></a>
							<?php } ?>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
		<?php if ($name != "") { ?>
			<script>document.title = "<?php echo $name ?>-西西美图" </script>
		<?php } ?>
		<?php } else { ?>
			<br /><br /><br /><br /><br /><br />
			<div class="alert alert-warning border">非法访问</div>
		<?php } ?>
	</div>
</div>
	<script>
		function Like (uuid) {
			$.get("<?php echo base_url('xixi/like') . '/' ?>" + uuid,function(data){
				$.each($.parseJSON(data), function(idx, obj) {
					if (obj.is_like) {
						$('#like').html(" 取消赞 " + obj.like);
					} else {
						$('#like').html(" 赞 " + obj.like);
					}
				});
			});
		}
		function Love (uuid) {
			$.get("<?php echo base_url('xixi/love') . '/' ?>" + uuid,function(data){
				$.each($.parseJSON(data), function(idx, obj) {
					if (obj.is_login) {
						if (obj.is_love) {
							$('#collect').html(" 取消收藏 " + obj.love);
						} else {
							$('#collect').html(" 收藏 " + obj.love);
						}
					} else {
						window.location.href = Home + "login";
					}
				});
				
			});
		}
		$(document).ready(function() {
			$(document).bind('keydown', function(event) {
			    switch(event.keyCode) {
			  		case 37:
			  			if ($('#Btnprse').length > 0) {
			  				window.location.href = $('#Btnprse').attr("href");
			  			}
			  			break;
			  		case 39:
			  			if ($('#Btnnext').length > 0) {
			  				window.location.href = $('#Btnnext').attr("href");
			  			}
			  			break;
			  		default:
			  			break;
			  	}
			});
		});
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
	</script>