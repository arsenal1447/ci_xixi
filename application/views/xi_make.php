	<div class="container top">
		<table class="table table-striped table-hover">
	        <tbody>
	          	<?php foreach ($make as $key => $value): ?>
      				<?php if( $key % 6 == 0 ): ?><tr><?php endif ?>
      					<td>
      						<?php $url = base_url('tag/' . $value['tag_name']); ?>
      						<a href="<?php echo $url ?>"><?php echo $value['tag_name'] ?></a>
      					</td>
	          	<?php endforeach ?>
	        </tbody>
	    </table>
	</div>
</div>