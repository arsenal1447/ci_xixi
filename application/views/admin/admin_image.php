			<div class="col-md-9">
				<table class="table table-striped table-hover">
			        <thead>
			          <tr>
			            <th>图片</th>
			            <th>分类</th>
			            <th>标题</th>
			            <th>描述</th>
			            <th>标签</th>
			            <th>操作</th>
			          </tr>
			        </thead>
			        <tbody>
			        <?php foreach ($image as $item): ?>
			          <tr>
			            <td>
			            	<a href="<?php echo base_url() . $item['pic_url'] ?>" target="_blank"><img src="<?php echo base_url() . $item['pic_url'] ?>" class="img-rounded" width="60">
			            </td>
			            <td><?php echo $this->catalogue_model->name_by_another($item['pic_type']) ?></td>
			            <td><?php echo $item['pic_name'] ?></td>
			            <td><?php echo $item['pic_text'] ?></td>
			            <td><?php echo $item['pic_tag'] ?></td>
			            <td>
			            	<a href="javascript:void(0)" onClick="Pass('<?php echo $item['pic_uuid'] ?>')">通过</a> | 
			            	<a href="javascript:void(0)" onClick="Reject('<?php echo $item['pic_uuid'] ?>')">驳回</a>
			            </td>
			          </tr>
			         <?php endforeach ?>
			        </tbody>
			      </table>
			</div>
<script>
	function Pass (uuid) {
		$.get("<?php echo base_url('admin/pass') . '/'  ?>" + uuid,function(data){
			location.reload();
		});
	}

	function Reject (uuid) {
		$.get("<?php echo base_url('admin/reject') . '/'  ?>" + uuid,function(data){
			location.reload();
		});
	}
</script>