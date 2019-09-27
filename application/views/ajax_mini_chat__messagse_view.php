<?php if(!empty($messages)) : ?>
  <?php foreach ($messages as $message) : ?>
  <div class="shout_msg">
		<span><?php echo $message['username'];?></span>
        <time><?php echo time_converter_helper($message['create_date'],true);?></time>
        <span class="message">
        <?php echo $message['content'];?>
        </span>
  </div>
  <?php endforeach;?>
<?php endif;?>
