<div class="posts form">
<?php //debug($this); ?>
<?php echo $this->Form->create('Cat' , array( 'type' => 'post', 'class'=>'uform aform' ));?>
	<fieldset>
 		
	<?php
		echo $this->Form->input('cat_name', array('class' => 'input validate[required]'));
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
