<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 29/9/2017
 * Time: 21:46
 * This file use admin and user
 */
//Path folder public
function public_url($url = ''){
    return base_url('public/'.$url);
}
//Path director folder upload
function upload_url($url = ''){
    return base_url('uploads/'.$url);
}
//Path director folder admin
//function admin_url($url = ''){
//    return base_url()
//}
function pre($list , $exit = true){
    echo '<pre>';
    print_r($list);
    if ($exit){
        die();
    }
}