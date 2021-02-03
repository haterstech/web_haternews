<?php 
/*
Template Name: 单栏页面
*/
get_header();?>
<div id="page-content">
	<div class="container">
	<div class="post">
		<?php if(have_posts()): ?>
		<?php while(have_posts()):the_post();  ?>
	
		
		<div class="post-title">
			<h1 class="title">
				<?php the_title(); ?>
			</h1>
		
		</div>
		<div class="post-content">
			<?php the_content();
				wp_link_pages(array('before' => '<div class="nextpage">', 'after' => '','next_or_number' => 'next', 'previouspagelink' => '<i class="icon-left-open"></i>&nbsp;&nbsp;&nbsp;&nbsp;', 'nextpagelink' => ""));  wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number','link_before' =>'<span>', 'link_after'=>'</span>')); wp_link_pages(array('before' => '', 'after' => '</div>','next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "&nbsp;&nbsp;&nbsp;&nbsp;<i class='icon-right-open'></i>")); ?>
		</div>	




	</div>
	<div class="clear"></div>
	<?php if (comments_open()) comments_template( '', true ); ?>

	<?php endwhile;  endif; ?>	
	<div class="clear"></div>
</div>	
</div>

<?php get_footer(); ?>