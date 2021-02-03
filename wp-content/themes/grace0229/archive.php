<?php get_header();?>
<div id="page-content">
	<div class="container">
		<div class="posts">
			<?php if(have_posts()) : ?>
				<div class="posts-box">
					<div class="ajax-load-box posts-con">
                    
						<?php 
							$isShowAd = 0;
							while ( have_posts() ) : the_post(); 
								include( TEMPLATEPATH.'/includes/excerpt.php' );
								if($isShowAd == 0){
									$isShowAd = 1;
						?>
					<li class="ajax-load-con content">
						<div class="content-box posts-gallery-box">
							<div class="posts-cjtz content-cjtz clearfix" style='text-align:center;'>
								<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
								<!-- PC-列表-1.1 -->
								<ins class="adsbygoogle"
									 style="display:block"
									 data-ad-client="ca-pub-4059643053601138"
									 data-ad-slot="4247568019"
									 data-ad-format="auto"
									 data-full-width-responsive="true"></ins>
								<script>
								(adsbygoogle = window.adsbygoogle || []).push({});
								</script>
							</div>
						<div class="posts-cjtz content-cjtz-mini clearfix" style="text-align:center;">
							<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- WEB-列表-1 -->
							<ins class="adsbygoogle"
								 style="display:inline-block;width:300px;height:250px"
								 data-ad-client="ca-pub-4059643053601138"
								 data-ad-slot="9453391720"></ins>
							<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
							</script>

						</div>	
					</div>
				  </li>

						<?php

								}
							endwhile; 
						?>
					</div>
					<div class="clearfix"></div>
					<?php if( suxingme('suxingme_ajax_posts',true) ) { ?>
							<div id="ajax-load-posts">
								<?php echo fa_load_postlist_button();?>
							</div>
							<?php  }else {
								the_posts_pagination( array(
									'prev_text'          =>上頁,
									'next_text'          =>下頁,
									'screen_reader_text' =>'',
									'mid_size' => 1,
								) ); } 
					else: ?>			
					<p><?php _e('站長很懶，該欄目還沒有文章...'); ?></p>
					<?php  endif; ?>
				</div>	
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>