<?php
get_header(); 
?>

<main id="main" class="site-main" role="main">
  <?php if( have_rows('flexible_content') ) { ?>
    <?php include( locate_template('parts/content-flexible.php') ); ?>
  <?php } else { ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="entry-content">
        <?php the_content() ?>
      </div>
    <?php endwhile; ?>
  <?php } ?>
</main>

<?php
get_footer();
