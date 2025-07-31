<?php if( get_row_layout() == 'image_and_text_block' ) {
  $imgPos = get_sub_field('image_placement');
  $feat_image = get_sub_field('image');
  $text = get_sub_field('textcontent');
  $has_content = ($feat_image||$text) ? true : false;
  if ($has_content) { ?>
  <section id="repeatable_<?php echo get_row_layout() ?>_<?php echo $ctr ?>" data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
    <div class="wrapper">
      <div class="flexwrap">
        <?php if ($feat_image) { ?>
        <div class="imageCol">
          <figure>
            <img src="<?php echo $feat_image['url'] ?>" alt="<?php echo $feat_image['title'] ?>" />
          </figure>
        </div> 
        <?php } ?>
        <?php if ($text) { ?>
        <div class="textCol">
          <div class="wrap">
            <?php echo anti_email_spam($text); ?>
          </div>
        </div> 
        <?php } ?>
      </div>
    </div>  
  </section>
  <?php } ?>
<?php } ?>