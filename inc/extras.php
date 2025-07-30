<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bellaworks
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
define('THEMEURI',get_template_directory_uri() . '/');

function bellaworks_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
   global $post;
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( is_front_page() || is_home() ) {
        $classes[] = 'homepage';
    } else {
        $classes[] = 'subpage';
    }
    if(is_page() && $post) {
      $classes[] = $post->post_name;
    }

    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

    return $classes;
}
add_filter( 'body_class', 'bellaworks_body_classes' );


function add_query_vars_filter( $vars ) {
  $vars[] = "pg";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


function shortenText($string, $limit, $break=".", $pad="...") {
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }

  return $string;
}


/* Fixed Gravity Form Conflict Js */
add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
    return true;
}

function get_page_id_by_template($fileName) {
    $page_id = 0;
    if($fileName) {
        $pages = get_pages(array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => $fileName.'.php'
        ));

        if($pages) {
            $row = $pages[0];
            $page_id = $row->ID;
        }
    }
    return $page_id;
}

function string_cleaner($str) {
    if($str) {
        $str = str_replace(' ', '', $str); 
        $str = preg_replace('/\s+/', '', $str);
        $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
        $str = strtolower($str);
        $str = trim($str);
        return $str;
    }
}

function format_phone_number($string) {
    if(empty($string)) return '';
    $append = '';
    if (strpos($string, '+') !== false) {
        $append = '+';
    }
    $string = preg_replace("/[^0-9]/", "", $string );
    $string = preg_replace('/\s+/', '', $string);
    return $append.$string;
}

function extractURLFromString($string) {
  $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
  if(preg_match($reg_exUrl, $string, $url)) {
      return ($url) ? $url[0] : '';
  } else {
      return '';
  }
}

function extractYoutubeId($videoURL) {
  $youtubeId = '';
  if (strpos( strtolower($videoURL), 'youtube.com') !== false) {
    /* if iframe */
    if (strpos( strtolower($videoURL), 'youtube.com/embed') !== false) {
      $parts = extractURLFromString($videoURL);
      $youtubeId = basename($parts);
    } else {

      $parts = parse_url($videoURL);
      parse_str($parts['query'], $query);
      $youtubeId = (isset($query['v']) && $query['v']) ? $query['v']:''; 
      
    }
  } else if (strpos( strtolower($videoURL), 'youtu.be') !== false) {
    $parts = explode('https://youtu.be/', $videoURL);
    $parts2 = explode('?', $parts[1]);
    $youtubeId = $parts2[0];
  } 
  // if($youtubeId) {
  //   $embed_url = 'https://www.youtube.com/embed/'.$youtubeId.'?version=3&rel=0&loop=0'; 
  //   $mainImage = 'https://i.ytimg.com/vi/'.$youtubeId.'/maxresdefault.jpg';
  // }
  return $youtubeId;
}

function extractVimdeoId($videoURL) {
  $vimeoId = '';
  if( strpos( strtolower($videoURL), 'vimeo.com') !== false ) { 
    $parts = explode("https://vimeo.com/",$videoURL);
    $parts2 = $parts[1];

    if( strpos( strtolower($parts2), '?') !== false ) { 
      $parts3 = explode("?",$parts2);
      $vimeoId = $parts3[0];
    } else {
      $vimeoId = $parts2;
    }
    // $parts = ($vimeo_parts && array_filter($vimeo_parts) ) ? array_filter($vimeo_parts) : '';
    // $vimeoId = ($parts) ?  preg_replace('/\s+/', '', end($parts)) : '';
  }
  return $vimeoId;
}

function get_social_icons() {
  $links = array();
  $social_media = get_field('social_media_links','option');
  $social_types = array(
      'facebook'  => 'fa fa-facebook',
      'twitter'   => 'fab fa-twitter',
      'linkedin'  => 'fab fa-linkedin',
      'instagram' => 'fab fa-instagram',
      'youtube'   => 'fab fa-youtube',
      'vimeo'     => 'fab fa-vimeo',
  );
  if($social_media) {
    foreach($social_media as $sm) {
      $s = $sm['link'];
      if( isset($s['url']) && $s['url'] ) {
        $sTitle = $s['title'];
        $sUrl = $s['url'];
        $sTarget = $s['target'];
        $parts = parse_url($sUrl)['host'];
        $parts = str_replace('www.','',$parts);
        $parts = str_replace('.com','',$parts);
        foreach($social_types as $k=>$icon) {
          if (strpos($parts, $k) !== false) {
            $links[] = array(
              'icon'=>$icon,
              'title'=>$sTitle,
              'url'=>$sUrl,
              'target'=>$sTarget
            );
          }
        }
      }
    }
  }
  return $links;
}

function parse_external_url( $url = '', $internal_class = 'internal-link', $external_class = 'external-link') {

    $url = trim($url);

    // Abort if parameter URL is empty
    if( empty($url) ) {
        return false;
    }

    //$home_url = parse_url( $_SERVER['HTTP_HOST'] );     
    $home_url = parse_url( home_url() );  // Works for WordPress

    $target = '_self';
    $class = $internal_class;

    if( $url!='#' ) {
        if (filter_var($url, FILTER_VALIDATE_URL)) {

            $link_url = parse_url( $url );

            // Decide on target
            if( empty($link_url['host']) ) {
                // Is an internal link
                $target = '_self';
                $class = $internal_class;

            } elseif( $link_url['host'] == $home_url['host'] ) {
                // Is an internal link
                $target = '_self';
                $class = $internal_class;

            } else {
                // Is an external link
                $target = '_blank';
                $class = $external_class;
            }
        } 
    }

    // Return array
    $output = array(
        'class'     => $class,
        'target'    => $target,
        'url'       => $url
    );

    return $output;
}

function get_images_dir($fileName=null) {
    return get_bloginfo('template_url') . '/images/' . $fileName;
}

/* Remove richtext editor on specific page */
function remove_pages_editor(){
    global $wpdb;
    $post_id = ( isset($_GET['post']) && $_GET['post'] ) ? $_GET['post'] : '';
    $disable_editor = array();
    if($post_id) {        
        $page_ids_disable = get_field("disable_editor_on_pages","option");
        if( $page_ids_disable && in_array($post_id,$page_ids_disable) ) {
            remove_post_type_support( 'page', 'editor' );
        }
    }
}   
add_action( 'init', 'remove_pages_editor' );


/* Add richtext editor to category description */
// remove the html filtering
remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );


/* Remove description column in the wp table list */
add_filter('manage_edit-divisions_columns', function ( $columns ) {
  if( isset( $columns['description'] ) )
      unset( $columns['description'] );   
  return $columns;
} );


/* ACF CUSTOM OPTIONS TABS */
if( function_exists('acf_add_options_page') ) {
  // Insert option in custom post type tab
  // acf_add_options_sub_page(array(
  //   'page_title'  => 'Divisions Options',
  //   'menu_title'  => 'Divisions Options',
  //   'parent_slug' => 'edit.php?post_type=team'
  // ));

  // acf_add_options_page(array(
  //   'page_title'  => 'Global Options',
  //   'menu_title'  => 'Global Options',
  //   'parent_slug' => 'admin.php?page=acf-options'
  // ));
}

if( function_exists('acf_set_options_page_title') ) {
  acf_set_options_page_title( __('Theme Options') );
}

add_action('admin_enqueue_scripts', 'bellaworks_admin_style');
function bellaworks_admin_style() {
  wp_enqueue_style('admin-dashicons', get_template_directory_uri().'/css/dashicons.min.css');
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
}

add_action('admin_footer', 'custom_admin_add_js');
function custom_admin_add_js() { ?>
<script>
jQuery(document).ready(function($){
  // $('[data-name="flexible_content"] .acf-fc-layout-handle').each(function(){
  //   $(this).append('<a href="javascript:void(0)" title="Disable Section" class="visibility-section acf--visibility-section"><span class="dashicons dashicons-visibility"></span></a>');
  // });
  // $(document).on('click', '.acf--visibility-section', function(e){
  //   e.preventDefault();
  //   $(this).toggleClass('off');
  //   if( $(this).parent().find('.acf-field-true-false[data-name="disable_section"]').length ) {
  //     var checkBox = $(this).parent().find('.acf-field-true-false[data-name="disable_section"] input[type="checkbox"]');
  //   }
  // });
  $(document).on('change', '.acf-field-true-false[data-name="disable_section"] input[type="checkbox"]', function(){
    if( this.checked ) {
      $(this).parents('.layout[data-layout]').toggleClass('off');
    } else {
      $(this).parents('.layout[data-layout]').removeClass('off');
    }
  })
});
</script>
<?php }


/* Disabling Gutenberg on certain templates */
function ea_disable_editor( $id = false ) {

  $excluded_templates = array(
    'page-repeatable.php',
  );

  $excluded_ids = array(
    get_option( 'page_on_front' ) /* Home page */
  );

  if( empty( $id ) )
    return false;

  $id = intval( $id );
  $template = get_page_template_slug( $id );

  return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

/**
 * Disable Gutenberg by template
 *
 */
function ea_disable_gutenberg( $can_edit, $post_type ) {

  if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
    return $can_edit;

  if( ea_disable_editor( $_GET['post'] ) )
    $can_edit = false;

  // if( get_post_type($_GET['post'])=='team' )
  //   $can_edit = false;

  // if( $_GET['post']==2 ) /* Home page */
  //   $can_edit = false;

  return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'ea_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'ea_disable_gutenberg', 10, 2 );


add_action( 'admin_init', 'bw_hide_classic_editor' ); 
function bw_hide_classic_editor() {
    $post_id = (isset($_GET['post'])) ? $_GET['post'] : '' ;
    if( !isset( $post_id ) ) return;
    //$template_file = get_post_meta($post_id, '_wp_page_template', true);
    // if($template_file == 'submit.php'){ // edit the template name
    //     remove_post_type_support('page', 'editor');
    // }
    $front = get_option('page_on_front');
    if($post_id==$front) {
      remove_post_type_support('page', 'editor');
    }
}


/* Shortcode for Address */
function get_contact_details_shortcode( $atts ){
  $a = shortcode_atts( array(
    'field' => '',
  ), $atts );
  $field = $a['field'];
  $slug = ($field) ? sanitize_title($field) : '';
  $contact_details = get_field('contact_details','option');
  $result = '';
  if($field=='Map') {
    $map_embed = get_field('map_embed','option');
    if($map_embed) {
      $result = '<div class="contact-map-embed">' . $map_embed . '</div>';
    }
  } else {
    if($contact_details) {
      foreach($contact_details as $c) {
        $label = ($c['label']) ? trim($c['label']) : '';
        $text = $c['description'];
        $icon = $c['icon'];
        if($label==$field) {
          $result = '<div class="contact-item info--'.$slug.'">' . $icon . $text . '</div>';
        }
      }
    }
  }
  return $result;
}
add_shortcode( 'get_contact', 'get_contact_details_shortcode' );


function get_icon_shortcode( $atts ){
  $a = shortcode_atts( array(
    'class' => '',
  ), $atts );
  $icon = $a['class'];
  if($icon) {
    return '<i class="'.$icon.'"></i>';
  } else {
    return '';
  }
}
add_shortcode( 'icon', 'get_icon_shortcode' );


function team_listing_shortcode( $atts ){
  $content = '';
  ob_start();
  include( locate_template('parts/content-team-listing.php') ); 
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode( 'team_listing', 'team_listing_shortcode' );

function arrow_icon_shortcode( $atts ){
  return '<span class="arrow-icon"></span>';
}
add_shortcode( 'arrow_icon', 'arrow_icon_shortcode' );

function bella_acf_input_admin_footer() { ?>
<script type="text/javascript">
(function($) {
  acf.add_filter('color_picker_args', function( args, $field ){
    // do something to args
    args.palettes = ['#009C89','#43427A','#A82E71','#191E51','#0064B1']
    return args;
  });
})(jQuery); 
</script>
<?php
}
add_action('acf/input/admin_footer', 'bella_acf_input_admin_footer');


// add new buttons
add_filter( 'mce_buttons', 'myplugin_register_buttons' );
function myplugin_register_buttons( $buttons ) {
  array_push( $buttons, 'edbutton1');
  return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
add_filter( 'mce_external_plugins', 'myplugin_register_tinymce_javascript' );
function myplugin_register_tinymce_javascript( $plugin_array ) {
  $plugin_array['ctabutton'] = get_stylesheet_directory_uri() . '/assets/js/custom/custom-tinymce.js';
  return $plugin_array;
}


function get_flexible_templates() {
  $partsDIR = "parts-flexible";
  $dir = get_template_directory() . "/".$partsDIR."/";
  $allFiles = scandir($dir,1);
  $files = array_diff($allFiles, array('.', '..'));
  $templates = [];
  if($files) {
    foreach($files as $file) {
      if($file) {
        if ( (strpos($file, 'bak') !== false) || (strpos($file, 'copy') !== false) ) {
          //Skip....
        } else {
          if (strpos($file, '.php') !== false) {
            $templates[] = $partsDIR . "/" . $file;
          }
        }
      }
    }
  }
  return $templates;
}


