<?php
/**
 * 组装页面body的class值
 *
 * 本项目的页面代码跟js库紧密结合，需要设置正确的
 */
$js_action   = $this->request['action'] == 'add' ? 'new' : $this->request['action'];
$body_class  = 'js-' . $this->request['controller'] . '-' . $js_action;
?>
<!DOCTYPE html>
<html lang='en'>
<head>
<?php echo $this->element('common/head'); ?>
</head>
<body class='<?php echo $body_class ?>'>

<?php
echo $this->element('common/header');
if(!isset($noMenuBar)) {
	echo $this->element('common/navbar');
}
?>

<div class='container clearfix'>

<?php echo $this->fetch('content'); ?>

</div>
<?php echo $this->element('common/footer'); ?>
<?php echo $this->element('common/foot_js'); ?>
</body>
</html>
