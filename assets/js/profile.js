$(document).ready(function(){

  /* ajax follow */
  $('#btn-follow').click(function(e){
    // console.log(e);
    var clickedButton = $(this);
    // console.log($(this).attr('data-user-follow-id'));
    var UserId = $(this).attr('data-user-follow-id');
    var flUrl = 
    // console.log(e.attr('data-user-follow-id'));
    // console.log($('#followUrl').attr('data-ajxUrl'));
    //http://localhost/tipster/Ajax_follow/follow
    // alert();
    // return;
        $.ajax({
         type: "POST",
         url: $('#followUrl').attr('data-ajxUrl')+'Ajax_follow/follow',
         data: { 'user': UserId },
         success: function(data){

           var jsonResult = jQuery.parseJSON(data);
               if(jsonResult.status == 0){
                  alert(jsonResult.message);
                  //  console.log('statusi = 0');
               }

                if(jsonResult.status == 1){
                   clickedButton.remove();
                   var content = '<a id="btn-unfollow" type="button" class="favorites-link" data-user-follow-id="'+UserId+'" >'+jsonResult.btn_text+'</a>';
                   $( ".btn-follow" ).prepend(content);
                  //  console.log('statusi = 1');
                   alert(jsonResult.message);
                }
          }
        });
  });

 /* ajax unfollow */
  $('#btn-unfollow').click(function(e){
    // console.log(e);
    var clickedButton = $(this);
    // console.log($(this).attr('data-user-follow-id'));
    var UserId = $(this).attr('data-user-follow-id');
    // console.log(e.attr('data-user-follow-id'));
    // alert();
        $.ajax({
         type: "POST",
         url: $('#followUrl').attr('data-ajxUrl')+'Ajax_follow/unfollow',
         data: { 'user': UserId },
         success: function(data){
           console.log(data);
           var jsonResult = jQuery.parseJSON(data);
               if(jsonResult.status == 0){
                  alert(jsonResult.message);
                  //  console.log('statusi = 0');
               }

                if(jsonResult.status == 1){
                   clickedButton.remove();
                   var content = '<a id="btn-follow" class="favorites-link" data-user-follow-id="'+UserId+'" >'+jsonResult.btn_text+'</a>';
                   $( ".btn-follow" ).prepend(content);
                  //  console.log('statusi = 1');
                   alert(jsonResult.message);
                }
          }
        });
  });

});
