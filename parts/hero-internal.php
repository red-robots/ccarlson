<?php 
$static_image = get_field('hero_image');
$hero_page_title = get_field('custom_page_title');
$custom_page_title = ($hero_page_title) ? $hero_page_title : get_the_title();
if ($static_image) { ?>
<section class="hero-internal">
  <div class="hero-inside">
    <?php if ($custom_page_title) { ?>
    <div class="hero-title">
      <div class="inner"><h1 class="custom-page-title"><?php echo $custom_page_title ?></h1></div>
    </div>
    <?php } ?>
    <figure class="hero-image">
      <img src="<?php echo $static_image['url'] ?>" alt="<?php echo $static_image['title'] ?>" role="presentation">
    </figure>
  </div>
</section>
<?php } ?>