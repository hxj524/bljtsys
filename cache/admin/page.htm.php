<?php /* Smarty version 2.6.26, created on 2015-12-09 19:18:50
         compiled from page.htm */ ?>
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
    <h3><a href="<?php echo $this->_tpl_vars['action_link']['href']; ?>
" class="actionBtn"><?php echo $this->_tpl_vars['action_link']['text']; ?>
</a><?php echo $this->_tpl_vars['ur_here']; ?>
</h3>
    <?php if ($this->_tpl_vars['rec'] == 'default'): ?>
    <div class="page">
     <?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page_list']):
?>
      <dl<?php if ($this->_tpl_vars['page_list']['level'] > 0): ?> class="child<?php echo $this->_tpl_vars['page_list']['level']; ?>
"<?php endif; ?>>
        <dt><strong><?php echo $this->_tpl_vars['page_list']['page_name']; ?>
</strong><p><?php echo $this->_tpl_vars['page_list']['unique_id']; ?>
</p></dt>
        <dd><a href="page.php?rec=edit&id=<?php echo $this->_tpl_vars['page_list']['id']; ?>
"><?php echo $this->_tpl_vars['lang']['edit']; ?>
</a> | <a href="page.php?rec=del&id=<?php echo $this->_tpl_vars['page_list']['id']; ?>
"><?php echo $this->_tpl_vars['lang']['del']; ?>
</a></dd>
      </dl>
     <?php endforeach; endif; unset($_from); ?>
    </div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['rec'] == 'add' || $this->_tpl_vars['rec'] == 'edit'): ?>
    <form action="page.php?rec=<?php echo $this->_tpl_vars['form_action']; ?>
" method="post">
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
       <td width="80" align="right"><?php echo $this->_tpl_vars['lang']['page_name']; ?>
</td>
       <td>
        <input type="text" name="page_name" value="<?php echo $this->_tpl_vars['page']['page_name']; ?>
" size="40" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td align="right"><?php echo $this->_tpl_vars['lang']['unique']; ?>
</td>
       <td>
        <input type="text" name="unique_id" value="<?php echo $this->_tpl_vars['page']['unique_id']; ?>
" size="40" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td align="right"><?php echo $this->_tpl_vars['lang']['parent']; ?>
</td>
       <td>
        <select name="parent_id">
         <option value="0"><?php echo $this->_tpl_vars['lang']['empty']; ?>
</option>
         <?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
         <?php if ($this->_tpl_vars['list']['id'] == $this->_tpl_vars['page']['parent_id']): ?>
         <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['list']['mark']; ?>
 <?php echo $this->_tpl_vars['list']['page_name']; ?>
</option>
         <?php else: ?>
         <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['mark']; ?>
 <?php echo $this->_tpl_vars['list']['page_name']; ?>
</option>
         <?php endif; ?>
         <?php endforeach; endif; unset($_from); ?>
        </select>
       </td>
      </tr>
      <tr>
       <td align="right"><?php echo $this->_tpl_vars['lang']['page_content']; ?>
</td>
       <td>
        <!-- KindEditor -->
        <script charset="utf-8" src="include/kindeditor/kindeditor.js"></script>
        <script charset="utf-8" src="include/kindeditor/lang/zh_CN.js"></script>
        <script>
        <?php echo '
         var editor;
         KindEditor.ready(function(K) {
             editor = K.create(\'#content\');
         });
        '; ?>

        </script>
        <!-- /KindEditor -->
        <textarea id="content" name="content" style="width:780px;height:400px;" class="textArea"><?php echo $this->_tpl_vars['page']['content']; ?>
</textarea>
       </td>
      </tr>
      <tr>
       <td align="right"><?php echo $this->_tpl_vars['lang']['keywords']; ?>
</td>
       <td>
        <input type="text" name="keywords" value="<?php echo $this->_tpl_vars['page']['keywords']; ?>
" size="90" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td align="right"><?php echo $this->_tpl_vars['lang']['description']; ?>
</td>
       <td>
        <input type="text" name="description" value="<?php echo $this->_tpl_vars['page']['description']; ?>
" size="90" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td></td>
       <td>
        <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['page']['id']; ?>
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