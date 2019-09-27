<div class="container-fluid">
    <div class="col-md-8">
    <?php if(!empty($statistic)) : ?>
      <table id="matches" class="table table-bordered">
        <tr class="bg-info">
          <th><?php echo $this->lang->line('kind_sport');?></th>
          <th><?php echo $this->lang->line('match_name');?></th>
          <th><?php echo $this->lang->line('pick');?></th>
          <th><?php echo $this->lang->line('odd');?></th>
          <th><?php echo $this->lang->line('forecast_date');?></th>
          <th><?php echo $this->lang->line('result');?></th>
          <th><?php echo $this->lang->line('delete');?></th>
        </tr>
        <?php foreach ($statistic['matches'] as $match) {  ?>
              <tr data-id="<?php echo $match['xml_id'];?>" <?php if($match['is_winner']){echo 'class="win_row"';}?>>
              <td><?php echo kind_sport_cinverter_helper($match['sport_id']);?></td>
              <td><?php echo $match['match_name'];?></td>
              <td><?php echo odd_type_converter_kind_sport($match['odd_type'],$match['sport_id'],$match['under_over_value']);?></td>
              <td><?php echo $match['odd_value'];?></td>
              <td><?php echo date("F j, g:i:s a",strtotime($match['add_date']));?></td>
              <td><?php echo $match['result'];?></td>
              <td><a href="<?php echo base_url('panel/Forecast/delete_forecast').'/'.$match['id'];?>" onclick="return confirm('Are you sure you want to delete forecast ?');">delete</a></td>
            </tr>
        <?php }?>
        </table>
      <?php endif;?>
      </div>
  </div>
  <script src="<?php echo base_url();?>assets/js/profile.js"></script>
