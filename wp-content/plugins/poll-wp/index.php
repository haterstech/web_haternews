<?php
      /*
      Plugin Name: Poll
      Plugin URI: http://total-soft.pe.hu/poll
      Description: Best Add a powerful poll on your site. WordPress Poll plugin is a responsive and customizable for WordPress. Poll plugin will help you more easily create powerful poll.
      Author: totalsoft
      Version: 1.2.45
      Author URI: http://total-soft.pe.hu/
      License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
      */

	require_once(dirname(__FILE__) . '/Includes/Total-Soft-Poll-Widget.php');
	require_once(dirname(__FILE__) . '/Includes/Total-Soft-Poll-Ajax.php');
	add_action('wp_enqueue_scripts', 'TotalSoft_Poll_Widget_Style');

	function TotalSoft_Poll_Widget_Style(){
		wp_register_style('Total_Soft_Poll', plugins_url('/CSS/Total-Soft-Poll-Widget.css',__FILE__ ));
		wp_enqueue_style('Total_Soft_Poll');
		wp_register_script('Total_Soft_Poll',plugins_url('/JS/Total-Soft-Poll-Widget.js',__FILE__),array('jquery','jquery-ui-core'));
		// wp_register_script('Total_Soft_Poll','jquery');
		// wp_register_script('Total_Soft_Poll','jquery-ui-core');
		wp_localize_script('Total_Soft_Poll', 'object', array('ajaxurl' => admin_url('admin-ajax.php')));
		wp_enqueue_script('Total_Soft_Poll');
		wp_enqueue_script("jquery");
		wp_enqueue_script("jquery-ui-core");

		wp_register_style('fontawesome-css', plugins_url('/CSS/totalsoft.css', __FILE__));
		wp_enqueue_style('fontawesome-css');
	}

	add_action('widgets_init', 'TotalSoft_Poll_Widget_Reg');

	function TotalSoft_Poll_Widget_Reg(){
		register_widget('Total_Soft_Poll');
	}

	add_action("admin_menu", 'TotalSoft_Poll_Admin_Menu');

	function TotalSoft_Poll_Admin_Menu(){
		$complete_url = wp_nonce_url( '', 'edit-menu_', 'TS_Poll_Nonce' );
		add_menu_page('Admin Menu', 'Poll Options', 'manage_options','Total_Soft_Poll' . $complete_url, 'Add_New_Poll',plugins_url('/Images/admin.png',__FILE__));
		add_submenu_page('Total_Soft_Poll' . $complete_url, 'Admin Menu', 'Poll Manager', 'manage_options', 'Total_Soft_Poll' . $complete_url, 'Add_New_Poll');
		add_submenu_page('Total_Soft_Poll' . $complete_url, 'Admin Menu', 'New Settings', 'manage_options', 'Total_Soft_Setting' . $complete_url, 'Total_Soft_Settings');
		add_submenu_page('Total_Soft_Poll' . $complete_url, 'Admin Menu', 'Themes', 'manage_options', 'Total_Soft_Theme' . $complete_url, 'Total_Soft_Themes');
		add_submenu_page('Total_Soft_Poll' . $complete_url, 'Admin Menu', 'Results', 'manage_options', 'Total_Soft_Result' . $complete_url, 'Total_Soft_Results');
		add_submenu_page('Total_Soft_Poll' . $complete_url, 'Admin Menu', 'Info', 'manage_options', 'Total_Soft_Info' . $complete_url, 'Total_Soft_Infos');
		add_submenu_page('Total_Soft_Poll' . $complete_url, 'Admin Menu', '<span id="TS_Poll_Sup">Support Forum</span>', 'manage_options', 'Total_Soft_Poll_Support', 'TS_Poll_Support');
		add_submenu_page('Total_Soft_Poll' . $complete_url, 'Admin Menu', 'Total Products', 'manage_options', 'Total_Soft_Products' . $complete_url, 'Total_Soft_Product_Poll');
	}

	add_action('admin_init', 'TotalSoft_Poll_Admin_Style');

	function TotalSoft_Poll_Admin_Style(){
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');

		wp_register_style('Total_Soft_Poll', plugins_url('/CSS/Total-Soft-Poll-Admin.css',__FILE__));
		wp_enqueue_style('Total_Soft_Poll' );
		wp_register_script('Total_Soft_Poll', plugins_url('/JS/Total-Soft-Poll-Admin.js',__FILE__),array('jquery','jquery-ui-core'));
		wp_localize_script('Total_Soft_Poll','object', array('ajaxurl'=>admin_url('admin-ajax.php')));
		wp_enqueue_script('Total_Soft_Poll');
		wp_enqueue_script("jquery");
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');

		wp_register_style('fontawesome-css', plugins_url('/CSS/totalsoft.css', __FILE__));
		wp_enqueue_style('fontawesome-css');
	}

	add_action ('wp_loaded', 'TS_PollSupport');

	function TS_PollSupport()
	{
		$get;
		isset($_GET['page']) ? $get = $_GET['page'] : $get = "";
		if( $get != 'Total_Soft_Poll_Support' ){
			return;
		}
		$url = 'https://wordpress.org/support/plugin/poll-wp';
		wp_redirect($url);
		exit;
	}

	add_action( 'admin_footer', 'TS_Poll_Support_Blank' );
	function TS_Poll_Support_Blank()
	{
		?>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#TS_Poll_Sup').parent().attr('target','_blank');
			});
		</script>
		<?php
	}

	function Add_New_Poll()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Poll-New.php');
	}
	function Total_Soft_Settings()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Poll-Settings.php');
	}
	function Total_Soft_Themes()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Poll-Options.php');
	}
	function Total_Soft_Results()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Poll-Results.php');
	}
	function Total_Soft_Infos()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Poll-Info.php');
	}
	function Total_Soft_Poll() {}
	function Total_Soft_Product_Poll()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Products.php');
	}
	function TotalSoftPollInstall()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Poll-Install.php');
	}
	register_activation_hook(__FILE__,'TotalSoftPollInstall');

	function Total_SoftPoll_Short_ID($atts, $content = null)
	{
		$atts=shortcode_atts(
			array(
				"id"=>"1"
			),$atts
		);
		return Total_Soft_Draw_Poll($atts['id']);
	}
	add_shortcode('Total_Soft_Poll', 'Total_SoftPoll_Short_ID');
	function Total_Soft_Draw_Poll($Poll)
	{
		ob_start();
			$args = shortcode_atts(array('name' => 'Widget Area','id'=>'','description'=>'','class'=>'','before_widget'=>'','after_widget'=>'','before_title'=>'','AFTER_TITLE'=>'','widget_id'=>'','widget_name'=>'Total Soft Poll'), $Poll, 'Total_Soft_Poll' );
			$Total_Soft_Poll = new Total_Soft_Poll;

			$instance = array('Total_Soft_Poll'=>$Poll, 'Total_Soft_Poll_T'=>'');
			$Total_Soft_Poll->widget($args,$instance);
			$cont[] = ob_get_contents();
		ob_end_clean();
		return $cont[0];
	}
	function TotalSoft_Poll_Color()
	{
		wp_enqueue_script(
			'alpha-color-picker',
			plugins_url('/JS/alpha-color-picker.js', __FILE__),
			array( 'jquery', 'wp-color-picker' ), // You must include these here.
			null,
			true
		);
		wp_enqueue_style(
			'alpha-color-picker',
			plugins_url('/CSS/alpha-color-picker.css', __FILE__),
			array( 'wp-color-picker' ) // You must include these here.
		);
	}
	add_action( 'admin_enqueue_scripts', 'TotalSoft_Poll_Color' );

	function Total_Soft_Poll_settings_link($links)
	{
		$forum_link = '<a target="_blank" href="https://wordpress.org/support/plugin/poll-wp/"> Support </a>';
		array_push($links, $forum_link);
		return $links;
	}

	$plugin = plugin_basename(__FILE__);
	add_filter("plugin_action_links_$plugin", 'Total_Soft_Poll_settings_link' );

	function TS_Poll_Media_Button() {
		$img = plugins_url('/Images/admin.png',__FILE__);
		$container_id = 'TSPoll';
		$title = 'Select Total Soft Poll to insert into post';
		$button_text = 'TS Poll';
		$context = "";
		$context .= '<a class="button thickbox" title="' . $title . '"	href="#TB_inline&inlineId=' . $container_id . '&width=400&height=240"><span class="wp-media-buttons-icon" style="background: url(' . $img . '); background-repeat: no-repeat; background-position: left bottom;background-size: 18px 18px;"></span>' . $button_text . '</a>';
		if(current_user_can('manage_options'))
		{
			echo $context;
		}
	}
	add_action( 'media_buttons', 'TS_Poll_Media_Button');
	add_action( 'admin_footer', 'TS_Poll_Media_Button_Content');

	function TS_Poll_Media_Button_Content()
	{
		require_once(dirname(__FILE__) . '/Includes/Total-Soft-Poll-Media.php');
	}
	if( isset($_GET['ts_poll_preview_poll']) )
	{
		add_filter('the_content', 'TS_Poll_theContenta');
		add_filter('template_include', 'TS_Poll_templateIncludea');

		function TS_Poll_theContenta()
		{
			if (!is_user_logged_in()) return 'Log In first in order to preview the Poll.';

			ob_start();
				$args = shortcode_atts(array('name' => 'Widget Area','id'=>'','description'=>'','class'=>'','before_widget'=>'','after_widget'=>'','before_title'=>'','AFTER_TITLE'=>'','widget_id'=>'','widget_name'=>'Total Soft Poll'), $_GET['ts_poll_preview_poll'], 'Total_Soft_Poll' );
				$Total_Soft_Poll = new Total_Soft_Poll;

				$instance = array('Total_Soft_Poll'=>$_GET['ts_poll_preview_poll'], 'Total_Soft_Poll_T'=>'');
				$Total_Soft_Poll->widget($args,$instance);
				$cont[] = ob_get_contents();
			ob_end_clean();
			return $cont[0];
		}
		function TS_Poll_templateIncludea()
		{
			return locate_template(array('page.php', 'single.php', 'index.php'));
		}
	}
	if( isset($_GET['ts_poll_preview_theme']) )
	{
		add_filter('the_content', 'TS_Poll_theContent');
		add_filter('template_include', 'TS_Poll_templateInclude');

		function TS_Poll_theContent()
		{
			global $wpdb;
			$table_name1  = $wpdb->prefix . "totalsoft_poll_manager";
			$table_name4  = $wpdb->prefix . "totalsoft_poll_dbt";
			$table_namea01 = $wpdb->prefix . "totalsoft_poll_stpoll_01";
			$table_namea03 = $wpdb->prefix . "totalsoft_poll_impoll_01";
			$table_namea05 = $wpdb->prefix . "totalsoft_poll_stwibu_01";
			$table_namea07 = $wpdb->prefix . "totalsoft_poll_imwibu_01";
			$table_namea09 = $wpdb->prefix . "totalsoft_poll_iminqu_01";

			$TotalSoftPoll = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id>%d", 0));

			if($_GET['ts_poll_preview_theme'] == 'true1')
			{
				$TotalSoftPollOptions = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea01 WHERE id > %d", 0));
				$TS_Poll_Theme_Prev = 'true1';
			}
			else if($_GET['ts_poll_preview_theme'] == 'true2')
			{
				$TotalSoftPollOptions = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea03 WHERE id > %d", 0));
				$TS_Poll_Theme_Prev = 'true2';
			}
			else if($_GET['ts_poll_preview_theme'] == 'true3')
			{
				$TotalSoftPollOptions = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea05 WHERE id > %d", 0));
				$TS_Poll_Theme_Prev = 'true3';
			}
			else if($_GET['ts_poll_preview_theme'] == 'true4')
			{
				$TotalSoftPollOptions = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea07 WHERE id > %d", 0));
				$TS_Poll_Theme_Prev = 'true4';
			}
			else if($_GET['ts_poll_preview_theme'] == 'true5')
			{
				$TotalSoftPollOptions = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_namea09 WHERE id > %d", 0));
				$TS_Poll_Theme_Prev = 'true5';
			}
			else
			{
				$TotalSoftPollOptions = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id = %d", $_GET['ts_poll_preview_theme']));
				$TS_Poll_Theme_Prev = $_GET['ts_poll_preview_theme'];
			}

			if(count($TotalSoftPoll) != 0)
			{
				for($i = 0; $i < count($TotalSoftPoll); $i++)
				{
					$TotalSoftPollOptions1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id = %d", $TotalSoftPoll[$i]->TotalSoftPoll_Theme));
					if($TotalSoftPollOptions1[0]->TotalSoft_Poll_TType == $TotalSoftPollOptions[0]->TotalSoft_Poll_TType)
					{
						$TSPoll = $TotalSoftPoll[$i]->id;
						$i = count($TotalSoftPoll);
					}
					else
					{
						$TSPoll = '';
					}
				}
			}
			else{ $TSPoll = ''; }

			if (!is_user_logged_in()) return 'Log In first in order to preview the Poll.';

			ob_start();
				$args = shortcode_atts(array('name' => 'Widget Area','id'=>'','description'=>'','class'=>'','before_widget'=>'','after_widget'=>'','before_title'=>'','AFTER_TITLE'=>'','widget_id'=>'','widget_name'=>'Total Soft Poll'), $TSPoll, 'Total_Soft_Poll' );
				$Total_Soft_Poll = new Total_Soft_Poll;

				$instance = array('Total_Soft_Poll'=>$TSPoll, 'Total_Soft_Poll_T'=>$TS_Poll_Theme_Prev);
				$Total_Soft_Poll->widget($args,$instance);
				$cont[] = ob_get_contents();
			ob_end_clean();
			return $cont[0];
		}
		function TS_Poll_templateInclude()
		{
			return locate_template(array('page.php', 'single.php', 'index.php'));
		}
	}
?>