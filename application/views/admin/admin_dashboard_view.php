<div class="container-fluid">
  <div class="row" style="padding: 10px;">

  	 <?php if(!empty($popular_matches)): ?>
      <div class="col-md-8">
      <h4>პოპულარული პროგნოზები</h4>
	      <table class="table table-responsive">
	  		<th>სპორტი</th>
	  		<th>მატჩი</th>
	  		<th>კოეფიციენტის ტიპი</th>
	  		<th>ტოტ</th>
	  		<th>კოეფიციენტი</th>
	  		<th>დაწყების დრო</th>
	  		<th>შედეგი</th>
	  		<th>რამდენმა დადო</th>
	  	<?php foreach($popular_matches as $popular_matche): ?>
	  		<tr>
			  <td><?php echo kind_sport_cinverter_helper($popular_matche['sport_id']);?></td>
			  <td><?php echo $popular_matche['match_name'];?></td>
			  <td><?php echo $popular_matche['odd_type'];?></td>
			  <td><?php echo $popular_matche['under_over_value'];?></td>
			  <td><?php echo $popular_matche['odd_value'];?></td>
			  <td><?php echo $popular_matche['add_date'];?></td>
			  <td><?php echo $popular_matche['result'];?></td>
			  <td><?php echo $popular_matche['total'];?></td>
			</tr>
		<?php endforeach;?>
			</table>
   </div>
 <?php endif; ?>

    <?php if(!empty($spammers)): ?>
      <div class="col-md-3">
      <h4>სპამზე შეტყობინება</h4>
	      <table class="table table-responsive">
	  		<th>username</th>
	  		<th>email</th>
	  		<th>report date</th>
	  	<?php foreach($spammers as $spammer): ?>
	  		<tr>
			  <td><a href="<?php echo base_url('panel/users/edit/').$spammer['id'];?>"><?php echo $spammer['username'];?></a></td>
			  <td><?php echo $spammer['email'];?></td>
			  <td><?php echo $spammer['report_date'];?></td>
			</tr>
		<?php endforeach;?>
			</table>
   </div>
	 <?php endif; ?>
  </div>
<div class="row" style="padding: 10px;">

    <div class="col-md-3">
    	<div class="list-group">
    	<h4>ლიგების და თამაშების განახლება</h4>
			  <a href="<?php echo base_url('panel/Managment/get_all_sport_matches/1');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">
			    Get Footbal leagues & matches
			  </a>
			  <a href="<?php echo base_url('panel/Managment/get_all_sport_matches/3');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">Get Basketball leagues & matches</a> 
			  <a href="<?php echo base_url('panel/Managment/get_all_sport_matches/2');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">Get Baseball leagues & matches</a>
			  <a href="<?php echo base_url('panel/Managment/get_all_sport_matches/4');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">Get Tennis leagues & matches</a>
			  <a href="<?php echo base_url('panel/Managment/get_all_sport_matches/6');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">Get Hockey leagues & matches</a>
			  <a href="<?php echo base_url('panel/Managment/get_all_sport_matches/5');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">Get Rugby leagues & matches</a>
			</div>
    </div>


  	  <div class="col-md-3">
  	  		<div class="list-group">
  	  		<h4>მატჩების შედეგების შემოწმება</h4>
			  <a href="<?php echo base_url('panel/Managment/check_forecasted_matches_results/1');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">
			    Check Footbal match results
			  </a>
			  <a href="<?php echo base_url('panel/Managment/check_forecasted_matches_results/3');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">Check Basketball match results</a> 
			  <a href="<?php echo base_url('panel/Managment/check_forecasted_matches_results/2');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">Check Baseball match results</a>
			  <a href="<?php echo base_url('panel/Managment/check_forecasted_matches_results/4');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">Check Tennis match results</a>
			  <a href="<?php echo base_url('panel/Managment/check_forecasted_matches_results/6');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">Check Hockey match results</a>
			  <a href="<?php echo base_url('panel/Managment/check_forecasted_matches_results/5');?>" class="list-group-item" onclick="return confirm('Are you sure ?');">Check Rugby match results</a>
			</div>
  	  </div>
  	
     <div class="col-md-3">
     	<div class="list-group">
     	<h4>სხვადასხვა ოპერაციები</h4>
	
		 <a class="list-group-item" href="<?php echo base_url('panel/Managment/update_10_to_20_statistics');?>"  onclick="return confirm('Are you sure  ?');">10 დან 20 თმაშამდე მქონე ტიპსტერების დათვლა</a>
		 <a class="list-group-item" href="<?php echo base_url('panel/Managment/update_over_20_statistics');?>"  onclick="return confirm('Are you sure ?');">20 თამაშზე მეტის მქონე ტიპსტერებს დათვლა</a>
		 <a class="list-group-item" href="<?php echo base_url('panel/Managment/update_raiting_100_statistics');?>"  onclick="return confirm('Are you sure ?');">100% ტიპსტერების დათვა</a>

		 <a class="list-group-item" href="<?php echo base_url('panel/Managment/get_all_sport_matches');?>"  onclick="return confirm('Are you sure you want to update sport datas ?');"><?php echo $this->lang->line('text_update_sport_data');?></a>
		  <a class="list-group-item" href="<?php echo base_url('panel/Managment/check_forecasted_matches_results')?>" onclick="return confirm('Are you sure you want to check forecasted matches results ?');"><?php echo $this->lang->line('text_check_forecasted_result');?></a>
		  <a class="list-group-item" href="<?php echo base_url('panel/Managment/test_top_5')?>" onclick="return confirm('Are you sure you want to test top 5 tipster ?');"><?php echo $this->lang->line('text_generate_best_5_tipster');?></a>
		  <a class="list-group-item" href="<?php echo base_url('panel/Managment/update_user_statistics')?>" onclick="return confirm('Are you sure you want to update users statistics ?');"><?php echo $this->lang->line('text_update_user_statistic');?></a>
		</div>
	</div>


  	  <div class="col-md-3">
  	  		<div class="list-group">
  	  		<h4>ძველი ინფორმაციის წაშლა</h4>
  	  			<a href="<?php echo base_url('panel/Managment/delete_old_top_games');?>" class="list-group-item" onclick="return confirm('Are you sure you ?');"><?php echo $this->lang->line('text_del_top_games');?></a>

  	  		<a href="<?php echo base_url('panel/Managment/delete_old_advised_matches');?>" class="list-group-item" onclick="return confirm('Are you sure you want delete old forecasted matches ?');"><?php echo $this->lang->line('text_del_advised_matches');?></a>
			   <a class="list-group-item" href="<?php echo base_url('panel/Managment/delete_old_forecasted_matches');?>" onclick="return confirm('Are you sure you want delete old forecasted matches ?');" data-toggle="tooltip" data-placement="left" title=" წაშლის ძველ  30 დღის წინ დადებულ პროგნოზებს"><?php echo $this->lang->line('text_del_old_forecasted_matches');?></a>
			   <a style="background-color: #FC4949;" class="list-group-item " href="<?php echo base_url('panel/Managment/delete_old_matches');?>" onclick="if(prompt('დარწმუნებული ხარ რომ გინდა ყველა მატჩების წაშლა ? წაიშლება ყველა მატჩი ყველა ლიგიდან ყველა სპორტში. ქვემოთ yes ჩაწერე') == 'yes'){
			     	return true;
			     }else{
			     	return false;
			     }"><?php echo $this->lang->line('text_del_old_matches_all_league');?></a>
			     <a style="background-color: #FC9449;" class="list-group-item " href="<?php echo base_url('panel/Managment/testing');?>" onclick="
			     if(prompt('დარწმუნებული ხარ რომ გინდა ტესტირების დაწყება ? ტესტირება წაშლის არესბულ მონაცემებს ყველგან დათავისას დააგენერირებს. ქვემოთ yes ჩაწერე') == 'yes'){
			     	return true;
			     }else{
			     	return false;
			     }
			     return ;"><?php echo $this->lang->line('text_start_testing');?></a>
			</div>
  	  </div>


  </div>
</div>