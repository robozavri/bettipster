  <div class="col-md-10 col-sm-12">
    <div class="row accaunt-edit-area">
          
      <!-- Nav tabs -->
       <ul class="nav nav-tabs" role="tablist">
         <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">რედაქტირება</a></li>
         <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">პაროლის შეცვლა</a></li> 
         <li role="presentation"><a href="#email" aria-controls="profile" role="tab" data-toggle="tab">ელ ფოსტის შეცვლა</a></li>
      </ul>

       <!-- Tab panes -->
       <div class="tab-content">
         <div role="tabpanel" class="tab-pane active" id="home" style="padding-top:10px;">    <div class="col-md-4">
               <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('Accaunt/edit');?>">
                <input class="form-control" type="hidden" name="base_url" value="<?php echo base_url();?>">

          <!-- <p class="warning-data">მომხმარებლის სახელი უნდა იყოს მაქსიმუმ 20 სიმბოლო</p> -->
             
          <div class="form-group">
              <?php echo form_error('phone','<p class="warning-data">', '</p>'); ?>
              <input class="form-control" type="text" maxlength="30" value="<?php echo !empty($profile[0]['phone']) ? $profile[0]['phone'] :'';?>" name="phone" placeholder="ტელეფონი">
          </div>
                
          <div class="form-group">
              <?php echo form_error('first_name','<p class="warning-data">', '</p>'); ?>
              <input class="form-control" type="text"  maxlength="50" value="<?php echo !empty($profile[0]['name']) ? $profile[0]['name'] :'';?>" name="first_name" placeholder="სახელი">
          </div>

            <div class="form-group">
              <?php echo form_error('last_name','<p class="warning-data">', '</p>'); ?>
              <input class="form-control" type="text"  maxlength="50" value="<?php echo !empty($profile[0]['full_name']) ? $profile[0]['full_name'] :'';?>" name="last_name" placeholder="გვარი">
            </div>

          <div class="form-group">
              <?php echo form_error('birthday','<p class="warning-data">', '</p>'); ?>
              <input class="form-control" type="date" value="<?php echo !empty($profile[0]['birthday']) ? $profile[0]['birthday'] :'';?>" name="birthday" placeholder="დაბადების თარიღი">
          </div>
                   
             <div class="form-group">
              <?php echo form_error('address','<p class="warning-data">', '</p>'); ?>
              <input class="form-control"  maxlength="30" type="text" value="<?php echo !empty($profile[0]['address']) ? $profile[0]['address'] :'';?>" name="address" placeholder="მისამართი">
         </div>

          <div class="form-group">
              <?php echo form_error('captcha','<p class="warning-data">', '</p>'); ?>
              <input class="form-control" maxlength="4" type="text" value="" name="captcha" required placeholder="ქვემოთ მოცემული კოდი">                
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
                 <img src="<?php echo base_url();?>fotos/avatars/1 (4).png" alt="">
                 <img class="selected-avatar" src="<?php echo base_url();?>fotos/avatars/1 (5).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (6).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (7).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (8).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (9).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (10).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (11).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (12).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (13).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (14).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (15).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (16).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (17).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (18).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (19).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (20).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (21).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (22).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (23).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (24).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (25).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (26).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (27).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (28).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (29).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (30).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (31).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (32).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (33).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (34).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (35).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (36).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (37).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (38).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (39).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (40).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (41).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (42).png" alt="">
                 <img src="<?php echo base_url();?>fotos/avatars/1 (43).png" alt="">
                 </div>
               </div>

             </div>
         <div role="tabpanel" class="tab-pane" id="profile" style="padding-top:10px;">
           <div class="col-md-4">
             <div class="form-group">
                <input id="password" min="3" maxlength="20" class="form-control" name="password" type="password" placeholder="პაროლი" required="">
             </div>
             <div class="form-group">
                <input id="retrypassword" maxlength="20" class="form-control" name="retypassword" type="password" placeholder="გაიმეორეთ პაროლი" required="">
             </div>
             <div class="form-group">
               <button type="submit" class="btn-blue" name="regirtr_me">რედაქტირება</button>
             </div>
           </div>
         </div> 
         <div role="tabpanel" class="tab-pane" id="email" style="padding-top:10px;">
           <div class="col-md-4">
            <div class="form-group">
              <?php echo form_error('email'); ?>
              <input class="form-control" type="text" placeholder="<?php echo !empty($profile[0]['email']) ? $profile[0]['email'] :'';?>" maxlength="30" value="" disabled>
             </div> 

             <div class="form-group">
              <?php echo form_error('email'); ?>
              <input class="form-control" type="text" placeholder="ახალი ელ ფოსტა" maxlength="30" value="" name="email">
             </div>
             <div class="form-group">
               <button type="submit" class="btn-blue" name="regirtr_me">რედაქტირება</button>
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
</script>