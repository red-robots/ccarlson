<?php if( get_row_layout() == 'intro_and_two_column' ) {
  $intro = get_sub_field('intro_fullwidth');
  $column1_text = get_sub_field('column1_text');
  $column2_text = get_sub_field('column2_text');
  $columnClass = ($column1_text && $column2_text) ? 'half' : 'full';
  $disable_section = get_sub_field('disable_section');
  $is_visible = ($disable_section) ? false : true;
  if( $is_visible && ($column_info) ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?>">
    <div class="wrapper">
      <?php if ($intro) { ?>
      <div class="intro"><?php echo anti_email_spam($intro); ?></div>
      <?php } ?>
      <div class="flexwrap <?php echo $columnClass ?>">
        <?php if ($column1_text) { ?>
        <div class="flexcol fxLeft"><?php echo anti_email_spam($column1_text); ?></div>
        <?php } ?>
        <?php if ($column2_text) { ?>
        <div class="flexcol fxRight"><?php echo anti_email_spam($column2_text); ?></div>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>
<?php } ?>