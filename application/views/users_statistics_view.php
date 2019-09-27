<div class="col-md-7">
<?php
$template = array(
        'table_open' => '<table class="table table-bordered">'
);
$this->table->set_heading(array($this->lang->line('username'),$this->lang->line('match_count'), $this->lang->line('win'), $this->lang->line('procent_win'), $this->lang->line('lost')));

$this->table->set_template($template);

  foreach($users->result() as  $user)
  {
      $this->table->add_row(
        anchor("profile/show/$user->user_id", $user->username),
        $user->forecoast_count,
        $user->win,
        $user->procent_win,
        $user->lose
      );
  }

  // echo $this->table->generate($users);
  echo $this->table->generate();

  echo $this->pagination->create_links();
?>
</div>
