<?php
get_header(); 
?>
<main id="main" class="site-main" role="main">
  <?php while ( have_posts() ) : the_post(); ?>
  <h1 style="display:none;"><?php the_title(); ?></h1>
  
  <?php /* CTAS */ ?>
  <?php if ( $ctas = get_field('ctas') ) { ?>
  <section class="row1-section ctas-section">
    <div class="wrapper">
      <div class="infoCards">
      <?php foreach ($ctas as $cta) { 
        $icon = $cta['icon'];
        $title = $cta['title'];
        $text = $cta['text'];
        $btn = $cta['button'];
        $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
        $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
        $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
        if ($title || $text) {  ?>
        <div class="infoCard">
          <div class="inside">
            <div class="top">
              <?php if ($icon) { ?>
              <div class="infoIcon"><span style="background-image: url('<?php echo $icon['url'] ?>');"></span></div>  
              <?php } ?>
              <?php if ($title) { ?>
              <div class="infoTitle"><?php echo $title ?></div>  
              <?php } ?>
              <?php if ($text) { ?>
              <div class="infoText"><?php echo $text ?></div>  
              <?php } ?>
            </div>
            <?php if ($btnTitle && $btnLink) { ?>
            <div class="infoButton">
              <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="btn-default"><?php echo $btnTitle ?></a>
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

  
  <?php /* MAKING DIFFERENCE */ ?>
  <?php  
  $row2_intro = get_field('row2_intro');
  $row2_buttons = get_field('row2_buttons');
  $row2_feat_image = get_field('row2_featured_image');
  //$row2_data = get_field('row2_accordion');
  //$row2_title = (isset($row2_data['title']) && $row2_data['title']) ? $row2_data['title'] : '';
  ;//$row2_accordion = (isset($row2_data['accordion_items']) && $row2_data['accordion_items']) ? $row2_data['accordion_items'] : '';
  $row2_links = get_field('row2_links');
  $row2_title = (isset($row2_links['title']) && $row2_links['title']) ? $row2_links['title'] : '';
  $row2_link_list = (isset($row2_links['links']) && $row2_links['links']) ? $row2_links['links'] : '';
  ?>
  <?php if ($row2_intro || $row2_accordion) { ?>
  <section class="row2-section intro-section">
    <div class="wrapper">
      <div class="columns">
        <?php if ($row2_intro) { ?>
        <div class="fcol fcol1">
          <div class="textwrap"><?php echo anti_email_spam($row2_intro); ?></div>
          <?php if ($row2_buttons) { ?>
          <div class="buttons">
            <?php foreach ($row2_buttons as $b) { 
              $btn = $b['button'];
              $btnName = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
              $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
              $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '';
              if( $btnName && $btnLink ) { ?>
              <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="btn-default"><?php echo $btnName ?></a>
              <?php } ?>
            <?php } ?>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
        
        <?php if ($row2_link_list || $row2_feat_image) { ?>
        <div class="fcol fcol2">
          <?php if ($row2_feat_image) { ?>
          <div class="featured-image clear">
            <figure>
              <img src="<?php echo $row2_feat_image['url'] ?>" alt="<?php echo $row2_feat_image['title'] ?>">
            </figure>
          </div>
          <?php } ?>

          <?php if ($row2_title || $row2_link_list) { ?>
          <div class="infobox">
            <?php if ($row2_title) { ?>
            <h3 class="h3"><span><?php echo $row2_title ?></span></h3>
            <?php } ?>

            <?php if ($row2_link_list) { ?>
            <div class="collapsible-wrapper">
              <ul class="collapsible">
              <?php $i=1; foreach ($row2_link_list as $a) { 
                $btn = ( isset($a['button']) && $a['button'] ) ? $a['button'] : '';
                $a_title = ( isset($btn['title']) && $btn['title'] ) ? $btn['title'] : '';
                $a_link = ( isset($btn['url']) && $btn['url'] ) ? $btn['url'] : '';
                $a_target = ( isset($btn['target']) && $btn['target'] ) ? $btn['target'] : '_self';
                if($a_title) { ?>
                <li class="collapsible-item">
                  <a href="<?php echo $a_link ?>" target="<?php echo $a_target ?>" class="collapsible-title"><span><?php echo $a_title ?></span><i class="arrow"></i></a>
                </li>
                <?php $i++; } ?>
              <?php } ?>
              </ul>
            </div>
            <?php } ?>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>


  <?php /* CONTACT COUNTY */ ?>
  <?php  
  $row3_intro = get_field('row3_intro');
  $row3_cards = get_field('row3_cards');
  $row3_phonebook = get_field('row3_phonebook');
  if($row3_intro) { ?>
  <section class="row3-section section-multiple-cards">
    <div class="wrapper">
      <div class="inner">
        <?php if ($row3_intro) { ?>
        <div class="intro"><?php echo anti_email_spam($row3_intro); ?></div>  
        <?php } ?>

        <?php if ($row3_phonebook) { ?>
        <div class="infoCards">
          <?php foreach ($row3_phonebook as $p) { 
            $pid = $p->ID;
            $title = $p->post_title;
            $company = get_field('company', $pid);
            $phone = get_field('phone', $pid);

            // $title = $c['title'];
            // $text = $c['text'];
            // $bottom = $c['bottom'];
            if($title || $text) { ?>
            <div class="infoCard">
              <div class="inside">
                <div class="textwrap">
                  <div class="top">
                    <?php if ($title) { ?>
                    <div class="infoTitle"><?php echo $title ?></div>  
                    <?php } ?>
                    <?php if ($company) { ?>
                    <div class="infoText"><?php echo anti_email_spam($company); ?></div>  
                    <?php } ?>
                  </div>
                  <?php if ($phone) { ?>
                  <div class="infoBottom"><?php echo $phone ?></div>  
                  <?php } ?>
                </div>
              </div>
            </div>
            <?php } ?>
          <?php } ?>
        </div>  
        <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>



  <?php /* TAKE ACTION */ ?>
  <?php  
  $row4_title = get_field('row4_section_title');
  $row4_columns = get_field('row4_columns');
  if($row4_columns) { ?>
  <section class="row4-section">
    <div class="wrapper">
      <?php if ($row4_title) { ?>
      <div class="title-block">
        <h2 class="section-title"><?php echo $row4_title ?></h2>
      </div>  
      <?php } ?>

      <?php if ($row4_columns) { ?>
      <div class="section-columns">
        <?php foreach ($row4_columns as $sc) { 
        $sc_icon = $sc['icon'];
        $sc_title = $sc['title'];
        $sc_text = $sc['text'];
        $sc_btn = $sc['button'];
        $sc_btnTitle = (isset($sc_btn['title']) && $sc_btn['title']) ? $sc_btn['title'] : '';
        $sc_btnLink = (isset($sc_btn['url']) && $sc_btn['url']) ? $sc_btn['url'] : '';
        $sc_btnTarget = (isset($sc_btn['target']) && $sc_btn['target']) ? $sc_btn['target'] : '_self';
        if ($sc_title || $sc_text) {  ?>
          <div class="infoCol">
            <div class="inside">
              <div class="top">
                <?php if ($sc_icon) { ?>
                <div class="infoIcon"><span style="background-image: url('<?php echo $sc_icon['url'] ?>');"></span></div>  
                <?php } ?>
                <?php if ($sc_title) { ?>
                <div class="infoTitle"><span><?php echo $sc_title ?></span></div>  
                <?php } ?>
                <?php if ($sc_text) { ?>
                <div class="infoText"><?php echo $sc_text ?></div>  
                <?php } ?>
              </div>
              <?php if ($sc_btnTitle && $sc_btnLink) { ?>
              <div class="infoButton">
                <a href="<?php echo $sc_btnLink ?>" target="<?php echo $sc_btnTarget ?>" class="btn-default"><?php echo $sc_btnTitle ?></a>
              </div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
        <?php } ?>
      </div>  
      <?php } ?>
    </div>
  </section>
  <?php } ?>


  <?php endwhile; ?>
</main>

<?php
get_footer();
