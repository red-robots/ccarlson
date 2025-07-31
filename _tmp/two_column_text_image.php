<?php if( get_row_layout() == 'two_column_text_image' ) {
  $image_position = get_sub_field('image_position');
  $image_position = ($image_position) ? ' image-' . $image_position : ' image-right';
  $text = get_sub_field('text');
  $image = get_sub_field('image');
  $columnClass = ($text && $image) ? 'half' : 'full';
  $columnClass .= $image_position;
  $disable_section = get_sub_field('disable_section');
  $is_visible = ($disable_section) ? false : true;
  if( $is_visible && $text ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?>">
    <div class="wrapper">
      <div class="flexwrap <?php echo $columnClass ?>">
        <?php if ($text) { ?>
          <div class="textCol"><?php echo anti_email_spam($text); ?></div>
        <?php } ?>
        <?php if ($image) { ?>
          <div class="imageCol">
            <figure>
              <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>">
            </figure>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>
<?php } ?>