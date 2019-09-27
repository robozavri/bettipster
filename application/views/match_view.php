<link href="<?=base_url();?>assets/css/style.css" rel="stylesheet" />
<script type="text/javascript">
<?php
// პროგნოზების ლიმიტი რამდენი აქ იმის მიხედვით ჩავსვათ localStorage
switch ($bet_limit) {
	case 0: echo "localStorage.clear();";
					echo "localStorage.setItem('count', 0);";
		break;
	case 1: echo "localStorage.clear();";
					echo "localStorage.setItem('count', 1);";
		break;
	case 2: echo "localStorage.clear();";
					echo "localStorage.setItem('count', 2);";
		break;
}
// $bet_limit == true or false
$bet_limit = false;
// თუ პროგნოზების ლიმიტი ამოიწურა
if($bet_limit) : ?>
	// localStorage.clear();
	// localStorage.setItem('count', 1);
<?php else: ?>

$(document).ready(function(){

   var name = new Array();
   var countMatch, countMessage, matchID, odd, content;
	 /* შევამოწმოთ პროგნოზების ლიმიტი  */
   for (var i = 0; i <= localStorage.length - 1; i++) {
   key = localStorage.key(i);

	   if(key == 'count'){
	   		countMatch = localStorage.getItem('count');

	   		switch(countMatch){
	   			case '0': countMessage = '<?php echo $this->lang->line('text_stayed_match');?>';
	   			break;
	   			case '1': countMessage = '<?php echo $this->lang->line('text_one_stayed_match');?>';
	   			break;
	   			case '2': countMessage = '<?php echo $this->lang->line('text_after_24_match');?>';
	   			break;

	   		}
	   		 $('.matches>p.bg-info').text(countMessage);
	   	}

   }

});
<?php endif; ?>

	/* მატჩის წაშლა */
	function deleteMatch(elm){

		 matchID = elm.getAttribute('class');
		 $(elm).remove();

		 var countMatch = localStorage.getItem('count');
		 localStorage.removeItem(matchID);
		 localStorage.setItem('count', countMatch - 1);
	}

	function sendMatch(){

			var arr = new Array();
			var matches;
			$('.matches>li').each(function(){
			     arr.push($(this).attr("data-match"));
			     localStorage.removeItem($(this).attr("class"));
			     $(this).remove();
			});

			if(arr[0] != undefined){

					if(arr[1] != undefined){
						 matches = arr[0]+'|'+arr[1];
					}else{
						 matches = arr[0];
					}

				$.ajax({
				    type: "POST",
				    url: "<?php echo base_url();?>Ajax_forecast/to_forecast",
				    // data:{ 'matches': "2342'234" },
				    data:{ 'matches': matches },
				    success: function(data){
						  var jsonResult = jQuery.parseJSON(data);
							$('.matches>p.bg-info').text(jsonResult.message);
				    }
				});
			}
	}

</script>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<table id="matches" class="table table-bordered">
				<tr>
					<th> </th>
					<th>1</th>
					<th>X</th>
					<th>2</th>
					<th>under</th>
					<th>over</th>
					<th>date</th>
				</tr>
			<?php
			// კოეფიციენტს ამოწმებს და 1.40 ზე ნაკლები ან ტოლი არ გამოაქ
			function check_add($add){
					if(floatval(str_replace(",",".",$add)) <= 1.40){
						return null;
					}else{
						return $add;
					}
			}
			
			foreach ($matches as $match) {
				$matchStartData = strtotime($match['start_date']);
				$now = time();
				// თუ მატჩი უკვე დაწყებულია ან დამთავრებულია
				if($matchStartData < $now){
						continue;
				}
				 ?>
					<tr data-id="<?php echo $match['xml_id'];?>" class="matchData">
						<td><?php echo $match['match_name'];?></td>
						<td class="match" data-add-type="1"><?php echo check_add($match['one']);?></td>
						<td class="match" data-add-type="X"><?php echo check_add($match['drow']);?></td>
						<td class="match" data-add-type="2"><?php echo check_add($match['two']);?></td>
						<td class="match" data-add-type="under"><?php echo check_add($match['under']);?></td>
						<td class="match" data-add-type="over"><?php echo check_add($match['over']);?></td>
						<td><?php echo date("F j, g:i a",strtotime($match['start_date']));?></td>
					</tr>
			<?php  }?>
			</table>
		</div>
		<div class="col-md-4">
			<ul class="list-group matches">
				<button onclick="sendMatch()" class="btn btn-success">send</button><br>
				<p class="bg-info"></p>
			</ul>
		</div>
	</div>
</div>



<script type="text/javascript">
$(document).ready(function(){

if (typeof(Storage) !== "undefined") {
  // Code for localStorage/sessionStorage.
    //alert(' supported');
    // Store
  } else {
     alert(' No Web Storage support..');
}

  /* მატჩის ბილეთში დამატება */
  $(".matchData").click(function(e){

       var name = $(this).children(":first").text();
       var matchID = $(this).attr('data-id');
       var odd = e.target.attributes.getNamedItem("data-add-type").value;
       var oddValue = e.target.innerText;
			  // თუ კუში ცარიელია return
			  if(!oddValue){
			 		return;
		    }

    // თუ მატჩი უკვე დამატებული არ არის
    if(localStorage.getItem(matchID) == null){

							// თუ მრიცხველი გამოცხადებული არ არის
              if(localStorage.getItem('count') == null){
                  localStorage.setItem('count', 0);
              }

					// მატჩის ბილეთში ჩასამატებელი კონტენტი
	          var content = '<li onclick="deleteMatch(this)" data-match="'+matchID+'='+odd+'" class="list-group-item '+matchID+'">'+name+'<span class="badge">'+odd+' </span><span class="badge"> '+oddValue+'</span></li>';
						 // 2 მატჩზე ნაკლები თუ არის
	           if(localStorage.getItem('count') < 2 ){
	                 $('.matches').append(content);
									 // შევინახოთ მატჩი
	                 localStorage.setItem(matchID, odd);
	                 var countMatch = localStorage.getItem('count');
	                 countMatch = parseInt(countMatch);
	                 countMatch = countMatch + 1;
	           			 localStorage.setItem('count', countMatch);
	           }
    }else{
						// განვაახლოთ მატჩი თუ უკვე არსებობს ბილეთში
					  $('li.'+matchID).remove();
	          var content = '<li onclick="deleteMatch(this)" data-match="'+matchID+'='+odd+'" class="list-group-item '+matchID+'">'+name+'<span class="badge">'+odd+' </span><span class="badge">'+oddValue+'</span></li>';
	          $('.matches').append(content);
	          localStorage.setItem(matchID, odd);
    }
  });
});
</script>
