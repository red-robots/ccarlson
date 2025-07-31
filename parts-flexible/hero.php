<?php if( get_row_layout() == 'hero' ) {
  $hero_type = get_sub_field('hero_type');
  $hero = get_sub_field('static_image_block');
  $slides = get_sub_field('slideshow');
  $has_hero = false;
  if($hero_type=='static_image') {  
    if( isset($hero['static_image']) && $hero['static_image'] ) {
      $has_hero = true;
    }
  } else {
    if($hero_type=='slider') {  
      if($slides) {
        $has_hero = true;
      }
    }
  }
  if($has_hero) { ?>
  <section id="repeatable_<?php echo get_row_layout() ?>_<?php echo $ctr ?>" data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable_<?php echo get_row_layout() ?> hero-type-<?php echo $hero_type ?>">
    
    <?php /* STATIC IMAGE */ ?>
    <?php if($hero_type=='static_image') { ?>
      <?php if( isset($hero['static_image']) && $hero['static_image'] ) { 
        $heroText = (isset($hero['title']) && $hero['title']) ? $hero['title'] : '';
        $heroDetails = (isset($hero['description']) && $hero['description']) ? $hero['description'] : '';
        $heroButtons = (isset($hero['buttons']) && $hero['buttons']) ? $hero['buttons'] : '';
        $show_caption = (isset($hero['add_caption']) && $hero['add_caption']) ? $hero['add_caption'] : '';
      ?>
      <figure class="static-image">
        <div class="imageWrap">
          <img src="<?php echo $hero['static_image']['url'] ?>" alt="<?php echo $hero['static_image']['title'] ?>" />
        </div>
        <?php if ($show_caption) { ?>
          <?php if($heroText||$heroDetails) { ?>
          <figcaption>
            <div class="imageText">
              <?php if ($heroText) { ?>
              <div class="title"><?php echo $heroText ?></div>
              <?php } ?>
              <?php if ($heroDetails) { ?>
              <div class="text"><?php echo anti_email_spam($heroDetails); ?></div>
              <?php } ?>
              <?php if ($heroButtons) { ?>
              <div class="buttons">
                <?php foreach ($heroButtons as $b) { 
                  $btn = (isset($b['button'])) ? $b['button'] : '';
                  $btnName = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
                  $btnUrl = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
                  $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
                  if($btnName && $btnUrl) { ?>
                  <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>" class="button"><span><?php echo $btnName ?></span></a>
                  <?php } ?>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
          </figcaption>
          <?php } ?>
        <?php } ?>
      </figure>
      <?php } ?>
    <?php } ?>


    <?php /* SLIDESHOW */ ?>
    <?php if($hero_type=='slider') { ?>
      <?php if($slides) { ?>
      <div class="hero-slider">
        <div class="swiper-container slideshow" id="slideshow_<?php echo get_row_layout() ?>_<?php echo $ctr ?>">
          <div class="swiper-wrapper">
            <?php foreach ($slides as $s) { 
              $slideImage = $s['image'];
              $slideTitle = $s['title'];
              $slideText = $s['description'];
              $slideButtons = $s['buttons'];
              if($slideImage) { ?>
              <div class="swiper-slide">
                <?php if ($slideTitle || $slideText) { ?>
                <div class="slideCaption">
                  <div class="wrap">
                    <?php if ($slideTitle) { ?>
                    <div class="title"><?php echo $slideTitle ?></div>
                    <?php } ?>
                    <?php if ($slideText) { ?>
                    <div class="text"><?php echo anti_email_spam($slideText); ?></div>
                    <?php } ?>
                    <?php if ($slideButtons) { ?>
                    <div class="buttons">
                      <?php foreach ($slideButtons as $b) { 
                        $btn = (isset($b['button'])) ? $b['button'] : '';
                        $btnName = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
                        $btnUrl = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
                        $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
                        if($btnName && $btnUrl) { ?>
                        <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>" class="button"><span><?php echo $btnName ?></span></a>
                        <?php } ?>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <?php } ?>
                <div class="slideImage" style="background-image:url('<?php echo $slideImage['url'] ?>')"></div>
              </div>  
              <?php } ?>
            <?php } ?>
          </div>
          <div class="swiper-pagination"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </div>
      <?php } ?>
    <?php } ?>

  </section>
  <?php } ?>
<?php } ?>