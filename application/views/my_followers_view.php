  <div class="col-md-8 col-sm-12">
    <div class="row accaunt-area">
      <div class="col-md-2 col-sm-2">      
                 <?php if(!empty($user['avatar'])) : ?>
                <img class="accaunt-avatar" src="<?php echo base_url().'uploads/avatars/'.$user['avatar'];?>"  class="img-responsive accaunt-img" alt="avatar">
                <?php else:?>
                <img class="accaunt-avatar" src="<?php echo base_url().'assets/icons/biguser.png';?>"  class="img-responsive accaunt-img" alt="avatar">
                <?php endif;?>
      </div>
      <div class="col-md-4 col-sm-2">
          <div class="nikname">
            <span><?php echo $user['username'];?></span>
            <input id="followUrl" type="hidden" data-ajxUrl="<?php echo base_url();?>">
          </div>
      </div>
        <div class="col-md-3 col-sm-3 pull-right">
            <span class="messages-notie">
              <img src="<?php echo base_url();?>assets/icons/letter.png" class="img-responsive" >
         
               <a data-user-id="<?php echo $user['id'];?>" href="<?php echo base_url('Chat');?>" class="start_chat"><?php echo $this->lang->line('text_messages');?></a>
        </span>
        </div>
  </div>
        <div class="tabletitles">
              <h1><?php echo $this->lang->line('text_statistic');?></h1>
         </div>
     <table class="table table-bordered mytaable">
    <tr class="bg-info">
      <th><?php echo $this->lang->line('text_username');?></th>
    </tr>
    <?php if(!empty($users)) :?>
      <?php foreach ($users as $user) : ?>
    <tr>
      <td><a href="<?php echo base_url('profile/show/').$user['id'];?>" class="link_white"><?php echo $user['username'];?></a></td>
    </tr>
      <?php endforeach;?>
    <?php endif;?>
  </table>
    
  </div>

