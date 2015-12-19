<?php /* Smarty version 2.6.26, created on 2015-12-12 14:29:10
         compiled from link.htm */ ?>
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
    <h3><?php echo $this->_tpl_vars['ur_here']; ?>
</h3>
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
    <tr>
       <th><?php echo $this->_tpl_vars['lang']['link_add']; ?>
</th>
       <th><?php echo $this->_tpl_vars['lang']['link_list']; ?>
</th>
     </tr>
     <tr>
      <td width="350" valign="top">
       <form action="link.php?rec=insert" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableOnebor">
         <tr>
          <td><?php echo $this->_tpl_vars['lang']['link_name']; ?>
<br>
<input type="text" name="link_name" value="" size="20" class="inpMain" />
          </td>
         </tr>
         <tr>
          <td><?php echo $this->_tpl_vars['lang']['link_link']; ?>

           <br>
           <input type="text" name="link_url" value="" size="40" class="inpMain" />
          </td>
         </tr>
         <tr>
          <td><?php echo $this->_tpl_vars['lang']['sort']; ?>
<br>
<input type="text" name="sort" value="50" size="20" class="inpMain" />
          </td>
         </tr>
         <tr>
          <td>
           <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
           <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
          </td>
         </tr>
        </table>
       </form>
      </td>
      <td valign="top">
       <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableOnebor">
        <form action="link.php?rec=update" method="post" enctype="multipart/form-data">
         <tr>
          <td><?php echo $this->_tpl_vars['lang']['link_name']; ?>
</td>
          <td width="50" align="center"><?php echo $this->_tpl_vars['lang']['sort']; ?>
</td>
          <td width="80" align="center"><?php echo $this->_tpl_vars['lang']['handler']; ?>
</td>
         </tr>
         <?php $_from = $this->_tpl_vars['link_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link_list']):
?>
         <?php if ($this->_tpl_vars['link_list']['id'] == $this->_tpl_vars['id']): ?>
         <tr>
          <td height="30" colspan="3"><strong><?php echo $this->_tpl_vars['lang']['link_edit']; ?>
</strong></td>
          </tr>
         <tr>
          <td colspan="3">
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
             <td><?php echo $this->_tpl_vars['lang']['link_name']; ?>
:
           <input type="text" name="link_name" value="<?php echo $this->_tpl_vars['link_list']['link_name']; ?>
" size="20" class="inpMain" /></td>
             <td align="right"><?php echo $this->_tpl_vars['lang']['sort']; ?>
:
     <input type="text" name="sort" value="<?php echo $this->_tpl_vars['link_list']['sort']; ?>
" size="20" class="inpMain" /></td>
            </tr>
           </table>
           
          </td>
          </tr>
         <tr>
          <td colspan="3"><?php echo $this->_tpl_vars['lang']['link_link']; ?>
:
           <input type="text" name="link_url" value="<?php echo $this->_tpl_vars['link_list']['link_url']; ?>
" size="55" class="inpMain" />
          </td>
         </tr>
         <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['link_list']['id']; ?>
">
         <tr>
          <td height="40" colspan="3">
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
             <td><a href="link.php"><?php echo $this->_tpl_vars['lang']['cancel']; ?>
</a></td>
             <td align="right">
             <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
             <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
             </td>
            </tr>
           </table>
          </td>
          </tr>
         <?php else: ?>
         <tr>
          <td><?php echo $this->_tpl_vars['link_list']['link_name']; ?>
</td>
          <td align="center"><?php echo $this->_tpl_vars['link_list']['sort']; ?>
</td>
          <td align="center"><a href="link.php?rec=edit&id=<?php echo $this->_tpl_vars['link_list']['id']; ?>
"><?php echo $this->_tpl_vars['lang']['edit']; ?>
</a> | <a href="link.php?rec=del&id=<?php echo $this->_tpl_vars['link_list']['id']; ?>
"><?php echo $this->_tpl_vars['lang']['del']; ?>
</a></td>
         </tr>
         <?php endif; ?>
         <?php endforeach; endif; unset($_from); ?>
        </form>
       </table>
      </td>
     </tr>
    </table>
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