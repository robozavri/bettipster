<div class="container-fluid">
  <div class="row">
  <div class="col-md-6">
  <h4>ეფექტურობა 10 თამაში და მეტი</h4>
   <table id="matches" class="table table-bordered mytaable table-hover">
   <tr class="bg-info">
     <th>უსერნეიმი</th>
     <th>ოვერეიჯი</th>
   </tr>
 		<?php if(!empty($average_10_to_20)) :?>
			<?php foreach($average_10_to_20 as $avarage) : ?>
				<tr>
					<td><a href="<?php echo base_url('panel/users/edit/').$avarage['user_id'];?>"><?php echo $avarage['username'];?></a></td>
					<td><?php echo round($avarage['avarage'],4);?></td>
				</tr>
 		<?php endforeach;?>	
 		<?php endif;?>	
	</table>
<h4>ეფექტურობა 100%</h4>
	<table class="table table-hover">
	<tr class="bg-info">
     <th>უსერნეიმი</th>
     <th>ოვერეიჯი</th>
   </tr>
 		<?php if(!empty($average_100)) :?>
			<?php foreach($average_100 as $avarage) : ?>
				<tr>
					<td><a href="<?php echo base_url('panel/users/edit/').$avarage['user_id'];?>"><?php echo $avarage['username'];?></a></td>
					<td><?php echo round($avarage['avarage'],4);?></td>
				</tr>
				 		<?php endforeach;?>	

 		<?php endif;?>	
	</table>

	<h4>ეფექტურობა 20 თამაში და მეტ</h4>
<table class="table table-hover">
<tr class="bg-info">
     <th>უსერნეიმი</th>
     <th>ოვერეიჯი</th>
   </tr>
 		<?php if(!empty($average_over_20)) :?>
			<?php foreach($average_over_20 as $avarage) : ?>
				<tr>
					<td><a href="<?php echo base_url('panel/users/edit/').$avarage['user_id'];?>"><?php echo $avarage['username'];?></a></td>
					<td><?php echo round($avarage['avarage'],4);?></td>
				</tr>
			<?php endforeach;?>	
 		<?php endif;?>	
	</table>
  </div>
  </div>
</div>