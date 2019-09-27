
  <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-body">
         <form action="<?php echo base_url('panel/leagues/sport/').$sport_id;?>" method="POST">
          <div class="list-group">
          <p>მონიშნულები გაითიშება და მომხმარებელი ვერ ნახავს</p>
         <p> <button type="submit" class="btn btn-default">block selected leagues</button>
   
</p>
         
          <br>
            <?php if(!empty($leagues)) : ?>
                <?php foreach ($leagues as $league) : ?>
                  <li class="list-group-item"><a href="<?php echo base_url('panel/leagues/league/').$league['xml_league_id'];?>"><?php echo $league['league_name'];?></a>
                  <input style="cursor: pointer;" class="pull-right block-leagues" type="checkbox" name="league[]" data-leagueId="<?php echo $league['xml_league_id'];?>" value="<?php echo $league['xml_league_id'].'|'.$league['turn'];?>"
                    <?php if($league['turn'] == 1){ echo 'checked="checked"';}?>
                  ></li>
                <?php endforeach; ?>
            <?php else: ?>
              <p>is empty</p>
            <?php endif; ?>
             </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">

  $('.block-leagues').click(function(e) {
 

    var attr = $(this).attr('checked');
    var leaguesid = $(this).attr('data-leagueId');

if (typeof attr !== typeof undefined && attr !== false) {
  console.log('has');

    $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>panel/Ajax_Leagues/unblock_leagues",
            data:{ 'leaguesid': leaguesid },
            success: function(data){

              // console.log(data);
            }
        });
}

});
</script>
