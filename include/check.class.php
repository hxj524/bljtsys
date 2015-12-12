<?php
/**
 * DouPHP
 * --------------------------------------------------------------------------------------------------
 * 版权所有 2013-2015 漳州豆壳网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.douco.com
 * --------------------------------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。
 * 授权协议：http://www.douco.com/license.html
 * --------------------------------------------------------------------------------------------------
 * Author: DouCo
 * Release Date: 2015-10-16
 */
if (!defined('IN_DOUCO')) {
    die('Hacking attempt');
}
class Check {
    /**
     * 判断是否为rec操作项
     */
    function is_rec($rec) {
        if (preg_match("/^[a-z_]+$/", $rec)) {
            return true;
        }
    }

    /**
     * 判断是否为数字
     */
    function is_number($number) {
        if (preg_match("/^[0-9]+$/", $number)) {
            return true;
        }
    }
    
    /**
     * 判断是否为字母
     */
    function is_letter($letter) {
        if (preg_match("/^[a-z]+$/", $letter)) {
            return true;
        }
    }
    
    /**
     * 判断是否为字母、中文、数字
     */
    function is_text($text) {
        if (preg_match("/^[\x{4e00}-\x{9fa5}0-9a-zA-Z_]*$/u", $text)) {
            return true;
        }
    }
    
    /**
     * 判断别名是否规范
     */
    function is_unique_id($unique) {
        if (preg_match("/^[a-zA-Z0-9-]+$/", $unique)) {
            return true;
        }
    }
    
    /**
     * 检查是否包含中文字符且长度符合要求
     */
    function guestbook($value, $length) {
        $check_chinese = $GLOBALS['_CFG']['guestbook_check_chinese'] ? $this->if_include_chinese($value) : true;
        
        if ($check_chinese && $this->length($value, $length)) {
            return true;
        }
    }
    
    /**
     * 检查是否包含中文字符，防止垃圾信息
     */
    function if_include_chinese($value) {
        if (preg_match("/[\x{4e00}-\x{9fa5}]+/u", $value)) {
            return true;
        }
    }
    
    /**
     * 验证是否输入和输入长度
     */
    function length($value, $length) {
        if (strlen($value) > 0 && strlen($value) <= $length) {
            return true;
        }
    }
    
    /**
     * 判断验证码是否规范
     */
    function is_captcha($captcha) {
        if (preg_match("/^[A-Za-z0-9]{4}$/", $captcha)) {
            return true;
        }
    }

    /**
     * 判断是否为邮件地址
     */
    function is_email($email) {
        if (preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/", $email)) {
            return true;
        }
    }
    
    /**
     * 限制密码长度为6-32位
     */
    function is_password($password) {
        if (preg_match("/^.{6,}$/", $password)) {
            return true;
        }
    }
    
    /**
     * 判断是否为手机号码
     */
    function is_telphone($mobile) {
        if (preg_match("/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/", $mobile)) {
            return true;
        }
    }
    
    /**
     * 判断是否为QQ号码
     */
    function is_qq($qq) {
        if (preg_match("/^[1-9]*[1-9][0-9]*$/", $qq)) {
            return true;
        }
    }
}
?>