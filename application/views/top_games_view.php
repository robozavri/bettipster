<div class="col-md-7 col-sm-12">
<?php if( !empty($top_games) ): ?>
      <table id="matches" class="table table-bordered to-forecast-table">
        <tr class="bgnone">
            <th><?php echo $this->lang->line('text_sport');?></th>
            <th><?php echo $this->lang->line('match_name');?></th>
            <th><?php echo $this->lang->line('start_date');?></th>
        </tr>
        <?php foreach($top_games as $match) : ?>
          <?php 
                      $matchStartData = strtotime($match['start_date']);
                      $now = time();

                    // თუ მატჩი უკვე დაწყებულია ან დამთავრებულია
                      if($matchStartData < $now){
                          continue;
                      }
          ?>
          <tr data-id="<?php echo $match['xml_id'];?>" data-league-id="<?php echo $match['leagues_id'];?>" class="match" data-sport-id="<?php echo sport_inner_code_convert_helper($match['kind_sport_id']);?>">
            <td><?php echo kind_sport_cinverter_helper($match['kind_sport_id']);?></td>
            <td><?php echo $match['match_name'];?></td>
            <td><?php echo date("j.n.Y",strtotime($match['start_date']));?></td>
          </tr>
        <?php endforeach;?>
          </table>

<?php endif; ?>
          <div class="ad-horizontal">
             <span style="  margin-top: 5%; display: inline-block; font-size: 26px; color: #4d4c5c; font-weight: bold;">770 X 200</span>
          </div>
       
</div>
<script type="text/javascript">
  $('.match').click(function(e){
     window.location.href = '<?php echo base_url();?>Forecast/league/'+$(this).attr('data-sport-id')+'/'+$(this).attr('data-league-id');
  });
</script>