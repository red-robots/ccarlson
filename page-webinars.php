<?php
/**
 * Template Name: Webinars/Events
 */
get_header(); 
?>

<main id="main" class="site-main webinars" role="main">
  <?php while ( have_posts() ) : the_post(); ?>
    <?php  
    $staff_assigned = get_field('staff_assigned');
    $section_title1 = get_field('section_title1');
    $intro_text1 = get_field('intro_text1');
    $post_type1 = get_field('post_type1');
    if($post_type1) {
      $event_args = array(
        'posts_per_page'   => 3,
        'post_type'        => $post_type1,
        'post_status'      => 'publish',
        'meta_key' => 'start_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
      );
      $events = new WP_Query($event_args); ?>

      <?php if($section_title1 || $events->have_posts()) {  ?>
      <section class="section-post-feeds post-<?php echo $post_type1 ?>">
        <div class="wrapper">
          <div class="intro">
            <?php if($section_title1) { ?>
              <div class="section-title"><h2><?php echo $section_title1 ?></h2></div>
            <?php } ?>
            <?php if($intro_text1) { ?>
              <div class="section-intro"><?php echo anti_email_spam($intro_text1); ?></div>
            <?php } ?>
          </div>
          <?php if ( $events->have_posts() ) {  ?>
            <div class="post-feeds">
              <div class="leftCol">
                <?php $i=1; while ( $events->have_posts() ) : $events->the_post(); 
                  $id = get_the_ID();
                  $thumbID = get_post_thumbnail_id($id);
                  $img = ($thumbID) ? wp_get_attachment_image_src($thumbID,'large') : '';
                  $imgAlt = ($img) ? get_the_title($thumbID) : '';
                  $start_date = get_field('start_date', $id);
                  $start_date = ($start_date) ? date('F j, Y', strtotime($start_date)) : '';
                  $content = ( get_the_content() ) ? strip_tags(get_the_content()) : '';
                  $content = ($content) ? shortenText($content, 250, ' ') : '';
                  $excerpt = get_field('excerpt', $id);
                  if($excerpt) {
                    $content = $excerpt;
                  }
                  ?>
                  <?php if ($i==1) { ?>
                  <figure class="post-image">
                    <a href="<?php echo get_permalink() ?>">
                      <img src="<?php echo $img[0] ?>" alt="<?php echo $imgAlt ?>">
                    </a>
                  </figure>
                  <div class="details">
                    <?php if ($start_date) { ?>
                    <div class="event-date"><?php echo $start_date ?></div>
                    <?php } ?>
                    <h3><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h3>
                    <?php if ( get_the_content() ) { ?>
                    <div class="excerpt">
                      <?php echo $content; ?>
                    </div>
                    <?php } ?>
                  </div>
                  <?php } ?>
                <?php $i++; endwhile; wp_reset_postdata(); ?>
              </div>

              <div class="rightCol">
                <?php if ($staff_assigned) { ?>
                <div class="staff-infocard">
                  <div class="card-gradient">
                    <ul class="listing">
                    <?php foreach ($staff_assigned as $staff) { 
                      $pid = $staff->ID;
                      $name = $staff->post_title;
                      $job = get_field('title', $pid);
                      $email = get_field('email', $pid);
                      $photo = get_field('photo', $pid);
                      $row_class = ($name && $photo) ? 'twocol':'onecol';
                      ?>
                      <li class="<?php echo $row_class ?>">
                        <figure class="photo">
                          <?php if ( isset($photo['url']) ) { ?>
                          <img src="<?php echo $photo['url'] ?>" alt="<?php echo $photo['title'] ?>" />
                          <?php } else { ?>
                          <span class="no-image"><i class="fa-solid fa-user"></i></span>
                          <?php } ?>
                        </figure>

                        <?php if ($name) { ?>
                        <div class="info">
                          <h3 class="name"><?php echo $name ?></h3>
                          <?php if ($job) { ?>
                          <div class="job"><?php echo $job ?></div>
                          <?php } ?>
                          <?php if ($email) { ?>
                          <div class="email"><a href="mailto:<?php echo antispambot($email,1) ?>"><?php echo antispambot($email) ?></a></div>
                          <?php } ?>
                        </div>
                        <?php } ?>
                      </li>
                    <?php } ?>
                    </ul>
                  </div>
                </div>
                <?php } ?>
                <ul class="feeds">
                <?php $n=1; while ( $events->have_posts() ) : $events->the_post(); 
                  $id = get_the_ID();
                  $thumbID = get_post_thumbnail_id($id);
                  $img = ($thumbID) ? wp_get_attachment_image_src($thumbID,'large') : '';
                  $imgAlt = ($img) ? get_the_title($thumbID) : '';
                  $start_date = get_field('start_date', $id);
                  $start_date = ($start_date) ? date('F j, Y', strtotime($start_date)) : '';
                  $content = ( get_the_content() ) ? strip_tags(get_the_content()) : '';
                  $content = ($content) ? shortenText($content, 60, ' ') : '';
                  $excerpt = get_field('excerpt', $id);
                  if($excerpt) {
                    $content = $excerpt;
                  }
                ?>
                  <?php if ($n>1) { ?>
                    <li class="item">
                      <div class="inside">
                        <?php if ($img) { ?>
                        <figure class="post-image">
                          <a href="<?php echo get_permalink() ?>">
                            <img src="<?php echo $img[0] ?>" alt="<?php echo $imgAlt ?>">
                          </a>
                        </figure> 
                        <?php } ?>

                        <div class="details">
                          <?php if ($start_date) { ?>
                          <div class="event-date"><?php echo $start_date ?></div>
                          <?php } ?>
                          <h3><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h3>
                          <?php if ( get_the_content() ) { ?>
                          <div class="excerpt">
                            <?php echo $content; ?>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </li>
                  <?php } ?>
                <?php $n++; endwhile; wp_reset_postdata(); ?>
                </ul>
              </div>
            </div>
          <?php } ?>
        </div>
      </section>  
      <?php } ?>
    <?php } ?>


    <?php  
    $section_title2 = get_field('section_title2');
    $intro_text2 = get_field('intro_text2');
    $post_type2 = get_field('post_type2');
    $paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
    $perpage = 6;
    if($post_type2) {
      $webinar_args = array(
        'posts_per_page'   => $perpage,
        'post_type'        => $post_type2,
        'post_status'      => 'publish',
        'meta_key' => 'start_date',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'paged'     => $paged,
      );
      $webinars = new WP_Query($webinar_args);
      if( $section_title2 || $webinars->have_posts() ) { 
        $total_post = $webinars->found_posts; ?>
        <section class="section-post-feeds post-<?php echo $post_type2 ?>">
          <div class="wrapper webinar-container">
            <div class="intro">
              <?php if($section_title2) { ?>
                <div class="section-title"><h2><?php echo $section_title2 ?></h2></div>
              <?php } ?>
              <?php if($intro_text2) { ?>
                <div class="section-intro"><?php echo anti_email_spam($intro_text2); ?></div>
              <?php } ?>
            </div>
            <?php if ( $webinars->have_posts() ) {  ?>
            <div class="webinars-feeds">
              <div class="webinars">
              <?php while ( $webinars->have_posts() ) : $webinars->the_post(); 
                $id = get_the_ID();
                $videoURL = get_field('video_link', $id);
                $w_start_date = get_field('start_date', $id);
                $w_start_date = ($w_start_date) ? date('F j, Y', strtotime($w_start_date)) : '';
                ?>
                <div class="webinar">
                  <?php if ($videoURL) { 
                    /* YOUTUBE VIDEO */
                    $youtubeId = extractYoutubeId($videoURL);
                    $embed_url = '';
                    if($youtubeId) {
                      $embed_url = 'https://www.youtube.com/embed/'.$youtubeId.'?version=3&rel=0&loop=0'; 
                      //$mainImage = 'https://i.ytimg.com/vi/'.$youtubeId.'/maxresdefault.jpg';
                    }

                    /* VIMEO VIDEO */ 
                    $vimeoId = extractVimdeoId($videoURL);

                    // if( strpos( strtolower($videoURL), 'vimeo.com') !== false ) { 
                    //   $vimeo_parts = explode("/",$videoURL);
                    //   $parts = ($vimeo_parts && array_filter($vimeo_parts) ) ? array_filter($vimeo_parts) : '';
                    //   $vimeoId = ($parts) ?  preg_replace('/\s+/', '', end($parts)) : '';
                    //   $vimeoData = ($vimeoId) ? get_vimeo_data($vimeoId) : '';
                    //   $data = json_decode( file_get_contents( 'https://vimeo.com/api/oembed.json?url=' . $videoURL ) );
                    //   $vimeoImage = ($data) ? $data->thumbnail_url : '';
                    // }
                  ?>
                  <figure class="video-frame">
                    <?php if ($youtubeId) { ?>
                      <iframe class="videoIframe iframe-youtube" data-vid="youtube" src="<?php echo $embed_url; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <?php } ?>

                    <?php if ($vimeoId) { ?>
                      <iframe class="videoIframe iframe-vimeo" data-vid="vimeo" src="https://player.vimeo.com/video/<?php echo $vimeoId?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                    <?php } ?>
                  </figure>
                  <?php } ?>

                  <div class="details">
                    <?php if ($w_start_date) { ?>
                    <div class="event-date"><?php echo $w_start_date ?></div>
                    <?php } ?>
                    <h3 class="event-name"><?php echo get_the_title() ?></h3>
                    <?php if ( get_the_content() ) { ?>
                    <div class="excerpt">
                      <?php the_content(); ?>
                    </div>
                    <?php } ?>
                    <?php if ($videoURL) { ?>
                    <div class="button-wrap">
                      <a href="<?php echo $videoURL ?>" data-fancybox class="button-outline-blue button-watch">Watch</a>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              <?php endwhile; wp_reset_postdata(); ?>
              </div>
            </div>
            <?php } ?>
          </div>
          <div id="hiddenEntries" style="display:none"></div>

          <?php if ($total_post > $perpage) { 
            $total_pages = ceil($total_post / $perpage);
            ?>
            <div id="pagination" class="pagination" style="display:none;">
              <?php
                  $pagination = array(
                    'base' => @add_query_arg('pg','%#%'),
                    'format' => '?paged=%#%',
                    'current' => $paged,
                    'total' => $total_pages,
                    'prev_text' => __( '&laquo;', 'red_partners' ),
                    'next_text' => __( '&raquo;', 'red_partners' ),
                    'type' => 'plain'
                  );
                echo paginate_links($pagination);
              ?>
            </div>
            <div class="load-more">
              <button class="more-button btn-solid" id="loadMoreBtn" data-baseurl="<?php echo get_permalink(); ?>" data-next="2" data-total-pages="<?php echo $total_pages ?>">Load More</button>
            </div>
          <?php } ?>
        </section>
      <?php } ?>
    <?php } ?>

  <?php endwhile; ?>

	<?php if( have_rows('flexible_content') ) {  ?>
  <div class="flexible-content-wrapper">
    <?php $ctr=1; while( have_rows('flexible_content') ): the_row(); ?>
      
    <?php include( locate_template('parts/content-repeater.php') ); ?>

    <?php $ctr++; endwhile; ?>
  </div>
  <?php } ?>

</main>

<script>
jQuery(document).ready(function($){
  $(document).on('click', '#loadMoreBtn', function(e){
    e.preventDefault();
    var moreBtn = $(this);
    var d = new Date();
    var baseUrl = $(this).attr('data-baseurl');
    var next = parseInt( $(this).attr('data-next') );
    var nextNum = next+1;
    var total = parseInt( $(this).attr('data-total-pages') );
    var nextPageUrl = baseUrl + '?pg=' + next;
    moreBtn.attr('data-next', nextNum);
    if(total >= next) {
      $('#hiddenEntries').load(nextPageUrl+' .webinars-feeds .webinars', function(data){
        if( $('#hiddenEntries .webinar').length ) {
          $('#hiddenEntries .webinar').each(function(){
            $(this).addClass('fadeIn').appendTo('.webinar-container .webinars');
          });
        }
      });
    }
    if(nextNum>total) {
        moreBtn.parent().hide();
    }    
  });
});
</script>

<?php
get_footer();