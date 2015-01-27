JustDeployIt
============

用于完成基于脚本语言的WEB应用程序的部署



## 规则 ##

## 路径规则 ##

本平台中所有的RUI规则都要遵守如下格式：

```
/:controllers/:action/:project_id/:id
```

`project_id`作为关键数据在任何路径中必须存在和被处理，`id`在new操作下可以不出现。

当Controller为Projects时，`id`永远不会出现，`project_id`在new操作下可以不出现。

### 邮件发送规则 ###

1. 项目创建人将会收到所有项目配置更改的变动通知
2. 项目创建人将会收到所有部署操作结果的通知
3. 部署创建人将会收到部署结果的通知

### 页面跳转规则 ###

1. 项目工程创建过程中，按 5 步骤顺序前进
2. 其它页面进入到配置页，完成工作后跳回入口页面

### 部署规则 ###

1. 默认情况下只覆盖，不删除
2. 删除目标服务器的文件，只发生在明确执行远端删除的情况下

## 实体关系 ##

1. 配置文件跟服务器组直接关联
2. 排除文件跟项目直接关联

## Routes and Controllers ##

```php
// 以下自定义路由的顺序很重要
// Router: 00 array('controller' => 'projects'); Projects专用
Router::connect('/:controller/new',                    array('action' => 'add'));
Router::connect('/:controller/:project_id',            array('action' => 'view'));
Router::connect('/:controller/:project_id/upload_key', array('action' => 'upload_key'));
Router::connect('/:controller/:project_id/public_key', array('action' => 'public_key'));
Router::connect('/:controller/:project_id/star',       array('action' => 'star'));
Router::connect('/:controller/:project_id/edit',       array('action' => 'edit'));
Router::connect('/:controller/:project_id/test',       array('action' => 'test'));
//Router::connect('/:controller/new/*', array('action' => 'add'));// 用途未明

// Router: 02 array('controller' => :controller, 'action' => 'index');
Router::connect('/projects/:project_id/:controller');

// Router: 03 array('controller' => :controller, 'action' => 'add');
Router::connect('/projects/:project_id/:controller/new', array('action' => 'add'));
//Router::connect('/projects/:project_id/:controller/new/*', array('action' => 'add')); // 用途未明

// Router: 05 array('controller' => 'repository'); Repository专用
Router::connect('/projects/:project_id/repository/:action');

// Router 04 array('controller' => :controller, 'action' => 'view'); // 推断是view
Router::connect('/projects/:project_id/:controller/:id');

// Router: 01 array('controller' => :controller, 'action' => :action);
Router::connect('/projects/:project_id/:controller/:id/:action/');
```
```php
// DeploymentsController
array(
    'controller' => 'deployments',
    'action'     => array(
         index,                 // 02, project_deployments,         /projects/:project_id/deployments
         new,                   // 03, new_project_deployment,      /projects/:project_id/deployments/new
         view,                  // 04, project_deployment,          /projects/:project_id/deployments/:id
         edit,                  // 01, edit_project_deployment,     /projects/:project_id/deployments/:id/edit
         retry,                 // 01, retry_project_deployment,    /projects/:project_id/deployments/:id/retry
         abort,                 // 01, abort_project_deployment,    /projects/:project_id/deployments/:id/abort
         start_log_streaming,   // 01, start_log_streaming_project_deployment, /projects/:project_id/deployments/:id/start_log_streaming
         rollback,              // 01, rollback_project_deployment, /projects/:project_id/deployments/:id/rollback
    )
);
// ServersController
array(
    'controller' => 'servers',
    'action'     => array(
        reorder,            // 0x, reorder_project_servers,         /projects/:project_id/servers/reorder (0x == not defined)
        index,              // 02, project_servers,                 /projects/:project_id/servers
        new,                // 03, new_project_server,              /projects/:project_id/servers/new
        view,               // 04, project_server,                  /projects/:project_id/servers/:id
        eidt,               // 01, edit_project_server,             /projects/:project_id/servers/:id/edit
        latest_revision,    // 01, latest_revision_project_server,  /projects/:project_id/servers/:id/latest_revision
        preferred_branch,   // 01, preferred_branch_project_server, /projects/:project_id/servers/:id/preferred_branch
        change_group,       // 01, change_group_project_server,     /projects/:project_id/servers/:id/change_group
    )
);
// ServerGroupsController
array(
    'controller' => 'servergroups',
    'action'     => array(
        index,      // 02, project_server_groups,       /projects/:project_id/server_groups
        new,        // 03, new_project_server_group,    /projects/:project_id/server_groups/new
        view,       // 04, project_server_group,        /projects/:project_id/server_groups/:id
        edit,       // 01, edit_project_server_group,   /projects/:project_id/server_groups/:id/edit
    )
);
// RepositoryController
array(
    'controller' => 'repository',
    'action'     => array(
        index,              // 02, project_repository,                  /projects/:project_id/repository
        new,                // 03, new_project_repository,              /projects/:project_id/repository/new
        edit,               // 05, edit_project_repository,             /projects/:project_id/repository/edit
        latest_revision,    // 05, latest_revision_project_repository,  /projects/:project_id/repository/latest_revision
        caching,            // 05, caching_project_repository,          /projects/:project_id/repository/caching
        cache_status,       // 05, cache_status_project_repository,     /projects/:project_id/repository/cache_status
        comparison,         // 05, comparison_project_repository,       /projects/:project_id/repository/comparison
        recache,            // 05, recache_project_repository,          /projects/:project_id/repository/recache
        cache_error,        // 05, cache_error_project_repository,      /projects/:project_id/repository/cache_error
        commit_select,      // 05, commit_select_project_repository,    /projects/:project_id/repository/commit_select
        commit_info,        // 05, commit_info_project_repository,      /projects/:project_id/repository/commit_info
        repo_list,          // 05, repo_list_project_repository,        /projects/:project_id/repository/repo_list
        add_credentials,    // 05, add_credentials_project_repository,  /projects/:project_id/repository/add_credentials
        add_notification,   // 05, add_notification_project_repository, /projects/:project_id/repository/add_notification
    )
);
// ConfigFilesController
array(
    'controller' => 'config_file',
    'action'     => array(
        index,      // 02, project_config_files,        /projects/:project_id/config_files
        new,        // 03, new_project_config_file,     /projects/:project_id/config_files/new
        view,       // 04, project_config_file,         /projects/:project_id/config_files/:id
        edit,       // 01, edit_project_config_file,    /projects/:project_id/config_files/:id/edit
    )
);
// NotificationsController
array(
    'controller' => 'notification',
    'action'     => array(
        index,      // 02, project_notifications,       /projects/:project_id/notifications
        new,        // 03, new_project_notification,    /projects/:project_id/notifications/new
        view,       // 04, project_notification,        /projects/:project_id/notifications/:id
        edit,       // 01, edit_project_notification,   /projects/:project_id/notifications/:id/edit
    )
);
// CommandsController
array(
    'controller' => 'commands',
    'action'     => array(
        reorder,        // 0x, reorder_project_commands,        /projects/:project_id/commands/reorder (0x == not defined)
        index,          // 02, project_commands,                /projects/:project_id/commands
        new,            // 03, new_project_command,             /projects/:project_id/commands/new
        view,           // 04, project_command,                 /projects/:project_id/commands/:id
        edit,           // 01, edit_project_command,            /projects/:project_id/commands/:id/edit
        command_lines,  // 01, command_lines_project_command,   /projects/:project_id/commands/:id/command_lines
    )
);
// ExcludeFilesController
array(
    'controller' => 'exclude_file',
    'action'     => array(
        index,      // 02, project_excluded_files,      /projects/:project_id/excluded_files
        new,        // 03, new_project_excluded_file,   /projects/:project_id/excluded_files/new
        view,       // 04, project_excluded_file,       /projects/:project_id/excluded_files/:id
        edit,       // 01, edit_project_excluded_file,  /projects/:project_id/excluded_files/:id/edit
    )
);
// ProjectsController
array(
    'controller' => 'project',
    'action'     => array(
        index,      // 0d, projects,            /projects (0d == cakephp default)
        new,        // 00, new_project,         /projects/new
        edit,       // 00, edit_project,        /projects/:id/edit
        view,       // 00, project,             /projects/:id
        test,       // 00, test_project,        /projects/:id/test
        upload_key, // 00, upload_key_project,  /projects/:id/upload_key
        public_key, // 00, public_key_project,  /projects/:id/public_key
        star,       // 00, star_project,        /projects/:id/star
    )
);
// ProjectsController
array(
    'controller' => 'project',
    'action'     => array(
        index,      // 0d, users, /users (0d == cakephp default)
        new,        // 00, new_user, /users/new
        view,       // 00, user, /users/:id
        edit,       // 00, edit_user, /users/:id/edit
        projects_view_preference,       // 00, projects_view_preference_user, /users/:id/projects_view_preference
        projects_sort_preference,       // 00, projects_sort_preference_user, /users/:id/projects_sort_preference
        notification_scope_preference,  // 00, notification_scope_preference_user, /users/:id/notification_scope_preference
        hide_notice,                    // 00, hide_notice_user, /users/:id/hide_notice
        
    )
);
```

```javascript
routes: {
  "": {
    "path": "/account(.:format)",
    "verb": "PATCH"
  },
  "log_auth_project_deployment": {
    "path": "/projects/:project_id/deployments/:id/logs/auth(.:format)",
    "verb": "POST"
  },
  "log_poll_project_deployment": {
    "path": "/projects/:project_id/deployments/:id/logs/poll(.:format)",
    "verb": "GET"
  },
  "repository_hook": {
    "path": "/deploy/:project_id/to/:server_id/:server_key(.:format)",
    "verb": "POST"
  },
  "repository_hook_info": {
    "path": "/deploy/:project_id/to/:server_id/:server_key(.:format)",
    "verb": "GET"
  },
  "import_project_repository_from": {
    "path": "/projects/:project_id/repository/from/:action(.:format)",
    "verb": "GET|POST"
  },
  "project_template": {
    "path": "/projects/:id/template/:template_identifier(.:format)",
    "verb": "GET|POST"
  },
  "global_rss": {
    "path": "/global(.:format)",
    "verb": "GET"
  },
  "profile": {
    "path": "/profile(.:format)",
    "verb": "GET"
  },
  "profile_noti": {
    "path": "/profile/noti(.:format)",
    "verb": "GET|POST"
  },
  "regenerate_api_key": {
    "path": "/regenerate_api_key(.:format)",
    "verb": "POST"
  },
  "login": {
    "path": "/login(.:format)",
    "verb": "GET"
  },
  "logout": {
    "path": "/logout(.:format)",
    "verb": "GET"
  },
  "reset_password": {
    "path": "/reset(.:format)",
    "verb": "GET|POST"
  },
  "apikey": {
    "path": "/apikey(.:format)",
    "verb": "GET"
  },
  "account_list": {
    "path": "/account_list(.:format)",
    "verb": "POST"
  },
  "account": {
    "path": "/account(.:format)",
    "verb": "GET"
  },
  "billy": {
    "path": "/~billy/:action(.:format)",
    "verb": "POST"
  },
  "billing": {
    "path": "/billing/:action(.:format)",
    "verb": "GET"
  },
  "support": {
    "path": "/support(.:format)",
    "verb": "GET"
  },
  "report_bug": {
    "path": "/feedback/report_bug(.:format)",
    "verb": "POST"
  },
  "feedback": {
    "path": "/feedback/feedback(.:format)",
    "verb": "POST"
  },
  "external_auth": {
    "path": "/auth/external(.:format)",
    "verb": "GET"
  },
  "external_auth_callback": {
    "path": "/auth/:provider/callback(.:format)",
    "verb": "GET"
  },
  "root": {
    "path": "/",
    "verb": "GET"
  }
},
```
