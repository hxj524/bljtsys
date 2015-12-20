<div id="caoter">
    <div class="demo">
        <div class="bx_wrap">
            <ul id="demo2">
                <!-- {foreach from=$product_slider name=product_slider item=product} -->
                <li class="img"><a href="{$product.url}"><img src="{$product.thumb}" width="126" height="126" /></a></li>
                <!-- {/foreach} -->
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
    {literal}
    $(function(){
        $('#demo2').bxCarousel({
            display_num: 6, 
            move: 6,
            auto: true, 
            margin: 10
        });
    });
    {/literal}
</script>