<div class="posts form">
<?php echo $this->Form->create('Cat' , array( 'type' => 'post', 'class'=> 'aform' ));?>
<?php
	// move these to controlle later
	$cat_name = array_keys($this->request->query);
	$cat_name = str_replace("_"," ",$cat_name[0]);
?>

	<fieldset>
	<?php
		echo $this->Form->hidden('cat_name', array('value'=>$cat_name));
		echo $this->Form->input('f_name', array('label'=>"Field Name", 'class'=>'input validate[required]'));
		echo $this->Form->input('f_sname', array('label'=>"Short Name", 'class'=>'input validate[required, custom[onlyLetterNumber]]'));
		$options = array('string' => 'String', 'date' => 'Date', 'boolean' => 'Boolean');
		//echo $this->Form->select('f_type', $options, array('default'=> 'string'));
		echo $this->Form->input('f_type', array('options'=>$options, 'string'=>'String', 'label'=> 'Data Type', 'class'=>'input validate[required]'));
	?>
	</fieldset>
<?php //echo $this->Form->end('Submit');?>
<div class="form-actions">
<button type="submit" class="btn btn-primary">
						Add New Data Type
					</button>
</div>
</div>
