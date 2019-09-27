<div class="container-fluid">
<div class="col-md-10">
  <nav aria-label="...">
    <ul class="pagination">
      <?php foreach (range('a', 'z') as $number):  ?>
        <li><a href="<?php echo base_url('panel/Users/sort').'/'.$number;?>"><?php echo $number;?></a></li>
      <?php endforeach; ?>
    </ul>
  </nav>
</div>
<div class="col-md-7">
<?php
$template = array(
        'table_open' => '<table class="table table-bordered">'
);
$this->table->set_heading(array(
   $this->lang->line('text_username'),
  //  $this->lang->line('name'),
  //  $this->lang->line('full_name'),
   $this->lang->line('email'),
  //  $this->lang->line('phone'),
  //  $this->lang->line('address'),
  //  $this->lang->line('birthday'),
  //  $this->lang->line('text_registr_date'),
  //  $this->lang->line('is_active'),
  //  $this->lang->line('bet_limit'),
  //  $this->lang->line('bet_limit_date'),
  //  $this->lang->line('avatar'),
  //  $this->lang->line('is_block'),
   $this->lang->line('edit')
));

$this->table->set_template($template);

  foreach($users->result() as  $user)
  {
      $this->table->add_row(
        anchor("panel/users/edit/$user->id", $user->username),
        // $user->name,
        // $user->full_name,
        $user->email,
        // $user->phone,
        // $user->address,
        // $user->birthday,
        // $user->regist_date,
        // $user->is_active,
        // $user->bet_limit,
        // $user->bet_limit_date,
        // $user->avatar,
        // $user->is_block,
        anchor("panel/users/edit/$user->id", 'edit profile').'<br>'.
        anchor("panel/users/edit_user_forecasts/$user->id",'edit users games')
      );
  }

  echo $this->table->generate();

  echo $this->pagination->create_links();
?>
</div>
</div>
