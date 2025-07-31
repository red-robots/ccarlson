<?php if( get_row_layout() == 'two_column_contact_info' ) {
  $column_left = get_sub_field('column_left');
  $column_right = get_sub_field('column_right');
  $text_quote = get_sub_field('text_quote');
  $disable_section = get_sub_field('disable_section');
  $is_visible = ($disable_section) ? false : true;
  if( $is_visible && ($column_left || $column_right || $text_quote) ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?>">
    <div class="wrapper">
      <div class="flexwrap">
        <?php if ($column_left || $text_quote) { ?>
        <div class="flexcol fleft">
          <div class="inside">
            <?php if ($column_left) { ?>
              <div class="contact-items">
                <?php echo anti_email_spam($column_left); ?>
              </div>
            <?php } ?>
            <?php if ($text_quote) { ?>
            <blockquote><?php echo anti_email_spam($text_quote); ?></blockquote>
            <?php } ?>
          </div>
        </div>
        <?php } ?>

        <?php if ($column_right) { ?>
        <div class="flexcol fright">
          <div class="inside">
            <?php echo anti_email_spam($column_right); ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>
<?php } ?>