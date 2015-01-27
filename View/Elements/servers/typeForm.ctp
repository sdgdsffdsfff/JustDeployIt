<?php
/**
 * 服务器类型表单视图
 *
 * to DRY, referenced by Servers/add.ctp， Servers/ssh.ctp， Servers/ftp.ctp
 *
 * 本视图比较特殊，对Servers/add.ctp而言，它是一个element被引用。对Serves/ssh.ctp、Servers/ftp.ctp而言，它是用来扩展的父视图
 */
?>
		<form accept-charset="UTF-8" action="/servers/new/<?php echo $Project['id']; ?>" autocomplete="off" class="new_server" id="new_server" method="post">
			<div style="display:none">
				<input name="utf8" type="hidden" value="&#x2713;" />
				<input name="authenticity_token" type="hidden" value="YyvJGdeB6KmHOTGVNWGwPXlD00PLTiOFwngTc6Jr38c=" />
				<input name="server[project_id]" type="hidden" value="<?php echo $Project['id']; ?>" />
			</div>
			<div class='section section--first section--skinny box'>
				<h3 class='form-heading form-heading--spaced g-heading-beta'>Choose Protocol</h3>
				<div class='form-group'>
					<label class="form-label" for="server_name">Name</label>
					<input class="form-control" id="server_name" name="server[name]" type="text" />
				</div>
				<div class='form-group'>
					<label class="form-label" for="server_type">Protocol</label>
					<div class='form-select'>
						<select id="server_type" name="server[type]">
							<option value="">Select Protocol</option>
							<option value="ssh">SSH/SFTP</option>
							<option value="ftp">FTP</option>
						</select>
					</div>
				</div>
			</div>
			<div class='js-protocol-container'>
				<?php echo $this->fetch('typeFormContent'); ?>
			</div>
			<div class='section section--first section--skinny box'>
				<h3 class='form-heading form-heading--spaced g-heading-beta'>Server Group</h3>
				<div class='form-group'>
					<label class="form-label" for="server_server_group">Server Group</label>
					<div class='form-select'>
						<select id="server_server_group_identifier" name="server[server_group_identifier]">
							<option value="">Individual Servers</option>
							<?php
							if(isset($ServerGroup)):
							foreach($ServerGroup as $key => $val):
							?>
							<option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
							<?php
							endforeach;
							endif;
							?>
						</select>
					</div>
					<p class='form-hint'>
						Select a group that this server will belong to. This server will then be deployed
						simultaniously with the other servers in the group.
						<a class="js-manage-server-groups" href="/server_groups/<?php echo $Project['id']; ?>">Manage Server Groups</a>.
					</p>
				</div>
			</div>
			<div class='box is-hidden js-deployment-options section section--first section--skinny'>
				<h3 class='form-heading form-heading--spaced g-heading-beta'>Deployment Options</h3>
				<div class='form-group'>
					<label class="form-label" for="server_notification_email">Notification email address</label>
					<input class="form-control" id="server_notification_email" name="server[notification_email]" type="text" />
					<p class='form-hint'>Leave blank to use project notification address.</p>
				</div>
				<div class='form-group'>
					<label class="form-label" for="server_branch">Branch to deploy from</label>
					<div class='form-select'>
						<select id="server_branch" name="server[branch]">
							<option value="">Project default (<?php echo $Repository['branch'];?>)</option>
							<?php foreach($Repository['branches'] as $ky => $val) : ?>
								<option value="<?php echo $val;?>"><?php echo $val;?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<div class='form-group'>
					<label class="form-label" for="server_environment">Environment</label>
					<input class="form-control" id="server_environment" name="server[environment]" type="text" />
					<p class='form-hint'>Production, Testing, Development etc. can be substituted into SSH commands.</p>
				</div>
				<div class='form-group'>
					<label class="form-label" for="server_root_path">Subdirectory to deploy from</label>
					<input class="form-control" id="server_root_path" name="server[root_path]" type="text" />
					<p class='form-hint'>
						The subdirectory in your repository that you wish to deploy.
						Leave blank to use the default specified in the project.
					</p>
				</div>
			</div>
			<div class='form-submit'>
				<button class="button button--positive" name="button" type="submit">Save</button>
			</div>
		</form>
