<script type="text/javascript">

$(document).ready(function(){

   var name = new Array();
   var countMatch, countMessage;
	 /* შევამოწმოთ პროგნოზების ლიმიტი  */
   for (var i = 0; i <= localStorage.length - 1; i++) {
   key = localStorage.key(i);

   }

});

	/* მატჩის წაშლა */
	function deleteMatch(elm){

		 var matchID = elm.getAttribute('data-id');
		 $(elm).remove();

		 localStorage.removeItem(matchID);

	}

	function sendMatch(){

			var arr = new Array();
			var matches;
			$('.matches>li').each(function(){
			     arr.push($(this).attr("data-match"));
			     localStorage.removeItem($(this).attr("class"));
			     $(this).remove();
			});

      if(arr[0] == undefined){
           return;
      }

            var i = 0 , matches = '';
            while(arr[i] != undefined){
                 matches += '|'+arr[i];
                 i++;
            }

				$.ajax({
				    type: "POST",
				    url: "<?php echo base_url();?>panel/Ajax_forecast/to_forecast/2",
				    data:{ 'matches': matches },
				    success: function(data){
						  var jsonResult = jQuery.parseJSON(data);

							$('.matches>p.bg-info').empty();

							for (var i = 0; i < jsonResult.length; i++){

								$('.matches>p.bg-info').append('<li>'+jsonResult[i].message+'</li>');
									if(jsonResult[i].status == 0){
										 localStorage.removeItem(jsonResult[i].match);

								   }
							}
							// $('.matches>p.bg-info').text(jsonResult.message);
				    }
				});

	}

</script>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<h3><? if(!empty($league_name)) { print $league_name[0]['league_name'];}?></h3>
			<table id="matches" class="table table-bordered">
				<tr>
					<th> </th>
					<th>1</th>
					<th>2</th>
					<th>under</th>
					<th>odd value</th>
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

      if(!empty($matches)){
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
						<td class="match" data-add-type="2"><?php echo check_add($match['two']);?></td>
						<td class="match" data-add-val="<?php echo $match['under_over_val'];?>" data-add-type="under"><?php echo check_add($match['under']);?></td>
						<td><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><?php echo $match['under_over_val'];?> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></td>
						<td class="match" data-add-val="<?php echo $match['under_over_val'];?>" data-add-type="over"><?php echo check_add($match['over']);?></td>
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
    <?php } ?>
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
			 var odd,oddValue,oddIndVal;
			 if($(e.target).attr('data-add-type')){
				  odd = $(e.target).attr('data-add-type');
				  oddValue = $(e.target).text();
			 }
			  if($(e.target).attr('data-add-val')){
			 	 oddIndVal = $(e.target).attr('data-add-val');
			  }else{
					oddIndVal = '';
				}

			  // თუ კუში ცარიელია return
			  if(!oddValue){
			 		return;
		    }

    // თუ მატჩი უკვე დამატებული არ არის
    if(localStorage.getItem(matchID) == null){

					// მატჩის ბილეთში ჩასამატებელი კონტენტი
	          var content = '<li onclick="deleteMatch(this)" data-match="'+matchID+'='+odd+'='+oddIndVal+'" data-id="'+matchID+'" class="list-group-item ">'+name+'<span class="badge">'+odd+' '+oddIndVal+' </span><span class="badge"> '+oddValue+'</span></li>';

	                 $('.matches').append(content);
									 // შევინახოთ მატჩი
	                 localStorage.setItem(matchID, odd);

    }else{
						// განვაახლოთ მატჩი თუ უკვე არსებობს ბილეთში
					  $("li[data-id='"+matchID+"']").remove();
	          var content = '<li onclick="deleteMatch(this)" data-match="'+matchID+'='+odd+'='+oddIndVal+'"  data-id="'+matchID+'" class="list-group-item">'+name+'<span class="badge">'+odd+' '+oddIndVal+' </span><span class="badge">'+oddValue+'</span></li>';
	          $('.matches').append(content);
	          localStorage.setItem(matchID, odd);
    }
  });
});
</script>
