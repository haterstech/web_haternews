<?php
namespace SiteGround_Optimizer\Front_End_Optimization;

use SiteGround_Optimizer\Options\Options;
use SiteGround_Optimizer\Emojis_Removal\Emojis_Removal;
use SiteGround_Optimizer\Lazy_Load_Images\Lazy_Load_Images;
use SiteGround_Optimizer\Images_Optimizer\Images_Optimizer;
use SiteGround_Optimizer\Minifier\Minifier;
use SiteGround_Optimizer\Combinator\Combinator;
use SiteGround_Optimizer\Helper\Helper;
/**
 * SG Front_End_Optimization main plugin class
 */
class Front_End_Optimization {

	/**
	 * The dir where the minified styles and scripts will be saved.
	 *
	 * @since 5.0.0
	 *
	 * @var string|null Path to assets dir.
	 */
	public $assets_dir = null;

	/**
	 * Script handles that shouldn't be loaded async.
	 *
	 * @since 5.0.0
	 *
	 * @var array Array of script handles that shouldn't be loaded async.
	 */
	private $blacklisted_async_scripts = array(
		'jquery',
		'jquery-core',
		'moxiejs',
	);

	/**
	 * The singleton instance.
	 *
	 * @since 5.1.0
	 *
	 * @var \Front_End_Optimization The singleton instance.
	 */
	private static $instance;

	/**
	 * Create a {@link Supercacher} instance.
	 *
	 * @since 5.0.0
	 */
	public function __construct() {
		$this->run();
	}

	/**
	 * Run the frontend optimization.
	 *
	 * @since  5.0.0
	 */
	private function run() {
		// Set the assets dir path.
		$this->set_assets_directory_path();

		self::$instance = $this;

		// Enabled lazy load images.
		if ( Options::is_enabled( 'siteground_optimizer_optimize_images' ) ) {
			new Images_Optimizer();
		}


		if (
			is_admin() ||
			$this->check_for_builders()
		) {
			return;
		}

		// Remove query strings only if the option is emabled.
		if ( Options::is_enabled( 'siteground_optimizer_remove_query_strings' ) ) {
			// Filters for static style and script loaders.
			add_filter( 'style_loader_src', array( $this, 'remove_query_strings' ) );
			add_filter( 'script_loader_src', array( $this, 'remove_query_strings' ) );
		}

		// Disable emojis if the option is enabled.
		if ( Options::is_enabled( 'siteground_optimizer_disable_emojis' ) ) {
			new Emojis_Removal();
		}

		// Enabled lazy load images.
		if ( Options::is_enabled( 'siteground_optimizer_lazyload_images' ) ) {
			new Lazy_Load_Images();
		}

		if ( Options::is_enabled( 'siteground_optimizer_combine_css' ) ) {
			new Combinator();
		}

		// Enabled async load js files.
		if ( Options::is_enabled( 'siteground_optimizer_optimize_javascript_async' ) ) {
			add_action( 'wp_print_scripts', array( $this, 'prepare_scripts_for_async_load' ), PHP_INT_MAX );

			// Add async attr to all scripts.
			add_filter( 'script_loader_tag', array( $this, 'add_async_attribute' ), 10, 3 );
		}

		new Minifier();
	}

	/**
	 * Get the singleton instance.
	 *
	 * @since 5.1.0
	 *
	 * @return \Front_End_Optimization The singleton instance.
	 */
	public static function get_instance() {
		return self::$instance;
	}

	/**
	 * Set the assets directory.
	 *
	 * @since  5.1.0
	 */
	private function set_assets_directory_path() {
		// Bail if the assets dir has been set.
		if ( null !== $this->assets_dir ) {
			return;
		}

		// Get the uploads dir.
		$upload_dir = wp_upload_dir();

		// Build the assets dir name.
		$directory = $upload_dir['basedir'] . '/siteground-optimizer-assets';

		// Check if directory exists and try to create it if not.
		$is_directory_created = ! is_dir( $directory ) ? $this->create_directory( $directory ) : true;

		// Set the assets dir.
		if ( $is_directory_created ) {
			$this->assets_dir = trailingslashit( $directory );
		}
	}

	/**
	 * Create directory.
	 *
	 * @since  5.1.0
	 *
	 * @param  string $directory The new directory path.
	 *
	 * @return bool              True is the directory is created.
	 *                           False on failure.
	 */
	private function create_directory( $directory ) {
		// Create the directory and return the result.
		$is_directory_created = wp_mkdir_p( $directory );

		// Bail if cannot create temp dir.
		if ( false === $is_directory_created ) {
			// translators: `$directory` is the name of directory that should be created.
			error_log( sprintf( 'Cannot create directory: %s.', $directory ) );
		}

		return $is_directory_created;
	}

	/**
	 * Get the original filepath by file handle.
	 *
	 * @since  5.1.0
	 *
	 * @param  string $original File handle.
	 *
	 * @return string           Original filepath.
	 */
	public static function get_original_filepath( $original ) {
		$home_url = Helper::get_home_url();
		// Get the home_url from database. Some plugins like qtranslate for example,
		// modify the home_url, which result to wrong replacement with ABSPATH for resources loaded via link.
		// Very ugly way to handle resources without protocol.
		$result = parse_url( $home_url );

		$replace = $result['scheme'] . '://';

		$new = preg_replace( '~^https?:\/\/|^\/\/~', $replace, $original );

		// Get the filepath to original file.
		if ( strpos( $new, $home_url ) !== false ) {
			$original_filepath = str_replace( $home_url, ABSPATH, $new );
		} else {
			$original_filepath = untrailingslashit( ABSPATH ) . $new;
		}

		return $original_filepath;
	}

	/**
	 * Return the path to assets dir.
	 *
	 * @since  5.1.0
	 *
	 * @return string Path to assets dir.
	 */
	public function get_assets_dir() {
		return $this->assets_dir;
	}


	/**
	 * Prepare scripts to be included async.
	 *
	 * @since  5.1.0
	 */
	public function prepare_scripts_for_async_load() {
		global $wp_scripts;

		// Bail if the scripts object is empty.
		if ( ! is_object( $wp_scripts ) ) {
			return;
		}

		$scripts = wp_clone( $wp_scripts );
		$scripts->all_deps( $scripts->queue );

		$excluded_scripts = apply_filters( 'sgo_js_async_exclude', $this->blacklisted_async_scripts );

		// Get groups of handles.
		foreach ( $scripts->to_do as $handle ) {
			// We don't want to load footer scripts asynchronous.
			if (
				$scripts->groups[ $handle ] > 0 ||
				in_array( $handle, $excluded_scripts ) ||
				empty( $wp_scripts->registered[ $handle ]->src )
			) {
				continue;
			}

			$wp_scripts->registered[ $handle ]->src = add_query_arg( 'siteground-async', 1, $wp_scripts->registered[ $handle ]->src );
		}
	}

	/**
	 * Load all scripts async.
	 * This function adds async attr to all scripts.
	 *
	 * @since 5.1.0
	 *
	 * @param string $tag    The <script> tag for the enqueued script.
	 * @param string $handle The script's registered handle.
	 * @param string $src    Script src.
	 */
	public function add_async_attribute( $tag, $handle, $src ) {
		if ( strpos( $src, 'siteground-async=1' ) !== false ) {
			$new_src = remove_query_arg( 'siteground-async', $src );
			// return the tag with the async attribute.
			return str_replace(
				array(
					'<script ',
					'-siteground-async',
					$src,
				),
				array(
					'<script async ',
					'',
					$new_src,
				),
				$tag
			);
		}

		return $tag;
	}

	/**
	 * Remove query strings from static resources.
	 *
	 * @since  5.0.0
	 *
	 * @param  string $src The source URL of the enqueued style.
	 *
	 * @return string $src The modified src if there are query strings, the initial src otherwise.
	 */
	public static function remove_query_strings( $src ) {
		return remove_query_arg(
			array(
				'ver',
				'version',
				'v',
				'generated',
			),
			$src
		);
	}

	/**
	 * Checks if the page is being rendered via page builder.
	 *
	 * @since  5.1.2
	 *
	 * @return bool True/false.
	 */
	private function check_for_builders() {

		$builder_paramas = apply_filters( 'sgo_pb_params', array( 'fl_builder', 'vcv-action', 'et_fb' ) );

		foreach ( $builder_paramas as $param ) {
			if ( isset( $_GET[ $param ] ) ) {
				return true;
			}
		}

		return false;
	}

}
