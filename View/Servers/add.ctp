	<div class='section section--first box'>
		<div class='page-header'>
			<h2 class='page-header__title g-heading-alpha'>Add New Server</h2>
			<p class='page-header__lead'>You can add an unlimited number of servers to your project. Each server can represent a different role of your project (for example you may have production, staging and development servers). Simply configure the appropriate fields below, we will attempt to connect to your server to ensure everything is OK when you click &lsquo;Save&rsquo;.</p>
		</div>
	</div>
	<div class='content--constrained'>
		<form accept-charset="UTF-8" action="/servers/new/<?php echo $Server['project_id']; ?>" autocomplete="off" class="new_server" id="new_server" method="post">
			<div style="display:none">
				<input name="utf8" type="hidden" value="&#x2713;" />
				<input name="authenticity_token" type="hidden" value="YyvJGdeB6KmHOTGVNWGwPXlD00PLTiOFwngTc6Jr38c=" />
				<input name="server[project_id]" type="hidden" value="<?php echo $Server['project_id']; ?>" />
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
						<a class="js-manage-server-groups" href="/server_groups/index/<?php echo $Server['project_id']; ?>">Manage Server Groups</a>.
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
	</div>
	<div class='sidebar'>
		<div class='content-block'>
			<h3 class='sidebar__heading g-heading-gamma'>Firewall Access</h3>
			<p>To grant Deploy access to your servers, please allow the following IP ranges through your firewall:</p>
			<ul>
				<li>
					<code>185.22.208.0/25</code>
				</li>
				<li>
					<code>2a00:67a0:a:1::/64</code>
				</li>
			</ul>

			<h3 class='sidebar__heading g-heading-gamma'>Host Key Checking</h3>
			<p>
				Deploy will make a note of your server's host key when we first connected to it.
			</p>
			<p>
				If this changes in future you may need to reset your host key from the server edit page.
			</p>

		</div>
	</div>
