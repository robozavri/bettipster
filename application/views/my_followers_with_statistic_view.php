  <div class="col-md-8 col-sm-12">
    <div class="row accaunt-area">
      <div class="col-md-2 col-sm-2">      
              <?php if(!empty($user['avatar'])) : ?>
                <img width="150" height="150" src="<?php echo base_url().'uploads/avatars/'.$user['avatar'];?>"  class="img-responsive accaunt-img" alt="avatar">
                <?php else:?>
                <img width="150" height="150" src="<?php echo base_url().'fotos/avatars/1 (34).png';?>"  class="img-responsive accaunt-img" alt="avatar">
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
         
              <a data-user-id="<?php echo $user['id'];?>" href="<?php echo base_url('Chat/show').'/'.$user['id'];?>" class="start_chat">მიწერე რამე </a>
        </span>
        </div>

  </div>
         <div class="tabletitles">
              <h1>სტატისტიკა</h1>
         </div>

        <?php  if(!empty($my_followers))
              for ($i = 0; $i < count($my_followers); $i++) { ?>
                <!-- <h3><?php echo $my_followers[$i]['usernames'];?></h3> -->
                <table id="matches" class="table table-bordered mytaable">
                  <tr class="bg-primary">
                    <td>
                        <?php echo $my_followers[$i]['usernames'];?>
                    </td>
                  </tr>
                  <tr class="bg-info">
                    <th><?php echo $this->lang->line('match_name');?></th>
                    <th><?php echo $this->lang->line('pick');?></th>
                    <th><?php echo $this->lang->line('odd');?></th>
                    <th><?php echo $this->lang->line('forecast_date');?></th>
                    <th><?php echo $this->lang->line('result');?></th>
                  </tr>
                  <?php  for ($j = 0; $j < count($my_followers[$i]['followers_statistic']); $j++) { ?>
                      <tr data-id="<?php echo $my_followers[$i]['followers_statistic'][$j]['xml_id'];?>" <?php if($my_followers[$i]['followers_statistic'][$j]['is_winner']){echo 'class="win_row"';}?>>
                        <td><?php echo $my_followers[$i]['followers_statistic'][$j]['match_name'];?></td>
                        <td><?php echo odd_type_converter($my_followers[$i]['followers_statistic'][$j]['odd_type']);?></td>
                        <td><?php echo $my_followers[$i]['followers_statistic'][$j]['odd_value'];?></td>
                        <td><?php echo date("F j, g:i a",strtotime($my_followers[$i]['followers_statistic'][$j]['add_date']));?></td>
                        <td><?php echo $my_followers[$i]['followers_statistic'][$j]['result'];?></td>
                      </tr>

             <?php   }
                } ?>

        </table>
      </div>
  