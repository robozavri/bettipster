<div class="container-fluid">
    <div class="row">
		<div class="col-md-4">
            <!-- =============================================================== -->
            <!-- member list -->
            <ul class="friend-list" id="friend-list">
                <li style="background-color:#fff;">
                  <a href="" class="clearfix" style=" pointer-events: none;
              cursor: default;">                    <?php if(!empty($users['avatar'])) : ?>
    			          <img  src="<?php echo base_url().'uploads/avatars/'.$users['avatar'];?>"  class="avatar img-circle" alt="avatar">
    			          <?php else:?>
    			          <img  src="<?php echo base_url().'uploads/icons/100.png';?>"  class="avatar img-circle" alt="avatar">
    			          <?php endif;?>
                  	<div class="friend-name">
                			<strong><?php echo $users['username'];?></strong>
                		</div>
                		<div class="last-message text-muted"></div>
                		<small class="time text-muted"></small>
                	<small class="chat-alert text-muted"><i class="fa fa-check"></i></small>
                	</a>
                </li>
                <?php if(!empty($chat['users'])) : ?>
                  <?php foreach($chat['users'] as $users) : ?>
                      <?php if($users['id'] == $this->session->user_id) { continue; } ?>
                  <li data-user-id="<?php echo $users['id'];?>"<?php if($users['msg_count'] != 0 ) : ?>class="active bounceInDown"<?php endif;?>>
                  	<a href="#" class="clearfix">
                    <?php if(!empty($users['avatar'])) : ?>
                    <img  src="<?php echo base_url().'uploads/avatars/'.$users['avatar'];?>"  class="avatar img-circle" alt="avatar">
                    <?php else:?>
                    <img  src="<?php echo base_url().'uploads/icons/100.png';?>"  class="avatar img-circle" alt="avatar">
                    <?php endif;?>
                    <div class="friend-name">
                  			<strong><?php echo $users['username'];?></strong>
                  		</div>
                  		<div class="last-message text-muted"><?php echo $users['message'];?></div>
                  		<small class="time text-muted"><?php echo time_converter_helper($users['send_data']);?></small>
                      <?php if($users['msg_count'] != 0 ) : ?>
                    	<small class="messageCount chat-alert label label-danger"><?php echo $users['msg_count'];?></small>
                      <?php endif;?>
                    </a>
                  </li>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>
		</div>

        <!--=========================================================-->
        <!-- selected chat -->
    	<div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                  <form class="" action="<?php echo base_url('Chat/block');?>" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $current_user_id;?>">
                    <button type="button" class="btn btn-danger">block user <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button>
                  </form>
                </div>
            </div>
            <div class="chat-message">
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
                    <!-- <li class="right clearfix">
                    	<span class="chat-img pull-right">
                    		<img src="http://bootdey.com/img/Content/user_1.jpg" alt="User Avatar">
                    	</span>
                    	<div class="chat-body clearfix">
                    		<div class="header">
                    			<strong class="primary-font">Sarah</strong>
                    			<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 13 mins ago</small>
                    		</div>
                    		<p>
                    			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at.
                    		</p>
                    	</div>
                    </li> -->
                </ul>
            </div>
            <div class="chat-box bg-white">
              <form id="chat_form" class="" action="<?php echo base_url('Ajax_Chat/send');?>" method="post">
                <div id="user_data" data-userid="<?php echo $this->session->user_id;?>" data-avatar="<?php echo base_url('uploads/avatars').'/'.$this->session->avatar;?>" data-username="<?php echo $this->session->username;?>"></div>
                <input type="hidden" name="user_id" value="<?php echo $users['id'];?>">
                	<div class="input-group">
                		<input id="message" class="form-control border no-shadow no-rounded" name="message" placeholder="Type your message here">
                		<span class="input-group-btn">
                			<button class="btn btn-success no-rounded" type="submit"><?php echo $this->lang->line('text_send');?> <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
                		</span>
                	</div><!-- /input-group -->
              </form>
            </div>
	  	</div>
	</div>
</div>
<script src="<?php echo base_url();?>assets/js/chat.js"></script>
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
