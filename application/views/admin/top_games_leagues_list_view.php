<!-- <div class="container"> -->
  <!-- <div class="row"> -->
  <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="list-group">
            <?php if(!empty($leagues)) : ?>
                <?php foreach ($leagues as $league) : ?>
                      <?php if($league['count_matchs'] == 0){ continue;} ?>
                  <a href="<?=base_url();?>panel/Top_games/league/<?php echo $sport_id.'/'.$league['leagues_id'];?>" class="list-group-item"><?php echo $league['league_name'];?><span class="badge">
   <?php echo $this->lang->line('text_matches_today').' - '.$league['count_matchs'];?></span></a>
                <?php endforeach; ?>
            <?php else: ?>
              <p>is empty</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <!-- </div> -->
<!-- </div> -->
