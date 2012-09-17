<div class="posts uform">
<?php echo $this->Form->create('Doc' , array( 'type' => 'post', 'class'=> 'aform' ));
$tableview = str_replace("_"," ",$this->params->query['tableview']);
?>
	<fieldset>
	<div id="file-upload-area">
		<noscript>			
			<p>Please enable JavaScript to use file uploader.</p>
			<!-- or put a simple form for upload here -->
		</noscript>         
	</div>
 		<?php
 		//debug($this->Form->fields);
	
	echo $this->Form->hidden('cat_name', array('value'=>$tableview));
 		foreach($cats_list as $cat): 
		if(array_search($tableview,$cat['Cat'])){
				//echo '<legend>Add New '.$cat['Cat']['cat_name'].' Reference Document</legend>';
				foreach($cat['Cat'] as $key => $cat_val):
					if(!($key == '_id' || $key == 'cat_name' || $key == 'created' || $key == 'modified')) {
						//debug($cat_val['type']);
						if($cat_val['type']=="date"){
							$class = 'input datepicker validate[required]';
						} elseif($cat_val['type']=="string") {
							$class = 'input validate[required]';
						} elseif($cat_val['type']=="string") {
							$class = 'input validate[required]';
						} elseif($cat_val['type']=="boolean") {
							$class = 'input validate[required]';
						} else {
							$class = 'input';
						}
						echo $this->Form->input($cat_val['sname'],
							array('label'=>$key, 'class' => $class));
					}
				endforeach;
			}
		endforeach;
		echo $this->Form->input('file', array('readonly'=>true));
 		?>
	</fieldset>
	<div class="form-actions">
<?php //echo $this->Form->end('Submit');?>
<button type="submit" class="btn btn-primary">
						Add New Reference
					</button>
					</div>
</div>
