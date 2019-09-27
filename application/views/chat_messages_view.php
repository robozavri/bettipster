  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 conversation-container">
          <div class="conversation-box">
           <?php  if(!empty($chat['users'])) : ?>
          <?php foreach($chat['users'] as $users) : ?>
              <?php if($users['id'] == $this->session->user_id){ continue; } ?>

             <div class="conversation convrs-<?php echo $users['id'];?>
             <?php if($users['msg_count'] != 0 ) : ?>
              unreader
            <?php endif;?>
             "
               >
              <?php if(!empty($users['avatar'])) : ?>
            <img  src="<?php echo base_url().'uploads/avatars/'.$users['avatar'];?>"  class="avatar img-circle" alt="avatar">
            <?php else:?>
                <img class="avatar img-circle" src="<?php echo base_url();?>assets/icons/biguser.png" alt="">
            <?php endif;?>

                 <div class="converstation-mini-con"> 
                   <span class="chat-nonverstation-nikname" data-user-id="<?php echo $users['id'];?>"><?php echo $users['username'];?></span>
                   <span class="msg-preview"><?php echo $users['message'];?></span>

                   <small class="pull-right"><i><?php echo time_converter_helper($users['send_data']);?></i></small> 
                   
              <div class="chat-menu-icon" data-user-id="<?php echo $users['id'];?>" >
                 <span class=" glyphicon glyphicon-cog" aria-hidden="true" ></span>
                    <ul class="chat-menu user-<?php echo $users['id'];?>">
                      <li class="block-user" data-user-id="<?php echo $users['id'];?>"><?php echo $this->lang->line('text_block');?></li>
                      <li  class="spam-user" data-user-id="<?php echo $users['id'];?>"><?php echo $this->lang->line('text_mark_as_spam');?></li>
                    </ul>
               </div>
                    
                       <?php if($users['msg_count'] != 0 ) : ?>
              <small class="messageCount msgConu-<?php echo $users['id'];?> label label-info pull-right"><?php echo $users['msg_count'];?></small>
              
              <?php endif;?>
                 </div>

           </div>

             <?php endforeach; ?>
      <?php else: ?>
   
      
          <div class="chat_alert alert" role="alert"><?php echo $this->lang->line('text_have_no_msg');?></div>
      <?php return; endif; ?>
 <script type="text/javascript">
      $( ".chat-menu-icon" ).click(function() {
        var userID = $(this).attr('data-user-id');
        $( ' .user-'+userID ).toggle();
      }); 

      $( ".block-user" ).click(function() {
        var userID = $(this).attr('data-user-id');
        var url = $( ".base_url" ).attr('data-base-url')+'Ajax_Chat/block_user';
                  
               if(! confirm('Are you sure ?') ){
                  return;
               }

                $.ajax({
                       type: "POST",
                       url: url,
                       data: { userid: userID },
                       success: function(data)
                       {
                          alert(data);

                       }

                });
      });

      $( ".spam-user" ).click(function() {
        var userID = $(this).attr('data-user-id');
        var url = $( ".base_url" ).attr('data-base-url')+'Ajax_Chat/mark_as_spam';
     
               if(! confirm('Are you sure ?') ){
                  return;
               }
               
                $.ajax({
                       type: "POST",
                       url: url,
                       data: { userid: userID }, 
                       success: function(data)
                       {
                          alert(data);

                       }

                });
      });
      </script>
          <!--   <div class="conversation unreader">
                 <img src="assets/icons/user-chat-icon.png" alt="">
                 <div class="converstation-mini-con">
                   <span class="chat-nonverstation-nikname">NUGO</span>
                   <span class="msg-preview">საბეჭდი და ტიპოგრაფიული ინდუსტრიის უშინაარსო ტექსტია. იგი სტანდარტად 1500-იანი წლებიდან იქცა, როდესაც უცნობმა მბეჭდავმა ამწყობ დაზგაზე წიგნის საცდელი ეგზემპლარი დაბეჭდა. მისი ტექსტი არამარტო 5 საუკუნის მანძილზე შემორჩა, არამედ მან დღემდე, ელექტრონული ტიპოგრაფიის დრომდეც უცვლელად მოაღწია. განსაკუთრებული პოპულარობა მას 1960-იან წლებში გამოსულმა Letraset-ის ცნობილმა ტრაფარეტებმა მოუტანა, უფრო მოგვიანებით კი — Aldus PageMaker-ის ტიპის საგამომცემლო პროგრამებმ</span>
                   <small class="pull-right"><i>17:29 19:21:2017</i></small>
                
                 </div>
           </div> -->
          </div>
      
      <!-- =============================================================== -->
      <!-- member list -->
    
		</div>

        <!--=========================================================-->
        <!-- selected chat -->
        <div class="col-md-8 col-sm-12 col-xs-12 msg-content-container">
          <div class="msg-content-box">
           <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
             <style media="screen">
            .glyphicon-refresh-animate {
              -animation: spin .7s infinite linear;
              -webkit-animation: spin2 .7s infinite linear;
              font-size: 20px;
              display: none;
              position: absolute;
              margin-left: 50%;
              margin-top: 21%;
              z-index: 9999999;
            }

            @-webkit-keyframes spin2 {
              from { -webkit-transform: rotate(0deg);}
              to { -webkit-transform: rotate(360deg);}
            }

            @keyframes spin {
              from { transform: scale(1) rotate(0deg);}
              to { transform: scale(1) rotate(360deg);}
            }
            </style>

             <div class="msgs-content">
              <div id="chat"  class="chat messages">
              <?php if(!empty($chat['user_messages'])) : ?>
                    <?php foreach ($chat['user_messages'] as $message) : ?>
                      <?php if($message['id'] == $this->session->user_id){$alegin = 'right hisnikname';}
                        else{$alegin = 'left mynikname';}?>

                  <div class="message">
                      <span class="chat-username pull-<?php  //echo $alegin;?>"> 
                        <strong class="primary-font">
                        <a href="<?php echo base_url('profile/show').'/'.$message['id'];?>"><?php echo $message['username'];?>
                        </a>
                        </strong>
                      </span>
                      <span class="pull-right"><i><?php echo  time_converter_helper($message['create_date']);?></i></span>
                      <p><?php echo $message['content'];?></p>
                  </div>
                  <?php endforeach;?>
                  <?php endif;?>
              </div>
            </div>
              <form id="chat_form" class="msg-form" action="<?php echo base_url('Ajax_Chat/send');?>" method="post">
                <div id="user_data" data-userid="<?php echo $this->session->user_id;?>" data-avatar="<?php  if(!empty($this->session->avatar)){  echo  base_url('uploads/avatars').'/'.$this->session->avatar; }else{ echo base_url().'uploads/icons/100.png'; }?>" data-username="<?php echo $this->session->username; ?>"></div>
                 <input type="hidden" name="user_id" value="<?php if( $message['from_user_id'] != $this->session->user_id){ echo $message['from_user_id']; }else{ echo $message['to_user_id']; }?>">
                <input type="hidden" name="ajax_url" value="<?php echo base_url('Ajax_Chat');?>">

                  <button id="send_message_ajax" type="button" name="button" class="btn-send-msg "><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
                  <textarea id="message" placeholder="შეტყობინების ტექსტი" name="message" class="msg-textarea pull-bottom" rows="8" cols="80" maxlength="500"></textarea>
              </form>
          </div>
      </div>
      <script type="text/javascript">
       var height = 0;
        $('.messages .message').each(function(i, value){
          height += parseInt($(this).height());
        });
        height += '';
        $('.messages').animate({scrollTop: height});
      </script>


 
<script src="<?php echo base_url();?>assets/js/chat.js"></script>
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
