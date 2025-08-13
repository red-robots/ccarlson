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
get_header(); ?>

<div id="primary" class="content-area-full content-default page-default-template <?php echo $has_banner ?>">
	<main id="main" class="site-main wrapper" role="main">

		<?php while ( have_posts() ) : the_post(); 

        $fullwidthContent = get_field('fullwidth_content');
      ?>

			<?php if( get_page_template_slug( get_the_ID() ) ) { ?>
        <div class="titlediv">
          <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
      <?php } else { ?>

        <div class="titlediv typical">
          <h1 class="page-title"><span><?php the_title(); ?></span></h1>
        </div>

      <?php } ?>

      <div class="entry-content padtop">
        <?php if ( has_post_thumbnail() ) { ?>
          <div class="entry-content-column">
            <article>
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
