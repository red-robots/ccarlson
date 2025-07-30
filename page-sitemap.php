<?php
/**
 * Template Name: Sitemap
 */

get_header(); ?>

<div id="primary" class="content-area-full generic-layout sitemap-content">
  <main id="main" class="site-main" role="main">
    <?php while ( have_posts() ) : the_post(); ?>

      <div class="titlediv">
        <div class="wrapper"><h1 class="page-title"><?php the_title(); ?></h1></div>
      </div>
      
      
      <?php if ( get_the_content() ) { ?>
      <div class="entry-content contentDiv">
        <div class="wrapper"><?php the_content(); ?></div>
      </div>
      <?php } ?>

      <?php if ( has_nav_menu('sitemap') ) { ?>
      <div id="sitemap-wrap">
        <?php wp_nav_menu( array( 'theme_location' => 'sitemap', 'menu_id' => 'sitemap','container_class'=>'sitemap-links') ); ?>
      </div>
      <?php } ?>

    <?php endwhile; ?>  
  </main>
</div>

<?php
get_footer();
