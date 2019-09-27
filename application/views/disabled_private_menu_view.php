<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="<?php echo base_url();?>assets/jquery-3.1.0.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

     <div class="row header-top">
                 <img src="<?php echo base_url();?>assets/icons/logo.png" alt="" class="logo">
                 <?php if(!$this->session->userdata('logged_in')) : ?>

                 <form class="form-inline pull-right login-form " id="user_login_form"  action="<?php echo base_url();?>Authentication/login" method="post">
                          <div class="form-group">
                            <a href="#">დაგავიწყდათ პაროლი ?</a>
                          </div>
                          <div class="form-group">
                             <input class="form-control" maxlength="30" name="email" type="text" placeholder="email" required>
                          </div>
                          <div class="form-group">
                             <input class="form-control" maxlength="20" name="password"  type="password" placeholder="password" required>
                          </div>
                        <div class="form-group">
                            <button id="login-btn" type="submit" class="btn btn-primary"><?php echo $this->lang->line('text_login'); ?></button>
                        </div>
                  </form>
                    <!-- registration modal -->
      <div id="modal-registr" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">რეგისტრაცია</h4>
             </div>
              <form id="user_registr_form" action="<?php echo base_url();?>Authentication/registration" method="post">
              <div class="modal-body mymodals">
                  <div class="form-group">
                     <input id="username" maxlength="20" name="username" class="form-control"  type="text" placeholder="მომხმარებელი username" required>
                  </div>
                  <p class="warning-data">მომხმარებლის სახელი უნდა იყოს მაქსიმუმ 20 სიმბოლო</p>
                  <div class="form-group">
                     <input id="email" min="5" maxlength="30" class="form-control" name="email" type="email" placeholder="ელ ფოსტა"  required>
                  </div>
                  <div class="form-group">
                     <input id="password" min="3" maxlength="20" class="form-control" name="password" type="password" placeholder="პაროლი" required>
                  </div>
                  <div class="form-group">
                     <input id="retrypassword" maxlength="20" class="form-control" name="retypassword" type="password" placeholder="გაიმეორეთ პაროლი" required>
                  </div>
                  <div class="form-group">
                     <input id="" maxlength="20" class="form-control" name="name" type="text" placeholder="სახელი" required>
                  </div>
                  <div class="form-group">
                     <input id="" maxlength="20" class="form-control" name="fullname" type="text" placeholder="გვარი" required>
                  </div>
                  <div class="form-group">
                     <input id="" maxlength="20" class="form-control" name="date" type="date" placeholder="დაბადების თარიღი" required>
                  </div>
                  <div class="form-group">
                    <select id="gender" class="form-control" name="gender">
                        <option value="male" selected="selected">მამრობითი</option>
                        <option value="fmale">მდედრობითი</option>
                    </select>                  </div>
                  <div class="form-group">
                      <input id="captcha" maxlength="4" class="form-control" name="captcha" type="text" placeholder="ქვემოთ მოცემული კოდი" required>
                       <p id="captcha_registr"></p>
                       <a href="" id="refresh-code" class="glyphicon glyphicon-refresh" aria-hidden="true"><?php echo $this->lang->line('text_refresh_code'); ?></a>
                  </div>
                    <div class="form-group">
                      <label class="iagree">
                        <input type="checkbox"><span> ვეთანხმები საიტის წესებს</span>
                      </label>
                    </div>

               <div class="modal-footer">
                 <button id="btn-registr" type="button" class="btn btn-primary" name="regirtr_me"><?php echo $this->lang->line('text_registration'); ?></button>
               </div>
              </form>
            </div>
          </div>
        </div>
      </div>

       <!-- end registration modal -->
       <?php else: ?>
            <div class="accaunt-panel pull-right">
                   <a href="<?php echo base_url('profile/show/').$this->session->user_id; ?>">
                     <img src="<?php echo base_url();?>assets/icons/user.png" alt="">
                     <span class="text-username"><?php echo $this->session->username; ?> </span>
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
                         <a type="button" href="<?php echo base_url();?>Authentication/logout" class="btn btn-default login-btn"><?php echo $this->lang->line('text_logout');?></a>
                 </div>
 <?php endif; ?>

  <nav id="mynav" class="navbar navbar-default">
        <div class="container-fluid">
          <ul id="topMenu" class="nav navbar-nav top-menu">
            <li>
              <a href="<?php echo base_url();?>"><?php echo $this->lang->line('text_home');?></a>
            </li>
            <li>
             <a href="<?php echo base_url();?>users"><?php echo $this->lang->line('text_typsters');?> <span class="sr-only"></span></a>
            </li>
            <li>
              <a href="#">პრიზები</a>
            </li>
            <li>
              <a href="#">ჩვენს შესახებ</a>
            </li>
            <li>
              <a href="#"><?php echo $this->lang->line('text_contact');?> <span class="sr-only"></span></a>
            </li>
            <li>
              <a href="#">ინსტრუქცია</a>
            </li>
          </ul>
            <div class="navbar-form navbar-right">
              
                <button  onclick="document.location.href='<?php echo base_url();?>Forecast';" id="registr_btn" type="button" class="btn btn-primary"><?php echo $this->lang->line('text_forecast');?></button>

          <select id="language" class="form-control" onchange="javascript:window.location.href='<?php echo base_url();?>Language/change/'+this.value;">
              <option value="english" <?php if($this->session->userdata('language') == 'english') echo 'selected="selected"'; ?>>English</option>
              <option value="georgian" <?php if($this->session->userdata('language') == 'georgian') echo 'selected="selected"'; ?>>georgian</option>
          </select>
            </div>

        </div>
      </nav>
<script src="<?php echo base_url();?>assets/js/typersi.js"></script>
