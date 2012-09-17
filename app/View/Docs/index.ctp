<a href="#" class="btn btn-primary" id="link_<?php echo str_replace(" ","_",$tableview) ?>">Add
	New Reference Doc</a>

<script type="text/javascript">
	$(function() {
		$("#link_<?php echo str_replace(" ","_",$tableview) ?>").click(function(event){
			$('<div/>').dialog2({
				title : "Add New <?php echo $tableview ?>",
				content : "Docs/add?tableview=<?php echo str_replace(" ","_",$tableview); ?>",
				id : "add_<?php echo str_replace(" ","_",$tableview) ?>"
			});

			event.preventDefault();
		});
	});
</script>


<br />
<br />

<table class="dataTable table table-striped"
	id="<?php echo $tableview; ?>" width="100%">
	<thead>
		<tr>
			<?php //Loop for Each Category 
	
	/* cats_list = List of Categories
	*	- Cat => cat_name
	*	- Cat => 'Field_name' => sname
	*	- Cat => 'Field_name' => type
	*  results = List of all the records
	*	- Doc => cat_name
	*	- Doc => 'Field_name' => data
	*/

	foreach($cats_list as $cat): 
		// Table Headings
//debug($cat);
		if(array_search($tableview,$cat['Cat'])){ 
			foreach($cat['Cat'] as $key => $cat_val):
				if(!($key == '_id' || $key == 'cat_name' || $key == 'created' || $key == 'modified')) {
					echo '<th>'.$key.'</th>';
				}
			endforeach;
			echo '<th>File</th>';		
			echo '<th>Operations</th>';
		}		

		endforeach;?>
		</tr>
	</thead>
	<?php foreach($results as $result): ?>
	<?php
	$doc_keys = array_keys($result['Doc']);

	?>

	<?php 
			if($result['Doc']['cat_name'] == $tableview) {
				echo "<tr>";
				foreach($cats_list as $cat): 
					if(array_search($tableview,$cat['Cat'])){
						foreach($cat['Cat'] as $key => $cat_val):
							//debug(array_search($cat_val['sname'],$result["Doc"]));
							if(!($key == 'cat_name' || $key == '_id' || $key == 'created' || $key == 'modified')){
								if(!empty($result["Doc"][$cat_val['sname']])){
								if($cat_val['sname'] == 'link'){
									echo "<td>";								
									echo '<a href="'.$result["Doc"][$cat_val['sname']].'">'.substr(strrchr($result['Doc'][$cat_val['sname']], "/"), 1).'</a>';
									echo "</td>";
								} else {
									echo "<td>";
									echo $result['Doc'][$cat_val['sname']];
									echo "</td>";
								}
							} else {
								echo "<td>";
								echo "</td>";
							}
					}
					endforeach; 
echo "<td><a href='files/".$result["Doc"]['file']."' class='btn btn-mini open-dialog' target='_blank'>File</td>";
echo "<td><a href='Docs/delete?id=".$result["Doc"]['_id']."' class='btn btn-mini delbtn'>Delete</td>";				
}
			endforeach; 

			echo "</tr>";	
		}
			?>
	<?php endforeach; ?>
</table>