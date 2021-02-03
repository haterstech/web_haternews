<div class="sidebar sidebar-right">
					<!-- 广告-->
	<?php if (!is_single()){?>
		
	<?php } ?>

	<div class="sidebar-box">
    
		<?php 
			if (is_single() && suxingme('suxingme_post_author_box',true) || is_author() && suxingme('suxingme_author_box',true)) { ?>
			<div class="widget suxingme_post_author">
				<div class="widget_box">
					<?php 
						$author_id=get_the_author_meta('ID');
						$author_url=get_author_posts_url($author_id);	
						$user_email = get_the_author_meta( 'user_email' );
					?>	
						<div class="authors_profile">
							<a target="_blank" href="<?php echo $author_url;?>" title="<?php  echo the_author_meta( 'nickname' ); ?>" class="author_pic">
								<?php echo get_avatar( get_the_author_meta('email'), 80 ); ?>
							</a>
							<div class="author_name"><a target="_blank" href="<?php echo $author_url;?>" title="<?php  echo the_author_meta( 'nickname' ); ?>"><?php the_author()?></a><span><?php echo suxing_level() ?></span></div>
							<p class="author_dec"><?php if(get_the_author_meta('description')){ echo the_author_meta( 'description' );}else{echo'我真的不是自黑!'; }?></p>
							<div class="side_count" style="margin-top:10px">
								<div class="side_cardTotal">
								<span class="card_number"><a href="<?php echo $author_url;?>" target="_blank"><?php the_author_posts(); ?></a></span>
								<span class="card"><a href="<?php echo $author_url;?>" target="_blank">文章</a></span>
								</div>
								<div class="side_comment">
									<span class="comment_number"><?php echo get_author_comment_count($author_id)?></span>
									<span class="comment"><a href="#comments">回复</a></span>
								</div>
								
							</div>
							<?php  if (is_single()) {?>
							<div class="author_post_like">
								<a href="<?php echo $author_url;?>" target="_blank">更多文章</a>
							</div>
							<?php } ?>
						</div>
				</div>
			</div>			
		<?php }	?>
		<?php if ( !is_active_sidebar( 'widget_right' ) && !is_active_sidebar( 'widget_post' ) && !is_active_sidebar( 'widget_page' ) && !is_active_sidebar( 'widget_sidebar' ) && !is_active_sidebar( 'widget_other' )) { 
				echo '<div class="widget"><div class="widget_box"><p>請到[後台 - >外觀 - >小工具]中添加需要顯示的小工具。</p></div></div>';
			 }else{
				dynamic_sidebar( 'widget_right' ); 
				if (is_single()){
					dynamic_sidebar( 'widget_post' ); 
				}
				else if (is_page()){
					dynamic_sidebar( 'widget_page' ); 
				}
				else if (is_home()){
					dynamic_sidebar( 'widget_sidebar' ); 
				}
				else {
					dynamic_sidebar( 'widget_other' );
				}
			
			} ?>

<div class="fb-page" data-href="https://www.facebook.com/hooopnews/" data-tabs="籃球網" data-height="215" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/hooopnews/"><a href="https://www.facebook.com/hooopnews/">籃球網</a></blockquote></div></div>

	</div>
</div>