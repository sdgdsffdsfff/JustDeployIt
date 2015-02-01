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
/**
 * 渲染出来的页面是否需要项目级的菜单
 * 除Projects的大部分action外，其它控制器都不需要这个菜单
 */
if(isset($needProjectMenuBar)) {
	echo $this->element('common/navbar');
}
?>

<?php
if(isset($needProjectMenuBar)) :
	if(empty($LastDeployment)) :
		?>
		<div class='container'>
			<div class='flash flash--spaced flash--neutral'>
				<p>This project hasn&rsquo;t been deployed yet. <a href="/deployments/new/<?php echo $Project['id']; ?>">Deploy now</a>.</p>
			</div>
		</div>
	<?php
	else :
		?>
		<div class='container'>
			<div class='flash flash--spaced flash--neutral'>
				<p>This project was last deployed at <?php echo date('Y-m-d H:i:s', $LastDeployment['Deployment']['created']); ?>. <a href="/deployments/view/<?php echo $LastDeployment['Deployment']['id'];?>">View details</a>.</p>
			</div>
		</div>
	<?php
	endif;
endif;
?>

<div class='container clearfix'>

<?php
// 显示功能级别的提示信息
echo $this->Session->flash('function');

echo $this->fetch('content');
?>

</div>
<?php echo $this->element('common/footer'); ?>
<?php echo $this->element('common/foot_js'); ?>
</body>
</html>
