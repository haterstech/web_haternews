<?php get_header();?>
<script type="text/javascript">
function jumpNewsList(catId){
	window.location.href = "http://www.haters.com.tw/?cat=" + catId;	
}
</script>
<div id="page-content">
	<div class="container">
		<?php if(is_home()&&!is_paged()){ ?>
			<div class="top-content">
				<?php if( suxingme('suxingme_slide',true) ) { 
				include( 'includes/topslide.php' );}?>
				<?php if( suxingme('suxing_cat_index_on') ) { ?>	
					<div class="cat">
						<ul>
							<?php 
								$top_args=array(
					    		'showposts' => 3,
					    		'orderby' => 'date',
					    		'post__in'   => get_option('sticky_posts'),
					    		'ignore_sticky_posts' => 0
					    		);
					    		$top_posts = query_posts($top_args);
								if($top_posts){
					    		while (have_posts()) : the_post(); 
			    			?>
								<li>
								<div class="index-cat-box" style="background-image:url(<?php echo post_thumbnail_src(); ?>)">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
									<div class="sticky-title"><div class="dec"><span class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></span>
												<span class="ico-eye"><i class="icon-eye-1"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></span>
												</div><h2><?php the_title(); ?></h2></div>
								</div>
								</li>
							<?php endwhile; wp_reset_query(); }?>
						</ul>
					</div>
			
			<?php } ?>
			</div>
		<?php } ?>

		<?php if(suxingme('suxingme_new_post',true)) { ?>
			<div class="posts">	
				<div class="posts-box">
					<div class="twolists">
					<?php 
						$categories=explode(",",suxingme('suxingme_cat_list'));
						foreach ($categories as $cat=>$catid ){
					?>
						<div class="list">
							<div class="list-box">
								<div class="list-title more-list-title"><?php $cat = get_category($catid);echo $cat->name; ?><span><a target="_blank" href="<?php
						        if($catid == 16){ $catid=17; }
						        echo get_category_link($catid);?>">更多</a></span></div>
								<ul>
								<?php
									$args = array(
													'post_status' => 'publish', // 只选公开的文章.
													'ignore_sticky_posts' => 1, // 排除置頂文章.
													'cat'     => $catid,
													'order'            => DESC,
													'showposts' => 4,
													
												);
									$query_posts = new WP_Query();
									$query_posts->query($args);
									$i=1;
									while( $query_posts->have_posts() ) { $query_posts->the_post(); ?>
									<?php if($i == 1){ ?>
									<li class="first">
										<a class="firstpic" href="<?php the_permalink(); ?>" style="background:url(<?php echo post_thumbnail_src(); ?>) no-repeat center top; background-size:cover;" title="<?php the_title(); ?>" target="_blank">
											<div class="meta">
												<h2><?php the_title(); ?></h2>
												<div class="dec"><span class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></span>
												<span class="ico-eye"><i class="icon-eye-1"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></span>
												</div>
											</div>
										</a>
									</li>
									<?php }else{ ?>
									<li class="others">
										<a class="pic" href="<?php the_permalink(); ?>" target="_blank">
											
										<?php if (suxingme('suxingme_timthumb')) {	?>
											<img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=70&w=100&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/>
										<?php } else { ?>
											<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
										<?php } ?>
										</a>
										<div class="meta">
											<h2><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h2>
											<div class="dec">
												<span class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></span>
												<span class="ico-eye"><i class="icon-eye-1"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></span>
												
											</div>
										</div>
									</li>
									<?php } $i++;} wp_reset_query();?>
								</ul>
							</div>
						</div>
						<?php } ?>
					</div>
					<?php
						$args = array(
						'ignore_sticky_posts'=> 1,
						'paged' => $paged
							);
						if( suxingme('notinhome') ){
							$pool = array();
							foreach (suxingme('notinhome') as $key => $value) {
								if( $value ) $pool[] = $key;
							}
							$args['cat'] = '-'.implode($pool, ',-');
						}		
						query_posts($args);if ( have_posts() ) : ?>
							<div class="ajax-load-box posts-con">
								<div class="list-title">最新新聞</div>
								<?php while ( have_posts() ) : the_post(); 
									include( 'includes/excerpt.php' );endwhile; ?>
							</div>
							<div class="clearfix"></div>
							<?php if( suxingme('suxingme_ajax_posts',true) ) { ?>
								<div id="ajax-load-posts">
									<?php 
										//echo fa_load_postlist_button();
									?>
                                    <button class="button button-more" onclick="jumpNewsList(17)">查看更多</button>
                                    
								</div>
								
								<?php  }else {
									the_posts_pagination( array(
										'prev_text'          =>上页,
										'next_text'          =>下页,
										'screen_reader_text' =>'',
										'mid_size' => 1,
									) ); } ?>
								<?php 	else :
								get_template_part( 'content', 'none' );

						endif;?>
					<?php 
						$categories=explode(",",suxingme('suxingme_cat_list2'));
						foreach ($categories as $cat=>$catid ){
					?>
					<div class="onelist">
					
						<div class="list-title"><?php $cat = get_category($catid);echo $cat->name; ?> <span><a target="_blank" href="<?php echo get_category_link($catid);?>">更多</a></span></div>
						<ul>
						<?php	
							$args = array(
								'ignore_sticky_posts'=> 1,
								'paged' => $paged,
								'orderby'=> DESC,
								'posts_per_page' =>6,
								'cat' => $catid , 
								
							);
						query_posts($args);		
						if (have_posts()) : while (have_posts()) : the_post();?>
							<li>
								<div class="box">
									<a class="pic" href="<?php the_permalink(); ?>"title="<?php the_title(); ?>" style="background:url(<?php echo post_thumbnail_src(); ?>) no-repeat center top; background-size:cover;"></a>
									<h2><a href="<?php the_permalink(); ?>"title="<?php the_title(); ?>" ><?php the_title(); ?></a></h2>
									<div class="meta">
										
										<span class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></span>
										<span class="ico-eye"><i class="icon-eye-1"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></span>
										
									</div>
								</div>
							</li>
						<?php endwhile; wp_reset_query(); endif; ?>
						</ul>
                        
					</div>
                    <div id="ajax-load-posts">
                    <button class="button button-more" onclick="jumpNewsList(<?php echo $catid; ?>)">查看更多</button>
                    </div>
					<?php } ?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>