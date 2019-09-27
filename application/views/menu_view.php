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

              <div class="row header-top">
                  <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/icons/logo.png" alt="" class="logo"></a>
               
                 <form class="form-inline pull-right login-form " id="user_login_form"  action="<?php echo base_url();?>Authentication/login" method="post">
                          <div class="form-group">
                            <a href="#" data-toggle="modal" data-target="#modal-frgtpass"><?php echo $this->lang->line('text_forgot_password');?></a>
                          </div>
                          <div class="form-group">
                             <input class="form-control" maxlength="30" name="email" type="text" placeholder="<?php echo $this->lang->line('text_email');?>" required>
                          </div>
                          <div class="form-group">
                             <input class="form-control" maxlength="20" name="password"  type="password" placeholder="<?php echo $this->lang->line('text_password');?>" required>
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
               <h4 class="modal-title"><?php echo $this->lang->line('text_registration'); ?></h4>
             </div>
              <form id="user_registr_form" action="<?php echo base_url();?>Authentication/registration" method="post">
              <div class="modal-body mymodals">
                  <div class="form-group">
                     <input id="username" maxlength="20" name="username" class="form-control"  type="text" placeholder="<?php echo $this->lang->line('text_username');?>" required>
                  </div>
                
                  <div class="form-group">
                     <input id="email" min="5" maxlength="30" class="form-control" name="email" type="email" placeholder="<?php echo $this->lang->line('text_email');?>"  required>
                  </div>
                  <div class="form-group">
                     <input id="password" min="3" maxlength="20" class="form-control" name="password" type="password" placeholder="<?php echo $this->lang->line('text_password');?>" required>
                  </div>
                  <div class="form-group">
                     <input id="retrypassword" maxlength="20" class="form-control" name="retypassword" type="password" placeholder="<?php echo $this->lang->line('text_retrypassword');?>" required>
                  </div>
                  <div class="form-group">
                     <input id="" maxlength="20" class="form-control" name="name" type="text" placeholder="<?php echo $this->lang->line('text_name');?>" required>
                  </div>
                  <div class="form-group">
                     <input id="" maxlength="20" class="form-control" name="fullname" type="text" placeholder="<?php echo $this->lang->line('text_fullname');?>" required>
                  </div>
                  <div class="form-group">
                    <select style="color: #a7a7a7 !important;" id="gender" class="form-control" name="gender">
                        <option value="male" selected="selected"><?php echo $this->lang->line('text_male');?></option>
                        <option value="fmale"><?php echo $this->lang->line('text_fmale');?></option>
                    </select>                  
                  </div>  
             
                  <div class="form-group">
                    <select class="birtday" name="year">
                        <option selected disabled><?php echo $this->lang->line('text_year');?></option>
                        <?php for($i = 1960 ; $i < date("Y") ; $i++ ) : ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                      <?php endfor;?>
                    </select> 
                    <select  class="birtday" name="month">
                          <option selected disabled><?php echo $this->lang->line('text_month');?></option>
                        <?php for($i = 1 ; $i <= 12 ; $i++ ) : ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                      <?php endfor;?>
                    </select>
                     <select  class="birtday" name="day">
                           <option selected disabled><?php echo $this->lang->line('text_day');?></option>
                        <?php for($i = 1 ; $i <= 31 ; $i++ ) : ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                      <?php endfor;?>                    </select>                  
                  </div>

                  <div id="captcha_form" class="form-group">
                      <input id="captcha" maxlength="4" class="form-control" name="captcha" type="text" placeholder="<?php echo $this->lang->line('text_security_code');?>" required>
                       <div id="captcha_registr"></div>
                       <a href="#" id="refresh-code" class="glyphicon glyphicon-refresh" aria-hidden="true"></a>
                  </div>
                    <div class="form-group">
                      <label class="iagree">
                        <input type="checkbox" required><span><?php echo $this->lang->line('text_iagry');?></span>
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
      <!-- start forgot password modal -->
         <div id="modal-frgtpass" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
              <h3 class="modal-title"><?php echo $this->lang->line('text_pass_reset');?></h3>
                <form id="forget_pass_form" action="<?php echo base_url();?>Authentication/password_reset" method="post">
                <div class="modal-body mymodals">
                    <div class="form-group">
                       <input id="email" min="5" maxlength="30" class="form-control" name="email" type="email" placeholder="<?php echo $this->lang->line('text_email');?>"  required>
                    </div>
                    <div class="form-group">
                    <button class="orange-btn"><?php echo $this->lang->line('text_reset');?></button>
                    </div>
                 </div>
                </form>
            </div>
          </div>
        </div>
      <!-- end forgot modal -->
   
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
                          <button id="registr_btn" type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modal-registr"><?php echo $this->lang->line('text_registr');?></button>
          <select id="language" class="form-control" onchange="javascript:window.location.href='<?php echo base_url();?>Language/change/'+this.value;">
              <option value="english" <?php if($this->session->userdata('language') == 'english') echo 'selected="selected"'; ?>><?php echo $this->lang->line('text_english');?></option>
              <option value="georgian" <?php if($this->session->userdata('language') == 'georgian') echo 'selected="selected"'; ?>><?php echo $this->lang->line('text_georgian');?></option>
          </select>
            </div>
         </div><!-- /.navbar-collapse -->
        </div>
      </nav>

<script src="<?php echo base_url();?>assets/js/typersi.js"></script>            