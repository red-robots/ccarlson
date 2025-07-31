<?php if( have_rows('flexible_content') ) {  ?>
  <div class="flexible-content-wrapper">
    <?php $ctr=1; while( have_rows('flexible_content') ): the_row(); ?>
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