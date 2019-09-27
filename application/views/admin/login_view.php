<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link href="<?php echo base_url();?>assets/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="<?php echo base_url();?>assets/jquery-3.1.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <title>Signin Template for Bootstrap</title>
  </head>
  <body>
    <style media="screen">
    body {
padding-top: 40px;
padding-bottom: 40px;
background-color: #eee;
}

.form-signin {
max-width: 330px;
padding: 15px;
margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
margin-bottom: 10px;
}
.form-signin .checkbox {
font-weight: normal;
}
.form-signin .form-control {
position: relative;
height: auto;
-webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
        box-sizing: border-box;
padding: 10px;
font-size: 16px;
}
.form-signin .form-control:focus {
z-index: 2;
}
.form-signin input[type="email"] {
margin-bottom: -1px;
border-bottom-right-radius: 0;
border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
margin-bottom: 10px;
border-top-left-radius: 0;
border-top-right-radius: 0;
}
    </style>
    <div class="container">
      <form class="form-signin" action="<?php echo base_url('panel/Login')?>" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
          <p>
        <label for="inputEmail" class="sr-only">Email address</label>
        <?php echo form_error('email'); ?>
        <input type="email" value="nika@mail.com" min="5" maxlength="30"  id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
            </p>
        <p>

        <label for="inputPassword" class="sr-only">Password</label>
        <?php echo form_error('password'); ?>
        <input type="password" value="777" min="3" maxlength="20" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      </p>
      <div class="checkbox">
          <label>
            <input type="checkbox" name="remember" value="1"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div> <!-- /container -->
  </body>
</html>
