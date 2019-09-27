  <div class="col-md-10 col-sm-12">
    <div class="row accaunt-edit-area">
      <div class="col-md-4">
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
       <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('Accaunt/edit');?>">
                <input class="form-control" type="hidden" name="base_url" value="<?php echo base_url();?>">
             
          <div class="form-group">
              <?php echo form_error('phone','<p class="warning-data">', '</p>'); ?>
              <input class="form-control" type="text" maxlength="30" value="<?php echo !empty($profile[0]['phone']) ? $profile[0]['phone'] :'';?>" name="phone" placeholder="<?php echo $this->lang->line('text_phone');?>">
          </div>
                
          <div class="form-group">
              <?php echo form_error('first_name','<p class="warning-data">', '</p>'); ?>
              <input class="form-control" type="text"  maxlength="50" value="<?php echo !empty($profile[0]['name']) ? $profile[0]['name'] :'';?>" name="first_name" placeholder="<?php echo $this->lang->line('text_name');?>">
          </div>

            <div class="form-group">
              <?php echo form_error('last_name','<p class="warning-data">', '</p>'); ?>
              <input class="form-control" type="text"  maxlength="50" value="<?php echo !empty($profile[0]['full_name']) ? $profile[0]['full_name'] :'';?>" name="last_name" placeholder="<?php echo $this->lang->line('text_fullname');?>">
            </div>
   
              <div class="form-group">
                   <select style="color: #a7a7a7 !important;" id="gender" class="form-control" name="gender">

                    <?php if(!empty( $profile[0]['gender'] ) ): ?>

                          <?php if($profile[0]['gender'] == 'male'): ?>
                              <option selected="selected" value="male"><?php echo $this->lang->line('text_male');?></option>
                                <option value="fmale"><?php echo $this->lang->line('text_fmale');?></option>
                          <?php else: ?>
                              <option selected="selected" value="fmale"><?php echo $this->lang->line('text_fmale');?></option>
                                <option value="male"><?php echo $this->lang->line('text_male');?></option>
                          <?php endif; ?>

                      <?php else : ?>

                              <option selected disabled ><?php echo $this->lang->line('text_gender');?></option>
                              <option value="male"><?php echo $this->lang->line('text_male');?></option>
                              <option value="fmale"><?php echo $this->lang->line('text_fmale');?></option>

                      <?php endif; ?>

                    </select>                  
             </div>  

                    <div class="form-group">
                        <?php echo form_error('year','<p class="warning-data">', '</p>'); ?>
                        <?php echo form_error('month','<p class="warning-data">', '</p>'); ?>
                        <?php echo form_error('day','<p class="warning-data">', '</p>'); ?>
                    <select class="accaunt-birtday" name="year">

    <?php  $date = explode('-',$profile[0]['birthday']);?>
    
    <?php if($date[0] == 0000 ): ?>

             <option selected disabled><?php echo $this->lang->line('text_year');?></option>

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


                    <select  class="accaunt-birtday" name="month">
    <?php if($date[1] == 00 ): ?>
                              <option selected disabled><?php echo $this->lang->line('text_month');?></option>

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


                     <select  class="accaunt-birtday" name="day">
    <?php if($date[2] == 00 ): ?>
                             <option selected disabled><?php echo $this->lang->line('text_day');?></option>

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


                   
             <div class="form-group">
              <?php echo form_error('address','<p class="warning-data">', '</p>'); ?>
              <input class="form-control"  maxlength="30" type="text" value="<?php echo !empty($profile[0]['address']) ? $profile[0]['address'] :'';?>" name="address" placeholder="<?php echo $this->lang->line('text_address');?>">
         </div>
         <div class="form-group">
         <?php echo form_error('password','<p class="warning-data">', '</p>'); ?>
                <input id="password" min="3" maxlength="20" class="form-control" name="password" type="password" placeholder="<?php echo $this->lang->line('text_password');?>" >
             </div>
             <div class="form-group">
              <?php echo form_error('retypassword','<p class="warning-data">', '</p>'); ?>
                <input id="retrypassword" maxlength="20" class="form-control" name="retypassword" type="password" placeholder="<?php echo $this->lang->line('text_retrypassword');?>" >
             </div>
              <div class="form-group">
              <input class="form-control" type="text" placeholder="<?php echo !empty($profile[0]['email']) ? $profile[0]['email'] :'';?>" maxlength="30" value="" disabled>
             </div> 

          <div class="form-group">
              <?php echo form_error('captcha','<p class="warning-data">', '</p>'); ?>
              <input class="form-control" maxlength="4" type="text" value="" name="captcha" required placeholder="<?php echo $this->lang->line('text_security_code');?>">                
          </div>       
          <div class="form-group"> 
              <div id="captcha_img"><?php echo $captcha; ?></div>
                        <a href="" id="security-code" class="glyphicon glyphicon-refresh" aria-hidden="true"></a> 
           </div> 
           <div class="form-group"> 
              <button type="submit" class="btn-blue" name="regirtr_me">რედაქტირება</button>  
           </div>   
          </form>
         </div>  
             <div class="col-md-8 col-sm-12">
               <div class="avatars-bar">
                 <?php if(!empty($avatars)) : ?>
                <?php foreach($avatars as $avatar):?>
                 <img class="avatar_image" data-img-id="<?php echo $avatar['avatars_bank_id'];?>" src="<?php echo base_url();?>uploads/avatars/<?php echo $avatar['avatar_name'];?>" alt="">
                <?php endforeach;?>
                <?php endif;?>
                 </div>
          
               </div>
            </div>
        </div>
           
       </div>
  </div>
  <!-- end accaunt area  -->
</div>
<script type="text/javascript">
$( "#security-code" ).click(function(e){
    e.preventDefault();
    // generate new captcha code
    var base_url = $('input[name="base_url"]').val();
    
    $.post( base_url+"Authentication/generate_captcha")
    .done(function( data ) {
        $( "#captcha_img" ).children('img').remove();
        $( "#captcha_img" ).prepend(data);
    });
});


$( ".avatar_image" ).click(function(){ 

  if(confirm('<?php echo $this->lang->line('text_chlicked_avatar'); ?>')){


         $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>Ajax_Avatar/change",
            data:{ 'avatar_id': $(this).attr('data-img-id') },
            success: function(data){

              var jsonResult = jQuery.parseJSON(data);
              alert( jsonResult.message );
              location.reload();
            }
        });

  }

});


</script>