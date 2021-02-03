<?php 
/*
Template Name: 点赞排行榜
*/
get_header();?>
<?php if(have_posts()): while(have_posts()):the_post();  ?>
<div id="page-content" class="page-single" >
	<div class="page-title" style="background:#504B51 url(<?php echo like_banner_pic(); ?>);background-repeat: no-repeat;background-size: cover;background-position: center top;">
		<div class="container">
			<h1 class="title">
				<?php the_title(); ?>
			</h1>
			<div class="page-dec">
				<?php the_content();?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="page-content">
			<ul class="likepage">
				<?php 
					$args = array(
					    'ignore_sticky_posts' => 1,
					    'meta_key' => 'suxing_ding',
					    'orderby' => 'meta_value_num',
					    'showposts' => 40
					);
					query_posts($args);

					while ( have_posts() ) : the_post(); 
				    $like = get_post_meta( get_the_ID(), 'bigfa_ding', true );?>
						<div class="like-posts">
							<div class="like-posts-box">
								<div class="like-posts-src" style="background:url(<?php echo post_thumbnail_src(); ?>) no-repeat center top; background-size:cover;" >
									<div class="gradient"></div>
									<a href="<?php the_permalink(); ?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>></a>
								</div>
								<div class="like-posts-title">
									<a href="<?php the_permalink(); ?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>><h2><?php the_title(); ?></h2></a>
									<div class="post-views"><a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" id="Addlike" class="action sharebtn like<?php if(isset($_COOKIE['suxing_ding_'.$post->ID])) echo ' current';?>" title="喜欢">
												<span class="icon s-like">喜歡 |  </span>
												<span class="count num"><?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></span>
											</a></div>
								</div>
							</div>
						</div>
				   <?php 
				   endwhile; 
				    wp_reset_query();
				?>
			</ul>
		</div>
		<div class="clear"></div>
		<?php if (comments_open()) comments_template( '', true ); ?>
		
	</div>
</div>
<?php endwhile; endif; ?>	
<?php get_footer(); ?>
