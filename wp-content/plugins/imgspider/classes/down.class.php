<?php


class WB_IMGSPY_Down
{

    private static $use_proxy_serv = false;


    public static function down($url,$args = array()){
        $defaults = array(
            'timeout' => 30,
            'redirection' => 5,
            'headers' => array(
                'Referer'=>'',
            ),
            'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
            'sslverify' => false,
        );
        $http_options = wp_parse_args( $args, $defaults );

        set_time_limit ( 300 );


        if(self::$use_proxy_serv){
            $http = wp_remote_get ( 'https://proxy.wbolt.com/wp-admin/admin-ajax.php?action=down_img&url='.urlencode($url), $http_options );
        }else{
            $http = wp_remote_get ( $url, $http_options );
        }
        if(is_wp_error($http) && function_exists('clog')){
            clog($http->get_error_message());
        }

        $code = wp_remote_retrieve_response_code($http);
        if($code === 200){
            if(isset($http_options['stream']) && $http_options['stream']){
                return $http;
            }
            return wp_remote_retrieve_body($http);
        }
        return false;
    }


    public static function set_proxy($use_proxy = null){
        IMGSPY_Admin::txt_log($use_proxy);
        if($use_proxy!==null){
            if($use_proxy == 'wb'){
                $proxy = array('type'=>'wb');
            }else{
                $proxy = WB_IMGSPY_Conf::cnf('proxy_manual.'.$use_proxy);
                if(!$proxy){
                    return;
                }
                $proxy['type'] = 'ip';
            }
        }else{
            $proxy = WB_IMGSPY_Conf::get_proxy();
        }

        IMGSPY_Admin::txt_log($proxy);
        if(!$proxy){
            return;
        }


        if($proxy['type']=='wb'){
            self::$use_proxy_serv = true;
            return;
        }

        if (isset($proxy['ip']) && $proxy['ip'] && !defined('WP_PROXY_HOST') ){
            define('WP_PROXY_HOST', $proxy['ip']);
        }
        if (isset($proxy['port']) && $proxy['port'] && !defined('WP_PROXY_PORT')){
            define('WP_PROXY_PORT', $proxy['port']);
        }
        if(isset($proxy['user']) && $proxy['user'] && !defined('WP_PROXY_USERNAME')){
            define('WP_PROXY_USERNAME',$proxy['user']);
        }
        if(isset($proxy['pwd']) && $proxy['pwd'] && !defined('WP_PROXY_PASSWORD')){
            define('WP_PROXY_PASSWORD',$proxy['pwd']);
        }
    }


}