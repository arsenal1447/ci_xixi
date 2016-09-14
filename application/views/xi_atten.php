<div class="container">
	<div class="row">
	<?php foreach ($myfollow as $value) { ?>
			<div class="col-sm-4 col-md-3">
			<div class="thumbnail text-center">
				<?php
					$picture             = 'upload/user/' . $this->user_model->picture($value['follow_to']) . '_1.jpg';
					if (file_exists($picture)) {
						$pic = base_url('upload/user/' . $this->user_model->picture($value['follow_to']) . '_1.jpg');
					} else {
						$pic = base_url('upload/user/default_1.jpg');
					}
				?>
		      	<img class="img-circle" src="<?php echo $pic ?>">
		        <h3><?php echo $value['follow_to'] ?></h3>
		        <?php
		        	$user = $value['follow_to'];
		        	if ($this->session->userdata('online')) {
						$form_name = $this->session->userdata('Username');
						if($this->follow_model->is_follow($user,$form_name)){
							$follow = 1;
						} else {
							$follow = 0;
						}
					} else {
						$follow = 0;
					}
		        ?>
		        <p>
		        	<a style="width: 100%;" onClick="Followss('<?php echo $user ?>')" class="btn btn-primary border" role="button">
		        		<span id="<?php echo $user ?>"><?php if($follow) { echo "取消关注"; } else { echo "关注"; } ?></span>
		        	</a>
		        </p>
		    </div>
		</div>
	<?php } ?>
<script>
	function Followss (username) {
		$.get("<?php echo base_url('user/addfollow') . '/' ?>" + username,function(data){
			$.each($.parseJSON(data), function(idx, obj) {
				if (obj.is_follow) {
					$('#' + username).html("取消关注");				
				} else {
					$('#' + username).html("关注");
				};
			});
		});
	}
</script>