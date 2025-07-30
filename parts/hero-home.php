<?php 
$hero_type = get_field('hero_type');
$static = get_field('static_image');
$static_image = (isset($static['image'])) ? $static['image'] : '';
$static_title = (isset($static['title'])) ? $static['title'] : '';
$static_description = (isset($static['description'])) ? $static['description'] : '';
$static_button = (isset($static['button'])) ? $static['button'] : '';
$sliderImages = get_field('slider');

//STATIC IMAGE
if ($hero_type=='static') { ?>

  <?php if ($static_image) { ?>
  <section class="hero hero-<?php echo $hero_type ?>">
    <?php 
    $slideTitle = $static_title;
    $slideText = $static_description;
    $slideButton = $static_button;
    $slideImage = $static_image;
    $btnName = (isset($static_button['title']) && $static_button['title']) ? $static_button['title'] : '';
    $btnLink = (isset($static_button['url']) && $static_button['url']) ? $static_button['url'] : '';
    $btnTarget = (isset($static_button['target']) && $static_button['target']) ? $static_button['target'] : '';
    ?>
    <div class="static-hero">
      <?php if ($slideTitle || $slideText) { ?>
      <div class="slideCaption">
        <div class="inside">
        <?php if ($slideTitle) { ?>
          <div class="title"><?php echo $slideTitle ?></div>
        <?php } ?>
        <?php if ($slideText) { ?>
          <div class="text"><?php echo $slideText ?></div>
        <?php } ?>
        <?php if ($btnName && $btnLink) { ?>
          <div class="slideButton">
              <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><span><?php echo $btnName ?></span></a>
          </div>
        <?php } ?>
        </div>
      </div>
      <?php } ?>
      <figure class="slideImage">
        <img src="<?php echo $slideImage['url'] ?>" alt="<?php echo $slideImage['title'] ?>" role="presentation">
      </figure>
    </div>
  </section>
  <?php } ?>

  
<?php } else {

  //SLIDESHOW

  if($sliderImages) { $countSlides = count($sliderImages);  ?>
  <section class="hero hero-<?php echo $hero_type ?> count-<?php echo $countSlides ?>">
    <div id="homeSlider" class="swiper-container slideshow">
      <div class="swiper-wrapper">
        <?php foreach ($sliderImages as $s) { 
          $slideImage = $s['slideImage'];
          $slideTitle = $s['slideTitle'];
          $slideText = $s['slideText'];
          $slideButton = $s['slideButton'];
          $btnName = (isset($slideButton['title']) && $slideButton['title']) ? $slideButton['title'] : '';
          $btnLink = (isset($slideButton['url']) && $slideButton['url']) ? $slideButton['url'] : '';
          $btnTarget = (isset($slideButton['target']) && $slideButton['target']) ? $slideButton['target'] : '';
          if($slideImage) { ?>
          <div class="swiper-slide">
            <?php if ($slideTitle || $slideText) { ?>
            <div class="slideCaption">
              <div class="inside">
              <?php if ($slideTitle) { ?>
                <div class="title"><?php echo $slideTitle ?></div>
              <?php } ?>
              <?php if ($slideText) { ?>
                <div class="text"><?php echo $slideText ?></div>
              <?php } ?>
              <?php if ($btnName && $btnLink) { ?>
                <div class="slideButton">
                    <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><span><?php echo $btnName ?></span></a>
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
  </section>
  <?php } ?>

<?php } ?>