<?php if( suxingme('suxing_ad_posts_pc')){  ?>
	<?php
		$num = suxingme('suxing_ad_posts_pc_num',3);
		if ($wp_query->current_post == $num) : ?>
			<div class="ajax-load-con content posts-cjtz">
				<?php echo suxingme('suxing_ad_posts_pc_url'); ?>
			</div>
		<?php endif; ?>
<?php } ?>
<?php if( suxingme('suxing_ad_posts_m')){  ?>
	<?php
		$num = suxingme('suxing_ad_posts_m_num');
		if ($wp_query->current_post == $num) : ?>
			<div class="ajax-load-con content posts-cjtz-min">
				<?php echo suxingme('suxing_ad_posts_m_url'); ?>
			</div>
		<?php endif; ?>
<?php } ?>
<?php if( has_post_format( 'link' ) ){ //推广文章?>
<li class="ajax-load-con content">
	<div class="content-box posts-gallery-box">
		<div class="posts-gallery-img">
			<div class="posts-gallery-info">
				<span class="i-tgwz">推廣</span>
			</div>
			<a href="<?php the_permalink(); ?>" title="<?php the_title();?>"  target="_blank">	
				<?php if( suxingme('suxingme_timthumb_lazyload')) { ?>
					<img class="lazy thumbnail" data-original="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=160&w=240&zc=1" src="<?php echo constant("THUMB_SMALL_DEFAULT");?>" alt="<?php the_title(); ?>" />	
				<?php }else if (suxingme('suxingme_timthumb')) {	?>
					<img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=160&w=240&zc=1" alt="<?php the_title(); ?>" />
				<?php }else{ ?>
					<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
				<?php }?>
			</a> 
		</div>
		<div class="posts-gallery-content">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="_blank"><?php the_title();?></a></h2>	
			<div class="posts-gallery-text"><?php if(has_excerpt()) echo mb_substr(get_the_excerpt(),0,60,"utf8").'...';else echo deel_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 60, '...');?></div>
			
		</div>
	</div>
</li>
<?php } else if ( has_post_format( 'aside' )) { //无图文章 ?>
<li class="ajax-load-con content">
	<div class="content-box posts-aside">
		<div class="posts-default-content">
			<div class="posts-default-title">
				<?php if (suxingme('suxingme_post_tags',true)) { the_tags('<div class="post-entry-categories">','','</div>'); }?>
				<h2><?php echo suxing_post_state_date()?><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="_blank"><?php the_title();?></a></h2>
			</div>
			<div class="posts-text"><?php if(has_excerpt()) echo mb_substr(get_the_excerpt(),0,90,"utf8").'...';else echo deel_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 90, '...');?></div>
			<div class="posts-default-info">
				<ul>
					
					<li class="post-author"><div class="avatar"><?php echo get_avatar( get_the_author_meta('email'), '' ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
					<li class="ico-cat"><i class="icon-list-1"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
					<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
					<li class="ico-eye"><i class="icon-eye-1"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></li>
					
				</ul>
			</div>
		</div>
	</div>
</li>
<?php } else if ( has_post_format( 'image' )) { //多图 ?>
<li class="ajax-load-con content">
	<div class="content-box posts-image-box">
		<div class="posts-default-title">
			<?php if (suxingme('suxingme_post_tags',true)) { the_tags('<div class="post-entry-categories">','','</div>'); }?>
			<h2><?php echo suxing_post_state_date()?><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="_blank"><?php the_title();?></a></h2>
		</div>
		<div class="post-images-item">
			<ul>
				<?php echo suxingme_get_thumbnail();?>
			</ul>
		</div>
		<div class="posts-default-content">
			
			<div class="posts-text"><?php if(has_excerpt()) echo mb_substr(get_the_excerpt(),0,90,"utf8").'...';else echo deel_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 90, '...');?></div>
			<div class="posts-default-info">
				<ul>
					<li class="post-author"><div class="avatar"><?php echo get_avatar( get_the_author_meta('email'), '' ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
					<li class="ico-cat"><i class="icon-list-1"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
					<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) )?></li>
					<li class="ico-eye"><i class="icon-eye-1"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></li>
					
				</ul>
			</div>
		</div>
	</div>
</li>
<?php } else if ( has_post_format( 'gallery' )) { //左图 ?>

<li class="ajax-load-con content">
	<div class="content-box posts-gallery-box">
		<div class="posts-gallery-img">
			<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="_blank">	
				<?php if( suxingme('suxingme_timthumb_lazyload')) { ?>
					<img class="lazy thumbnail" data-original="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=160&w=240&zc=1" src="<?php echo constant("THUMB_SMALL_DEFAULT");?>" alt="<?php the_title(); ?>" />	
				<?php }else if (suxingme('suxingme_timthumb')) {	?>
					<img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=160&w=240&zc=1" alt="<?php the_title(); ?>" />
				<?php }else{ ?>
					<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
				<?php }?>
			</a> 
		</div>
		<div class="posts-gallery-content">
			<h2><?php echo suxing_post_state_date()?><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="_blank"><?php the_title();?></a></h2>
			<div class="posts-gallery-text"><?php if(has_excerpt()) echo mb_substr(get_the_excerpt(),0,55,"utf8").'...'; else echo deel_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 55, '...');?></div>
			<div class="posts-default-info">
				<ul>
					
					<li class="post-author"><div class="avatar"><?php echo get_avatar( get_the_author_meta('email'), '' ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
					<li class="ico-cat"><i class="icon-list-1"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
					<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
					<li class="ico-eye"><i class="icon-eye-1"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></li>
					
				</ul>
			</div>
		</div>
	</div>
</li>
<?php } else{ //标准 ?>
<li class="ajax-load-con content posts-default">
	<div class="content-box">	
		<div class="posts-default-img">
			<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="_blank">
				<div class="overlay"></div>	
				<?php if( suxingme('suxingme_timthumb_lazyload')) { ?>
					<img class="lazy thumbnail" data-original="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=300&w=760&zc=1" src="<?php echo constant("THUMB_BIG_DEFAULT");?>" alt="<?php the_title(); ?>" />	
				<?php }else if (suxingme('suxingme_timthumb')) {	?>
					<img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=300&w=760&zc=1" alt="<?php the_title(); ?>" />
				<?php }else{ ?>
					<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="nothumbnail" />
				<?php }?>
			</a> 
		</div>
		<div class="posts-default-box">
			<div class="posts-default-title">
				<?php if (suxingme('suxingme_post_tags',true)) { the_tags('<div class="post-entry-categories">','','</div>'); }?>
				<h2><?php echo suxing_post_state_date()?><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="_blank"><?php the_title();?></a></h2>
			</div>
			<div class="posts-default-content">
				
				<div class="posts-text"><?php if(has_excerpt()) echo mb_substr(get_the_excerpt(),0,90,"utf8").'...';else echo deel_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 90, '...');?></div>
				<div class="posts-default-info">
					<ul>
						<li class="post-author"><div class="avatar"><?php echo get_avatar( get_the_author_meta('email'), '' ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
						<li class="ico-cat"><i class="icon-list-1"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
						<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) )?></li>
						<li class="ico-eye"><i class="icon-eye-1"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
</li>

<?php } ?>
