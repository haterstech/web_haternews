<?php


/**
 *
 */

/**
 * Class IMGSPY_Admin
 */

class IMGSPY_Admin
{
    public static $debug = false;

	public static function init(){



	    add_action('init',array(__CLASS__,'wp_init'));

        if(is_admin()){



	        add_action('media_buttons', array(__CLASS__, 'add_media_button'), 20);

	        add_action('admin_head-post.php',array(__CLASS__,'admin_head'));
	        add_action('admin_head-post-new.php',array(__CLASS__,'admin_head'));

	        add_action('admin_head',array(__CLASS__,'admin_head_mark'));
	        add_action('save_post',array(__CLASS__,'save_post'),10,3);

        }

        WB_IMGSPY_Conf::init();

        WB_IMGSPY_Ajax::init();

    }


    public static function plugin_activate(){

    }

    public static function plugin_deactivate(){

    }

    public static function txt_log($msg){

        if(!self::$debug){
            return;
        }
        $num = func_num_args();
        if($num>1){
            $msg = json_encode(func_get_args());
        }else if(is_array($msg)){
            $msg = json_encode($msg);
        }else if(is_object($msg)){
            $msg = json_encode($msg);
        }

        error_log('['.current_time('mysql').']'.$msg."\n",3,IMGSPY_PATH.'/#log/'.date('Ym').'.log');
    }

    public static function open_types(){
        global $wp_post_types;
        $post_types = array();
        if ($wp_post_types && is_array($wp_post_types)) foreach ($wp_post_types as $type) {
            if ($type->public) {
                $post_types[] = $type->name;
            }

        }

        return $post_types;

    }
    public static function save_post($post_ID, $post, $update){

	    static $post_ids = array();
        //自动保存图片
        $cnf = WB_IMGSPY_Conf::opt();
        if($cnf['mode']){
            return;
        }

        if(!$update){
            return;
        }

        if(isset($_POST['data']) && isset($_POST['data']['wp_autosave'])){
            return;
        }

        if(!in_array($post->post_type,self::open_types())){
            return;
        }

        if(in_array($post->post_status,array('auto-draft','inherit'))){
            return;
        }

        if(isset($post_ids[$post_ID])){
            return;
        }
        if($post->post_status == 'trash'){
            return;
        }



        $post_ids[$post_ID] = 1;

        //self::txt_log($post->post_type);

        $find_img_html = array();

        $img_list = WB_IMGSPY_Post::find_img_src($post,$find_img_html);

        //self::txt_log($img_list);

        if(!$img_list || empty($img_list)){
            return;
        }

        WB_IMGSPY_Down::set_proxy();

        $success_list = array();
        foreach($img_list as $key=>$img){

            $ret = WB_IMGSPY_Post::upload($img,$post_ID,false);
            if($ret){
                $success_list[$key] = $ret;
            }
        }
        if($success_list){
            //self::txt_log($success_list);
            WB_IMGSPY_Post::update_post($post_ID,$post,$update,$success_list,$find_img_html);
        }
    }


    public static function admin_head_mark()
    {
        echo '<meta name="wb_marker" content="'.get_option('wb_imgspider_ver',0).'"/>';
    }

    public static function admin_head(){

        wp_enqueue_script('wbp-admin-jq-paste-image',IMGSPY_URI.'assets/jquery.paste_image_reader.js', array('jquery'), IMGSPY_VERSION, true);

        if(defined('WB_CORE_ASSETS_LOAD') && class_exists('WB_Core_Asset_Load')){
            WB_Core_Asset_Load::load('post-01');
        }else{
            wp_enqueue_style('wbp-admin-style-imgspy',IMGSPY_URI.'assets/wbp_admin_imgspy.css', array(), IMGSPY_VERSION);
            wp_enqueue_script('wbp-admin-js-imgspy',IMGSPY_URI.'assets/wbp_admin_imgspy.js', array('jquery'), IMGSPY_VERSION, true);
        }



        $ajax_nonce = wp_create_nonce('wp_ajax_wb_imgspider');
        $imgspider_ver = get_option('wb_imgspider_ver',0);
        $config_url = admin_url('options-general.php?page=imgspider_pack#scExtension');

	    wp_add_inline_script('wbp-admin-js-imgspy','var imgspy_cnf='.json_encode(WB_IMGSPY_Conf::opt()).',wb_ajaxurl=\''.admin_url('admin-ajax.php').'\',imgspider_ver='.$imgspider_ver.',_wb_imgspider_ajax_nonce=\''.$ajax_nonce.'\',imgspider_pro_url=\''.$config_url.'\';','before');




    }

    public static function wp_init(){
        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
            return;
        if ( get_user_option('rich_editing') == 'true') {
            add_filter('mce_external_plugins', array(__CLASS__,'mce_external_plugins_paste_image'));
        }
    }

    public static function mce_external_plugins_paste_image($plugin_array){

        $plugin_array['wb_paste_image'] = IMGSPY_URI.'assets/wb_paste_image.js';

	    return $plugin_array;
    }


    public static function add_media_button(){


        $html = '<button id="wb-wbsm-btn-spy" type="button" class="button wb-wbsm-btn-spy"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"><g fill="#999" fill-rule="evenodd"><path d="M6 16h4v-2H6zM6 2h4V0H6zM14 10h2V6h-2zM0 10h2V6H0zM12 8H9V4H7v4H4l4 4zM2 2h2V0H1C.4 0 0 .4 0 1v3h2V2zM15 0h-3v2h2v2h2V1c0-.6-.4-1-1-1M14 14h-2v2h3c.6 0 1-.4 1-1v-3h-2v2zM2 12H0v3c0 .6.4 1 1 1h3v-2H2v-2z"/></g></svg><span>保存站外图片</span></button>';
        $html .= '<button id="wb-wbsm-btn-spy-ext" style="display:none;" type="button" class="button wb-wbsm-btn-spy"></button>';
        echo $html;
    }



}
