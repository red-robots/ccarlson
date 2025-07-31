<?php if( get_row_layout() == 'profileBlock' ) {
  $photo = get_sub_field('photo');
  $details = get_sub_field('details');
  $disable_section = get_sub_field('disable_section');
  $is_visible = ($disable_section) ? false : true;
  if( $is_visible && $details ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?>">
    <div class="wrapper">
      <?php if ($photo) { ?>
      <div class="photoBlock">
        <figure>
          <img src="<?php echo $photo['url'] ?>" alt="<?php echo $photo['title'] ?>">
        </figure>
      </div>
      <?php } ?>
      <?php if ($details) { ?>
      <div class="details"><?php echo anti_email_spam($details); ?></div>
      <?php } ?>
    </div>
  </section>
  <?php } ?>
<?php } ?>