<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

$placeholder = THEMEURI . 'images/rectangle.png';
$banner = get_field("banner_image");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
global $post;

$has_title_shortcode = ( has_shortcode($post->post_content,'page_title_here') ) ? true : false;
get_header(); ?>

<div id="primary" class="content-area-full content-default page-default-template <?php echo $has_banner ?>">
	<main id="main" class="site-main wrapper" role="main">

		<?php while ( have_posts() ) : the_post(); 
        $fullwidthContent = get_field('fullwidth_content');
      ?>

      <?php if (!$has_title_shortcode) { ?>
        <?php if ( !has_post_thumbnail() ) { ?>
          <div class="entry-title">
            <h1 class="page-title"><?php the_title(); ?></h1>
          </div>
        <?php } ?>
      <?php } ?>

      <div class="entry-content">
        <?php if ( has_post_thumbnail() ) { ?>
          <div class="entry-content-column">
            <article>
              <h1 class="page-title"><?php the_title(); ?></h1>
              <?php the_content(); ?>
            </article>
            <figure class="featured-image">
              <?php the_post_thumbnail() ?>
            </figure>
          </div>
        <?php } else { ?>
          <?php the_content(); ?>
        <?php } ?>

        <?php if ($fullwidthContent) { ?>
        <div class="acf--fulwidth-content">
          <?php echo anti_email_spam($fullwidthContent); ?>
        </div> 
        <?php } ?>
      </div>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
