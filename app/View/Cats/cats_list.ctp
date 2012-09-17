<ul class="nav nav-tabs">
<?php foreach($cats_list as $cat): ?>
<?php 
	if($cat['Cat']['cat_name'] == $tableview){
		$active = "active";
	} else {
		$active = "";
}
?>
	<li class="<?php echo $active; ?>"><a href="#<? echo str_replace(' ', '',$cat['Cat']['cat_name']); ?>" data-toggle="tab"><?php echo $cat['Cat']['cat_name'];  ?></a></li>
<?php endforeach; ?>	
	
	<li><a href="#" id="link_add_cat">Add New</a></li>

<script type="text/javascript">
    $(function() {
        $("#link_add_cat").click(function(event) {
            $('<div/>').dialog2({
                title: "Add New Category", 
                content: "Cats/add", 
                id: "add_cat"
            });

            event.preventDefault();
        });
    });
</script>
</ul>