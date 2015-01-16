<div class="projects form">
<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Project'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('repository_type');
		echo $this->Form->input('repository_url');
		echo $this->Form->input('default_branch');
		echo $this->Form->input('repository_username');
		echo $this->Form->input('repository_password');
		echo $this->Form->input('ssh_key');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Projects'), array('action' => 'index')); ?></li>
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
