<?php if( get_row_layout() == 'postcard' ) {
  $details_position = get_sub_field('details_position');
  $details = get_sub_field('details');
  $buttons = get_sub_field('buttons');
  $featured_image = get_sub_field('featured_image');
  $textcolor = get_sub_field('textcolor');
  $bgcolor = get_sub_field('bgcolor');
  $h2color = get_sub_field('h2color');

  $is_split = ($details && $featured_image) ? 'half' : 'full';
  $disable_section = get_sub_field('disable_section');
  $is_visible = ($disable_section) ? false : true;
  if( $is_visible && ($details || $featured_image) ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?>">
    <style>
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> {
        background-color: <?php echo $bgcolor ?>;
        color:<?php echo $textcolor ?>;
      }
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> .textBlock h2,
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> .textBlock h3,
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> .textBlock p {
        color:<?php echo $textcolor ?>;
      }
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> .textBlock a {
        color:<?php echo $textcolor ?>;
      }
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> h2 {
        color:<?php echo $h2color ?>!important;
      }
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> ul {
        margin: 0 0;
        padding: 0 0 0 8px;
        list-style: none;
      }
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> ul > li {
        position: relative;
        list-style: none;
        margin: 20px 0;
        padding-left: 16px;
      }
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> ul > li:before {
        content:"";
        display: block;
        width: 7px;
        height: 7px;
        border-radius: 100px;
        background-color: <?php echo $h2color ?>;
        position: absolute;
        top: 7px;
        left: 0;
      }
    </style>
    <div class="flexwrap details-<?php echo $details_position ?> <?php echo $is_split ?>">
      <?php if ($details) { ?>
      <div class="flexcol textBlock">
        <div class="inner"><?php echo anti_email_spam($details); ?></div>
        <?php if ($buttons) { ?>
        <div class="button-wrapper">
          <?php foreach ($buttons as $b) { 
            $btn = $b['button'];
            $btnName = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
            $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
            $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
            if($btnName && $btnLink) { ?>
            <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button-common"><span><?php echo $btnName ?></span></a>
            <?php } ?>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($featured_image) { ?>
      <div class="flexcol imageBlock">
        <div class="image" style="background-image:url('<?php echo $featured_image['url'] ?>')"></div>
      </div>
      <?php } ?>
    </div>
  </section>
  <?php } ?>
<?php } ?>