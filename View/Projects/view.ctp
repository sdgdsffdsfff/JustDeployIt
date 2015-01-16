<div class="projects view">
<h2><?php echo __('Project'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($project['Project']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($project['User']['id'], array('controller' => 'users', 'action' => 'view', $project['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($project['Project']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Repository Type'); ?></dt>
		<dd>
			<?php echo h($project['Project']['repository_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Repository Url'); ?></dt>
		<dd>
			<?php echo h($project['Project']['repository_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Default Branch'); ?></dt>
		<dd>
			<?php echo h($project['Project']['default_branch']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Repository Username'); ?></dt>
		<dd>
			<?php echo h($project['Project']['repository_username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Repository Password'); ?></dt>
		<dd>
			<?php echo h($project['Project']['repository_password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ssh Key'); ?></dt>
		<dd>
			<?php echo h($project['Project']['ssh_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($project['Project']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($project['Project']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Project'), array('action' => 'edit', $project['Project']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Project'), array('action' => 'delete', $project['Project']['id']), array(), __('Are you sure you want to delete # %s?', $project['Project']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Config Files'), array('controller' => 'config_files', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Config File'), array('controller' => 'config_files', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Deployments'), array('controller' => 'deployments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deployment'), array('controller' => 'deployments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exclude Files'), array('controller' => 'exclude_files', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exclude File'), array('controller' => 'exclude_files', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Server Groups'), array('controller' => 'server_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Server Group'), array('controller' => 'server_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Config Files'); ?></h3>
	<?php if (!empty($project['ConfigFile'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Project Id'); ?></th>
		<th><?php echo __('Path'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($project['ConfigFile'] as $configFile): ?>
		<tr>
			<td><?php echo $configFile['id']; ?></td>
			<td><?php echo $configFile['user_id']; ?></td>
			<td><?php echo $configFile['project_id']; ?></td>
			<td><?php echo $configFile['path']; ?></td>
			<td><?php echo $configFile['content']; ?></td>
			<td><?php echo $configFile['created']; ?></td>
			<td><?php echo $configFile['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'config_files', 'action' => 'view', $configFile['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'config_files', 'action' => 'edit', $configFile['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'config_files', 'action' => 'delete', $configFile['id']), array(), __('Are you sure you want to delete # %s?', $configFile['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Config File'), array('controller' => 'config_files', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Deployments'); ?></h3>
	<?php if (!empty($project['Deployment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Project Id'); ?></th>
		<th><?php echo __('Server Id'); ?></th>
		<th><?php echo __('Server Group Id'); ?></th>
		<th><?php echo __('Is Copy Config Files'); ?></th>
		<th><?php echo __('Is Send Mail'); ?></th>
		<th><?php echo __('Time Start'); ?></th>
		<th><?php echo __('Time End'); ?></th>
		<th><?php echo __('Revision From'); ?></th>
		<th><?php echo __('Revision To'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($project['Deployment'] as $deployment): ?>
		<tr>
			<td><?php echo $deployment['id']; ?></td>
			<td><?php echo $deployment['user_id']; ?></td>
			<td><?php echo $deployment['project_id']; ?></td>
			<td><?php echo $deployment['server_id']; ?></td>
			<td><?php echo $deployment['server_group_id']; ?></td>
			<td><?php echo $deployment['is_copy_config_files']; ?></td>
			<td><?php echo $deployment['is_send_mail']; ?></td>
			<td><?php echo $deployment['time_start']; ?></td>
			<td><?php echo $deployment['time_end']; ?></td>
			<td><?php echo $deployment['revision_from']; ?></td>
			<td><?php echo $deployment['revision_to']; ?></td>
			<td><?php echo $deployment['status']; ?></td>
			<td><?php echo $deployment['created']; ?></td>
			<td><?php echo $deployment['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'deployments', 'action' => 'view', $deployment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'deployments', 'action' => 'edit', $deployment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'deployments', 'action' => 'delete', $deployment['id']), array(), __('Are you sure you want to delete # %s?', $deployment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Deployment'), array('controller' => 'deployments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Exclude Files'); ?></h3>
	<?php if (!empty($project['ExcludeFile'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Project Id'); ?></th>
		<th><?php echo __('Pattern'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($project['ExcludeFile'] as $excludeFile): ?>
		<tr>
			<td><?php echo $excludeFile['id']; ?></td>
			<td><?php echo $excludeFile['user_id']; ?></td>
			<td><?php echo $excludeFile['project_id']; ?></td>
			<td><?php echo $excludeFile['pattern']; ?></td>
			<td><?php echo $excludeFile['created']; ?></td>
			<td><?php echo $excludeFile['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'exclude_files', 'action' => 'view', $excludeFile['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'exclude_files', 'action' => 'edit', $excludeFile['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'exclude_files', 'action' => 'delete', $excludeFile['id']), array(), __('Are you sure you want to delete # %s?', $excludeFile['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Exclude File'), array('controller' => 'exclude_files', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Server Groups'); ?></h3>
	<?php if (!empty($project['ServerGroup'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Project Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Preferred Branch'); ?></th>
		<th><?php echo __('Last Revision'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($project['ServerGroup'] as $serverGroup): ?>
		<tr>
			<td><?php echo $serverGroup['id']; ?></td>
			<td><?php echo $serverGroup['user_id']; ?></td>
			<td><?php echo $serverGroup['project_id']; ?></td>
			<td><?php echo $serverGroup['name']; ?></td>
			<td><?php echo $serverGroup['preferred_branch']; ?></td>
			<td><?php echo $serverGroup['last_revision']; ?></td>
			<td><?php echo $serverGroup['created']; ?></td>
			<td><?php echo $serverGroup['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'server_groups', 'action' => 'view', $serverGroup['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'server_groups', 'action' => 'edit', $serverGroup['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'server_groups', 'action' => 'delete', $serverGroup['id']), array(), __('Are you sure you want to delete # %s?', $serverGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Server Group'), array('controller' => 'server_groups', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
