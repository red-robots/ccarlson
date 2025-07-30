<?php if( get_row_layout() == 'cards_pattern_background' ) {
  $section_intro = get_sub_field('section_intro');
  $numcols = get_sub_field('numcols');
  $numcols = ($numcols) ? $numcols : 3;
  $cards = get_sub_field('cards');
  $bgcolor = get_sub_field('bgcolor');
  $bgpattern = get_sub_field('bgpattern');
  $has_pattern = ($bgpattern) ? ' has-pattern':' no-pattern';
  $disable_section = get_sub_field('disable_section');
  $is_visible = ($disable_section) ? false : true;
  if( $is_visible && $cards ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?><?php echo $has_pattern ?>">
    <style>
      .repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?> {
        background-color: <?php echo $bgcolor ?>;
      }
    </style>
    <div class="wrapper">
      <?php if ($section_intro) { ?>
      <div class="section-intro-center">
        <?php echo anti_email_spam($section_intro); ?>
      </div>  
      <?php } ?>
      <div class="infoCards numcols-<?php echo $numcols ?>">
        <?php foreach ($cards as $c) { 
          $title = $c['title'];
          $details = $c['text'];
          $image_video = $c['image_video'];
          $image = $c['image'];
          $videoUrl = $c['video'];
          if($title || $details || $image) { ?>
          <div class="infoCard">
            <div class="inner">
              <?php if ($image_video=='image') { ?>
                <?php if ($image) { ?>
                <figure class="image">
                  <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" />
                </figure>
                <?php } ?>
              <?php } else { ?>
                <?php if ($videoUrl) { 
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
                <?php } ?>
              <?php } ?>
              
              <?php if($title || $details) { ?>
              <div class="infoText">
                <?php if ($title) { ?>
                  <h2 class="h2"><?php echo $title ?></h2>
                <?php } ?>
                <?php if ($details) { ?>
                <div class="details"><?php echo anti_email_spam($details); ?></div>
                <?php } ?>
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
