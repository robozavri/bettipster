<div class="col-md-7">
  <table class="table table-bordered">
    <tr class="bg-info">
      <th><?php echo $this->lang->line('text_username');?></th>
      <th><?php echo $this->lang->line('text_registr_date');?></th>
    </tr>
    <?php if(!empty($users)) :?>
      <?php foreach ($users as $user) : ?>
    <tr>
      <td><a href="<?php echo base_url('profile/show/').$user['id'];?>"><?php echo $user['username'];?></a></td>
      <td><?php echo $user['regist_date'];?></td>
    </tr>
      <?php endforeach;?>
    <?php endif;?>
  </table>
</div>
