<div class="col-md-7">
  <?php if(!empty($statistic)) : ?>
  <table class="table table-bordered">
    <tr class="bg-info">
      <th><?php echo $this->lang->line('username');?></th>
      <th><?php echo $this->lang->line('match_count');?></th>
      <th><?php echo $this->lang->line('win');?></th>
      <th><?php echo $this->lang->line('procent_win');?></th>
      <th><?php echo $this->lang->line('lost');?></th>
    </tr>
      <?php for ($i=0; $i < count($statistic); $i++) :?>
    <tr>
      <td> <a href="<?php echo base_url('profile/show/').$statistic[$i]['user_id'];?>"> <?php echo $statistic[$i]['username'];?></a></td>
      <td><?php echo $statistic[$i]['match_count'];?></td>
      <td><?php echo $statistic[$i]['won_count'];?></td>
      <td><?php echo $statistic[$i]['procent_wins'];?></td>
      <td><?php echo $statistic[$i]['lost'];?></td>
    </tr>
    <?php endfor;?>
  <?php endif;?>
  </table>
</div>
