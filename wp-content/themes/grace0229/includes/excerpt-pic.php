<li class="ajax-load-con pic-posts">
	<div class="pic-posts-box">
		
		<div class="pic-posts-src" style="background-image:url(<?php echo post_thumbnail_src(); ?>); background-repeat: no-repeat;background-position:center top; background-size:cover;" >
	
			<div class="gradient"></div>
			<a href="<?php the_permalink(); ?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>></a>
		</div>
		<div class="title">
			<a href="<?php the_permalink(); ?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>><h2><?php the_title(); ?></h2></a>
			<div class="post-views"><span>瀏覽 | <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></span></div>
		</div>
	</div>
</li>
