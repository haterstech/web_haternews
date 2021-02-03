<?php
	global $post;
	$cats = wp_get_post_categories($post->ID);
	if ($cats) {
		$args = array(
			  'category__in' => array( $cats[0] ),
			  'post__not_in' => array( $post->ID ),
			  'showposts' => 3,
			  'ignore_sticky_posts' => 1,
			  'orderby'=>'rand',
		  );
	  query_posts($args);
	  if (have_posts()) {
		while (have_posts()) {
		  the_post(); update_post_caches($posts); ?>  
			<li>
				<div class="item">
					<a class="relatedpostpic" rel="nofollow" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<div class="overlay"></div>
						<?php if( suxingme('suxingme_timthumb_lazyload')) { ?>
							<img class="attachment-medium wp-post-image lazy thumbnail" data-original="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=150&w=237&zc=1" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo constant("THUMB_BIG_DEFAULT");?>&h=150&w=237&zc=1" alt="<?php the_title(); ?>" />	
						<?php }else if (suxingme('suxingme_timthumb')) {	?>
							<img class="attachment-medium wp-post-image" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=150&w=237&zc=1" alt="<?php the_title(); ?>" />
						<?php }else{ ?>
							<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="attachment-medium wp-post-image" />
						<?php }?>                         
						
					</a>
					<div class="relatedPostDesc">
						<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					</div>
				</div>
			</li>
	<?php
		}
	  } 
	  else {
		echo '<li>暫無相關文章</li>';
	  }
	  wp_reset_query(); 
	}
	else {
	  echo '<li>暫無相關文章</li>';
	}
?>
