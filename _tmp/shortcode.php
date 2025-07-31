<?php if( get_row_layout() == 'shortcode' ) {
  $shortcode_input = get_sub_field('shortcode_input');
  $disable_section = get_sub_field('disable_section');
  $is_visible = ($disable_section) ? false : true;
  if( $is_visible && ($shortcode_input && do_shortcode($shortcode_input)) ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?>">
    <div class="wrapper">
      <?php echo do_shortcode($shortcode_input); ?>
    </div>
  </section>
  <?php } ?>
<?php } ?>