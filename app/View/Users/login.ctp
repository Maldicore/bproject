<div class="row-fluid">
    <div class="span4 columns"></div>
    <div class="span4 columns">
<?php echo $this->Session->flash('auth'); ?>
	<?php
	
echo $this->Form->create
(
	'User',
	array
	(
		'url' => array
		(
			'controller' => 'users',
			'action'	 => 'login'
		),
		'class'			=> 'well form-horizontal',
		'inputDefaults' => array
		(
			'label' => true,
			'error' => false
		)
	)
); 
?>
<fieldset>
            <legend><?php echo 'Login'; ?></legend>
<?php
echo $this->Form->input('username',array('placeholder' => 'Username', 'type'=>'text', 'class' => 'input', 'label'=>'Username: &nbsp;'));
echo $this->Form->input('password',array('placeholder' => '********','type' => 'password', 'class' => 'input', 'label'=>'Password: &nbsp;'));
echo '<br />';
echo '<span>'.$this->Form->submit('Login',array('class' => 'btn btn-primary pull-left')).'</span>';
echo '<span>'.$this->Html->link('Signup',array('controller'=>'Users','action'=>'add'),array('class'=>'btn pull-left left12')).'</span>';

?>
	</fieldset>
	</div>
    <div class="span4 columns"></div>
</div>