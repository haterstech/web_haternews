<?php get_header(); ?>
<div id="page-content">
	<div class="container">
		<div class="posts">	
			<div class="posts-box">
				<?php if ( !have_posts() ) : ?>
				
					<?php _e('沒有找到相關的內容'); ?></p>
			
				<?php else: ?>
				
				<div class="search-title">
					<div class="search-title-box">
					<h3 class="subtitle"><span><?php global $wp_query; echo '搜索到 ' . $wp_query->found_posts . ' 篇相關的文章';?></span></h3></div>
				</div>
				<div class="ajax-load-box posts-con">
					<?php while ( have_posts() ) : the_post(); 
						include( TEMPLATEPATH.'/includes/excerpt.php' );endwhile; ?>
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
				endif; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>