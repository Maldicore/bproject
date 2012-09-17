<div class="container-fluid">
	<div class="row-fluid">
	<div class="span4 columns"></div>
    <div class="span4 columns">
<div class="posts form">
<?php echo '<legend>Update Your Profile</legend>'; ?>

<?php echo $this->Form->create('User' , array('type' => 'post', 'class'=> 'well form-horizontal' ));?>
	<fieldset>
	<?php
		echo $this->Form->hidden('_id', array('value'=>$this->Session->read('Auth.User._id')));
		echo $this->Form->input('username', array('label'=>"Username", 'value'=>$this->Session->read('Auth.User.username'), 'class'=>'input validate[required]'));		
		echo $this->Form->input('email', array('label'=>"Email", 'value'=>$this->Session->read('Auth.User.email'), 'class'=>'input validate[required, custom[email]]'));
		echo $this->Form->input('password', array('label'=>"Password", 'value'=>'' ,'class'=>'input validate[required]'));
		echo $this->Form->hidden('role', array('label'=>"Role", 'value'=>$this->Session->read('Auth.User.role')));
	?>
	</fieldset><br />
<?php //echo $this->Form->end('Submit');?>
<button type="submit" class="btn btn-primary">
						Modify User Data
					</button>
</div></div>
<div class="span4 columns"></div></div></div>
