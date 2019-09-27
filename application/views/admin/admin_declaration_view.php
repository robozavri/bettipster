
	<div class="col-md-8">
		<form class="form-horizontal" action="<?php echo base_url('panel/Managment/admin_declaration')?>" method="post">
		 <div class="form-group">
		    <div class="col-md-5">
		<textarea class="form-control" name="admin_message" placeholder="message write here"></textarea>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-md-5">
		  <input type="submit" value="Submit">
		    </div>
		  </div>
		</form>

	</div>
			<div class="col-md-8">
					<div class="panel panel-default">
					  <div class="panel-body">
					  <?php foreach($messages as $row ) : ?>
					  	<p><?php echo $row->message; ?>
					  		<a class="pull-right" href="<?php echo base_url('panel/Managment/admin_declaration_delete/').$row->adm_msg_id;?>">delete</a>
					  	</p>
					  	<hr>
					  <?php endforeach;?>
					  </div>
					</div>
			</div>

	
