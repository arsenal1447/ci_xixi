<div class="container top">
	<div class="row">
		<div class="col-md-3">
    		<ul class="nav nav-pills nav-stacked pinned">
        		<li class="active">
				  	<a href="<?php echo base_url('admin/index') ?>">管理中心</a>
				</li>
				<li>
				  	<a class="<?php if(strpos(current_url(),'system')) echo 'activeadmin' ?>" href="<?php echo base_url('admin/system') ?>">基础设置</a>
				</li>
				<li>
				  	<a class="<?php if(strpos(current_url(),'image')) echo 'activeadmin' ?>" href="<?php echo base_url('admin/image') ?>">图片审核</a>
				</li>
				<li>
				  	<a class="<?php if(strpos(current_url(),'picture')) echo 'activeadmin' ?>" href="<?php echo base_url('admin/picture') ?>">图片管理</a>
				</li>
				<li>
				  	<a class="<?php if(strpos(current_url(),'usercen')) echo 'activeadmin' ?>" href="<?php echo base_url('admin/usercen') ?>">会员管理</a>
				</li>
				<li>
				  	<a class="<?php if(strpos(current_url(),'types')) echo 'activeadmin' ?>" href="<?php echo base_url('admin/types') ?>">分类管理</a>
				</li>
				<li>
				  	<a class="<?php if(strpos(current_url(),'tags')) echo 'activeadmin' ?>" href="<?php echo base_url('admin/tags') ?>">标签管理</a>
				</li>
			</ul>
		</div>