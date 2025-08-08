<?php
/**
 * Template Name: Portfolio
 */

get_header(); 
$filter_category = ( isset($_GET['category']) && $_GET['category'] ) ? $_GET['category'] : '';
$perpage = 6;
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$currentPageLink = get_permalink();
$taxonomy = 'artwork-category';
$post_type = 'portfolio';
$tax_args = array(
  'taxonomy'   => $taxonomy,
  'post_types' => array($post_type), 
  'hide_empty' => false, 
);
$categories = get_terms($tax_args);
$is_current_name = 'All';
if ($categories) {
  if($filter_category) {
    foreach ($categories as $tm) { 
      if($filter_category==$tm->slug) {
        $is_current_name = $tm->name;
      }
    }
  }
}
?>

<?php if ($categories) { ?>
<div class="category-container">
  <div class="desktop-category-selection">
    <div class="flexwrap">
      <a href="<?php echo get_permalink() ?>" class="link all<?php echo (empty($filter_category)) ? ' current':''; ?>">All</a>
      <?php foreach ($categories as $term) { 
        $termId = $term->term_id;
        $termSlug = $term->slug;
        $termName = $term->name;
        $pagelink = get_permalink() . '?category=' . $termSlug;
        $is_current = ($filter_category==$termSlug) ? ' current':'';
      ?>
      <a href="<?php echo $pagelink ?>" data-catid="<?php echo $termId ?>" class="link<?php echo $is_current ?>"><?php echo $termName ?></a>  
      <?php } ?>
    </div>
  </div>

  <div class="mobile-category-selections">
    <div class="selections">
      <button class="select-category-btn" aria-expanded="false" aria-controls="CategorySelections"><span><?php echo $is_current_name ?></span> <i class="fa-solid fa-chevron-down"></i></button>
      <ul id="CategorySelections" class="category-selections">
        <li><a href="<?php echo get_permalink() ?>" class="mobile--link all<?php echo (empty($filter_category)) ? ' current':''; ?>">All</a></li>
        <?php foreach ($categories as $term) { 
          $termId = $term->term_id;
          $termSlug = $term->slug;
          $termName = $term->name;
          $pagelink = get_permalink() . '?category=' . $termSlug;
          $is_current = ($filter_category==$termSlug) ? ' current':'';
          ?>
          <li><a href="<?php echo $pagelink ?>" data-catid="<?php echo $termId ?>" class="mobile--link<?php echo $is_current ?>"><?php echo $termName ?></a></li> 
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
<?php } ?>

<div id="primary" class="content-area portfolio-content">
  <main id="main" class="site-main" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php if ( get_the_content() ) { ?>
      <div class="entry-content">
        <div class="wrapper"><?php the_content(); ?></div>
      </div>
      <?php } ?>
    <?php endwhile; ?>  

    <?php  
      $args = array(
        'posts_per_page'   => $perpage,
        'paged'            => $paged,
        'post_type'        => $post_type,
        'post_status'      => 'publish'
      );

      if($filter_category) {
        $args['tax_query'] = array(
          array(
            'taxonomy' => $taxonomy,
            'terms' => $filter_category,
            'field' => 'slug',
            'include_children' => true,
            'operator' => 'IN'
          )
        );
      }

      $entries = new WP_Query($args);
      if ( $entries->have_posts() ) { ?>
      <section id="entries" class="gallery-list">
        <div class="wrapper grid-items-wrapper">
          <div class="flexwrap masonry grid">
            <?php while ( $entries->have_posts() ) : $entries->the_post(); 
              $product_title = get_the_title();
              $main_photo = get_field('main_photo');
              $painting_size = get_field('painting_size');
              $price = get_field('price');
              $popup_caption = '<span>'.strtoupper($product_title).'</span>';
              if($painting_size) {
                $popup_caption .= '<span>'.$painting_size.'</span>';
              }
              if($price) {
                $popup_caption .= '<span>'.$price.'</span>';
              }
              // $caption_args = array(strtoupper($product_title),$size,$price);
              // if( $caption_args = array_filter($caption_args) ) {
              //   $popup_caption = implode('  ', $caption_args);
              // }

              $popup_caption = ($popup_caption) ? " data-caption='".$popup_caption."'" : "";

              if($main_photo) { ?>
              <div class="grid-sizer"></div>
              <div class="fbox grid-item">
                <figure class="the-image">
                  <a href="<?php echo $main_photo['url'] ?>" class="imageLink popup-gallery" data-fancybox="gallery"<?php echo $popup_caption ?>>
                    <img src="<?php echo $main_photo['url'] ?>" alt="<?php echo $main_photo['title'] ?>" />
                    <figcaption>
                      <div class="title"><?php echo $product_title ?></div>
                      <?php if ($painting_size) { ?>
                      <div class="size"><?php echo $painting_size ?></div>
                      <?php } ?>
                      <?php if ($price) { ?>
                      <div class="price"><?php echo $price ?></div>
                      <?php } ?>
                    </figcaption>
                  </a>
                </figure>
              </div>
              <?php } ?>
            <?php endwhile; wp_reset_postdata(); ?>
          </div>
        </div>

        <div id="stophere"></div>

        <?php
          $total_pages = $entries->max_num_pages;
          if ($total_pages > 1){ ?> 
          <div class="load-more-wrap">
            <button id="load-more-btn" data-current="1" data-baseurl="<?php echo $currentPageLink ?>" data-end="<?php echo $total_pages?>" class="button"><span>Load More</span></button>
          </div>
          <?php } ?>
        <?php } ?>
      </section>
      <div class="hidden-entries" style="display:none;"></div>

  </main>
</div>


<script type="text/javascript">
jQuery(document).ready(function($){
  var $container = $('.masonry');
  $container.imagesLoaded(function() {
    $container.masonry({
      itemSelector: '.grid-item',
      columnWidth: '.grid-sizer',
    });
  });

  

  $(document).on("click","#load-more-btn",function(e){
    e.preventDefault();
    var button = $(this);
    var baseURL = $(this).attr("data-baseurl");
    var currentPageNum = $(this).attr("data-current");
    var nextPageNum = parseInt(currentPageNum) + 1;
    var pageEnd = $(this).attr("data-end");
    var nextURL = baseURL + '?pg=' + nextPageNum;
    button.attr("data-current",nextPageNum);
    if(nextPageNum==pageEnd) {
      $(".load-more-wrap").remove();
    }
    $(".hidden-entries").load(nextURL+" .grid-items-wrapper",function(){
      if( $('#entries .masonry #firstAppended').length ) {
        $('#entries .masonry #firstAppended').removeAttr('id');
      }

      if( $(".hidden-entries").find(".fbox").length>0 ) {
        $(".hidden-entries").find(".fbox").each(function(k){
          if(k==0) {
            $(this).attr('id','firstAppended');
          }
          $(this).addClass('appended');
          $(this).appendTo('#entries .masonry');
        });

        //var entries = $(".hidden-entries").find(".masonry").html();
        //$("#loaderDiv").addClass("show");
        
        if(entries) {
          $('.masonry').masonry('destroy');
          setTimeout(function(){
            $('.masonry').masonry({
              itemSelector: '.grid-item',
              columnWidth: '.grid-sizer',
            });
          },20);
          setTimeout(function(){
            smoothScroll('#firstAppended');
          },100);
        }
      }

    });
  });

  function smoothScroll(hashTag) {
    var target = $(hashTag);
    if (target.length) {
      $('html, body').animate({
        scrollTop: target.offset().top - 50
      }, 1500, function() {
        target.focus();
        if (target.is(":focus")) {
          return false;
        } else {
          target.attr('tabindex','-1');
          target.focus(); 
        };
      });
    }
  }
});
</script>
<?php
get_footer();
