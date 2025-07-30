	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    <?php  
    $contact_details = get_field('contact_details','option');
    $map_embed = get_field('map_embed','option');
    $social_icons = get_social_icons();
    global $post;
    $is_contact_us = ( isset($post->post_name) && $post->post_name=='contact' ) ? true : false;
    ?>
    <?php if ($is_contact_us==false) { ?>
    <div class="footerTop">
      <div class="wrapper">
        <div class="footer-columns">
          <?php if ($contact_details) { ?>
          <div class="footcol foot-contact-info">
            <div class="foot-title">Contact</div>
            <div class="foot-info">
              <?php foreach ($contact_details as $cd) { 
                $label = $cd['label'];
                $description = $cd['description'];
                $icon = $cd['icon'];
                if($description) { ?>
                <div class="info">
                  <?php if ($icon) { ?><?php echo $icon ?><?php } ?>
                  <?php if ($description) { ?>
                  <div class="text"><?php echo $description ?></div>
                  <?php } ?>
                </div>
                <?php } ?>
              <?php } ?>
            </div>

            <?php if ($social_icons) { ?>
            <div class="social-media-links">
              <div class="social-title">Follow</div>
              <div class="social-links">
              <?php foreach ($social_icons as $sm) { ?>
              <a href="<?php echo $sm['url'] ?>" target="<?php echo $sm['target'] ?>">
                <i class="<?php echo $sm['icon'] ?>"></i>
                <span class="sr-only"><?php echo $sm['title'] ?></span>
              </a>
              <?php } ?>
              </div>
            </div>    
            <?php } ?>
        
          </div>
          <?php } ?>

          <?php if ($map_embed ) { ?>
          <div class="footcol foot-contact-map">
            <div class="mapframe">
              <?php echo $map_embed ?>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>

    <?php 
      $copyright = get_field('copyright', 'option'); 
      $footerLogos = get_field('footer_logos', 'option'); 
    ?>
    <div class="copyright-section<?php echo ($footerLogos) ? ' has-footer-logos':'' ?>">
      <div class="wrapper">
        <div class="flexwrap">
          <?php if ($copyright) { ?>
          <div class="copyright">
              <?php echo $copyright ?>
            <div class="poweredby">Site by <a href="https://bellaworksweb.com/" target="_blank">Bellaworks</a></div>      
          </div>
          <?php } ?>
          <?php if ($footerLogos) { ?>
          <div class="footer-logo">
            <?php foreach ($footerLogos as $f) { 
            $img = $f['image'];
            $website = $f['logo_website_url'];
            $newTab = $f['logo_url_open_new_tab'];
            $linkTarget = ($newTab) ? ' target="_blank" ':'';
            if($img) { ?>
            <figure>
              <?php if ($website) { ?>
                <a href="<?php echo $website ?>"<?php echo $linkTarget ?>><img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>" /></a>
              <?php } else { ?>
                <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>" />
              <?php } ?>
            </figure>
            <?php } ?>
            <?php } ?>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
