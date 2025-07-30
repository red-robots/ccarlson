<?php
$post_type = 'staff';
$taxonomy = 'staff-department';
$departments = get_terms( array(
    'taxonomy'    => $taxonomy,
    'post_type'   => $post_type,
    'hide_empty'  => false,
  ) );
if($departments) { ?>
<div class="teamInfoCards masonry">
  <?php foreach ($departments as $term) { 
    $bgColor = get_field('department_color_code',$taxonomy.'_'.$term->term_id);
    $bgColor = ($bgColor) ? $bgColor : '#009C89';
    $args = array(
      'posts_per_page'   => -1,
      'post_type'        => $post_type,
      'post_status'      => 'publish',
          'tax_query' => array(
              array(
                  'taxonomy' => $term->taxonomy,
                  'field'    => 'slug',
                  'terms'    => $term->slug,
              ),
          ),
      );
    $teams = new WP_Query($args);
    ?>
    <div class="infoCard grid-item">
      <div class="inside">
        <div class="title" style="background:<?php echo $bgColor?>">
          <h3><?php echo $term->name; ?></h3>
        </div>
        <?php if ( $teams->have_posts() ) { ?>
        <div class="details">
          <ul class="listing">
          <?php while ( $teams->have_posts() ) : $teams->the_post(); 
            $pid = get_the_ID();
            $name = get_the_title();
            $job = get_field('title');
            $email = get_field('email');
            $phone = get_field('phone');
            $photo = get_field('photo');
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
                <?php if ($phone) { ?>
                <div class="phone">
                  <i class="fa-solid fa-phone"></i> <a href="tel:<?php echo format_phone_number($phone) ?>"><?php echo $phone ?></a>
                </div>
                <?php } ?>
                <?php if ($email) { ?>
                <div class="email">
                  <i class="fa-solid fa-envelope"></i> <a href="mailto:<?php echo antispambot($email,1) ?>"><?php echo antispambot($email) ?></a>
                </div>
                <?php } ?>
              </div>
              <?php } ?>
            </li>
          <?php endwhile;  ?>
          </ul>
        </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
</div>
<?php } ?>