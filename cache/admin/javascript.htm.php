<?php /* Smarty version 2.6.26, created on 2015-12-17 21:15:33
         compiled from javascript.htm */ ?>
<script type="text/javascript" src="images/jquery.min.js"></script>
<script type="text/javascript" src="images/global.js"></script>
<?php if ($this->_tpl_vars['cur'] == 'index'): ?>
<script type="text/javascript">
var dou_api = '<?php echo $this->_tpl_vars['dou_api']; ?>
';
<?php echo '
if (typeof(json) == \'undefined\') var json = \'\';
function jsonCallBack(url, callback) {
    $.getScript(url,
    function() {
        callback(json);
    });
}
function dou_update() {
    jsonCallBack(dou_api,
    function(json) {
        document.getElementById(\'douApi\').innerHTML = json;
    })
}
window.onload = dou_update;
'; ?>

</script>
<?php endif; ?>