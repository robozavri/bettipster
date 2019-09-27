<div id="chat"  class="chat messages">
   <?php if(!empty($messages)) : ?>
    <?php foreach ($messages as $message) : ?>
       <?php if($message['id'] == $this->session->user_id){$alegin = 'right hisnikname';}
                        else{$alegin = 'left mynikname';}?>
  <div class="message">
                      <span class="chat-username pull-<?php // echo $alegin;?>"> <strong class="primary-font"><a href="<?php echo base_url('profile/show').'/'.$message['id'];?>"><?php echo $message['username'];?></a></strong></span>
                      <span class="pull-right"><i><?php echo  time_converter_helper($message['create_date']);?></i></span>
                      <p><?php echo $message['content'];?></p>
                  </div>
                   <?php endforeach;?>
                  <?php endif;?>
              </div>
<?php return; ?>



<ul id="chat"  class="chat">
  <?php if(!empty($messages)) : ?>
    <?php foreach ($messages as $message) : ?>
      <?php if($message['id'] == $this->session->user_id){$alegin = 'right';}
        else{$alegin = 'left';}?>
      <li  class="<?php echo $alegin;?> clearfix">
        <span class="chat-img pull-<?php echo $alegin;?>">
          <?php if(!empty($message['avatar'])) : ?>
          <img  src="<?php echo base_url().'uploads/avatars/'.$message['avatar'];?>"  class="avatar img-circle" alt="avatar">
          <?php else:?>
          <img  src="<?php echo base_url().'uploads/icons/100.png';?>"  class="avatar img-circle" alt="avatar">
          <?php endif;?>
        </span>
        <div class="chat-body clearfix">
          <div class="header">
            <strong class="primary-font"> <a href="<?php echo base_url('profile/show').'/'.$message['id'];?>"><?php echo $message['username'];?></a></strong>
            <small class="pull-right text-muted"><i class="fa fa-clock-o"></i><?php echo time_converter_helper($message['create_date']);?></small>
          </div>
          <p class="message_content">
          <?php echo $message['content'];?>
          </p>
        </div>
      </li>
    <?php endforeach;?>
  <?php endif;?>
</ul>
