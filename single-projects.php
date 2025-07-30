<?php
$post_id = get_the_ID();
$img = get_field('main_photo', $post_id);
$alternative_title = get_field('alternative_title', $post_id);
$page_title = ($alternative_title) ? $alternative_title : get_the_title();

get_header(); ?>
<div id="primary" class="content-area-full project-single-content <?php echo $has_banner ?>">
  <?php if($img) { ?>
    <figure class="project-main-image">
      <div class="img" style="background-image:url('<?php echo $img['url']?>')"></div>
      <img src="<?php echo $img['url']?>" alt="<?php echo $img['title']?>" />
    </figure>
  <?php } ?>
  <main id="main" class="site-main" role="main" data-page-title="<?php echo $page_title ?>">

		<?php while ( have_posts() ) : the_post(); ?>

        <div class="titlediv typical">
          <h1 class="page-title"><span><?php echo $page_title ?></span></h1>
        </div>

      <?php if ( get_the_content() ) { ?>
			<div class="entry-content">
        <div class="wrapper">
				  <?php the_content(); ?>
        </div>
			</div>
      <?php } ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
