<?php
/**
 * Template Name: Flexible Content
 */
get_header(); 
?>

<main id="main" class="site-main" role="main">

  <?php while ( have_posts() ) : the_post(); ?>
  <?php endwhile; ?>

	<?php if( have_rows('flexible_content') ) {  ?>
  <div class="flexible-content-wrapper">
    <?php $ctr=1; while( have_rows('flexible_content') ): the_row(); ?>

    <?php //include( locate_template('parts/content-repeater.php') ); ?>
    <?php  
    $templates = get_flexible_templates();
    if($templates) {
      foreach($templates as $template) {
        include( locate_template($template) ); 
      }
    }
    ?>

    <?php $ctr++; endwhile; ?>
  </div>
  <?php } ?>

</main>

<?php
get_footer();