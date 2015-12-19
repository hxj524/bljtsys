<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- {if $link} -->
<div class="wrap link-wrap">
    <div class="wrap">
        <div class="ygfc">
            <h1><strong>员工风采</strong></h1>
            <div class="content">
                
            </div>
        </div><div class="link">
            <h1><strong>{$lang.link}</strong></h1>
            <!-- {foreach from=$link name=link item=link} -->
            <a href="{$link.link_url}" target="_blank" >{$link.link_name}</a>
            <!-- {/foreach} -->
        </div>
    </div>
</div>
<!-- {/if} -->