<div class="col-md-10">
  <nav aria-label="...">
    <ul class="pagination">
      <?php foreach (range('a', 'z') as $number):  ?>
        <li><a href="<?php echo base_url('Users/sort').'/'.$number;?>"><?php echo $number;?></a></li>
      <?php endforeach; ?>
    </ul>
  </nav>
</div>
<div class="col-md-8">
<?php
$template = array(
        'table_open' => '<table class="table table-bordered mytaable">'
);
$this->table->set_heading(array($this->lang->line('text_username'), $this->lang->line('regist_date')));

$this->table->set_template($template);

  foreach($users->result() as  $user)
  {
      $this->table->add_row(
        anchor("profile/show/$user->id", $user->username, array('class' => 'link_white')),
        date("j.n.Y",strtotime($user->regist_date))
      );
  }

  echo $this->table->generate();

  echo $this->pagination->create_links();
?>
</div>
