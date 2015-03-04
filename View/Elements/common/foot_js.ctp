<?php
/**
 * 为Js库确定正确运行设定关联参数
 *
 * 基本数据由layouts/default.ctp组装并传递进来
 */

// 为foot_js.ctp的Utility设置参数
$RailsVars = array();
$RailsVars["user_timezone"] = "Etc/UTC";
$RailsVars["vwp_token"]     = "13c9299896384ac5ac3cf68c";
if(!empty($project)) {
    $RailsVars["project"] = $project;
}
if(isset($BodyJsRailsVar)) {
    $RailsVars = array_merge($RailsVars, $BodyJsRailsVar);
}
?>
<script src="/js/application-4490436fc5ec79a05e570d20adf462b5.js"></script>
<script>
    //<![CDATA[
    window.Utility || (window.Utility = {});
    Utility.RailsVars = <?php echo json_encode($RailsVars);?>;

    (function() {
        window.$this = new (App.<?php echo $apps;?> || App.Base)();
        if (typeof $this.<?php echo $action;?> === 'function') {
            return $this.<?php echo $action;?>.call();
        }
    })();

    //]]>
</script>
