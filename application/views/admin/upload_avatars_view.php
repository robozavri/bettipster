 <div class="container">
  <div class="row">
  <div class="col-md-4">
<form action="#"  enctype="multipart/form-data" method="POST">
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" min="1" max="20" multiple="true" name="file[]" id="exampleInputFile">
        <p class="help-block">ფაილების ზომა უნდა იყოს 128x128</p>
  </div>
  <button type="submit" name="load_files" value="Go class="btn btn-default">ატვირთვა</button>
</form>
</div>
<style type="text/css">
  .avatars-bar img {
    width: 80px;
    height: 80px;
  }
</style>
    <div class="col-md-8 col-sm-12">
               <div class="avatars-bar">
               <?php if(!empty($avatars)) : ?>
                <?php foreach($avatars as $avatar):?>
                 <img src="<?php echo base_url();?>uploads/avatars/<?php echo $avatar['avatar_name'];?>" alt="">
                  
                <?php endforeach;?>
                <?php endif;?>
                 </div>
               </div>
</div>
</div>