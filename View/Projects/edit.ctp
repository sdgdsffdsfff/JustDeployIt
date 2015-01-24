	<div class='content--constrained'>
		<form accept-charset="UTF-8" action="/projects/edit/<?php echo $Project['id'];?>" class="edit_project" id="edit_project_<?php echo $Project['id'];?>" method="post">
			<div style="display:none">
				<input name="utf8" type="hidden" value="&#x2713;" />
				<input name="authenticity_token" type="hidden" value="4KixzdUUL2+E/WLOW6xvPIK5ydNR5egmlK76+SB1KKk=" />
				<input name="project[id]" type="hidden" value="<?php echo $Project['id'];?>" />
			</div>
			<div class='section section--first section--skinny box'>
				<h2 class='form-heading'>Project Settings</h2>
				<div class='form-group'>
					<label class="form-label" for="project_name">Name</label>
					<input class="form-control" id="project_name" name="project[name]" type="text" value="<?php echo $Project['name'];?>" />
					<p class='form-hint'>The name of a project is used to identify it within your Deploy account.</p>
				</div>
				<div class='form-group'>
					<label class="form-label" for="project_notification_email">Notification Email Address</label>
					<input class="form-control" id="project_notification_email" name="project[notification_email]" type="text" value="<?php echo $Project['notification_email'];?>" />
					<p class='form-hint'>Leave blank to use users email address.</p>
				</div>
			</div>
			<?php
			if(!isset($Repository)) :
			?>
			<div class='flash flash--info section--first'>
				<p>You haven&rsquo;t added your repository settings yet. <a href="/projects/repository/<?php echo $Project['id'];?>">Add them now</a>.</p>
			</div>
			<?php
			else:
			?>
				<div class='section section--first section--skinny box'>
					<h3 class='form-heading g-heading-beta u-margin-zero'>Repository Settings</h3>
					<p class='form-paragraph u-margin-top'>
						If you need to change your branch or repository URL you can do so below.
					</p>
					<input name="repository[id]" type="hidden" value="<?php echo $Repository['id'];?>" />
					<div class='js-repo-manual-details is-git-repo'>
						<h3 class='form-heading g-heading-gamma'>Repository Type</h3>
						<div class='form-group'>
							<div class='radio-block radio-block--no-label'>
								<label class="radio-block__group radio-block__group--full" for="scm_type_git">
									<input <?php if($Repository['scm_type'] == 'git') echo 'checked="checked"';?> class="radio-block__input js-scm-type" id="scm_type_git" name="repository[scm_type]" type="radio" value="git" />
									<span>Git</span>
								</label>
								<label class="radio-block__group radio-block__group--full" for="scm_type_subversion">
									<input <?php if($Repository['scm_type'] == 'subversion') echo 'checked="checked"';?> class="radio-block__input js-scm-type" id="scm_type_subversion" name="repository[scm_type]" type="radio" value="subversion" disabled />
									<span>Subversion</span>
								</label>
								<label class="radio-block__group radio-block__group--full" for="scm_type_mercurial">
									<input <?php if($Repository['scm_type'] == 'mercurial') echo 'checked="checked"';?> class="radio-block__input js-scm-type" id="scm_type_mercurial" name="repository[scm_type]" type="radio" value="mercurial" disabled />
									<span>Mercurial</span>
								</label>
							</div>
						</div>
						<hr class='form-separator'>
						<div class='form-group'>
							<label class="form-label" for="repository_url">Full URL to repository</label>
							<input class="form-control js-repo-url" id="repository_url" name="repository[url]" type="text" value="<?php echo $Repository['url'];?>" />
						</div>
						<div class='form-group is-related-git is-related-mercurial'>
							<label class="form-label" for="repository_port">Custom repository port (if required)</label>
							<input class="form-control" id="repository_port" name="repository[port]" type="text" value="<?php echo $Repository['port'];?>" />
						</div>
						<div class='form-group'>
							<label class="form-label" for="repository_root_path">Subdirectory to deploy from</label>
							<input class="form-control" id="repository_root_path" name="repository[root_path]" type="text" value="<?php echo $Repository['root_path'];?>" />
							<p class='form-hint'>
								The subdirectory in your repository that you wish to deploy.
								Leave blank to use the default specified in the project.
							</p>
						</div>
						<div class='form-group is-related-git is-related-mercurial'>
							<label class="form-label" for="repository_branch">Default branch you wish to deploy from?</label>
							<div class='form-select'>
								<select id="repository_branch" name="repository[branch]">
									<?php foreach($Repository['branches'] as $ky => $val) : ?>
									<option <?php if($val == $Repository['branch']) echo 'selected="selected"';?> value="<?php echo $val;?>"><?php echo $val;?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class='form-group js-auth-requirement-http is-hidden'>
							<div class='form-group'>
								<label class="form-label" for="repository_username">Username</label>
								<input class="form-control" id="repository_username" name="repository[username]" type="text" value="<?php echo $Repository['username'];?>" />
							</div>
							<div class='form-group'>
								<label class="form-label" for="repository_password">Password</label>
								<input class="form-control" id="repository_password" name="repository[password]" type="password" value="<?php echo $Repository['password'];?>" />
								<p class='form-hint'>Username/Password for HTTP only.</p>
							</div>
						</div>
						<div class='form-group js-auth-requirement-ssh'>
							<label class="form-label" for="deploy_generated_public">Use this public key and add it to your repository server&#39;s authorized keys:</label>
							<textarea class='textarea textarea--snippet' id='deploy_generated_public' readonly><?php echo $Project['public_key'];?></textarea>
						</div>
					</div>

					<div class='form-group js-auth-requirement-ssh'>
						<p class='form-paragraph u-margin-top'>
							Want to use your own keys? <a class="js-key-upload g-text-info g-text-underlined" href="#">Upload your private key</a>.
						</p>
					</div>
					<div class='form-group js-private-key-upload is-hidden'>
						<label class="form-label" for="custom_private_key">To use your own private key, copy and paste it into the box below:</label>
						<textarea class="textarea" id="project_custom_private_key" name="project[custom_private_key]"><?php echo $Project['custom_private_key'];?></textarea>
						<p class='form-paragraph u-margin-top'>
							Or use the public key that Deploy has <a class="js-use-generated-public-key g-text-info g-text-underlined" href="#">generated for you</a>.
						</p>
					</div>
				</div>
			<?php
			endif;
			?>
			<div class='form-submit'>
				<button class="button button--positive" name="button" type="submit">Save Changes</button>
			</div>
		</form>
	</div>
	<div class='sidebar'>
		<div class='content-block'>
			<?php
			if(isset($Repository)) :
			?>
			<h4 class='sidebar__heading g-heading-gamma'>Test Access</h4>
			<p>Push the button below and we'll run a quick test to see if we can login to your servers and repository.</p>
			<p>The result will be shown below.</p>
			<p><a class="button" href="#">Run Tests</a></p>
			<h4 class='sidebar__heading g-heading-gamma'>Recache Repository</h4>
			<p>Made some changes to your repository that Deploy hasn't picked up yet?</p>
			<p>Press this button to recache your repository.</p>
			<p><a class="button" data-confirm="Are you sure you want to recache your repository? You may be unavailable to Deploy this repository for a few minutes." data-method="post" href="/projects/recache/<?php echo $Project['id'];?>" rel="nofollow">Recache Repository</a></p>
			<?php
			endif;
			?>
			<h4 class='sidebar__heading g-heading-gamma'>Delete Project</h4>
			<p>A project’s server information and configuration files can not be accessed once deleted.</p>
			<p><a class="button button--negative" data-confirm="Are you sure you wish to remove this project?" data-method="delete" href="/projects/del/<?php echo $Project['id'];?>" rel="nofollow">Delete Project</a></p>
		</div>
	</div>
