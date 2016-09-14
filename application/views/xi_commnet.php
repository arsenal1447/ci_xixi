<div class="container top">
	<ul class="nav nav-pills" role="tablist">
	  	<li role="presentation"><a href="<?php echo base_url('letter') ?>">私信</a></li>
	  	<li role="presentation"><a href="<?php echo base_url('notice') ?>">通知</a></li>
	  	<li role="presentation" class="active"><a href="<?php echo base_url('comment') ?>">评论</a></li>
	</ul>
	<table class="table table-bordered">
		<thead>
	        <tr>
	        	<th>操作</th>
	          	<th>内容</th>
	          	<th>日期</th>
	        </tr>
      	</thead>
      	<tbody>
      	<?php foreach ($letter as $value) { ?>
       		<tr>
       			<td><a style="cursor: pointer;" onClick="DelLetter('<?php echo $value['ID'] ?>')"><?php ?>删除</a></td>
	          	<td><?php echo $value['letter_text'] ?></td>
	          	<td><?php echo $value['letter_datetime'] ?></td>
	        </tr>
	    <?php } ?>
      </tbody>
	</table>
</div>
<script>
	function DelLetter (id) {
		$.get("<?php echo base_url('letter/delete') . '/'  ?>" + id,function(data){
			location.reload();
		});
	}
</script>
