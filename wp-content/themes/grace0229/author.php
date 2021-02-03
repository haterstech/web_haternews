<?php get_header();?>
<div id="page-content">
	<div class="container">
		<div class="posts">
			<?php if(have_posts()) : ?>
			<div class="posts-box">
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
						'prev_text'          =>上页,
						'next_text'          =>下页,
						'screen_reader_text' =>'',
						'mid_size' => 1,
					) ); } 
				else: ?>			
				<p><?php _e('該欄目還沒有文章...'); ?></p>
				<?php  endif; ?>
			</div>	
				<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
