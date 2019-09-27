<link href="<?=base_url();?>assets/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="<?=base_url();?>assets/jquery-3.1.0.min.js"></script>
<script src="<?=base_url();?>assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <form id="user_registr" action="<?php echo base_url();?>Authentication/registration" method="post">
      <div class="modal-body">
          <div class="form-group">
             <input id="username" maxlength="20" name="username" class="form-control"  type="text" placeholder="username" required>
          </div>
          <div class="form-group">
             <input id="email" maxlength="30" class="form-control" name="email" type="email" placeholder="email"  required>
          </div>
          <div class="form-group">
             <input id="password" maxlength="20" class="form-control" name="password" type="password" placeholder="password" required>
          </div>
          <div class="form-group">
             <input id="retrypassword" maxlength="20" class="form-control" name="retypassword" type="password" placeholder="rety-password" required>
          </div>
          <div class="form-group">
              <input id="captcha" maxlength="4" class="form-control" name="captcha" type="text" placeholder="security code" required>
               <p id="captcha_registr"></p>
          </div>
       <div class="modal-footer">
           <input type="submit" name="regirtr_me" value="registration" class="btn btn-primary">
       </div>
      </form>
    </div>
  </div>
</div>



<script src="<?=base_url();?>assets/js/typersi.js"></script>
