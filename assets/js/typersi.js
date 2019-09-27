/********** login code **********/
/*
$('#login-btn').click(function(e){
  var form = $('#user_login_form');

      $.ajax({
       type: "POST",
       url: form.attr('action'),
       data: form.serialize(),
       success: function(data){

         var jsonResult = jQuery.parseJSON(data);
             if(jsonResult.status == 0){
                // addClass( "has-error" );
                alert(jsonResult.email +''+jsonResult.password);
                 console.log('statusi = 0');
             }

              if(jsonResult.status == 1){
                 console.log('statusi = 1');
                //  window.location.href = "";
                location.reload();
              }
        }
      });

});
*/
/********** registration code **********/

/** refresh secutity code **/
$( "#refresh-code" ).click(function(e){
    e.preventDefault();
            var url = $('.base_url').attr('data-base-url');

    // generate new captcha code
    $.post( url+"Authentication/generate_captcha")
    .done(function( data ) {
        $( "#captcha_registr" ).children('img').remove();
        $( "#captcha_registr" ).prepend(data);
    });
});

/** if is valid do registration**/
 $( "#btn-registr" ).click(function(){

    var forma = $( "#user_registr_form" );

        var url = $('.base_url').attr('data-base-url');
        var obj = $( "#captcha" );

           $.ajax({
             type: 'POST',
             url:  url+'Authentication/captcha',
             data: {'captcha' : obj.val() },
             success: function(data) {

                 var jsonResult = jQuery.parseJSON(data);
                 if(jsonResult.status == 0){
                       obj.parent().children('i').remove();
                       obj.parent().addClass( "has-error" );
                       obj.parent().prepend('<i>'+jsonResult.message+'</i>');
                 }

                 if(jsonResult.status == 1){
                       obj.parent().removeClass( "has-error" );
                       obj.parent().children('i').remove();
                       obj.parent().addClass( "has-success" );
                       forma.submit();
                 }

             }
           });

 });


/* for generate captcha */
 $( "#registr_btn" ).click(function() {

 var url = $('.base_url').attr('data-base-url');
      $.post( url+"Authentication/generate_captcha")
      .done(function( data ) {
          $( "#captcha_registr" ).children('img').remove();
          $( "#captcha_registr" ).prepend(data);
      });
});

 /* for chaptcha check */
//    $( "#captcha" ).blur(function(e) {
//
//   var obj = $(this);
//
//      $.post( "http://localhost/tipster/Authentication/captcha", { 'captcha' : $(this).val() })
//      .done(function( data ) {
//
//         var jsonResult = jQuery.parseJSON(data);
//         if(jsonResult.status == 0){
//               obj.parent().children('i').remove();
//               obj.parent().addClass( "has-error" );
//               obj.parent().prepend('<i>'+jsonResult.message+'</i>');
//         }
//
//         if(jsonResult.status == 1){
//               obj.parent().removeClass( "has-error" );
//               obj.parent().children('i').remove();
//               obj.parent().addClass( "has-success" );
//         }
//
//      });
//
//    });

/* for username */
   $( "#username" ).blur(function(e) {

 var url = $('.base_url').attr('data-base-url');

  var obj = $(this);

     $.post( url+"Authentication/username", { 'username' : $(this).val() })
     .done(function( data ) {

        var jsonResult = jQuery.parseJSON(data);
        if(jsonResult.status == 0){
              obj.parent().children('i').remove();
              obj.parent().addClass( "has-error" );
              obj.parent().prepend('<i>'+jsonResult.message+'</i>');
        }

        if(jsonResult.status == 1){
              obj.parent().removeClass( "has-error" );
              obj.parent().children('i').remove();
              obj.parent().addClass( "has-success" );
        }

     });

   });

/* for password */

$( "#password" ).blur(function(e) {

var obj = $(this);
 var url = $('.base_url').attr('data-base-url');

  $.post( url+"Authentication/password", { 'password' : $(this).val() })
  .done(function( data ) {

     var jsonResult = jQuery.parseJSON(data);
     if(jsonResult.status == 0){
           obj.parent().children('i').remove();
           obj.parent().addClass( "has-error" );
           obj.parent().prepend('<i>'+jsonResult.message+'</i>');
     }

     if(jsonResult.status == 1){
           obj.parent().removeClass( "has-error" );
           obj.parent().children('i').remove();
           obj.parent().addClass( "has-success" );
     }

  });

});

/* for retry password */

$( "#retrypassword" ).blur(function(e) {

  var obj = $(this);

  if($( "#password" ).val() != $( "#retrypassword" ).val()){
    obj.parent().children('i').remove();
    obj.parent().addClass( "has-error" );
    obj.parent().prepend('<i> Passwords do not match </i>');
    return;
  }

 var url = $('.base_url').attr('data-base-url');


  $.post( url+"Authentication/retypassword", { 'retypassword' : $(this).val() })
  .done(function( data ) {

     var jsonResult = jQuery.parseJSON(data);
     if(jsonResult.status == 0){

           obj.parent().children('i').remove();
           obj.parent().addClass( "has-error" );
           obj.parent().prepend('<i>'+jsonResult.message+'</i>');
     }

     if(jsonResult.status == 1){

           obj.parent().removeClass( "has-error" );
           obj.parent().children('i').remove();
           obj.parent().addClass( "has-success" );
     }

  });

});


/* for email */

$( "#email" ).blur(function(e) {

var obj = $(this);
 var url = $('.base_url').attr('data-base-url');


  $.post( url+"Authentication/email", { 'email' : $(this).val() })
  .done(function( data ) {

     var jsonResult = jQuery.parseJSON(data);
     if(jsonResult.status == 0){
           obj.parent().children('i').remove();
           obj.parent().addClass( "has-error" );
           obj.parent().prepend('<i>'+jsonResult.message+'</i>');
     }

     if(jsonResult.status == 1){
           obj.parent().removeClass( "has-error" );
           obj.parent().children('i').remove();
           obj.parent().addClass( "has-success" );
     }

  });

});
