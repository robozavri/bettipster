<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tipsters.ge</title>
</head>
<body>
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="<?php echo base_url();?>assets/jquery-3.1.0.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<span class="base_url" data-base-url="<?php echo base_url();?>"></span>
 <div class="admin-declaration-row">
     <?php  if(!empty($admin_message)): ?>
               <?php foreach($admin_message as $message) : ?>
                          <?php //var_dump($message);?>
            <marquee ><span><?php echo $message->message ; ?></span></marquee>
                <?php endforeach;?>
      <?php endif;?>
  </div>
     <div class="row header-top">
                 <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/icons/logo.png" alt="" class="logo"></a>

                 <?php //print_r( $admin_message); 
                 //echo $admin_message->message ;

                 // foreach ($admin_message as $message) {
                 //   echo $message->message ; 
                 // }
                 // if(empty($admin_message)){echo 'carieliao ';}
                 // if(!empty($admin_message)){echo 'savseao';}
                 ?>
                 
            <div class="accaunt-panel pull-right">
                   <a  href="<?php echo base_url('profile/show/').$this->session->user_id; ?>">
                   <?php if(empty( $user_mini_info->avatar)) : ?>
                     <img id="user-menu-avatar" src="<?php echo base_url();?>assets/icons/biguser.png" alt="">
                   <?php else : ?>
                      <img id="user-menu-avatar" src="<?php echo base_url('uploads/avatars/').$user_mini_info->avatar;?>" alt="">
                    <?php endif; ?>
                     <span class="text-username"><?php 
                     if(is_object($user_mini_info)){
                       echo $user_mini_info->username;
                     }
                     

                     ?> </span>
                   </a>
                    <?php if(!empty($chat_notiesf)) : ?>
                    <span class="badge message-notie-icon">
                      <?php echo $chat_notiesf; ?>
                    </span>
                  <?php endif;?>
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle login-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                          <!-- <span class="caret"></span> -->
                          </button>
                          <ul id="accaunt-menu" class="dropdown-menu dropdown-menu-right">
                            <li><a href="<?php echo base_url();?>Chat"><?php echo $this->lang->line('text_chat'); ?></a></li>
                            <li><a href="<?php echo base_url();?>Accaunt/followers"><?php echo $this->lang->line('text_my_followers');?></a></li>
                            <li><a href="<?php echo base_url();?>Accaunt/statistic"><?php echo $this->lang->line('text_my_forecast');?> </a></li>
                            <li><a href="<?php echo base_url();?>Accaunt/edit"><?php echo $this->lang->line('text_edit_accaunt');?> </a></li>
                          </ul>
                        </div>
                         <a href="<?php echo base_url();?>Authentication/logout" class="btn btn-logout"><?php echo $this->lang->line('text_logout');?></a>
                 </div>
       </div>          

  <nav id="mynav" class="navbar navbar-default">
        <div class="container-fluid">
<div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
           </button>
 </div>
           
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            

          <ul id="topMenu" class="nav navbar-nav top-menu">
            <li>
              <a href="<?php echo base_url();?>"><?php echo $this->lang->line('text_home');?></a>
            </li>
            <li>
             <a href="<?php echo base_url();?>users"><?php echo $this->lang->line('text_typsters');?> <span class="sr-only"></span></a>
            </li>
            <li>
              <a href="#"><?php echo $this->lang->line('text_gifts');?></a>
            </li>
            <li>
              <a href="#"><?php echo $this->lang->line('text_about');?></a>
            </li>
            <li>
              <a href="#"><?php echo $this->lang->line('text_contact');?> <span class="sr-only"></span></a>
            </li>
            <li>
              <a href="#"><?php echo $this->lang->line('text_instruction');?></a>
            </li>
          </ul>
            <div class="navbar-form navbar-right">
              
                <button  onclick="document.location.href='<?php echo base_url();?>Forecast';" id="registr_btn" type="button" class="btn btn-primary"><?php echo $this->lang->line('text_forecast');?></button>

          <select id="language" class="form-control" onchange="javascript:window.location.href='<?php echo base_url();?>Language/change/'+this.value;">
              <option value="english" <?php if($this->session->userdata('language') == 'english') echo 'selected="selected"'; ?>><?php echo $this->lang->line('text_english');?></option>
              <option value="georgian" <?php if($this->session->userdata('language') == 'georgian') echo 'selected="selected"'; ?>><?php echo $this->lang->line('text_georgian');?></option>
          </select>
            </div>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
<script src="<?php echo base_url();?>assets/js/typersi.js"></script>
