<?php
/**
 * 常用的且在面对不同环境易变的配置
 */

// 在生产环境里将去掉debugkit的加载
CakePlugin::load('DebugKit');
// Git的关联配置
Configure::write('GitSettings', array(
    'bin_path'  => 'git',
    'repos_path' => 'D:\ProjectGithub\JustDeployIt.Repos'
));

?>