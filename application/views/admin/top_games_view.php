<div class="container-fluid">

<div class="col-md-6">
 <h3><?php echo $this->lang->line('text_site_advice');?></h3>
  <table id="matches" class="table table-bordered">
    <tr class="bg-info">
      <th><?php echo $this->lang->line('text_sport');?></th>
      <th><?php echo $this->lang->line('match_name');?></th>

      <th><?php echo $this->lang->line('date');?></th>
      <th><?php echo $this->lang->line('mark');?></th>
    </tr>
    <?php  if(!empty($top_games)) :?>

      <form class="" action="<?php echo base_url('panel/top_games/delete_top_games')?>" method="post">
       <p>
          <a onclick="return confirm('<?php echo $this->lang->line('are_you_shure');?>');" href="<?php echo base_url('panel/top_games/delete_all_top_games')?>" class="btn btn-danger"><?php echo $this->lang->line('delete_all_advices');?></a>
          <button onclick="return confirm('<?php echo $this->lang->line('are_you_shure');?>');" type="submit" class="btn btn-warning" name="button"><?php echo $this->lang->line('delete_selected');?></button>
        </p>
       <?php foreach ($top_games as $match) : ?>
          <tr data-id="<?php echo $match['xml_id'];?>" >
            <td><?php echo kind_sport_cinverter_helper($match['kind_sport_id']);?></td>
            <td><?php echo $match['match_name'];?></td>
          
       
            <td><?php echo date("F j, g:i a",strtotime($match['start_date']));?></td>
   
            <td><div class="col-lg-1"> <input type="checkbox" name="check_list[]" value="<?php echo $match['xml_id'];?>"></div> </td>
          </tr>
      <?php  endforeach; ?>
        </form>
    <?php endif;?>
    </table>
  </div>
