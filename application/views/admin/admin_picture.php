			<div class="col-md-9">
				<table class="table table-striped table-hover">
			        <thead>
			          <tr>
			            <th>图片</th>
			            <th>操作</th>
			            <th>作者</th>
			            <th>日期</th>
			          </tr>
			        </thead>
			        <tbody>
			        <?php foreach ($image as $item): ?>
			          <tr>
			            <td>
			            	<img src="<?php echo base_url() . $item['pic_url'] ?>" class="img-rounded" width="60">
			            </td>
			            <td>
			            	<a href="javascript:void(0)" onClick="Delete('<?php echo $item['pic_uuid'] ?>')">删除</a> |  
			            	<a href="<?php echo base_url('view') . '/' . $item['pic_uuid'] ?>"  target="_black">查看</a>
			            </td>
			            <td><?php echo $item['pic_user'] ?></td>
			            <td><?php echo $item['pic_datetime'] ?></td>
			          </tr>
			         <?php endforeach ?>
			        </tbody>
			      </table>
			</div>
<script>
	function Delete (uuid) {
		$.get("<?php echo base_url('admin/delete') . '/'  ?>" + uuid,function(data){
			location.reload();
		});
	}
</script>