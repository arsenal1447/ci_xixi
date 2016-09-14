<div class="col-md-9">
	<table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>操作</th>
            <th>名称</th>
            <th>身份</th>
            <th>日期</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($image as $item): ?>
          <tr>
            <td>
              <?php if(!$item['user_status']) { ?>
            	<a href="javascript:void(0)" onClick="DeleteUser('<?php echo $item['ID'] ?>')">删除</a>
              <?php } ?>
            </td>
            <td>
              <?php echo $item['user_login'] ?>
            </td>
            <td>
              <?php 
              if($item['user_status']) {
                echo "管理员";
              } else {
                echo "普通会员";
              }
              ?>
            </td>
            <td><?php echo $item['user_register'] ?></td>
          </tr>
         <?php endforeach ?>
        </tbody>
      </table>
</div>
<script>
  function DeleteUser (id) {
    $.get("<?php echo base_url('admin/deleteuser') . '/'  ?>" + id,function(data){
      location.reload();
    });
  }
</script>