<?php 
/* Template Name: Home */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();?>
	
	<div class="content no_margin_bottom">
		<?php
		// Get template parts
		get_template_part('components/home_top_banner');
		get_template_part('components/home_purpose_text');
		get_template_part('components/next_gathering');
		get_template_part('components/sms_signup');
		get_template_part('components/image-gallery-row');
		?>
	</div>
	
<?php endwhile; endif; get_footer();?>