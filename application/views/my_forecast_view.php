
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<table id="matches" class="table table-bordered">
				<tr>
					<th><?php echo $this->lang->line('match_name');?></th>
					<th><?php echo $this->lang->line('pick');?></th>
					<th><?php echo $this->lang->line('odd');?></th>
					<th><?php echo $this->lang->line('forecast_date');?></th>
					<th><?php echo $this->lang->line('result');?></th>
				</tr>
        <?php
        foreach ($football_matches as $match) {

           ?>
              <tr data-id="<?php echo $match['xml_id'];?>" <?php if($match['is_winner']){echo 'class="win_row"';}?>>
              <td><?php echo $match['match_name'];?></td>
              <td><?php echo odd_type_converter($match['odd_type']);?></td>
              <td><?php echo $match['odd_value'];?></td>
              <td><?php echo date("F j, g:i a",strtotime($match['add_date']));?></td>
              <td><?php echo $match['result'];?></td>
            </tr>
        <?php  }?>
        </table>
      </div>
      <div class="col-md-4">

      </div>
    </div>
  </div>
