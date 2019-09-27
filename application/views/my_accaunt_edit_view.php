<div class="container">
    <h1>Edit Profile</h1>
  	<hr>
	<div class="row">
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <?php if(isset($condition) && $condition == true) : ?>
       <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a>
          <i class="fa fa-coffee"></i>
             <?php echo $this->lang->line('text_success_updated'); ?>
        </div>
      <?php elseif(isset($condition) && $condition == false) :?>
        <div class="alert alert-danger alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a>
          <i class="fa fa-coffee"></i>
        <?php echo $this->lang->line('text_error'); ?>
        </div>
      <?php endif;?>
        <h3>Personal info</h3>
        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('Accaunt/edit');?>">
           
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <?php echo form_error('first_name'); ?>
              <input class="form-control" type="text"  maxlength="50" value="<?php echo !empty($profile[0]['name']) ? $profile[0]['name'] :'';?>" name="first_name">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <?php echo form_error('last_name'); ?>
              <input class="form-control" type="text"  maxlength="50" value="<?php echo !empty($profile[0]['full_name']) ? $profile[0]['full_name'] :'';?>" name="last_name">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">phone:</label>
            <div class="col-lg-8">
              <?php echo form_error('phone'); ?>
              <input class="form-control" type="text" maxlength="30" value="<?php echo !empty($profile[0]['phone']) ? $profile[0]['phone'] :'';?>" name="phone">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">address:</label>
            <div class="col-lg-8">
              <?php echo form_error('address'); ?>
              <input class="form-control"  maxlength="30" type="text" value="<?php echo !empty($profile[0]['address']) ? $profile[0]['address'] :'';?>" name="address">
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">birthday:</label>
            <div class="col-lg-8">
              <?php echo form_error('birthday'); ?>
              <input class="form-control" type="date" value="<?php echo !empty($profile[0]['birthday']) ? $profile[0]['birthday'] :'';?>" name="birthday">
            </div>
          </div>

 



          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <?php echo form_error('email'); ?>
              <input class="form-control" type="text" placeholder="<?php echo !empty($profile[0]['email']) ? $profile[0]['email'] :'';?>" maxlength="30" value="" name="email">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <?php echo form_error('password'); ?>
              <input class="form-control" type="password" value="" name="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
              <?php echo form_error('retypassword'); ?>
              <input class="form-control" type="password" value="" name="retypassword">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">security code below:</label>
            <div class="col-md-8">
              <?php echo form_error('captcha'); ?>
              <input class="form-control" maxlength="4" type="text" value="" name="captcha" required>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <p id="captcha_img"><?php echo $captcha; ?></p>
              <a href="#" id="security-code" class="glyphicon glyphicon-refresh" aria-hidden="true"> refresh code</a>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
      </div>
      <!-- right column -->
      <div class="col-md-3">
        <div class="text-center">
          <img width="200" height="200" src="<?php echo base_url().'uploads/icons/100.png';?>"  class="avatar img-circle" alt="avatar">
        <h6>choos different icon...</h6>
          <form class="" enctype="multipart/form-data"  action="" method="post">
                <p>
                  <button name="button" class="btn btn-primary">choose icon</button>
                </p>
          </form>

        </div>
      </div>
  </div>
</div>
<hr>
<script type="text/javascript">
$( "#security-code" ).click(function(e){
    e.preventDefault();
     var url = $('.base_url').attr('data-base-url');

    // generate new captcha code
    var base_url = $('input[name="base_url"]').val();
    console.log();
    return;
    $.post( url+"Authentication/generate_captcha")
    .done(function( data ) {
        $( "#captcha_img" ).children('img').remove();
        $( "#captcha_img" ).prepend(data);
    });
});
</script>
