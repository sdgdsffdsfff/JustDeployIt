<div class='page-header'>
	<h2 class='page-header__title g-heading-alpha'>Server Groups</h2>
</div>
<table class='table table--responsive u-margin-top'>
	<thead>
	<tr>
		<td>Name</td>
		<td>Existing Servers</td>
		<td></td>
	</tr>
	</thead>
	<tbody>
	<?php
	if(isset($ServerGroupList)) :
		foreach($ServerGroupList as $key => $val) :
			extract($val);
	?>
	<tr data-id='<?php echo $ServerGroup['id']; ?>' data-name='<?php echo $ServerGroup['name']; ?>'>
		<td><?php echo $ServerGroup['name']; ?></td>
		<td></td>
		<td class='table__actions u-text-right'>
			<a class="js-edit-server-group" href="/server_groups/edit/<?php echo $Project['id']; ?>/<?php echo $ServerGroup['id']; ?>"><img alt="Edit Icon" class="icon" src="/img/icons/icon-pencil-c3c83e027bd471c46571ffc8a6914974.svg" /></a>
			<a class="js-delete-server-group" data-confirm="Are you sure you wish to remove this server group?" data-method="delete" href="/server_groups/del/<?php echo $Project['id']; ?>/<?php echo $ServerGroup['id']; ?>" rel="nofollow"><img alt="Delete Icon" class="icon" src="/img/icons/icon-trash-4d0e03bf959145d64a6c5a9905127c05.svg" /></a>
		</td>
	</tr>
	<?php
		endforeach;
	else :
	?>
	<tr>
		<td class='g-text-subtle u-text-center' colspan='3'>No server groups have been created for this project.</td>
	</tr>
	<?php
	endif;
	?>
	</tbody>
</table>
<div class='form-group u-margin-top u-text-right'>
	<a class="button button--positive js-new-server-group" href="/server_groups/new/<?php echo $Project['id']; ?>">New Server Group</a>
</div>
