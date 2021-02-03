<?php 
add_action('wp_ajax_nopriv_ajax_comment', 'ajax_comment_callback');
add_action('wp_ajax_ajax_comment', 'ajax_comment_callback');
function ajax_comment_callback(){
    global $wpdb;
    $comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
    $post = get_post($comment_post_ID);
    $post_author = $post->post_author;
    if ( empty($post->comment_status) ) {
        do_action('comment_id_not_found', $comment_post_ID);
        ajax_comment_err('Invalid comment status.');
    }
    $status = get_post_status($post);
    $status_obj = get_post_status_object($status);
    if ( !comments_open($comment_post_ID) ) {
        do_action('comment_closed', $comment_post_ID);
        ajax_comment_err('對不起，本文評論已關閉。');
    } elseif ( 'trash' == $status ) {
        do_action('comment_on_trash', $comment_post_ID);
        ajax_comment_err('未知錯誤。');
    } elseif ( !$status_obj->public && !$status_obj->private ) {
        do_action('comment_on_draft', $comment_post_ID);
        ajax_comment_err('未知錯誤。');
    } elseif ( post_password_required($comment_post_ID) ) {
        do_action('comment_on_password_protected', $comment_post_ID);
        ajax_comment_err('密碼保護中');
    } else {
        do_action('pre_comment_on_post', $comment_post_ID);
    }
    $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
    $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
    $comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
    $comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
    $user = wp_get_current_user();
    if ( $user->exists() ) {
        if ( empty( $user->display_name ) )
            $user->display_name=$user->user_login;
        $comment_author       = esc_sql($user->display_name);
        $comment_author_email = esc_sql($user->user_email);
        $comment_author_url   = esc_sql($user->user_url);
        $user_ID              = esc_sql($user->ID);
        if ( current_user_can('unfiltered_html') ) {
            if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
                kses_remove_filters();
                kses_init_filters();
            }
        }
    } else {
        if ( get_option('comment_registration') || 'private' == $status )
            ajax_comment_err('<p>抱歉，您必須登錄後才能發表評論。</p>');
    }
    $comment_type = '';
    if ( get_option('require_name_email') && !$user->exists() ) {
        if ( 6 > strlen($comment_author_email) || '' == $comment_author )
            ajax_comment_err( '<p>錯誤：請填寫必須的選項（姓名，電子郵件）。</p>' );
        elseif ( !is_email($comment_author_email))
            ajax_comment_err( '<p>錯誤：請輸入有效的電子郵件地址。</p>' );
    }
    if ( '' == $comment_content )
        ajax_comment_err( '<p>說點什麼？</p>' );
    $dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
    if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
    $dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
    if ( $wpdb->get_var($dupe) ) {
        ajax_comment_err('<p>aha~似乎說過這句話？</p>');
    }
    if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) {
        $time_lastcomment = mysql2date('U', $lasttime, false);
        $time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
        $flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
        if ( $flood_die ) {
            ajax_comment_err('<p>你回复太快了。慢慢來。</p>');
        }
    }
    $comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
    $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

    $comment_id = wp_new_comment( $commentdata );


    $comment = get_comment($comment_id);
    do_action('set_comment_cookies', $comment, $user);
    $comment_depth = 1;
    $tmp_c = $comment;
    while($tmp_c->comment_parent != 0){
        $comment_depth++;
        $tmp_c = get_comment($tmp_c->comment_parent);
    }
    $GLOBALS['comment'] = $comment;
    //这里修改成你的评论结构
    ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">		
		<div id="comment-<?php comment_ID() ?>">
		<div class="comment-avatar"><?php echo get_avatar($comment,50); ?></div>
		<div class="comment-body">
			<div class="comment_author">
				<span class="name"><a class="url" href="/i?a=<?php echo base64_encode(get_comment_author_url($comment_ID))?>" rel="external nofollow" target="_blank"><?php comment_author() ?></a></span>
				<?php if($comment->user_id == 1) echo "<span class='comment_admin'>站長</span>"; ?>
				<em><?php echo get_comment_time('Y-m-d H:i') ?></em><?php edit_comment_link('編輯','&nbsp;&nbsp;',''); ?>
			</div>
			<div class="comment-text">
			<?php comment_text() ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
			<font style="color:#C00; font-style:inherit">您的評論正在等待審核中...</font>
			<?php endif; ?>
			</div>

		</div>
	</div>
	
    
    <?php die();
}
function ajax_comment_err($a) {
    header('HTTP/1.0 500 Internal Server Error');
    header('Content-Type: text/plain;charset=UTF-8');
    echo $a;
    exit;
}
function scp_comment_post( $incoming_comment ) {
    $pattern = '/[一-龥]/u';

    // 禁止全英文评论
    if(!preg_match($pattern, $incoming_comment['comment_content'])) {
        ajax_comment_err( "<p>some Chinese word (like \"你好\")，您的評論中必須包含漢字!</p>" );
    }
    return( $incoming_comment );
}
add_filter('preprocess_comment', 'scp_comment_post');