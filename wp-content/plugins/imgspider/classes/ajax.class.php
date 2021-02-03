<?php


class WB_IMGSPY_Ajax
{

    public static function init(){
        add_action('wp_ajax_wb_scrapy_image',array(__CLASS__,'wp_ajax_wb_scrapy_image'));
    }

    public static function wp_ajax_wb_scrapy_image(){
        if( !is_user_logged_in()) {
            echo 'fail';
            exit();
        }
        global $wpdb;
        $ret = array('code'=>0,'desc'=>'success');

        switch ($_REQUEST['do']){
            case 'chk_ver':
                $http = wp_remote_get('https://www.wbolt.com/wb-api/v1/themes/checkver?code='.IMGSPY_CODE.'&ver='.IMGSPY_VERSION.'&chk=1',array('sslverify' => false,'headers'=>array('referer'=>home_url()),));

                if(wp_remote_retrieve_response_code($http) == 200){
                    echo wp_remote_retrieve_body($http);
                }

                exit();
                break;
            case 'chk_ver_ce':

                $http = wp_remote_get('https://www.wbolt.com/wb-api/v1/extension/ver?code='.IMGSPY_CODE.'&ver=',array('sslverify' => false,'headers'=>array('referer'=>home_url()),));

                if(wp_remote_retrieve_response_code($http) == 200){
                    echo wp_remote_retrieve_body($http);
                }

                exit();
                break;
            case 'set_setting':

                if(current_user_can('manage_options')){
                    WB_IMGSPY_Conf::update_cnf();
                }



                $ret = array('code'=>0,'desc'=>'success');

                break;



            case 'scan':

                if(!current_user_can('manage_options')){
                    $ret = array('code'=>1,'desc'=>'没有权限');
                    break;
                }

                $domain = $_POST['domain'];
                $scan_type = $_POST['scan_type'];



                if(empty($scan_type)){
                    $ret = array('code'=>1,'desc'=>'扫描类型为空');
                    break;
                }


                //取
                $job = get_option('wb_imgspy_scan',false);

                if(!$job){
                    $job = array('scan_num'=>0,'offset'=>0,'total'=>0,'num'=>10,'finnish'=>0,'type'=>array('post'));
                }

                $offset = $job['offset'];
                $num = $job['num'];

                $find_total = '';
                if($job['total']<1){
                    $find_total = 'SQL_CALC_FOUND_ROWS';
                }

                $post_type_in = implode("','",$scan_type);

                $sql = "SELECT $find_total * FROM $wpdb->posts WHERE post_status='publish' AND post_type IN('$post_type_in') ORDER BY ID ASC LIMIT $offset,$num";

                $list = $wpdb->get_results($sql);
                $images = array();
                $idx = 0;
                foreach($list as $r){
                    $idx++;
                    $html = array();
                    //$img_list = WB_IMGSPY_Post::find_img_src($r,$html);
                    $img = self::parse_images_url($r,$domain);
                    $images = array_merge($images,$img);
                }

                //$images = array_unique($images);

                if($find_total){
                    $job['total'] = $wpdb->get_var("SELECT FOUND_ROWS()");
                }


                $job['scan_num'] += $idx;

                $job['offset'] = $job['offset'] + $job['num'];

                if($job['offset'] > $job['total']){
                    $job['finnish'] = 1;
                }

                if($job['finnish']){
                    delete_option('wb_imgspy_scan');
                }else{
                    update_option('wb_imgspy_scan',$job);
                }


                $ret = array('code'=>0,'desc'=>'success','job'=>$job,'images'=>$images);


                break;


            case 'save_img':

                $post_title = isset($_POST['post_title']) ?sanitize_text_field($_POST['post_title']):'';
                $post_id = isset($_POST['post_id'])?intval($_POST['post_id']):0;
                if(!current_user_can('edit_post', $post_id)){
                    $ret = [];//array('code'=>1,'desc'=>'没有权限');
                    break;
                }

                $ret_list = array();
                $error = '';
                $ret = WB_IMGSPY_Post::upload_img_file('img_file',$post_id,false,$error);
                if($ret){
                    $config = WB_IMGSPY_Conf::opt();
                    $img_html = WB_IMGSPY_Post::img_html($ret,0,$post_title,$config);
                    $ret_list[] = $img_html;
                }
                $ret = $ret_list;
                break;
            case 'save_paste_image':

                $post_title = isset($_POST['post_title']) ?sanitize_text_field($_POST['post_title']):'';
                $post_id = isset($_POST['post_id'])?intval($_POST['post_id']):0;
                $img = isset($_POST['image']) ? $_POST['image']:'';
                if(empty($img) || empty($post_id)){
                    $ret = [];
                    break;
                }
                if(!current_user_can('edit_post',$post_id)){
                    $ret = [];//array('code'=>1,'desc'=>'没有权限');
                    break;
                }
                $ret_list = array();
                $ret = WB_IMGSPY_Post::upload_img_base64($img,$post_id,false);
                if($ret){
                    $config = WB_IMGSPY_Conf::opt();
                    $img_html = WB_IMGSPY_Post::img_html($ret,0,$post_title,$config);

                    $ret_list[] = $img_html;
                }
                $ret = $ret_list;
                break;
            case 'scrapy':

                set_time_limit ( 600 );
                $idx = (int)$_POST['idx'];
                $post_title = sanitize_text_field($_POST['title']);
                $img = $_POST['image'];
                $proxy = sanitize_text_field($_POST['proxy']);
                $config = WB_IMGSPY_Conf::opt();
                $post_id = isset($_POST['post_id'])?intval($_POST['post_id']):0;

                if(!current_user_can('edit_post',$post_id)){
                    $ret = [];//array('code'=>1,'desc'=>'没有权限');
                    break;
                }

                //set proxy
                if(strlen($proxy)>0 && $proxy != 'none'){
                    WB_IMGSPY_Down::set_proxy($proxy);
                }
                $ret_list = array();
                if($img){

                    $img =  rawurldecode($img);
                    $img = str_replace('&amp;','&',$img);

                    $ret = WB_IMGSPY_Post::upload($img,$post_id,false);
                    if($ret){

                        $img_html = WB_IMGSPY_Post::img_html($ret,$idx,$post_title,$config);

                        $ret_list[] = $img_html;
                    }
                }

                $ret = $ret_list;
                break;


            case 'down':
                if(!current_user_can('manage_options')){
                    $ret = array('code'=>1,'desc'=>'没有权限');
                    break;
                }
                set_time_limit ( 600 );
                $id = trim($_POST['id']);
                $image = trim($_POST['image']);
                $img_key = trim($_POST['key']);

                if(empty($id)){
                    $ret['code'] = 1;
                    $ret['desc'] = 'ID不能为空';
                    break;
                }

                if(empty($image)){
                    $ret['code'] = 1;
                    $ret['desc'] = '图片不能为空';
                    break;
                }
                if(empty($img_key)){
                    $ret['code'] = 1;
                    $ret['desc'] = 'Key不能为空';
                    break;
                }

                if(!preg_match('#^\d+-\d+$#',$id)){
                    $ret['code'] = 1;
                    $ret['desc'] = 'ID参数符';
                    break;
                }
                $ids = explode('-',$id);


                $post_id = intval($ids[0]);
                $idx = intval($ids[1]);

                $post = get_post($post_id);

                if(!$post || !$post->ID || $post->post_status != 'publish'){
                    $ret['code'] = 1;
                    $ret['desc'] = '无法找到对应文章';
                    break;
                }

                if(!preg_match_all('#<img[^>]+>#is',$post->post_content,$match)){
                    $ret['code'] = 1;
                    $ret['desc'] = '未匹配到图片';
                    break;
                }

                $find_it = false;
                foreach($match[0] as $img_html){
                    if(!preg_match('#src=([^\s]+)#is',$img_html,$img_match)){
                        continue;
                    }
                    $img_src = trim($img_match[1],'\'"');
                    if(!preg_match('#^https?://#is',$img_src)){
                        continue;
                    }
                    $key = md5($img_src);
                    if($img_key!=$key){
                        continue;
                    }
                    $find_it = true;
                    break;

                }
                if(!$find_it){
                    $ret['code'] = 1;
                    $ret['desc'] = '图片不匹配';
                    break;
                }

                $config = WB_IMGSPY_Conf::opt();
                $proxy = trim($_POST['proxy']);
                if($proxy && $proxy != 'none'){
                    //set proxy
                    WB_IMGSPY_Down::set_proxy($proxy);
                }


                $new_html = '';
                if(isset($_FILES['img_file'])) {
                    $error = '';
                    $upload_ret = WB_IMGSPY_Post::upload_img_file('img_file', $post_id, $post->post_date, $error);
                }else if(isset($_POST['base64_img'])){
                    $upload_ret = WB_IMGSPY_Post::upload_img_base64($_POST['base64_img'],$post_id,$post->post_date);
                }else{
                    $img =  rawurldecode($image);
                    $img = str_replace('&amp;','&',$img);
                    $upload_ret = WB_IMGSPY_Post::upload($img,$post_id,$post->post_date);
                }

                if($upload_ret){
                    $new_html = WB_IMGSPY_Post::img_html($upload_ret,$idx,$post->post_title,$config);
                }

                if(!$new_html){
                    $ret['code'] = 1;
                    $ret['desc'] = '采集失败';
                    break;
                }

                $content = $post->post_content;

                foreach($match[0] as $img_html){
                    if(!preg_match('#src=([^\s]+)#is',$img_html,$img_match)){
                        continue;
                    }
                    $img_src = trim($img_match[1],'\'"');
                    if(!preg_match('#^https?://#is',$img_src)){
                        continue;
                    }
                    $key = md5($img_src);
                    if($img_key!=$key){
                        continue;
                    }
                    $content = str_replace($img_html,$new_html,$content);
                }

                wp_update_post(array('ID'=>$post->ID,'post_content'=>$content));
                $ret['code'] = 0;
                $ret['desc'] = 'success';
                break;

            case 'verify':
                if(!wp_verify_nonce($_POST['_ajax_nonce'], 'wp_ajax_wb_imgspider')){

                    echo json_encode(array('code'=>1,'data'=>'非法操作'));
                    exit(0);
                }
                if(!current_user_can('manage_options')){
                    echo json_encode(array('code'=>1,'data'=>'没有权限'));
                    exit(0);
                }

                $param = array(
                    'code'=>sanitize_text_field(trim($_POST['key'])),
                    'host'=>sanitize_text_field(trim($_POST['host'])),
                    'ver'=>'imgspider-pro',
                );
                $err = '';
                do{
                    $http = wp_remote_post('https://www.wbolt.com/wb-api/v1/verify',array('sslverify'=>false,'body'=>$param,'headers'=>array('referer'=>home_url()),));
                    if(is_wp_error($http)){
                        $err = '校验失败，请稍后再试（错误代码001['.$http->get_error_message().'])';
                        break;
                    }

                    if($http['response']['code']!=200){
                        $err = '校验失败，请稍后再试（错误代码001['.$http['response']['code'].'])';
                        break;
                    }

                    $body = $http['body'];

                    if(empty($body)){
                        $err = '发生异常错误，联系<a href="https://www.wbolt.com/member?act=enquire" target="_blank">技术支持</a>（错误代码 010）';
                        break;
                    }

                    $data = json_decode($body,true);

                    if(empty($data)){
                        $err = '发生异常错误，联系<a href="https://www.wbolt.com/member?act=enquire" target="_blank">技术支持</a>（错误代码011）';
                        break;
                    }
                    if(empty($data['data'])){
                        $err = '校验失败，请稍后再试（错误代码004)';
                        break;
                    }
                    if($data['code']){
                        $err_code = $data['data'];
                        switch ($err_code){
                            case 100:
                            case 101:
                            case 102:
                            case 103:
                                $err = '插件配置参数错误，联系<a href="https://www.wbolt.com/member?act=enquire" target="_blank">技术支持</a>（错误代码'.$err_code.'）';
                                break;
                            case 200:
                                $err = '输入key无效，请输入正确key（错误代码200）';
                                break;
                            case 201:
                                $err = 'key使用次数超出限制范围（错误代码201）';
                                break;
                            case 202:
                            case 203:
                            case 204:
                                $err = '校验服务器异常，联系<a href="https://www.wbolt.com/member?act=enquire" target="_blank">技术支持</a>（错误代码'.$err_code.'）';
                                break;
                            default:
                                $err = '发生异常错误，联系<a href="https://www.wbolt.com/member?act=enquire" target="_blank">技术支持</a>（错误代码'.$err_code.'）';
                        }

                        break;
                    }

                    update_option('wb_imgspider_ver',$data['v'],false);
                    update_option('wb_imgspider_cnf_'.$data['v'],$data['data'],false);


                    echo json_encode(array('code'=>0,'data'=>'success'));
                    exit(0);
                }while(false);
                echo json_encode(array('code'=>1,'data'=>$err));
                //exit(0);
                break;
            case 'options':
                if(!wp_verify_nonce($_GET['_ajax_nonce'], 'wp_ajax_wb_imgspider')){
                    echo json_encode(array('o'=>''));
                    exit(0);
                }

                $ver = get_option('wb_imgspider_ver',0);
                $cnf = '';
                if($ver){
                    $cnf = get_option('wb_imgspider_cnf_'.$ver,'');
                }
                $list = array('o'=>$cnf);
                header('content-type:text/json;charset=utf-8');
                echo json_encode($list);
                exit();
                break;

        }

        header('content-type:text/json;charset=utf-8');
        echo json_encode($ret);
        exit();

    }


    private static function parse_images_url($post,$allow_domain = array()){
        $ret = array();
        $host_name = parse_url(home_url(),PHP_URL_HOST);
        $host_name = str_replace('www.','',$host_name);
        $allow_domain[] = $host_name;

        if(preg_match_all('#<img[^>]+>#is',$post->post_content,$match)){

            foreach($match[0] as $img_html){
                if(!preg_match('#src=([^\s]+)#is',$img_html,$img_match)){
                    continue;
                }
                $img_src = trim($img_match[1],'\'"');
                if(!preg_match('#^https?://#is',$img_src)){
                    continue;
                }

                $find_id = false;

                foreach($allow_domain as $domain){
                    if(strpos($img_src,$domain)){
                        $find_id = true;
                        break;
                    }
                }
                if(!$find_id){
                    $key = md5($img_src);
                    $ret[$key] = $img_src;
                }
            }
        }
        if($ret){
            //$ret = array_values($ret);
            $images = array();
            $post_url = get_permalink($post);
            $idx = -1;
            foreach($ret as $k=>$img){
                $idx ++;
                $images[] = array('post_id'=>$post->ID,'status'=>0,'key'=>$k,'id'=>$post->ID.'-'.$idx,'url'=>$post_url,'src'=>$img);
            }

            return $images;
        }

        return $ret;
    }
}