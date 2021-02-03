<?php

require (TEMPLATEPATH. '/includes/pagemetabox.php');
function myScripts() {  
    $roll = '';
    if( is_home() && suxingme('sideroll_index_s') ){
        $roll = suxingme('sideroll_index');
    }else if( (is_category() || is_tag() || is_search()) && suxingme('sideroll_list_s') ){
        $roll = suxingme('sideroll_list');
    }else if( is_single() && suxingme('sideroll_post_s') ){
        $roll = suxingme('sideroll_post');
    }else if( is_page() && suxingme('sideroll_page_s') ){
        $roll = suxingme('sideroll_page');
    }

    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '' ); 
    wp_register_script( 'suxingme', get_template_directory_uri() . '/js/suxingme.js', array('jquery'), '' ); 
    wp_localize_script( 'suxingme', 'suxingme_url', array("url_ajax"=>admin_url("admin-ajax.php"),"url_theme"=>get_template_directory_uri(),"roll"=>$roll,"headfixed"=>(suxingme("suxingme_head_fixed") ? suxingme("suxingme_head_fixed") :"0") ) ); 
    wp_register_script( 'owl', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '' );  
    wp_register_script('fastclick', get_template_directory_uri() . '/js/fastclick.min.js', array('jquery'), '' ); 
    wp_register_script('comments', get_template_directory_uri() . '/ajax-comment/ajax-comment.js', array('jquery'), '' ); 
    wp_register_script('baidushare', get_template_directory_uri() . '/js/baidushare.js', array('jquery'), '' ); 
    wp_register_script('fancybox', get_template_directory_uri() . '/js/fancybox.js', array('jquery'), '' ); 
    wp_register_script('lazyload', get_template_directory_uri() . '/js/jquery.lazyload.min.js', array('jquery'), '' );

    if ( !is_admin() ) {
        wp_enqueue_script( 'jquery'); 
        wp_enqueue_script( 'bootstrap',false,array(),'',true ); 
        wp_enqueue_script( 'suxingme',false,array(),'',true  );
        wp_enqueue_script( 'fastclick' ,false,array(),'',true );
        if( suxingme('suxingme_lazy') or suxingme('suxingme_timthumb_lazyload') ) {         
            wp_enqueue_script( 'lazyload' ,false,array(),'',true );
        }
    }
    if ( !is_admin() && is_home() && suxingme('suxingme_slide',true)){ 
        wp_enqueue_script( 'owl',false,array(),'',true  );
    }
    if ( !is_admin() && is_singular() ){ 
        wp_enqueue_script( 'comments',false,array(),'',true  );
    }
    if ( !is_admin() && is_single() ){ 
        wp_enqueue_script( 'baidushare',false,array(),'',true  );
    }
    if ( !is_admin() && is_singular() && suxingme('suxingme_fancybox',true) ) { 
        wp_enqueue_script( 'fancybox',false,array(),'',true  );
    }  
}  

add_action( 'wp_enqueue_scripts', 'myScripts' );


add_action( 'wp_enqueue_scripts', 'load_fontawesome_styles' );
function load_fontawesome_styles(){
    global $wp_styles;
    wp_enqueue_style( 'fontello', get_template_directory_uri() . '/includes/font-awesome/css/fontello.css' );
    wp_enqueue_style( 'animation', get_template_directory_uri() . '/includes/font-awesome/css/animation.css' );
    wp_enqueue_style( 'fontello-ie7', get_template_directory_uri() . '/includes/font-awesome/css/fontello-ie7.css' );
    $wp_styles->add_data( 'fontello-ie7', 'conditional', 'lte IE 7' );
}

function remove_script_version( $src ){
  return remove_query_arg( 'ver', $src );
}
add_filter( 'script_loader_src', 'remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'remove_script_version', 15, 1 );

add_action('wp_head', 'suxing_wp_head');
function suxing_wp_head() { 
    if( suxingme('headcode') ) echo "<!--ADD_CODE_HEADER_START-->\n".suxingme('headcode')."\n<!--ADD_CODE_HEADER_END-->\n";
}

add_action('wp_footer', 'suxing_wp_footer');
function suxing_wp_footer() { 
    if( suxingme('footcode') ) echo "<!--ADD_CODE_FOOTER_START-->\n".suxingme('footcode')."\n<!--ADD_CODE_FOOTER_END-->\n";
    if ( is_singular() && suxingme('suxingme_fancybox',true) ) {
    echo'<script type="text/javascript">jQuery(document).ready(function($) {$(".fancybox").fancybox()});</script>';
    }
}

// 屏蔽WordPress默认小工具
add_action( 'widgets_init', 'my_unregister_widgets' );   
function my_unregister_widgets() {   
 
    unregister_widget( 'WP_Widget_Archives' );   
    unregister_widget( 'WP_Widget_Calendar' );   
    unregister_widget( 'WP_Widget_Categories' );   
    unregister_widget( 'WP_Widget_Links' );   
    unregister_widget( 'WP_Widget_Meta' );   
    unregister_widget( 'WP_Widget_Pages' );   
    unregister_widget( 'WP_Widget_Recent_Comments' );   
    unregister_widget( 'WP_Widget_Recent_Posts' );   
    unregister_widget( 'WP_Widget_RSS' );   
    unregister_widget( 'WP_Widget_Search' );   
    unregister_widget( 'WP_Widget_Tag_Cloud' );   
    unregister_widget( 'WP_Nav_Menu_Widget' );   
	
}

//自动修改Wordpress文章、评论、缩略图片的IMG属性
function add_image_placeholders( $content ) {
    // Don't lazyload for feeds, previews, mobile
    if( is_feed() || is_preview() || ( function_exists( 'is_mobile' ) && is_mobile() ) )
        return $content;
    // Don't lazy-load if the content has already been run through previously
    if ( false !== strpos( $content, 'data-original' ) )
        return $content;
    // In case you want to change the placeholder image
    $placeholder_image = apply_filters( 'lazyload_images_placeholder_image', get_template_directory_uri() . '/img/lazy.png' );
    // This is a pretty simple regex, but it works
    $content = preg_replace( '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', sprintf( '<img${1}src="%s" data-original="${2}"${3}><noscript><img${1}src="${2}"${3}></noscript>', $placeholder_image ), $content );
    return $content;
}

/** 修改网站标题连接符 **/
function page_sign(){
    if(suxingme('page_sign')){
        echo ' ';
        echo suxingme('page_sign');
        echo ' ';
    }else{
        echo ' - ';
    }
}

/* 评论作者链接新窗口打开 */
function specs_comment_author_link() {
    $url    = get_comment_author_url();
    $author = get_comment_author();
    if ( empty( $url ) || 'http://' == $url )
        return $author;
    else
        return "<a target='_blank' href='$url' rel='external nofollow' class='url'>$author</a>";
}
add_filter('get_comment_author_link', 'specs_comment_author_link');


/**
 * 禁用：移除 WordPress 4.2 中前台自动加载的 emoji 脚本
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
 
/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}


//自定义登录页面风格（图片轮换背景）
function uazoh_custom_login_page_imgbackground() {
echo '  <script type="text/javascript" src="/wp-includes/js/jquery/jquery.js?ver=1.11.1"></script>
            <script src="'.get_bloginfo('template_directory').'/js/jquery.backstretch.min.js"></script>
<script>
jQuery(function(){
var imgsrc = "'.get_bloginfo('template_directory').'/img/login_page_bg";
var listArr = [imgsrc+"/1.jpg",imgsrc+"/2.jpg",imgsrc+"/3.jpg",imgsrc+"/4.jpg"];
jQuery(\'.login\').backstretch(listArr, {fade: 1000,duration: 5000});});</script>';
}
add_action('login_head', 'uazoh_custom_login_page_imgbackground');

//自定义登录页面风格
function uazoh_custom_login_page() {
echo'<style type="text/css">
body { background: none; }
#login {width: 320px;margin: auto;background: #FFF;margin-top: 8%;padding: 20px;border-radius: 3px;box-shadow: 0px 1px 1px 0px rgba(0,0,0,0.2);}
.login form {margin-top: 0;margin-left: 0;padding:6px 24px 10px;-webkit-box-shadow:none;box-shadow:none;}
.login form .forgetmenot{float:none}
.login .button-primary{float:none;background-color: #494949;font-weight: bold;color: #fff;width: 100%;height: 40px;border-width: 0;border-color:none}
#login form p.submit{padding: 20px 0 0;}
.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover{background:#1F1F1F}
.wp-core-ui .button.button-large{height:40px;line-height:38px;font-size:16px;}
input{outline:none!important}
</style>';
}
add_action('login_head', 'uazoh_custom_login_page');

//修复 WordPress 找回密码提示“抱歉，该key似乎无效”

function reset_password_message( $message, $key ) {
 if ( strpos($_POST['user_login'], '@') ) {
 $user_data = get_user_by('email', trim($_POST['user_login']));
 } else {
 $login = trim($_POST['user_login']);
 $user_data = get_user_by('login', $login);
 }
 $user_login = $user_data->user_login;
 $msg = __('有人要求重設如下帳號的密碼：'). "\r\n\r\n";
 $msg .= network_site_url() . "\r\n\r\n";
 $msg .= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
 $msg .= __('若這不是您本人要求的，請忽略本郵件，一切如常。') . "\r\n\r\n";
 $msg .= __('要重置您的密碼，請打開下面的鏈接：'). "\r\n\r\n";
 $msg .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ;
 return $msg;
}
add_filter('retrieve_password_message', 'reset_password_message', null, 2);

/**
 * Display tags width hot tag.
 *WordPress 标签云 – 带热门标签
 * @since Pure 1.0
 */
function get_hot_tag_list( $num = null , $hot = null , $offset = null){
    $num = $num ? $num : 14;
    $hot = $hot ? $hot : 5;
    $offset = $offset ? $offset : 0;
    
    $output = '<div class="tag-items">';
    $tags = get_tags(array("number" => $num,
	    'orderby' => 'count',
        "order" => "DESC",
        "offset"=>$offset,
    ));
    foreach($tags as $tag){
        $count = intval( $tag->count );
        $name = apply_filters( 'the_title', $tag->name );
        $class = ( $count > $hot ) ? 'tag-item hot' : 'tag-item';
        $output .= '<a href="'. esc_attr( get_tag_link( $tag->term_id ) ) .'" class="'. $class .'" title="瀏覽和' . $name . '有關的文章"><span>' . $name . '</span></a>';

    }
    $output .= '</div>';
    return $output;

}

//留言墙
function readers_wall( $outer='1', $timer='100', $limit='200' ){
    global $wpdb;
    $items = $wpdb->get_results("select count(comment_author) as cnt, comment_author, comment_author_url, comment_author_email from (select * from $wpdb->comments left outer join $wpdb->posts on ($wpdb->posts.id=$wpdb->comments.comment_post_id) where comment_date > date_sub( now(), interval $timer month ) and user_id='0' and comment_author != '".$outer."' and post_password='' and comment_approved='1' and comment_type='') as tempcmt group by comment_author order by cnt desc limit $limit");
    $htmls = '';
    foreach ($items as $item) {
        $c_url = $item->comment_author_url;
        if (!$c_url) $c_url = 'javascript:;';
        // print_r($item);
        $htmls .= '<a target="_blank" href="'. $c_url . '" title="'.$item->comment_author.' 評論'. $item->cnt . '次">'.suxing_avatar('', $item->comment_author_email).'</a>';
    }
    echo $htmls;
}

//友情链接
function get_the_link_items($id = null){
    $bookmarks = get_bookmarks('orderby=date&category=' .$id );
    $output = '';
    if ( !empty($bookmarks) ) {
        $output .= '<ul class="link-items fontSmooth">';
        foreach ($bookmarks as $bookmark) 
        {
            $output .=  '<li class="link-item"><a class="link-item-inner effect-apollo" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" rel="' . $bookmark->link_rel . '" >';
            
            if(($bookmark->link_notes)){
                $output .= get_avatar($bookmark->link_notes,64);
            }else if($bookmark->link_image){
                
                $output .= '<img alt="' . $bookmark->link_description . '" src="'. $bookmark->link_image .'" title="' . $bookmark->link_description . '">';
                
            }
            else{
                
                $output .= '<img alt="' . $bookmark->link_description . '" src="'.get_bloginfo('template_url').'/img/avatar.png" title="' . $bookmark->link_description . '">';
                
            }
            
            $output .= '<span class="sitename">'. $bookmark->link_name .'</span></a></li>';
        }
        $output .= '</ul><div class="clearfix"></div>';
    }
    return $output;
}

function get_link_items(){
    $linkcats = get_terms( 'link_category' );
    if ( !empty($linkcats) ) {
        foreach( $linkcats as $linkcat){ 
                if( $linkcat->description ) $linkdes .= '- <span class="link-description">' . $linkcat->description . '</span>';           
            $result .=  '<div class="link-title"><span>'.$linkcat->name.'</span>'.$linkdes.'</div>';
           
            $result .=  get_the_link_items($linkcat->term_id);
        }
    } else {
        $result = get_the_link_items();
    }
    return $result;
}

function shortcode_link(){
    return get_link_items();
}
add_shortcode('bigfalink', 'shortcode_link');

function links_banner_pic(){
    if(suxingme('links_banner_pic')){
        $links_banner_pic = suxingme('links_banner_pic');
    }else{
        $links_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $links_banner_pic;   
}

function pagenav_banner_pic(){
    if(suxingme('pagenav_banner_pic')){
        $pagenav_banner_pic = suxingme('pagenav_banner_pic');
    }else{
        $pagenav_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $pagenav_banner_pic;   
}


function tags_banner_pic(){
    if(suxingme('tags_banner_pic')){
        $tags_banner_pic = suxingme('tags_banner_pic');
    }else{

        $tags_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $tags_banner_pic;   
}

function readers_banner_pic(){
    if(suxingme('readers_banner_pic')){
        $readers_banner_pic = suxingme('readers_banner_pic');
    }else{

        $readers_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $readers_banner_pic;   
}

function archives_banner_pic(){
    if(suxingme('archives_banner_pic')){
        $archives_banner_pic = suxingme('archives_banner_pic');
    }else{

        $archives_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $archives_banner_pic;   
}

function like_banner_pic(){
    if(suxingme('like_banner_pic')){
        $like_banner_pic = suxingme('like_banner_pic');
    }else{

        $like_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $like_banner_pic;   
}

function single_pc_ad_pic(){
	$ad_content_pc = suxingme('suxing_ad_content_pc_url');
    if( suxingme('suxing_ad_content_pc',true)){ 
    	$single_ad_pc='<div class="posts-cjtz content-cjtz clearfix">'.$ad_content_pc.'</div>';
    }else{ 	
    	$single_ad_pc='';	
    }
    return $single_ad_pc; 
}
function single_mini_ad_pic(){
    $ad_content_pc = suxingme('suxing_ad_content_mini_url');
    if( suxingme('suxing_ad_content_mini',true)){ 
        $single_ad_pc='<div class="posts-cjtz content-cjtz-mini clearfix">'.$ad_content_pc.'</div>';
    }else{  
        $single_ad_pc='';   
    }
    return $single_ad_pc; 
}
				
//自动给修改网站登陆页面logo
function customize_login_logo(){      
    if( suxingme('suxingme_login_logo') ) {
        echo '<style type="text/css">
       .login h1 a { background-image:url('.suxingme('suxingme_login_logo') .');background-size: 120px;width: 120px;height: 120px;margin: 20px auto 15px; }
        </style>';      
    }else{
    echo '<style type="text/css">
        .login h1 a { background-image:url('.get_template_directory_uri() .'/img/logo.png); width: 280px; max-height: 100px;margin: 20px auto 15px; background-size: contain;background-repeat: no-repeat;background-position: center center;}
        </style>';   
    }    
}      
add_action('login_head', 'customize_login_logo');   
add_filter('login_headerurl', create_function(false,"return get_bloginfo('url');"));

add_action('optionsframework_after','show_category', 100);
function show_category() {
    global $wpdb;
    $request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
    $request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
    $request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
    $request .= " ORDER BY term_id asc";
    $categorys = $wpdb->get_results($request);
    echo '<div class="uk-panel uk-panel-box" style="margin-bottom: 20px;"><h3 style="margin-top: 0; margin-bottom: 15px; font-size: 18px; line-height: 24px; font-weight: 400; text-transform: none; color: #666;">可能会用到的分类ID</h3>';
    echo "<ul>";
    foreach ($categorys as $category) { 
        echo  '<li style="margin-right: 10px;float:left;">'.$category->name."（<code>".$category->term_id.'</code>）</li>';
    }
    echo "</ul></div>";
}

function suxingme_get_thumbnail() {  
    global $post;
    $html = '';

    $content = $post->post_content;  
    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);  
    $images = $strResult[1];

    $counter = count($strResult[1]);
	//samsoo修改开始
	if($counter > 0){
		$tempCounter = $counter > 3 ? 3 : $counter;
		for($i=0 ; $i<$tempCounter ; $i++){
			$html .= '<li><div class="image-item"><a  href="'.get_permalink(get_the_ID()).'"> <div class="overlay"></div><img src="' . $strResult[1][$i] . '"  class="thumbnail" width="240" height="160" /></a></div></li>';
		}
		return $html;
	}else{			
		$item = '';		
		if( suxingme('suxingme_timthumb_lazyload')) { 
			$item = '<img class="lazy thumbnail" data-original="<' . get_template_directory_uri() . '/timthumb.php?src=' . post_thumbnail_src() . '&h=160&w=240&zc=1" src="<' . constant("THUMB_SMALL_DEFAULT") . '" alt="' . the_title() . '" />	';
		}else if (suxingme('suxingme_timthumb')) {
			$item = '<img class="thumbnail" src="' . get_template_directory_uri() . '/timthumb.php?src=' . post_thumbnail_src() . '&h=160&w=240&zc=1" alt="' . the_title() . '" />';
		}else{
			$item = '<img src="' . post_thumbnail_src() . '" alt="' . the_title() . '" class="thumbnail" />';
		}
		
		return '<li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>' . 
                            $item .
                        '</a>
                    </div>
                </li>';
	}
	
	//samsoo修改结束





    if( !$counter ){
        return '<li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
                </li>
                <li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
                </li>
                <li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
                </li>';
    }
    $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
    $ts_thum = $full_image_url[0];
    if($ts_thum){
        $num = 2;
        $html .= '<li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.$ts_thum.'&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
                </li>';
    }
    else{
        $num = 3;
    }

    $i = 0;
    foreach($images as $key=>$src){
        $i++;
        $src2 = wp_get_attachment_image_src(suxingme_get_attachment_id_from_src($src), 'full');
        $src2 = $src2[0];
        if( !$src2 && true ){
            $src = $src;
        }else{
            $src = $src2;
        }
        $item = '<img src="'.get_template_directory_uri().'/timthumb.php?src='.$src.'&h=160&w=250&zc=1" alt="'.get_the_title().'">';
        $html .= '<li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            '.$item.'
                        </a>
                    </div>
                </li>';
        if( $counter >= $num && $i >= $num )
        {
            break; 
        }
    }

    if(count($images) < 3 && $ts_thum ){
        $j = 3 - count($images) - 1;
        for ($k=0; $k < $j ; $k++) { 
        $html .= '<li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.get_template_directory_uri().'/img/default_thumb.png&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
             </li>';
        }
    }
    if(count($images) < 3 && !$ts_thum ){
        $j = 3 - count($images);
         for ($k=0; $k < $j ; $k++) { 
        $html .= '<li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.get_template_directory_uri().'/img/default_thumb.png&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
                </li>';
        }
    }

    

    return $html;
}
function suxingme_get_attachment_id_from_src ($link) {
    global $wpdb;
    $link = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $link);
    return $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE guid='$link'");
}

//关键字自动替换
function replace_text_wps($text){  
	//'关键词'=>'替换的关键词'例如：
    $replace = array(
		"凱爾特人"=>"塞爾提克",
		"尼克斯"=>"尼克",
		"北京時間"=>"時間",
		"朝鮮"=>"北韓",
		"猛龍"=>"暴龍",
		"中國台灣"=>"台灣",
		"裝逼"=>"耍帥",
		"層經"=>"曾經",
		"蓋帽"=>"阻攻",
		"胡子"=>"鬍子",
		"搶斷"=>"抄截",
		"季前賽"=>"熱身賽",
		"頭發"=>"頭髮",
		"發型"=>"髮型",
		"扣籃"=>"灌籃",
		"常規賽"=>"例行賽",
		"裡約"=>"里約",
		"工資"=>"薪水",
		"總決賽"=>"總冠軍賽",
		"碰瓷"=>"造犯規",
		"沖突"=>"衝突",
		"三雙"=>"大三元",
		"碰瓷"=>"造犯規",
		"全明星比賽"=>"明星賽",
		"全明星賽"=>"明星賽",
		"休斯頓"=>"休士頓",
		"推特"=>"Twitter",
		"季后賽"=>"季後賽",
		"網絡"=>"網路",
		"心髒"=>"",
		"德魯大叔"=>"Uncle Drew",
		"地麵"=>"地面",
		"麵"=>"面",
		"裡"=>"里",
		"干拔"=>"拔蔥",
		"面條"=>"麵條",
		"吃面"=>"吃麵",
		"抽簽"=>"抽籤",
		"籤約"=>"簽約",
		"視頻"=>"影片",
		"水花兄弟"=>"浪花兄弟",
		"水花"=>"浪花",
		"孟菲斯"=>"曼斐斯",
		"新奧爾良"=>"紐奧良",
		"步行者"=>"遛馬",
		"密爾沃基"=>"密爾瓦基",
		"掘金"=>"金塊",
		"森林狼"=>"灰狼",
		"俄克拉荷馬"=>"奧克拉荷馬",
		"開拓者"=>"拓荒者",
		"奇才"=>"巫師",
		"快船"=>"快艇",
		"菲尼克斯"=>"鳳凰城",
		"薩克拉門托"=>"沙加緬度",
		"尼克斯"=>"尼克",
		"北京時間"=>"時間",
		"朝鮮"=>"北韓",
		"猛龍"=>"暴龍",
		"舔籃"=>"挑籃",
		"中國台灣"=>"台灣",
		"裝逼"=>"耍帥",
		"層經"=>"曾經",
		"蓋帽"=>"阻攻",
		"胡子"=>"鬍子",
		"搶斷"=>"抄截",
		"季前賽"=>"熱身賽",
		"頭發"=>"頭髮",
		"發型"=>"髮型",
		"扣籃"=>"灌籃",
		"常規賽"=>"例行賽",
		"裡約"=>"里約",
		"工資"=>"薪水",
		"總決賽"=>"總冠軍賽",
		"沖突"=>"衝突",
		"三雙"=>"大三元",
		"碰瓷"=>"造犯規",
		"全明星比賽"=>"明星賽",
		"全明星賽"=>"明星賽",
		"休斯頓"=>"休士頓",
		"推特"=>"Twitter",
		"網絡"=>"網路",
		"心髒"=>"心臟",
		"地麵"=>"地面",
		"麵"=>"面",
		"裡"=>"里",
		"面條"=>"麵條",
		"吃面"=>"吃麵",
		"東部"=>"東區",
		"西部"=>"西區",
		"干拔"=>"拔蔥",
		"抽簽"=>"抽籤",
		"籤約"=>"簽約",
		"視頻"=>"影片",
		"水花兄弟"=>"浪花兄弟",
		"孟菲斯"=>"曼斐斯",
		"新奧爾良"=>"紐奧良",
		"步行者"=>"遛馬",
		"密爾沃基"=>"密爾瓦基",
		"妖刀"=>"鬼切",
		"掘金"=>"金塊",
		"森林狼"=>"灰狼",
		"俄克拉荷馬"=>"奧克拉荷馬",
		"開拓者"=>"拓荒者",
		"奇才"=>"巫師",
		"快船"=>"快艇",
		"菲尼克斯"=>"鳳凰城",
		"薩克拉門托"=>"沙加緬度",

	);
    $text = str_replace(array_keys($replace), $replace, $text);  
    return $text;  
}

//替换cdn
function replace_text_cdn($text){  
	//'关键词'=>'替换的关键词'例如：
    $replace = array(
		"http://www.vuuuuu.com//wp-content/uploads/"=>"http://www.vuuuuu.com//wp-content/uploads/"
	);
    $text = str_replace(array_keys($replace), $replace, $text);  
    return $text;  
}

function login_protection(){
	if($_GET['mag_key'] != '48b069e7'){
		header('Location: http://www.bballmen.com/404.html');
	}
}

function my_the_views($count){
    $string = str_replace(',','',$count);
    return number_format_i18n( intval($string) + 1000);
}

add_filter('the_views', 'my_the_views');
add_filter('the_content', 'replace_text_wps');
add_filter('the_excerpt', 'replace_text_wps');
add_filter('the_title', 'replace_text_wps');
add_filter('the_content', 'replace_text_cdn');
add_filter('the_excerpt', 'replace_text_cdn');
add_filter('get_site_icon_url', 'replace_text_cdn');
add_action('wp_head', 'replace_text_cdn');
add_action('login_enqueue_scripts', 'login_protection');

?>
