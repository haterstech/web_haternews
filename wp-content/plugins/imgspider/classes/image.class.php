<?php


class WB_IMGSPY_Image
{

    public static function resize_image($img_file,$mime_type){



        if(!preg_match('#(jpg|jpeg|png)#',$mime_type)){
            return;
        }
        $config = WB_IMGSPY_Conf::opt();
        $rule = $config['rule'];

        if(!$rule || !$rule['size']){
            return;
        }
        $max_w = 0;
        if($rule['size']=='1'){
            $max_w = 1080;
        }else if($rule['size']=='2'){
            $max_w = 720;
        }else if($rule['size']=='3'){
            $max_w = intval($rule['custom_size']);
        }
        if(!$max_w){
            return;
        }

        if(apply_filters('wb_imgspy_resize_image',false,$img_file,$mime_type,$rule)){
            return true;
        }

        if(function_exists('getimagesize')){
            $size = getimagesize($img_file);
            if($size && $size[0]<=$max_w){//未超额
                return true;
            }
        }


        if(preg_match('#png#',$mime_type)){
            $fun = 'imagepng';
            if(!function_exists('imagecreatefrompng')){
                return false;
            }
            $img = imagecreatefrompng($img_file);
        }else{
            if(!function_exists('imagecreatefromjpeg')){
                return false;
            }
            $fun = 'imagejpeg';
            $img = imagecreatefromjpeg($img_file);
        }

        $s_w = imagesx($img);
        $s_h = imagesy($img);
        $rate = $s_w / $s_h;//100/100=1,100/200<1,200/100>1

        if($s_w<=$max_w){
            return true;
        }

        $w = $max_w;
        $h = (int)($w / $rate);


        $res = imagecreatetruecolor($w, $h);

        if($fun == 'imagepng'){
            $alpha = imagecolorallocatealpha($res, 0, 0, 0, 127);
            imagefill($res, 0, 0, $alpha);

        }

        imagecopyresampled($res, $img, 0, 0, 0, 0, $w, $h, $s_w, $s_h);

        if($fun == 'imagepng')
        {
            imagesavealpha($res, true);
        }


        if ($fun == 'imagejpeg') {
            $fun($res, $img_file, 80);
        } else {
            $fun($res, $img_file);
        }

        return true;

    }


}