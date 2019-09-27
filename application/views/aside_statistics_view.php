  <div class="topraiting-colom col-md-2 col-sm-12 col-xs-12">
   <?php if(!empty($raiting_100)) : ?>
    <div class="topraiting col-md-12 col-sm-4 col-xs-12">
      <h1><?php echo $this->lang->line('raiting_100');?></h1>
            <ul>
            <?php
            
            for ($i=0; $i < count($raiting_100); $i++) {  ?>
              <li>  
              <a href="<?php echo base_url('profile/show/').$raiting_100[$i]['user_id'];?>"><?php echo $raiting_100[$i]['username'];?></a>
          <span>(<?php echo $raiting_100[$i]['match_quantity'];?>)</span>
          <span>100 %</span></li>
           
            <?php  } ?>
              </ul>
        </div>
      <?php endif; ?>

       <?php if(!empty($raiting_10_to_20)) : ?>
          <div class="topraiting col-md-12 col-sm-4 col-xs-12">
            <h1><?php echo $this->lang->line('raiting_10_to_20');?></h1>
            <ul>
            <?php
            for ($i=0; $i < count($raiting_10_to_20); $i++) {  ?>
              <li> <a href="<?php echo base_url('profile/show/').$raiting_10_to_20[$i]['user_id'];?>"><?php echo $raiting_10_to_20[$i]['username'];?></a>
              <span>(<?php echo $raiting_10_to_20[$i]['match_quantity'];?>)</span>
                 <span><?php echo $raiting_10_to_20[$i]['won_percent'];?>%</span>
              </li>
            <?php  } ?>
              </ul>
          </div>
       <?php endif; ?>


           <?php if(!empty($raiting_over_20)) : ?>
           <div class="topraiting col-md-12 col-sm-4 col-xs-12">
            <h1><?php echo $this->lang->line('raiting_over_20');?></h1>
              <ul>
            <?php
            
            for ($i=0; $i < count($raiting_over_20); $i++) {  ?>

                     <li> 
                     <a href="<?php echo base_url('profile/show/').$raiting_over_20[$i]['user_id'];?>"><?php echo $raiting_over_20[$i]['username'];?></a>
          <span>(<?php echo $raiting_over_20[$i]['match_quantity'];?>)</span>
          <span><?php echo $raiting_over_20[$i]['won_percent'];?>%</span></li>
            <?php  } ?>
              </ul>
          </div>
      <?php endif; ?>
    </div>
