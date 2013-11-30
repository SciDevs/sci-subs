<?php
/*
This file is part of codium_grid. Hack and customize by henri labarre and based on the marvelous sandbox theme

codium_grid_grid is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or (at your option) any later version.

*/


function codium_grid_setup() {
    
    // Make theme available for translation
    // Translations can be filed in the /languages/ directory
    load_theme_textdomain( 'codium_grid', get_template_directory() . '/languages' );

    // add_editor_style support
    add_editor_style( 'custom-editor-style.css' );
   
    //feed
	add_theme_support('automatic-feed-links');
	
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	register_nav_menu( 'primary-menu', __( 'Primary Menu', 'codium_grid' ) );

    // Post thumbnails support for post
	add_theme_support( 'post-thumbnails', array( 'post' ) ); // Add it for posts
	set_post_thumbnail_size( 280, 196, true ); // Normal post thumbnails

    // This theme allows users to set a custom background
	add_theme_support( 'custom-background' );
    
    // This theme allows users to set a custom header image
    //custom header for 3.4 and compatability for prior version

	$args = array(
		'width'               => 1280,
		'height'              => 250,
		'default-image'       => '',
		'default-text-color'  => '444',
		'wp-head-callback'    => 'codium_grid_header_style',
		'admin-head-callback' => 'codium_grid_admin_header_style',
        
	);

	$args = apply_filters( 'codium_grid_custom_header', $args );

    add_theme_support( 'custom-header', $args );


}
add_action( 'after_setup_theme', 'codium_grid_setup' );

function codium_grid_scripts_styles() {

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'codium_grid-style', get_stylesheet_uri(), array(), '2013-10-31' );

}
add_action( 'wp_enqueue_scripts', 'codium_grid_scripts_styles' );
	

// gets included in the site header
function codium_grid_header_style() {
    if (get_header_image() != ''){
    ?><style type="text/css">
        div#header {
            background: url(<?php header_image(); ?>); height :230px; margin: 0 0 10px 0;
        }
      </style>    
    <?php }
    if ( 'blank' == get_header_textcolor() ) { ?>
        <style type="text/css">
      	h1.blogtitle,.description,.blogtitle { display: none; }
		</style>
    <?php } else { ?>
		<style type="text/css">
      	h1.blogtitle a,.description { color:#<?php header_textcolor() ?>; }
    	</style>
    <?php }
	}


// gets included in the admin header
function codium_grid_admin_header_style() {
    ?><style type="text/css">
        #headimg {
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        }
    </style><?php
}
	

// Set the content width based on the theme's design and stylesheet.
	if ( ! isset( $content_width ) )
	$content_width = 620;
	
//Nice title

function codium_grid_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'codium_grid' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'codium_grid_wp_title', 10, 2 );

// Generates semantic classes for BODY and POST element
function codium_grid_category_id_class($classes) {
	global $post;
	if (!is_404() && isset($post))
	foreach((get_the_category($post->ID)) as $category)
		$classes[] = $category->category_nicename;
	return $classes;
}
add_filter('body_class', 'codium_grid_category_id_class');

function codium_grid_tag_id_class($classes) {
	global $post;
	if (!is_404() && isset($post))
	if ( $tags = get_the_tags() )
		foreach ( $tags as $tag )
			$classes[] = 'tag-' . $tag->slug;
	return $classes;
}
add_filter('body_class', 'codium_grid_tag_id_class');

function codium_grid_author_id_class($classes) {
	global $post;
	if (!is_404() && isset($post))
		$classes[] = 'author-' . sanitize_title_with_dashes(strtolower(get_the_author_meta('login')));
	return $classes;
}
add_filter('post_class', 'codium_grid_author_id_class');

// add category nicenames in body and post class
	function category_id_class($classes) {
	    global $post;
	    foreach((get_the_category($post->ID)) as $category)
	        $classes[] = $category->category_nicename;
	        return $classes;
	}
	add_filter('post_class', 'category_id_class');
	
// count comment
function codium_grid_comment_count( $print = true ) {
	global $comment, $post, $codium_grid_comment_alt;

	// Counts trackbacks and comments
	if ( $comment->comment_type == 'comment' ) {
		$count[] = "$codium_grid_comment_alt";
	} else {
		$count[] = "$codium_grid_comment_alt";
	}

	$count = join( ' ', $count ); // Available filter: comment_class

	// Tada again!
	echo $count;
	//return $print ? print($count) : $count;
}


// Generates time- and date-based classes for BODY, post DIVs, and comment LIs; relative to GMT (UTC)
function codium_grid_date_classes( $t, &$c, $p = '' ) {
	$t = $t + ( get_option('gmt_offset') * 3600 );
	$c[] = $p . 'y' . gmdate( 'Y', $t ); // Year
	$c[] = $p . 'm' . gmdate( 'm', $t ); // Month
	$c[] = $p . 'd' . gmdate( 'd', $t ); // Day
	$c[] = $p . 'h' . gmdate( 'H', $t ); // Hour
}

// For category lists on category archives: Returns other categories except the current one (redundant)
function codium_grid_cats_meow($glue) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list($separator) );
	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset($cats[$i]);
			break;
		}
	}
	if ( empty($cats) )
		return false;

	return trim(join( $glue, $cats ));
}

// For tag lists on tag archives: Returns other tags except the current one (redundant)
function codium_grid_tag_ur_it($glue) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset($tags[$i]);
			break;
		}
	}
	if ( empty($tags) )
		return false;

	return trim(join( $glue, $tags ));
}

if ( ! function_exists( 'codium_grid_posted_on' ) ) :
// data before post
function codium_grid_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s.', 'codium_grid' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'codium_grid' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'codium_grid_posted_in' ) ) :
// data after post
function codium_grid_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'codium_grid' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'codium_grid' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'codium_grid' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


// Widgets plugin: intializes the plugin after the widgets above have passed snuff
function codium_grid_widgets_init() {

		register_sidebar(array(
		'name' => 'SidebarTop',
		'description' => 'Top sidebar',
		'id'            => 'sidebartop',
		'before_widget'  =>   "\n\t\t\t" . '<li id="%1$s" class="widget %2$s"><div class="widgetblock">',
		'after_widget'   =>   "\n\t\t\t</div></li>\n",
		'before_title'   =>   "\n\t\t\t\t". '<div class="widgettitleb"><h3 class="widgettitle">',
		'after_title'    =>   "</h3></div>\n" .''
		));
		
		register_sidebar(array(
		'name' => 'SidebarBottom',
		'description' => 'Bottom sidebar',
		'id'            => 'sidebarbottom',
		'before_widget'  =>   "\n\t\t\t" . '<li id="%1$s" class="widget %2$s"><div class="widgetblock">',
		'after_widget'   =>   "\n\t\t\t</div></li>\n",
		'before_title'   =>   "\n\t\t\t\t". '<div class="widgettitleb"><h3 class="widgettitle">',
		'after_title'    =>   "</h3></div>\n" .''
		));
        
        register_sidebar(array(
		'name' => 'WidgetFooterLeft',
		'description' => 'Left Footer widget',
		'id'            => 'widgetfooterleft',
		'before_widget'  =>   "\n\t\t\t" . '<div class="alpha grid_5 postsingle entry-content-footer"><div class="postwidgettext">',
		'after_widget'   =>   "\n\t\t\t</div></div>\n",
		'before_title'   =>   "\n\t\t\t\t". '<div class="widgettitleb"><h3 class="widgettitle">',
		'after_title'    =>   "</h3></div>\n" .''
		));

        register_sidebar(array(
		'name' => 'WidgetFooterCenter',
		'description' => 'Center Footer widget',
		'id'            => 'widgetfootercenter',
		'before_widget'  =>   "\n\t\t\t" . '<div class="grid_5 postsingle entry-content-footer"><div class="postwidgettext">',
		'after_widget'   =>   "\n\t\t\t</div></div>\n",
		'before_title'   =>   "\n\t\t\t\t". '<div class="widgettitleb"><h3 class="widgettitle">',
		'after_title'    =>   "</h3></div>\n" .''
		));

        register_sidebar(array(
		'name' => 'WidgetFooterRight',
		'description' => 'Right Footer widget',
		'id'            => 'widgetfooterright',
		'before_widget'  =>   "\n\t\t\t" . '<div class="omega grid_5 postsingle entry-content-footer"><div class="postwidgettext">',
		'after_widget'   =>   "\n\t\t\t</div></div>\n",
		'before_title'   =>   "\n\t\t\t\t". '<div class="widgettitleb"><h3 class="widgettitle">',
		'after_title'    =>   "</h3></div>\n" .''
		));

	}

// Runs our code at the end to check that everything needed has loaded
add_action( 'widgets_init', 'codium_grid_widgets_init' );


// Changes default [...] in excerpt to a real link
function codium_grid_excerpt_more($more) {
       global $post;
       $readmore = __(' read more <span class="meta-nav">&raquo;</span>', 'codium_grid' );
	return ' <a href="'. get_permalink($post->ID) . '">' . $readmore . '</a>';
}
add_filter('excerpt_more', 'codium_grid_excerpt_more');

//shorten titles too long
function codium_grid_short_title($text)
{
    // Change to the number of characters you want to display   
    $chars_limit = 130;
    $chars_text = strlen($text);
    $text = $text." ";
    $text = substr($text,0,$chars_limit);
    $text = substr($text,0,strrpos($text,' '));
    
    // If the text has more characters that your limit,
    //add ... so the user knows the text is actually longer
    if ($chars_text > $chars_limit)
    {
        $text = $text."...";
    }
    return $text;
}

// Adds filters for the description/meta content in archives.php
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );

// Remember: the codium_grid is for play.


//Remove <p> in excerpt
function codium_grid_strip_para_tags ($content) {
if ( is_home() && ($paged < 2 )) {
  $content = str_replace( '<p>', '', $content );
  $content = str_replace( '</p>', '', $content );
  return $content;
}
} 

if ( ! function_exists( 'codium_grid_comment' ) ) :
//Comment function
function codium_grid_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
   <li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
      <div class="comment-author vcard">
        <?php echo get_avatar( $comment, 48 ); ?>
		<?php printf(__('<div class="fn">%s</div> '), get_comment_author_link()) ?>
      </div>
        
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is in moderation.', 'codium_grid') ?></em>
         <br />
      <?php endif; ?>

      <div class="comment-meta"><?php printf(__('%1$s - %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'codium_grid'),
										get_comment_date(),
										get_comment_time(),
										'#comment-' . get_comment_ID() );
										edit_comment_link(__('Edit', 'codium_grid'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
	  <div class="clear"></div>	
			
      <div class="comment-body"><?php comment_text(); ?></div>
      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
      <?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'codium_grid' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'codium_grid' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;
        
//font for the Title
function codium_grid__google_font() {
?>
<link href='http://fonts.googleapis.com/css?family=Strait' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css' />
<?php
}

add_action('wp_head', 'codium_grid__google_font');

// footer link 
add_action('wp_footer', 'footer_link');

function footer_link() {	
if ( is_front_page() && !is_paged()) {
	$powered = __( 'Powered by:', 'codium_grid' );
    $theme = __( 'by:', 'codium_grid' );
    $content = '<div class="credits container_15 entry-content-footer">Theme '.$theme.' <a href="http://codiumgrid.allolesparents.fr/" title="Allo les Parents">Allo les Parents</a>, '.$powered.' <a href="http://wordpress.org" title="Wordpress">Wordpress</a></div>';
  	echo $content;
} else {
    $powered = __( 'Powered by:', 'codium_grid' );
    $content = '<div class="credits container_15 entry-content-footer">'.$powered.' <a href="http://wordpress.org" title="Wordpress">Wordpress</a></div>';
  	echo $content;
}
}


?>