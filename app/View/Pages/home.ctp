<div class="container-fluid">
	<div class="row-fluid">
		<div class="tabbable tabs-left">
		<?php //debug($this); ?>
			<?php 
				if(!(empty($cats_list[0]['Cat']['cat_name']))){
					$view = $cats_list[0]['Cat']['cat_name']; 
					} else {
					$view = '';
				} 
				echo $this->element('../Cats/cats_list',array('tableview' => $view));
			?>
			<div class="tab-content">
			<?php 
				foreach($cats_list as $cat):
 					
					if($cat['Cat']['cat_name'] == $cats_list[0]['Cat']['cat_name']){
						$active_state = 'active';
					} else {
						$active_state = '';
					}
					//debug($cat['Cat']['cat_name']);
					echo '<div class="tab-pane '.$active_state.'" id="'.str_replace(' ', '',$cat['Cat']['cat_name']).'">';
					echo '<legend>'.$cat['Cat']['cat_name'].'</legend>';
					if(count($cat['Cat']) > 2) {
					echo $this->element('../Docs/index',
						array('tableview' => $cat['Cat']['cat_name']));
					} else {
						echo "<a href='Cats'>Click here to add some fields!</a>";
					}
					echo '</div>'; 
				endforeach;
			?>
			</div>
		</div>
	</div>
</div>