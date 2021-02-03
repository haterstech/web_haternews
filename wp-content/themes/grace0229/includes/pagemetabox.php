<?php

//自定义域

$new_page_meta_boxes =
array(
  "linkcat" => array(
    "name" => "linkcat",
    "std" => "輸入要顯示的鏈接分類ID，每個鏈接分類ID 用 空格 隔開。",
    "title" => "輸入導航分類ID:"),
);

function new_page_meta_boxes() {
    global $post, $new_page_meta_boxes;

    foreach($new_page_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

        if($meta_box_value == "")
          $meta_box_value = $meta_box['std'];

        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';

        // 自定义字段输入框
        echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
        if($meta_box['std'] != ''){   
            echo '<p>'.$meta_box['std'].'</p>';
        }
        echo get_links_category();  
    }
    echo '<input type="hidden" name="ludou_metaboxes_nonce" id="ludou_metaboxes_nonce" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
    echo
<<<JS
<script>
    jQuery(document).ready(function(){
        var defaultpage = jQuery('#page_template').children('option:selected').val();
        if(defaultpage != 'pages/page-nav.php'){
            jQuery('#new-meta-boxes').hide();
        }
        jQuery('#page_template').change(function(){
            var curpage = jQuery(this).children('option:selected').val();
            if(curpage == 'pages/page-nav.php'){
                jQuery('#new-meta-boxes').show();
            }
            else{
                jQuery('#new-meta-boxes').hide();
            }
        });
    });
</script>
JS;
}

function create_page_meta_box() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '導航分類設置', 'new_page_meta_boxes', 'page', 'normal', 'high' );
    }
}
function save_pagedata( $post_id ) {
    global $new_page_meta_boxes;
    if ( !wp_verify_nonce( $_POST['ludou_metaboxes_nonce'], plugin_basename(__FILE__) ))
    return;
    if ( !current_user_can( 'edit_posts', $post_id ))
    return;           
    foreach($new_page_meta_boxes as $meta_box) {
    $data = $_POST[$meta_box['name'].'_value'];
    if($data == "")
        delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    else
      update_post_meta($post_id, $meta_box['name'].'_value', $data);
   }
}
add_action('admin_menu', 'create_page_meta_box');
add_action('save_post', 'save_pagedata');
?>
