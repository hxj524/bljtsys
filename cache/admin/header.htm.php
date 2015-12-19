<?php /* Smarty version 2.6.26, created on 2015-12-12 14:24:57
         compiled from header.htm */ ?>
<div id="dcHead">
 <div id="head">
  <div class="logo"><a href="index.php"><img src="images/dclogo.png" alt="logo"></a></div>
  <div class="nav">
   <ul>
    <li class="M"><a href="JavaScript:void(0);" class="topAdd"><?php echo $this->_tpl_vars['lang']['top_add']; ?>
</a>
     <div class="drop mTopad"><?php if ($this->_tpl_vars['lang']['top_add_product']): ?><a href="product.php?rec=add"><?php echo $this->_tpl_vars['lang']['top_add_product']; ?>
</a><?php endif; ?> <?php if ($this->_tpl_vars['lang']['top_add_article']): ?><a href="article.php?rec=add"><?php echo $this->_tpl_vars['lang']['top_add_article']; ?>
</a><?php endif; ?> <a href="nav.php?rec=add"><?php echo $this->_tpl_vars['lang']['top_add_nav']; ?>
</a> <a href="show.php"><?php echo $this->_tpl_vars['lang']['top_add_show']; ?>
</a> <a href="page.php?rec=add"><?php echo $this->_tpl_vars['lang']['top_add_page']; ?>
</a> <a href="manager.php?rec=add"><?php echo $this->_tpl_vars['lang']['top_add_manager']; ?>
</a> <a href="link.php"><?php echo $this->_tpl_vars['lang']['top_add_link']; ?>
</a> </div>
    </li>
    <li><a href="../index.php" target="_blank"><?php echo $this->_tpl_vars['lang']['top_go_site']; ?>
</a></li>
    <li><a href="index.php?rec=clear_cache"><?php echo $this->_tpl_vars['lang']['clear_cache']; ?>
</a></li>
    <li><a href="http://help.douco.com" target="_blank"><?php echo $this->_tpl_vars['lang']['top_help']; ?>
</a></li>
    <li class="noRight"><a href="module.php"<?php if ($this->_tpl_vars['cur'] == 'module'): ?> class="cur"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['top_module']; ?>
<?php if ($this->_tpl_vars['unum']['module']): ?><span class="unum"><span><?php echo $this->_tpl_vars['unum']['module']; ?>
</span></span><?php endif; ?></a></li>
   </ul>
   <ul class="navRight">
    <li class="M noLeft"><a href="JavaScript:void(0);"><?php echo $this->_tpl_vars['lang']['top_welcome']; ?>
<?php echo $this->_tpl_vars['user']['user_name']; ?>
</a>
     <div class="drop mUser">
      <a href="manager.php?rec=edit&id=<?php echo $this->_tpl_vars['user']['user_id']; ?>
"><?php echo $this->_tpl_vars['lang']['top_manager_edit']; ?>
</a>
      <a href="manager.php?rec=cloud_account"><?php echo $this->_tpl_vars['lang']['cloud_account']; ?>
</a>
     </div>
    </li>
    <li class="noRight"><a href="login.php?rec=logout"><?php echo $this->_tpl_vars['lang']['top_logout']; ?>
</a></li>
   </ul>
  </div>
 </div>
</div>
<!-- dcHead 结束 -->