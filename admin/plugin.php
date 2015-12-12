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

require (dirname(__FILE__) . '/include/init.php');

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

// 插件目录
$plugin_dir = ROOT_PATH . 'include/plugin/';

// 赋值给模板
$smarty->assign('rec', $rec);
$smarty->assign('cur', 'plugin');

/**
 * +----------------------------------------------------------
 * 插件列表
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    $dir_array = $dou->get_subdirs($plugin_dir);
    foreach ($dir_array as $dir_name) {
        if (file_exists($setting_file = $plugin_dir . $dir_name . '/setting.plugin.php')) {
            require ($setting_file); // 载入插件设置文件
            $enabled = $dou->get_one("SELECT unique_id FROM " . $dou->table('plugin') . " WHERE unique_id = '$plugin[unique_id]'");
    
            $plugin_list[] = array (
                    "unique_id" => $plugin['unique_id'],
                    "name" => $plugin['name'],
                    "description" => $plugin['description'],
                    "ver" => $plugin['ver'],
                    "enabled" => $enabled
            );
        }
    }
 
    $smarty->assign('plugin_list', $plugin_list);
    $smarty->assign('ur_here', $_LANG['plugin']);

    $smarty->display('plugin.htm');
} 

/**
 * +----------------------------------------------------------
 * 在线安装插件
 * +----------------------------------------------------------
 */
if ($rec == 'install') {
    $smarty->assign('ur_here', $_LANG['plugin']);

    $smarty->assign('get', urlencode(serialize($_GET)));
    $smarty->assign('localsite', $dou->dou_localsite('plugin'));

    $smarty->display('plugin.htm');
} 

/**
 * +----------------------------------------------------------
 * 插件启用
 * +----------------------------------------------------------
 */
if ($rec == 'enable') {
    $smarty->assign('ur_here', $_LANG['plugin_enable']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['plugin'],
            'href' => 'plugin.php' 
    ));

    // 验证并获取合法的ID
    $unique_id = $check->is_extend_id($_REQUEST['unique_id']) ? $_REQUEST['unique_id'] : '';

    require ($plugin_dir . $unique_id . '/setting.plugin.php'); // 载入插件设置文件

    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('plugin_enable'));
 
    // 赋值给模板
    $smarty->assign('form_action', 'insert');
    $smarty->assign('plugin', $plugin);

    $smarty->display('plugin.htm');
} 

if ($rec == 'insert') {
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'plugin_enable');

    $config = serialize($_POST['config']);
    $sql = "INSERT INTO " . $dou->table('plugin') . " (unique_id, name, config, plugin_group, description)" . " VALUES ('$_POST[unique_id]', '$_POST[name]', '$config', '$_POST[plugin_group]', '$_POST[description]')";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['plugin_enable'] . ': ' . $_POST['name']);
    $dou->dou_msg($_LANG['plugin_enable_succes'], 'plugin.php');
} 


/**
 * +----------------------------------------------------------
 * 插件编辑
 * +----------------------------------------------------------
 */
elseif ($rec == 'edit') {
    $smarty->assign('ur_here', $_LANG['plugin_edit']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['plugin'],
            'href' => 'plugin.php' 
    ));
    
    // 验证并获取合法的ID
    $unique_id = $check->is_extend_id($_REQUEST['unique_id']) ? $_REQUEST['unique_id'] : '';
    
    $plugin_mysql = $dou->fetch_array($dou->select($dou->table('plugin'), '*', '`unique_id` = \'' . $unique_id . '\''));
    $plugin_mysql['config'] = unserialize($plugin_mysql['config']);

    require ($plugin_dir . $unique_id . '/setting.plugin.php'); // 载入插件设置文件
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('plugin_edit'));
    
    // 赋值给模板
    $smarty->assign('form_action', 'update');
    $smarty->assign('plugin', $plugin);
    $smarty->assign('plugin_mysql', $plugin_mysql);
    
    $smarty->display('plugin.htm');
} 

elseif ($rec == 'update') {
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'plugin_edit');
    
    $config = serialize($_POST['config']);
    $sql = "UPDATE " . $dou->table('plugin') . " SET name = '$_POST[name]', config = '$config', plugin_group = '$_POST[plugin_group]', description = '$_POST[description]' WHERE unique_id = '$_POST[unique_id]'";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['plugin_edit'] . ': ' . $_POST['name']);
    $dou->dou_msg($_LANG['plugin_edit_succes'], 'plugin.php');
} 

/**
 * +----------------------------------------------------------
 * 停用插件
 * +----------------------------------------------------------
 */
elseif ($rec == 'disable') {
    // 验证并获取合法的ID
    $unique_id = $check->is_extend_id($_REQUEST['unique_id']) ? $_REQUEST['unique_id'] : '';
    $name = $dou->get_one("SELECT name FROM " . $dou->table('plugin') . " WHERE unique_id = '$unique_id'");
    
    $dou->create_admin_log($_LANG['plugin_disable_succes'] . ': ' . $name);
    $dou->delete($dou->table('plugin'), "unique_id = '$unique_id'");
    $dou->dou_header('plugin.php');
} 

/**
 * +----------------------------------------------------------
 * 删除插件
 * +----------------------------------------------------------
 */
elseif ($rec == 'del') {
    if ($check->is_extend_id($unique_id = $_REQUEST['unique_id'])) {
        // 载入扩展功能
        include_once (ROOT_PATH . ADMIN_PATH . '/include/cloud.class.php');
        $dou_cloud = new Cloud('cache');
    
        if (isset($_POST['confirm']) ? $_POST['confirm'] : '') {
            $plugin_array = $dou->get_subdirs($plugin_dir);
            if (in_array($unique_id, $plugin_array)) { // 判断删除操作的插件是否真实存在
                $dou->del_dir($plugin_dir . $unique_id);
                $dou_cloud->change_updatedate('plugin', $unique_id, true); // 删除更新时间记录
                $dou->create_admin_log($_LANG['plugin_del'] . ': ' . $unique_id);
                $dou->dou_header('plugin.php');
            }
        } else {
            $_LANG['del_check'] = preg_replace('/d%/Ums', $unique_id, $_LANG['del_check']);
            $dou->dou_msg($_LANG['del_check'], 'plugin.php', '', '30', "plugin.php?rec=del&unique_id=$unique_id");
        }
    } else {
        $dou->dou_header('plugin.php');
    }
} 
?>