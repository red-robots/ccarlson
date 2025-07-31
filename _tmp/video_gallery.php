<?php if( get_row_layout() == 'video_gallery' ) {
  $section_intro = get_sub_field('section_intro');
  $videos = get_sub_field('videos');
  $numcols = get_sub_field('numcols_video');
  $numcols = ($numcols) ? $numcols : 3;
  $textcolor_video = get_sub_field('textcolor_video');
  $bgcolor = get_sub_field('bgcolor_video');
  $bgpattern = get_sub_field('bgpattern_video');
  $has_pattern = ($bgpattern) ? ' has-pattern':' no-pattern';
  $disable_section = get_sub_field('disable_section');
  $is_visible = ($disable_section) ? false : true;
  if( $is_visible && $videos ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?><?php echo $has_pattern ?>">
    <style>
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> {
        background-color: <?php echo $bgcolor ?>;
      }
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> .section-intro,
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> .section-intro h2,
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> .section-intro h3,
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> .section-intro p {
        color: <?php echo ($textcolor_video) ? $textcolor_video : '#000'; ?>;
      }
    </style>
    <div class="wrapper">
      <?php if ($section_intro) { ?>
      <div class="section-intro section-intro-center">
        <?php echo anti_email_spam($section_intro); ?>
      </div>  
      <?php } ?>
      <div class="infoCards numcols-<?php echo $numcols ?>">
        <?php foreach ($videos as $v) { 
          $videoUrl  = $v['videoUrl'];
          if($videoUrl) { ?>
          <div class="infoCard">
            <div class="inner">
              <?php  
              $youtubeId = extractYoutubeId($videoUrl);
              $vimeoId = extractVimdeoId($videoUrl); 

              $youtube_embed = ($youtubeId) ? 'https://www.youtube.com/embed/'.$youtubeId.'?version=3&rel=0&loop=0' : '';
              $vimeo_embed = ($vimeoId) ? 'https://player.vimeo.com/video/'.$vimeoId : '';
              ?>
              <?php if ($youtubeId) { ?>
                <div class="video-frame">
                  <div class="video-inner">
                    <iframe class="videoIframe iframe-youtube" data-vid="youtube" src="<?php echo $youtube_embed; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
                </div>
              <?php } ?>

              <?php if ($vimeoId) { ?>
                <div class="video-frame">
                  <div class="video-inner">
                    <iframe class="videoIframe iframe-vimeo" data-vid="vimeo" src="<?php echo $vimeo_embed?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>
<?php } ?>
