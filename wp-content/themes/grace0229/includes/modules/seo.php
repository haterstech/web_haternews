<title><?php

	global $page, $paged;
	$site_description = get_bloginfo( 'description', 'display' );
 	if ($site_description && ( is_home() || is_front_page() )) {
		bloginfo('name');
		echo page_sign();
		echo " $site_description";
	} else {
		echo trim(wp_title('',0));
		if ( $paged >= 2 || $page >= 2 )
			echo page_sign() . sprintf( __( '第%s頁' ), max( $paged, $page ) );
		echo page_sign();
		bloginfo('name');
	}
?></title>
<?php if (is_home() || is_front_page())
	{
	$description = suxingme('suxingme_description');
	$keywords = suxingme('suxingme_keywords');
	}
	elseif (is_category())
	{
	$description = strip_tags(trim(category_description()));
	$keywords = single_cat_title('', false);
	}
	elseif (is_tag())
	{
	$description = sprintf( __( '與標籤 %s 相關聯的文章列表'), single_tag_title('', false));
    $keywords = single_tag_title('', false);
	}
	elseif (is_single())
	{
     if ($post->post_excerpt) {$description = $post->post_excerpt;} 
	 else {$description = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 100,"...","utf-8");}
    $keywords = "";
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {$keywords = $keywords . $tag->name . ", ";}
	}
	elseif (is_page())
	{
	$keywords = get_post_meta($post->ID, "keywords", true);
	$description = get_post_meta($post->ID, "description", true);
	}
?>
<meta name="keywords" content="<?php echo $keywords ?>" />
<meta name="description" content="<?php echo $description?>" />

<?php 
if(is_single()){
?>

<meta property="og:title" content="<?php echo trim(wp_title('',0)); ?>" />
<meta property="og:description" content="<?php echo trim($description); ?>" />
<meta property="og:url" content="<?php  the_permalink(); ?>" />
<meta property="og:type" content="article"/>
<meta property="og:image" content="<?php  echo post_thumbnail_src(); ?>"/>
<?php
}
?>

<?php
if(is_home()) { ?>
<link rel="canonical" href="<?php echo suxingme_archive_link();?>"/>
<?php } ?>
<?php
if(is_category()) { ?>
<link rel="canonical" href="<?php echo suxingme_archive_link();?>"/>
<?php } ?>
<?php
if(is_single())  { ?>
<link rel="canonical" href="<?php the_permalink(); ?>"/>
<?php }?>
<?php
if(is_tag()) { ?>
<link rel="canonical" href="<?php echo suxingme_archive_link();?>"/>
<?php }?>