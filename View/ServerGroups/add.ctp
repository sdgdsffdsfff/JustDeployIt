<div class='page-header'>
	<h2 class='page-header__title g-heading-alpha'>Create Server Group</h2>
	<p class='page-header__lead'>Use this interface to create a new server group and specify the branch for it the group to track. Once you&rsquo;ve created your group you&rsquo;ll be sent to the servers page to add servers to the group.</p>
</div>
<div class='u-margin-top'>
	<form accept-charset="UTF-8" action="/server_groups/new/<?php echo $Project['id']; ?>" class="new_server_group" id="new_server_group" method="post">
		<div style="display:none">
			<input name="utf8" type="hidden" value="&#x2713;" />
			<input name="authenticity_token" type="hidden" value="YyvJGdeB6KmHOTGVNWGwPXlD00PLTiOFwngTc6Jr38c=" />
			<input name="server_group[project_id]" type="hidden" value="<?php echo $Project['id']; ?>" />
		</div>
		<div class='form-group'>
			<label class="form-label" for="server_group_name">Name</label>
			<input class="form-control" id="server_group_name" name="server_group[name]" type="text" />
		</div>
		<div class='form-group'>
			<label class="form-label" for="server_group_branch">Branch</label>
			<div class='form-select'>
				<select id="server_group_branch" name="server_group[branch]">
					<option value="">Project default (<?php echo $Repository['branch'];?>)</option>
					<?php foreach($Repository['branches'] as $ky => $val) : ?>
						<option value="<?php echo $val;?>"><?php echo $val;?></option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
		<div class='form-group'>
			<button class="button button--positive" name="button" type="submit">Create Server Group</button>
		</div>
	</form>


</div>
