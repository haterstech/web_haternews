<?php


class WB_IMGSPY_Conf
{
    public static $name = 'imgspider_pack';
    public static $optionName = 'wb_imgspider_option';

    public static function init(){
        if(is_admin()){
            add_action( 'admin_menu', array(__CLASS__,'admin_menu') );
            add_action('admin_enqueue_scripts',array(__CLASS__,'admin_enqueue_scripts'),1);
            add_filter( 'plugin_action_links', array(__CLASS__,'actionLinks'), 10, 2 );
            add_filter('plugin_row_meta', array(__CLASS__, 'plugin_row_meta'), 10, 2);
        }
    }


    public static function plugin_row_meta($links,$file){

        $base = plugin_basename(IMGSPY_BASE_FILE);
        if($file == $base) {
            $links[] = '<a href="https://www.wbolt.com/plugins/imgspider/">插件主页</a>';
            $links[] = '<a href="https://www.wbolt.com/imgspider-plugin-documentation.html">FAQ</a>';
            $links[] = '<a href="https://wordpress.org/support/plugin/imgspider/">反馈</a>';
        }
        return $links;
    }

    public static function actionLinks( $links, $file ) {

        if ( $file != plugin_basename(IMGSPY_BASE_FILE) )
            return $links;

        $settings_link = '<a href="'.menu_page_url( self::$name, false ).'">设置</a>';

        array_unshift( $links, $settings_link );

        return $links;
    }

    public static function admin_menu(){

        global $wb_settings_page_hook_imgscrapy;
        $wb_settings_page_hook_imgscrapy = add_options_page(
            'IMGspider图片蜘蛛',
            'IMGspider图片蜘蛛',
            'manage_options',
            self::$name,
            array(__CLASS__,'admin_settings')
        );
    }


    public static function admin_enqueue_scripts($hook){

        global $wb_settings_page_hook_imgscrapy;

        if($wb_settings_page_hook_imgscrapy != $hook) return;


        if(defined('WB_CORE_ASSETS_LOAD') && class_exists('WB_Core_Asset_Load')){
            WB_Core_Asset_Load::load('setting-01');
        }else{
            wp_enqueue_script('wbp-imgscrapy-js', IMGSPY_URI . 'assets/wbp_setting.js', array(), IMGSPY_VERSION, true);
        }

        //wb_ajaxurl
        wp_enqueue_style('wbs-style-imgscrapy', IMGSPY_URI . 'assets/wbp_setting.css', array(), IMGSPY_VERSION);

        $ajax_nonce = wp_create_nonce('wp_ajax_wb_imgspider');
        $imgspider_ver = get_option('wb_imgspider_ver',0);

        wp_add_inline_script('wbp-imgscrapy-js','var wb_ajaxurl=\''.admin_url('admin-ajax.php').'\',imgspider_ver='.$imgspider_ver.',_wb_imgspider_ajax_nonce=\''.$ajax_nonce.'\';','before');


    }

    public static function get_proxy(){

        $cnf = WB_IMGSPY_Conf::opt();

        if(!isset($cnf['df_mode'])){
            return false;
        }
        if(in_array($cnf['df_mode'],array('none','proxy','ext'))){
            return false;
        }
        $proxy_type = $cnf['df_mode'];


        /*if(!isset($cnf['proxy']) || empty($cnf['proxy']) || !is_array($cnf['proxy'])){
            return false;
        }


        $proxy_type = '';

        foreach($cnf['proxy'] as $type=>$active){
            if($active){
                $proxy_type = $type;
                break;
            }
        }*/

        if(!$proxy_type){
            return false;
        }

        /*if($proxy_type=='wb'){
            return array('type'=>$proxy_type);
        }*/


        if(!isset($cnf['proxy_manual']) || empty($cnf['proxy_manual']) || !is_array($cnf['proxy_manual'])){
            return false;
        }

        if(!isset($cnf['proxy_manual'][$proxy_type])){
            return false;
        }

        $ret = $cnf['proxy_manual'][$proxy_type];
        $ret['type'] = 'ip';

        return $ret;
    }


    public static function update_cnf(){
        $opt_data = $_POST['opt'];
        update_option( self::$optionName, $opt_data ,false);
    }

    public static function opt(){

        static $opt = null;
        if($opt){
            return $opt;
        }
        $def = array(
            'switch'=>1,
            'mode'=>1,
            'df_mode'=>'none',
            'proxy'=>array(
                'wb'=>0,
            ),
            'proxy_manual'=>array(
                //array('name'=>'test','ip'=>'127.0.0.1','port'=>'1080','user'=>'','pwd'=>'')
            ),

            /*
            'proxy_type'=>'none',
            'proxy_ip'=>'',
            'proxy_port'=>'',
            'proxy_user'=>'',
            'proxy_pwd'=>'',*/

            'thumbnail'=>0, //第一张图作为缩略图
            'rule'=>array(
                'size'=>'0',
                'custom_size'=>'',
                'file_name'=>'0',
                'custom_name'=>'',
                'title_alt'=>'0',
                'custom_title'=>'',
                'align'=>'none'
            ),

            'filter' => array(
                'except_index'=>'',
                'min_width' => '',
                'domain'=>array(),
                'type'=>array(
                    'jpg'=>0,
                )
            ),
        );
        $opt = get_option(self::$optionName,array() );
        foreach ($def as $k=>$v){
            if(!isset($opt[$k])){
                $opt[$k] = $v;
            }else{
                if(is_array($v))foreach($v as $sk=>$sv){
                    if(!isset($opt[$k][$sk])){
                        $opt[$k][$sk] = $sv;
                    }
                }
            }

        }



        return apply_filters('wb_imgspy_cnf',$opt);
    }

    public static function cnf($key,$default=null){
        static $option = array();
        if(!$option){
            $option = self::opt();
        }
        $keys = explode('.',$key);
        $find = false;
        $cnf = $option;
        foreach ($keys as $_k){
            if(isset($cnf[$_k])){
                $cnf = $cnf[$_k];
                $find = true;
                continue;
            }
            $find = false;
        }
        if($find){
            return $cnf;
        }

        return $default;

    }



    public static function admin_settings(){


        $cnf = self::opt();


        global $wp_post_types;

        $post_types = array();
        if ($wp_post_types && is_array($wp_post_types)) foreach ($wp_post_types as $type) {
            if ($type->public) {
                $post_types[$type->name] = $type->labels->name;
            }

        }

        include_once( IMGSPY_PATH.'/settings.php' );
    }
}