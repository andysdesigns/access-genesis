<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Leiden' );
define( 'CHILD_THEME_URL', 'http://genesis-accessible.org/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );



/**
 * Enqueue scripts for smooth scrolling
 */
add_action( 'wp_enqueue_scripts', 'po_smooth_scroll', 1 );
function po_smooth_scroll() {

	wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.5-beta', true );
	wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/js/jquery.localScroll.min.js', array( 'scrollTo' ), '1.2.8b', true );
	wp_enqueue_script( 'scrollto-init', get_stylesheet_directory_uri() . '/js/scrollto-init.js', array( 'localScroll' ), '', true );

}

//* Add Font Awesome Support
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {
	wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0' );
}

add_action( 'wp_enqueue_scripts', 'po_enqueue_backstretch' );
/**
 * Set Featured Image as Header's background using Backstretch on singular entries.
 * For singular entries not having a Featured Image and other sections of the site,
 * like category archives, a default image will be set as Header's background.
 *
  */
function po_enqueue_backstretch() {

	wp_enqueue_script( 'backstretch', get_stylesheet_directory_uri() . '/js/jquery.backstretch.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'backstretch-set', get_stylesheet_directory_uri() . '/js/backstretch-set.js' , array( 'backstretch' ), '1.0.0', true );

	if ( has_post_thumbnail() && is_singular() ) {
		$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id() );
		$backstretch_src = array( 'src' => $featured_image_url );
	} else {
		$default_header_url = get_stylesheet_directory_uri() . '/images/header-default.png';
		$backstretch_src = array( 'src' => $default_header_url );
	}

	wp_localize_script( 'backstretch-set', 'BackStretchImg', $backstretch_src );

}


//* Change the footer text
add_filter('genesis_footer_creds_text', 'sp_footer_creds_filter');
function sp_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] &middot; Patrick O`Dacre';
	return $creds;
}

//* Register Custom Homepage Widgets

genesis_register_sidebar( array(
	'id'            => 'home-featured',
	'name'          => __( 'Home Featured', 'Patrick_Custom' ),
	'description'   => __( 'This featured area appears below the header on the frontpage.', 'Patrick_Custom' ),
) );
genesis_register_sidebar( array(
	'id'            => 'home-top-left',
	'name'          => __( 'Home Top-Left', 'Patrick_Custom' ),
	'description'   => __( 'This top area appears below the featured area on the frontpage.', 'Patrick_Custom' ),
) );
genesis_register_sidebar( array(
	'id'            => 'home-top-middle',
	'name'          => __( 'Home Top-Middle', 'Patrick_Custom' ),
	'description'   => __( 'This top area appears below the featured area on the frontpage.', 'Patrick_Custom' ),
) );
genesis_register_sidebar( array(
	'id'            => 'home-top-right',
	'name'          => __( 'Home Top-Right', 'Patrick_Custom' ),
	'description'   => __( 'This top area appears below the featured area on the frontpage.', 'Patrick_Custom' ),
) );
genesis_register_sidebar( array(
	'id'            => 'home-middle',
	'name'          => __( 'Home Middle', 'Patrick_Custom' ),
	'description'   => __( 'This middle area appears below the top area on the frontpage.', 'sanecotec' ),
) );
genesis_register_sidebar( array(
	'id'            => 'home-bottom',
	'name'          => __( 'Home Bottom', 'Patrick_Custom' ),
	'description'   => __( 'This area appears at the very bottom of the frontpage.', 'Patrick_Custom' ),
) );



//* Add anchor above the site header
add_action( 'genesis_before_header', 'po_beam_me_up' );
	function po_beam_me_up() { ?>
		<div id="beam-me-up"></div>
		<?php
	}


//* Add back to top link in the footer

add_action( 'genesis_footer', 'po_beam_me_up_link', 6 );
	function po_beam_me_up_link() { ?>
		<div class="back-to-top"><a href="#beam-me-up" class="fa fa-arrow-circle-up"><span class="fa-on-left">Back to Top</span></a></div>
		<?php
	}





// Add custom styles to visual editor

function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Image Float Left',  
			'block' => 'span',  
			'classes' => 'image-float-left',
			'wrapper' => true,			
		),  
		array(  
			'title' => 'Image Float Right',  
			'block' => 'span',  
			'classes' => 'image-float-right',
			'wrapper' => true,
		),
		array(  
			'title' => 'Add Image Border',  
			'block' => 'span',  
			'classes' => 'image-border',
			'wrapper' => true,
		),
		array(  
			'title' => 'Circle Image Center',  
			'block' => 'span',  
			'classes' => 'circle-image',
			'wrapper' => true,
		),
		array(
			'title' => 'Callout Box Green',
			'block' => 'div',
			'classes' => 'callout-box-green',
			'wrapper' => true,
		),
		array(  
			'title' => 'Text Block Float Left',  
			'block' => 'span',  
			'classes' => 'text-block-left',
			'wrapper' => true,			
		),  
		array(  
			'title' => 'Text Block Float Right',  
			'block' => 'span',  
			'classes' => 'text-block-right',
			'wrapper' => true,
		),
		array(  
			'title' => 'Font Size 24',  
			'block' => 'span',  
			'classes' => 'font-size-24',
			'wrapper' => true,
		),
		array(  
			'title' => 'Font Size 36',  
			'block' => 'span',  
			'classes' => 'font-size-36',
			'wrapper' => true,
		),
		array(  
			'title' => 'Font Size 48',  
			'block' => 'span',  
			'classes' => 'font-size-48',
			'wrapper' => true,
		),
		array(  
			'title' => 'Block Link',  
			'block' => 'a',  
			'classes' => '.block-link',
			'wrapper' => true,
		),
		array(  
			'title' => 'Heading Emphasize',  
			'block' => 'span',  
			'classes' => 'heading-emphasize',
			'wrapper' => true,
		),
		array(  
			'title' => 'Sub Heading',  
			'block' => 'span',  
			'classes' => 'sub-heading',
			'wrapper' => true,
		),
		array(  
			'title' => 'Callout Box',  
			'block' => 'div',  
			'classes' => 'callout-box',
			'wrapper' => true,
		),
		array(  
			'title' => 'Clear Spacer',  
			'block' => 'div',  
			'classes' => 'clear-spacer',
			'wrapper' => false,
		),
		array( 
			'title' => 'Clear',  
			'block' => 'div',  
			'classes' => 'clear',
			'wrapper' => false,
		),
		array(  
			'title' => 'Clear Line',  
			'block' => 'div',  
			'classes' => 'clear-line',
			'wrapper' => false,
		),
	
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 



function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}

add_action( 'init', 'my_theme_add_editor_styles' );

