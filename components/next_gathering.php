<div class="full_width primary_background pad">
	<div class="wide_container">
		<div class="next_gathering">
			<div class="next_gathering right_sidebar">
				<?php 
				$next_gathering_image = wp_get_attachment_image_src(get_field('next_monthly_gathering_image'),'full_grid')[0];
				$next_gathering_image_dominant_color = get_post_meta($next_gathering_image, 'dominant_color_hex', true);
				?>

				<div style="padding-top:65%; background-color: <?php echo $next_gathering_image_dominant_color;?>; background-image:url('<?php echo $next_gathering_image;?>'); background-size: cover; background-position: center center"></div>

				<?php					
					$date_1 = date('Ymd', strtotime("now")); 
					$date_2 = date('Ymd', strtotime("+12 months"));

					get_header();
					$next_gathering = array(
						'post_type'	=> 'gathering',
						'posts_per_page' => 1,
						'meta_key' => 'date',
						'meta_compare' => 'BETWEEN',
						'meta_type' => 'numeric',
						'meta_value' => array($date_1, $date_2),
						'orderby' => 'meta_value_num',
						'order' => 'ASC'
					); 

					$posts_array = get_posts( $next_gathering );
					setup_postdata( $post );
					foreach( $posts_array as $post ) :
						$date_time_unix = strtotime(get_field('date_time'));
						$year = date("Y", $date_time_unix);
						$month = date("F", $date_time_unix);
						$day = date("j", $date_time_unix);
						$day_of_week = date("l", $date_time_unix);
						$formatted_date = date("n.j.y", $date_time_unix);
						$start_time = date("g:i", $date_time_unix);	
						$end_time = get_field('end_time');
						$gatherings_page_id = get_field('gatherings_page', 'option');?>
						<div>
							<h1 class="giant">The Next Monthly Gathering</h1>
							<h1 style="margin-bottom: 2rem"><?php echo $formatted_date;?></h1>
							<h2>Livestream begins at <?php echo $start_time;?> PM</h2>
							<a style="font-style: italic;" href="<?php the_permalink($gatherings_page_id);?>">Find out more</a>
						</div>
					<?php endforeach;
					wp_reset_query();
				?>
			</div>
		</div>
	</div>
</div>
