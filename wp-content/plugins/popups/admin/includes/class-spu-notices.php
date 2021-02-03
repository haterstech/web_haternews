<?php

/**
 * Class that handle all admin notices
 *
 * @since      1.3.1
 * @package    SocialPopup
 * @subpackage SocialPopup/Admin/Includes
 * @author     Damian Logghe <info@timersys.com>
 */
class SocialPopup_Notices {


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.3.1
	 */
	public function __construct( ) {

		if( isset( $_GET['spu_notice'])){
			update_option('spu_'.esc_attr($_GET['spu_notice']), true);
		}
	}


	public function rate_plugin(){
		?><div class="notice-info notice">
		<h3><i class=" dashicons-before dashicons-share-alt"></i>WordPress Popups Plugin</h3>
			<p><?php echo sprintf(__( 'We noticed that you have been using our plugin for a while and we would like to ask you a little favour. If you are happy with it and can take a minute please <a href="%s" target="_blank">leave a nice review</a> on WordPress. It will be a tremendous help for us!', 'spu' ), 'https://wordpress.org/support/view/plugin-reviews/popups?filter=5' ); ?></p>
		<ul>
			<li><?php echo sprintf(__('<a href="%s" target="_blank">Leave a nice review</a>'),'https://wordpress.org/support/view/plugin-reviews/popups?filter=5');?></li>
			<li><?php echo sprintf(__('<a href="%s">I already did</a>'), admin_url('?spu_notice=rate_plugin'));?></li>
		</ul>
		</div><?php
	}

	public function enabled_cache() {
		?><div class="notice-warning notice is-dismissible spu_enable_ajax">
		<h3><i class=" dashicons-before dashicons-share-alt"></i>WordPress Popups Plugin</h3>
			<p>
				<?php _e('It looks like you are using a Cache plugin. Remember to enable ajax mode to bypass page cache');?>
			</p>
			<p>
				<?php echo sprintf(__('Enable it on the <a href="%s">Settings page</a>'), admin_url('edit.php?post_type=spucpt&page=spu_settings'));?>
			</p>
		</div>
<script type="text/javascript">
jQuery(function($){
	$( document ).on( 'click', '.spu_enable_ajax .notice-dismiss', function () {

		$.ajax( ajaxurl,
		  {
			type: 'POST',
			data: {
			  action: 'spu_enable_ajax_notice_handler'
			}
		  } );
	} );
});
</script>
		<?php
	}
}
