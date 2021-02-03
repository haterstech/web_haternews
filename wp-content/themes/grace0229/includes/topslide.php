
<div id="top-slide" class="owl-carousel">
	<?php 
		$numpost = suxingme('suxingme_slide_number');
		$args = array( 
		'showposts' => $numpost,
		'ignore_sticky_posts' => 1,	
		'meta_query' => array(
			array(
				'key' => 'lunbo_value', 
				'value' => 'true'  
				)));
		query_posts($args);
		if (have_posts()) : while (have_posts()) : the_post();?>
			<div class="item">	
				<a href="<?php the_permalink(); ?>"  target="_blank" title="<?php the_title();?>">
					<?php if (get_post_meta($post->ID,"postthumb_value",true )) {	?>
						<img src="<?php echo get_post_meta($post->ID,"postthumb_value",true);?>"  alt="<?php the_title(); ?>">
					<?php }elseif( suxingme('suxingme_timthumb')){ ?>
						<img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=450&w=1120&zc=1"  alt="<?php the_title(); ?>">
					<?php }else{ ?>
						<img src="<?php echo post_thumbnail_src(); ?>"  alt="<?php the_title(); ?>">
					<?php } ?>
				</a>
				<?php if( suxingme('suxingme_slide_info',true) ) { ?>
					<div class="slider-content">
						<div class="slider-content-box">    
							<div class="post-categories clearfix">            
								<?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?>       
							</div>  
							
							<div class="slider-title">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
				            </div>
				            <div class="post-element clearfix">
					            <ul>
					            	<li  class="post-slider-author"><?php echo get_avatar( get_the_author_meta('email'), '' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>                
					            	<li class="post-slider-clock"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
					            	<li class="post-slider-views"><i class="icon-eye"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></li>            
					            </ul>        
				            </div>
					        <div class="slider-post-text clearfix"><?php if(has_excerpt()) the_excerpt();else echo '<p class="posts-gallery-text">'.deel_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 60, '...').'</p>';?></div>
					        <div class="read-more"><a href="<?php the_permalink(); ?>">閱讀全文</a></div>   
			           	</div>
					</div>
				<?php } ?> 
			</div>
			<?php endwhile; else:  
				$categories = explode(",",suxingme( 'suxingme_slide_fenlei' ));
				$order = suxingme('suxingme_slide_order');
				$num = suxingme('suxingme_slide_number');
				$args = array(
					'ignore_sticky_posts'=> 1,
					'paged' => $paged,
					'orderby'=> $order,//date DESC rand
					'posts_per_page' =>  $num,
					'cat' => $categories , 
					'tax_query' => array( array( 
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array(
							//请根据需要保留要排除的文章形式
							'post-format-aside',
							'post-format-link'
							),
						'operator' => 'NOT IN',
					) ),
				);
			query_posts($args);			
			while (have_posts()) : the_post();?>
			<div class="item">	
				<a href="<?php the_permalink(); ?>"  target="_blank" title="<?php the_title();?>">
					<?php if (suxingme('suxingme_timthumb')) {	?>
						<img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=450&w=1120&zc=1"  alt="<?php the_title(); ?>">
					<?php }else{ ?>
						<img src="<?php echo post_thumbnail_src(); ?>"  alt="<?php the_title(); ?>">
					<?php }?>
				</a>
				<?php if( suxingme('suxingme_slide_info',true) ) { ?>
					<div class="slider-content">
						<div class="slider-content-box">    
							<div class="post-categories clearfix">            
								<?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?>       
							</div>  
							
							<div class="slider-title">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
				            </div>
				            <div class="post-element clearfix">
					            <ul>
					            	<li  class="post-slider-author"><?php echo get_avatar( get_the_author_meta('email'), '' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>                
					            	<li class="post-slider-clock"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
					            	<li class="post-slider-views"><i class="icon-eye"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></li>            
					            </ul>        
				            </div>
					        <div class="slider-post-text clearfix"><?php if(has_excerpt()) the_excerpt();else echo '<p class="posts-gallery-text">'.deel_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 60, '...').'</p>';?></div>
					        <div class="read-more"><a href="<?php the_permalink(); ?>">閱讀全文</a></div>   
			           	</div>
					</div>
				<?php } ?> 
			</div>
	<?php endwhile; wp_reset_query(); endif; ?>

</div>
