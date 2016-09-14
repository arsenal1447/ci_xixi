			<div class="col-md-9">
				<?php 
                  $attr = array('class' => 'form-horizontal','role' => 'form');
                  echo form_open('admin/setsystem', $attr);
                ?>
                	<div class="form-group">
                		<label class="col-sm-2 control-label">网站名称</label>
				    	<div class="col-sm-10">
				    		<input type="text" name="webtitle" value="<?php echo $this->system_model->get_webtitle() ?>" class="form-control border" autocomplete="off" required="true">    	
				  		</div>
				  		<div class="col-sm-offset-2 col-sm-10"><?php echo form_error('webtitle'); ?></div>
				  	</div>

				  	<div class="form-group">
                		<label class="col-sm-2 control-label">关键字</label>
				    	<div class="col-sm-10">
				    		<input type="text" name="keywords" value="<?php echo $this->system_model->get_keywords() ?>" class="form-control border" autocomplete="off" required="true">    	
				  		</div>
				  		<div class="col-sm-offset-2 col-sm-10"><?php echo form_error('keywords'); ?></div>
				  	</div>

				  	<div class="form-group">
                		<label class="col-sm-2 control-label">网站名称</label>
				    	<div class="col-sm-10">
				    		<input type="text" name="description" value="<?php echo $this->system_model->get_description() ?>" class="form-control border" autocomplete="off" required="true">    	
				  		</div>
				  		<div class="col-sm-offset-2 col-sm-10"><?php echo form_error('description'); ?></div>
				  	</div>
				  	
				  	<div class="form-group">
    					<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-success border">保存</button>
						</div>
  					</div>
				</form>
			</div>
		</div>
	</div>
</div>