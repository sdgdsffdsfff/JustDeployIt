<div class='content'>
    <div class='page-header form-group'>
        <h2 class='page-header__title g-heading-alpha'>Server Group: <?php echo $ServerGroup['name'];?></h2>
    </div>
    <form accept-charset="UTF-8" action="/server_groups/edit/<?php echo $ServerGroup['project_id'];?>/<?php echo $ServerGroup['id'];?>" class="edit_server_group" id="edit_server_group_9262" method="post">
        <div style="display:none">
			<input name="utf8" type="hidden" value="&#x2713;"/>
			<input name="authenticity_token" type="hidden" value="ZbMoWfr9xuhgG+WAQLU0D93YzWOSBirObepeq0/lYLM="/>
			<input name="server_group[project_id]" type="hidden" value="<?php echo $ServerGroup['project_id'];?>"/>
			<input name="server_group[id]" type="hidden" value="<?php echo $ServerGroup['id'];?>"/>
		</div>
        <div class='form-group'>
            <label class="form-label" for="server_group_name">Name</label>
            <input class="form-control" id="server_group_name" name="server_group[name]" type="text" value="<?php echo $ServerGroup['name'];?>"/>
        </div>
        <div class='form-group'>
            <label class="form-label" for="server_group_branch">Branch</label>
            <div class='form-select'>
                <select id="server_group_branch" name="server_group[branch]">
					<option value="">Project default (<?php echo $Repository['branch'];?>)</option>
					<?php foreach($Repository['branches'] as $ky => $val) : ?>
						<option <?php if($ServerGroup['branch'] == $val) echo 'selected="selected"'; ?> value="<?php echo $val;?>"><?php echo $val;?></option>
					<?php endforeach;?>
                </select>
            </div>
        </div>
        <div class='form-group'>
            <button class="button button--positive" name="button" type="submit">Create Server Group</button>
        </div>
    </form>
</div>
