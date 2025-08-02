<?php if( get_row_layout() == 'portfolio_category' ) {
$show_title_text = get_sub_field('show_title_text');
$number_items = get_sub_field('number_items');
$btn = get_sub_field('button');
$btnName = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
$btnUrl = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
$btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';

$taxonomy = 'artwork-category';
$tax_args = array(
  'taxonomy'   => $taxonomy,
  'post_types' => array('portfolio'), 
  'hide_empty' => false, 
);
$section_title = '';
$section_text = '';
if($show_title_text) {
  foreach($show_title_text as $opt) {
    if($opt=='title') {
      $section_title = get_sub_field('section_title');
    }
    if($opt=='text') {
      $section_text = get_sub_field('section_text');
    }
  }
}

$portfolio_categories = get_terms($tax_args);
  if($portfolio_categories) { ?>
  <section id="repeatable_<?php echo get_row_layout() ?>_<?php echo $ctr ?>" data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
    <?php if ($section_title || $section_text) { ?>
    <div class="section-intro">
      <div class="wrapper">
        <?php if ($section_title) { ?>
         <h2 class="section-title"><?php echo $section_title ?></h2> 
        <?php } ?>
        <?php if ($section_text) { ?>
         <div class="section-text"><?php echo anti_email_spam($section_text); ?></div> 
        <?php } ?>
      </div>
    </div> 
    <?php } ?>

    <div class="wrapper">
      <div class="flexColumns">
        <?php $i=1; foreach ($portfolio_categories as $term) { 
          $termId = $term->term_id;
          $termName = $term->name;
          $termImage = get_field('category_image', $taxonomy . '_' . $termId); 
          $termLink = get_term_link($term,$taxonomy);
          $delay = 300 + ($i*50);
          if($termImage) { ?>
          <div class="flexCol">
            <a href="<?php echo $termLink ?>" class="imageLink">
              <figure>
                <div class="image">
                  <img src="<?php echo $termImage['url'] ?>" alt="<?php echo $termImage['title'] ?>" />
                </div>
                <figcaption><?php echo $termName ?></figcaption>
              </figure>
            </a>
          </div>
          <?php $i++; } ?>
        <?php } ?>
      </div>

      <?php if($btnName && $btnUrl) { ?>
      <div class="buttons">
        <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>" class="button"><span><?php echo $btnName ?></span></a>
      </div>
      <?php } ?>

    </div>  
  </section>
  <?php } ?>
<?php } ?>