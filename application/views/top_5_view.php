       <div class="ad-horizontal">
                   <span style="  margin-top: 5%; display: inline-block; font-size: 26px; color: #4d4c5c; font-weight: bold;">770 X 200</span>
    </div>
         <div class="tabletitles">
                    <h1><?php echo $this->lang->line('text_top_5');?></h1>
                </div>
  <table id="matches" class="table table-bordered mytaable">
    <tr class="bg-info">
      <th><?php echo $this->lang->line('username');?></th>
      <th><?php echo $this->lang->line('match_name');?></th>
      <th><?php echo $this->lang->line('pick');?></th>
      <th><?php echo $this->lang->line('odd');?></th>
      <th><?php echo $this->lang->line('forecast_date');?></th>
      <th><?php echo $this->lang->line('result');?></th>
    </tr>
    <?php if(!empty($top_5)) :?>
       <?php foreach ($top_5 as $match) : ?>
          <tr data-id="<?php echo $match['xml_id'];?>">
          <td><a class="link_white" href="<?php echo base_url('profile/show/').$match['id'];?>"><?php echo $match['username'];?></a></td>
          <td><?php echo $match['match_name'];?></td>
          <td><?php echo odd_type_converter($match['odd_type']);?></td>
          <td><?php echo $match['odd_value'];?></td>
          <td><?php echo date("j.n.Y",strtotime($match['start_date']));?></td>
          <td  <?php if($match['is_winner']){echo 'class="win_row"';}elseif ($match['is_winner'] == 0 and $match['status'] == 1) { echo 'class="lose_row"';}?>><?php  if(!empty( $match['result'] ))
            echo $match['result']; else echo ' - ';?></td>
        </tr>
      <?php  endforeach; ?>
    <?php endif;?>
    
    </table>
  <div class="ad-horizontal">
                   <span style="  margin-top: 5%; display: inline-block; font-size: 26px; color: #4d4c5c; font-weight: bold;">770 X 200</span>
    </div>