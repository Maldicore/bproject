<div class="posts form">
<?php echo $this->Form->create('Cat' , array( 'type' => 'post' ));?>
	<fieldset>
 		<legend><?php __('Edit Post');?></legend>
	<?php
		echo $this->Form->hidden('_id');
		echo $this->Form->input('cat_name');
		echo $this->Form->input('field_name');
		echo $this->Form->input('field_type');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Cat', true), array('action'=>'index'));?></li>
	</ul>
</div>
