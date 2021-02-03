<?php  

add_action('widgets_init', create_function('', 'return register_widget("suxingme_social");'));
class suxingme_social extends WP_Widget {
	function suxingme_social() {
		$widget_ops = array( 'classname' => 'suxingme_social', 'description' => '集成社交网站链接入口' );
		parent::__construct( 'suxingme_social', '关注我们', $widget_ops );
	}

    function widget($args, $instance) {
        extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$qq = $instance['qq'];
		$sinaweibo = $instance['sinaweibo'];
		$mail = $instance['mail'];
		$weixin = $instance['weixin'];
		$tencent = $instance['tencent'];
		
		echo $before_widget;
        echo suxingme_widget_social($title,$sinaweibo,$tencent,$qq,$mail,$weixin);
        echo $after_widget;	
    }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['qq'] = strip_tags($new_instance['qq']);
		$instance['sinaweibo'] = strip_tags($new_instance['sinaweibo']);
		$instance['mail'] = strip_tags($new_instance['mail']);
		$instance['weixin'] = strip_tags($new_instance['weixin']);
		$instance['tencent'] = strip_tags($new_instance['tencent']);
		

		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '关注我们 么么哒！',
			) 
		);
		$instance['sinaweibo'] = ! empty( $instance['sinaweibo'] ) ? esc_attr( $instance['sinaweibo'] ) : '';
		$instance['tencent'] = ! empty( $instance['tencent'] ) ? esc_attr( $instance['tencent'] ) : '';
		$instance['mail'] = ! empty( $instance['mail'] ) ? esc_attr( $instance['mail'] ) : '';
		$instance['qq'] = ! empty( $instance['qq'] ) ? esc_attr( $instance['qq'] ) : '';
		$instance['weixin'] = ! empty( $instance['weixin'] ) ? esc_attr( $instance['weixin'] ) : '';
		
?>

<p>
	<label> 名称：
		<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label> 微博链接（链接以http://开头）：
		<input id="<?php echo $this->get_field_id('sinaweibo'); ?>" name="<?php echo $this->get_field_name('sinaweibo'); ?>" type="text" value="<?php echo $instance['sinaweibo']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label>  QQ微博链接（链接以http://开头）：
		<input id="<?php echo $this->get_field_id('tencent'); ?>" name="<?php echo $this->get_field_name('tencent'); ?>" type="text" value="<?php echo $instance['tencent']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label>  QQ邮箱地址：
		<input id="<?php echo $this->get_field_id('mail'); ?>" name="<?php echo $this->get_field_name('mail'); ?>" type="text" value="<?php echo $instance['mail']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label>  QQ客服号：
		<input id="<?php echo $this->get_field_id('qq'); ?>" name="<?php echo $this->get_field_name('qq'); ?>" type="text" value="<?php echo $instance['qq']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label>  微信二维码图片链接（链接以http://开头）：
		<input id="<?php echo $this->get_field_id('weixin'); ?>" name="<?php echo $this->get_field_name('weixin'); ?>" type="text" value="<?php echo $instance['weixin']; ?>" class="widefat" />
	</label>
</p>

<?php
	}
}

function suxingme_widget_social($title,$sinaweibo,$tencent,$qq,$mail,$weixin){ 
?>
	<div class="attentionus">
		<p class="title"><span><?php echo $title ?></span></p>
		<ul class="items clearfix">
			<?php if( $sinaweibo ) { ?>
			<a href="<?php echo $sinaweibo ?>" target="_blank" class="social_a social_weibo" rel="nofollow" title="新浪微博"><i class="icon-weibo"></i></a> 
			<?php } ?>
			<?php if( $tencent ) { ?>
			<a href="<?php echo $tencent ?>" target="_blank" class="social_a social_tencent" rel="nofollow" title="腾讯微博"><i class="icon-tencent-weibo"></i></a><?php } ?>
			<?php if( $mail ) { ?>
			<a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=<?php echo $mail ?>" target="_blank" class="social_a social_email" rel="nofollow" title="邮箱"><i class="icon-mail"></i></i></a><?php } ?>
			<?php if( $qq ) { ?>
			<div class="dropdown-menu-part">
				<a id="tooltip-qq" href="javascript:void(0);" onclick="return false;" target="_blank" class="social_a social_qq" rel="nofollow" title="QQ:<?php echo $qq ?>"><i class="icon-qq"></i></a>
				<div class="dropdown-menu qq-dropdown">
					<p><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $qq ?>&site=qq&menu=yes"><?php echo $qq ?></a></p>
				</div>
			</div><?php } ?>
			<?php if( $weixin ) { ?>		
			<div class="dropdown-menu-part">
				<a id="tooltip-weixin" class="social_a social_weixin" href="javascript:void(0);" onclick="return false;" ><i class="icon-wechat"></i></a>
				<div class="dropdown-menu weixin-dropdown">
					<div class="tooltip-weixin-inner">
					<p style="font-size: 16px; color: #333;">微信公众号</p>
					<p>扫描下方二维码或者搜索二维码下方的微信公众号</p>
					<div class="qcode"><img src="<?php echo $weixin ?>" width="160" height="160" alt="微信公众号"></div></div>
				</div>
			</div>
			<?php } ?>
			
		</ul>
	</div>
		
<?php }?>
