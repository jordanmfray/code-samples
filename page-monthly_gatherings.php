<?php 
/* Template Name: Monthly Gatherings V2 */


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
query_posts($next_gathering);

// Setup Gathering Variables
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		$date_time = get_field('date_time');
		$date_time_unix = strtotime($date_time);
		$date_time_unix_adjusted_time = $date_time_unix + 21600;
		$seconds_till_unlock =  $date_time_unix_adjusted_time - strtotime("now") - 300;
		$year = date("Y", $date_time_unix);
		$month = date("F", $date_time_unix);
		$day = date("j", $date_time_unix);
		$day_of_week = date("l", $date_time_unix);
		$formatted_date = date("n.j.y", $date_time_unix);
		$start_time = date("g:i", $date_time_unix);	
		$end_time = get_field('end_time');
	endwhile;
endif; 
wp_reset_query();?>

	<?php 
		$banner_image = wp_get_attachment_image_src(get_field('banner_image'),'full_grid')[0];
		$banner_image_dominant_color = get_post_meta($banner_image, 'dominant_color_hex', true);
	?>
	<div class="content">
		<div class="banner wide_container primary_background">
			<div class="row no_margin_top">
				<div class="monthly_gatherings_banner">
					<h1 class="giant animated animatedFadeInUp fadeInUp">The Next Monthly Gathering <?php echo $formatted_date;?></h1>
					<div class="image" style="height: 50vh; background-color: <?php echo $banner_image_dominant_color;?>; background-image:url('<?php echo $banner_image;?>'); background-size: cover; background-position: center center"></div>
				</div>
			</div>
			<i class="fal fa-angle-down"></i>
		</div>

		<?php 
			$zoom = get_field('zoom');
			$meeting_url = $zoom['zoom_meeting_url'];
			$meeting_id = $zoom['zoom_meeting_id'];
			$meeting_phone_number = $zoom['zoom_call_in_phone_number'];
		?>
		
		<div class="wide_container">
			<div class="row monthly_gatherings_about">
				<div>
					<h4><?php echo $day_of_week;?></h4>
					<h1><?php echo $month . " " . $day . ", " . $year;?></h1>
					<h2><?php echo $start_time . "-" . $end_time . "PM";?> MT</h2>
					<div class="zoom">
						<h4>Join Virtually on Zoom</h4>
						<a id="join_zoom" class="button lock_button" target="_blank" href="<?php echo $zoom['zoom_meeting_url'];?>" data-seconds_till_unlock="<?php echo $seconds_till_unlock;?>">Zoom Meeting Locked</a>
						<div id="meeting_info">
							<p>Call in Number: <?php echo phone_number_format($meeting_phone_number);?></p>
							<p>Meeting ID: <?php echo zoom_id_format($meeting_id);?></p>
						</div>
					</div>
				</div>

				<div>
					<h1>What to Expect</h1>
					<p class="about_monthly_gatherings"><?php the_field('about_monthly_gatherings');?></p>
				</div>
			</div>
		</div>

		<div class="full_width">
			<div class="wide_container">
				<div class="row">
					<div class="sms_notifications">
						<div>
							<h1 class="center">Hey! Shoot me a text.</h1>
							<p class="center">Enter your phone number and we’ll send you a text reminder about the next monthly gathering.</p>
							
							<div style="position: relative;">
								<form class="subscribe" id="sms_subscribe" action="javascript:post_sms_webhook()">
									<div id="error">Please provide your full phone number starting with the area code.</div>
									<input id="phone_number" type="tel" placeholder="*Phone Number">
									<input id="submit" type="submit" value="Send">
								</form>

								<div id="success">
									<p>Sweet. We just sent you a text.</p>
								</div>

								<p class="center fine_print">Message and data rates may apply. 1-2 msgs per month. Reply HELP for help, STOP to cancel. Read our Terms of Service and Privacy Policy for more information. </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php // Full Bleed Image Gallery
$instagram_images = get_field('instagram_images');

if( $instagram_images ):?>
	<div class="wide_container instagram">
		<div class="row no_margin_top">
			<p class="center"><?php the_field("introduction");?></p>
			<div class="four_columns">
				<?php
				// Loop through Images
				foreach( $instagram_images as $image ):
			    	$image_url = wp_get_attachment_image_src($image['ID'],'full_width')[0];
			    	$image_dominant_color = get_post_meta($image['ID'], 'dominant_color_hex', true);?>
			    
			    	<div class="image" style="background-color: <?php echo $image_dominant_color;?>; background-image:url('<?php echo $image_url;?>'); background-size: cover; background-position: center center"></div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<!-- load footer.php -->
<?php get_footer(); ?>