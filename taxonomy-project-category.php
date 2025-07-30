<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */
$queried_object = get_queried_object(); 
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;
$termName = $queried_object->name;
$post_type = 'projects';
get_header(); ?>

	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">
			<div class="titlediv">
        <div class="wrapper"><h1 class="page-title"><?php echo $termName?></h1></div>
      </div>
			<?php
				$args = array(
					'posts_per_page' 	=> -1,
					'post_type'				=> $post_type,
					'post_status'			=> 'publish',
					'tax_query' => array(
						array(
							'taxonomy' 	=> $taxonomy, 
							'field' 	=> 'term_id',
							'terms' 	=> array( $term_id ) 
						)
					)
				);
				$posts = new WP_Query($args);
				if ($posts->have_posts())  { ?>
				<div class="projects-wrapper wrapper">
					<div class="project-listing">
						<?php while ($posts->have_posts()) : $posts->the_post(); 
							$main_photo = get_field('main_photo'); 
							$hasImage = ($main_photo) ? 'hasImage':'noImage';
							?>
							<div class="item-info <?php echo $hasImage?>">
								<a href="<?php echo get_permalink()?>" class="projectLink">
									<figure>
									<?php if($main_photo) { ?>
										<div class="img"><span style="background-image:url('<?php echo $main_photo['url']?>')"></span></div>
									<?php } else { ?>
										<div class="img no-image"></div>
									<?php } ?>
										<img src="<?php echo get_template_directory_uri() ?>/images/slider-frame.png" alt="" class="frame" />
									</figure>
								</a>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
				<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
