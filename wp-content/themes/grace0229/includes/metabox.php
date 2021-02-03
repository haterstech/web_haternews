<?php

//自定义域
$new_meta_boxes =
array(
	"checkbox" => array(   
        "name" => "lunbo",      
        "title" => "把文章推送至首頁“幻燈片",   
        'type' => 'checkbox',
		), 
	
	"postthumb" => array(   
        "name" => "postthumb",   
        "std" => "",      
        "title" => "单独设置幻灯片图片（尺寸：宽1120px、高450px），注意：须开启上面的推送功能。",   
        "type"=>"uploader"), 
 
);
function new_meta_boxes() {   
    global $post, $new_meta_boxes;   
    foreach($new_meta_boxes as $meta_box) {   
        //获取保存的是   
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);   
        if($meta_box_value != "")      
            $meta_box['std'] = $meta_box_value;//将默认值替换为以保存的值   
           
        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';   
        //通过选择类型输出不同的html代码   
        switch ( $meta_box['type'] ){  
						
            case 'title':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                break;   
            case 'text':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                echo '<input type="text" size="40" name="'.$meta_box['name'].'_value" value="'.$meta_box['std'].'" /><br />';   
                break; 
				
			case 'uploader':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                echo '<input class="metabox_upload_input" type="text" size="80" value="'.$meta_box['std'].'" name="'.$meta_box['name'].'_value"/>';   
                echo '<input type="button" value="上傳" class="metabox_upload_bottom"/>';
				echo '<br/>';  
				 //图片预览框   
                if($meta_box['std'] != ''){   
                echo '<span id="'.$meta_box['name'].'_value_img"><img src='.$meta_box['std'].' alt="" /></span>';}  
				wp_enqueue_script('kriesi_custom_fields_js', get_template_directory_uri(). '/js/metaup.js');  
				 wp_enqueue_style( 'meta_box_css', get_stylesheet_directory_uri().'/includes/meta_box_style.css'); 
                break;  
			
            case 'textarea':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                echo '<textarea cols="60" rows="4" name="'.$meta_box['name'].'_value">'.$meta_box['std'].'</textarea><br />';   
                break;   
            case 'dropdown':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                if($meta_box['subtype'] == 'cat'){   
                    $select = 'Select category';   
                    $entries = get_categories('title_li=&orderby=name&hide_empty=0');//获取分类   
                }   
                echo '<p><select name="'.$meta_box['name'].'_value"> ';   
                echo '<option value="">'.$select .'</option>  ';   
                foreach ($entries as $key => $entry){   
                    $id = $entry->term_id;   
                    $title = $entry->name;   
                    if ( $meta_box['std'] == $id ){   
                        $selected = "selected='selected'";   
                    }else{   
                        $selected = "";   
                    }   
                    echo "<option $selected value='". $id."'>". $title."</option>";   
                }   
                echo '</select><br />';   
                break;   
            case 'radio':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                $counter = 1;   
                foreach( $meta_box['buttons'] as $radiobutton ) {   
                    $checked ="";   
                    if(isset($meta_box['std']) && $meta_box['std'] == $counter) {   
                        $checked = 'checked = "checked"';   
                    }   
                    echo '<input '.$checked.' type="radio" class="kcheck" value="'.$counter.'" name="'.$meta_box['name'].'_value"/>'.$radiobutton;   
                    $counter++;   
                }   
                break;   
            case 'checkbox':   
                echo'<h4>'.$meta_box['title'].'</h4>';   
                if( isset($meta_box['std']) && $meta_box['std'] == 'true' )   
                    $checked = 'checked = "checked"';   
                else  
                    $checked  = '';    
                echo '<input type="checkbox" id="'.$meta_box['name'].'_value"  class="metabox-checkbox" name="'.$meta_box['name'].'_value" value="true"  '.$checked.' /><div class="checkbox-wrapper"><label for="'.$meta_box['name'].'_value" class="metaboxcheckbox-label" ></label></div>';   


            break;   
			
               
        }             
    }      
}  

function create_meta_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '文章扩展', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}

function save_postdata( $post_id ) {   
    global $post, $new_meta_boxes;   
  
    foreach($new_meta_boxes as $meta_box) {   
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {   
            return $post_id;   
        }   
  
        if ( 'page' == $_POST['post_type'] ) {   
            if ( !current_user_can( 'edit_page', $post_id ))   
                return $post_id;   
        }    
        else {   
            if ( !current_user_can( 'edit_post', $post_id ))   
                return $post_id;   
        }   
  
        $data = $_POST[$meta_box['name'].'_value'];   
  
        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")   
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);   
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))   
            update_post_meta($post_id, $meta_box['name'].'_value', $data);   
        elseif($data == "")   
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_key,$meta_box['name'].'_value', true));   
    }   
}  

add_action('admin_menu', 'create_meta_box');   
add_action('save_post', 'save_postdata');  



?>
