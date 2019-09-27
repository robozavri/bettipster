<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap panel Theme v3</title>
<link href="<?php echo base_url();?>assets/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="<?php echo base_url();?>assets/jquery-3.1.0.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url('panel/Managment');?>">Dshboard</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="<?php echo base_url();?>">site tipster</a></li>
          <li class="active"><a href="<?php echo base_url('panel/Users');?>"><?php echo $this->lang->line('users');?> <i class="glyphicon glyphicon-user"></i></a></li>
          <li><a href="<?php echo base_url('panel/Forecast');?>"><?php echo $this->lang->line('site_advice');?> <i class="glyphicon glyphicon-record"></i></a></li>
          <!-- <li>
            <a href="<?php //echo base_url('panel/Chat');?>"><?php // echo $this->lang->line('chat');?>
              <?php // var_dump($chat_notiesf); die;?>
              <?php // if(!empty($chat_notiesf)) : ?>
                <span class="label label-success cht_notify">
                  <?php // echo $chat_notiesf; ?>
                </span>
              <?php //endif;?>
            <i class="glyphicon glyphicon-comment"></i>
          </a>
        </li> -->
         
          <li><a href="<?php echo base_url('panel/Leagues');?>"><?php echo $this->lang->line('leagues');?></a></li>
          <li><a href="<?php echo base_url('panel/Managment/avatars_upload');?>"><?php echo $this->lang->line('text_avatars');?></a></li>  
          <li><a href="<?php echo base_url('panel/Top_games');?>"><?php echo $this->lang->line('top_games');?></a></li>
  <li><a href="<?php echo base_url('panel/Managment/admin_declaration');?>"><?php echo $this->lang->line('text_admin_declration');?></a></li>
   <li><a href="<?php echo base_url('panel/Average/index');?>">Averages</a></li>
        
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="navbar-form navbar-left">
            <select class="form-control" onchange="javascript:window.location.href='<?php echo base_url();?>Language/change/'+this.value;">
                <option value="english" <?php if($this->session->userdata('language') == 'english') echo 'selected="selected"'; ?>>English</option>
                <option value="georgian" <?php if($this->session->userdata('language') == 'georgian') echo 'selected="selected"'; ?>>georgian</option>
            </select>
          </li>
       <!--    <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php //echo base_url('panel/Managment/stop_testing')?>" onclick="return confirm('Are you sure you want to delete testing data in db ?');">delete testing data in db</a></li>
              <li><a href="<?php //echo base_url('panel/Managment/testing')?>" onclick="return confirm('Are you sure you want to start generate testing data ?');">start generate testing data</a></li>
              <li><a href="<?php //echo base_url('panel/Managment/delete_cookie')?>" onclick="return confirm('Are you sure you want to delete cookie and session data ?');">delete cookie and session data</a></li>
              <li><a href="<?php //echo base_url('panel/Managment/test_top_5')?>" onclick="return confirm('Are you sure you want to test top 5 tipster ?');">test top 5 tipster</a></li>
              <li><a href="<?php //echo base_url('panel/Managment/check_forecasted_matches_results')?>" onclick="return confirm('Are you sure you want to check forecasted matches results ?');">check forecasted matches results</a></li>
              <li><a href="<?php //echo base_url('panel/Managment/update_user_statistics')?>" onclick="return confirm('Are you sure you want to update users statistics ?');">update users statistic</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?php //echo base_url('panel/Managment/some')?>">some</a></li>
            </ul>
          </li> -->
          <li><a href="<?php echo base_url('panel/logout')?>"><?php echo $this->lang->line('text_logout');?></a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div class="row">
