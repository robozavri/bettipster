<div class="container-fluid">

<div class="col-md-6">
 <h3><?php echo $this->lang->line('text_site_advice');?></h3>
  <table id="matches" class="table table-bordered">
    <tr class="bg-info">
      <th><?php echo $this->lang->line('text_sport');?></th>
      <th><?php echo $this->lang->line('match_name');?></th>
      <th><?php echo $this->lang->line('pick');?></th>
      <th><?php echo $this->lang->line('odd');?></th>
      <th><?php echo $this->lang->line('forecast_date');?></th>
      <th><?php echo $this->lang->line('result');?></th>
      <th><?php echo $this->lang->line('mark');?></th>
    </tr>
    <?php if(!empty($statistic)) :?>
      <form class="" action="<?php echo base_url('panel/Forecast/advices_delete')?>" method="post">
        <p>
          <a onclick="return confirm('<?php echo $this->lang->line('are_you_shure');?>');" href="<?php echo base_url('panel/Forecast/delete_all_advices')?>" class="btn btn-danger"><?php echo $this->lang->line('delete_all_advices');?></a>
          <button onclick="return confirm('<?php echo $this->lang->line('are_you_shure');?>');" type="submit" class="btn btn-warning" name="button"><?php echo $this->lang->line('delete_selected');?></button>
        </p>
       <?php foreach ($statistic as $match) : ?>
          <tr data-id="<?php echo $match['xml_id'];?>" <?php if($match['is_winner']){echo 'class="win_row"';}?>>
            <td><?php echo kind_sport_cinverter_helper($match['sport_id']);?></td>
            <td><?php echo $match['match_name'];?></td>
            <td><?php echo odd_type_converter_kind_sport($match['odd_type'],$match['sport_id'],$match['under_over_value']);?></td>
            <td><?php echo $match['odd_value'];?></td>
            <td><?php echo date("F j, g:i a",strtotime($match['add_date']));?></td>
            <td><?php echo $match['result'];?></td>
            <td><div class="col-lg-1"> <input type="checkbox" name="check_list[]" value="<?php echo $match['xml_id'];?>"></div> </td>
          </tr>
      <?php  endforeach; ?>
        </form>
    <?php endif;?>
    </table>
  </div>
