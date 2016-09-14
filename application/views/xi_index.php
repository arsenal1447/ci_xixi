	<div id="picture"></div>
	<div id="loader"><i class="icon-spinner icon-spin icon-3x"></i></div>
</div>
<script>
var GetImageURL = "<?php echo $pictureURL ?>";
</script>
<script src="<?php echo base_url('dist/js/xixi.js') ?>"></script>
<script src="<?php echo base_url('dist/js/top.js') ?>"></script>
<script>
	function Like (uuid) {
		$.get("<?php echo base_url('xixi/like') . '/' ?>" + uuid,function(data){
			$.each($.parseJSON(data), function(idx, obj) {
				if (obj.is_like) {
					$('#likeButton'+ uuid).removeClass("btn-default");
					$('#likeButton'+ uuid).addClass("btn-info");
				} else {
					$('#likeButton'+ uuid).removeClass("btn-info");
					$('#likeButton'+ uuid).addClass("btn-default");
				}
			});
		});
	}
	function Love (uuid) {
		$.get("<?php echo base_url('xixi/love') . '/' ?>" + uuid,function(data){
			$.each($.parseJSON(data), function(idx, obj) {
				if (obj.is_login) {
					if (obj.is_love) {
						$('#collectButton'+ uuid).removeClass("btn-default");
						$('#collectButton'+ uuid).addClass("btn-info");
					} else {
						$('#collectButton'+ uuid).removeClass("btn-info");
						$('#collectButton'+ uuid).addClass("btn-default");
					}
				} else {
					window.location.href = Home + "login";
				}
			});
		});
	}
</script>
