<?php if( get_row_layout() == 'two_column_section' ) {
  $left_column = get_sub_field('left_column');
  $right_column = get_sub_field('right_column');
  $custom_class = ($left_column && $right_column) ? ' two-columns' : '';
  $has_content = ($left_column||$right_column) ? true : false;
  if ($has_content) { ?>
  <section id="repeatable_<?php echo get_row_layout() ?>_<?php echo $ctr ?>" data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable_<?php echo get_row_layout() ?><?php echo $custom_class; ?>">
    <div class="wrapper">
      <div class="flexwrap">
        <?php if ($left_column) { ?>
        <div class="leftCol">
          <div class="textWrap">
            <?php echo anti_email_spam($left_column); ?>
          </div>
        </div> 
        <?php } ?>
        <?php if ($right_column) { ?>
        <div class="rightCol">
          <div class="textWrap">
            <?php echo anti_email_spam($right_column); ?>
          </div>
        </div> 
        <?php } ?>
      </div>
    </div>  
  </section>
  <?php } ?>
<?php } ?>