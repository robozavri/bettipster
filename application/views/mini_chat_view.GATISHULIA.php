<style type="text/css">
<!--
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
	background: url(http://localhost/tipster/uploads/icons/close_btn.png) no-repeat 0px 0px;
	float: right;
	width: 15px;
	height: 15px;
}
.shout_box .header .close_btn:hover {
	background: url(http://localhost/tipster/uploads/icons/close_btn.png) no-repeat 0px -16px;
}

.shout_box .header .open_btn {
	background: url(http://localhost/tipster/uploads/icons/close_btn.png) no-repeat 0px -32px;
	float: right;
	width: 15px;
	height: 15px;
}
.shout_box .header .open_btn:hover {
	background: url(http://localhost/tipster/uploads/icons/close_btn.png) no-repeat 0px -48px;
}
.shout_box .header{
	padding: 5px 3px 5px 5px;
	font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
	font-weight: bold;
	color:#fff;
	border: 1px solid rgba(0, 39, 121, .76);
	border-bottom:none;
	cursor: pointer;
}
.shout_box .header:hover{
	background-color: #5fb7f3;
}
.shout_box .message_box {
	background: #FFFFFF;
	height: 200px;
	overflow:auto;
	border: 1px solid #CCC;
}
.shout_msg{
	margin-bottom: 10px;
	display: block;
	border-bottom: 1px solid #F3F3F3;
	padding: 0px 5px 5px 5px;
	font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
	color:#7C7C7C;
}
.message_box:last-child {
	border-bottom:none;
}
time{
	font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
	font-weight: normal;
	float:right;
	color: #D5D5D5;
}
.shout_msg .username{
	margin-bottom: 10px;
	margin-top: 10px;
}
.user_info input {
	width: 100%;
	height: 25px;
	border: 1px solid #CCC;
	border-top: none;
	padding: 3px 0px 0px 3px;
	font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
}
.shout_msg .username{
	font-weight: bold;
	display: block;
}
-->
</style>

<script type="text/javascript">

$(document).ready(function(){

$('.start_chat').click(function(e){
      e.preventDefault();
       $('.shout_box').css('display','block');

        load_data = {'userid' : $(this).attr('data-user-id')};
        $.post('http://localhost/tipster/Ajax_Chat/get_mini_chat_messages', load_data,  function(data){
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
			// 	var iusername = $('#shout_username').val();
				var imessage = $('#shout_message').val();
        if(imessage.length == 0){ return; }
				post_data = {'user_id':userID, 'message':imessage};

				//send data to "shout.php" using jQuery $.post()
				$.post('http://localhost/tipster/Ajax_Chat/send', post_data, function(data) {

					//append data into messagebox with jQuery fade effect!
         var d = new Date();
         var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
        //  console.log(time);

          var myMessage = '<div class="shout_msg">';
          myMessage += '<time>'+time+'</time>';
          myMessage += '  <span class="username">'+'nikoloza'+'</span>';
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
</head>

<body>
<div class="shout_box">
<div class="header">here will recepient username <div class="close_btn">&nbsp;</div></div>
  <div class="toggle_chat">
  <div class="message_box">
        <!-- <div class="shout_msg">
          <time>07:06 AM Nov 18</time>
          <span class="username">niko</span>
          <span class="message">hello</span>
        </div> -->
  </div>
    <div class="user_info">
   <input name="shout_message" id="shout_message" type="text" placeholder="Type Message Hit Enter" maxlength="100" />
    </div>
    </div>
</div>
