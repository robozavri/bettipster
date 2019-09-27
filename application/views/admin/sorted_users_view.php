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
<?php
$template = array(
        'table_open' => '<table class="table table-bordered">'
);
$this->table->set_heading(array(
   $this->lang->line('text_username'),
   $this->lang->line('email'),
   $this->lang->line('edit')
));

$this->table->set_template($template);

  foreach($users->result() as  $user)
  {
      $this->table->add_row(
        anchor("profile/show/$user->id", $user->username),
        $user->email,
        anchor("panel/users/edit/$user->id", 'edit profile').'<br>'.
        anchor("panel/users/edit_user_forecasts/$user->id",'edit users games')

      );
  }

  // echo $this->table->generate($users);
  echo $this->table->generate();

  echo $this->pagination->create_links();
?>
</div>
