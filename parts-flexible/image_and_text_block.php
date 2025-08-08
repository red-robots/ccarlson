<?php if( get_row_layout() == 'image_and_text_block' ) {
  $imgPos = get_sub_field('image_placement');
  $image_overlap = get_sub_field('image_overlap');
  $feat_image = get_sub_field('image');
  $textbg = get_sub_field('textbg');
  $text = get_sub_field('textcontent');
  $custom_class = '';
  $has_content = ($feat_image||$text) ? true : false;
  if($image_overlap) {
    $custom_class = ' overlap-image';
  }
  if ($has_content) { ?>
  <section id="repeatable_<?php echo get_row_layout() ?>_<?php echo $ctr ?>" data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable_<?php echo get_row_layout() ?><?php echo $custom_class; ?>">
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
          <div class="padleft"></div>
        </div> 
        <?php } ?>
      </div>
    </div>  
    <?php if ($textbg) { ?>
    <style>
      #repeatable_<?php echo get_row_layout() ?>_<?php echo $ctr ?> .textCol,
      #repeatable_<?php echo get_row_layout() ?>_<?php echo $ctr ?> .padleft {
        background-color:<?php echo $textbg ?>;
      }
    </style>
    <?php } ?>
  </section>
  <?php } ?>
<?php } ?>