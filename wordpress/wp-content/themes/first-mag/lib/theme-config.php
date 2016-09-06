<?php

/**
 * Kirki Advanced Customizer
 * @package first-mag
 */
// Early exit if Kirki is not installed
if ( !class_exists( 'Kirki' ) ) {
	return;
}
/* Register Kirki config */
Kirki::add_config( 'first_mag_settings', array(
	'capability'	 => 'edit_theme_options',
	'option_type'	 => 'theme_mod',
) );
/**
 * Add sections
 */
Kirki::add_section( 'sidebar_section', array(
	'title'			 => __( 'Sidebars', 'first-mag' ),
	'priority'		 => 10,
	'description'	 => __( 'Sidebar layouts.', 'first-mag' ),
) );

Kirki::add_section( 'layout_section', array(
	'title'			 => __( 'Main styling', 'first-mag' ),
	'priority'		 => 10,
	'description'	 => __( 'Define theme layout', 'first-mag' ),
) );


Kirki::add_section( 'post_section', array(
	'title'			 => __( 'Post settings', 'first-mag' ),
	'priority'		 => 10,
	'description'	 => __( 'Single post settings', 'first-mag' ),
) );

Kirki::add_section( 'site_bg_section', array(
	'title'		 => __( 'Site Background', 'first-mag' ),
	'priority'	 => 10,
) );
Kirki::add_section( 'colors_section', array(
	'title'		 => __( 'Colors', 'first-mag' ),
	'priority'	 => 10,
) );


Kirki::add_field( 'first_mag_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'rigth-sidebar-check',
	'label'			 => __( 'Right Sidebar', 'first-mag' ),
	'description'	 => __( 'Enable the Right Sidebar', 'first-mag' ),
	'section'		 => 'sidebar_section',
	'default'		 => 1,
	'priority'		 => 10,
) );

Kirki::add_field( 'first_mag_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'right-sidebar-size',
	'label'		 => __( 'Right Sidebar Size', 'first-mag' ),
	'section'	 => 'sidebar_section',
	'default'	 => '3',
	'priority'	 => 10,
	'choices'	 => array(
		'2'	 => '2',
		'3'	 => '3',
		'4'	 => '4',
		'5'	 => '5'
	),
	'required'	 => array(
		array(
			'setting'	 => 'rigth-sidebar-check',
			'operator'	 => '==',
			'value'		 => 1,
		),
	)
) );

Kirki::add_field( 'first_mag_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'left-sidebar-check',
	'label'			 => __( 'Left Sidebar', 'first-mag' ),
	'description'	 => __( 'Enable the Left Sidebar', 'first-mag' ),
	'section'		 => 'sidebar_section',
	'default'		 => 0,
	'priority'		 => 10,
) );

Kirki::add_field( 'first_mag_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'left-sidebar-size',
	'label'		 => __( 'Left Sidebar Size', 'first-mag' ),
	'section'	 => 'sidebar_section',
	'default'	 => '2',
	'priority'	 => 10,
	'choices'	 => array(
		'2'	 => '2',
		'3'	 => '3',
		'4'	 => '4',
		'5'	 => '5'
	),
	'required'	 => array(
		array(
			'setting'	 => 'left-sidebar-check',
			'operator'	 => '==',
			'value'		 => 1,
		),
	)
) );

Kirki::add_field( 'first_mag_settings', array(
	'type'			 => 'image',
	'settings'		 => 'header-logo',
	'label'			 => __( 'Logo', 'first-mag' ),
	'description'	 => __( 'Upload your logo', 'first-mag' ),
	'section'		 => 'layout_section',
	'default'		 => '',
	'priority'		 => 10,
) );
Kirki::add_field( 'first_mag_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'get-featured',
	'label'			 => __( 'Slider', 'first-mag' ),
	'description'	 => __( 'Enable or disable slider on homepage', 'first-mag' ),
	'section'		 => 'layout_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'first_mag_settings', array(
	'type'			 => 'select',
	'settings'		 => 'featured-categories',
	'label'			 => __( 'Slider category', 'first-mag' ),
	'description'	 => __( 'Select category for slider', 'first-mag' ),
	'section'		 => 'layout_section',
	'default'		 => '1',
	'priority'		 => 10,
	'choices'		 => first_mag_get_cats(),
	'required'		 => array(
		array(
			'setting'	 => 'get-featured',
			'operator'	 => '==',
			'value'		 => 1,
		),
	)
) );

Kirki::add_field( 'first_mag_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'related-posts-check',
	'label'			 => __( 'Related posts', 'first-mag' ),
	'description'	 => __( 'Enable or disable related posts', 'first-mag' ),
	'section'		 => 'post_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'first_mag_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'author-check',
	'label'			 => __( 'Author box', 'first-mag' ),
	'description'	 => __( 'Enable or disable author box', 'first-mag' ),
	'section'		 => 'post_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'first_mag_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'post-nav-check',
	'label'			 => __( 'Post navigation', 'first-mag' ),
	'description'	 => __( 'Enable or disable navigation below post content', 'first-mag' ),
	'section'		 => 'post_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'first_mag_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'breadcrumbs-check',
	'label'			 => __( 'Breadcrumbs', 'first-mag' ),
	'description'	 => __( 'Enable or disable Breadcrumbs', 'first-mag' ),
	'section'		 => 'post_section',
	'default'		 => 1,
	'priority'		 => 10,
) );

Kirki::add_field( 'first_mag_settings', array(
	'type'		 => 'color',
	'settings'	 => 'color_site_title',
	'label'		 => __( 'Site title color', 'first-mag' ),
	'help'		 => __( 'Site title text color, if not defined logo.', 'first-mag' ),
	'section'	 => 'colors_section',
	'default'	 => '#222',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => '.rsrc-header-text a',
			'property'	 => 'color',
			'units'		 => ' !important',
		),
	),
) );
Kirki::add_field( 'first_mag_settings', array(
	'type'		 => 'color',
	'settings'	 => 'color_site_desc',
	'label'		 => __( 'Site description color', 'first-mag' ),
	'help'		 => __( 'Site title text color, if not defined logo.', 'first-mag' ),
	'section'	 => 'colors_section',
	'default'	 => '#B6B6B6',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => '.rsrc-header-text h4',
			'property'	 => 'color',
		),
	),
) );

Kirki::add_field( 'first_mag_settings', array(
	'type'		 => 'background',
	'settings'	 => 'background_site',
	'label'		 => __( 'Background', 'first-mag' ),
	'section'	 => 'site_bg_section',
	'default'	 => array(
		'color'		 => '#f4f4f4',
		'image'		 => '',
		'repeat'	 => 'no-repeat',
		'size'		 => 'cover',
		'attach'	 => 'fixed',
		'position'	 => 'center-top',
		'opacity'	 => 100,
	),
	'priority'	 => 10,
	'output'	 => 'body',
) );

/**
 * Configuration sample for the first-mag Customizer.
 */
function first_mag_configuration() {

	$config[ 'logo_image' ]	 = get_template_directory_uri() . '/img/logo.png';
	$config[ 'description' ]	 = __( 'First Mag is a simple way to create your Personal WordPress Blog or Magazine, with no technical knowledge or expertise required.', 'first-mag' );
	$config[ 'color_back' ]	 = '#192429';
	$config[ 'color_accent' ]	 = '#00d6f7';
	$config[ 'width' ]		 = '25%';

	return $config;
}

add_filter( 'kirki/config', 'first_mag_configuration' );

function first_mag_configuration_i18n( $config ) {

	$strings = array(
		'background-color'		 => __( 'Background Color', 'first-mag' ),
		'background-image'		 => __( 'Background Image', 'first-mag' ),
		'no-repeat'				 => __( 'No Repeat', 'first-mag' ),
		'repeat-all'			 => __( 'Repeat All', 'first-mag' ),
		'repeat-x'				 => __( 'Repeat Horizontally', 'first-mag' ),
		'repeat-y'				 => __( 'Repeat Vertically', 'first-mag' ),
		'inherit'				 => __( 'Inherit', 'first-mag' ),
		'background-repeat'		 => __( 'Background Repeat', 'first-mag' ),
		'cover'					 => __( 'Cover', 'first-mag' ),
		'contain'				 => __( 'Contain', 'first-mag' ),
		'background-size'		 => __( 'Background Size', 'first-mag' ),
		'fixed'					 => __( 'Fixed', 'first-mag' ),
		'scroll'				 => __( 'Scroll', 'first-mag' ),
		'background-attachment'	 => __( 'Background Attachment', 'first-mag' ),
		'left-top'				 => __( 'Left Top', 'first-mag' ),
		'left-center'			 => __( 'Left Center', 'first-mag' ),
		'left-bottom'			 => __( 'Left Bottom', 'first-mag' ),
		'right-top'				 => __( 'Right Top', 'first-mag' ),
		'right-center'			 => __( 'Right Center', 'first-mag' ),
		'right-bottom'			 => __( 'Right Bottom', 'first-mag' ),
		'center-top'			 => __( 'Center Top', 'first-mag' ),
		'center-center'			 => __( 'Center Center', 'first-mag' ),
		'center-bottom'			 => __( 'Center Bottom', 'first-mag' ),
		'background-position'	 => __( 'Background Position', 'first-mag' ),
		'background-opacity'	 => __( 'Background Opacity', 'first-mag' ),
		'ON'					 => __( 'ON', 'first-mag' ),
		'OFF'					 => __( 'OFF', 'first-mag' ),
		'all'					 => __( 'All', 'first-mag' ),
		'cyrillic'				 => __( 'Cyrillic', 'first-mag' ),
		'cyrillic-ext'			 => __( 'Cyrillic Extended', 'first-mag' ),
		'devanagari'			 => __( 'Devanagari', 'first-mag' ),
		'greek'					 => __( 'Greek', 'first-mag' ),
		'greek-ext'				 => __( 'Greek Extended', 'first-mag' ),
		'khmer'					 => __( 'Khmer', 'first-mag' ),
		'latin'					 => __( 'Latin', 'first-mag' ),
		'latin-ext'				 => __( 'Latin Extended', 'first-mag' ),
		'vietnamese'			 => __( 'Vietnamese', 'first-mag' ),
		'serif'					 => _x( 'Serif', 'font style', 'first-mag' ),
		'sans-serif'			 => _x( 'Sans Serif', 'font style', 'first-mag' ),
		'monospace'				 => _x( 'Monospace', 'font style', 'first-mag' ),
	);

	$config[ 'i18n' ] = $strings;

	return $config;
}

add_filter( 'kirki/config', 'first_mag_configuration_i18n' );

function first_mag_get_cats() {
	/* GET LIST OF CATEGORIES */
	$layercats		 = get_categories();
	$newList		 = array();
	$newList[ '0' ]	 = __( 'All categories', 'first-mag' );
	foreach ( $layercats as $category ) {
		$newList[ $category->term_id ] = $category->cat_name;
	}
	return $newList;
}
