<?php 
$carouselItems = get_field('projects_selection');
if( is_archive() ) {
  $queried_object = get_queried_object(); 
  $taxonomy = ( isset($queried_object->taxonomy) && $queried_object->taxonomy ) ? $queried_object->taxonomy : '';
  if($taxonomy=='project-category') {
    $carouselItems = get_field('projects_selection',18);
  }
}

if( $carouselItems ) { ?>
<?php  
  $firstBatch = array();
  $paged = ( isset($_GET['spg']) && $_GET['spg'] ) ? $_GET['spg'] : 1;
?>
<div id="carouselData" class="carousel-wrapper" data-perview="5" data-page="1" data-baseUrl="<?php echo get_permalink(); ?>">
  <div class="carousel-inner">
    <div id="carousel" class="owl-carousel">
      
      <?php foreach ($carouselItems as $c) { 
        $pid = $c->ID;
        $img = get_field('main_photo', $pid);
        $firstBatch[] = $c->ID;
        if($img) { ?>
        <a href="<?php echo get_permalink($pid)?>" class="thumbnail" data-pid="<?php echo $pid ?>" data-title="<?php echo $c->post_title ?>">
          <div class="frame"></div>
          <div class="img" style="background-image:url('<?php echo $img['sizes']['medium'] ?>')"></div>
        </a>
        <?php } ?>
      <?php } ?>

      <?php  
      $args = array(
        'posts_per_page'=> 5,
        'post_type'     => 'projects',
        'post_status'   => 'publish',
        'paged'         => $paged
      );

      if($firstBatch) {
        $args['post__not_in'] = $firstBatch;
      }

      $projects = new WP_Query($args);
      if ( $projects->have_posts() ) { ?>
        <?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
          <?php if( $img = get_field('main_photo') ) { ?>
          <a href="<?php echo get_permalink()?>" class="thumbnail" data-pid="<?php the_ID(); ?>" data-title="<?php echo get_the_title(); ?>">
            <div class="frame"></div>
            <div class="img" style="background-image:url('<?php echo $img['sizes']['medium'] ?>')"></div>
          </a>
          <?php } ?>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php } ?>

    </div>

    <a href="javascript:void(0)" data-action="previous" class="customControl control-previous"><span class="sr">Previous</span></a>
    <a href="javascript:void(0)" data-action="next" class="customControl control-next"><span class="sr">Next</span></a>
  </div>
  
  <div class="hiddenDataContainer" style="display:none"></div>
  <div class="hiddenData" style="display:none">
    <?php 
      $projects = new WP_Query($args);
      if ( $projects->have_posts() ) { ?>
        <?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
          <?php if( $img = get_field('main_photo') ) { ?>
          <a href="<?php echo get_permalink()?>" class="thumbnail" data-pid="<?php the_ID(); ?>" data-title="<?php echo get_the_title(); ?>">
            <div class="frame"></div>
            <div class="img" style="background-image:url('<?php echo $img['url'] ?>')"></div>
          </a>
          <?php } ?>
        <?php endwhile; wp_reset_postdata(); ?>
    <?php } ?>
  </div>

</div>

<?php } ?>