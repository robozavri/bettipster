<div class="container">
    <h1>Edit Profile</h1>
  	<hr>
	<div class="row">
      <!-- left column -->
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
        <h3>Personal user info edit</h3>
        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('panel/users/edit').'/'.$profile[0]['id'];?>">
 <!--
          <div class="form-group">
            <label class="col-lg-3 control-label">Block user IP</label>
            <div class="col-lg-1">
              <input class="form-control" type="checkbox"  name="is_ip_block" <?php echo $profile[0]['is_ip_block'] == 1 ? 'checked':'';?>>
            </div>
          </div>
-->
          <div class="form-group">
            <label class="col-lg-3 control-label">Block user</label>
            <div class="col-lg-1">
              <input class="form-control" type="checkbox"   name="is_block" <?php echo $profile[0]['is_block'] == 1 ? 'checked':'';?>>
            </div>
          </div>
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
            <label class="col-lg-3 control-label">Phone:</label>
            <div class="col-lg-8">
              <?php echo form_error('phone'); ?>
              <input class="form-control" type="text" maxlength="30" value="<?php echo !empty($profile[0]['phone']) ? $profile[0]['phone'] :'';?>" name="phone">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Address:</label>
            <div class="col-lg-8">
              <?php echo form_error('address'); ?>
              <input class="form-control"  maxlength="30" type="text" value="<?php echo !empty($profile[0]['address']) ? $profile[0]['address'] :'';?>" name="address">
            </div>
          </div>
            <div class="form-group">
             <label class="col-lg-3 control-label">Gender:</label>
                <div class="col-lg-8">
                    <select id="gender" class="form-control" name="gender">

                    <?php if(!empty( $profile[0]['gender'] ) ): ?>

                          <?php if($profile[0]['gender'] == 'male'): ?>
                              <option selected="selected" value="male">Male</option>
                               <option value="fmale">Fmale</option>
                          <?php else: ?>
                              <option selected="selected" value="fmale">Fmale</option>
                               <option value="male">Male</option>
                          <?php endif; ?>

                      <?php else : ?>

                              <option selected disabled >Gender</option>
                              <option value="male">Male</option>
                              <option value="fmale">Fmale</option>

                      <?php endif; ?>

                    </select>  
                </div>                
             </div> 


            <div class="form-group">
                  <label class="col-lg-3 control-label">Birthday:</label>
            <div class="col-lg-8">
                        <?php echo form_error('year','<p class="warning-data">', '</p>'); ?>
                        <?php echo form_error('month','<p class="warning-data">', '</p>'); ?>
                        <?php echo form_error('day','<p class="warning-data">', '</p>'); ?>
                    <select class="form-control" name="year">

    <?php  $date = explode('-',$profile[0]['birthday']);?>
    
    <?php if($date[0] == 0000 ): ?>

             <option selected disabled>Year</option>

            <?php for($i = 1960 ; $i < date("Y") ; $i++ ) : ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php endfor;?>

    <?php else: ?>
                   <?php for($i = 1960 ; $i < date("Y") ; $i++ ) : ?>

                            <?php if($i == $date[0]): ?>
                            <option selected="selected" value="<?php echo $date[0];?>"><?php echo $date[0];?></option> 
                           
                             <?php continue; ?>
                           <?php else: ?>
                                  <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endif;?>
                    <?php endfor;?>
    <?php endif;?>
                    </select> 


                    <select  class="form-control" name="month">
    <?php if($date[1] == 00 ): ?>
                              <option selected disabled>Month</option>

                      <?php for($i = 1 ; $i <= 12 ; $i++ ) : ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                      <?php endfor;?>

    <?php else: ?>
                      <?php for($i = 1 ; $i <= 12 ; $i++ ) : ?>

                            <?php if($i == str_replace("0","",$date[1]) ): ?>

                            <option  selected="selected" value="<?php echo $i;?>"><?php echo $i;?></option>

                              <?php continue; ?>

                           <?php else: ?>
                                  <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endif;?>
                      <?php endfor;?>
    <?php endif;?>
                    </select>


                     <select  class="form-control" name="day">
    <?php if($date[2] == 00 ): ?>
                             <option selected disabled>Day</option>

                    <?php for($i = 1 ; $i <= 31 ; $i++ ) : ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php endfor;?> 


    <?php else: ?>
                    <?php for($i = 1 ; $i <= 31 ; $i++ ) : ?>
                        <?php if($i == str_replace("0","",$date[2]) ): ?>
                             <option selected="selected" value="<?php echo $i;?>"><?php echo $i;?></option>
                         <?php else: ?>
                                  <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                         <?php endif;?>

                    <?php endfor;?> 
    <?php endif;?>
                         </select>                  
             </div>
          </div>













          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <?php echo form_error('email'); ?>
              <input class="form-control" type="text" placeholder="<?php echo !empty($profile[0]['email']) ? $profile[0]['email'] :'';?>" maxlength="30"  name="email">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Username:</label>
            <div class="col-md-8">
              <?php echo form_error('username'); ?>
              <input class="form-control" type="text" maxlength="25" placeholder="<?php echo !empty($profile[0]['username']) ? $profile[0]['username'] :'';?>" name="username">
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
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
      </div>
      <!-- right colom -->
      <div class="col-md-3">
        <div class="text-center">
          <p>
            <?php if(!empty($profile[0]['avatar'])) : ?>
            <img width="200" height="200" src="<?php echo base_url().'uploads/avatars/'.$profile[0]['avatar'];?>"  class="avatar img-circle" alt="avatar">
            <?php else:?>
            <img width="200" height="200" src="<?php echo base_url().'uploads/icons/100.png';?>"  class="avatar img-circle" alt="avatar">
          <?php endif;?>
          </p>
             <!-- <a  onclick="return confirm('Are you sure you want to delete user avatar ?');" class="btn btn-danger" href="<?php //echo base_url('panel/users/delete_user_avatar').'/'.$profile[0]['id'];?>">Delete avatar</a> -->
        </div>
      </div>
  </div>
</div>
<hr>
