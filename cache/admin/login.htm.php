<?php /* Smarty version 2.6.26, created on 2015-12-09 19:18:06
         compiled from login.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_tpl_vars['page_title']; ?>
</title>
<meta name="Copyright" content="Douco Design." />
<link href="templates/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
<?php echo 'function refreshimage() {
    var cap = document.getElementById(\'vcode\');
    cap.src = cap.src + \'?\';
}'; ?>

</script>
</head>
<body>
<div id="login">
  <div class="dologo"></div>
  <?php if ($this->_tpl_vars['rec'] == 'default'): ?>
  <form action="login.php?rec=login" method="post">
   <ul>  
    <li class="inpLi"><b><?php echo $this->_tpl_vars['lang']['login_user_name']; ?>
：</b><input type="text" name="user_name" class="inpLogin"></li>
    <li class="inpLi"><b><?php echo $this->_tpl_vars['lang']['login_password']; ?>
：</b><input type="password" name="password" class="inpLogin"></li>
    <?php if ($this->_tpl_vars['site']['captcha']): ?>
    <li class="captchaPic">
      <div class="inpLi"><b><?php echo $this->_tpl_vars['lang']['login_captcha']; ?>
：</b><input type="text" name="captcha" class="captcha"></div>
      <img id="vcode" src="../captcha.php" alt="<?php echo $this->_tpl_vars['lang']['captcha']; ?>
" border="1" onClick="refreshimage()" title="<?php echo $this->_tpl_vars['lang']['login_captcha_refresh']; ?>
">
    </li>
    <?php endif; ?>
    <li class="sub"><input type="submit" name="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['login_submit']; ?>
"></li> 
    <li class="action"><a href="login.php?rec=password_reset"><?php echo $this->_tpl_vars['lang']['login_password_forget']; ?>
？</a> <em class="separator">|</em> <a href="<?php echo $this->_tpl_vars['site']['root_url']; ?>
"><?php echo $this->_tpl_vars['lang']['login_back']; ?>
</a></li> 
   </ul>
  </form>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['rec'] == 'password_reset'): ?>
  <form action="login.php?rec=password_reset_post" method="post">
   <ul class="reset">
    <?php if ($this->_tpl_vars['action'] == 'default'): ?>
    <li class="inpLi"><b><?php echo $this->_tpl_vars['lang']['login_user_name']; ?>
：</b><input type="text" name="user_name" class="inpLogin"></li>
    <li class="inpLi"><b><?php echo $this->_tpl_vars['lang']['login_email']; ?>
：</b><input type="text" name="email" class="inpLogin"></li>
    <li class="sub">
     <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
     <input type="submit" name="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['login_password_reset']; ?>
">
    </li> 
    <?php elseif ($this->_tpl_vars['action'] == 'reset'): ?>
    <li class="inpLi"><b><?php echo $this->_tpl_vars['lang']['manager_new_password']; ?>
：</b><input type="password" name="password" class="inpLogin"></li>
    <li class="inpLi"><b><?php echo $this->_tpl_vars['lang']['manager_new_password_confirm']; ?>
：</b><input type="password" name="password_confirm" class="inpLogin"></li>
    <li class="sub">
     <input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['user_id']; ?>
" />
     <input type="hidden" name="code" value="<?php echo $this->_tpl_vars['code']; ?>
" />
     <input type="hidden" name="action" value="reset" />
     <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
     <input type="submit" name="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
">
    </li> 
    <?php endif; ?>
    <li class="action"><a href="login.php"><?php echo $this->_tpl_vars['lang']['login_submit']; ?>
</a> <em class="separator">|</em> <a href="<?php echo $this->_tpl_vars['site']['root_url']; ?>
"><?php echo $this->_tpl_vars['lang']['login_back']; ?>
</a></li> 
   </ul>
  </form>
  <?php endif; ?>
</div>
</body>
</html>