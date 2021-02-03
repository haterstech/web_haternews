<?php 

require (TEMPLATEPATH. '/includes/modules/categories-images.php');
require (TEMPLATEPATH. '/includes/metabox.php');
require TEMPLATEPATH . '/ajax-comment/do.php';
require ( TEMPLATEPATH. '/includes/modules/comments.php' );
require ( TEMPLATEPATH. '/includes/modules/canonical.php' );
require ( TEMPLATEPATH. '/includes/wp-alu/functions.php' );
if (suxingme( 'suxingme_suxingsaid', true )) include_once( TEMPLATEPATH. '/includes/modules/suxingsaid.php' ); 
if (suxingme( 'suxingme_post_like', true )) include_once(TEMPLATEPATH .'/includes/modules/like.php');
if (suxingme( 'friendly', 'no entry' )) include_once(TEMPLATEPATH .'/includes/modules/friendlyimages.php'); 
if (suxingme( 'suxingme_keywordlink', 'no entry' )) include_once(TEMPLATEPATH .'/includes/modules/keywordlink.php');
if (suxingme( 'suxingme_fancybox', 'no entry' )) include_once(TEMPLATEPATH .'/includes/modules/fancybox.php');  
if (suxingme( 'suxingme_autonofollow', 'no entry' )) include_once(TEMPLATEPATH .'/includes/modules/autonofollow.php'); 
if (suxingme( 'suxingme_wphead', 'no entry' )) include_once(TEMPLATEPATH .'/includes/modules/wphead.php'); 





//禁用所有文章类型的修订版本
if (suxingme( 'revisions_to_keep', true)){
    add_filter( 'wp_revisions_to_keep', 'specs_wp_revisions_to_keep', 10, 2 );
    function specs_wp_revisions_to_keep( $num, $post ) {
       if ( 'post_type' == $post->post_type )
          $num = 0;
       return $num;
    }
}

//body添加额外的class
function suxingme_bodyclass(){
    $class = '';
    if( (is_page() || is_single()) && suxingme('suxingme_text_indent',true) ){
        $class .= ' post-p-indent';
    }
    return trim(trim($class).' ');
}

//延迟加载的默认图片设置
if(suxingme('default_thumbnail')){
$smallimg = suxingme('default_thumbnail');
$bigimg = suxingme('default_thumbnail_700');
define( 'THUMB_SMALL_DEFAULT'  , $smallimg );
}else{
define( 'THUMB_SMALL_DEFAULT'  , get_template_directory_uri().'/img/thumbnail-small.png' ); 
}

if(suxingme('default_thumbnail_700')){
define( 'THUMB_BIG_DEFAULT'  , $bigimg );
}else{
define( 'THUMB_BIG_DEFAULT'  , get_template_directory_uri() .'/img/thumbnail-big.png' );    
}


//添加特色缩略图支持
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');
//输出缩略图地址
function post_thumbnail_src(){
    global $post;
    if( $values = get_post_custom_values("thumb") ) {   //输出自定义域图片地址
        $values = get_post_custom_values("thumb");
        $post_thumbnail_src = $values [0];
    } elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        $post_thumbnail_src = $thumbnail_src [0];
    } else {
        $post_thumbnail_src = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        if(!empty($matches[1][0])){
            $post_thumbnail_src = $matches[1][0];   //获取该图片 src
        }elseif( suxingme('suxingme_post_thumbnail') ){
            $post_thumbnail_src = suxingme('suxingme_post_thumbnail');
        }else{  
            //如果日志中没有图片，则显示随机图片
            //$random = mt_rand(1, 5);
            //$post_thumbnail_src = get_template_directory_uri().'/img/random/'.$random.'.jpg';
            //如果日志中没有图片，则显示默认图片
            $post_thumbnail_src = get_template_directory_uri().'/img/default_thumb.png';
        }
    }
	
	//'关键词'=>'替换的关键词'例如：
    $post_thumbnail_src = replace_text_cdn($post_thumbnail_src);  
	
    return $post_thumbnail_src;
} 

function get_post_thumbnail_url($post_id){
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
	$post=get_post($post_id);
	if( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'full');
        $post_thumbnail_src = $thumbnail_src [0];
    } else {
        $post_thumbnail_src = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        if(!empty($matches[1][0])){
            $post_thumbnail_src = $matches[1][0];   //获取该图片 src
        }else{  
            $post_thumbnail_src = '';
        }
    }
    $post_thumbnail_src = replace_text_cdn($post_thumbnail_src);  
	
    return $post_thumbnail_src;
}

//加载ajax分页
include_once( TEMPLATEPATH. '/includes/modules/ajaxpost.php' );

//给WordPress添加文章形式
add_theme_support( 'post-formats', array( 'gallery','aside','image','link' ) );

function rename_post_formats( $safe_text ) {
if ( $safe_text == '相冊' )
return '左圖模板';
if ( $safe_text == '圖像' )
return '多圖模板';
if ( $safe_text == '日誌' )
return '無圖模版';
if ( $safe_text == '鏈接' )
return '推廣模板';
return $safe_text;
}
add_filter( 'esc_html', 'rename_post_formats' );

//默认头像
define( 'AVATAR_DEFAULT' , THEME_URI.'/img/avatar.png' );

//使用Gravatar头像服务的（HTTPS）加密线路
function suxingme_get_avatar($avatar) {
    $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/', '<img src="https://secure.gravatar.com/avatar/$1" class="avatar avatar-$2" height="$2" width="$2">', $avatar);
    return $avatar;
}

//官方Gravatar头像调用ssl头像链接
function suxingme_replace_avatar($avatar) {
  $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar);
    return $avatar;
}

if( suxingme('suxingme_get_avatar')=='one' ){
    add_filter('get_avatar', 'suxingme_get_avatar');
}elseif( suxingme('suxingme_get_avatar')=='two' ){
    add_filter( 'get_avatar', 'suxingme_replace_avatar', 10, 3 );
}else{
    add_filter('get_avatar', 'suxingme_get_avatar');
}

function suxing_user_avatar($user_id=''){
    if( !$user_id ) return false;
    $avatar = get_user_meta( $user_id, 'avatar', true );
    if( $avatar ){
        return $avatar;
    }else{
        return false;
    }
}

//avatar
function suxing_avatar( $user_id='', $user_email='', $src=false, $size= 50 ){
    $user_avtar = suxing_user_avatar($user_id);
    if( $user_avtar ){
        $attr = 'data-original';
        if( $src ) $attr = 'src';
        return '<img class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" '.$attr.'="'.$user_avtar.'">';
    }else{
        $avatar = get_avatar( $user_email, $size ,AVATAR_DEFAULT );
        if( $src ){
            return $avatar;
        }else{
            return str_replace(' src=', ' data-original=', $avatar);
        }
    }
}

//摘要截断
function deel_strimwidth($str ,$start , $width ,$trimmarker ){
    $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
    return $output.$trimmarker;
}

//访问计数
function record_visitors(){
    if (is_singular()) {global $post;
     $post_ID = $post->ID;
      if($post_ID) 
      {
          $post_views = (int)get_post_meta($post_ID, 'views', true);
          if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
          {
            add_post_meta($post_ID, 'views', 1, true);
          }
      }
    }
}
//add_action('wp_head', 'record_visitors');  

function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
    global $post;
    $post_ID = $post->ID;
    $views = (int)get_post_meta($post_ID, 'views', true);
    if ($echo) echo $before, number_format($views), $after;
    else return $views;
};

//百度分享
function suxing_get_share(){
    $shares = array(
        array('tsina','icon-weibo'),
        array('weixin','icon-wechat'),
        array('tqq','icon-tencent-weibo'),
        array('tqf','icon-qq'),
       array('mail','icon-mail'),
       array('copy','icon-link'),
	   //array('fbook','icon-fbook'),
    );
    $html = '';
    for ($i=0; $i < count($shares); $i++) { 
        $html .= '<a class="share-links bds_'.$shares[$i][0].' '.$shares[$i][1].'" data-cmd="'.$shares[$i][0].'"></a>';
        
    }
	 //return $html.'<a class="share-links bds_more" data-cmd="more"><i class="icon-forward"></i></a> (<a class="bds_count" data-cmd="count"></a>)';
    return $html;
}

//根据上传时间重命名文件
if (suxingme( 'suxingme_upload_filter', true)){
add_filter('wp_handle_upload_prefilter', 'custom_upload_filter' );

function custom_upload_filter( $file ){
    $info = pathinfo($file['name']);
    $ext = $info['extension'];
    $filedate = date('YmdHis').rand(10,99);//为了避免时间重复，再加一段2位的随机数
    $file['name'] = $filedate.'.'.$ext;
    return $file;
}}
    
/*编辑器添加分页按钮*/
add_filter('mce_buttons','wysiwyg_editor');
function wysiwyg_editor($mce_buttons) {
    $pos = array_search('wp_more',$mce_buttons,true);
    if ($pos !== false) {
        $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
        $tmp_buttons[] = 'wp_page';
        $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
    }
    return $mce_buttons;
}

/*激活友情链接后台*/
add_filter( 'pre_option_link_manager_enabled', '__return_true' );   

//评论时间
function timeago( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - 28800 - $ptime;
    if($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  '年前 ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  '個月前 ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  '週前 ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小時前',
        60                      =>  '分鐘前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    }
}


//控制摘要长度
function excerpt_read_more_link($output) {
global $post;
$output = mb_substr($output,0, 60); // 这里修改想要截取的长度
return $output . '';
}
add_filter('the_excerpt', 'excerpt_read_more_link');

/*文章状态*/
function suxing_post_state_date() { 
    global $post;
    $t1 = $post->post_date;
    $t2 = date("Y-m-d H:i:s");
    $new = '<span class="state-new">最新</span>';
    $diff = (strtotime($t2)-strtotime($t1))/3600;
    if($diff<24){
    	return $new;
    }else{
    	 return false;
    }
}

//使用昵称替换用户名，通过用户ID进行查询
add_filter( 'request', 'suxingme_request' );
function suxingme_request( $query_vars )
{
    if ( array_key_exists( 'author_name', $query_vars ) ) {
        global $wpdb;
        $author_id = $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='nickname' AND meta_value = %s", $query_vars['author_name'] ) );
        if ( $author_id ) {
            $query_vars['author'] = $author_id;
            unset( $query_vars['author_name'] );    
        }
    }
    return $query_vars;
}

/**  
*参数$title 字符串 页面标题  
*参数$slug  字符串 页面别名  
*参数$page_template 字符串  模板名  
*无返回值  
**/  
function suxingme_add_page($title,$slug,$page_template=''){   
    $allPages = get_pages();//获取所有页面   
    $exists = false;   
    foreach( $allPages as $page ){   
        //通过页面别名来判断页面是否已经存在   
        if( strtolower( $page->post_name ) == strtolower( $slug ) ){   
            $exists = true;   
        }   
    }   
    if( $exists == false ) {   
        $new_page_id = wp_insert_post(   
            array(   
                'post_title' => $title,   
                'post_type'     => 'page',   
                'post_name'  => $slug,   
                'comment_status' => 'closed',   
                'ping_status' => 'closed',   
                'post_content' => '',   
                'post_status' => 'publish',   
                'post_author' => 1,   
                'menu_order' => 0   
            )   
        );   
        //如果插入成功 且设置了模板   
        if($new_page_id && $page_template!=''){   
            //保存页面模板信息   
            update_post_meta($new_page_id, '_wp_page_template',  $page_template);   
        }   
    }   
}  

function suxingme_add_pages() {   
    global $pagenow;   
    //判断是否为激活主题页面   
    if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ){   
        suxingme_add_page('熱門標籤','tags-page','pages/page-tags.php');  
        suxingme_add_page('友情鏈接','links-page','pages/page-links.php');  
        suxingme_add_page('年度歸檔','archives-page','pages/page-archives.php');  
        suxingme_add_page('人氣文章排行榜','like-page','pages/page-like.php');  
    }   
}   
add_action( 'load-themes.php', 'suxingme_add_pages' );  

//文章内分页
function suxing_link_pages($args = '') {      
    $defaults = array(      
        'before' => '<p>' . __('Pages:'), 
        'after' => '</p>',      
        'link_before' => '', 
        'link_after' => '',      
        'next_or_number' => 'number', 
        'nextpagelink' => __('下一页'),      
        'previouspagelink' => __('上一页'), 
        'pagelink' => '%',      
        'echo' => 1      
    );      
    $r = wp_parse_args( $args, $defaults );      
    $r = apply_filters( 'wp_link_pages_args', $r );      
    extract( $r, EXTR_SKIP );      
    global $page, $numpages, $multipage, $more, $pagenow;      
    $output = '';      
    if ( $multipage ) {      
        if ( 'number' == $next_or_number ) {      
            $output .= $before;      
            for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {      
                $j = str_replace('%',$i,$pagelink);      
                $output .= ' ';      
                if ( ($i != $page) || ((!$more) && ($page==1)) ) {      
                    $output .= _wp_link_page($i);      
                    $output .= $link_before . $j . $link_after;//将原本在下面的那句移进来了      
                }else{  //加了个else语句，用来判断当前页，如果是的话输出下面的      
                    $output .= '<span class="page-numbers current">' . $j . '</span>';      
                }      
                //原本这里有一句，移到上面去了      
                if ( ($i != $page) || ((!$more) && ($page==1)) )      
                    $output .= '</a>';      
            }      
            $output .= $after;      
        } else {      
            if ( $more ) {      
                $output .= $before;      
                $i = $page - 1;      
                if ( $i && $more && $previouspagelink ) { //if里面的条件加了$previouspagelink也就是只有参数有“上一页”这几个字才显示      
                    $output .= _wp_link_page($i);      
                    $output .= $link_before. $previouspagelink . $link_after . '</a>';      
                }      
                $i = $page + 1;      
                if ( $i <= $numpages && $more && $nextpagelink ) {      
                //if里面的条件加了$nextpagelink也就是只有参数有“下一页”这几个字才显示      
                    $output .= _wp_link_page($i);      
                    $output .= $link_before. $nextpagelink . $link_after . '</a>';      
                }      
                $output .= $after;      
            }      
        }      
    }      
    if ( $echo )      
        echo $output;      
    return $output;      
}    

//搜索结果排除所有页面
function search_filter_page($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','search_filter_page');

/*识别当前作者身份*/
function suxing_level() { 
$user_id=get_post(get_the_ID())->post_author;   
if(user_can($user_id,'install_plugins')){echo'站長';}   
elseif(user_can($user_id,'edit_others_posts')){echo'管理編輯';}elseif(user_can($user_id,'publish_posts')){echo'作者';}elseif(user_can($user_id,'delete_posts')){echo'貢獻者';}elseif(user_can($user_id,'read')){echo'訂閱者';}
}

//统计作者的评论数量 替换author_comment_count
function get_author_comment_count($author_id) { 
    global $wpdb;
    $comment_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->comments  WHERE comment_approved='1' AND user_id = %d AND comment_type not in ('trackback','pingback')" ,$author_id) );
    return $comment_count;
}

add_filter( 'avatar_defaults', 'newgravatar' );  
function newgravatar ($avatar_defaults) {  
    $myavatar = suxingme("new_avatar_pic");  
    $avatar_defaults[$myavatar] = get_bloginfo('name')." 默認頭像";  
    return $avatar_defaults;  
}

//自定义样式
function suxingme_head_css() {

    $styles = '';

    if( suxingme('suxingme_site_gray') ){
        $styles .= "html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}";
    }

    if( suxingme('theme_skin_custom') ){
        $skin_option = suxingme('theme_skin_custom');
        $skc = $skin_option;
    }else{
        $skin_option = suxingme('theme_skin');
        $skc = '#'.$skin_option;
    }
    
    if( $skin_option && $skin_option !== '19B5FE' && suxingme("suxingme_site_gray_turn") ){ 
        $styles .= "#top-slide .owl-item .slider-content .post-categories a,#top-slide .owl-item .slider-content .slider-title h2:after,#top-slide .owl-item .slider-content .read-more a:hover,.posts-default-title h2:after,#ajax-load-posts a, #ajax-load-posts span, #ajax-load-posts button,.post-title .title:after,#commentform .form-submit input[type='submit'],.tag-clouds .tagname:hover{background-color:$skc;}a:hover,.authors_profile .author_name a{color:$skc;}#ajax-load-posts a:hover,#ajax-load-posts button:hover{background-color:#273746}#header .search-box form button:hover, #header .primary-menu ul > li > a:hover, #header .primary-menu ul > li:hover > a, #header .primary-menu ul > li.current-menu-ancestor > a, #header .primary-menu ul > li.current-menu-item > a, #header .primary-menu ul > li .sub-menu li.current-menu-item > a, #header .primary-menu ul > li .sub-menu li a:hover, #menu-mobile a:hover{color:$skc;}@media screen and (max-width: 767px){#header .search-box form button{background-color:$skc;}}.widget h3{color:$skc;border-color:$skc}.comment-form-smilies .smilies-box a:hover{border-color:$skc}";

    }

    $styles .= suxingme('csscode');

    if( $styles ) echo '<style>'.$styles.'</style>';
}
add_action('wp_head','suxingme_head_css');

function get_links_category(){
	$link_cats=get_terms( 'link_category' );;
	$rehtml .= '<div class="show-links-id"><p>相關的鏈接分類ID：</p><ul>';
	foreach ($link_cats as $key => $value) {
		$rehtml .= '<li>'.$value->name.'（'.$value->term_id.'）</li>';
	}
	$rehtml .= '</ul></div>';
	return $rehtml;
}