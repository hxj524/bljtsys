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
define('IN_DOUCO', true);

require ('../languages/zh_cn/admin/cloud.lang.php');
require (dirname(__FILE__) . '/include/init.php');

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

// 实例化
include_once (ROOT_PATH . ADMIN_PATH . '/include/cloud.class.php');
$dou_cloud = new Cloud('cache');

// 赋值给模板
$smarty->assign('rec', $rec);
$smarty->assign('cur', 'cloud');

/**
 * +----------------------------------------------------------
 * 扩展操作
 * +----------------------------------------------------------
 */
if ($rec == 'handle') {
    $smarty->assign('ur_here', $_LANG['cloud_handle']);

    // 验证并获取合法的ID
    $cloud_id = $check->is_extend_id($_REQUEST['cloud_id']) ? $_REQUEST['cloud_id'] : '';
    $type = $_REQUEST['type'];
    $mode = $check->is_letter($_REQUEST['mode']) ? $_REQUEST['mode'] : '';

    $smarty->assign('type', $_LANG['cloud_' . $type]);
    $smarty->assign('cloud_id', $cloud_id);
    $smarty->assign('mode', $mode);
    
    $smarty->display('cloud.htm');
    $GLOBALS['dou_cloud']->handle($type, $cloud_id, $mode);
} 

/**
 * +----------------------------------------------------------
 * 详细介绍弹出框
 * +----------------------------------------------------------
 */
elseif ($rec == 'details') {
    echo '<div id="douFrame"><div class="bg" onclick="douRemove('."'douFrame'".')"></div><div class="frame details"><h2><a href="javascript:void(0)" class="close" onclick="douRemove('."'douFrame'".')">X</a>'.$_POST['name'].'</h2><div class="content"><iframe frameborder="0" hspace="0" src="'.$_POST['frame'].'" width="100%" height="600">' . $_LANG['cloud_frame_cue'] . '</iframe></div></div></div>';
} 

/**
 * +----------------------------------------------------------
 * 云购物车
 * +----------------------------------------------------------
 */
elseif ($rec == 'order') {
    // 验证并获取合法的REQUEST
    $cloud_id = $check->is_extend_id($_REQUEST['cloud_id']) ? $_REQUEST['cloud_id'] : '';
    $action = $check->is_rec($_REQUEST['action']) ? $_REQUEST['action'] : 'default';
    $type = $check->is_letter($_REQUEST['type']) ? $_REQUEST['type'] : '';
    
    $smarty->assign('ur_here', $_LANG['cloud_'.$type] . $_LANG['cloud_order']);

    // CSRF防御令牌生成
    if($action == 'default') $smarty->assign('token', $firewall->set_token('cloud_order'));

    // CSRF防御令牌验证
    if($action == 'checkout') {
        if ($firewall->check_token($_POST['token'], 'cloud_order', true)) {
            $dou->create_admin_log($_LANG['cloud_order'] . ': ' . $type . ': ' . $cloud_id);
        } else {
            $dou->dou_msg($_LANG['illegal'], 'index.php');
        }
    }

    $cloud_account = unserialize($_CFG['cloud_account']);
    if(function_exists('curl_init')) {
        $ch = curl_init();
        $data = array('type' => $type, 'action' => $action, 'cloud_id' => $cloud_id, 'user' => $cloud_account['user'], 'password' => $cloud_account['password']);
        curl_setopt($ch, CURLOPT_REFERER, "http://cloud.douco.com" );  
        curl_setopt($ch, CURLOPT_URL, 'http://cloud.douco.com/order/extend_client');  
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $cloud_html = curl_exec($ch);
        curl_close($ch);
    }
    
    // 模块链接
    switch ($type) {
        case 'plugin' : // 插件
            $module_link = 'plugin.php?rec=install';
            break;
        case 'theme' : // 模板
            $module_link = 'theme.php?rec=install';
            break;
        case 'mobile' : // 模板
            $module_link = 'mobile.php?rec=theme&act=install';
            break;
        default :
            $module_link = 'module.php';
    }
    
    $smarty->assign('module_link', $module_link);
    $smarty->assign('cloud_id', $cloud_id);
    $smarty->assign('action', $action);
    $smarty->assign('type', $type);
    $smarty->assign('cloud_html', $cloud_html);
    $smarty->display('cloud.htm');
} 

/**
 * +----------------------------------------------------------
 * 写入可更新数量
 * +----------------------------------------------------------
 */
elseif ($rec == 'update_number') {
    $update_number = array (
            "update" => $_POST['update'],
            "patch" => $_POST['patch'],
            "module" => $_POST['module'],
            "plugin" => $_POST['plugin'],
            "theme" => $_POST['theme'],
            "mobile" => $_POST['mobile']
    );

    // 将可更新数量零时写进数据库
    $new_update_number = serialize($update_number);
    $GLOBALS['dou']->query("UPDATE " . $GLOBALS['dou']->table('config') . " SET value = '$new_update_number' WHERE name = 'update_number'");
} 
?>