<?php
	global $post;
	$cats = wp_get_post_categories($post->ID);
	if ($cats) {
		//$args = array(
		//	  'category__in' => array( $cats[0] ),
		//	  'post__not_in' => array( $post->ID ),
		//	  'showposts' => 3,
		//	  'ignore_sticky_posts' => 1,
		//	  'orderby'=>'rand',
		//  );
        $numpost = suxingme('suxingme_slide_number');
        $args=array(
            'post_status' => 'publish', // 只选公开的文章.
            'orderby' => 'date',
            'post__in'   => get_option('sticky_posts'),
            'posts_per_page' =>6,
            'caller_get_posts' => 1
        );
	  query_posts($args);
	  $rel_ad_i = 0;

	  if (have_posts()) {
		while (have_posts()) {
		  the_post(); update_post_caches($posts); 
			$rel_ad_i++;
			if($rel_ad_i == 2){
	  ?>

	

	  <?php
				continue;
			}
		  
		  ?>  
			<li>
				<div class="box">
					<a class="pic" href="<?php the_permalink(); ?>"title="<?php the_title(); ?>" target="_blank" style="background:url(<?php  echo post_thumbnail_src();?>) no-repeat center top; background-size:cover;"></a>               
					<h2><a href="<?php the_permalink(); ?>"title="<?php the_title(); ?>" target="_blank" ><?php the_title(); ?></a></h2>
					<div class="meta">
						<span class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></span>
						<span class="ico-eye"><i class="icon-eye-1"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></span>		
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
