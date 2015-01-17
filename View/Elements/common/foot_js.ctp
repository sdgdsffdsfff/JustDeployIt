<?php
/**
 * 下方代码里用到的两个变量在layout/default.ctp里计算完成并作为参数传递进来
 */
?>
<script src="/js/application-4490436fc5ec79a05e570d20adf462b5.js"></script>
<script>
    //<![CDATA[
    window.Utility || (window.Utility = {});
    Utility.RailsVars = {"user_timezone":"Etc/UTC","vwp_token":"13c9299896384ac5ac3cf68c"};

    (function() {
        window.$this = new (App.<?php echo $js_apps;?> || App.Base)();
        if (typeof $this.<?php echo $js_action;?> === 'function') {
            return $this.<?php echo $js_action;?>.call();
        }
    })();

    //]]>
</script>
