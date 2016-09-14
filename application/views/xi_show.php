<div class="jumbotron">
	<div class="container">
		<div class="row" style="margin-top: 10px;">
		    <?php
                $query = $this->tags_model->alltags();
                foreach ($query as $value) {
            ?>
            <div class="col-xs-2" style="margin-top: 10px;"><a href="<?php echo base_url('tag') . '/' . $value['tag_name'] ?>"><?php echo $value['tag_name'] ?></a></div>
            <?php } ?>
		</div>
	</div>
</div>