<?php
/**
 * 组装页面body的class值和foot_js的初始化值
 *
 * 本项目的页面代码跟js库紧密结合，需要设置正确的body class和foot_js初始值才能正常工作
 * body class的设置有三种情况：
 *   1. 标准情况，为当前controller、action的名称组合
 *   2. action为add，需要将action更换为new，因为new是php的关键词，但是前端默认要求用new
 *   3. 部分特殊动作，由controller在需要时单独设定
 *
 * foot_j的设置有三个情况：
 *   1. 具体controller的首字母大写
 *   2. action跟body class一致
 *   3. 标识project的id在部分页面下不需要，比如dashboards的页面，主要是非项目级别的控制器和操作
 */

// body class string
if(!isset($BodyJsAction)) {
	$BodyJsAction   = $this->request['action'] == 'add' ? 'new' : $this->request['action'];
}
$body_class  = 'js-' . $this->request['controller'] . '-' . $BodyJsAction;
// foot js arguments
$footJsArguments = array();
$footJsArguments['action'] = $BodyJsAction;
$footJsArguments['apps']   = ucfirst($this->request['controller']);
// 为foot_js.ctp的Utility设置参数，如果请求URL里有传参，第一个一定是project_id
$footJsArguments['project'] = isset($this->request->pass[0]) ? $this->request->pass[0] : '';

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
				<p>This project was last deployed at <?php echo $LastDeployment['Deployment']['time_start']; ?>. <a href="/deployments/view/<?php echo $LastDeployment['Deployment']['id'];?>">View details</a>.</p>
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
<?php echo $this->element('common/foot_js', $footJsArguments); ?>
</body>
</html>
