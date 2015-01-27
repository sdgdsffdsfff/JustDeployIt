	<p class='page-back'>
		<a class="page-back__link" href="/servers/index/<?php echo $Server['project_id']; ?>">&#8592; Back to servers list</a>
	</p>
	<div class='section section--first box'>
		<div class='page-header'>
			<h2 class='page-header__title g-heading-alpha'>Edit Server</h2>
			<p class='page-header__lead'>When you press save we will validate the credentials to ensure we can connect successfully with the details you have provided.</p>
		</div>
	</div>
	<div class='content--constrained'>
		<form accept-charset="UTF-8" action="/servers/edit/<?php echo $Server['project_id']; ?>/<?php echo $Server['id']; ?>" autocomplete="off" class="edit_server" id="edit_server_<?php echo $Server['id']; ?>" method="post">
			<div style="display:none"><input name="utf8" type="hidden" value="&#x2713;" />
				<input name="authenticity_token" type="hidden" value="YyvJGdeB6KmHOTGVNWGwPXlD00PLTiOFwngTc6Jr38c=" />
				<input name="server[project_id]" type="hidden" value="<?php echo $Server['project_id']; ?>" />
				<input name="server[id]" type="hidden" value="<?php echo $Server['id']; ?>" />
			</div>
			<div class='section section--first section--skinny box'>
				<h3 class='form-heading form-heading--spaced g-heading-beta'>Choose Protocol</h3>
				<div class='form-group'>
					<label class="form-label" for="server_name">Name</label>
					<input class="form-control" id="server_name" name="server[name]" type="text" value="<?php echo $Server['name']; ?>" />
				</div>
				<div class='form-group'>
					<label class="form-label" for="server_type">Protocol</label>
					<div class='form-select'>
						<select id="server_type" name="server[type]">
							<option value="">Select Protocol</option>
							<option <?php if($Server['type'] == 'ssh') echo 'selected="selected"';?> value="ssh">SSH/SFTP</option>
							<option <?php if($Server['type'] == 'ftp') echo 'selected="selected"';?> value="ftp">FTP</option>
						</select>
					</div>
				</div>
			</div>
			<div class='js-protocol-container'>
				<?php
				echo $this->element('servers/edit_'.$Server['type']);
				?>
			</div>
			<div class='section section--first section--skinny box'>
				<h3 class='form-heading form-heading--spaced g-heading-beta'>Server Group</h3>
				<div class='form-group'>
					<label class="form-label" for="server_server_group">Server Group</label>
					<div class='form-select'>
						<select id="server_server_group_identifier" name="server[server_group_identifier]">
							<option value="">Individual Servers</option>
							<option selected="selected" value="b9f12823-d554-8315-3307-02b09a3217f3">TestingGroup</option>
							<option value="6bfa0c88-1fb1-a8ef-cca9-1571f6e83268">SecondGS</option>
						</select>
					</div>
					<p class='form-hint'>
						Select a group that this server will belong to. This server will then be deployed
						simultaniously with the other servers in the group.
						<a class="js-manage-server-groups" href="/projects/deepphpoop/server_groups">Manage Server Groups</a>.
					</p>
				</div>
			</div>
			<div class='section section--first section--skinny box js-deployment-options'>
				<h3 class='form-heading form-heading--spaced g-heading-beta'>Deployment Options</h3>
				<div class='form-group'>
					<label class="form-label" for="server_notification_email">Notification email address</label>
					<input class="form-control" id="server_notification_email" name="server[notification_email]" type="text" value="" />
					<p class='form-hint'>Leave blank to use project notification address.</p>
				</div>
				<div class='form-group'>
					<label class="form-label" for="server_branch">Branch to deploy from</label>
					<div class='form-select'>
						<select disabled="disabled" id="server_branch" name="server[branch]">
							<option selected="selected" value="">Group default ()</option>
							<option value="dev_zsk">dev_zsk</option>
							<option value="dev_zsk2">dev_zsk2</option>
							<option value="master">master</option></select>
					</div>
				</div>
				<div class='form-group'>
					<label class="form-label" for="server_environment">Environment</label>
					<input class="form-control" id="server_environment" name="server[environment]" type="text" value="" />
					<p class='form-hint'>Production, Testing, Development etc. can be substituted into SSH commands.</p>
				</div>
				<div class='form-group'>
					<label class="form-label" for="server_root_path">Subdirectory to deploy from</label>
					<input class="form-control" id="server_root_path" name="server[root_path]" type="text" value="" />
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
			<h4 class='sidebar__heading g-heading-gamma'>Automatic Deployment</h4>
			<form accept-charset="UTF-8" action="/projects/deepphpoop/servers/b44c0963-91af-651f-0810-8f9a26375277" class="edit_server" id="server_auto_deploy" method="post"><div style="display:none"><input name="utf8" type="hidden" value="&#x2713;" /><input name="_method" type="hidden" value="patch" /><input name="authenticity_token" type="hidden" value="YyvJGdeB6KmHOTGVNWGwPXlD00PLTiOFwngTc6Jr38c=" /></div><p class='clearfix'>
					<label class="form-checkbox form-checkbox--inline" for="server_auto_deploy_true"><input checked="checked" class="form-checkbox__input" id="server_auto_deploy_true" name="server[auto_deploy]" type="radio" value="true" />
						<span class='form-checkbox__text g-text-semibold g-text-positive'>On</span>
					</label><label class="form-checkbox form-checkbox--inline" for="server_auto_deploy_false"><input class="form-checkbox__input" id="server_auto_deploy_false" name="server[auto_deploy]" type="radio" value="false" />
						<span class='form-checkbox__text g-text-semibold g-text-negative'>Off</span>
					</label></p>
			</form>

			<p>You can use the URL below as a Github or Codebase post-receive hook to trigger an automatic deployment of your project.</p>
			<p><input class="form-control g-text-code" id="api_key" name="api_key" readonly="readonly" type="text" value="https://treetree.deployhq.com/deploy/deepphpoop/to/royalwebhosting/sr34ballntut" /></p>
			<p>For more information please see our <a href="http://support.deployhq.com/articles/deployments">documentation pages</a>.</p>

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
				You may need to reset your host key if you've changed your server.
			</p>
			<p><a class="button" data-confirm="Are you sure you want to reset your host key?" href="#">Reset Host Key</a></p>

		</div>
	</div>
