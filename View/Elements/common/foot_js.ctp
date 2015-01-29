<?php
/**
 * 为Js库确定正确运行设定关联参数
 *
 * 由于php将new作为关键词，使用add作为对应的cakephp action，在routes里进行new、add转换，在这里在转换过来
 * 这里产生的几个变量值主要在本文件和common/foot_js.ctp里使用
 */
$js_action   = $this->request['action'] == 'add' ? 'new' : $this->request['action'];
$js_apps     = ucfirst($this->request['controller']);

/**
 * 为foot_js.ctp的Utility设置参数
 *
 * 如果请求URL里有传参，第一个一定是project_id
 *
 * TODO: 判定project_id的合法性
 */
$RailsVars = array();
$RailsVars["user_timezone"] = "Etc/UTC";
$RailsVars["vwp_token"]     = "13c9299896384ac5ac3cf68c";
if(isset($this->request->pass[0]) && is_numeric($this->request->pass[0])) {
    $RailsVars["project"] = $this->request->pass[0];
}
?>
<script src="/js/application-4490436fc5ec79a05e570d20adf462b5.js"></script>
<script>
    //<![CDATA[
    window.Utility || (window.Utility = {});
    Utility.RailsVars = <?php echo json_encode($RailsVars);?>;

    (function() {
        window.$this = new (App.<?php echo $js_apps;?> || App.Base)();
        if (typeof $this.<?php echo $js_action;?> === 'function') {
            return $this.<?php echo $js_action;?>.call();
        }
    })();

    //]]>
</script>
