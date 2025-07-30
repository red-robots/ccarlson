<?php if( get_row_layout() == 'affiliations' ) {
  $title = get_sub_field('title');
  $gallery = get_sub_field('gallery');
  $disable_section = get_sub_field('disable_section');
  $is_visible = ($disable_section) ? false : true;
  if( $gallery ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?>">
    <div class="wrapper">
      <?php if ($title) { ?>
      <div class="titleDiv">
        <h2 class="h2"><?php echo $title ?></h2>
      </div>
      <?php } ?>
      <div class="flexwrap">
      <?php foreach ($gallery as $img) { 
        $id = $img['ID'];
        $link = get_field('websiteurl', $id);
        ?>
        <figure class="company-logo">
        <?php if ($link) { ?>
          <a href="<?php echo $link ?>" target="_blank">
            <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>" />
          </a>
        <?php } else { ?>
          <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>" />
        <?php } ?>
        </figure>
      <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>
<?php } ?>