<?php 
	$images = get_field("banner_images");
	$left_image = wp_get_attachment_image_src($images['left_image'],'full_grid')[0];
	$left_image_dominant_color = get_post_meta($images['left_image'], 'dominant_color_hex', true);
	$right_image = wp_get_attachment_image_src($images['right_image'],'full_grid')[0];
	$right_image_dominant_color = get_post_meta($images['right_image'], 'dominant_color_hex', true);
?>

<div class="full_width">
	<div class="right_sidebar">
		<div style="height: 60vh; background-color: <?php echo $left_image_dominant_color;?>; background-image:url('<?php echo $left_image;?>'); background-size: cover; background-position: center center"></div>
		<div style="height: 60vh; background-color: <?php echo $right_image_dominant_color;?>; background-image:url('<?php echo $right_image;?>'); background-size: cover; background-position: center center"></div>
	</div>
</div>