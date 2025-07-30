<?php if( get_row_layout() == 'multiple_cards' ) {
  $intro = get_sub_field('introduction');
  $card_option = get_sub_field('card_option');
  $phonebook = get_sub_field('phonebook');
  $cards = get_sub_field('cards');
  //$disable_section = get_sub_field('disable_section');
  //$is_visible = ($disable_section) ? false : true;
  if( $intro && $card_option ) { ?>
  <section data-group="<?php echo get_row_layout() ?>" class="repeatable section-multiple-cards repeatable--<?php echo get_row_layout() ?> repeatable--<?php echo get_row_layout() ?>-<?php echo $ctr ?>">
    <div class="wrapper">
      <div class="inner">
        <?php if ($intro) { ?>
        <div class="intro"><?php echo anti_email_spam($intro); ?></div>  
        <?php } ?>

        <?php if ($card_option=='phonebook') { ?>
          <?php if ($phonebook) { ?>
          <div class="infoCards card-phonebook">
            <?php foreach ($phonebook as $p) { 
              $pid = $p->ID;
              $title = $p->post_title;
              $company = get_field('company', $pid);
              $phone = get_field('phone', $pid);
              if($title || $company) { ?>
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
        <?php } else { ?>
          <?php if ($cards) { ?>
          <div class="infoCards card-custom">
            <?php foreach ($cards as $p) { 
              $title = $p['title'];
              $text = $p['text'];
              $phone = $p['text_bottom'];;
              if($title || $text) { ?>
              <div class="infoCard">
                <div class="inside">
                  <div class="textwrap">
                    <div class="top">
                      <?php if ($title) { ?>
                      <div class="infoTitle"><?php echo $title ?></div>  
                      <?php } ?>
                      <?php if ($text) { ?>
                      <div class="infoText"><?php echo anti_email_spam($text); ?></div>  
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
        <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>
<?php } ?>