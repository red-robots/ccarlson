<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bellaworks
 */

get_header(); ?>

<div id="primary" class="content-area-full generic-layout page404-content">
  <main id="main" class="site-main" role="main">

      <div class="titlediv">
        <div class="wrapper"><h1 class="page-title"><?php esc_html_e( 'Page Not Found!', 'bellaworks' ); ?></h1></div>
      </div>
      
      
      <div class="entry-content contentDiv">
        <div class="wrapper">
          <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below.', 'bellaworks' ); ?></p>
          <div id="sitemap-wrap">
            <?php wp_nav_menu( array( 'theme_location' => 'sitemap', 'menu_id' => 'sitemap','container_class'=>'sitemap-links') ); ?>
          </div>
        </div>
      </div>
  </main>
</div>

<?php
get_footer();
