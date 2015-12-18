<?php /* Smarty version 2.6.26, created on 2015-12-17 22:25:32
         compiled from inc/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'inc/header.tpl', 38, false),)), $this); ?>
<div id="top">
 <div class="wrap">
  <?php if ($this->_tpl_vars['open']['user']): ?>
  <ul class="userTop">
   <?php if ($this->_tpl_vars['user']): ?> 
   <a href="<?php echo $this->_tpl_vars['url']['user']; ?>
"><?php echo $this->_tpl_vars['user']['user_name']; ?>
，<?php echo $this->_tpl_vars['lang']['user_welcom_top']; ?>
</a><s></s><a href="<?php echo $this->_tpl_vars['url']['logout']; ?>
"><?php echo $this->_tpl_vars['lang']['user_logout']; ?>
</a> 
   <?php else: ?> 
   <a href="<?php echo $this->_tpl_vars['url']['login']; ?>
"><?php echo $this->_tpl_vars['lang']['user_login_nav']; ?>
</a><s></s><a href="<?php echo $this->_tpl_vars['url']['register']; ?>
"><?php echo $this->_tpl_vars['lang']['user_register_nav']; ?>
</a> 
   <?php endif; ?> 
  </ul>
  <?php endif; ?>
  <ul class="topNav">
   <?php $_from = $this->_tpl_vars['nav_top_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nav']):
?> 
   <?php if ($this->_tpl_vars['nav']['child']): ?>
   <li class="parent"><a href="<?php echo $this->_tpl_vars['nav']['url']; ?>
"><?php echo $this->_tpl_vars['nav']['nav_name']; ?>
<s></s></a>
    <ul>
     <?php $_from = $this->_tpl_vars['nav']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['child']):
?>
     <li><a href="<?php echo $this->_tpl_vars['child']['url']; ?>
"><?php echo $this->_tpl_vars['child']['nav_name']; ?>
</a></li>
     <?php endforeach; endif; unset($_from); ?>
    </ul>
   </li>
   <?php else: ?>
   <li><a href="<?php echo $this->_tpl_vars['nav']['url']; ?>
"<?php if ($this->_tpl_vars['nav']['target']): ?> target="_blank"<?php endif; ?>><?php echo $this->_tpl_vars['nav']['nav_name']; ?>
</a><s></s></li>
   <?php endif; ?> 
   <?php endforeach; endif; unset($_from); ?>
   <li><a href="javascript:AddFavorite('<?php echo $this->_tpl_vars['site']['root_url']; ?>
', '<?php echo $this->_tpl_vars['site']['site_name']; ?>
')"><?php echo $this->_tpl_vars['lang']['add_favorite']; ?>
</a></li>
  </ul>
 </div>
</div>
<div id="header">
 <div class="wrap clearfix">
  <ul class="logo">
   <a href="<?php echo $this->_tpl_vars['site']['root_url']; ?>
"><img src="http://www.bljt.com/theme/theme1/images/<?php echo $this->_tpl_vars['site']['site_logo']; ?>
" alt="<?php echo $this->_tpl_vars['site']['site_name']; ?>
" title="<?php echo $this->_tpl_vars['site']['site_name']; ?>
" /></a>
  </ul>
  <ul class="searchBox">
   <form name="search" id="search" method="get" action="<?php echo $this->_tpl_vars['site']['root_url']; ?>
">
    <label for="keyword"><?php echo $this->_tpl_vars['lang']['search_cue']; ?>
</label>
    <input name="s" type="text" class="keyword" title="<?php echo $this->_tpl_vars['lang']['search_product_cue']; ?>
" autocomplete="off" maxlength="128" value="<?php if ($this->_tpl_vars['keyword']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['keyword'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['search_product']; ?>
<?php endif; ?>" onclick="formClick(this,'<?php echo $this->_tpl_vars['lang']['search_product']; ?>
')">
    <input type="submit" class="btnSearch" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
">
   </form>
  </ul>
 </div>
</div>
<div id="mainNav">
 <ul class="wrap">
  <li<?php if ($this->_tpl_vars['index']['cur']): ?> class="cur"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['site']['root_url']; ?>
" class="first"><?php echo $this->_tpl_vars['lang']['home']; ?>
</a></li>
  <?php $_from = $this->_tpl_vars['nav_middle_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['nav_middle_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_middle_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['nav']):
        $this->_foreach['nav_middle_list']['iteration']++;
?> 
  <li<?php if ($this->_tpl_vars['nav']['cur']): ?> class="cur hover"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['nav']['url']; ?>
"<?php if ($this->_foreach['nav_middle_list']['iteration'] == 7): ?> class="last"<?php endif; ?><?php if ($this->_tpl_vars['nav']['target']): ?> target="_blank"<?php endif; ?>><?php echo $this->_tpl_vars['nav']['nav_name']; ?>
</a> 
  <?php if ($this->_tpl_vars['nav']['child']): ?>
  <ul>
   <?php $_from = $this->_tpl_vars['nav']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['child']):
?>
   <li><a href="<?php echo $this->_tpl_vars['child']['url']; ?>
"<?php if ($this->_tpl_vars['child']['child']): ?> class="parent"<?php endif; ?>><?php echo $this->_tpl_vars['child']['nav_name']; ?>
</a> 
    <?php if ($this->_tpl_vars['child']['child']): ?>
    <ul>
     <?php $_from = $this->_tpl_vars['child']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['children']):
?>
     <li><a href="<?php echo $this->_tpl_vars['children']['url']; ?>
"><?php echo $this->_tpl_vars['children']['nav_name']; ?>
</a></li>
     <?php endforeach; endif; unset($_from); ?>
    </ul>
    <?php endif; ?> 
   </li>
   <?php endforeach; endif; unset($_from); ?>
  </ul>
  <?php endif; ?>
  </li>
  <?php endforeach; endif; unset($_from); ?>
  <div class="clear"></div>
 </ul>
</div>