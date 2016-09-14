			<div class="col-md-9">
				<h4>图标获取地址：<a href="http://www.bootcss.com/p/font-awesome/" target="_black"><small>http://www.bootcss.com/p/font-awesome/</small></a></h4>
			    <?php 
                  $attr = array('class' => 'form-inline' ,'role' => 'form');
                  echo form_open('admin/addtype', $attr);
                ?>
                	<div class="form-group">
				    	<input type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control border" placeholder="名称" autocomplete="off" required="true" autofocus="true">    	
				  	</div>
				  	<div class="form-group">
				    	<input type="text" name="another" value="<?php echo set_value('another'); ?>" class="form-control border" placeholder="别名" autocomplete="off" required="true">
				  	</div>
					<button type="submit" class="btn btn-success border">保存</button>
				</form>
				<?php echo validation_errors(); ?>
				<table class="table table-striped table-hover">
			        <thead>
			          <tr>
			          	<th>操作</th>
			            <th>名称</th>
			            <th>别名</th>
			            <th>图标</th>
			            <th>父级</th>
			          </tr>
			        </thead>
			        <tbody>
			        <?php foreach ($catalogue as $item): ?>
			          <tr>
			            <td>
			            	<a href="javascript:void(0)" onClick="DeleteType('<?php echo $item['ID'] ?>')">删除</a>
			            </td>
			            <td><?php echo $item['cat_name'] ?></td>
			            <td><?php echo $item['cat_another_name'] ?></td>
			            <td><?php echo $item['cat_icon'] ?></td>
			            <td><?php echo $item['cat_father'] ?></td>
			          </tr>
			         <?php endforeach ?>
			        </tbody>
			      </table>
			</div>
		</div>
	</div>
</div>
<script>
	function DeleteType (id) {
		$.get("<?php echo base_url('admin/deletetype') . '/'  ?>" + id,function(data){
			location.reload();
		});
	}
</script>