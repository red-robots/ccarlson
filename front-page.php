<?php
get_header(); 
?>

<main id="main" class="site-main" role="main">
  <?php while ( have_posts() ) : the_post(); ?>
  <?php endwhile; ?>
  <?php include( locate_template('parts/content-flexible.php') ); ?>
</main>

<?php
get_footer();
