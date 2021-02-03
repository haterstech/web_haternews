<div id="footer">
	<div class="container">
		<div class="row">
			<div class="inner clearfix">
				<div id="footer-copyright">Copyright © 2015 <a class="site-link" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" rel="home"><?php bloginfo('name'); ?></a> <?php if( suxingme('suxingme_beian') ) { ?><a href="http://www.miitbeian.gov.cn" rel="external nofollow" target="_blank"><?php echo suxingme('suxingme_beian'); ?></a><?php } ?> <?php if( suxingme('suxingme_statistics_code') ) { ?><?php echo suxingme('suxingme_statistics_code'); ?><?php } ?>
                &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;友情鏈接： <a href="http://www.ballgametime.com" target="_blank">黑特籃球</a>
				</div>
                
				<div id="footer-links">
                    
					<?php if(suxingme('suxingme_social_weibo')){?><a href="<?php echo suxingme('suxingme_social_weibo') ;  ?>" class="footer-link" target="_blank"><i class="icon-weibo"></i></a> <?php } ?>
					<?php if(suxingme('suxingme_social_qqweibo')){?><a href="<?php echo suxingme('suxingme_social_qqweibo') ;  ?>" target="_blank" class="footer-link" rel="nofollow" title="腾讯微博"><i class="icon-tencent-weibo"></i></a><?php } ?>
					<?php if(suxingme('suxingme_social_email')){?><a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=<?php echo suxingme('suxingme_social_email') ;  ?>" class="footer-link" target="_blank"><i class="icon-mail"></i></a><?php } ?>
					<?php if(suxingme('suxingme_social_qq')){?>
					<div class="dropdown-menu-part">
						<a id="tooltip-f-qq" href="javascript:void(0);" onclick="return false;" class="footer-link" target="_blank"><i class="icon-qq"></i></a>
						<div class="dropdown-menu f-qq-dropdown">
							<p>QQ：<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo suxingme('suxingme_social_qq');  ?>&site=qq&menu=yes"><?php echo suxingme('suxingme_social_qq');  ?></a></p>
						</div>
					</div><?php } ?>
					<?php if(suxingme('suxingme_social_weixin')){?>
					<div class="dropdown-menu-part">
						<a id="tooltip-f-weixin" href="javascript:void(0);" onclick="return false;" class="footer-link" target="_blank"><i class="icon-wechat"></i></a>
						<div class="dropdown-menu f-weixin-dropdown">
							<div class="tooltip-weixin-inner">
							<p style="font-size: 16px; color: #333;">微信公眾號</p>
							<p>掃描下方二維碼或者搜索二維碼下方的微信公眾號</p>
							<div class="qcode"> 
								<img src="<?php echo suxingme('suxingme_social_weixin') ;  ?>" width="160" height="160" alt="微信公众号">
							</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<a class="to-top"><i class="icon-up-small"></i></a>
<?php wp_footer();?>
<?php if(is_home()&&!is_paged()&&suxingme('suxingme_slide')){?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var owl = $('.owl-carousel'); 
	owl.owlCarousel({
	 	items: 1,
	 	loop:true,
	 	animateOut: 'fadeOut',
	  	autoplay:true,
	  	autoplayTimeout:3000,
	  	responsive:{	
		    765:{
		      items:1
		    }
		}
	});
 });
</script>
<?php } ?>



</body>
</html>