<?php
//自定义代码	

add_action('wp_head', 'suxing_color_css');
function suxing_color_css() { 
    suxing_head_css();
  
}
function suxing_head_css() {

    $styles = '';
    if( suxingme('theme_skin_color') ){
        $skin_option = suxingme('theme_skin_color');
        $skc = $skin_option;
    }    
    if( $skin_option && $skin_option !== '00A7EB' ){
        $styles .= "#ajax-load-posts a, #ajax-load-posts span,.uk-button:hover, .uk-button:focus,.uk-button:before,.relatedPostDesc span,#commentform .submit,.pic-posts-box .title .post-views span,.like-posts-box .like-posts-title .post-views a{background-color:{$skc};}#header .logo a:hover, #header .search-box form button:hover, #header .social-profiles a:hover, #header .primary-menu .logo-fixed a:hover, #header .primary-menu ul > li > a:hover, #header .primary-menu ul > li:hover > a, #header .primary-menu ul > li.current-menu-ancestor > a, #header .primary-menu ul > li.current-menu-item > a, #header .primary-menu ul > li .sub-menu li.current-menu-item > a, #header .primary-menu ul > li .sub-menu li a:hover, #menu-mobile a:hover,.authors_profile .author_name a,a:hover{color:{$skc}}.widget h3, .subtitle, #comment-title,.button.gray-outline:hover,#commentform .submit,.rsMinW .rsBullet.rsNavSelected span{border-color:{$skc}}";
    }
	
	
	if( suxingme('theme_heightlight_color') ){
        $heightlight_color = suxingme('theme_heightlight_color');
        $skc = $heightlight_color;
    }
    
    if( $heightlight_color && $heightlight_color !== '' ){
        $styles .= "#ajax-load-posts a:hover,#commentform .submit:hover,.suxingme_maillist form .rssbutton:hover,.to-top:hover,.authors_profile .author_post_like a:hover{background-color:{$skc}}#commentform .submit:hover,.suxingme_maillist form .rssbutton:hover{border-color:{$skc}}";
    }

    $styles .= suxingme('csscode');

    if( $styles ) echo '<style>'.$styles.'</style>';
}

?>