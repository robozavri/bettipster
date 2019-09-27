<div class="col-md-12">
  <nav aria-label="...">
    <ul class="pagination">
      <?php foreach (range('a', 'z') as $number):  ?>
        <li><a href="<?php echo base_url('panel/Users/sort').'/'.$number;?>"><?php echo $number;?></a></li>
      <?php endforeach; ?>
    </ul>
  </nav>
</div>
<div class="col-md-12">
  <table class="table table-bordered">
    <tr class="bg-info">
      <th><?php echo $this->lang->line('text_username');?></th>
      <th><?php echo $this->lang->line('name');?></th>
      <th><?php echo $this->lang->line('full_name');?></th>
      <th><?php echo $this->lang->line('email');?></th>
      <th><?php echo $this->lang->line('phone');?></th>
      <th><?php echo $this->lang->line('address');?></th>
      <th><?php echo $this->lang->line('birthday');?></th>
      <th><?php echo $this->lang->line('text_registr_date');?></th>
      <th><?php echo $this->lang->line('is_active');?></th>
      <th><?php echo $this->lang->line('bet_limit');?></th>
      <th><?php echo $this->lang->line('bet_limit_date');?></th>
      <th><?php echo $this->lang->line('avatar');?></th>
      <th><?php echo $this->lang->line('is_block');?></th>
    </tr>
    <?php if(!empty($users)) :?>
      <?php foreach ($users as $user) : ?>
    <tr>
      <td><a href="<?php echo base_url('panel/users/edit/').$user['id'];?>"><?php echo $user['username'];?></a></td>
      <td><?php echo $user['name'];?></a></td>
      <td><?php echo $user['full_name'];?></a></td>
      <td><?php echo $user['email'];?></a></td>
      <td><?php echo $user['phone'];?></a></td>
      <td><?php echo $user['address'];?></a></td>
      <td><?php echo $user['birthday'];?></a></td>
      <td><?php echo $user['regist_date'];?></td>
      <td><?php echo $user['is_active'];?></td>
      <td><?php echo $user['bet_limit'];?></td>
      <td><?php echo $user['bet_limit_date'];?></td>
      <td><?php echo $user['avatar'];?></td>
      <td><?php echo $user['is_block'];?></td>
    </tr>
      <?php endforeach;?>
    <?php endif;?>
  </table>
</div>
