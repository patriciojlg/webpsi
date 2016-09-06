<?php
/**
 * Settig Theme-options
 */
include_once( trailingslashit( get_template_directory() ) . 'lib/plugin-activation.php' );
include_once( trailingslashit( get_template_directory() ) . 'lib/theme-config.php' );

add_action( 'after_setup_theme', 'first_mag_setup' );

if ( !function_exists( 'first_mag_setup' ) ) :

	function first_mag_setup() {

		// Theme lang
		load_theme_textdomain( 'first-mag', get_template_directory() . '/languages' );

		// Add Title Tag Support
		add_theme_support( 'title-tag' );

		// Register Menus
		register_nav_menus(
		array(
			'main_menu' => __( 'Main Menu', 'first-mag' ),
		)
		);


		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true );
		add_image_size( 'first-mag-home', 394, 221, true );
		add_image_size( 'first-mag-home-small', 131, 98, true );
		add_image_size( 'first-mag-slider', 818, 430, true );
		add_image_size( 'first-mag-single', 1170, 400, true );


		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'woocommerce' );
	}

endif;
/**
 * Display a admin notices
 */
add_action( 'admin_notices', 'first_mag_admin_notice' );

function first_mag_admin_notice() {
	global $current_user;
	$first_mag_pro	 = 'http://themes4wp.com/product/first-mag-pro/';
	$user_id		 = $current_user->ID;
	/* Check that the user hasn't already clicked to ignore the message */
	if ( !get_user_meta( $user_id, 'first_mag_ignore_notice' ) ) {
		echo '<div class="updated notice-info point-notice" style="position:relative;"><p>';
		printf( __( 'Like First Mag theme? You will <strong>LOVE First Mag PRO</strong>!', 'first-mag' ) . '<a href="' . esc_url( $first_mag_pro ) . '" target="_blank">&nbsp;' . __( 'Click here for all the exciting features.', 'first-mag' ) . '</a><a href="%1$s" class="dashicons dashicons-dismiss dashicons-dismiss-icon" style="position: absolute; top: 8px; right: 8px; color: #222; opacity: 0.4; text-decoration: none !important;"></a>', '?first_mag_notice_ignore=0' );
		echo "</p></div>";
	}
}

add_action( 'admin_init', 'first_mag_notice_ignore' );

function first_mag_notice_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset( $_GET[ 'first_mag_notice_ignore' ] ) && '0' == $_GET[ 'first_mag_notice_ignore' ] ) {
		add_user_meta( $user_id, 'first_mag_ignore_notice', 'true', true );
	}
}

add_action( 'customize_controls_print_footer_scripts', 'first_mag_pro_banner' );

function first_mag_pro_banner() {
	$first_mag_pro = 'http://themes4wp.com/product/first-mag-pro/';
	echo '<a href="' . esc_url( $first_mag_pro ) . '" id="pro-banner" style="display: none; margin-top: 10px; background: #192429;" target="_blank"><img src="' . get_template_directory_uri() . '/img/first-mag-pro.jpg" /></a>';
	echo '<script type="text/javascript">jQuery(document).ready(function($) { $("#pro-banner").appendTo("#customize-info").css("display", "block"); });</script>';
}

/**
 * Enqueue Styles (normal style.css and bootstrap.css)
 */
function first_mag_theme_stylesheets() {
	wp_enqueue_style( 'first-mag-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css', array(), '1', 'all' );
	wp_enqueue_style( 'first-mag-stylesheet', get_stylesheet_uri(), array(), '1', 'all' );
	// load Font Awesome css
	wp_enqueue_style( 'first-mag-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false );
	// load Flexslider css
	wp_enqueue_style( 'first-mag-stylesheet-flexslider', get_template_directory_uri() . '/css/flexslider.css', 'style' );
}

add_action( 'wp_enqueue_scripts', 'first_mag_theme_stylesheets' );

/**
 * Register Bootstrap JS with jquery
 */
function first_mag_theme_js() {
	wp_enqueue_script( 'first-mag-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), true );
	wp_enqueue_script( 'first-mag-theme-js', get_template_directory_uri() . '/js/customscript.js', array( 'jquery' ), true );
	wp_enqueue_script( 'first-mag-flexslider-js', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), true );
}

add_action( 'wp_enqueue_scripts', 'first_mag_theme_js' );


/**
 * Register Custom Navigation Walker include custom menu widget to use walkerclass
 */
require_once('lib/wp_bootstrap_navwalker.php');

/**
 * Register the Sidebar(s)
 */
add_action( 'widgets_init', 'first_mag_widgets_init' );

function first_mag_widgets_init() {
	register_sidebar(
	array(
		'name'			 => __( 'Front Page: Content Section', 'first-mag' ),
		'id'			 => 'first-mag-front-page',
		'description'	 => __( 'Content Section', 'first-mag' ),
		'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h3 class="widget-title"><div class="title-text">',
		'after_title'	 => '</div><div class="widget-line"></div></h3>',
	) );

	register_sidebar(
	array(
		'name'			 => __( 'Right Sidebar', 'first-mag' ),
		'id'			 => 'first-mag-right-sidebar',
		'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h3 class="widget-title"><div class="title-text">',
		'after_title'	 => '</div><div class="widget-line"></div></h3>',
	) );

	register_sidebar(
	array(
		'name'			 => __( 'Left Sidebar', 'first-mag' ),
		'id'			 => 'first-mag-left-sidebar',
		'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h3 class="widget-title"><div class="title-text">',
		'after_title'	 => '</div><div class="widget-line"></div></h3>',
	) );

	register_sidebar(
	array(
		'name'			 => __( 'Header Section', 'first-mag' ),
		'id'			 => 'first-mag-header-top-section',
		'description'	 => __( 'Shows widgets in header section just above the main navigation menu. Suitable for search field or Ad (text widget).', 'first-mag' ),
		'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );

	register_sidebar(
	array(
		'name'			 => __( 'Top Ad Section', 'first-mag' ),
		'id'			 => 'first-mag-top-ad-section',
		'description'	 => __( 'Shows widgets just below the main navigation menu. Fullwidth section. Suitable for any Ad (text widget).', 'first-mag' ),
		'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );

	register_widget( 'first_mag_featured_posts_widget' );
	register_widget( 'first_mag_featured_posts_widget_second' );
	register_widget( 'first_mag_fullwidth_posts_widget' );
}

/**
 * Register Widgets
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/widgets.php' );
/**
 * Register hook and action to set Main content area col-md- width based on sidebar declarations
 */
add_action( 'first_mag_main_content_width_hook', 'first_mag_main_content_width_columns' );

function first_mag_main_content_width_columns() {

	$columns = '12';

	if ( get_theme_mod( 'rigth-sidebar-check', 1 ) != 0 ) {
		$columns = $columns - esc_attr( get_theme_mod( 'right-sidebar-size', 3 ) );
	}

	if ( get_theme_mod( 'left-sidebar-check', 0 ) != 0 ) {
		$columns = $columns - esc_attr( get_theme_mod( 'left-sidebar-size', 3 ) );
	}

	echo $columns;
}

function first_mag_main_content_width() {
	do_action( 'first_mag_main_content_width_hook' );
}

/**
 * Set Content Width
 */
if ( !isset( $content_width ) )
	$content_width = 800;

/**
 * Breadcrumbs
 */
function first_mag_breadcrumb() {
	global $post, $wp_query;
	$home		 = __( 'Home', 'first-mag' );
	$delimiter	 = ' &raquo; ';
	$homeLink	 = home_url();
	if ( is_home() || is_front_page() ) {
		// no need for breadcrumbs in homepage
	} else {
		echo '<div id="breadcrumbs" >';
		echo '<div class="breadcrumbs-inner text-right">';
		// main breadcrumbs lead to homepage
		echo '<span><a href="' . esc_url( $homeLink ) . '">' . '<i class="fa fa-home"></i><span>' . esc_attr( $home ) . '</span>' . '</a></span>' . $delimiter . ' ';
		if ( is_category() ) {
			$thisCat = get_category( get_query_var( 'cat' ), false );
			if ( $thisCat->parent != 0 ) {
				$category_link = get_category_link( $thisCat->parent );
				echo '<span><a href="' . esc_url( $category_link ) . '">' . '<span>' . esc_attr( get_cat_name( $thisCat->parent ) ) . '</span>' . '</a></span>' . $delimiter . ' ';
			}
			$category_id	 = get_cat_ID( single_cat_title( '', false ) );
			$category_link	 = get_category_link( $category_id );
			echo '<span><a href="' . esc_url( $category_link ) . '">' . '<span>' . esc_attr( single_cat_title( '', false ) ) . '</span>' . '</a></span>';
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type	 = get_post_type_object( get_post_type() );
				$slug		 = $post_type->rewrite;
				echo '<span><a href="' . esc_url( $homeLink ) . '/' . $slug[ 'slug' ] . '">' . '<span>' . esc_attr( $post_type->labels->singular_name ) . '</span>' . '</a></span>';
				echo ' ' . $delimiter . ' ' . get_the_title();
			} else {
				$category = get_the_category();
				if ( $category ) {
					foreach ( $category as $cat ) {
						echo '<span><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . '<span>' . esc_attr( $cat->name ) . '</span>' . '</a></span>' . $delimiter . ' ';
					}
				}
				echo get_the_title();
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_search() ) {
			$post_type = get_post_type_object( get_post_type() );
			echo $post_type->labels->singular_name;
		} elseif ( is_attachment() ) {
			$parent = get_post( $post->post_parent );
			echo '<span><a href="' . esc_url( get_permalink( $parent ) ) . '">' . '<span>' . esc_attr( $parent->post_title ) . '</span>' . '</a></span>';
			echo ' ' . $delimiter . ' ' . get_the_title();
		} elseif ( is_page() && !$post->post_parent ) {
			$get_post_slug	 = $post->post_name;
			$post_slug		 = str_replace( '-', ' ', $get_post_slug );
			echo '<span><a href="' . esc_url( get_permalink() ) . '">' . '<span>' . esc_attr( ucfirst( $post_slug ) ) . '</span>' . '</a></span>';
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id	 = $post->post_parent;
			$breadcrumbs = array();
			while ( $parent_id ) {
				$page			 = get_page( $parent_id );
				$breadcrumbs[]	 = '<span><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . '<span>' . esc_attr( get_the_title( $page->ID ) ) . '</span>' . '</a></span>';
				$parent_id		 = $page->post_parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
				echo $breadcrumbs[ $i ];
				if ( $i != count( $breadcrumbs ) - 1 )
					echo ' ' . $delimiter . ' ';
			}
			echo $delimiter . '<span><a href="' . esc_url( get_permalink() ) . '">' . '<span>' . esc_attr( the_title_attribute( 'echo=0' ) ) . '</span>' . '</a></span>';
		}
		elseif ( is_tag() ) {
			$tag_id = get_term_by( 'name', single_cat_title( '', false ), 'post_tag' );
			if ( $tag_id ) {
				$tag_link = get_tag_link( $tag_id->term_id );
			}
			echo '<span><a href="' . esc_url( $tag_link ) . '">' . '<span>' . esc_attr( single_cat_title( '', false ) ) . '</span>' . '</a></span>';
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );
			echo '<span><a href="' . esc_url( get_author_posts_url( $userdata->ID ) ) . '">' . '<span>' . esc_attr( $userdata->display_name ) . '</span>' . '</a></span>';
		} elseif ( is_404() ) {
			echo __( 'Error 404', 'first-mag' );
		} elseif ( is_search() ) {
			echo 'Search results for "' . esc_attr( get_search_query() ) . '"';
		} elseif ( is_day() ) {
			echo '<span><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span>' . esc_attr( get_the_time( 'Y' ) ) . '</span>' . '</a></span>' . $delimiter . ' ';
			echo '<span><a href="' . esc_url( get_month_link( get_the_time( 'Y' ) ), get_the_time( 'm' ) ) . '">' . '<span>' . esc_attr( get_the_time( 'F' ) ) . '</span>' . '</a></span>' . $delimiter . ' ';
			echo '<span><a href="' . esc_url( get_day_link( get_the_time( 'Y' ) ), get_the_time( 'm' ), get_the_time( 'd' ) ) . '">' . '<span>' . esc_attr( get_the_time( 'd' ) ) . '</span>' . '</a></span>';
		} elseif ( is_month() ) {
			echo '<span><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span>' . esc_attr( get_the_time( 'Y' ) ) . '</span>' . '</a></span>' . $delimiter . ' ';
			echo '<span><a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . '<span>' . esc_attr( get_the_time( 'F' ) ) . '</span>' . '</a></span>';
		} elseif ( is_year() ) {
			echo '<span><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span>' . esc_attr( get_the_time( 'Y' ) ) . '</span>' . '</a></span>';
		}
		if ( get_query_var( 'paged' ) ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo ' (';
			echo __( 'Page', 'first-mag' ) . ' ' . get_query_var( 'paged' );
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo ')';
		}
		echo '</div></div>';
	}
}

/**
 * Display navigation to next/previous pages when applicable
 */
if ( !function_exists( 'first_mag_content_nav' ) ) :

	function first_mag_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous	 = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next		 = get_adjacent_post( false, '', false );

			if ( !$next && !$previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
			return;

		$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';
		?>
		<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
			<div class="screen-reader-text"><?php _e( 'Post navigation', 'first-mag' ); ?></div>
			<div class="pager">

				<?php if ( is_single() ) : // navigation links for single posts  ?>

					<div class="post-navigation row">
						<div class="post-previous col-md-6"><?php previous_post_link( '%link', '<span class="meta-nav">' . __( 'Previous:', 'first-mag' ) . '</span> %title' ); ?></div>
						<div class="post-next col-md-6"><?php next_post_link( '%link', '<span class="meta-nav">' . __( 'Next:', 'first-mag' ) . '</span> %title' ); ?></div>
					</div>

				<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages  ?>

					<?php if ( get_next_posts_link() ) : ?>
						<li class="nav-previous previous btn btn-default"><?php next_posts_link( __( 'Older posts', 'first-mag' ) ); ?></li>
					<?php endif; ?>

					<?php if ( get_previous_posts_link() ) : ?>
						<li class="nav-next next btn btn-default"><?php previous_posts_link( __( 'Newer posts', 'first-mag' ) ); ?></li>
						<?php endif; ?>

				<?php endif; ?>

			</div>
		</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
		<?php
	}

endif; // content_nav

/**
 * Pagination
 */
function first_mag_pagination() {
	global $wp_query;
	$big	 = 999999999;
	$pages	 = paginate_links( array(
		'base'		 => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'	 => '?page=%#%',
		'current'	 => max( 1, get_query_var( 'paged' ) ),
		'total'		 => $wp_query->max_num_pages,
		'prev_next'	 => false,
		'type'		 => 'array',
		'prev_next'	 => TRUE,
		'prev_text'	 => __( '&larr; Previous', 'first-mag' ),
		'next_text'	 => __( 'Next &rarr;', 'first-mag' ),
	) );
	if ( is_array( $pages ) ) {
		$current_page = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
		echo '<ul class="pagination">';
		foreach ( $pages as $i => $page ) {
			if ( $current_page == 1 && $i == 0 ) {
				echo "<li class='active'>$page</li>";
			} else {
				if ( $current_page != 1 && $current_page == $i ) {
					echo "<li class='active'>$page</li>";
				} else {
					echo "<li>$page</li>";
				}
			}
		}
		echo '</ul>';
	}
}

/**
 * Theme Info page
 */
if ( is_admin() ) {
	require_once(trailingslashit( get_template_directory() ) . 'lib/theme-info.php');
}