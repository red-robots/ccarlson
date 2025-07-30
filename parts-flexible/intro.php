<?php if( get_row_layout() == 'intro' ) {
  $title = get_sub_field('title');
  $details = get_sub_field('details');
  $disable_section = get_sub_field('disable_section');
  $is_visible = ($disable_section) ? false : true;
  if( $is_visible && ($title || $details) ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?>">
    <div class="wrapper">
      <?php if ($title) { ?>
      <h2 class="h2"><?php echo $title ?></h2>
      <?php } ?>
      <?php if ($details) { ?>
      <div class="details"><?php echo anti_email_spam($details); ?></div>
      <?php } ?>
    </div>
  </section>
  <?php } ?>
<?php } ?>