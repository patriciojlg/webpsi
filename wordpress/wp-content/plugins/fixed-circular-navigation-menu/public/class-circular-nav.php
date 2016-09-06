<?php
/**
 * @package   Fixed Circular Navigation Menu
 * @author    Enrique Crespo Molera <contact@e-crespo.com>
 * @license   GPL-2.0+
 * @link      http://wordpress-fixed-circular-nav.e-crespo.com
 * @copyright 2014 Enrique Crespo Molera
 */

/**
 * Plugin class for public functionalities
 * @package   Circular_Nav
 * @author    Enrique Crespo Molera <contact@e-crespo.com>
 */
class Circular_Nav {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
         * @updated  1.1.0
	 *
	 * @var     string
	 */
	const VERSION = '1.1.1';

	/**
	 * Unique identifier for plugin.
         * 
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'circular-nav';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Main functionality and action/filter hoooking
		add_action( 'wp_footer', array($this, 'output_circular_nav'));

	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
		//Define activation functionality here
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
		//Define deactivation functionality here
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
                global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
                
		//Enqueue main styles
                wp_enqueue_style( $this->plugin_slug . '-style', plugins_url( 'assets/css/circular-nav.css', __FILE__ ), array(), self::VERSION );
                
                //Enqueue dynamic generated styles from setup options, depending on if it is a multisite installation or not
                $uploads = wp_upload_dir();
                $css_dir = plugins_url( 'public/assets/css/', dirname(__FILE__));
                /** Load from different directory if on multisite **/
                if(is_multisite()) {
                    $aq_uploads_dir = trailingslashit($uploads['baseurl']);
                } else {
                    $aq_uploads_dir = $css_dir;
                }
                wp_enqueue_style( $this->plugin_slug . '-options', $aq_uploads_dir . 'cn-options.css', array(), self::VERSION );
                
                //Enqueue font awesome styles
                wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array (), '', 'all' );
                
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
                 
                //Enqueue main javascript file
                wp_enqueue_script( $this->plugin_slug . '-script', plugins_url( 'assets/js/circular-nav.js', __FILE__ ), array( 'jquery' ), self::VERSION, true );
                
                //Localize script generating some paths variables to be used in main javascript file depending on if it is a multisite installation or not
                $uploads = wp_upload_dir();
                $views_dir = plugins_url( 'public/views/', dirname(__FILE__));
                /** Load from different directory if on multisite **/
                if(is_multisite()) {
                    $aq_uploads_dir = trailingslashit($uploads['baseurl']);
                } else {
                    $aq_uploads_dir = $views_dir;
                }
                 
                wp_localize_script( $this->plugin_slug . '-script', 'CircularNav', array( 'pluginJsDir' => plugins_url( 'public/assets/js/', dirname(__FILE__)) , 'pluginViewsDir' => $aq_uploads_dir ));
                
	}

        /**
	 * Output circular navigation menu
	 *
	 * @since    1.0.0
	 */
	public function output_circular_nav() {
            
            $cn_data = get_option('circular_nav_options');
            
            if ( !empty($cn_data) ){
            
                if ( !empty( $cn_data['cn']) ){
                    if ( ( count($cn_data['cn']) >= 2 ) && ( count($cn_data['cn']) < 9 ) ){

                    $position = $cn_data['position'];

                    if ( $cn_data['menu-style'] == "text" ) {
                        $button_output = '<div class="cn-button" id="cn-button"><span id="cn-button-text" class="cn-button-text">more</span></div>';
                        $button_script_output = '
                            <script>
                            (function($){
                                 changeCnBtnContent = function(way) {
                                     if ( way == "open" ){ $("#cn-button-text").html("close"); }
                                     else if ( way == "close" ){ $("#cn-button-text").html("more"); }
                                  };
                             })(jQuery);
                             </script>';
                    }

                    $output = '
                        <div id="circular-nav" class="circular-nav">
                                        <!-- Start Fixed Circular Navigation Structure -->
                                        '.$button_output.'
                                        <div class="cn-wrapper" id="cn-wrapper"></div>
                                        <div id="cn-overlay" class="cn-overlay"></div>
                                        <!-- End Fixed Circular Navigation Structure -->
                        </div>
                        '.$button_script_output.'';

                    echo $output;

                } 
              }
                
        
            }
            
        }

}
