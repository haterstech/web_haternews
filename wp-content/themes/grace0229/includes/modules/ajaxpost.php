<?php

//ajax post by weiwei
function fa_make_post_section(){
    global $post;

    $target='';
    $image='';
    $excerpt='';
    $excerpt2='';
    $cate='';
    $post_section ='';
    $category = get_the_category();
    if( suxingme('suxingme_post_target')) { $target='target="_blank"';}
    if(has_excerpt()) { $excerpt = mb_substr(get_the_excerpt(),0,90,"utf8").'...';} else { $excerpt = deel_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 90, '...'); }
    if(has_excerpt()) { $excerpt2 = mb_substr(get_the_excerpt(),0,60,"utf8").'...'; } else { $excerpt2 = deel_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 60, '...'); }
    if($category[0]){
        $cate='<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
    }

    if( get_post_meta($post->ID,'suxing_ding',true) ){ $ding_num = get_post_meta($post->ID,'suxing_ding',true); } else { $ding_num =  '0';}


    if( has_post_format( 'gallery' ) ){
        if( suxingme('suxingme_timthumb_lazyload')) { 
            $image ='<img class="lazy thumbnail" data-original="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=160&w=240&zc=1" src="'.THUMB_SMALL_DEFAULT.'" alt="' . get_the_title() . '" />';           
        }
        elseif (suxingme('suxingme_timthumb')) {
            $image ='<img class="thumbnail" src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=160&w=240&zc=1" alt="' . get_the_title() . '" />';
        }
        else{
            $image ='<img src="'.post_thumbnail_src().'" alt="'. get_the_title().'" class="thumbnail" />';  
        }
        $post_section ='
            <li class="ajax-load-con content">
                <div class="content-box posts-gallery-box">
                    <div class="posts-gallery-img">
                        <a href="'.get_permalink().'" title="'.get_the_title().'" '.$target.'>  
                            '.$image.'
                        </a> 
                    </div>
                    <div class="posts-gallery-content">
                        <h2 class="posts-gallery-title">'.suxing_post_state_date().'<a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>'.get_the_title().'</a></h2>  
                       <div class="posts-gallery-text">'.$excerpt2.'</div>
                        <div class="posts-default-info">
                            <ul>
                                <li class="post-author"><div class="avatar">'. get_avatar( get_the_author_meta('email'), '' ).'</div><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ). '" target="_blank">'. get_the_author() .'</a></li>
                                <li class="ico-cat"><i class="icon-list"></i>  '.$cate.'</li>
                                <li class="ico-time"><i class="icon-clock-1"></i> '.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ).'</li>
                                <li class="ico-eye"><i class="icon-eye-1"></i> '.post_views('','',0).'</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        ';
    }
    else if ( has_post_format( 'image' )) { //多图 
        $post_section .= '<li class="ajax-load-con content"><div class="content-box posts-image-box"><div class="posts-default-title">';
        if (suxingme('suxingme_post_tags',true)) { 
            $posttags = get_the_tags();
            if ($posttags) {
                $post_section .='<div class="post-entry-categories">';
                foreach($posttags as $tag) {
                    $post_section .= '<a href="'.get_tag_link($tag->term_id).'" rel="tag">' .$tag->name .'</a>'; 
                }
                $post_section .='</div>';
            }
        }
        $post_section .= '<h2>'.suxing_post_state_date().'<a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>'.get_the_title().'</a></h2></div>
                <div class="post-images-item"><ul>'.suxingme_get_thumbnail().'</ul></div><div class="posts-default-content"><div class="posts-text">'.$excerpt.'</div>
                        <div class="posts-default-info">
                            <ul>
                                <li class="post-author"><div class="avatar">'. get_avatar( get_the_author_meta('email'), '' ).'</div><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ). '" target="_blank">'.get_the_author() .'</a></li>
                                <li class="ico-cat"><i class="icon-list"></i>  '.$cate.'</li>
                                <li class="ico-time"><i class="icon-clock-1"></i> '.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ).'</li>
                                <li class="ico-eye"><i class="icon-eye-1"></i> '.post_views('','',0).'</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>';
     }
    else if ( has_post_format( 'aside' )) {
        $post_section .= '<li class="ajax-load-con content"><div class="content-box posts-aside"><div class="posts-default-content"><div class="posts-default-title">';
        if (suxingme('suxingme_post_tags',true)) { 
            $posttags = get_the_tags();
            if ($posttags) {
                $post_section .='<div class="post-entry-categories">';
                foreach($posttags as $tag) {
                    $post_section .= '<a href="'.get_tag_link($tag->term_id).'" rel="tag">' .$tag->name .'</a>'; 
                }
                $post_section .='</div>';
            }
        }
        $post_section .= '
            <h2 class="posts-title">'.suxing_post_state_date().'<a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>'.get_the_title().'</a></h2></div>
                    <div class="posts-text">'.$excerpt.'</div>
                        <div class="posts-default-info">
                            <ul>
                                <li class="post-author"><div class="avatar">'. get_avatar( get_the_author_meta('email'), '' ).'</div><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ). '" target="_blank">'.get_the_author() .'</a></li>
                                <li class="ico-cat"><i class="icon-list"></i>  '.$cate.'</li>
                                <li class="ico-time"><i class="icon-clock-1"></i> '.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ).'</li>
                                <li class="ico-eye"><i class="icon-eye-1"></i> '.post_views('','',0).'</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        ';
    }
   else if ( has_post_format( 'link' )) {
        if( suxingme('suxingme_timthumb_lazyload')) { 
            $image ='<img class="lazy thumbnail" data-original="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=160&w=240&zc=1" src="'.THUMB_SMALL_DEFAULT.'" alt="' . get_the_title() . '" />';           
        }
        elseif (suxingme('suxingme_timthumb')) {
            $image ='<img class="thumbnail" src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=160&w=240&zc=1" alt="' . get_the_title() . '" />';
        }
        else{
            $image ='<img src="'.post_thumbnail_src().'" alt="'. get_the_title().'" class="thumbnail" />';  
        }
        $post_section ='
            <li class="ajax-load-con content">
                <div class="content-box posts-gallery-box">
                    <div class="posts-gallery-img">
                        <div class="posts-gallery-info">
                            <span class="i-tgwz">推廣</span>
                        </div>
                        <a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>  
                            '.$image.'
                        </a> 
                    </div>
                    <div class="posts-gallery-content">
                        <h2 class="posts-gallery-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>' . get_the_title() . '</a></h2>  
                        <div class="posts-gallery-text">'.$excerpt2.'</div>
                    </div>
                </div>
            </li>
        ';
   }
   else{
        if( suxingme('suxingme_timthumb_lazyload')) { 
            $image ='<img class="lazy thumbnail" data-original="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=300&w=760&zc=1" src="'.THUMB_BIG_DEFAULT.'" alt="' . get_the_title() . '" />';         
        }
        elseif (suxingme('suxingme_timthumb')) {
            $image ='<img class="thumbnail" src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=300&w=760&zc=1" alt="' . get_the_title() . '" />';
        }
        else{
            $image ='<img src="'.post_thumbnail_src().'" alt="'. get_the_title().'" class="thumbnail" />';  
        }

        $post_section .='<li class="ajax-load-con content posts-default"><div class="content-box">
                            <div class="posts-default-img">
                                <a href="' . get_permalink() . '" title="'.get_the_title().'" '.$target.'>
                                    <div class="overlay"></div>     
                                    '.$image.'
                                </a> 
                            </div>';

        $post_section .='<div class="posts-default-box"><div class="posts-default-title">';

        if (suxingme('suxingme_post_tags',true)) { 
            $posttags = get_the_tags();
            if ($posttags) {
                $post_section .='<div class="post-entry-categories">';
                foreach($posttags as $tag) {
                    $post_section .= '<a href="'.get_tag_link($tag->term_id).'" rel="tag">' .$tag->name .'</a>'; 
                }
                $post_section .='</div>';
            }
        }
        $post_section .='<h2>'.suxing_post_state_date().'<a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>'.get_the_title().'</a></h2></div><div class="posts-default-content">
                        <div class="posts-text">'.$excerpt.'</div>
                        <div class="posts-default-info">
                            <ul>
                                <li class="post-author"><div class="avatar">'. get_avatar( get_the_author_meta('email'), '' ).'</div><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ). '" target="_blank">'.get_the_author() .'</a></li>
                                <li class="ico-cat"><i class="icon-list"></i>  '.$cate.'</li>
                                <li class="ico-time"><i class="icon-clock-1"></i> '.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ).'</li>
                                <li class="ico-eye"><i class="icon-eye-1"></i> '.post_views('','',0).'</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        ';
   }

   return $post_section;
}

add_action('wp_ajax_nopriv_fa_load_postlist', 'fa_load_postlist_callback');
add_action('wp_ajax_fa_load_postlist', 'fa_load_postlist_callback');
function fa_load_postlist_callback(){
    $postlist = '';
    $paged = !empty($_POST["paged"]) ? $_POST["paged"] : null;
    $total = !empty($_POST["total"]) ? $_POST["total"] : null;
    $category = !empty($_POST["category"]) ? $_POST["category"] : null;
    $author = !empty($_POST["author"]) ? $_POST["author"] : null;
    $tag = !empty($_POST["tag"]) ? $_POST["tag"] : null;
    $search = !empty($_POST["search"]) ? $_POST["search"] : null;
    $year = !empty($_POST["year"]) ? $_POST["year"] : null;
    $month = !empty($_POST["month"]) ? $_POST["month"] : null;
    $day = !empty($_POST["day"]) ? $_POST["day"] : null;
    $query_args = array(
        "posts_per_page" => get_option('posts_per_page'),
        "cat" => $category,
        "tag" => $tag,
        "author" => $author,
        "post_status" => "publish",
        "post_type" => "post",
        "paged" => $paged,
        "s" => $search,
        "year" => $year,
        "monthnum" => $month,
        "day" => $day,
        "ignore_sticky_posts" => 1
    );
    /*if( suxingme('notinhome') ){
        $pool = array();
        foreach (suxingme('notinhome') as $key => $value) {
            if( $value ) $pool[] = $key;
        }
        $query_args['cat'] = '-'.implode($pool, ',-');
    }
    else{
         $query_args['cat'] = $category;
    }*/
    $the_query = new WP_Query( $query_args );
    while ( $the_query->have_posts() ){
        $the_query->the_post();
        $postlist .= fa_make_post_section();
    }
    $code = $postlist ? 200 : 500;
    wp_reset_postdata();
    $next = ( $total > $paged )  ? ( $paged + 1 ) : '' ;
    echo json_encode(array('code'=>$code,'postlist'=>$postlist,'next'=> $next));
    die;
}

function fa_load_postlist_button(){
    global $wp_query;
    if (2 > $GLOBALS["wp_query"]->max_num_pages) {
        return;
    } else {
        $button = '<button id="fa-loadmore" class="button button-more"';
        if (is_category()) $button .= ' data-category="' . get_query_var('cat') . '"';

        if (is_author()) $button .=  ' data-author="' . get_query_var('author') . '"';

        if (is_tag()) $button .=  ' data-tag="' . get_query_var('tag') . '"';

        if (is_search()) $button .=  ' data-search="' . get_query_var('s') . '"';

        if (is_date() ) $button .=  ' data-year="' . get_query_var('year') . '" data-month="' . get_query_var('monthnum') . '" data-day="' . get_query_var('day') . '"';

        $button .= ' data-paged="2" data-action="fa_load_postlist" data-total="' . $GLOBALS["wp_query"]->max_num_pages . '">加载更多</button>';

        return $button;
    }
}


