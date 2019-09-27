$(document).ready(function(){

$("#send_message_ajax").click(function(e) { 
 
    var url = $("#chat_form").attr('action');
    var userid, username, avatar, content, message;
    message = $('#message').val();

    if($('#message').val().length > 500 ) {  return; }

    $.ajax({
           type: "POST",
           url: url,
           data: $("#chat_form").serialize(), // serializes the form's elements.
           success: function(data)
           {
                var jsonResult = jQuery.parseJSON(data);

                if(jsonResult.is_blocked == 0){
                  alert(jsonResult.message);
                   $('#message').val('');
                    return;
                } 

               $('#message').val('');
               userid = $('#user_data').attr('data-userid');
               username = $('#user_data').attr('data-username');
               avatar = $('#user_data').attr('data-avatar');

               content =  '<div class="message">';
               content += ' <span class="chat-username"><strong class="primary-font">';
               content +=  username;
               content += '</strong></span>';
               content += '<p>'+message+'</p>';
               content += '</div>';
                $('#chat').append(content);
           }
         });

    // e.preventDefault();
  });


  $('.chat-nonverstation-nikname').click(function() {

        var url = $('input[name="ajax_url"]').val()+'/get_messages';

      var userId = $(this).attr('data-user-id');
      $('.convrs-'+userId).removeClass('active unreader');
      $('.msgConu-'+userId).remove();

       $('.glyphicon-refresh-animate').css('display:block');
   
      $.ajax({
             type: "POST",
             url: url,
             data: { userid: userId }, 
             beforeSend: function(){
               $('.glyphicon-refresh-animate').css('display','block');
                $('input[name="user_id"]').val(userId);
             },
             success: function(data)
             {

                 $('#chat').remove();
                 $('.msgs-content').append(data);

                  
                  var height = 0;
                  $('.messages .message').each(function(i, value){
                    height += parseInt($(this).height());
                  });
                  height += '';
                  $('.messages').animate({scrollTop: height});

             },
             complete: function(){
                $('.glyphicon-refresh-animate').css('display','none');
             }

      });

  });

});
