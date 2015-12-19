<?php /* Smarty version 2.6.26, created on 2015-12-12 13:40:41
         compiled from search.dwt */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'search.dwt', 31, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
" />
<meta name="description" content="<?php echo $this->_tpl_vars['description']; ?>
" />
<meta name="generator" content="DouPHP v1.3" />
<title><?php echo $this->_tpl_vars['page_title']; ?>
</title>
<link href="http://www.bljt.com/theme/default/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://www.bljt.com/theme/default/images/jquery.min.js"></script>
<script type="text/javascript" src="http://www.bljt.com/theme/default/images/global.js"></script>
</head>
<body>
<div id="wrapper"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <div class="wrap mb">
  <div id="pageLeft"> 
   <?php if ($this->_tpl_vars['search_module'] == 'product'): ?> 
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/product_tree.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
   <?php else: ?> 
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/article_tree.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
   <?php endif; ?> 
  </div>
  <div id="pageIn"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/ur_here.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
   <?php if ($this->_tpl_vars['search_module'] == 'product'): ?>
   <div class="productList"> 
    <?php $_from = $this->_tpl_vars['search_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['product_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['product_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['product_list']['iteration']++;
?> 
    <dl<?php if (($this->_foreach['product_list']['iteration'] == $this->_foreach['product_list']['total'])): ?> class="last"<?php endif; ?>>
    <dt><a href="<?php echo $this->_tpl_vars['product']['url']; ?>
"><img src="<?php echo $this->_tpl_vars['product']['thumb']; ?>
" alt="<?php echo $this->_tpl_vars['product']['name']; ?>
" width="158" height="158" /></a></dt>
    <dd>
     <p class="name"><a href="<?php echo $this->_tpl_vars['product']['url']; ?>
" title="<?php echo $this->_tpl_vars['product']['name']; ?>
"><?php echo $this->_tpl_vars['product']['name']; ?>
</a></p>
     <p class="brief"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['description'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50, "...") : smarty_modifier_truncate($_tmp, 50, "...")); ?>
</p>
     <p class="price"><?php echo $this->_tpl_vars['lang']['price']; ?>
：<?php echo $this->_tpl_vars['product']['price']; ?>
</p>
     <p><a href="<?php echo $this->_tpl_vars['product']['url']; ?>
" class="btn"><?php echo $this->_tpl_vars['lang']['product_buy']; ?>
</a></p>
    </dd>
    </dl>
    <?php endforeach; endif; unset($_from); ?>
    <div class="clear"></div>
   </div>
   <?php else: ?>
   <div id="articleList"> 
    <?php $_from = $this->_tpl_vars['search_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['article_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['article_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['article']):
        $this->_foreach['article_list']['iteration']++;
?> 
    <dl<?php if (($this->_foreach['article_list']['iteration'] == $this->_foreach['article_list']['total'])): ?> class="last"<?php endif; ?>>
    <div class="numDate"> <em><?php echo $this->_tpl_vars['article']['click']; ?>
</em>
     <p><?php echo $this->_tpl_vars['article']['add_time']; ?>
</p>
    </div>
    <dt><a href="<?php echo $this->_tpl_vars['article']['url']; ?>
"><?php echo $this->_tpl_vars['article']['title']; ?>
</a></dt>
    <dd><?php if ($this->_tpl_vars['article']['image']): ?>
     <p class="img"><img src="<?php echo $this->_tpl_vars['article']['image']; ?>
" height="42"></p>
     <?php endif; ?>
     <p class="desc"><?php echo ((is_array($_tmp=$this->_tpl_vars['article']['description'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 96, "...") : smarty_modifier_truncate($_tmp, 96, "...")); ?>
</p>
    </dd>
    </dl>
    <?php endforeach; endif; unset($_from); ?> 
   </div>
   <?php endif; ?> 
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
  <div class="clear"></div>
 </div>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/online_service.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
</body>
</html>