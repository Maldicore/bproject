<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Bibliography');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->Html->charset(); ?>
<title>
	<?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?>
</title>
<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('style');
		echo $this->Html->css('dataTables.editor');
		//echo $this->Html->css('jquery.dataTables');
		echo $this->Html->css('dataTables');
		echo $this->Html->css('TableTools');
		echo $this->Html->css('jquery.dialog2');
		echo $this->Html->css('datepicker');
		echo $this->Html->css('validationEngine.jquery');
		echo $this->Html->css('fileuploader');

		echo $this->Html->script('jquery');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('jquery.dataTables');
		echo $this->Html->script('bootstrap.dataTables');
		echo $this->Html->script('TableTools');
		echo $this->Html->script('dataTables.editor');
		echo $this->Html->script('jquery.form');
		echo $this->Html->script('jquery.controls');
		echo $this->Html->script('jquery.dialog2');
		echo $this->Html->script('jquery.dialog2.helpers');
		echo $this->Html->script('bootstrap-datepicker');
		echo $this->Html->script('jquery.validationEngine-en');
		echo $this->Html->script('jquery.validationEngine');
		echo $this->Html->script('fileuploader');
		echo $this->Html->script('script');		

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse"
						data-target=".nav-collapse"> <span class="icon-bar"></span> <span
						class="icon-bar"></span> <span class="icon-bar"></span>
					</a><?php echo $this->Html->link('Bibliography', '/', array('class'=>'brand')) ?> 
					<div class="btn-group pull-right">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-user"></i> <?php 
									$username = $this->Session->read('Auth.User.username');
									$email = $this->Session->read('Auth.User.email');
									$id = $this->Session->read('Auth.User._id');
									if(!empty($username)){ echo $username; } else { echo 'Please Login'; } ?> <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
					</li>
                            <?php if(!empty($username)){ ?>
                            	<li><?php echo $this->Html->link('Profile', '/Users/edit?id='.$id) ?></li>
                                <li class="divider"></li>
                                <li><?php echo $this->Html->link('Signout', '/Users/logout') ?></li>
                            <?php } else { ?>
                                <li><?php echo $this->Html->link('Login', '/Users/login'); ?></li>
                                <li class="divider"></li>
                                <li><?php echo $this->Html->link('Signup', '/Users/add'); ?></li>
                            <?php } ?>
						</ul>
					</div>
					<div class="nav-collapse">
						<ul class="nav">
							<li class="<?php if($this->request->webroot == $this->request->here){ echo "active"; } ?>"><?php echo $this->Html->link('Home', '/') ?></li>
							<li class="<?php if($this->request->webroot.'Cats' == $this->request->here){ echo "active"; } ?>"><?php echo $this->Html->link('Categories', '/Cats') ?></li>
							<li class="<?php if($this->request->webroot.'Pages/Contact' == $this->request->here){ echo "active"; } ?>"><?php echo $this->Html->link('Contact', '/Pages/Contact'); ?></li>
						</ul>
					</div>
					<!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<?php 
			//debug($app['msgTxt']);
			if(empty($app['msgType'])) { $type = 'success'; }
			if(!(empty($app['msgTxt']))) { ?>
				<div id="alert-area"></div>
				<script>
					newAlert('<?php echo $app["msgType"]; ?>', '<?php echo $app["msgTxt"]; ?>');
				</script>
			<?php } ?>
				<?php echo $this->fetch('content'); ?>
<hr/>
		<div id="footer" class="row-fluid">
			
			<div class="span8">
				<p class="left12"><?php
				echo $this->Html->image('cake.power.gif',array('alt'=>'Maldicore Group Pvt Ltd'));
				if(date('Y') == '2012') { $cy = date('Y'); } else { $cy = "2012 - ".date('Y'); }
				echo "<span class='left12'>Copyright ".$cy." Maldicore Group Pvt Ltd - All Rights Reserved.</span>";
				?>
				</p>
			</div>
			<div class="span4"><p class="right12 pull-right">Designed & Developed by <a href="http://maldicore.com" target="_blank">Maldicore</a></p></div>
			
		</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
