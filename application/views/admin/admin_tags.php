			<div class="col-md-9">
				<table class="table table-striped table-hover">
			        <thead>
			          <tr>
			          	<th>操作</th>
			            <th>名称</th>
			            <th>次数</th>
			          </tr>
			        </thead>
			        <tbody>
			        <?php foreach ($tag as $item): ?>
			          <tr>
			            <td>
			            	<a href="javascript:void(0)" onClick="DeleteTag('<?php echo $item['ID'] ?>')">删除</a>
			            </td>
			            <td><?php echo $item['tag_name'] ?></td>
			            <td><?php echo $item['tag_amount'] ?></td>
			          </tr>
			         <?php endforeach ?>
			        </tbody>
			      </table>
			</div>
		</div>
	</div>
</div>
<script>
	function DeleteTag (id) {
		$.get("<?php echo base_url('admin/deletetag') . '/'  ?>" + id,function(data){
			location.reload();
		});
	}
</script>