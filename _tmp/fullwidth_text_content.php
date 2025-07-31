<?php if( get_row_layout() == 'fullwidth_text_content' ) {
  $text_content = get_sub_field('text_content');
  $buttons = get_sub_field('buttons');
  $textcolor = get_sub_field('textcolor');
  $bgcolor = get_sub_field('bgcolor');
  //$disable_section = get_sub_field('disable_section');
  //$is_visible = ($disable_section) ? false : true;
  if( $text_content ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?>">
    <style type="text/css">
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> .fullwidth {
        background-color: <?php echo $bgcolor ?>;
        color: <?php echo $textcolor ?>;
      }
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> *:not(a):not(a span) {
        color: <?php echo $textcolor ?>!important;
      }
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> .button-wrapper {
        display: flex;
        justify-content: center;
        gap: 1em;
      }
    </style>
    <div class="fullwidth">
      <div class="wrapper">
        <div class="textblock">
          <?php echo anti_email_spam($text_content); ?>
        </div>
        <?php if ($buttons) { ?>
        <div class="button-wrapper">
          <?php foreach ($buttons as $b) { 
            $btn = $b['button'];
            $btnName = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
            $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
            $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
            if($btnName && $btnLink) { ?>
            <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button-outline"><span><?php echo $btnName ?></span></a>
            <?php } ?>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>
<?php } ?>