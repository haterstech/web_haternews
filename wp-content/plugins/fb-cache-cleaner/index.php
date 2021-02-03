<?php
/**
 * Plugin Name: FB Cache Cleaner
 * Plugin URI: http://www.michelangeloscotto.net/
 * Description: This plugin clear the cache of facebook after a post is updated.
 * Version: 1.0
 * Author: Michelangelo Scotto di Gregorio
 * Author URI: http://www.michelangeloscotto.net
 * License: Copyright 2015 Michelangelo Scotto di Gregorio.
 */
 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Icona
$fcp_ico = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUxMiA1MTIiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxwYXRoIGZpbGw9IiNmZmZmZmYiIGQ9Ik00MzQuNTIxLDI0OS40M2MtMTIuNzQ5LDAtMjMuMDg0LDEwLjMzNi0yMy4wODQsMjMuMDg0YzAsODUuNzA4LTY5LjcyOSwxNTUuNDM3LTE1NS40MzgsMTU1LjQzN3MtMTU1LjQzNy02OS43MjktMTU1LjQzNy0xNTUuNDM3UzE3MC4yOTIsMTE3LjA3NywyNTYsMTE3LjA3N2M1LjUwNSwwLDEwLjk4LDAuMjkzLDE2LjQxLDAuODYybC0xMy42MDcsMjQuNDQ3Yy0xLjYwNCwyLjg4Mi0xLjU0OSw2LjQwMSwwLjE0Niw5LjIzMmMxLjY2OSwyLjc4OSw0LjY3OSw0LjQ5Miw3LjkyMyw0LjQ5MmMwLjA0OCwwLDAuMDk3LDAsMC4xNDYtMC4wMDJsMTE0LjE0Ny0xLjc5MmMzLjI5OC0wLjA1Myw2LjMxOC0xLjg1OSw3LjkyMy00Ljc0MWMxLjYwNC0yLjg4MywxLjU1LTYuNDAyLTAuMTQ1LTkuMjMzbC01OC42MTktOTcuOTY5Yy0xLjY5NC0yLjgzLTQuNzU1LTQuNTY0LTguMDY4LTQuNDkxYy0zLjI5OSwwLjA1MS02LjMxOSwxLjg1OS03LjkyNCw0Ljc0MmwtMTcuOTk2LDMyLjMzMmMtMTMuMjE2LTIuNjg1LTI2LjcxMi00LjA0OS00MC4zMzUtNC4wNDljLTUzLjg1MSwwLTEwNC40NzksMjAuOTcxLTE0Mi41NTcsNTkuMDQ5cy01OS4wNDksODguNzA2LTU5LjA0OSwxNDIuNTU3czIwLjk3MSwxMDQuNDc5LDU5LjA0OSwxNDIuNTU3UzIwMi4xNDksNDc0LjExOSwyNTYsNDc0LjExOXMxMDQuNDc5LTIwLjk3MSwxNDIuNTU3LTU5LjA0OWMzOC4wNzktMzguMDc4LDU5LjA1LTg4LjcwNiw1OS4wNS0xNDIuNTU3QzQ1Ny42MDYsMjU5Ljc2Niw0NDcuMjcsMjQ5LjQzLDQzNC41MjEsMjQ5LjQzeiIvPjxwYXRoIGZpbGw9IiNmZmZmZmYiIGQ9Ik0zNTUuNzkxLDM3MS4yMjVjLTIuNTU3LTYuNTY4LTQuMzExLTEwLjc0NS00LjMxMS0xMC43NDVjLTIuMzA4LTUuNTItNy44Ni05LjA1NS0xMy4xNjItMTEuMjI5bC0zNS44MzQtMTYuNDk4bC0xNy4yMTQtMTQuNTE4bC0yNy42NjIsMjcuNTEzbDkuOTgsNjYuNzIyQzMwMS45NjMsNDA5LjY0NywzMzIuODY5LDM5NC4zOTYsMzU1Ljc5MSwzNzEuMjI1eiIvPjxwYXRoIGZpbGw9IiNmZmZmZmYiIGQ9Ik0xNzMuNjgyLDM0OS4yNWMtNS4zMDIsMi4xNzUtMTEuMDcsNS45NS0xMy4xNjIsMTEuMjI5YzAsMC0xLjc1NCw0LjE3OC00LjMxMSwxMC43NDVjMjIuOTIyLDIzLjE3MSw1My44MjgsMzguNDIzLDg4LjIwMyw0MS4yNDRsOS45NzktNjYuNzIybC0yNy42NjEtMjcuNTEzbC0xNy4yMTQsMTQuNTE4TDE3My42ODIsMzQ5LjI1eiIvPjxwYXRoIGZpbGw9IiNmZmZmZmYiIGQ9Ik0zMjAuNjE5LDIyNi4zMDRjMC4zOTctMzkuNzM0LTE4LjUyNi02My41MTQtNjQuNjItNjMuNTE0Yy00Ni4wOTQsMC02NS4wMjEsMjMuNzc5LTY0LjYxOCw2My41MTRjMC42MjIsNTcuMjYyLDI3Ljk2OSw5MS40MDcsNjQuNjE4LDkxLjQwN0MyOTIuNjQ3LDMxNy43MTEsMzE5Ljk5NiwyODMuNTY1LDMyMC42MTksMjI2LjMwNHoiLz48L2c+PC9zdmc+';

// Setup
register_activation_hook( __FILE__, 'setup_fcp');
function setup_fcp(){
 add_option('miksco_fcp', '2');
}

// Azioni, filitri, hooks
add_action('admin_menu', 'miksco_fcp_menu');
add_action('admin_bar_menu', 'miksco_fcp_toolbar', 1000);

// Admin menu
function miksco_fcp_menu(){ global $fcp_ico;
 add_menu_page('FBCachePurge', 'FB Cache Cleaner', 'manage_options', 'miksco_fcp', 'miksco_fcp', $fcp_ico);
}

// Admin menu bar
function miksco_fcp_toolbar(){ global $wp_admin_bar, $fcp_ico;
 if(!is_super_admin() || !is_admin_bar_showing()) return;
 
 $wp_admin_bar->add_menu(array('id'=>'MikScoFCPToolbar', 'title' => '<span class="ab-icon"><img alt="FB Cache Cleaner" style="max-height:20px" src="'.$fcp_ico.'"></span> FB Cache Cleaner', 'href'=> admin_url("admin.php?page=miksco_fcp")));
}

// Clear Cache for Publish post
add_action('save_post', 'clear_cache');

function clear_cache($post){
 if(get_post_status($post) == "publish"){
  wp_remote_post("https://graph.facebook.com?id=".get_permalink($post)."&scrape=true");
 }
}

// Dashboard
function miksco_fcp(){
 include("inc/dashboard.php");
}

?>