<?php /* Smarty version 2.6.26, created on 2015-12-12 16:17:30
         compiled from plugin.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_tpl_vars['lang']['home']; ?>
<?php if ($this->_tpl_vars['ur_here']): ?> - <?php echo $this->_tpl_vars['ur_here']; ?>
 <?php endif; ?></title>
<meta name="Copyright" content="Douco Design." />
<link href="templates/public.css" rel="stylesheet" type="text/css">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "javascript.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>
<body>
<div id="dcWrap">
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <div id="dcLeft"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
 <div id="dcMain">
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ur_here.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   <div class="mainBox" style="<?php echo $this->_tpl_vars['workspace']['height']; ?>
">
   <?php if ($this->_tpl_vars['rec'] == 'default'): ?>
   <h3><?php echo $this->_tpl_vars['ur_here']; ?>
</h3>
   <ul class="tab">
    <li><a href="plugin.php" class="selected"><?php echo $this->_tpl_vars['lang']['plugin_list']; ?>
</a></li>
    <li><a href="plugin.php?rec=install"><?php echo $this->_tpl_vars['lang']['plugin_install']; ?>
<?php if ($this->_tpl_vars['unum']['theme']): ?><span class="unum"><span><?php echo $this->_tpl_vars['unum']['theme']; ?>
</span></span><?php endif; ?></a></li>
   </ul>
   <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
    <tr>
     <th width="100" align="left"><?php echo $this->_tpl_vars['lang']['plugin_name']; ?>
</th>
     <th align="left"><?php echo $this->_tpl_vars['lang']['plugin_description']; ?>
</th>
     <th width="60" align="center"><?php echo $this->_tpl_vars['lang']['plugin_ver']; ?>
</th>
     <th width="80" align="center"><?php echo $this->_tpl_vars['lang']['handler']; ?>
</th>
    </tr>
    <?php $_from = $this->_tpl_vars['plugin_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plugin']):
?>
    <tr <?php if ($this->_tpl_vars['plugin']['if_read'] == '0'): ?>class="unread"<?php endif; ?>>
     <td valign="top"><?php echo $this->_tpl_vars['plugin']['name']; ?>
</td>
     <td valign="top"><?php echo $this->_tpl_vars['plugin']['description']; ?>
</td>
     <td align="center" valign="top"><?php echo $this->_tpl_vars['plugin']['ver']; ?>
</td>
     <td align="center" valign="top">
      <?php if ($this->_tpl_vars['plugin']['enabled']): ?>
      <a href="plugin.php?rec=disable&unique_id=<?php echo $this->_tpl_vars['plugin']['unique_id']; ?>
"><?php echo $this->_tpl_vars['lang']['plugin_disable']; ?>
</a> | <a href="plugin.php?rec=edit&unique_id=<?php echo $this->_tpl_vars['plugin']['unique_id']; ?>
"><?php echo $this->_tpl_vars['lang']['edit']; ?>
</a>
      <?php else: ?>
      <a href="plugin.php?rec=enable&unique_id=<?php echo $this->_tpl_vars['plugin']['unique_id']; ?>
"><?php echo $this->_tpl_vars['lang']['plugin_enable_btn']; ?>
</a> | <a href="plugin.php?rec=del&unique_id=<?php echo $this->_tpl_vars['plugin']['unique_id']; ?>
"><?php echo $this->_tpl_vars['lang']['del']; ?>
</a>
      <?php endif; ?>
     </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
   </table>
   <?php endif; ?>
   <?php if ($this->_tpl_vars['rec'] == 'install'): ?>
   <h3><?php echo $this->_tpl_vars['ur_here']; ?>
</h3>
   <ul class="tab">
    <li><a href="plugin.php"><?php echo $this->_tpl_vars['lang']['plugin_list']; ?>
</a></li>
    <li><a href="plugin.php?rec=install" class="selected"><?php echo $this->_tpl_vars['lang']['plugin_install']; ?>
</a></li>
   </ul>
   <div class="selector"></div>
   <div class="cloudList">
   </div>
   <script type="text/javascript">get_cloud_list('plugin', '<?php echo $this->_tpl_vars['get']; ?>
', '<?php echo $this->_tpl_vars['localsite']; ?>
')</script>
   <div class="pager"></div>
   <?php endif; ?>
   <?php if ($this->_tpl_vars['rec'] == 'enable' || $this->_tpl_vars['rec'] == 'edit'): ?>
   <h3><a href="<?php echo $this->_tpl_vars['action_link']['href']; ?>
" class="actionBtn"><?php echo $this->_tpl_vars['action_link']['text']; ?>
</a><?php echo $this->_tpl_vars['ur_here']; ?>
</h3>
   <form action="plugin.php?rec=<?php echo $this->_tpl_vars['form_action']; ?>
" method="post">
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
     <tr>
      <td width="90" align="right"><?php echo $this->_tpl_vars['lang']['plugin_name']; ?>
</td>
      <td>
       <input type="text" name="name" value="<?php echo $this->_tpl_vars['plugin']['name']; ?>
" size="50" class="inpMain" />
      </td>
     </tr>
     <tr>
      <td width="90" align="right"><?php echo $this->_tpl_vars['lang']['plugin_description']; ?>
</td>
      <td>
       <textarea name="description" cols="70" rows="5" class="textArea" /><?php echo $this->_tpl_vars['plugin']['description']; ?>
</textarea>
      </td>
     </tr>
     <?php $_from = $this->_tpl_vars['plugin']['config']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['config']):
?>
     <tr>
      <td align="right"><?php echo $this->_tpl_vars['config']['name']; ?>
</td>
      <td>
       <?php if ($this->_tpl_vars['config']['type'] == 'select'): ?>
       <select name="config[<?php echo $this->_tpl_vars['config']['field']; ?>
]">
        <?php $_from = $this->_tpl_vars['config']['option']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['value']):
?>
        <option value="<?php echo $this->_tpl_vars['value']; ?>
"<?php if ($this->_tpl_vars['config']['value'] == $this->_tpl_vars['value']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
       </select>
       <?php elseif ($this->_tpl_vars['config']['type'] == 'textarea'): ?>
       <textarea name="config[<?php echo $this->_tpl_vars['config']['field']; ?>
]" cols="70" rows="5" class="textArea" /><?php echo $this->_tpl_vars['config']['value']; ?>
</textarea>
       <?php else: ?>
       <input type="text" name="config[<?php echo $this->_tpl_vars['config']['field']; ?>
]" value="<?php echo $this->_tpl_vars['config']['value']; ?>
" size="50" class="inpMain" />
       <?php endif; ?>
       <?php if ($this->_tpl_vars['config']['desc']): ?> <p class="cue"><?php echo $this->_tpl_vars['config']['desc']; ?>
</p><?php endif; ?>
      </td>
     </tr>
     <?php endforeach; endif; unset($_from); ?>
     <tr>
      <td></td>
      <td>
       <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
       <input type="hidden" name="unique_id" value="<?php echo $this->_tpl_vars['plugin']['unique_id']; ?>
">
       <input type="hidden" name="plugin_group" value="<?php echo $this->_tpl_vars['plugin']['plugin_group']; ?>
">
       <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
      </td>
     </tr>
    </table>
   </form>
   <?php endif; ?> 
   </div>
 </div>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 </div>
</body>
</html>