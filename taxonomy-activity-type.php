<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */

get_header();
global $obj;
//$obj = get_queried_object();
$current_term_id = $obj->term_id;
$current_term_slug = $obj->slug;
$current_term_name = $obj->name;
$taxonomy = $obj->taxonomy;
$has_cat_description = ( category_description( $current_term_id ) ) ? 'has-cat-desc' : 'no-cat-desc';
?>

<div id="primary" data-term="<?php echo $current_term_name ?>" class="content-area-full taxonomy-content taxonomy-<?php echo $current_term_slug ?> <?php echo $has_cat_description ?>">
  <main id="main" class="site-main" role="main">
    <?php if ( category_description( $current_term_id ) ) { ?>
    <div class="wrapper cat-description">
      <?php echo anti_email_spam(category_description( $current_term_id )); ?>
    </div>
    <?php } ?>

    <?php  
    $args = array(
      'post_type'   =>'activities',
      'post_status' =>'publish',
      'posts_per_page'  => -1,
      'tax_query' => array(
        array(
          'taxonomy'  => 'activity-type', 
          'field'   => 'term_id',
          'terms'   => array( $current_term_id ) 
        )
      )
    );
    $posts = new WP_Query($args);
    if ($posts->have_posts()) { $count = $posts->found_posts;?>
    <div class="taxonomy-posts count-<?php echo $count?>">
      <div class="flexwrap">
        <?php while ($posts->have_posts()) : $posts->the_post(); 
          $main_photo = get_field('main_photo');
          $imgStyle = ($main_photo) ? ' style="background-image:url('.$main_photo['url'].')"':''
          ?>
          <div class="item">
            <div class="wrap">
              <figure<?php echo $imgStyle?>>
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/rectangle-lg.png" alt="">
              </figure>
              <div class="info">
                <h3 class="name"><?php the_title(); ?></h3>
                <div class="buttondiv">
                  <a href="<?php echo get_permalink() ?>" class="button">Learn More</a>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
    <?php } ?>
  </main>
</div>

<?php
get_footer();
