<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- {if $site.qq} -->
<div id="onlineService">
 <div class="onlineBtn"><a class="show" rel="nofollow" style="display:none" title="查看在线客服" href="javascript:void(0);">展开</a><a class="hide" rel="nofollow" title="关闭在线客服" href="javascript:void(0);" style="display:block">收缩</a></div>
 <div class="onlineBox" style="display: block;">
  <div class="head"></div>
  <dl class="box">
   <dt></dt>
   <dd>
        <!-- {foreach from=$site.qq item=qq} -->
        <!-- {if is_array($qq)} -->
        <a href="http://wpa.qq.com/msgrd?v=3&uin={$qq.number}&site=qq&menu=yes" target="_blank"><i></i><em>QQ交谈</em></a>
        <!-- {else} -->
        <a href="http://wpa.qq.com/msgrd?v=3&uin={$qq}&site=qq&menu=yes" target="_blank"><i></i><em>QQ交谈</em></a>
        <!-- {/if} -->
        <!-- {/foreach} -->
        <a target="_blank" href="/page.php?id=4"><i class="tel"></i><em>{$site.tel}</em></a>
   </dd>
  </dl>
  <div class="foot"></div>
 </div>
</div>
<!-- {/if} -->