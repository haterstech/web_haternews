<?php 
/*
Plugin Name: QQWorld Auto Save Images
Plugin URI: https://wordpress.org/plugins/qqworld-auto-save-images/
Description: Automatically keep the all remote picture to the local, and automatically set featured image.
Version: 1.9.6
Author: Michael Wang
Author URI: http://www.qqworld.org
Text Domain: qqworld_auto_save_images
*/
define('QQWORLD_AUTO_SAVE_IMAGES_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('QQWORLD_AUTO_SAVE_IMAGES_URL', plugin_dir_url(__FILE__));

class QQWorld_auto_save_images {
	var $text_domain = 'qqworld_auto_save_images';
	var $mode;
	var $when;
	var $type;
	var $remote_publishing;

	var $thumbnail_id = 0; // featured image id
	var $current_post_id; // for xmlrpc
	var $change_image_name;
	var $has_remote_image;
	var $has_missing_image;
	var $count;
	var $only_save_first;
	var $minimum_picture_size;
	var $maximum_picture_size;
	var $exclude_domain;
	var $format;
	var $filename_structure;
	var $change_title_alt;
	var $save_outside_links;
	var $auto_caption;
	var $format_align_to;
	var $link_to;
	var $additional_content;

	function __construct() {
		$this->classic_edition = get_option('qqworld_auto_save_images_classic_edition', 'enable');
		$this->mode = get_option('qqworld_auto_save_images_mode', 'auto');
		$this->when = get_option('qqworld_auto_save_images_when', 'publish');
		$this->remote_publishing = get_option('qqworld_auto_save_images_remote_publishing', 'yes');
		$this->schedule_publish = get_option('qqworld_auto_save_images_schedule_publish', 'yes');
		$this->featured_image = get_option('qqworld_auto_save_images_set_featured_image', 'yes');
		$this->only_save_first = get_option('qqworld_auto_save_images_only_save_first', 'all');
		$this->change_image_name = get_option('qqworld_auto_save_images_auto_change_name', 'none');
		// temporary start
		$this->change_image_name = $this->change_image_name == 'yes' ? 'ascii' : $this->change_image_name;
		// temporary end
		$this->minimum_picture_size = get_option('qqworld_auto_save_images_minimum_picture_size', array('width'=>32, 'height'=>32));
		$this->maximum_picture_size = get_option('qqworld_auto_save_images_maximum_picture_size', array('width'=>1280, 'height'=>1280));
		$this->exclude_domain = get_option('qqworld-auto-save-images-exclude-domain');
		$this->format = get_option('qqworld-auto-save-images-format', array('size'=>'full', 'link-to'=>'none'));
		$this->change_title_alt = isset($this->format['title-alt']) ? $this->format['title-alt'] : 'no';
		$this->filename_structure = isset($this->format['filename-structure']) ? $this->format['filename-structure'] : '%filename%';
		$this->keep_outside_links = isset($this->format['keep-outside-links']) ? $this->format['keep-outside-links'] : 'no';
		$this->save_outside_links = isset($this->format['save-outside-links']) ? $this->format['save-outside-links'] : 'no';
		$this->additional_content = isset($this->format['additional-content']) ? $this->format['additional-content'] : array('before'=>'', 'after'=>'');
		$this->auto_caption = isset($this->format['auto-caption']) ? $this->format['auto-caption'] : 'no';
		$this->format_link_to = isset($this->format['link-to']) ? $this->format['link-to'] : 'none';
		$this->format_align_to = isset($this->format['align-to']) ? $this->format['align-to'] : 'none';

		if ($this->classic_edition == 'enable') add_filter('use_block_editor_for_post', '__return_false');

		switch ($this->mode) {
			case 'auto':
				$this->add_actions();
				break;
			case 'manual':
				add_action( 'media_buttons', array($this, 'media_buttons' ), 11 );
				add_action( 'wp_ajax_save_remote_images', array($this, 'save_remote_images') );
				add_action( 'wp_ajax_nopriv_save_remote_images', array($this, 'save_remote_images') );	
				break;
		}
		if ($this->schedule_publish == 'yes') add_action( 'publish_future_post', array($this, 'fetch_images_after_save') );
		if ($this->remote_publishing) add_action('xmlrpc_publish_post', array($this, 'fetch_images_after_save') );

		add_action( 'wp_ajax_get_scan_list', array($this, 'get_scan_list') );
		add_action( 'wp_ajax_nopriv_get_scan_list', array($this, 'get_scan_list') );
		add_action( 'wp_ajax_save_remote_images_get_categories_list', array($this, 'save_remote_images_get_categories_list') );
		add_action( 'wp_ajax_nopriv_save_remote_images_get_categories_list', array($this, 'save_remote_images_get_categories_list') );
		add_action( 'wp_ajax_save_remote_images_after_scan', array($this, 'save_remote_images_after_scan') );
		add_action( 'wp_ajax_nopriv_save_remote_images_after_scan', array($this, 'save_remote_images_after_scan') );
		add_action( 'wp_ajax_save_remote_images_list_all_posts', array($this, 'save_remote_images_list_all_posts') );
		add_action( 'wp_ajax_nopriv_save_remote_images_list_all_posts', array($this, 'save_remote_images_list_all_posts') );
		add_action( 'wp_ajax_save_remote_images-get-auto-saved-results', array($this, 'save_remote_images_get_auto_saved_results') );
		add_action( 'wp_ajax_nopriv_save_remote_images-get-auto-saved-results', array($this, 'save_remote_images_get_auto_saved_results') );
		
		
		add_action( 'plugins_loaded', array($this, 'load_language') );
		add_action( 'admin_menu', array($this, 'admin_menu') );
		add_action( 'admin_init', array($this, 'register_settings') );
		add_filter( 'plugin_row_meta', array($this, 'registerPluginLinks'),10,2 );

		add_action( 'admin_enqueue_scripts', array($this, 'add_to_post_php') );
		add_action( 'admin_enqueue_scripts', array($this, 'add_to_page_qqworld_auto_save_images') );

		add_filter( 'post_updated_messages', array($this, 'post_updated_messages') );
		add_filter( 'qqworld-auto-save-images-custom-filename-structure', array($this, 'custom_filename_structure') );
		add_action( 'admin_notices', array($this, 'admin_notices') );
		add_filter( 'qqworld-auto-save-images-string-compatible', array($this, 'string_compatible_vietnamese_to_english') );
	}

	public function string_compatible_vietnamese_to_english($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		//$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
		return $str;
	}

	public function languages() {
		__('Michael Wang', $this->text_domain);
		__(' (In Development)', $this->text_domain);
	}

	public function admin_notices() {
		$screen = get_current_screen();
		if (strstr($screen->id, 'qqworld-auto-save-images')) {
			settings_errors();
			if (!function_exists('curl_init')) add_settings_error('qqworld-auto-save-images', esc_attr('needs_php_lib'), __("Your server PHP does not support cUrl, please remove ';' from in front of extension=php_curl.dll in the php.ini.", $this->text_domain), 'error' );
			if (!function_exists('imagecreate')) add_settings_error('qqworld-auto-save-images', esc_attr('needs_php_lib'), __("Your server PHP does not support GD2, please remove ';' from in front of extension=php_gd2.dll in the <strong>php.ini</strong>.", $this->text_domain), 'error' );
			if (!function_exists('file_get_contents')) add_settings_error('qqworld-auto-save-images', esc_attr('needs_php_lib'), __('Your server PHP does not support fopen, please set allow_url_fopen=1 in the php.ini.', $this->text_domain), 'error' );
			settings_errors('qqworld-auto-save-images');
		}
	}

	public function custom_filename_structure($filename) {
		$blogtime = current_time( 'mysql' );
		list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = preg_split( '([^0-9])', $blogtime );
		$date = $today_year . $today_month . $today_day;
		$year = $today_year;
		$month = $today_month;
		$day = $today_day;
		$time = $hour . $minute . $second;
		$timestamp = current_time('timestamp');
		$filename_structure = str_replace('%filename%', $filename, $this->filename_structure );
		$filename_structure = str_replace('%date%', $date, $filename_structure );
		$filename_structure = str_replace('%year%', $year, $filename_structure );
		$filename_structure = str_replace('%month%', $month, $filename_structure );
		$filename_structure = str_replace('%day%', $day, $filename_structure );
		$filename_structure = str_replace('%time%', $time, $filename_structure );
		$filename = str_replace('%timestamp%', $timestamp, $filename_structure );
		return $filename;
	}

	public function save_remote_images_get_categories_list() {
		if (isset($_REQUEST['posttype']) && !empty($_REQUEST['posttype'])) {
			$posttype = $_REQUEST['posttype'];
			$taxonomies = get_object_taxonomies($posttype);
			if (!empty($taxonomies)) foreach ($taxonomies as $tax) {
				$taxonomy = get_taxonomy($tax);
				echo '<div id="'.$tax.'div" post-type="'.$tax.'" class="postbox"><div class="hndle">'.$taxonomy->labels->name.'</div><div class="inside"><div id="'.$tax.'-all" class="tabs-panel"><ul>';
				wp_terms_checklist('', array(
					'taxonomy' => $tax,
					'walker' => new QQWorld_Save_Remote_Images_Walker_Category_Checklist
				));
				echo '</ul></div></div></div>';
			} else _e('No taxonomies found.', $this->text_domain);
		}
		exit;
	}

	public function post_updated_messages($messages) {
		global $post, $post_ID;
		$post_type = get_post_type( $post_ID );
		$messages[$post_type][21] = __('All remote images have been saved.', $this->text_domain) . sprintf( __(' <a href="%s">View</a>', $this->text_domain), esc_url( get_permalink($post_ID) ) );
		$messages[$post_type][22] = __('Has missing images or image which could not download.', $this->text_domain) . sprintf( __(' <a href="%s">View</a><script>alert("警告：內容包含不存在/無法下載的圖像！！！");</script>', $this->text_domain), esc_url( get_permalink($post_ID) ) );
		return $messages;
	}

	public function redirect_post_location($location, $post_id) {
		if ($this->has_remote_image) {
			if ($this->has_missing_image) $location = add_query_arg( 'message', 22, get_edit_post_link( $post_id, 'url' ) );
			else $location = add_query_arg( 'message', 21, get_edit_post_link( $post_id, 'url' ) );
		}		
		return $location;
	}

	public function add_to_post_php() {
		global $post;
		if ( $this->mode == 'manual' && ($GLOBALS['hook_suffix'] == 'post.php' || $GLOBALS['hook_suffix'] == 'post-new.php') ) {
			wp_register_script('noty', QQWORLD_AUTO_SAVE_IMAGES_URL . 'js/jquery.noty.packaged.min.js', array('jquery') );
			wp_enqueue_script('noty');
			wp_register_style('qqworld-auto-save-images-style-post', QQWORLD_AUTO_SAVE_IMAGES_URL . 'css/manual.css' );
			wp_enqueue_style('qqworld-auto-save-images-style-post');
			wp_register_script('qqworld-auto-save-images-script-post', QQWORLD_AUTO_SAVE_IMAGES_URL . 'js/manual.js', array('jquery') );
			wp_enqueue_script('qqworld-auto-save-images-script-post');
			$translation_array = array(
				'post_id' => $post->ID,
				'in_process' => __('In Process...', $this->text_domain),
				'error' => __('Something error, please check.', $this->text_domain),
				'save_remote_images' => __('Save Remote Images', $this->text_domain)
			);
			wp_localize_script('qqworld-auto-save-images-script-post', 'QASI', $translation_array, '3.0.0');
		}

		if ( $this->mode == 'auto' && ($GLOBALS['hook_suffix'] == 'post.php' || $GLOBALS['hook_suffix'] == 'post-new.php') ) {
			wp_register_script('noty', QQWORLD_AUTO_SAVE_IMAGES_URL . 'js/jquery.noty.packaged.min.js', array('jquery') );
			wp_enqueue_script('noty');
			wp_register_script('qqworld-auto-save-images-script-post', QQWORLD_AUTO_SAVE_IMAGES_URL . 'js/auto.js', array('jquery') );
			wp_enqueue_script('qqworld-auto-save-images-script-post');
			$translation_array = array(
				'post_id' => $post->ID
			);
			wp_localize_script('qqworld-auto-save-images-script-post', 'QASI', $translation_array, '3.0.0');
		}
	}

	public function add_to_page_qqworld_auto_save_images() {
		if ( preg_match('/qqworld-auto-save-images$/i', $GLOBALS['hook_suffix'], $matche) ) {
			wp_register_script('noty-4-save', QQWORLD_AUTO_SAVE_IMAGES_URL . 'js/jquery.noty.packaged.min.js', array('jquery') );
			wp_enqueue_script('noty-4-save');
			wp_register_style('qqworld-auto-save-images-style', QQWORLD_AUTO_SAVE_IMAGES_URL . 'css/style.css' );
			wp_enqueue_style('qqworld-auto-save-images-style');
			wp_register_style('jquery-ui-style', QQWORLD_AUTO_SAVE_IMAGES_URL . 'css/jquery-ui/jquery-ui.min.css' );
			wp_enqueue_style('jquery-ui-style');

			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-position');
			wp_enqueue_script('jquery-ui-tooltip');
			wp_enqueue_script('jquery-ui-draggable');

			wp_enqueue_script('jquery-effects-core');
			wp_enqueue_script('jquery-effects-shake');

			wp_register_script('qqworld-auto-save-images-script', QQWORLD_AUTO_SAVE_IMAGES_URL . 'js/admin.js', array('jquery') );
			wp_enqueue_script('qqworld-auto-save-images-script');
			wp_enqueue_media();
			$translation_array = array(
				'are_your_sure' => __('Are you sure?<br />Before you click the yes button, I recommend backup site database.', $this->text_domain),
				'pls_select_post_types' => __('Please select post types.', $this->text_domain),
				'maybe_problem' => __('May be a problem with some posts: ', $this->text_domain),
				'no_need_enter_' => __("No need enter \"%s\".", $this->text_domain),
				'n_post_has_been_scanned' => __( '%d post has been scanned.', $this->text_domain),
				'n_posts_have_been_scanned' => __( '%d posts have been scanned.', $this->text_domain),
				'n_post_included_remote_images_processed' => __( '%d post included remote images processed.', $this->text_domain),
				'n_posts_included_remote_images_processed' => __( '%d posts included remote images processed.', $this->text_domain),
				'n_post_has_missing_images_couldnt_be_processed' => __( "%d post has missing images couldn't be processed.", $this->text_domain),
				'n_posts_have_missing_images_couldnt_be_processed' => __( "%d posts have missing images couldn't be processed.", $this->text_domain),
				'found_n_post_including_remote_images' => __( 'found %d post including remote images.', $this->text_domain),
				'found_n_posts_including_remote_images' => __( 'found %d posts including remote images.', $this->text_domain),
				'and_with_n_post_has_missing_images' => __( "And with %d post has missing images.", $this->text_domain),
				'and_with_n_posts_have_missing_images' => __( "And with %d posts have missing images.", $this->text_domain),
				'no_posts_processed' => __( "No posts processed.", $this->text_domain),
				'no_post_has_remote_images_found' => __('No post has remote images found.', $this->text_domain),
				'no_posts_found' => __('No posts found.', $this->text_domain),
				'all_done' => __('All done.', $this->text_domain),
				'yes' => __('Yes'),
				'no' => __('No'),
				'scanning' => __('Scanning...', $this->text_domain),
				'listing' => __('Listing...', $this->text_domain),
				'id' => __('ID'),
				'post_type' => __('Post Type', $this->text_domain),
				'title' => __('Title'),
				'status' => __('Status'),
				'control' => __('Control', $this->text_domain),
				'done' => __('Done'),
				'delete' => __('Delete')
			);
			wp_localize_script('qqworld-auto-save-images-script', 'QASI', $translation_array, '3.0.0');
		}
	}

	public function get_scan_list() {
		if ( !current_user_can( 'manage_options' ) ) return;
		$args = array();

		//post types
		$post_types = isset($_REQUEST['qqworld_auto_save_images_post_types']) ? $_REQUEST['qqworld_auto_save_images_post_types'] : 'post';
		$args['post_type'] = $post_types;

		//cagegory
		if (isset($_REQUEST['terms']) && !empty($_REQUEST['terms'])) {
			$terms = $_REQUEST['terms'];
			$args['tax_query'] = array(
				'relation' => 'OR'
			);
			foreach ($terms as $taxonomy => $term_ids) {
				$args['tax_query'][] = array(
					'taxonomy' => $taxonomy,
					'terms' => $term_ids,
					'field' => 'id'
				);
			}
		}
		// Scope of ID
		$id_from = $_REQUEST['id_from'];
		$id_to = $_REQUEST['id_to'];
		$id_from = $id_from=='0' ? 1 : $id_from;
		$id_to = $id_to=='0' ? 1 : $id_to;
		$post__in = array();
		if (!empty($id_from) && is_numeric($id_from) && empty($id_to)) {
				$post__in[] = $id_from;
		} elseif (empty($id_from) && !empty($id_to) && is_numeric($id_to)) {
			$post__in[] = $id_to;
		} elseif (!empty($id_from) && is_numeric($id_from) && !empty($id_to) && is_numeric($id_to)) {
			if ($id_from == $id_to) $post__in[] = $id_from;
			elseif ($id_from < $id_to) for ($s=$id_from; $s<=$id_to; $s++) $post__in[]=$s;
			elseif($id_from > $id_to) for ($s=$id_from; $s>=$id_to; $s--) $post__in[]=$s;
		}
		$args['post__in'] = $post__in;

		// Offset
		$offset = empty($_REQUEST['offset']) ? 0 : $_POST['offset'];
		$args['offset'] = $offset;

		// posts per page
		$posts_per_page = $_REQUEST['posts_per_page'];
		$args['posts_per_page'] = $posts_per_page;

		// order
		$args['order'] = $_REQUEST['order'];

		// status
		$args['post_status'] = $_REQUEST['post_status'];

		// orderby
		$args['orderby'] = $_REQUEST['orderby'];

		//echo '<pre>'; print_r($args); echo '</pre>';
		$posts = get_posts($args);
		$result=array();
		foreach ($posts as $post) array_push($result, $post->ID);
		echo json_encode($result);
		exit;
	}

	public function save_remote_images_after_scan() {
		set_time_limit(0);
		if ( !current_user_can( 'manage_options' ) ) return;
		$post_ids = $_REQUEST['post_id'];
		if (!empty($post_ids)) foreach ($post_ids as $post_id) :
			$this->has_remote_image = 0;
			$this->has_missing_image = 0;
			$post = get_post($post_id);
			$post_id = $post->ID;
			$post_type =  $post->post_type;
			$content = $post->post_content;
			$title = $post->post_title;
			$content = $this->content_save_pre($content, $post_id);
			wp_update_post(array('ID' => $post_id, 'post_content' => $content));

			$post_type_object = get_post_type_object($post_type);
			if ($this->has_remote_image) :
				$class = 'has_remote_images';
				if ($this->has_missing_image) $class .= ' has_not_exits_remote_images';
				$class = ' class="' . $class . '"';
?>
			<tr<?php echo $class; ?>>
				<td><?php echo $post_id; ?></td>
				<td><?php echo $post_type_object->labels->name; ?></td>
				<td><a href="<?php echo get_edit_post_link($post_id); ?>" target="_blank"><?php echo $title; ?> &#8667;</a></td>
				<td><?php echo $this->has_missing_image ? '<span class="red">'.__('Has missing images.', $this->text_domain).'</span>' : '<span class="green">'.__('All remote images have been saved.', $this->text_domain).'</span>'; ?></td>
			</tr>
<?php else: ?>
			<tr>
				<td colspan="4" class="hr"></td>
			</tr>
<?php		endif;
		endforeach;
		exit;
	}

	public function save_remote_images_list_all_posts() {
		set_time_limit(0);
		if ( !current_user_can( 'manage_options' ) ) return;
		$post_ids = $_REQUEST['post_id'];
		if (!empty($post_ids)) foreach ($post_ids as $post_id) :
			$this->has_remote_image = 0;
			$this->has_missing_image = 0;
			$post = get_post($post_id);
			$post_id = $post->ID;
			$post_type =  $post->post_type;
			$content = $post->post_content;
			$title = $post->post_title;

			$content = $this->content_save_pre($content, $post_id, 'scan');

			if ($this->has_remote_image) :
				$post_type_object = get_post_type_object($post_type);
				$class = $this->has_missing_image ? ' has_not_exits_remote_images' : '';
?>
			<tr class="has_remote_images<?php echo $class; ?>">
				<td><?php echo $post_id; ?></td>
				<td><?php echo $post_type_object->labels->name; ?></td>
				<td><a href="<?php echo get_edit_post_link($post_id); ?>" target="_blank"><?php echo $title; ?> &#8667;</a></td>
				<td><?php echo $this->has_missing_image ? '<span class="red">'.__('Has missing images.', $this->text_domain).'</span>' : __('Normal', $this->text_domain); ?></a></td>
				<td id="list-<?php echo $post_id; ?>"><input type="button" post-id="<?php echo $post_id; ?>" class="fetch-remote-images button button-primary" value="&#9997; <?php _e('Fetch', $this->text_domain); ?>" /></td>
			</tr>
<?php else: ?>
			<tr>
				<td colspan="5" class="hr"></td>
			</tr>
<?php		endif;
		endforeach;
		exit;
	}

	public function save_remote_images_get_auto_saved_results() {
		if (!isset($_POST['post_id'])) exit;

		$post = get_post($_POST['post_id']);
		$results = array(
			'post_content' => $post->post_content
		);
		if (has_post_thumbnail($_POST['post_id'])) $results['thumbnail_id'] = get_post_thumbnail_id($_POST['post_id']);
		print json_encode($results);
		exit;
	}

	public function media_buttons() {
	?>
		<style>
		.button.save_remote_images span.wp-media-buttons-icon:before {
			font: 400 18px/1 dashicons;
			speak: none;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			content: '\f161';
		}
		#save-remote-images-button {
			-webkit-transition: all .25s;
			-moz-transition: all .25s;
			-o-transition: all .25s;
			-ms-transition: all .25s;
			transition: all .25s;
		}
		#save-remote-images-button.success {
			-webkit-transform: scale(1.1);
			-moz-transform: scale(1.1);
			-o-transform: scale(1.1);
			-ms-transform: scale(1.1);
			transform: scale(1.1);
		}
		ul[id^="noty_"] li {
			margin-bottom: 0;
		}
		#noty_center_layout_container img {
			vertical-align: middle;
		}
		</style>
		<a href="javascript:" id="save-remote-images-button" class="button save_remote_images" title="<?php _e('Save Remote Images', $this->text_domain); ?>"><span class="wp-media-buttons-icon"></span><?php _e('Save Remote Images', $this->text_domain); ?></a>
	<?php
	}

	public function load_language() {
		load_plugin_textdomain( $this->text_domain, dirname( __FILE__ ) . '/lang' . 'lang', basename( dirname( __FILE__ ) ) . '/lang' );
	}

	function registerPluginLinks($links, $file) {
		$base = plugin_basename(__FILE__);
		if ($file == $base) {
			$links[] = '<a href="' . menu_page_url( 'qqworld-auto-save-images', 0 ) . '">' . __('Settings') . '</a>';
		}
		return $links;
	}

	function admin_menu() {
		$page_name = 'qqworld-auto-save-images';
		if ( is_plugin_active( 'qqworld-collector/qqworld-collector.php' ) ) {
			$settings_page = add_submenu_page('qqworld-collector', __('Auto Save Images', $this->text_domain), __('Auto Save Images', $this->text_domain), 'manage_options', $page_name, array($this, 'fn'));
		} else {
			$settings_page = add_submenu_page('options-general.php', __('QQWorld Auto Save Images', $this->text_domain), __('QQWorld Auto Save Images', $this->text_domain), 'manage_options', $page_name, array($this, 'fn'));
		}
		add_action( "load-{$settings_page}", array($this, 'help_tab') );
	}

	public function help_tab() {
		$screen = get_current_screen();
		$screen->add_help_tab( array( 
			'id' => 'qqworld-auto-save-images-installation',
			'title' => __('Installation', $this->text_domain),
			'content' => __('<ol><li>Make sure the server configuration <strong>allow_url_fopen=1</strong> in php.ini.</li><li>Warning: If your website domain has been changed, you must modify all image link to new domain from database, or else all images which not modified in post content will be save again.</li></ol>', $this->text_domain)
		) );
		$screen->add_help_tab( array( 
			'id' => 'qqworld-auto-save-images-notice',
			'title' => __('Notice', $this->text_domain),
			'content' => __("<ul><li>This plugin has a little problem that is all the image url must be full url, it means must included \"http(s)://\", for example:<ul><li>&lt;img src=&quot;http://img.whitehouse.gov/image/2014/08/09/gogogo.jpg&quot; /&gt;</li><li>&lt;img src=&quot;http://www.bubugao.me/image/travel/beijing.png?date=20140218&quot; /&gt;</li>			<li>&lt;img src=&quot;http://r4.ykimg.com/05410408543927D66A0B4D03A98AED24&quot; /&gt;</li><li>&lt;img src=&quot;https://example.com/image?id=127457&quot; /&gt;</li></ul></li><li>The examples that not works:<ul><li>&lt;img src=&quot;/images/great.png&quot; /&gt;</li><li>&lt;img src=&quot;./photo-lab/2014-08-09.jpg&quot; /&gt;</li><li>&lt;img src=&quot;img/background/black.gif&quot; /&gt;</li></ul></li></ul>I'v tried to figure this out, but i couldn't get the host name to make image src full.<br />So if you encounter these codes, plaese manually fix the images src to full url.", $this->text_domain)
		) );
		$screen->add_help_tab( array( 
			'id' => 'qqworld-auto-save-images-about',
			'title' => __('About'),
			'content' => __("<p>Hi everyone, My name is Michael Wang from china.</p><p>I made this plugin just for play in the first place, after 1 year, oneday someone sent an email to me for help , I was surprise and glad to realized my plugin has a fan. then more and more peoples asked me for helps, and my plugin was getting more and more powerful. Now this's my plugin. I hope you will like it, thanks.</p>", $this->text_domain)
		) );
	}

	function fn() {
?>
<div class="wrap" id="qqworld-auto-save-images-container">
	<h2><?php _e('QQWorld Auto Save Images', $this->text_domain); ?></h2>
	<p><?php _e('Automatically keep the all remote picture to the local, and automatically set featured image.', $this->text_domain); ?>
	<form action="options.php" method="post" id="form">
		<?php settings_fields('qqworld_auto_save_images_settings'); ?>
		<img src="<?php echo QQWORLD_AUTO_SAVE_IMAGES_URL; ?>images/banner-772x250.jpg" width="772" height="250" class="qc-banner" />
		<ul id="qqworld-auto-save-images-tabs">
			<li class="current"><?php _e('General'); ?></li>
			<li><?php _e('Filter', $this->text_domain); ?></li>
			<li><?php _e('Format', $this->text_domain); ?></li>
			<li><?php _e('Scan Posts', $this->text_domain); ?></li>
			<li><?php _e('Commercial Edition', $this->text_domain); ?></li>
			<li class="hidden"><?php _e('Products', $this->text_domain); ?></li>
			<li><?php _e('Contact', $this->text_domain); ?></li>
		</ul>
		<div class="tab-content">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label><?php _e('Classic Edition', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Classic Edition', $this->text_domain); ?></span></legend>
							<label for="enable">
								<input name="qqworld_auto_save_images_classic_edition" type="radio" id="enable" value="enable" <?php checked('enable', $this->classic_edition); ?> />
								<?php _e('Enable', $this->text_domain); ?>
							</label><br />
							<label for="disable">
								<input name="qqworld_auto_save_images_classic_edition" type="radio" id="disable" value="disable" <?php checked('disable', $this->classic_edition); ?> />
								<?php _e('Disable', $this->text_domain); ?>
							</label>
							<p class="description"><?php printf(__('This plugin only supports the classic editor.<br />If you want to use the Gutenberg editor, please purchase the Professional Edition of the <a href="%s" target="_blank">QQWorld Collector Deluxe</a>.<br />If you don’t want to buy the commercial version and you have to use the Gutenberg editor, it is recommended to turn on the automatic mode and refresh the page after saving the remote images.', $this->text_domain), __('https://www.qqworld.org/product/qqworld-collector?locale=en_US', $this->text_domain)); ?></p>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Mode', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Mode', $this->text_domain); ?></span></legend>
								<label for="auto">
									<input name="qqworld_auto_save_images_mode" type="radio" id="auto" value="auto" <?php checked('auto', $this->mode); ?> />
									<?php _e('Automatic', $this->text_domain); ?>
								</label> <span class="icon help" title="<?php _e('Automatically save all remote images to local media libary when you save or publish post.', $this->text_domain); ?>"></span><br />
								<label for="manual">
									<input name="qqworld_auto_save_images_mode" type="radio" id="manual" value="manual" <?php checked('manual', $this->mode); ?> />
									<?php _e('Manual', $this->text_domain); ?>
								</label> <span class="icon help" title="<?php _e('Manually save all remote images to local media libary when you click the button on the top of editor.', $this->text_domain); ?>"></span>
						</fieldset></td>
					</tr>
					
					<tr id="second_level" valign="top"<?php if ($this->mode != 'auto') echo ' style="display: none;"'; ?>>
						<th scope="row"><label><?php _e('When', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('When', $this->text_domain); ?></span></legend>
								<label for="save">
									<input name="qqworld_auto_save_images_when" type="radio" id="save" value="save" <?php checked('save', $this->when); ?> />
									<?php _e('Save post (Publish, save draft or pedding review).', $this->text_domain); ?>
								</label><br />
								<label for="publish">
									<input name="qqworld_auto_save_images_when" type="radio" id="publish" value="publish" <?php checked('publish', $this->when); ?> />
									<?php _e('Publish post only.', $this->text_domain); ?>
								</label>
						</fieldset></td>
					</tr>

					<tr valign="top">
						<th scope="row"><label><?php _e('Schedule Publish', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Save remote images via Schedule Publish.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Schedule Publish', $this->text_domain); ?></span></legend>
								<label for="qqworld_auto_save_images_schedule_publish">
									<input name="qqworld_auto_save_images_schedule_publish" type="checkbox" id="qqworld_auto_save_images_schedule_publish" value="yes" <?php checked('yes', $this->schedule_publish); ?> />
								</label>
						</fieldset></td>
					</tr>

					<tr valign="top">
						<th scope="row"><label><?php _e('Remote Publishing', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Save remote images via remote publishing from IFTTT or other way using XMLRPC. Only supports publish post.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Remote Publishing', $this->text_domain); ?></span></legend>
								<label for="qqworld_auto_save_images_remote_publishing">
									<input name="qqworld_auto_save_images_remote_publishing" type="checkbox" id="qqworld_auto_save_images_remote_publishing" value="yes" <?php checked('yes', $this->remote_publishing); ?> />
								</label>
						</fieldset></td>
					</tr>

					<tr valign="top">
						<th scope="row"><label><?php _e('Set Featured Image', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Set first one of the remote images as featured image.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Set Featured Image', $this->text_domain); ?></span></legend>
								<label for="qqworld_auto_save_images_set_featured_image_yes">
									<input name="qqworld_auto_save_images_set_featured_image" type="checkbox" id="qqworld_auto_save_images_set_featured_image_yes" value="yes" <?php checked('yes', $this->featured_image); ?> />
								</label>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</div>
		<div class="tab-content" style="display: none;">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="only_save_first"><?php _e('Grabbing from Each Posts', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Grabbing from Each Posts', $this->text_domain); ?></span></legend>
								<select id="only_save_first" name="qqworld_auto_save_images_only_save_first">
									<option value="all" <?php selected('all', $this->only_save_first); ?>><?php _e('All Images', $this->text_domain); ?></option>
									<?php
									for ($i=1; $i<=30; $i++) {
										$selected = selected($i, $this->only_save_first, false);
										echo '<option value="' . $i . '" '.$selected.'>' . sprintf(_n('First %d image only', 'First %d images only', $i, $this->text_domain), number_format_i18n($i)) . '</option>';
									}
									?>
								</select>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Minimum Picture Size', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Ignore smaller than this size picture.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Minimum Picture Size', $this->text_domain); ?></span></legend>
								<label for="qqworld_auto_save_images_minimum_picture_size_width">
									<?php _e('Width:', $this->text_domain); ?> <input name="qqworld_auto_save_images_minimum_picture_size[width]" class="small-text" type="text" id="qqworld_auto_save_images_minimum_picture_size_width" value="<?php echo $this->minimum_picture_size['width']; ?>" /> <?php _e('(px)', $this->text_domain); ?>
								</label><br />
								<label for="qqworld_auto_save_images_minimum_picture_size_height">
									<?php _e('Height:', $this->text_domain); ?> <input name="qqworld_auto_save_images_minimum_picture_size[height]" class="small-text" type="text" id="qqworld_auto_save_images_minimum_picture_size_height" value="<?php echo $this->minimum_picture_size['height']; ?>" readonly /> <?php _e('(px)', $this->text_domain); ?>
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Maximum Picture Size', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Automatic reduction is greater than the size of the picture. if you want image width less than 800px with any size height, please set width 800 and leave height blank.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Maximum Picture Size', $this->text_domain); ?></span></legend>
								<label for="qqworld_auto_save_images_maximum_picture_size_width">
									<?php _e('Width:', $this->text_domain); ?> <input name="qqworld_auto_save_images_maximum_picture_size[width]" class="small-text" type="text" id="qqworld_auto_save_images_maximum_picture_size_width" value="<?php echo $this->maximum_picture_size['width']; ?>" /> <?php _e('(px)', $this->text_domain); ?>
								</label><br />
								<label for="qqworld_auto_save_images_maximum_picture_size_height">
									<?php _e('Height:', $this->text_domain); ?> <input name="qqworld_auto_save_images_maximum_picture_size[height]" class="small-text" type="text" id="qqworld_auto_save_images_maximum_picture_size_height" value="<?php echo $this->maximum_picture_size['height']; ?>" /> <?php _e('(px)', $this->text_domain); ?>
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Exclude Domain/Keyword', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Images will not be saved, if that url contains Exclude-Domain/Keyword.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Exclude Domain/Keyword', $this->text_domain); ?></span></legend>
								<ul id="exclude_domain_list">
								<?php
								if (!empty($this->exclude_domain)) foreach ($this->exclude_domain as $domain) :
									if (!empty($domain)) :
								?>
								<li>http(s):// <input type="text" name="qqworld-auto-save-images-exclude-domain[]" class="regular-text" value="<?php echo $domain; ?>" /><input type="button" class="button delete-exclude-domain" value="<?php _e('Delete'); ?>"></li>
									<?php endif;
								endforeach; ?>
								</ul>
								<input type="button" id="add_exclude_domain" class="button" value="<?php _e('Add a Domain/Keyword', $this->text_domain);?>" />
						</fieldset></td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</div>
		<div class="tab-content" style="display: none;">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="auto_change_name"><?php _e('Change Image Filename', $this->text_domain); ?></label></th>
						<td>
							<fieldset>
							<legend class="screen-reader-text"><span><?php _e('Change Image Filename', $this->text_domain); ?></span></legend>
								<select id="auto_change_name" name="qqworld_auto_save_images_auto_change_name">
									<option value="none" <?php selected('none', $this->change_image_name); ?>>1. <?php _e('No'); ?></option>
									<option value="ascii" <?php selected('ascii', $this->change_image_name); ?>>2. <?php _e('Only change remote images filename that have Non-ASCii characters (for Windows Server)', $this->text_domain); ?></option>
									<option value="all" <?php selected('all', $this->change_image_name); ?>>3. <?php _e('Change all remote images Filename and Alt as post name (for Linux Server)', $this->text_domain); ?></option>
								</select>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="filename-structure"><?php _e('Custom Filename Structure', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Custom Filename Structure', $this->text_domain); ?></span></legend>
								<label for="filename-structure">
									<input name="qqworld-auto-save-images-format[filename-structure]" type="text" id="filename-structure" class="regular-text" value="<?php echo $this->filename_structure; ?>" />
								</label>
								<p class="description">
									<strong>%filename%</strong> : <?php _e('Original filename or automatic changed filename.', $this->text_domain); ?><br />
									<strong>%date%</strong> : <?php _e('Full date, e.g. 20150209.', $this->text_domain); ?><br />
									<strong>%year%</strong> - <?php _e('YYYY, e.g. 2015.', $this->text_domain); ?><br />
									<strong>%month%</strong> - <?php _e('MM, e.g. 02.', $this->text_domain); ?><br />
									<strong>%day%</strong> -  <?php _e('DD, e.g. 15.', $this->text_domain); ?><br />
									<strong>%time%</strong> - <?php _e('HHMMSS, e.g. 182547.', $this->text_domain); ?><br />
									<strong>%timestamp%</strong> - <?php printf(__('Unix timestamp, e.g. %s.', $this->text_domain), time()); ?>
								</p>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Change Title & Alt', $this->text_domain); ?></label> <span class="icon help" title="<?php _e('Automatically add title & alt of image as post title.', $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Change Title & Alt', $this->text_domain); ?></span></legend>
								<label for="qqworld_auto_save_images_format_title_alt">
									<input name="qqworld-auto-save-images-format[title-alt]" type="checkbox" id="qqworld_auto_save_images_format_title_alt" value="yes" <?php checked('yes', $this->change_title_alt); ?> />
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Keep Outside Links', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Keep the outside links of remote images if exist.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Keep Outside Links', $this->text_domain); ?></span></legend>
								<label for="qqworld_auto_save_images_format_keep_outside_links">
									<input name="qqworld-auto-save-images-format[keep-outside-links]" type="checkbox" id="qqworld_auto_save_images_format_keep_outside_links" value="yes" <?php checked('yes', $this->keep_outside_links); ?> />
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Save Outside Links', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Save the outside links to description of attachments.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Save Outside Links', $this->text_domain); ?></span></legend>
								<label for="qqworld_auto_save_images_format_save_outside_links">
									<input name="qqworld-auto-save-images-format[save-outside-links]" type="checkbox" id="qqworld_auto_save_images_format_save_outside_links" value="yes" <?php checked('yes', $this->save_outside_links); ?> />
								</label>
								<p><?php _e('To custom the content, add codes into <strong>functions.php</strong> like this below:', $this->text_domain); ?></p>
								<pre>add_filter('qqworld-auto-save-images-save-outsite-link', 'save_outside_link', 10, 2);
function save_outside_link($content, $link) {
	$content = '&lta href="'.$link.'" target="_blank" rel="nofollow"&gt;Original Link&lt;/a&gt;';
	return $content;
}</pre>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Image Size', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Replace images you want size to display.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Image Size', $this->text_domain); ?></span></legend>
								<label>
									<select name="qqworld-auto-save-images-format[size]">
									<?php
									$sizes = apply_filters( 'image_size_names_choose', array(
										'thumbnail' => __('Thumbnail'),
										'medium'    => __('Medium'),
										'large'     => __('Large'),
										'full'      => __('Full Size')
									) );
									foreach ($sizes as $value => $title) echo '<option value="'.$value.'"'.selected($value, $this->format['size'], false).'>'.$title.'</option>';
									?>
									</select>
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Link To', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("If you checked Keep-Outside-Links, this option will not works.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Link To', $this->text_domain); ?></span></legend>
								<label>
									<select name="qqworld-auto-save-images-format[link-to]">
									<?php
									$linkTo = array(
										'file' => __('Media File'), 
										'post' => __('Attachment Page'),
										'none' => __('None')
									);
									foreach ($linkTo as $value => $title) echo '<option value="'.$value.'"'.selected($value, $this->format_link_to, false).'>'.$title.'</option>';
									?>
									</select>
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="format-align-to"><?php _e('Align To', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Align To', $this->text_domain); ?></span></legend>
								<label>
									<select name="qqworld-auto-save-images-format[align-to]" id="format-align-to">
									<?php
									$linkTo = array(
										'left' => __('Left'),
										'center' => __('Center'),
										'right' => __('Right'),
										'none' => __('None')
									);
									foreach ($linkTo as $value => $title) echo '<option value="'.$value.'"'.selected($value, $this->format_align_to, false).'>'.$title.'</option>';
									?>
									</select>
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="format_caption"><?php _e('Auto Caption', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Automatically add caption shortcode.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Auto Caption', $this->text_domain); ?></span></legend>
								<label for="format_caption">
									<input name="qqworld-auto-save-images-format[auto-caption]" type="checkbox" id="format_caption" value="yes" <?php checked('yes', $this->auto_caption); ?> />
								</label>
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Additional Content', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("This content will be displayed after the each remote images code. you can use [Attachment ID] indicate current attachment ID.", $this->text_domain); ?>"></span></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Additional Content', $this->text_domain); ?></span></legend>
								<label for="qqworld_auto_save_images_additional_content_after">
									<textarea name="qqworld-auto-save-images-format[additional-content][after]" rows="3" cols="80" id="qqworld_auto_save_images_additional_content_after"><?php echo $this->additional_content['after']; ?></textarea>
									<p class="discription"><?php _e("For example: [Gbuy id='[Attachment ID]']", $this->text_domain); ?></p>
								</label>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
			<?php do_action('qqworld-auto-save-images-general-options-form'); ?>
			<?php submit_button(); ?>
		</div>
	</form>
	<form action="" method="post" id="scan">
		<div class="tab-content hidden">
			<div id="scan-result"></div>
			<div id="scan-post-block">
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label><?php _e('Select post types', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("If you have too many posts to be scan, sometimes in process looks like stopping, but it may be fake. please be patient.", $this->text_domain) ?>"></span></th>
							<td>
								<?php $post_types = get_post_types('', 'objects'); ?>
								<ul id="post_types_list">
								<?php foreach ($post_types as $name => $post_type) :
									if ( !in_array($name, array('attachment', 'revision', 'nav_menu_item') )) : ?>
									<li><label><input name="qqworld_auto_save_images_post_types[]" type="checkbox" value="<?php echo $name; ?>" /> <?php echo $post_type->labels->name; ?> (<?php $count = wp_count_posts($name); echo $count->publish; ?>)</label></li>
								<?php endif;
								endforeach;
								?></ul>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><label><?php _e('Categories'); ?></label> <span class="icon help" title="<?php _e("Default empty to scan all categories.", $this->text_domain) ?>"></span></th>
							<td id="categories_block"><?php _e('Please select post types.', $this->text_domain); ?></td>
						</tr>

						<tr valign="top">
							<th scope="row"><label><?php _e('Scope of Post ID', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Default empty for scan all posts ID. If you want to scan posts ID from 50 to 100. please type '50' and '100' or '100' and '50', The order in which two numbers can be reversed. If you only type one number, system would only scan that ID.", $this->text_domain); ?>"></span></th>
							<td><?php printf(__('From %1$s to %2$s', $this->text_domain), '<input type="number" class="small-text" name="id_from" />', '<input type="number" class="small-text" name="id_to" />'); ?></td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><label><?php _e('Offset', $this->text_domain); ?></label> <span class="icon help" title="<?php _e("Default scan all posts. If you want to scan 50-150 posts, please type '50' in the textfield and select '100'.", $this->text_domain); ?>"></span></th>
							<td>
								<?php printf(__('Start from %s to Scan', $this->text_domain), '<input type="number" class="small-text" name="offset" value="0" disabled />'); ?>
								<select name="posts_per_page">
									<option value="-1"><?php _e('All'); ?></option>
									<?php for ($i=1; $i<=10; $i++) : ?>
									<option value="<?php echo $i*100; ?>"><?php echo $i*100; ?></option>
									<?php endfor; ?>
								</select> <?php _e('Posts'); ?>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><label><?php _e('Status'); ?></label></th>
							<td>
								<select name="post_status">
								<?php
								global $wp_post_statuses;
								echo '<option value="any" /> '.__('Any', $this->text_domain).'</option>';
								foreach ($wp_post_statuses as $slug => $status) {
									if (!in_array($slug, array('auto-draft', 'inherit', 'trash'))) echo '<option value="'.$slug.'" '.selected('publish', $slug, false).'> '.$status->label.'</option>';
								}
								?>
								</select>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><label><?php _e('Order By', $this->text_domain); ?></label></th>
							<td>
								<select name="orderby">
									<?php
									$orderby = array(
										'ID' => __('ID'),
										'author' => __('Author'),
										'title' => __('Title'),
										'date' => __('Date'),
										'modified' => __('Last Modified'),
										'comment_count' => __('Comment Count', $this->text_domain)
									);
									foreach ($orderby as $key => $name) : ?>
									<option value="<?php echo $key; ?>"<?php selected('date', $key); ?>><?php echo $name; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><label for="order"><?php _e('Order'); ?></label></th>
							<td id="categories_block"><fieldset>
								<select name="order" id="order">
									<option value="DESC">DESC</option>
									<option value="ASC">ASC</option>
								</select>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><label><?php _e('Speed', $this->text_domain); ?></label> <span class="icon help" title="<?php _e('If the server is too much stress may be appropriately reduced speed.', $this->text_domain); ?>"></span></th>
							<td>
								<select name="speed">
									<?php for ($i=1; $i<10; $i++) : ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php endfor; ?>
									<option value="10" selected>10</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<p class="submit">
					<input name="scan_old_posts" type="button" class="button-primary" id="scan_old_posts" value="<?php _e('Automatic', $this->text_domain); ?> &#8667;" /> <span class="icon help" title="<?php _e('Scan posts and keep remote images in all posts to local media library. Maybe take a long time.', $this->text_domain); ?>"></span>
					<input name="list_all_posts" type="button" class="button-primary" id="list_all_posts" value="<?php _e('Manual', $this->text_domain); ?> &#9776;" /> <span class="icon help" title="<?php _e("The list displayed will show you which posts including remote images, then you can keep them to local manually via click \"Fetch\" button.", $this->text_domain); ?>"></span>
				</p>
			</div>
		</div>
	</form>
	<div class="tab-content hidden">
		<div id="cron-list-container">
			<p><img src="<?php echo QQWORLD_AUTO_SAVE_IMAGES_URL; ?>images/qcd-banner-772x250.jpg" width="772" height="250" class="qc-banner" /></p>
			<table id="product-info" class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label><?php _e('Why buy QQWorld Collector', $this->text_domain); ?></label></th>
						<td>
							<ol>
								<li><?php _e('The best way to grab the image plugin, the same remote image will not be saved repeatedly, grab remote images and sync to cloud storage in one go.', $this->text_domain); ?></li>
								<li><?php _e('Perfect support for the Gutenberg editor, you can automatically parse the HTML and generate the corresponding block after saving the image.', $this->text_domain); ?></li>
								<li><?php _e('It is possible to prohibit the generation of various thumbnail sizes.', $this->text_domain); ?></li>
								<li><?php _e('Support dozens of cloud storage, Multiple cloud storage can be used simultaneously in JoinMode.', $this->text_domain); ?></li>
								<li><?php _e("The best general-purpose collection plug-in can be used to collect almost all websites such as WeChat public number and today's headlines.", $this->text_domain); ?></li>
								<li><?php _e('There are a large number of collection video tutorials for reference. If you encounter difficulties, you can consult customer service for free, or you can purchase the service at a low price.', $this->text_domain); ?></li>
								<li>...</li>
							</ol>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Purchase', $this->text_domain); ?></label></th>
						<td>
							<p><?php _e("The commercial edition's plugin name is <strong>QQWorld Collector</strong>, Does the feeling of maintaining the site work very heavy? This plugin will save you a lot of time!", $this->text_domain); ?></p>
							<p><?php printf(__('Price: from <strong>%s</strong>', $this->text_domain), _x('$7.5 (RMB &#165;49)', 'price', $this->text_domain)); ?></p>
							<p><a href="https://www.qqworld.org/product/qqworld-collector" target="_blank" class="button button-primary"><?php _e('Details or Purchase', $this->text_domain); ?> &#8667;</a></p>
							<p><a href="<?php _e('http://www.qqworld.org/how-to-buy-en?locale=en_US', $this->text_domain); ?>" target="_blank"><?php _e('How to buy?', $this->text_domain); ?></a> | <a href="<?php _e('https://www.qqworld.org/product-activation-en?locale=en_US', $this->text_domain); ?>" target="_blank" target="_blank"><?php _e('Product Activation', $this->text_domain); ?></a></p>
							<?php printf(__('<h2>Don\'t know Chinese?</h2><p>Don\'t worry, click on this <a href="%s" target="_blank">link</a> to transfer important content from the website to English and then happily register, purchase and activate the product.</p>', $this->text_domain), 'https://www.qqworld.org/product/qqworld-collector?locale=en_US'); ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Download &amp; Trial', $this->text_domain); ?></label></th>
						<td>
							<p class="hidden">
								<a href="https://pan.baidu.com/s/1IgQ1mQV97rn-p1zm15UtBA" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Baidi Network Disk', $this->text_domain); ?> &#8667;</a> <?php printf(_x('Code: %s', 'baidu',  $this->text_domain), 'td9o');?>
							</p>
							<p class="hidden">
								<a href="https://drive.google.com/open?id=1MPiqkC1y4b1dlI29kDyB36aQEjx_0m4G" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Google Drive', $this->text_domain); ?> &#8667;</a>
							</p>
							<p><?php _e('Please choose the fastest network disk for you and download the latest version of the date.', $this->text_domain); ?></p>
							<table class="wp-list-table widefat striped posts">
								<thead>
									<tr>
										<td class="manage-column column-cb check-column"></td>
										<th class="manage-column"><?php _e('QQWorld CLoud Storage', $this->text_domain); ?></th>
										<th class="manage-column"><?php _e('Baidi Network Disk', $this->text_domain); ?></th>
										<th class="manage-column"><?php _e('Tencent WeiYun', $this->text_domain); ?></th>
										<th class="manage-column"><?php _e('Google Drive', $this->text_domain); ?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row" class="check-column"></th>
										<td align="center"><a href="https://cloud.qqworld.org/index.php?share/folder&user=1&sid=9H5KicyN" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Download', $this->text_domain); ?> &#8667;</a></td>
										<td align="center"><a href="https://pan.baidu.com/s/1y5ZRgMbRHhq4lTPzxk3wlg" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Download', $this->text_domain); ?> &#8667;</a> <?php printf(_x('Code: %s', 'baidu', $this->text_domain), 'n1v2'); ?></td>
										<td align="center"><a href="https://share.weiyun.com/5oYlXvE" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Download', $this->text_domain); ?> &#8667;</a></td>
										<td align="center"><a href="https://drive.google.com/open?id=0B8SziOUSW1wpT283ZWc5ZUNsUXM" class="button button-primary button-large qc-icon download" target="_blank"><?php _e('Download', $this->text_domain); ?> &#8667;</a></td>
									</tr>
								</tbody>
							</table>
							<p><?php _e('After installation, click the activation button of the corresponding version to try it for 15 days (with certain restrictions)', $this->text_domain); ?></p>
							<h3><?php _e('Installation instructions', $this->text_domain); ?></h3>
							<dl>
								<dt><strong><?php _e('"Link expired" when uploading plugin zip', $this->text_domain); ?></strong></dt>
								<dd><?php _e("Because the plugin calls a large number of libraries and rich graphic help files, so the file is relatively large, please ensure that the server's PHP settings allow uploading large files, otherwise please unzip the installation package and use FTP to upload to the website's <em>wp-content/plugins</em> table of Contents.", $this->text_domain); ?></dd>
								<dt><strong><?php _e('Fatal error when activating plugin: Warning: require(phar:///...', $this->text_domain); ?></strong></dt>
								<dd><?php _e("The plugin requires PHP's Phar extension support. Please make sure that your PHP version is higher than or equal to 5.3, and compile and install the Phar extension. Some virtual hosts do not support Phar, so you cannot use this plugin.", $this->text_domain); ?></dd>
								<dt><strong><?php _e('Fatal error when activating plugin: Parse error: syntax error, unexpected \'}\', ..', $this->text_domain); ?></strong></dt>
								<dd><?php _e('Servers that use some PHP cryptographic modules are not supported, such as the Loader.so required for the tint theme. This cryptographic module is not compatible with Phar and can produce inexplicable error reports.', $this->text_domain); ?></dd>
							</dl>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Introduction', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Introduction', $this->text_domain); ?></span></legend>
								<?php _e('<iframe width="1024" height="600" src="https://www.youtube.com/embed/LtrQITIhScQ" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>', $this->text_domain); ?>	
						</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php _e('Auto Save Attachments', $this->text_domain); ?></label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span><?php _e('Auto Save Attachments', $this->text_domain); ?></span></legend>
								<?php _e('<iframe width="1024" height="600" src="https://www.youtube.com/embed/8OPhE9t716Q" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>', $this->text_domain); ?>
							<p><?php _e('Perfect support for the Gutenberg editor, you can automatically parse the HTML and generate the corresponding block after saving the image.', $this->text_domain); ?></p>
							</fieldset></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label><?php printf(__('More <a href="%s" target="_blank">Video Tutorials</a>', $this->text_domain), 'https://www.qqworld.org/archives/category/videos'); ?></label></th>
						<td>
							<ul>
								<li><a href="https://www.qqworld.org/archives/5447" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-13：采集下载资源</a></li>
								<li><a href="https://www.qqworld.org/archives/5327" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-12：对付POST请求的AJAX分页</a></li>
								<li><a href="https://www.qqworld.org/archives/5299" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-11：使用第三方接口采集微信公众号</a></li>
								<li><a href="https://www.qqworld.org/archives/5298" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-10：采集今日头条的头条号</a></li>
								<li><a href="https://www.qqworld.org/archives/5295" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-8&amp;9：采集天猫商品快速部署WooCommerce网店</a></li>
								<li><a href="https://www.qqworld.org/archives/5288" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-7：采集微信公众号订阅</a></li>
								<li><a href="https://www.qqworld.org/archives/5284" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-6：采集采集金色财经新闻</a></li>
								<li><a href="https://www.qqworld.org/archives/5283" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-5：采集网易科技新闻</a></li>
								<li><a href="https://www.qqworld.org/archives/5282" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-4：采集游侠网评测</a></li>
								<li><a href="https://www.qqworld.org/archives/5281" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-3：采集黑基网</a></li>
								<li><a href="https://www.qqworld.org/archives/5280" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-2：采集IT之家资讯</a></li>
								<li><a href="https://www.qqworld.org/archives/5278" target="_blank">WordPress采集插件之QQWorld收藏家视频教程-1：采集游侠网攻略</a></li>
								<li><a href="https://www.qqworld.org/archives/5198" target="_blank">WordPress使用百度云BOS对象存储作为媒体库保存图片</a></li>
								<li><a href="https://www.qqworld.org/archives/4452" target="_blank">WordPress使用腾讯云COS作为媒体库保存图片</a></li>
								<li><a href="https://www.qqworld.org/archives/4441" target="_blank">WordPress使用七牛云存储作为媒体库保存图片</a></li>
								<li><a href="https://www.qqworld.org/archives/4423" target="_blank">WordPress使用阿里云OSS作为媒体库保存图片</a></li>
								<li><a href="https://www.qqworld.org/archives/5257" target="_blank">WordPress使用亚马逊网络服务(AWS)S3云存储作为媒体库保存图片</a></li>
								<li><a href="https://www.qqworld.org/archives/5692" target="_blank">QQWorld收藏家调用自建的可道云（KodExplorer）作为对象云存储</a></li>
								<li><a href="https://www.qqworld.org/archives/5685" target="_blank">QQWorld收藏家调用自建Chevereto开源图床作为云存储</a></li>
							</ul>
							<ol class="hidden">
								<li><a href="https://www.qqworld.org/archives/4282" target="_blank">批量采集微信公众号、百度百家、今日头条和淘宝头条</a></li>
								<li><a href="https://www.qqworld.org/archives/4383" target="_blank">WordPress最强云存储插件</a></li>
								<li><a href="https://www.qqworld.org/archives/4452" target="_blank">WordPress使用腾讯云COS作为媒体库保存图片</a></li>
								<li><a href="https://www.qqworld.org/archives/4441" target="_blank">WordPress使用七牛云存储作为媒体库保存图片</a></li>
								<li><a href="https://www.qqworld.org/archives/4399" target="_blank">抓取WordPress自定义栏目中的远程图像</a></li>
								<li><a href="https://www.qqworld.org/archives/4423" target="_blank">WordPress使用阿里云OSS作为媒体库保存图片</a></li>
								<li><a href="https://www.qqworld.org/archives/4524" target="_blank">QQWorld收藏家支持远程发布啦~</a></li>
								<li><a href="https://www.qqworld.org/archives/4512" target="_blank">WordPress使用贴图库作为远程云存储媒体库(不稳定，请不要用)</a></li>
								<li><a href="https://www.qqworld.org/archives/4475" target="_blank">QQWorld收藏家旗舰版采集教程</a></li>
								<li><a href="https://www.qqworld.org/archives/4507" target="_blank">批量采集微信公众号最近10次群发文章</a></li>
								<li><a href="https://www.qqworld.org/archives/4533" target="_blank">QQWorld收藏家之水印</a></li>
								<li><a href="https://www.qqworld.org/archives/4600" target="_blank">建立微信公众号本地采集服务器</a></li>
								<li><a href="https://www.qqworld.org/archives/4797" target="_blank">批量采集早期的公众号文章（iDataAPI）</a></li>
								<li><a href="https://www.qqworld.org/archives/4824" target="_blank">新魔法采集：QQWorld收藏家采集AJAX加载的网站</a></li>
								<li><a href="https://www.qqworld.org/archives/4857" target="_blank">采集需要登录的网站并自动下载其资源</a></li>
								<li><a href="https://www.qqworld.org/archives/4881" target="_blank">新增魔法采集：从列表页采集内容</a></li>
								<li><a href="https://www.qqworld.org/archives/4941" target="_blank">使用QQWorld收藏家抓取防盗链防采集的远程图片</a></li>
								<li><a href="https://www.qqworld.org/archives/4969" target="_blank">WordPress使用新浪图床作为媒体库保存图片</a></li>
							</ol>
						</td>
					</tr>
					<tr>
						<th><?php _e('Edition Introduction', $this->text_domain); ?></th>
						<td>
							<table class="wp-list-table widefat striped posts">
								<thead>
									<tr>
										<td class="manage-column column-cb check-column"></td>
										<th class="manage-column column-primary"><?php _e('Edition', $this->text_domain); ?></th>
										<th class="manage-column"><?php _e('Description', $this->text_domain); ?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row" class="check-column"></th>
										<td class="column-primary">
											<strong><?php _e('Cloud Storage Edition', $this->text_domain); ?></strong>
											<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
										</td>
										<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you only need the cloud storage function, please purchase the Cloud Storage Edition, which supports 6 kinds of cloud storage in China, as well as AWS S3, FTP, sina chart bed, etc. You can automatically delete local attachments after synchronization and establish the remote cloud media library.', 'shopping guide', $this->text_domain); ?></td>
									</tr>
									<tr>
										<th scope="row" class="check-column"></th>
										<td class="column-primary">
											<strong><?php _e('Professional Edition', $this->text_domain); ?></strong>
											<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
										</td>
										<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you only need to capture remote image and watermark function, please buy Professional Edition.', 'shopping guide', $this->text_domain); ?></td>
									</tr>
									<tr>
										<th scope="row" class="check-column"></th>
										<td class="column-primary">
											<strong><?php _e('Server Edition', $this->text_domain); ?></strong>
											<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
										</td>
										<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you need to capture remote images, watermarks, and cloud storage, buy the Server Edition.', 'shopping guide', $this->text_domain); ?></td>
									</tr>
									<tr>
										<th scope="row" class="check-column"></th>
										<td class="column-primary">
											<strong><?php _e('Website Master Edition', $this->text_domain); ?></strong>
											<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
										</td>
										<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you need to capture remote image, watermark and collection function, but do not need cloud storage, please buy Website Master Edition, can be timed batch collection of Tmall, WeChat public number, toutiao today and taobao toutiao most of the sites.', 'shopping guide', $this->text_domain); ?></td>
									</tr>
									<tr>
										<th scope="row" class="check-column"></th>
										<td class="column-primary">
											<strong><?php _e('Enterprise Edition', $this->text_domain); ?></strong>
											<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
										</td>
										<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you want all functions except static cache, buy the enterprise Edition.', 'shopping guide', $this->text_domain); ?></td>
									</tr>
									<tr>
										<th scope="row" class="check-column"></th>
										<td class="column-primary">
											<strong><?php _e('Ultimate Edition', $this->text_domain); ?></strong>
											<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
										</td>
										<td data-colname="<?php _e('Description', $this->text_domain); ?>" class="column-description"><?php _ex('If you want full functionality, buy the Ultimate Edition.', 'shopping guide', $this->text_domain); ?></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<th><?php _e('Website Edition', $this->text_domain); ?></th>
						<td>
							<table class="wp-list-table widefat striped">
								<thead>
									<tr>
										<td class="manage-column column-cb check-column"></td>
										<th class="manage-column column-primary" style="width: 150px;"><?php _e('Title', $this->text_domain); ?></th>	
										<th class="manage-column"><?php _e('Basic Edition', $this->text_domain); ?></th>
										<th class="manage-column"><?php _e('Single Site Edition', $this->text_domain); ?></th>
										<th class="manage-column"><?php _e('Multisite Edition', $this->text_domain); ?></th>
										<th class="manage-column"><?php _e('Unlimited Edition', $this->text_domain); ?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row" class="check-column"></th>
										<td class="column-primary">
											<strong><?php _e('Verification Method', $this->text_domain); ?></strong>
											<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
										</td>
										<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php _e('Top Level Domain', $this->text_domain); ?></td>
										<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php _e('Top Level Domain', $this->text_domain); ?></td>
										<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php _e('Top Level Domain', $this->text_domain); ?></td>
										<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('Top Level Domain', $this->text_domain); ?></td>
									</tr>
									<tr>
										<th scope="row" class="check-column"></th>
										<td class="column-primary">
											<strong><?php _e('Activating Quantity', $this->text_domain); ?></strong>
											<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
										</td>
										<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>">1<?php _e(' (Include Subdomain)', $this->text_domain); ?></td>
										<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>">1<?php _e(' (Include Subdomain)', $this->text_domain); ?></td>
										<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>">1<?php _e(' (Include Subdomain)', $this->text_domain); ?></td>
										<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('Unlimited', $this->text_domain); ?></td>
									</tr>
									<tr>
										<th scope="row" class="check-column"></th>
										<td class="column-primary">
											<strong><?php _e('Changeable times', $this->text_domain); ?></strong>
											<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
										</td>
										<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php printf(__('You must unlock to change your domain name (%s of unit price)', $this->text_domain), '40%'); ?></td>
										<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php printf(__('%s times, Excessive need to unlock (%s of unit price, same as the unlock price of Basic Edition)', $this->text_domain), '5', '20%'); ?></td>
										<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php printf(__('%s times, Excessive need to unlock (%s of unit price)', $this->text_domain), '5', '20%'); ?></td>
										<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('Unlimited', $this->text_domain); ?></td>
									</tr>
									<tr>
										<th scope="row" class="check-column"></th>
										<td class="column-primary">
											<strong><?php _e('Suggest', $this->text_domain); ?></strong>
											<button type="button" class="toggle-row"><span class="screen-reader-text"><?php _e('Show more details'); ?></span></button>
										</td>
										<td data-colname="<?php _e('Basic Edition', $this->text_domain); ?>"><?php _e('Suitable for single sites, If you do not need to change domain names frequently, please purchase this edition.', $this->text_domain)?></td>
										<td data-colname="<?php _e('Single Site Edition', $this->text_domain); ?>"><?php _e("If you don't have a lot of websites, but you may want to change your domain more frequently, please purchase this edition.", $this->text_domain)?></td>
										<td data-colname="<?php _e('Multisite Edition', $this->text_domain); ?>"><?php printf(_x('If your site is <a href="%s" target="_blank" rel="noopener">Multi-Site mode</a>, please purchase this edition, just activate the main site domain name, unlimited sub site available.', 'shopping guide', $this->text_domain), 'https://www.qqworld.org/archives/5426'); ?></td>
										<td data-colname="<?php _e('Unlimited Edition', $this->text_domain); ?>"><?php _e('If you have more than 4 websites, please purchase an unlimited version to activate unlimited domain names across servers.', $this->text_domain); ?></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<th><?php _e('Edition Difference', $this->text_domain); ?></th>
						<td>
							<table id="product-info" class="wp-list-table widefat striped posts hidden">
								<thead>
									<tr>
										<th class="column-primary"></th>
										<th><?php _ex('Ultimate Edition', 'activation', $this->text_domain); ?></th>
										<th><?php _ex('Server Edition', 'activation', $this->text_domain); ?></th>
										<th><?php _ex('Professional Edition', 'activation', $this->text_domain); ?></th>
										<th><?php _ex('Free Edition', 'activation', $this->text_domain); ?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="column-primary"><?php _ex('Support for the new editor of Wordpress 5.0.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td class="column-primary"><?php _ex('Automatically delete the HTML code of remote images smaller than Minimum-Picture-Size.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Detecting replicated images in media library by Original-link and CRC (Only for new images that after v1.1 updated).', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Automatically exclude specified remote images by CRC.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Automatically delete html code of specified remote images by CRC.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('New manual mode with multi-thread<br> (Faster than automatic mode and modify Title &amp; Alt in realtime)', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Download Images from WeChat', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Cron Scan Posts', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Watermark', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Images Compression (JPG Only)', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Use Proxy', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Smart Grabbing, Automatically detect 2 images url<br> from href/src of remote image with outside link, and grab the bigger one.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Use Cookie-Free Domain &amp; CDN Servive (AliYun OSS, UpYun, QiNiu, Tencent COS)', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Database content replacement, easy to replace content in post content and post titles.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Automatic Collecting: Easy to collcet articles, and get all the images to choose from web pages.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="red"></td>
										<td class="red"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Translation (Baidu Translation, Google Translation)', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Set no remote images saved into media library, it means would not generate thumbnail with many sizes. but if you checked Set-Featured-Image, the first remote image will be saved into media library.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Support automatically convert BMP/WEBP to JPG.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Cleaner tool: If you have a huge media library and do not know how many attachments has not bean used. this tool will help you to find out.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Special Features: Automatically keep remote images in the custom fields to the local media library.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
										<td class="red"></td>
									</tr>
									<tr>
										<td><?php _ex('Special Features: Automatically delete attachments of post when deleting post.', 'activation', $this->text_domain); ?></td>
										<td class="green"></td>
										<td class="green"></td>
										<td class="red"></td>
										<td class="red"></td>
									</tr>
								</tbody>
							</table>
							<table id="comparison-table" class="wp-list-table widefat striped">
								<thead>
									<tr>
										<th><?php _e('Items', $this->text_domain); ?></th>
										<th class="comparison-cell"><?php _e('Ultimate Edition', $this->text_domain); ?></th>
										<th class="comparison-cell"><?php _e('Enterprise Edition', $this->text_domain); ?></th>
										<th class="comparison-cell"><?php _e('Master Edition', $this->text_domain); ?></th>
										<th class="comparison-cell"><?php _e('Server Edition', $this->text_domain); ?></th>
										<th class="comparison-cell"><?php _e('Professional Edition', $this->text_domain); ?></th>
										<th class="comparison-cell"><?php _e('Cloud Storage Edition', $this->text_domain); ?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;125'); ?></center></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;99'); ?></center></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;74.5'); ?></center></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;49'); ?></center></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;32.5'); ?></center></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;25'); ?></center></td>
									</tr>
									<tr>
										<td class="qc-svg collection">
											<strong><?php _e('Collection Project', $this->text_domain); ?></strong>
											<ol>
												<li><?php _e('Self-built collection project, set collection rules, using object-oriented programming compared to 2.x, it is very convenient to collect AJAX loaded pages and filter any collected content.', $this->text_domain); ?></li>
												<li><?php _e('Manual collection, you can select the posts to be collected, you can collect them by importing archive links or singular post links.', $this->text_domain); ?></li>
												<li><?php _e('Automatically collect, set up scheduled tasks, and let the website automatically collect posts.', $this->text_domain); ?></li>
												<li><?php _e('A template that automatically adds a header template and a footer template to the collected posts in the collection project.', $this->text_domain); ?></li>
												<li><?php _e('Collection project store with video tutorials. You can purchase collection project directly.', $this->text_domain); ?></li>
												<li><?php _e('Basically, as long as it is not a digital signature encrypted website, it can be collected.', $this->text_domain); ?></li>
											</ol>
										</td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>" class="red"></td>
									</tr>
									<tr>
										<td class="qc-svg attachments">
											<strong><?php _e('Auto Save Attachment', $this->text_domain); ?></strong>
											<ol>
												<li><?php _e('Support for new editors of Wordpress 5.0.', $this->text_domain); ?></li>
												<li><?php _e('Automatically save remote attachments, as long as the file format allowed by the Wordpress media library can be crawled.', $this->text_domain); ?></li>
												<li><?php _e('Automatically save remote attachments, as long as the file format allowed by the Wordpress media library can be crawled.', $this->text_domain); ?></li>
												<li><?php _e('Format the HTML code of the collected remote image.', $this->text_domain); ?></li>
												<li><?php _e('You can not use the media library.', $this->text_domain); ?></li>
												<li><?php _e('Scan the post to automatically save remote attachments from the old post to local.', $this->text_domain); ?></li>
												<li><?php _e('Set up scheduled tasks to scan posts.', $this->text_domain); ?></li>
												<li><?php _e('Set thumbnail crop position.', $this->text_domain); ?></li>
											</ol>
										</td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>" class="red"></td>
									</tr>
									<tr>
										<td class="qc-svg watermark">
											<strong><?php _e('Watermark', $this->text_domain); ?></strong>
											<ol>
												<li><?php _e('Both image watermark and text watermark are supported.', $this->text_domain); ?></li>
												<li><?php _e('Scan the media library to watermark the image.', $this->text_domain); ?></li>
											</ol>
										</td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>" class="red"></td>
									</tr>
									<tr>
										<td class="qc-svg translate">
											<strong><?php _e('Translate', $this->text_domain); ?></strong>
											<ol>
												<li><?php _e("You can use Baidu translation, Google free translation, Google translation and Simplified and Traditional chinese to translate the content of the article automatically or manually.", $this->text_domain); ?></li>
												<li><?php _e('Support automatic translation, manual translation or translation at the time of collection.', $this->text_domain); ?></li>
												<li><?php _e('Automatically translate post name.', $this->text_domain); ?></li>
											</ol>
										</td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>" class="red"></td>
									</tr>
									<tr>
										<td class="qc-svg cloud-storage">
											<strong><?php _e('Cloud Storage', $this->text_domain); ?></strong>
											<p class="description"><?php _e("A domain that serves no cookies. The idea here is that you use a cookie-free domain to serve images, CSS files, scripts and whatnot, so that your users don't waste time and bandwidth transmitting cookies for them.", $this->text_domain); ?></p>
											<ol>
												<li><?php _e("Cookie-free domain: use the local server save attachments, the idea here is that you use a cookie-free domain to serve images, CSS files, scripts and whatnot, so that your users don't waste time and bandwidth transmitting cookies for them.", $this->text_domain); ?></li>
												<li><?php _e('Controllable Cloud Storage: FTP, Aliyun OSS, QiNiu Cloud Storage, UpYun Cloud Storage, Tencent COS, Baidu BOS, UCloud UFile Storage. Most of these cloud storage require payment, but data security is higher.', $this->text_domain); ?></li>
												<li><?php _e('Others Cloud Storage: Sina images storage, SM.MS etc. These cloud storage are free, but the resources are less controllable and have the potential to be lost.', $this->text_domain); ?></li>
											</ol>
										</td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>" class="green"></td>
									</tr>
									<tr>
										<td class="qc-svg proxy">
											<strong><?php _e('Proxy', $this->text_domain); ?></strong>
											<ol>
												<li><?php _e("Static Proxy: You can directly fill in the IP and port of the proxy server, I hope you have fast proxy server.", $this->text_domain); ?></li>
												<li><?php _e('Dynamic proxy: All are paid proxy, you need to fill in the URL to dynamically get the proxy address.', $this->text_domain); ?></li>
											</ol>
										</td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>" class="red"></td>
									</tr>
									<tr>
										<td class="qc-svg database">
											<strong><?php _e('Database', $this->text_domain); ?></strong>
											<p class="description"><?php _e("Help you to handle database content easily.", $this->text_domain); ?>
											<ol>
												<li><?php _e('Modify some characters in the database in batches.', $this->text_domain); ?></li>
												<li><?php _e('Batch restore the address of the controllable cloud storage to the local address.', $this->text_domain); ?></li>
												<li><?php _e('Automatically wipe specified tags or attributes in the post content.', $this->text_domain); ?></li>
											</ol>
										</td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>" class="green"></td>
									</tr>
									<tr>
										<td class="qc-svg anchor">
											<strong><?php _e('Automatic Anchor', $this->text_domain); ?></strong>
											<p class="description"><?php _e('Automatically add tags anchor to the keywords in the post content.', $this->text_domain); ?></p>
											<ol>
												<li><?php _e('The anchor link is automatically set according to the manually set keywords when the post content is output.', $this->text_domain); ?></li>
												<li><?php _e('Automatically set up existing article tags.', $this->text_domain); ?></li>
											</ol>
										</td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>" class="red"></td>
									</tr>
									<tr>
										<td class="qc-svg pseudo-original">
											<strong><?php _e('Pseudo Original', $this->text_domain); ?></strong>
											<p class="description"><?php _e('Automatically replace the keywords in the post content.', $this->text_domain); ?></p>
											<ol>
												<li><?php _e('Built-in tens of thousands of thesaurus.', $this->text_domain); ?></li>
												<li><?php _e('The thesaurus can be built manually.', $this->text_domain); ?></li>
											</ol>
										</td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>" class="red"></td>
									</tr>
									<tr>
										<td class="qc-svg static-cache">
											<strong><?php _e('Static Cache', $this->text_domain); ?></strong>
											<p class="description"><?php _e("If you don't need interactive features, just show the site as fast as it can, and you'll like this static caching system like a domestic system like Empire CMS.", $this->text_domain); ?></p>
											<ol>
												<li><?php _e('<strong>Pure Static Cache</strong>: This mode is the fastest, but does not support website interaction.', $this->text_domain); ?></li>
												<li><?php _e('<strong>Half Static Cache</strong>: This mode supports website interaction and loads the static cache only for users who are not logged in.', $this->text_domain); ?></li>
												<li><?php _e('Static Cache for Joinmode of cloud storage', $this->text_domain); ?></li>
											</ol>
										</td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>" class="red"></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>" class="red"></td>
									</tr>
									<tr>
										<td class="qc-svg cleaner">
											<strong><?php _e('Cleaner', $this->text_domain); ?></strong>
											<p class="description"><?php _e('If you have a huge media library and do not know how many attachments has not bean used. this tool will help you to find out.', $this->text_domain); ?></p>
											<ol>
												<li><?php _e('Scan for attachments that are not in use and automatically delete them.', $this->text_domain); ?></li>
												<li><?php _e('Attachments to post are automatically deleted when the post is deleted.', $this->text_domain); ?></li>
												<li><?php _e('Automatically delete duplicated posts.', $this->text_domain); ?></li>
												<li><?php _e('Automatically delete empty posts.', $this->text_domain); ?></li>
											</ol>
										</td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>" class="green"></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>" class="red"></td>
									</tr>
									<tr>
										<td></td>
										<td data-colname="<?php _e('Ultimate Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;125'); ?></center></td>
										<td data-colname="<?php _e('Enterprise Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;99'); ?></center></td>
										<td data-colname="<?php _e('Master Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;74.5'); ?></center></td>
										<td data-colname="<?php _e('Server Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;49'); ?></center></td>
										<td data-colname="<?php _e('Professional Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;32.5'); ?></center></td>
										<td data-colname="<?php _e('Cloud Storage Edition', $this->text_domain); ?>"><center><?php printf(__('From <span class="price">%s</span>', $this->text_domain), '&#165;25'); ?></center></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Products -->
	<div class="tab-content hidden">
		<?php
		$plugins = array(
			'qqworld-collector' => array(
				'recommend' => true,
				'url' => 'https://www.qqworld.org/product/qqworld-collector',
				'thumbnail' => QQWORLD_AUTO_SAVE_IMAGES_URL . 'images/products/plugins/qqworld-collector/thumbnail.jpg',
				'title' => __('QQWorld Collector', $this->text_domain),
				'description' => __('感觉维护网站的工作很繁重吗？本插件将为你节约大量的时间！QQWorld收藏家是一款Wordpress采集插件，可以采集绝大部分网站，特色是定时批量采集微信公众号和头条号，抓取微信图片、支持水印，支持阿里云OSS、又拍云、腾讯COS、七牛云存储和百度BOS，尤其是可以在同步后自动删除本地附件，建立远程云媒体库……', $this->text_domain),
				'metas' => array(
					'author' => array(
						'label' => __('Author'),
						'name' => __('Michael Wang', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					),
					'company' => array(
						'label' => __('Company', $this->text_domain),
						'name' => __('QQWorld', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					)
				)
			),
			'qqworld-theme-maker' => array(
				'recommend' => true,
				'url' => 'https://www.qqworld.org/product/qqworld-framework',
				'thumbnail' => QQWORLD_AUTO_SAVE_IMAGES_URL . 'images/products/plugins/qqworld-framework/thumbnail.jpg',
				'title' => __('QQWorld Theme Maker', $this->text_domain),
				'description' => __('众多的设计狮存在一个苦恼，为何自己设计的漂亮的网站必须依靠程序员才能做成成品上线，作为一个不懂编程的设计狮能否独立完成一个网站的建设呢？答案是肯定的，阿Q的项目倾力打造的QQWorld主题制造可以实现这一目标。', $this->text_domain),
				'metas' => array(
					'author' => array(
						'label' => __('Author'),
						'name' => __('Michael Wang', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					),
					'company' => array(
						'label' => __('Company', $this->text_domain),
						'name' => __('QQWorld', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					)
				)
			),
			/*'qqworld-woocommerce-assistant' => array(
				'recommend' => true,
				'url' => 'https://www.qqworld.org/product/qqworld-woocommerce-assistant',
				'thumbnail' => QQWORLD_AUTO_SAVE_IMAGES_URL . 'images/products/plugins/qqworld-woocommerce-assistant/thumbnail.jpg',
				'title' => __('QQWorld Woocommerce Assistant', $this->text_domain),
				'description' => __('Woocommerce是一款非常优秀的电子商务插件，不过因为它的西方血统导致其在中国有些水土不服，本插件基于解决这些问题，为帮助Woocommerce能够更好地为中国地区用户服务而生。', $this->text_domain),
				'metas' => array(
					'author' => array(
						'label' => __('Author'),
						'name' => __('Michael Wang', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					),
					'company' => array(
						'label' => __('Company', $this->text_domain),
						'name' => __('QQWorld', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					)
				)
			),
			'qqworld-synchronizer' => array(
				'recommend' => false,
				'url' => 'https://www.qqworld.org/product/qqworld-synchronizer',
				'thumbnail' => QQWORLD_AUTO_SAVE_IMAGES_URL . 'images/products/plugins/qqworld-synchronizer/thumbnail.png',
				'title' => __('QQWorld Synchronizer', $this->text_domain),
				'description' => __('QQWorld同步器是<a href="https://wordpress.org/plugins/qqworld-passport/" target="_blank">QQWorld通行证</a>的商业扩展插件，可以将网站的内容自动同步到社交网站，目前仅支持微信自定义菜单和微信登录或绑定微信时自动同步Woocommerce的收货地址。', $this->text_domain),
				'metas' => array(
					'author' => array(
						'label' => __('Author'),
						'name' => __('Michael Wang', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					),
					'company' => array(
						'label' => __('Company', $this->text_domain),
						'name' => __('QQWorld', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					)
				)
			),
			'qqworld-checkout' => array(
				'recommend' => false,
				'url' => 'https://www.qqworld.org/product/qqworld-checkout',
				'thumbnail' => QQWORLD_AUTO_SAVE_IMAGES_URL . 'images/products/plugins/qqworld-checkout/thumbnail.jpg',
				'title' => __('QQWorld Checkout', $this->text_domain),
				'description' => __('这是一款用于Woocommerce的支付方式扩展插件，包含官方微信支付，支付宝以及第三方支付有赞支付，没有备案的网站也可以使用喔。', $this->text_domain),
				'metas' => array(
					'author' => array(
						'label' => __('Author'),
						'name' => __('Michael Wang', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					),
					'company' => array(
						'label' => __('Company', $this->text_domain),
						'name' => __('QQWorld', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					)
				)
			),
			'qqworld-mobile' => array(
				'recommend' => false,
				'url' => 'https://www.qqworld.org/product/qqworld-mobile',
				'thumbnail' => QQWORLD_AUTO_SAVE_IMAGES_URL . 'images/products/plugins/qqworld-mobile/thumbnail.jpg',
				'title' => __('QQWorld Mobile', $this->text_domain),
				'description' => __('本插件致力于将手机短信功能和网站结合起来，支持手机号注册，短信找回密码以及适用于Woocommerce的短信通知客户发货物流信息。', $this->text_domain),
				'metas' => array(
					'author' => array(
						'label' => __('Author'),
						'name' => __('Michael Wang', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					),
					'company' => array(
						'label' => __('Company', $this->text_domain),
						'name' => __('QQWorld', $this->text_domain),
						'url' => 'https://www.qqworld.org',
					)
				)
			)*/
		);
		?>
		<ul class="qqworld-product-list">
		<?php foreach ($plugins as $plugin) : ?>
			<li>
				<figure class="photo">
					<?php if ($plugin['recommend']) : ?><span class="recommend"><?php _e('Recommend', $this->text_domain); ?></span><?php endif; ?>
					<a href="<?php echo $plugin['url']; ?>" target="_blank" title="<?php _e('Purchase', $this->text_domain); ?>"><img src="<?php echo $plugin['thumbnail']; ?>" /></a>
				</figure>
				<h3><?php echo $plugin['title']; ?></h3>
				<p class="description"><?php echo $plugin['description']; ?></p>
				<p class="metas">
				<?php foreach ($plugin['metas'] as $className => $meta) : ?>
					<span class="<?php echo $className; ?>"><?php echo $meta['label']; ?> / <a href="<?php echo $meta['url']; ?>" target="_blank"><?php echo $meta['name']; ?></a></span>
				<?php endforeach; ?>
				</p>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<!-- Contact -->
	<div class="tab-content hidden">
		<p><?php _e('This plugin is no longer updated, only fix Bugs. If you need new features, please consider purchasing a commercial version.', $this->text_domain); ?></p>
		<table id="contact-list" class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for=""><?php _ex('Developer', 'contact', $this->text_domain); ?></label></th>
					<td><?php _e('Michael Wang', $this->text_domain); ?></td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Official Website', $this->text_domain); ?></label></th>
					<td><a href="https://www.qqworld.org" target="_blank" class="button button-primary qc-icon link"><?php _e("QQWorld's Projects", $this->text_domain); ?></a></td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Email'); ?></label></th>
					<td><a href="mailto:<?php _e('Michael Wang', $this->text_domain); ?> <admin@qqworld.org>" class="button button-primary qc-icon mail">admin@qqworld.org</a></td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Tencent QQ', $this->text_domain); ?></label></th>
					<td><a href="http://wpa.qq.com/msgrd?v=3&uin=172269588&site=qq&menu=yes">172269588</a> (<?php printf(__('%s: ', $this->text_domain), __('QQ Group', $this->text_domain)); ?>3372914)<br /><br />
					<img src="<?php echo QQWORLD_AUTO_SAVE_IMAGES_URL; ?>images/qrcode/qq-follow.png" class="qq qr-code" />
					<p><?php _e('Please use the QQ APP to scan the QR code.', $this->text_domain); ?></p></td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Wechat', $this->text_domain); ?></label></th>
					<td>kbzyzwxq (<?php printf(__('%s: ', $this->text_domain), __('WeChat Official Account', $this->text_domain)); _e('qqworld-project', $this->text_domain); ?>)<br /><br /><img src="<?php echo QQWORLD_AUTO_SAVE_IMAGES_URL; ?>images/qrcode/wechat-follow.png" class="wechat qr-code" />
					<p><?php _e('Please use the WeChat APP to scan the QR code.', $this->text_domain); ?></p></td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Alipay', $this->text_domain); ?></label></th>
					<td><img src="<?php echo QQWORLD_AUTO_SAVE_IMAGES_URL; ?>images/qrcode/alipay-follow.png" class="qr-code" />
					<p><?php _e('Please use the Alipay APP to scan the QR code.', $this->text_domain); ?></p></td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php _e('Cellphone', $this->text_domain); ?></label></th>
					<td><a href="tel:13294296711" class="button button-primary qc-icon phone">13294296711</a></td>
				</tr>
			</tbody>
		</table>
	</div>
<?php
	}

	function register_settings() {
		$settings_fields = array(
			'settings' => array(
				'qqworld_auto_save_images_classic_edition',
				'qqworld_auto_save_images_mode',
				'qqworld_auto_save_images_when',
				'qqworld_auto_save_images_remote_publishing',
				'qqworld_auto_save_images_schedule_publish',
				'qqworld_auto_save_images_set_featured_image',
				'qqworld_auto_save_images_auto_change_name',
				'qqworld_auto_save_images_only_save_first',
				'qqworld_auto_save_images_maximum_picture_size',
				'qqworld_auto_save_images_minimum_picture_size',
				'qqworld-auto-save-images-exclude-domain',
				'qqworld-auto-save-images-format'
			)
		);
		foreach ( $settings_fields as $field => $settings )
			foreach ( $settings as $setting )
			 register_setting("qqworld_auto_save_images_{$field}", $setting);
	}

	/**
	* gets the current post type in the WordPress Admin
	*/
	public function get_current_post_type() {
		global $post, $typenow, $current_screen;

		if (isset($_GET['post']) && $_GET['post']) {
			$post_type = get_post_type($_GET['post']);
			return $post_type;
		}

		//we have a post so we can just get the post type from that
		if ( $post && $post->post_type )
			return $post->post_type;

		//check the global $typenow - set in admin.php
		elseif( $typenow )
			return $typenow;

		//check the global $current_screen object - set in sceen.php
		elseif( $current_screen && $current_screen->post_type )
			return $current_screen->post_type;

		//lastly check the post_type querystring
		elseif( isset( $_REQUEST['post_type'] ) )
			return sanitize_key( $_REQUEST['post_type'] );

		//we do not know the post type!
		return null;
	}

	function add_actions() {
		add_filter( 'wp_insert_post_data', array($this, 'fetch_images_when_saving'), 10, 2);
		add_action( 'wp_insert_post', array($this, 'set_featured_image_for_wp_4_6'), 10, 3 );
	}

	public function set_featured_image_for_wp_4_6($post_ID, $post, $update) {
		if (!empty($this->thumbnail_id)) set_post_thumbnail($post_ID, $this->thumbnail_id);
	}

	function remove_actions() {
		remove_filter( 'wp_insert_post_data', array($this, 'fetch_images_when_saving') );
		remove_action( 'wp_insert_post', array($this, 'set_featured_image_for_wp_4_6') );
		if ($this->schedule_publish == 'yes') remove_action( 'publish_future_post', array($this, 'fetch_images_after_save') );
		if ($this->remote_publishing) remove_action('xmlrpc_publish_post', array($this, 'fetch_images_after_save') );
	}

	function utf8_urldecode($str) {
		$str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\\\1;",urldecode($str));
		return html_entity_decode($str, null, 'UTF-8');
	}

	function save_remote_images() { // for manual mode
		set_time_limit(0);
		//Check to make sure function is not executed more than once on save
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return;

		$post_id = $_POST['post_id'];

		if ( !current_user_can('edit_post', $post_id) ) 
		return;

		$this->current_post_id = $post_id;

		$this->has_remote_image = 0;
		$this->has_missing_image = 0;

		$content = $this->content_save_pre($this->utf8_urldecode($this->utf8_urldecode($_POST['content'])), $post_id);
		wp_update_post(array('ID' => $post_id, 'post_content' => addslashes($content)));

		$result = array();
		if ($this->has_remote_image) {
			if ($this->has_missing_image) {
				$result['type'] = 3;
				$result['msg'] = __('Has Missing/Undownloadable images.', $this->text_domain);
			} else {
				$result['type'] = 2;
				$result['msg'] = __('All remote images have been saved.', $this->text_domain);
			}
		} else {
			$result['type'] = 1;
			$result['msg'] = __('No remote images found.', $this->text_domain);
		}
		$result['content'] = $content;
		echo json_encode($result);
		exit;
	}

	public function fetch_images_when_saving($data, $postarr) {
		set_time_limit(0);

		if ($this->when == 'save') $allow = true;
		elseif ($this->when == 'publish' && $data['post_status'] == 'publish') $allow = true;
		else $allow = false;
		if ($allow) {
			$this->has_remote_image = 0;
			$this->has_missing_image = 0;
			add_filter( 'redirect_post_location', array($this, 'redirect_post_location'), 10, 2);
			$data['post_content'] = addslashes($this->content_save_pre(stripslashes($data['post_content']), $postarr['ID']));
		}
		return $data;
	}

	function fetch_images_after_save($post_id) { // for automatic mode
		set_time_limit(0);

		//Check to make sure function is not executed more than once on save
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
			return;

		// AJAX? Not used here
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) 
			return;

		$this->current_post_id = $post_id;
		
		$this->has_remote_image = 0;
		$this->has_missing_image = 0;
		
		add_filter( 'redirect_post_location', array($this, 'redirect_post_location'), 10, 2);

		if ($this->mode=='auto') $this->remove_actions();
		if ($this->remote_publishing) remove_action('xmlrpc_publish_post', array($this, 'fetch_images') );
		if ($this->schedule_publish == 'yes') remove_action('publish_future_post', array($this, 'fetch_images') );

		$post = get_post($post_id);
		$content = $this->content_save_pre($post->post_content, $post_id);

	    //Replace the image in the post
		remove_action( 'post_updated', 'wp_save_post_revision' );
	    wp_update_post(array('ID' => $post_id, 'post_content' => addslashes($content)));
		add_action( 'post_updated', 'wp_save_post_revision', 10, 1 );

		if ($this->mode=='auto') $this->add_actions();
		if ($this->remote_publishing) add_action('xmlrpc_publish_post', array($this, 'fetch_images') );
		if ($this->schedule_publish == 'yes') add_action('publish_future_post', array($this, 'fetch_images') );
	}

	public function getimagesize($image_url) {
		$params = @getimagesize($image_url);
		$width = $params[0];
		$height = $params[1];
		$this->type = $params['mime'];
		if ($width==null) {
			$file = @file_get_contents( $image_url );
			if ($file) {
				$encoding = $this->fsockopen_image_header($image_url, 'Content-Encoding');
				if ($encoding == 'gzip' && function_exists('gzdecode')) $file = gzdecode($file);
				if (function_exists('getimagesizefromstring')) {
				$params = getimagesizefromstring($file);
					$width = $params[0];
					$height = $params[1];
					$this->type = $params['mime'];
				}
			}
		} else {
			$width = $params[0];
			$height = $params[1];
			$this->type = $params['mime'];
		}
		return array($width, $height, $this->type);
	}

	public function convert_space_from_content($content) {
		$preg = preg_match_all('/(src|href)=\"((?!\").*?)\"/i', stripslashes($content), $matches);
		if ($preg) {
			foreach ($matches[2] as $match) {
				if (preg_match("/ /", $match)) {
					$new_str = str_replace(' ', '%20', $match);
					$content = str_replace($match, $new_str, $content);
				}
			}
		}
		return $content;
	}

	public function automatic_set_featured_pic_from_media_library($post_id) {
		if ( $this->featured_image == 'yes' && !has_post_thumbnail($post_id) ) {
			$media = get_attached_media('image', $post_id);
			if (!empty($media)) foreach ($media as $attachment_id => $attachment) {
				set_post_thumbnail( $post_id, $attachment_id );
				break;
			}
		}
	}

	public function content_save_pre($content, $post_id=null, $action='save') {
		$post = get_post($post_id);
		if ($post->post_type == 'revision') return;

		$this->count = 1;
		$content = $this->convert_space_from_content($content);
		$this->change_attachment_url_to_permalink($content);
		$remote_images = array();
		$preg = preg_match_all('/<img.*?src=\"((?!\").*?)\"/i', stripslashes($content), $matches);
		if ($preg) $remote_images = $matches[1];
		$preg = preg_match_all('/<img.*?src=\'((?!\').*?)\'/i', stripslashes($content), $matches);
		if ($preg) $remote_images = array_merge($remote_images, $matches[1]);
		if(!empty($remote_images)){
			foreach($remote_images as $image_url) {
				if ($this->only_save_first != 'all' && $this->count++ > $this->only_save_first) continue;
				if (empty($image_url)) continue;
				// exclude domain
				$allow=true;
				if (!empty($this->exclude_domain)) foreach ($this->exclude_domain as $domain) {
					if ($allow==true) {
						$pos=strpos($image_url, $domain);
						if($pos) $allow=false;
					}
				}
				// check pictrue size
				list($width, $height, $type) = $this->getimagesize($image_url);
				
				if ($width != NULL && ($width<$this->minimum_picture_size['width'] || $height<$this->minimum_picture_size['height'])) $allow = false;
				// check if remote image
				if ($allow) {
					$pos = strpos($image_url, get_bloginfo('url'));
					if($pos===false){
						$this->has_remote_image = 1;
						if ($action=="save" && $res=$this->save_images($image_url,$post_id)) {
							$content = $this->format($image_url, $res, $content);
						}
					}
				}
			}
		}
		if (!empty($post_id)) $this->automatic_set_featured_pic_from_media_library($post_id);
		return apply_filters( 'qqworld-auto-save-images-content-save-pre', $content, $post_id );
	}

	public function change_attachment_url_to_permalink(&$content) {
		$pattern = '/<a\s[^>]*href=\"'.$this->encode_pattern(home_url('?attachment_id=')).'(.*?)\".*?>/i';
		if ( preg_match_all($pattern, $content, $matches) ) {
			foreach ($matches[1] as $attachment_id) {
				$attachment = get_post($attachment_id);
				$post = get_post($attachment->post_parent);
				if ($post->post_status != 'draft' && $post->post_status != 'pending' && $post->post_status != 'future') {
					$url = get_permalink($attachment_id);
					$content = preg_replace('/'.$this->encode_pattern(home_url('?attachment_id='.$attachment_id)).'/i', $url, $content);
				}
			}
		}
	}

	public function encode_pattern($str) {
		$str = str_replace('(', '\(', $str);
		$str = str_replace(')', '\)', $str);
		$str = str_replace('{', '\{', $str);
		$str = str_replace('}', '\}', $str);
		$str = str_replace('+', '\+', $str);
		$str = str_replace('.', '\.', $str);
		$str = str_replace('?', '\?', $str);
		$str = str_replace('*', '\*', $str);
		$str = str_replace('/', '\/', $str);
		$str = str_replace('^', '\^', $str);
		$str = str_replace('$', '\$', $str);
		$str = str_replace('|', '\|', $str);
		return $str;
	}

	public function format($image_url, $res, $content) {
		$no_match = false;
		$attachment_id = $res['id'];
		$url_path = str_replace(basename($res['file']), '', $res['url']);
		$size = isset($res['sizes'][$this->format['size']]) ? $this->format['size'] : 'full';
		if ($size == 'full') {
			$src = $res['url'];
			$width = $res['width'];
			$height = $res['height'];
		} else {
			$src = $url_path . $res['sizes'][$size]['file'];
			$width = $res['sizes'][$size]['width'];
			$height = $res['sizes'][$size]['height'];
		}
		$pattern_image_url = $this->encode_pattern($image_url);
		$preg = false;
		if ($this->keep_outside_links=='no') {
			$pattern = '/<a[^<]+><img\s[^>]*'.$pattern_image_url.'.*?>?<[^>]+a>/i';
			$preg = preg_match($pattern, $content, $matches);
			if ($preg) {
				if ( $this->save_outside_links == 'yes' ) {
					if ( preg_match('/<a[^>]*href=\"(.*?)\".*?>/i', $matches[0], $match) ) {
						$link = $match[1];
						$description = '<a href="'.$link.'" target="_blank" rel="nofollow">'.__('Original Link', $this->text_domain).'</a>';
						$description = apply_filters('qqworld-auto-save-images-save-outsite-link', $description, $link);
						$args = array(
							'ID' => $attachment_id,
							'post_content' => $description
						);
						wp_update_post($args);
					}
				}
				$args = $this->set_img_metadata($matches[0], $attachment_id);
			}
		}
		if (!$preg) {
			$pattern = '/<img\s[^>]*'.$pattern_image_url.'.*?>/i';
			if ( preg_match($pattern, $content, $matches) ) {
				$args = $this->set_img_metadata($matches[0], $attachment_id);
			} else {
				$pattern = '/'.$pattern_image_url.'/i';
				$no_match = true;
			}
		}
		$alt = isset($args['alt']) ? ' alt="'.$args['alt'].'"' : '';
		$title = isset($args['title']) ? ' title="'.$args['title'].'"' : '';
		$align = $this->auto_caption == 'yes' ? '' : 'align'.$this->format_align_to.' ';
		$img = '<img class="'.$align.'size-'.$size.' wp-image-'.$attachment_id.'" src="'.$src.'" width="'.$width.'" height="'.$height.'"'.$alt.$title.' />';
		$link_to = $this->keep_outside_links=='no' ? $this->format['link-to'] : 'none';
		switch ($link_to) {
			case 'none':
				$replace = $img; break;
			case 'file':
				$replace = '<a href="'.$res['url'].'">'.$img.'</a>';
				break;
			case 'post':
				$replace = '<a href="'.get_permalink($attachment_id).'">'.$img.'</a>';
				break;
		}
		if ($no_match) $replace = $res['url'];
		else if ($this->auto_caption == 'yes') $replace = '[caption id="attachment_'.$attachment_id.'" align="align'.$this->format_align_to.'" width="'.$width.'"]' . $replace . ' ' . (isset($args['alt']) ? $args['alt'] : '') . '[/caption]';
		$replace .= str_replace( '[Attachment ID]', $res['id'], $this->additional_content['after'] );

		if ( $this->keep_outside_links=='yes' ) {
			$patt = '/<a[^<]+><img\s[^>]*'.$pattern_image_url.'.*?>?<[^>]+a>/i';
			if ( preg_match($patt, $content, $match) ) {
				$string = $match[0];
				$pos = strpos($string, '>');
				$string = substr_replace($string, ' rel="nofollow">', $pos, 1);
				$content = preg_replace($patt, $string, $content);
			}
		}

		$content = preg_replace($pattern, $replace, $content);
		return $content;
	}

	public function set_img_metadata($img, $attachment_id) {
		if ($this->change_title_alt == 'no') {
			$pattern = '/<img\s[^>]*alt=\"(.*?)\".*?>/i';
			if ( preg_match($pattern, $img, $matches) ) $alt = $matches[1];
			else {
				$pattern = '/<img\s[^>]*alt=\'(.*?)\'.*?>/i';
				$alt = preg_match($pattern, $img, $matches) ? $matches[1] : null;
			}
			$pattern = '/<img\s[^>]*title=\"(.*?)\".*?>/i';
			if ( preg_match($pattern, $img, $matches) ) $title = $matches[1];
			else {
				$pattern = '/<img\s[^>]*alt=\'(.*?)\'.*?>/i';
				$title = preg_match($pattern, $img, $matches) ? $matches[1] : null;
			}
		} else {
			$alt = $this->get_post_title() ? $this->get_post_title() : null;
			$title = $this->get_post_title() ? $this->get_post_title() : null;
		}
		if ($alt) update_post_meta($attachment_id, '_wp_attachment_image_alt', $alt);
		if ($title) {
			$attachment = array(
				'ID' => $attachment_id,
				'post_title' => $title
			);
			wp_update_post($attachment);
		}
		return array(
			'alt' => $alt,
			'title' => $title
		);
	}

	public function get_post_title() {
		$post = get_post($this->current_post_id);
		return $post->post_title;
	}

	public function get_post_name() {
		return sanitize_title_with_dashes( $this->get_post_title() );
	}

	public function change_images_filename($name, $extension) {
		switch ($this->change_image_name) {
			case 'none':
				break;
			case 'ascii':
				if ( !preg_match( '/^[\x20-\x7f]*$/', $name, $match ) ) $name = md5($name);
				break;
			case 'all':
				global $post;
				$name = urldecode($this->get_post_name());
				$name = apply_filters('qqworld-auto-save-images-string-compatible', $name);
				break;
		}
		return apply_filters('qqworld-auto-save-images-custom-filename-structure', $name) . $extension;
	}

	public function get_filename_from_url($url) {
		$url = parse_url($url);
		$path = $url['path'];
		$filename = explode('/', $path);
		$filename = urldecode($filename[count($filename)-1]);
		return $filename;
	}

	public function automatic_reduction($file, $image_url) {
		$filetype = $this->getFileType($file);
		list($width, $height, $type) = $this->getimagesize($image_url);

		$needs_reduction = false;
		if ( !empty($this->maximum_picture_size['width']) && !empty($this->maximum_picture_size['height']) && ($width > $this->maximum_picture_size['width'] || $height > $this->maximum_picture_size['height']) ) {
			$needs_reduction = true;
		} elseif ( !empty($this->maximum_picture_size['width']) && empty($this->maximum_picture_size['height']) && $width > $this->maximum_picture_size['width'] ) {
			$needs_reduction = true;
		} elseif ( empty($this->maximum_picture_size['width']) && !empty($this->maximum_picture_size['height']) && $height > $this->maximum_picture_size['height'] ) {
			$needs_reduction = true;
		}

		if ($needs_reduction) {
			if ($width > $height) {
				$maximum_picture_size_width = empty($this->maximum_picture_size['width']) ? $width*$this->maximum_picture_size['height']/$height : $this->maximum_picture_size['width'];
				$new_width = intval($maximum_picture_size_width);
				$new_height = intval($height*$maximum_picture_size_width/$width);
			} else {
				$maximum_picture_size_height = empty($this->maximum_picture_size['height']) ? $height*$this->maximum_picture_size['width']/$width : $this->maximum_picture_size['height'];
				$new_width = intval($width*$maximum_picture_size_height/$height);
				$new_height = intval($maximum_picture_size_height);
			}
			$image_p = imagecreatetruecolor($new_width, $new_height);
			$image = imagecreatefromstring($file);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			ob_start();
			switch ($filetype) {
				case 'jpg':
				case 'jpeg':
					imageJpeg($image_p, null, 75);
					break;
				case 'png':
					imagePng($image_p, null);
					break;
				case 'gif':
					imageGif($image_p, null);
					break;
			}
			$file = ob_get_contents();
			ob_end_clean();
			imagedestroy($image_p);
			imagedestroy($image);
			$width = $new_width;
			$height = $new_height;
		}
		return array($file, $width, $height);
	}

	function fsockopen_image_header($image_url, $mode='Content-Type') { // 'Content-Length' | 'Content-Type' | 'Date' | 'Last-Modified'
		$url = parse_url($image_url);
		$fp = @fsockopen($url['host'], 80, $errno, $errstr, 30);
		if ($fp) {
			//这里请求设置为HEAD
			$out = "HEAD {$url['path']} HTTP/1.1\r\n";
			$out .= "Host: {$url['host']}\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
			while (!feof($fp)) {
				$header = fgets($fp);
				if (stripos($header, $mode) !== false) {
					$value = trim(substr($header, strpos($header, ':') + 1));
					return $value;
				}
			}
			fclose($fp);
		}
		return null;
	}

	public function download_image($image_url) {
		$encoding = $this->fsockopen_image_header($image_url, 'Content-Encoding');
		$file = '';

		// file_get_contents
		if (function_exists('file_get_contents')) {
			$file = @file_get_contents($image_url);
			if ($encoding == 'gzip' && function_exists('gzdecode')) $file = @gzdecode($file);
		}

		// curl
		if (!$file && function_exists('curl_init')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $image_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			//curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			$file = curl_exec($ch);
			if ($encoding == 'gzip' && function_exists('gzdecode')) $file = @gzdecode($file);
			curl_close($ch);
		}

		// GD
		$img = @imagecreatefromstring($file);
		if (!$img && function_exists('fsockopen')) {
			$type = @$this->fsockopen_image_header($image_url);
			if (!empty($type) && in_array($type, array('image/jpeg', 'image/gif', 'image/png'))) {
				$type = substr($type, 6);
				$img = @call_user_func("imagecreatefrom{$type}", $image_url);
				if ($img) {
					ob_start();
					call_user_func("image{$type}", $img);
					$file = ob_get_contents();
					ob_end_clean();
					imagedestroy($img);
					if ($encoding == 'gzip' && function_exists('gzdecode')) $file = @gzdecode($file);
				}
			} else $file = '';
		}
		return $file;
	}

	//save exterior images
	function save_images($image_url, $post_id){
		set_time_limit(0);
		$file = $this->download_image($image_url);
		if ( $file ) {
			$filename = $this->get_filename_from_url($image_url);
			preg_match( '/(.*?)(\.(jpg|jpeg|png|gif|bmp))$/i', $filename, $match );
			if ( empty($match) ) {
				if ($filetype = $this->getFileType($file) ) {
					preg_match( '/(.*?)$/i', $filename, $match );
					$pos=strpos($image_url,'?'); // if has '?', md5()
					$img_name = $pos ? md5($match[0]) : $match[0];
					$img_name = $this->change_images_filename($img_name, '.'.$filetype);
				} else return false;
			} else {
				$img_name = $match[1];
				$filetype = preg_replace('/^./', '', $match[2]);
				$img_name = $this->change_images_filename($match[1], $match[2]);
			}
			// Automatic reduction pictures size
			list($file, $width, $height) = $this->automatic_reduction($file, $image_url);
			/* fit to custom-upload-dir - start */
			if (function_exists('cud_custom_upload_dir')) {
				$temp_id = $post_id;
				global $post_id, $cud_file_ext, $cud_file_type;
				$post_id = $temp_id;
				$cud_file_type = $this->type;
				$cud_file_ext = $filetype;
				add_filter('upload_dir', 'cud_custom_upload_dir', 1);
			}
			/* fit to custom-upload-dir - end */
			$res=wp_upload_bits($img_name,'',$file);
			if (isset( $res['error'] ) && !empty($res['error'])) return false;
			$attachment_id = $this->insert_attachment($res['file'], $post_id);
			$res['id'] = $attachment_id;
			$meta_data = wp_get_attachment_metadata($attachment_id);
			$res = @array_merge($res, $meta_data);
			if( !has_post_thumbnail($post_id) && $this->featured_image=='yes' ) {
				$this->thumbnail_id = $res['id'];
				set_post_thumbnail( $post_id, $attachment_id );
			}
			return $res;
		} else {
			$this->has_missing_image = 1;
		}
		return false;
	}

	public function getFileType($file){
		$bin = substr($file,0,2);
		$strInfo = @unpack("C2chars", $bin);
		$typeCode = intval($strInfo['chars1'].$strInfo['chars2']);
		switch ($typeCode) {
			case 7790: $fileType = 'exe'; return false;
			case 7784: $fileType = 'midi'; return false;
			case 8297: $fileType = 'rar'; return false;
			case 255216: $fileType = 'jpg'; $mime = 'image/jpeg'; return $fileType;
			case 7173: $fileType = 'gif'; $mime = 'image/gif'; return $fileType;
			case 6677: $fileType = 'bmp'; $mime = 'image/bmp'; return $fileType;
			case 13780: $fileType = 'png'; $mime = 'image/png'; return $fileType;
			default: return false;
		}
	}
	
	//insert attachment
	function insert_attachment($file, $id){
		$dirs = wp_upload_dir();
		$filetype = wp_check_filetype($file);
		$attachment=array(
			'guid' => $dirs['baseurl'].'/'._wp_relative_upload_path($file),
			'post_mime_type' => $filetype['type'],
			'post_title' => preg_replace('/\.[^.]+$/','',basename($file)),
			'post_content' => '',
			'post_status' => 'inherit'
		);
		$attach_id = wp_insert_attachment($attachment, $file, $id);
		if (!function_exists('wp_generate_attachment_metadata')) include_once (ABSPATH . DIRECTORY_SEPARATOR . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'image.php');
		$attach_data = wp_generate_attachment_metadata($attach_id, $file);
		wp_update_attachment_metadata($attach_id, $attach_data);
		return $attach_id;
	}
}
new QQWorld_auto_save_images;

class QQWorld_Save_Remote_Images_Walker_Category_Checklist extends Walker {
	public $tree_type = 'category';
	public $db_fields = array ('parent' => 'parent', 'id' => 'term_id'); //TODO: decouple this

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='children'>\n";
	}
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		if ( empty( $args['taxonomy'] ) ) {
			$taxonomy = 'category';
		} else {
			$taxonomy = $args['taxonomy'];
		}

		if ( $taxonomy == 'category' ) {
			$name = 'post_category';
		} else {
			$name = 'tax_input[' . $taxonomy . ']';
		}
		$args['popular_cats'] = empty( $args['popular_cats'] ) ? array() : $args['popular_cats'];
		$class = in_array( $category->term_id, $args['popular_cats'] ) ? ' class="popular-category"' : '';

		$args['selected_cats'] = empty( $args['selected_cats'] ) ? array() : $args['selected_cats'];

		/** This filter is documented in wp-includes/category-template.php */
		$output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" .
			'<label class="selectit"><input value="' . $category->term_id . '" type="checkbox" name="terms['.$taxonomy.'][]" id="in-'.$taxonomy.'-' . $category->term_id . '"' .
			checked( in_array( $category->term_id, $args['selected_cats'] ), true, false ) .
			disabled( empty( $args['disabled'] ), false, false ) . ' /> ' .
			esc_html( apply_filters( 'the_category', $category->name ) ) . '</label>';
	}
	public function end_el( &$output, $category, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}