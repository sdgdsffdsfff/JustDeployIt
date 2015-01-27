<?php
/**
 * 页面用的到的flash及展示
 *
 * flash的类型如下：
 *   1. alert
 *   2. notice
 *   3. success
 *   4. neutral
 * 使用位置为两处：
 *   1. 用在<div class='container clearfix'>之后的flashes，第一行，用于当前功能的操作结果提示。setflash时的key值为function
 *   2. 用在common_header和common_menu之后的flashes，一般用于项目级的操作结果提示，此时需要封装到<div class='container'>之中</div>。setflash时的key值为project
 */
?>
<?php
if(isset($flashOnTop)) :
?>
<div class='container'>
<?php
endif;
?>
    <div class='flash flash--spaced flash--<?php echo $type;?>'>
        <p><?php echo $message;?></p>
    </div>
<?php
if(isset($flashOnTop)) :
?>
</div>
<?php
endif;
?>
