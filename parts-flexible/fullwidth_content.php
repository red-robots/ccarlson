<?php if( get_row_layout() == 'fullwidth_content' ) {
  $content = get_sub_field('content');
  $has_content = ($content) ? true : false;
  $custom_class = '';
  if ($has_content) { ?>
  <section id="repeatable_<?php echo get_row_layout() ?>_<?php echo $ctr ?>" data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable_<?php echo get_row_layout() ?><?php echo $custom_class; ?>">
    <div class="wrapper">
      <div class="flexwrap">
        <div class="textWrap">
          <?php echo anti_email_spam($content); ?>
        </div>
      </div>
    </div>  
  </section>
  <?php } ?>
<?php } ?>