<div class="container-fluid">
	<div class="row-fluid">
		<div class="tabbable tabs-left">
			<?php 
			if(!(empty($cats_list[0]['Cat']['cat_name']))){
					$view = $cats_list[0]['Cat']['cat_name']; 
					} else {
					$view = '';
				}
				echo $this->element('../Cats/cats_list',array('tableview' => $view)); ?>
				<div class="tab-content">
				<?php 
				//debug($this->viewVars);	
				
				foreach($cats_list as $cat): 
				if($cat['Cat']['cat_name'] == $cats_list[0]['Cat']['cat_name']){
					$active = "active";
				} else {
					$active = "";
				}
				echo '<div class="tab-pane '.$active.'" id="'.str_replace(' ', '',$cat['Cat']['cat_name']).'">'; 
				echo '<legend>'.$cat['Cat']['cat_name'].'</legend>';
				
				?>
				<a href="Cats/delete?id=<?php echo $cat['Cat']['_id']; ?>&n=<?php echo $cat['Cat']['cat_name']; ?>" class="btn delbtn btn-info">Delete Category <?php echo $cat['Cat']['cat_name']; ?></a>
				<a href="#" class="btn btn-primary" id="laf_<?php echo str_replace(" ","_",$cat['Cat']['cat_name']); ?>">Add New Field</a><br/><br/>
				

				<script type="text/javascript">
					$(function() {
						$("#laf_<?php echo str_replace(" ","_",$cat['Cat']['cat_name']); ?>").click(function(event) {
							$('<div/>').dialog2({
								title : "Add New <?php echo str_replace("_"," ",$cat['Cat']['cat_name']); ?> Field",
								content : "Cats/add_fields?<?php echo str_replace(" ","_",$cat['Cat']['cat_name']); ?>",
								id : "add_field"
							});

							event.preventDefault();
						});
					});
				</script>
				
				<?php
				$cat_keys = array_keys($cat['Cat']);
				//debug($cat_keys);
				unset($cat_keys[array_search('_id',$cat_keys)]);
				unset($cat_keys[array_search('cat_name',$cat_keys)]);
				unset($cat_keys[array_search('modified',$cat_keys)]);
				unset($cat_keys[array_search('created',$cat_keys)]);
				echo '<table class="dataTable table table-striped" id="'.$cat['Cat']['cat_name'].'" width="100%">';
				echo "<thead>
					<tr>
						<th>Name</th>
						<th>Type</th>
						<th>Operations</th>
					</tr>
				</thead>";
				foreach($cat_keys as $cat_field):
					echo "<tr>";
					echo '<td>'.$cat_field."</td>";
					//echo '<td>'.$cat['Cat'][$cat_field]['sname']."</td>";
					echo '<td>'.$cat['Cat'][$cat_field]['type']."</td>";
					echo "<td><a href='Cats/d_unset?f=".$cat_field."&t=".str_replace(" ","_",$cat['Cat']['cat_name'])."' class='btn btn-mini delbtnF'>Delete</td>";
					echo "</tr>";					
				endforeach; 
				echo "</table>";
				?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>



<br>
<br>

<?php //move this to controller later
		
	 ?>

<?php //debug($results); ?>


