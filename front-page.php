<?php
/**
 * This file adds widgetized Home Page.
 *
 */


add_action( 'get_header', 'po_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function po_home_genesis_meta() {

	if ( is_active_sidebar( 'home-featured' ) || is_active_sidebar( 'home-top-left' ) || is_active_sidebar( 'home-top-middle' ) || is_active_sidebar( 'home-top-right' ) || is_active_sidebar( 'home-middle' ) || is_active_sidebar( 'home-bottom' ) ) {

		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
		add_action( 'genesis_before_loop', 'po_remove_home_title' );

		// //* Remove the default Genesis loop
		// remove_action( 'genesis_loop', 'genesis_do_loop' );

		// //* Remove .site-inner
		// add_filter( 'genesis_markup_site-inner', '__return_null' );
		// add_filter( 'genesis_markup_content-sidebar-wrap_output', '__return_false' );
		// add_filter( 'genesis_markup_content', '__return_null' );

		//* Add home widget areas
		add_action( 'genesis_after_header', 'po_home_featured_area' );

		add_action( 'genesis_after_header', 'po_home_top_area' );
		add_action( 'genesis_after_header', 'po_home_middle_area' );
		add_action( 'genesis_after_header', 'po_home_bottom_area' );



	}

}

function po_remove_home_title() {
	if ( is_front_page() )
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
}

function po_home_featured_area() {

		echo '<div class="home-featured-container"><div class="background-dark-overlay"><div class="wrap">';

		genesis_widget_area( 'home-featured', array(
			'before' => '<div class="home-featured-widget widget-area">',
			'after' => '</div>',
		) );

		echo '</div></div></div>';
}

function po_home_top_area() {

		echo '<div class="home-top-container"><div class="wrap">';

		genesis_widget_area( 'home-top-left', array(
			'before' => '<div class="home-top-left-widget widget-area one-third first">',
			'after' => '</div>',
		) );

		genesis_widget_area( 'home-top-middle', array(
			'before' => '<div class="home-top-middle-widget widget-area one-third">',
			'after' => '</div>',
		) );


		genesis_widget_area( 'home-top-right', array(
			'before' => '<div class="home-top-right-widget widget-area one-third">',
			'after' => '</div>',
		) );

		echo '</div></div>';

}

function po_home_middle_area() {

		echo '<div class="home-middle-container"><div class="wrap">';

		genesis_widget_area( 'home-middle', array(
			'before' => '<div class="home-middle-widget widget-area">',
			'after' => '</div>',
		) );

		echo '</div></div>';
}

function po_home_bottom_area() {

		echo '<div class="home-bottom-container"><div class="wrap">';
		
		genesis_widget_area( 'home-bottom', array(
			'before' => '<div class="home-bottom-widget widget-area">',
			'after' => '</div>',
		) );

		echo '</div></div>';


}

genesis();