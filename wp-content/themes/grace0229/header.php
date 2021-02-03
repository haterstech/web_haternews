<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes/modules/seo.php'); ?>
<?php if( suxingme( 'suxingme_favicon', '' ) ) { ?>
	<link rel="shortcut icon" href="<?php echo suxingme( 'suxingme_favicon', '' ); ?>" type="image/x-icon" >
	<?php }else{ ?>
	<link rel="Shortcut Icon" href="<?php bloginfo('template_url');?>/img/favicon.ico" type="image/x-icon" />
<?php }?>
<?php if( is_single() || is_page() ) {
    if( function_exists('get_query_var') ) {
        $cpage = intval(get_query_var('cpage'));
        $commentPage = intval(get_query_var('comment-page'));
    }
    if( !empty($cpage) || !empty($commentPage) ) {
        echo '<meta name="robots" content="noindex, nofollow" />';
        echo "\n";
    }
}
?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
<meta http-equiv="X-UA-Compatible"content="IE=9; IE=8; IE=7; IE=EDGE;chrome=1">
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" media="all">
<?php if( is_home()&&suxingme( 'suxingme_slide', true ) ) { ?>
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/includes/css/owl.carousel.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/includes/css/owl.theme.css" rel="stylesheet">
<?php }?>
<!--[if lt IE 9]>
    <script src="<?php bloginfo('template_url');?>/js/html5shiv.js"></script>
    <script src="<?php bloginfo('template_url');?>/js/respond.min.js"></script>
<![endif]-->
<?php wp_head(); ?>


<?php
	if(!strpos(strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']),"cn")){
		echo "<script async src='https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>" .
			 "<script>" . "(adsbygoogle = window.adsbygoogle || []).push({" . "google_ad_client: 'ca-pub-3418717299302732'," . "enable_page_level_ads: true});</script>";
	}

?>

</head>
<body <?php body_class( suxingme_bodyclass() ); ?>>
<div id="header">
	<div class="container">
		<h1 class="logo">
			<a  href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"/>
			<?php if( suxingme('suxingme_logo') ) { ?>
				<img src="<?php echo suxingme('suxingme_logo'); ?>" alt="<?php bloginfo('name'); ?>">
			<?php }else{ ?>
				<img src="<?php bloginfo('template_url');?>/img/logo.png" alt="<?php bloginfo('name'); ?>">
			<?php }?></a>
			
		</h1>
		<div role="navigation"  class="site-nav  primary-menu">
			<div class="menu-fix-box">
				 <?php if ( function_exists( 'wp_nav_menu' ) && has_nav_menu('top-nav') ) { 
					wp_nav_menu(
								array(	
										'theme_location'   => 'top-nav',
										'sort_column'	   => 'menu_order',
										'depth'           => 2,
										'fallback_cb' => 'cmp_nav_fallback',
									
										'container' => false, 
										'menu_id' =>'menu-navigation',
										'menu_class' =>'menu',
									) 
							); 
				?>
				 <?php } else { ?>
					<ul id="menu-navigation" class="menu">
					<li>請到[後台 - >外觀 - >菜單]中設置菜單。</li>
					</ul><!-- topnav end -->
				<?php } ?>
			</div>
		</div>
		<div class="search-box">
            <form action="<?php bloginfo('wpurl'); ?>">
                <input class="form-search" type="text" name="s" placeholder="Search...">
                <button><i class="icon-search"></i></button>
            </form>            
        </div>
		
		<span class="icon-search m-search"></span>
		<div class="mobile_menu">
            <span class="menu-top"></span>
            <span class="menu-bottom"></span>
        </div>
        <ul class="mobile_nav">
             <?php if ( function_exists( 'wp_nav_menu' ) && has_nav_menu('mobile-nav') ) { 
					wp_nav_menu(
								array(	
										'theme_location'   => 'mobile-nav',
										'depth'           => 2,
										'fallback_cb' => 'cmp_nav_fallback',		
										'container' => false, 
										'items_wrap' => '%3$s',
										'menu_class' =>'menu',
									) 
							); 
			?>
			<?php } else { ?>
				<li><a href="#">請到[後台 - >外觀 - >菜單]中設置菜單。</a></li>
			<?php } ?>
        </ul>
	</div>	
</div>
<div id="menu-mobile" style="display: none;">
    <div class="inner">
        <a href="#" class="menu-mobile-close"><i class="fa fa-times"></i></a>

			<?php	wp_nav_menu(
								array(	
										'theme_location'   => 'top-nav',
										'sort_column'	   => 'menu_order',
										'depth'           => 2,
										'fallback_cb' => 'cmp_nav_fallback',
									
										'container' => false, 
										'menu_id' =>'mobile-menu',
										'menu_class' =>'menu',
									) 
							); 
				?>		
    </div>
</div>

