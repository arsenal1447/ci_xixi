<div class="container top">
	<ul class="nav nav-pills" role="tablist">
	  	<li role="presentation" class="active"><a href="<?php echo base_url('letter') ?>">私信</a></li>
	  	<li role="presentation"><a href="<?php echo base_url('notice') ?>">通知</a></li>
	  	<li role="presentation"><a href="<?php echo base_url('comment') ?>">评论</a></li>
	</ul>
	<table class="table table-bordered">
		<thead>
	        <tr>
	        	<!-- <th>状态</th> -->
	          	<th>发送者</th>
	          	<th>内容</th>
	          	<!-- <th>操作</th> -->
	          	<th>日期</th>
	        </tr>
      	</thead>
      	<tbody>
      	<?php foreach ($letter as $value) { ?>
       		<tr>
       			<!-- <td><?php if($value['letter_status'] == 0) { echo "未读"; } else { echo "已读"; } ?></td> -->
	          	<td><?php echo $value['letter_form'] ?></td>
	          	<td>
	          		<?php 
	          			echo mb_substr($value['letter_text'],0,50);
	          		?>
	          	</td>
	          	<!-- <td><a>查看</a> 删除</td> -->
	          	<td><?php echo $value['letter_datetime'] ?></td>
	        </tr>
	    <?php } ?>
      </tbody>
	</table>
</div>

