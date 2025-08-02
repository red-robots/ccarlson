	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    <?php  
    $quickLinks = get_field('footer_quick_links','option');
    $footerLogo = get_field('footer_logo','option');
    $leftLinks = (isset($quickLinks['links_left']) && $quickLinks['links_left']) ? $quickLinks['links_left'] : '';
    $rightLinks = (isset($quickLinks['links_right']) && $quickLinks['links_right']) ? $quickLinks['links_right'] : '';
    ?>
    <div class="top">
      <div class="wrapper">
        <div class="flexwrap">
          <?php if ($leftLinks) { ?>
          <div class="footCol leftLinks">
            <ul class="footerNav">
              <?php foreach ($leftLinks as $link) { 
                $a = $link['link'];
                $aName = (isset($a['title']) && $a['title']) ? $a['title'] : '';
                $aUrl = (isset($a['url']) && $a['url']) ? $a['url'] : '';
                $aTarget = (isset($a['target']) && $a['target']) ? $a['target'] : '_self';
                ?>
                <li><a href="<?php echo $aUrl ?>" target="<?php echo $aTarget ?>"><?php echo $aName ?></a></li>  
              <?php } ?>
            </ul>
          </div>
          <?php } ?>

          <?php if ($footerLogo) { ?>
          <figure class="footCol footLogo">
            <img src="<?php echo $footerLogo['url'] ?>" alt="<?php echo $footerLogo['title'] ?>" />
          </figure>
          <?php } ?>

          <?php if ($rightLinks) { ?>
          <div class="footCol rightLinks">
            <ul class="footerNav">
              <?php foreach ($rightLinks as $link) { 
                $a = $link['link'];
                $aName = (isset($a['title']) && $a['title']) ? $a['title'] : '';
                $aUrl = (isset($a['url']) && $a['url']) ? $a['url'] : '';
                $aTarget = (isset($a['target']) && $a['target']) ? $a['target'] : '_self';
                ?>
                <li><a href="<?php echo $aUrl ?>" target="<?php echo $aTarget ?>"><?php echo $aName ?></a></li>  
              <?php } ?>
            </ul>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php  
    $social_media = get_social_icons();
    if($social_media) { ?>
    <div class="bottom">
      <div class="wrapper">
        <ul class="social-media">
        <?php foreach ($social_media as $v) { 
          $target = ($v['target'] && $v['target']) ? ' target="'.$v['target'].'"':'';
          $icon = $v['icon'];
          $link = $v['url'];
          $title = $v['title'];
          ?>
          <li>
            <a href="<?php echo $link ?>"<?php echo $target ?> aria-label="<?php echo $title ?>"><i class="<?php echo $icon ?>" aria-hidden="true"></i></a>
          </li>
        <?php } ?>
        </ul>
      </div>
    </div>
    <?php } ?>
    <div class="copyright">
      <span>
        &copy; <?php echo get_bloginfo('name') ?> <?php echo date('Y') ?>
      </span>
    </div>
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
