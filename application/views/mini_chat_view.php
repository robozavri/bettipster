  <style type="text/css">

    .shout_box {
    	background: #7fd869;
    	width: 260px;
    	overflow: hidden;
    	position: fixed;
    	bottom: 0;
    	right: 20%;
    	z-index:9;
      display: none;
    }
    .shout_box .header .close_btn {
    	background: url(<?php echo base_url();?>uploads/icons/close_btn.png) no-repeat 0px 0px;
    	float: right;
    	width: 15px;
    	height: 15px;
    }
    .shout_box .header .close_btn:hover {
    	background: url(<?php echo base_url();?>tipster/uploads/icons/close_btn.png) no-repeat 0px -16px;
    }

    .shout_box .header .open_btn {
    	background: url(<?php echo base_url();?>uploads/icons/close_btn.png) no-repeat 0px -32px;
    	float: right;
    	width: 15px;
    	height: 15px;
    }
    .shout_box .header .open_btn:hover {
    	background: url(<?php echo base_url();?>uploads/icons/close_btn.png) no-repeat 0px -48px;
    }
    .shout_box .header{
    	padding: 15px 13px 15px 15px;
    	font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
    	font-weight: bold;
    	color:#fff;
    	/*border: 1px solid rgba(0, 39, 121, .76);*/
    	border-bottom:none;
    	cursor: pointer;
      background: -moz-linear-gradient(0deg, #eb3503 28%, #F7740A 100%) !important;/* FF3.6+ */
      background: -webkit-gradient(linear, 0deg, color-stop(28%, eb3503), color-stop(100%, F7740A));/* Chrome,Safari4+ */
      background: -webkit-linear-gradient(0deg, #eb3503 28%, #F7740A 100%) !important;/* Chrome10+,Safari5.1+ */
      background: -o-linear-gradient(0deg, #eb3503 28%, #F7740A 100%) !important;/* Opera 11.10+ */
      background: -ms-linear-gradient(0deg, #eb3503 28%, #F7740A 100%) !important;/* IE10+ */
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1301FE', endColorstr='#F4F60C', GradientType='1'); /* for IE */
      background: linear-gradient(0deg, #eb3503 28%, #F7740A 100%) !important;/* W3C */
    }
    .shout_box .header:hover{
    	background-color: #5fb7f3;
    }
    .shout_box .message_box {
    	background: #2d2f3b;
    	height: 200px;
    	overflow:auto;
    	/*border: 1px solid #3ebbf3;*/
    }
    .shout_msg{
    	margin-bottom: 10px;
    	display: block;
    	border-bottom: 1px solid #736f6f;
    	padding: 0px 5px 5px 5px;
    	font: 15px 'lucida grande', tahoma, verdana, arial, sans-serif;
    	color:#e0e0e0;
    }
    .message_box:last-child {
    	border-bottom:none;
    }
    time{
    	font: 9px 'lucida grande', tahoma, verdana, arial, sans-serif;
    	font-weight: normal;
    	float:right;
    	color: #9c9898;
        display: block;
    }
    .shout_msg .username{
    	margin-bottom: 10px;
    	margin-top: 10px;
    }
    .user_info input {
    	width: 100%;
    	height: 40px;
    	border: 1px solid #CCC;
    	border-top: none;
    	padding: 3px 0px 0px 3px;
    	font: 15px 'lucida grande', tahoma, verdana, arial, sans-serif;
    }
    .shout_msg .username{
        font-weight: bold;
        display: block;
    } 
    .shout_msg .message {
    	display: block;
    }
    </style>

    <script type="text/javascript">

    $(document).ready(function(){

    $('.start_chat').click(function(e){
          e.preventDefault();
           $('.shout_box').css('display','block');

            load_data = {'userid' : $(this).attr('data-user-id')};
            $.post('<?php echo base_url();?>Ajax_Chat/get_mini_chat_messages', load_data,  function(data){
                 	$('.message_box').html(data);
                  // console.log(data);
                 // 	var scrolltoh = $('.message_box')[0].scrollHeight;
                 // 	$('.message_box').scrollTop(scrolltoh);
            });

          //  var as = $(this).attr('data-user-id');
          //  console.log(as);
          //  alert(e.attr('data-user-id'));
    });


    	// load messages every 1000 milliseconds from server.
    	// load_data = {'fetch':1};
    	// window.setInterval(function(){
    	//  $.post('http://localhost/tipster/Ajax_Chat/get_messages', load_data,  function(data) {
    	// 	$('.message_box').html(data);
    	// 	var scrolltoh = $('.message_box')[0].scrollHeight;
    	// 	$('.message_box').scrollTop(scrolltoh);
    	//  });
    	// }, 1000);

    	//method to trigger when user hits enter key
    	$("#shout_message").keypress(function(evt) {
    		if(evt.which == 13) {
          var userID = $('.start_chat').attr('data-user-id');
    //       var d = new Date();
    // var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
    // console.log(time);
          //  console.log(userID);
                    var iusername = '<?php echo $this->session->username; ?>';
    				// var iusername = $('#shout_username').val();
    				var imessage = $('#shout_message').val();
            if(imessage.length == 0){ return; }
    				post_data = {'user_id':userID, 'message':imessage};

    				//send data to "shout.php" using jQuery $.post()
    				$.post('<?php echo base_url();?>/Ajax_Chat/send', post_data, function(data) {

                            var jsonResult = jQuery.parseJSON(data);

                            if(jsonResult.is_blocked == 0){
                              alert(jsonResult.message);
                               $('#shout_message').val('');
                                return;
                            } 
                             $('#shout_message').val('');
    					//append data into messagebox with jQuery fade effect!
             var d = new Date();
             var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
            //  console.log(time);

              var myMessage = '<div class="shout_msg">';
              myMessage += '<time>'+time+'</time>';
              myMessage += '  <span class="username">'+iusername+'</span>';
              myMessage += '  <span class="message">'+imessage+'</span>';
              myMessage += '</div>';

    					$(myMessage).hide().appendTo('.message_box').fadeIn();
    					$(data).hide().appendTo('.message_box').fadeIn();

    					//keep scrolled to bottom of chat!
    					var scrolltoh = $('.message_box')[0].scrollHeight;
    					$('.message_box').scrollTop(scrolltoh);

    					//reset value of message box
    					$('#shout_message').val('');

    				}).fail(function(err) {
    							//alert HTTP server error
    							// alert(err.statusText);
    				});
    			}
    	});

    	//toggle hide/show shout box
    	$(".close_btn").click(function (e) {
    		//get CSS display state of .toggle_chat element
    		var toggleState = $('.toggle_chat').css('display');

    		//toggle show/hide chat box
    		$('.toggle_chat').slideToggle();

    		//use toggleState var to change close/open icon image
    		if(toggleState == 'block')
    		{
    			$(".header div").attr('class', 'open_btn');
    		}else{
    			$(".header div").attr('class', 'close_btn');
    		}


    	});
    });

    </script>
    <div class="shout_box">
<div class="header">...<div class="close_btn">&nbsp;</div></div>
  <div class="toggle_chat">
    <div class="message_box">   
 

      </div>
    <div class="user_info">
   <input name="shout_message" id="shout_message" type="text" placeholder="Type Message Hit Enter" maxlength="100" />
    </div>
    </div>
</div>