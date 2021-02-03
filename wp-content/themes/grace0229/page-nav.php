<?php 
/*
Template Name: 导航页面
*/
get_header();

?>
<?php if(have_posts()): while(have_posts()):the_post();  


$linkcat = get_post_meta($post->ID, 'linkcat_value', true);

$link_cat_ids = explode(",",$linkcat);

foreach ( $link_cat_ids as $key => $value) {

}

?>
<div class="page-single page-nav"  >
	<div class="page-title"  style="background:#504B51 url(<?php echo like_banner_pic(); ?>);background-repeat: no-repeat;background-size: cover;background-position: center top;">
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
		<div class="page-nav-items">
			<?php 
				wp_list_bookmarks(array(
					'category' => $value,
					'show_description' => true,
					
					'title_before'     => '<h2><span>',
  					'title_after'      => '</span></h2>',
					'title_li'  => __(''),
					'category_before'  => '<div class="item">',
					'category_after'   => '</div>',
					'category_order' => ASC,
					'show_images'=> 0
				));
			?>
		</div>
	</div>
</div>
<?php endwhile; endif; ?>	
<?php get_footer(); ?>
