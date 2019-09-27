<div class="col-md-7 col-sm-12">
      <h1 class="sport-titles-widtout-bg"><?php echo sport_name_convrt_helper($sport_id);?></h1>
 <?php if(!empty($leagues)) : ?>
      <div class="list-group sport-leagues-list">
         <?php foreach ($leagues as $league) : ?>
            <?php if($league['count_matchs'] == 0 || $league['turn'] == 1){ continue;} ?>
            <a href="<?=base_url();?>Forecast/league/<?php echo $sport_id.'/'.$league['leagues_id'];?>" class="list-group-item"><?php echo $league['league_name'];?><span class="badge"><?php echo $this->lang->line('text_matches_today').' - '.$league['count_matchs'];?></span></a>
               <?php endforeach; ?>
      </div>
       <?php else: ?>
              <p><?php //echo $this->lang->line('text_league_are_empty');?></p>
      <?php endif; ?>

</div>
