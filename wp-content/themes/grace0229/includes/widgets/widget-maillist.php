<?php  

add_action('widgets_init', create_function('', 'return register_widget("suxingme_maillist");'));
class suxingme_maillist extends WP_Widget {
	function suxingme_maillist() {
		$widget_ops = array( 'classname' => 'suxingme_maillist', 'description' => '邮件订阅（仅适用于qq邮件订阅，详情看： http://list.qq.com ）' );
		 parent::__construct( 'suxingme_maillist', 'QQ邮件订阅', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		$title = apply_filters('widget_name', $instance['title']);
		$nid = $instance['nid'];
		$placeholder = $instance['placeholder'];
		echo $before_title.$title.$after_title; 
		
		echo '<form action="http://list.qq.com/cgi-bin/qf_compose_send" target="_blank" method="post"><input type="hidden" name="t" value="qf_booked_feedback" /><input type="hidden" name="id" value="' . $nid . '" />';
		echo '<input type="email" name="to" class="rsstxt" placeholder="' . $placeholder . '" value="" required /><input type="submit" class="rssbutton" value="订阅" />';
		
		echo '</from>';
		echo $after_widget;
	}

	function form($instance) {
	    $instance = wp_parse_args( (array) $instance, array( 
			'title' => '邮件订阅',
			'placeholder' => 'your@email.com',
			) 
		);
		$instance['nid'] = ! empty( $instance['nid'] ) ? esc_attr( $instance['nid'] ) : '';
?>

<p>
	<label> 名称：
		<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label> 订阅ID：
		<input id="<?php echo $this->get_field_id('nid'); ?>" name="<?php echo $this->get_field_name('nid'); ?>" type="text" value="<?php echo $instance['nid']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label> 提示文字：
		<input id="<?php echo $this->get_field_id('placeholder'); ?>" name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php echo $instance['placeholder']; ?>" class="widefat" />
	</label>
</p>
<?php
	}
}

?>
