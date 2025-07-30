<?php if( get_row_layout() == 'two_column_text' ) {
  $column_info = get_sub_field('column_info');
  $disable_section = get_sub_field('disable_section');
  $is_visible = ($disable_section) ? false : true;
  if( $is_visible && ($column_info) ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?>">
    <div class="wrapper">
      <div class="flexwrap">
        <?php foreach ($column_info as $col) { 
          $title = $col['title'];
          $details = $col['details'];
          $image = $col['image'];
          if($title || $details || $image) { ?>
          <div class="flexcol">
            <?php if ($title) { ?>
              <h2 class="h2"><?php echo $title ?></h2>
            <?php } ?>
            <?php if ($details) { ?>
            <div class="details"><?php echo anti_email_spam($details); ?></div>
            <?php } ?>
            <?php if ($image) { ?>
            <figure class="feat-image">
              <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" />
            </figure>
            <?php } ?>
          </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>
<?php } ?>