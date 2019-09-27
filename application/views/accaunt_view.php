  <div class="col-md-8 col-sm-12">
    <div class="row accaunt-area">
      <div class="col-md-2 col-sm-2">      
              <?php if(!empty($user['avatar'])) : ?>
                <img class="accaunt-avatar" src="<?php echo base_url().'uploads/avatars/'.$user['avatar'];?>"  class="img-responsive accaunt-img" alt="avatar">
                <?php else:?>
                <img class="accaunt-avatar" src="<?php echo base_url().'assets/icons/biguser.png';?>"  class="img-responsive accaunt-img" alt="avatar">
                <?php endif;?>
      </div>
      <div class="col-md-4 col-sm-2">
          <div class="nikname">
            <span><?php echo $user['username'];?></span>
            <input id="followUrl" type="hidden" data-ajxUrl="<?php echo base_url();?>">
          </div>
      </div>
        <div class="col-md-3 col-sm-3 pull-right">
            <span class="messages-notie">
              <img src="<?php echo base_url();?>assets/icons/letter.png" class="img-responsive" >
         
              <a data-user-id="<?php echo $user['id'];?>" href="<?php echo base_url('Chat');?>" class="start_chat"><?php echo $this->lang->line('text_chat');?></a>
        </span>
        </div>
  </div>
        <div class="tabletitles">
              <h1><?php echo $this->lang->line('text_statistic');?></h1>
         </div>
        <?php if(!empty($statistic)) : ?>
    			<table class="table table-bordered mytaable">
    				<tr class="bg-info">
    					<th><?php echo $this->lang->line('match_count');?></th>
    					<th><?php echo $this->lang->line('win');?></th>
              <th><?php echo $this->lang->line('lost');?></th>
    					<th><?php echo $this->lang->line('procent_win');?></th>
    				</tr>
              <?php if(!empty($statistic['statistic_mini'])) :?>
    				<tr>   
              <?php foreach ( $statistic['statistic_mini'] as $value):  ?>
    					<td><?php echo $value['forecoast_count'];?></td>
    					<td><?php echo $value['win'];?></td>
              <td><?php echo $value['lose'];?></td>
    					<td><?php echo $value['procent_win'];?></td>
    					
            <?php endforeach; ?>
    			  </tr>
              <?php endif;?>
    			</table>
    			<table id="matches" class="table table-bordered mytaable">
    				<tr class="bg-info">
    					<th><?php echo $this->lang->line('kind_sport');?></th>
    					<th><?php echo $this->lang->line('match_name');?></th>
    					<th><?php echo $this->lang->line('pick');?></th>
    					<th><?php echo $this->lang->line('odd');?></th>
    					<th><?php echo $this->lang->line('forecast_date');?></th>
    					<th><?php echo $this->lang->line('result');?></th>
    				</tr>
            <?php if(!empty($statistic['matches'] )) :?>
                  <?php foreach ($statistic['matches'] as $match) { ?>
                        <tr data-id="<?php echo $match['xml_id'];?>" <?php if($match['is_winner']){echo 'class="win_row"';}?>>
                        <td><?php echo kind_sport_cinverter_helper($match['sport_id']);?></td>
                        <td><?php echo $match['match_name'];?></td>
                        <td><?php echo odd_type_converter_kind_sport($match['odd_type'],$match['sport_id'],$match['under_over_value']);?></td>
                        <td><?php echo $match['odd_value'];?></td>
                        <td><?php echo date("j.n.Y",strtotime($match['start_date']));?></td>
                        <td  <?php if($match['is_winner']){echo 'class="win_row"';}elseif ($match['is_winner'] == 0 and $match['status'] == 1) { echo 'class="lose_row"';}?>><?php if(empty($match['result'])){echo ' - '; }else{ echo $match['result']; } ?></td>
                      </tr>
                  <?php }?>
               <?php endif;?>
            </table>
          <?php endif;?>
          </div>
        </div>
      </div>
    	<script src="<?php echo base_url();?>assets/js/profile.js"></script>
