<?php // Full Bleed Image Gallery
$image_gallery = get_field('image_gallery_row');

if( $image_gallery ):
	$images = $image_gallery['images'];
	$image_count = count($images);
	$gallery_style = $image_gallery['style'];
	$gallery_height = $image_gallery['height'] . "px";

	// Set grid columns
	if($image_count == 2 ) {
		$columns = 'two_columns';
	} elseif($image_count == 3 ) {
		$columns = 'three_columns';
	} elseif($image_count == 4 ) {
		$columns = 'four_columns';
	}

	// Open Compenent Element Container
	if( $gallery_style == 'Full Width' ):?>
		<div class="full_bleed_gallery <?php echo $columns;?>">
	<?php else:?>
		<div class="full_bleed_gallery">
			<div class="wide_container <?php echo $columns;?>">
	<?php endif;?>

	<?php 
	// Loop through Images
	foreach( $images as $image ):
    	$banner_image = wp_get_attachment_image_src($image['ID'],'full_width')[0];
    	$banner_image_dominant_color = get_post_meta($image['ID'], 'dominant_color_hex', true);?>
    
    	<div style="padding-top: 100%; background-color: <?php echo $banner_image_dominant_color;?>; background-image:url('<?php echo $banner_image;?>'); background-size: cover; background-position: center center"></div>
	<?php endforeach; ?>

	<?php 
	// Close Compenent Element Container
	if( $gallery_style == 'Grid Width' ):?>
		</div>>
	<?php else:?>
			</div>
		</div>	
	<?php endif;?>
<?php endif; ?>