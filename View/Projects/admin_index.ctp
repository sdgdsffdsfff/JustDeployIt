<div class="projects index">
	<h2><?php echo __('Projects'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('repository_type'); ?></th>
			<th><?php echo $this->Paginator->sort('repository_url'); ?></th>
			<th><?php echo $this->Paginator->sort('default_branch'); ?></th>
			<th><?php echo $this->Paginator->sort('repository_username'); ?></th>
			<th><?php echo $this->Paginator->sort('repository_password'); ?></th>
			<th><?php echo $this->Paginator->sort('ssh_key'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($projects as $project): ?>
	<tr>
		<td><?php echo h($project['Project']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($project['User']['id'], array('controller' => 'users', 'action' => 'view', $project['User']['id'])); ?>
		</td>
		<td><?php echo h($project['Project']['name']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['repository_type']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['repository_url']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['default_branch']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['repository_username']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['repository_password']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['ssh_key']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['created']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $project['Project']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $project['Project']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $project['Project']['id']), array(), __('Are you sure you want to delete # %s?', $project['Project']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Project'), array('action' => 'add')); ?></li>
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
