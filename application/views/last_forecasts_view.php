  <div class="tabletitles">
       <h1><?php echo $this->lang->line('last_forecasts');?></h1>
   </div>

 <table id="matches" class="table table-bordered mytaable">
   <tr class="bg-info">
     <th><?php echo $this->lang->line('text_sport');?></th>
     <th><?php echo $this->lang->line('username');?></th>
     <th><?php echo $this->lang->line('match_name');?></th>
     <th><?php echo $this->lang->line('pick');?></th>
     <th><?php echo $this->lang->line('odd');?></th>
     <th><?php echo $this->lang->line('forecast_date');?></th>
     <th><?php echo $this->lang->line('result');?></th>
   </tr>
   <?php  if(!empty($last_forecasts)) :?>
      <?php foreach ($last_forecasts as $match) : ?>
        <tr data-id="<?php echo $match['xml_id'];?>">
           <td><?php echo kind_sport_cinverter_helper($match['sport_id']);?></td>
           <td><a class="link_white" href="<?php echo base_url('profile/show/').$match['id'];?>"><?php echo $match['username'];?></a></td>
           <td><?php echo $match['match_name'];?></td>
           <td><?php echo odd_type_converter_kind_sport($match['odd_type'],$match['sport_id'],$match['under_over_value']);?></td>
           <td><?php echo $match['odd_value'];?></td>
           <td><?php echo date("j.n.Y",strtotime($match['start_date']));?></td>
           <td  <?php if($match['is_winner']){echo 'class="win_row"';}elseif ($match['is_winner'] == 0 and $match['status'] == 1) { echo 'class="lose_row"';}?>><?php  if(!empty( $match['result'] ))
            echo $match['result']; else echo ' - ';?></td>
         </tr>
     <?php  endforeach; ?>
   <?php endif;?>
   </table>
 
</div>
 <!-- end col 8 -->
  