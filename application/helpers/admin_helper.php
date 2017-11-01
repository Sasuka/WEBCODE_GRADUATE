<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 29/10/2017
 * Time: 18:04
 */
/*Tạo các link trong admin*/
function admin_url($url = ''){
    return base_url('admin/'.$url);
}