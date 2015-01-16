<?php

/**
 * 本文件存储了项目中常用的几个下拉列表的选项
 *
 * CakePHP从数据库兼容性考虑，不支持MySQL的enum字段类型，无法使用Console/cake bake
 * 进行初始代码构建工作，因此将这些enum型的字段用专门的配置存储
 *
 * @author shukai0828 <pheonix0862@hotmail.com>
 *
 */

// 项目使用的代码管理软件的类型
Configure::write('Project.scm_type', array('Git', ));

// 部署服务器的连接协议
Configure::write('Server.protocol', array('SSH/SFTP', 'FTP'));

// 部署服务器的环境类型
Configure::write('Server.environment', array('Development', 'Testing', 'Staging', 'Production'));

// 部署行为的结果
Configure::write('Deployment.result', array('Successful', 'Failed', 'Aborted'));

// 部署步骤日志的类型
Configure::write('Deployment.action', array('Acting', 'Informing', 'Result'));
?>