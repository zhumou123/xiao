<?php

/* 公用函数 */
require_once('function.php');

/* 增加自定义字段 */
if($_SERVER['SCRIPT_NAME']=="/admin/write-post.php"){
  function themeFields($layout){
    $img = new Typecho_Widget_Helper_Form_Element_Text(
      'img', NULL, NULL, _t('自定义缩略图（非必填）'), _t(
      '填写时：将会显示填写的文章缩略图 <br>不填写时：若文章有图片则取文章内图片'));
    $layout->addItem($img);
  }
}