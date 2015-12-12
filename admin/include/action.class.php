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
class Action extends Common {
    /**
     * +----------------------------------------------------------
     * 初始化工作空间
     * +----------------------------------------------------------
     */
    function dou_workspace() {
        $menu_list = $this->get_menu_list();
        $workspace['menu_column'] = $menu_list['column'];
        $workspace['menu_single'] = $menu_list['single'];
        $workspace['menu_simple'] = $this->get_menu_page();
        
        // 可更新数量
        $number = unserialize($GLOBALS['_CFG']['update_number']);
        $number['system'] = $number['update'] + $number['patch'];
        $GLOBALS['smarty']->assign('unum', $number);
        
        // 计算工作空间高度
        if ($GLOBALS['_MODULE']['all']) {
            $height = (count($menu_list['single']) * 43) + (count($menu_list['column']) * 86) + 280;
        } else {
            $record_count = mysql_num_rows($this->query("SELECT * FROM " . $this->table('page')));
            $height = $record_count * 43 + 280;
        }
        $height = $height < 550 ? 550 : $height;
        $workspace['height'] = 'height:auto!important;height:'.$height.'px;min-height:'.$height.'px;';
        
        return $workspace;
    }
    
    /**
     * +----------------------------------------------------------
     * 本地站点信息，在线安装时使用
     * +----------------------------------------------------------
     * $type 类型
     * +----------------------------------------------------------
     */
    function dou_localsite($type = '') {
        if ($type) {
            $update_date = unserialize($GLOBALS['_CFG']['update_date']);
            $localsite = $update_date[$type];
        } else {
            $localsite = unserialize($GLOBALS['_CFG']['update_date']);
        }
        
        $cloud_account = unserialize($GLOBALS['_CFG']['cloud_account']);
        $localsite['cloud_account'] = array('user' => $cloud_account['user'], 'password' => $cloud_account['password']);
        return urlencode(serialize($localsite));
    }

    /**
     * +----------------------------------------------------------
     * 用户权限判断
     * +----------------------------------------------------------
     */
    function admin_check($user_id, $shell, $action_list = ALL) {
        if (!defined('NO_CHECK')) {
            if ($row = $this->admin_state($user_id, $shell)) {
                $this->admin_ontime(10800);
                if (is_array($row)) {
                    $user = array (
                            'user_id' => $row['user_id'],
                            'user_name' => $row['user_name'],
                            'email' => $row['email'],
                            'action_list' => $row['action_list'] 
                    );
                    
                    return $user;
                }
            } else {
                $this->dou_header(ROOT_URL . ADMIN_PATH . '/login.php');
            }
        }
    }
    
    /**
     * +----------------------------------------------------------
     * 用户状态
     * +----------------------------------------------------------
     */
    function admin_state($user_id, $shell) {
        $query = $this->select($this->table('admin'), '*', '`user_id` = \'' . $user_id . '\'');
        $user = $this->fetch_array($query);
        
        // 如果$user则开始比对$shell值
        $check_shell = is_array($user) ? $shell == md5($user['user_name'] . $user['password'] . DOU_SHELL) : FALSE;
        
        // 如果比对$shell吻合，则返回会员信息，否则返回空
        return $check_shell ? $user : NULL;
    }
    
    /**
     * +----------------------------------------------------------
     * 登录超时默认为3小时(10800秒)
     * +----------------------------------------------------------
     */
    function admin_ontime($timeout = '10800') {
        $ontime = $_SESSION[DOU_ID]['ontime'];
        $cur_time = time();
        if ($cur_time - $ontime > $timeout) {
            unset($_SESSION[DOU_ID]);
        } else {
            $_SESSION[DOU_ID]['ontime'] = time();
        }
    }
    
    /**
     * +----------------------------------------------------------
     * 找回密码验证
     * +----------------------------------------------------------
     * $user_id 会员ID
     * $code 密码找回码
     * $timeout 默认为24小时(86400秒)
     * +----------------------------------------------------------
     */
    function check_password_reset($user_id, $code, $timeout = 86400) {
        if ($GLOBALS['dou']->value_exist('admin', 'user_id', $user_id)) {
            $user = $GLOBALS['dou']->fetch_array($GLOBALS['dou']->select($GLOBALS['dou']->table('admin'), '*', "user_id = '$user_id'"));
            
            // 初始化
            $get_code = substr($code , 0 , 16);
            $get_time = substr($code , 16 , 26);
            $code = substr(md5($user['user_name'] . $user['email'] . $user['password'] . $get_time . $user['last_login'] . DOU_SHELL) , 0 , 16);
            
            // 验证链接有效性
            if (time() - $get_time < $timeout && $code == $get_code) return true;
        }
    }
    
    /**
     * +----------------------------------------------------------
     * 获取导航菜单
     * +----------------------------------------------------------
     * $type 导航类型
     * $parent_id 默认获取一级导航
     * $level 无限极分类层次
     * $current_id 当前页面栏目ID
     * $mark 无限极分类标记
     * +----------------------------------------------------------
     */
    function get_nav($type = 'middle', $parent_id = 0, $level = 0, $current_id = '', &$nav = array(), $mark = '-') {
        $data = $this->fetch_array_all($this->table('nav'), 'sort ASC');
        foreach ((array) $data as $value) {
            if ($value['parent_id'] == $parent_id && $value['type'] == $type && $value['id'] != $current_id) {
                if ($value['module'] != 'nav') {
                    $value['guide'] = $this->rewrite_url($value['module'], $value['guide']);
                }
                
                $value['mark'] = str_repeat($mark, $level);
                $nav[] = $value;
                $this->get_nav($type, $value['id'], $level + 1, $current_id, $nav);
            }
        }
        return $nav;
    }
    
    /**
     * +----------------------------------------------------------
     * 生成模块后台菜单
     * +----------------------------------------------------------
     */
    function get_menu_list() {
        foreach ($GLOBALS['_MODULE']['column'] as $value) {
            $menu_list['column'][] = array (
                    'name_category' => $value . '_category',
                    'lang_category' => $GLOBALS['_LANG'][$value . '_category'],
                    'name' => $value,
                    'lang' => $GLOBALS['_LANG'][$value]
            );
        }

        foreach ($GLOBALS['_MODULE']['single'] as $value) {
            $menu_list['single'][] = array (
                    'name' => $value,
                    'lang' => $GLOBALS['_LANG'][$value]
            );
        }
        
        return $menu_list;
    }

    /**
     * +----------------------------------------------------------
     * 获取有层次的栏目分类，有几层分类就创建几维数组
     * +----------------------------------------------------------
     * $parent_id 默认获取一级导航
     * $current_id 当前页面栏目ID
     * +----------------------------------------------------------
     */
    function get_menu_page($parent_id = 0, $current_id = '') {
        $menu_page = array ();
        $query = $this->query("SELECT id, unique_id, parent_id, page_name FROM " . $this->table('page') . " ORDER BY id ASC");
        while ($row = $this->fetch_assoc($query)) {
            $data[] = $row;
        }
        foreach ((array) $data as $value) {
            // $parent_id将在嵌套函数中随之变化
            if ($value['parent_id'] == $parent_id) {
                $value['cur'] = $value['id'] == $current_id ? true : false;
                
                foreach ($data as $child) {
                    // 筛选下级导航
                    if ($child['parent_id'] == $value['id']) {
                        // 嵌套函数获取子分类
                        $value['child'] = $this->get_menu_page($value['id'], $current_id);
                        break;
                    }
                }
                $menu_page[] = $value;
            }
        }
        
        return $menu_page;
    }

    /**
     * +----------------------------------------------------------
     * 获取整站目录数据
     * +----------------------------------------------------------
     */
    function get_catalog($module = '', $id = '') {
        // 单页面列表
        foreach ($this->get_page_nolevel() as $row) {
            $catalog[] = array (
                    "name" => $row['page_name'],
                    "module" => 'page',
                    "guide" => $row['id'],
                    "cur" => ($module == 'page' && $id == $row['id']) ? true : false,
                    "mark" => '-' . $row['mark'] 
            );
        }
        
        // 栏目模块
        foreach ($GLOBALS['_MODULE']['column'] as $module_id) {
            $catalog[] = array (
                    "name" => $GLOBALS['_LANG']['nav_' . $module_id],
                    "module" => $module_id . '_category',
                    "cur" => ($module == $module_id . '_category' && $id == 0) ? true : false,
                    "guide" => 0 
            );
            foreach ($this->get_category_nolevel($module_id . '_category') as $row) {
                $catalog[] = array (
                        "name" => $row['cat_name'],
                        "module" => $module_id . '_category',
                        "guide" => $row['cat_id'],
                        "cur" => ($module == $module_id . '_category' && $id == $row['cat_id']) ? true : false,
                        "mark" => '-' . $row['mark'] 
                );
            }
        }

        // 简单模块
        foreach ($GLOBALS['_MODULE']['single'] as $module_id) {
        // 不显示的模块
        $no_show = 'plugin';
            if (!in_array($module_id, explode('|', $no_show))) {
                $catalog[] = array (
                        "name" => $GLOBALS['_LANG'][$module_id],
                        "module" => $module_id,
                        "cur" => ($module == $module_id && $id == 0) ? true : false,
                        "guide" => 0
                );
            }
        }
        
        return $catalog;
    }
    
    /**
     * +----------------------------------------------------------
     * 批量移动分类
     * +----------------------------------------------------------
     * $module 模块名称及数据表名
     * $checkbox 要批量处理的ID合集
     * $new_cate_id 要移动到哪个分类
     * +----------------------------------------------------------
     */
    function category_move($module, $checkbox, $new_cate_id) {
        $sql_in = $this->create_sql_in($_POST['checkbox']);
        
        // 移动分类操作
        $this->query("UPDATE " . $this->table($module) . " SET cat_id = '$new_cate_id' WHERE id " . $sql_in);
        
        $this->create_admin_log($GLOBALS['_LANG']['category_move_batch'] . ': ' . strtoupper($module) . ' ' . addslashes($sql_in));
        $this->dou_msg($GLOBALS['_LANG']['category_move_batch_succes'], $module . '.php');
    }
    
    /**
     * +----------------------------------------------------------
     * 批量删除
     * +----------------------------------------------------------
     */
    function del_all($module, $checkbox, $field_filter, $field_image = '') {
        $sql_in = $this->create_sql_in($_POST['checkbox']);
        
        // 删除相应图片
        if ($field_image) {
            $sql = "SELECT " . $field_image . " FROM " . $this->table($module) . " WHERE " . $field_filter . " " . $sql_in;
            $query = $this->query($sql);
            while ($row = $this->fetch_array($query)) {
                $this->del_image($row[$field_image]);
            }
        }
        
        // 从数据库中删除所选内容
        $this->query("DELETE FROM " . $this->table($module) . " WHERE " . $field_filter . " " . $sql_in);
        
        $this->create_admin_log($GLOBALS['_LANG']['del_all'] . ': ' . strtoupper($module) . ' ' . addslashes($sql_in));
        $this->dou_msg($GLOBALS['_LANG']['del_succes'], $module . '.php');
    }
    
    /**
     * +----------------------------------------------------------
     * 删除图片
     * +----------------------------------------------------------
     */
    function del_image($image) {
        $no_ext = explode(".", $image);
        $image_thumb = $no_ext[0] . '_thumb' . '.' . $no_ext[1];
        @unlink(ROOT_PATH . $image);
        @unlink(ROOT_PATH . $image_thumb);
    }
    
    /**
     * +----------------------------------------------------------
     * 获取管理员日志
     * +----------------------------------------------------------
     * $action 管理员操作的内容
     * +----------------------------------------------------------
     */
    function create_admin_log($action) {
        $create_time = time();
        $ip = $this->get_ip();
        
        $sql = "INSERT INTO " . $this->table('admin_log') . " (id, create_time, user_id, action ,ip)" . " VALUES (NULL, '$create_time', " .
                 $_SESSION[DOU_ID]['user_id'] . ", '$action', '$ip')";
        $this->query($sql);
    }
    
    /**
     * +----------------------------------------------------------
     * 获取管理员日志
     * +----------------------------------------------------------
     * $user_id 管理员ID
     * $num 调用日志数量
     * +----------------------------------------------------------
     */
    function get_admin_log($user_id = '', $num = '') {
        if ($user_id) {
            $where = " WHERE user_id = '$user_id'";
        }
        if ($num) {
            $limit = " LIMIT $num";
        }
        
        $sql = "SELECT * FROM " . $this->table('admin_log') . $where . " ORDER BY id DESC" . $limit;
        $query = $this->query($sql);
        while ($row = $this->fetch_array($query)) {
            $create_time = date("Y-m-d H:i:s", $row['create_time']);
            $user_name = $this->get_one("SELECT user_name FROM " . $this->table('admin') . " WHERE user_id = " . $row['user_id']);
            
            $log_list[] = array (
                    "id" => $row['id'],
                    "create_time" => $create_time,
                    "user_name" => $user_name,
                    "action" => $row['action'],
                    "ip" => $row['ip'] 
            );
        }
        
        return $log_list;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取当前目录子文件夹
     * +----------------------------------------------------------
     * $dir 要检索的目录
     * +----------------------------------------------------------
     */
    function get_subdirs($dir) {
        $subdirs = array();
        if (!$handle  = @opendir($dir)) return $subdirs;
        
        while ($file = @readdir($handle )) {
            if ($file == '.' || $file == '..') continue; // 排除掉当前目录和上一个目录
            $subdirs[] = $file;
        }
        return $subdirs;
    }
    
    /**
     * +----------------------------------------------------------
     * 清除缓存及已编译模板
     * +----------------------------------------------------------
     * $dir 要删除的目录
     * +----------------------------------------------------------
     */
    function dou_clear_cache($dir) {
        $dir = realpath($dir);
        if (!$dir || !@is_dir($dir))
            return 0;
        $handle = @opendir($dir);
        if ($dir[strlen($dir) - 1] != DIRECTORY_SEPARATOR)
            $dir .= DIRECTORY_SEPARATOR;
        while ($file = @readdir($handle)) {
            if ($file != '.' && $file != '..') {
                if (@is_dir($dir . $file) && !is_link($dir . $file))
                    $this->dou_clear_cache($dir . $file);
                else
                    @unlink($dir . $file);
            }
        }
        closedir($handle);
    }
    
    /**
     * +----------------------------------------------------------
     * 删除目录及目录下所有子目录和文件
     * +----------------------------------------------------------
     * $dir 要删除的目录
     * $sub_dir 只删除子目录
     * +----------------------------------------------------------
     */
    function del_dir($dir, $sub_dir = false) {
        if ($handle = @opendir($dir)) {
           // 删除目录下子目录和文件
           while (false !== ($item = @readdir($handle))) {  
               if ($item != '.' && $item != '..') {  
                   if (is_dir( "$dir/$item")) {  
                       $this->del_dir("$dir/$item");  
                   } else {  
                       @unlink("$dir/$item");  
                   }  
               }  
           }  
           closedir($handle);
           
           // 删除目录本身
           if (!$sub_dir) @rmdir($dir);  
        } 
    }
    
    /**
     * +----------------------------------------------------------
     * 获取模板信息
     * +----------------------------------------------------------
     * $unique_id 模板ID
     * $is_mobile 是否是手机版
     * +----------------------------------------------------------
     */
    function get_theme_info($unique_id, $is_mobile = false) {
        $theme_url = $is_mobile ? M_PATH.'/theme/' : 'theme/';
        $content = file(ROOT_PATH . $theme_url . $unique_id . '/style.css');
        foreach ($content as $line) {
            if (strpos($line, '/*') !== false) continue;
            if (strpos($line, '*/') !== false) break;
            
            $line = preg_replace('/:/', '#', $line, 1); // 使用'#'作为分隔符，避免把网址中的':'也给分割了
            $arr = explode('#', trim($line));
            $key = str_replace(' ', '_', strtolower($arr[0]));
            $info[$key] = trim($arr[1]);
        }
        $info['unique_id'] = $unique_id;
        $info['image'] = ROOT_URL . $theme_url . $unique_id . '/images/screenshot.png';
        
        return $info;
    }

    /**
     * +----------------------------------------------------------
     * 给URL自动上http://
     * +----------------------------------------------------------
     * $url 网址
     * +----------------------------------------------------------
     */
    function auto_http($url) {
        if (strpos($url, 'http://') !== false || strpos($url, 'https://') !== false) {
            $url = trim($url);
        } else {
            $url = 'http://' . trim($url);
        }
        return $url;
    }
    
    /**
     * +----------------------------------------------------------
     * 版本升级提示
     * +----------------------------------------------------------
     */
    function dou_api() {
        global $_CFG;
        global $sys_info;
        
        $apiget = "ver=$_CFG[douphp_version]&update=$sys_info[update]&patch=$sys_info[patch]&lang=$_CFG[language]&php_ver=$sys_info[php_ver]&mysql_ver=$sys_info[mysql_ver]&os=$sys_info[os]&web_server=$sys_info[web_server]&charset=$sys_info[charset]&template=$_CFG[site_theme]&url=" . ROOT_URL;
        return "http://api.douco.com/update.php" . '?' . $apiget;
    }
    
    /**
     * +----------------------------------------------------------
     * 创建IN查询如"IN('1','2')";
     * +----------------------------------------------------------
     * $arr 要处理成IN查询的数组
     * +----------------------------------------------------------
     */
    function create_sql_in($arr) {
        foreach ((array) $arr as $list) {
            $sql_in .= $sql_in ? ",'$list'" : "'$list'";
        }
        return "IN ($sql_in)";
    }
    
    /**
     * +----------------------------------------------------------
     * 后台通用信息提示
     * +----------------------------------------------------------
     * $text 提示的内容
     * $url 提示后要跳转的网址
     * $out 管理员登录操作时的提示页面
     * $time 多久时间跳转
     * $check 删除确认按钮的链接
     * +----------------------------------------------------------
     */
    function dou_msg($text, $url = '', $out = '', $time = 3, $check = '') {
        if (!$text) {
            $text = $GLOBALS['_LANG']['dou_msg_success'];
        }
        
        $GLOBALS['smarty']->assign('ur_here', $GLOBALS['_LANG']['dou_msg']);
        $GLOBALS['smarty']->assign('text', $text);
        $GLOBALS['smarty']->assign('url', $url);
        $GLOBALS['smarty']->assign('out', $out);
        $GLOBALS['smarty']->assign('time', $time);
        $GLOBALS['smarty']->assign('check', $check);
        
        // 根据跳转时间生成跳转提示
        $cue = preg_replace('/d%/Ums', $time, $GLOBALS['_LANG']['dou_msg_cue']);
        $GLOBALS['smarty']->assign('cue', $cue);
        
        $GLOBALS['smarty']->display('dou_msg.htm');
        exit();
    }
}
?>