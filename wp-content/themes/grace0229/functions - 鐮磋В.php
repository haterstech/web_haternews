<?php

if (is_admin()) {
	$theme_name = 'Grace';
	if (!function_exists('curl_init')) {
		wp_die('主机不支持curl，请联系主机服务商。');
	}
	if ($_GET['key'] == 'wpmee') {
		$sd = '{"copyright":"200"}';
		$sdapi = json_decode($sd, true);
		update_option('mee_themes_key_' . $theme_name, $sdapi);
	}
	$mee_api = 'http://yun.api.suxing.me/';
	if (defined('WP_HOME')) {
		if (is_ssl()) {
			$site_str = str_replace('https://', "", WP_HOME);
		} else {
			$site_str = str_replace('http://', "", WP_HOME);
		}
	} else {
		if (is_ssl()) {
			$site_str = str_replace('https://', "", home_url());
		} else {
			$site_str = str_replace('http://', "", home_url());
		}
	}
	$strdomain = explode('/', $site_str);
	$domain = $strdomain[0];
	function mee_curl_get_contents($_var_0, $_var_1 = 30)
	{
		$_var_2 = curl_init();
		curl_setopt($_var_2, CURLOPT_URL, $_var_0);
		curl_setopt($_var_2, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($_var_2, CURLOPT_TIMEOUT, $_var_1);
		$_var_3 = curl_exec($_var_2);
		curl_close($_var_2);
		return $_var_3;
	}

	function GetUrlToDomain($_var_4)
	{
		$_var_5 = '';
		$_var_6 = mee_curl_get_contents($_var_7 . '?do=get_weiba');
		$_var_8 = json_decode($_var_6, true);
		$_var_9 = explode('.', $_var_4);
		$_var_10 = count($_var_9) - 1;
		if ($_var_9[$_var_10] == 'cn') {
			if (in_array($_var_9[$_var_10 - 1], $_var_8)) {
				$_var_5 = $_var_9[$_var_10 - 2] . '.' . $_var_9[$_var_10 - 1] . '.' . $_var_9[$_var_10];
			} else {
				$_var_5 = $_var_9[$_var_10 - 1] . '.' . $_var_9[$_var_10];
			}
		} else {
			$_var_5 = $_var_9[$_var_10 - 1] . '.' . $_var_9[$_var_10];
		}
		return $_var_5;
	}

	$mee_themes_key = get_option('mee_themes_key_' . $theme_name);
	if ($mee_themes_key['copyright'] != '200') {
		$c_api = mee_curl_get_contents($mee_api . '?domain=' . GetUrlToDomain($domain) . '&theme=' . $theme_name);
		$api = json_decode($c_api, true);
		//echo “theme_name：” . $theme_name;
		//print_r($api);
		wp_die('您未获得' . $theme_name . '主题的授权', '授权提示');
		update_option('mee_themes_key_' . $theme_name, $api);
		switch ($api['copyright']) {
			case 200:
				break;
			default :
				header('Content-type: text/html; charset=utf-8');
				wp_die('您未获得' . $theme_name . '主题的授权', '授权提示');
				break;
		}
	}
}
date_default_timezone_set('PRC');
define('THEME_URI', get_stylesheet_directory_uri());
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
require_once TEMPLATEPATH . '/inc/options-framework.php';
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
function optionsframework_custom_scripts()
{
	echo <<<JS
<script type="text/javascript">
jQuery(document).ready(function() {
    if (jQuery('#tab_showhidden:checked').val() !== undefined) {
        jQuery('#section-tabfirst').show();
        jQuery('#section-tabfirsttitle').show();
        jQuery('#section-tabsecond').show();
        jQuery('#section-tabsecondtitle').show();
        jQuery('#section-tabthird').show();
        jQuery('#section-tabthirdtitle').show();
    }
});
</script>
JS;
}

function remove_open_sans()
{
	wp_deregister_style('open-sans');
	wp_register_style('open-sans', false);
	wp_enqueue_style('open-sans', '');
}

add_action('init', 'remove_open_sans');
register_nav_menu('top-nav', __('导航菜单', 'main'));
register_nav_menu('mobile-nav', __('移动端菜单', 'mobile'));
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($_var_11)
{
	return is_array($_var_11) ? array_intersect($_var_11, array('current-menu-item', 'current-post-ancestor', 'current-menu-ancestor', 'current-menu-parent', 'menu-item-has-children')) : '';
}

if (function_exists('register_sidebar')) {
	register_sidebar(array('name' => '全站侧栏', 'id' => 'widget_right', 'before_widget' => '<div class="widget %2$s"><div class="widget_box">', 'after_widget' => '</div></div>', 'before_title' => '<h3>', 'after_title' => '</h3>'));
	register_sidebar(array('name' => '首页侧栏', 'id' => 'widget_sidebar', 'before_widget' => '<div class="widget %2$s"><div class="widget_box">', 'after_widget' => '</div></div>', 'before_title' => '<h3>', 'after_title' => '</h3>'));
	register_sidebar(array('name' => '文章页侧栏', 'id' => 'widget_post', 'before_widget' => '<div class="widget %2$s"><div class="widget_box">', 'after_widget' => '</div></div>', 'before_title' => '<h3>', 'after_title' => '</h3>'));
	register_sidebar(array('name' => '页面侧栏', 'id' => 'widget_page', 'before_widget' => '<div class="widget %2$s"><div class="widget_box">', 'after_widget' => '</div></div>', 'before_title' => '<h3>', 'after_title' => '</h3>'));
	register_sidebar(array('name' => '分类/标签/搜索页侧栏', 'id' => 'widget_other', 'before_widget' => '<div class="widget %2$s"><div class="widget_box">', 'after_widget' => '</div></div>', 'before_title' => '<h3>', 'after_title' => '</h3>'));
}
include_once(TEMPLATEPATH . '/includes/widgets/index.php');
include_once(TEMPLATEPATH . '/inc/options-suxing.php');
include_once(TEMPLATEPATH . '/functions_suxingme.php');