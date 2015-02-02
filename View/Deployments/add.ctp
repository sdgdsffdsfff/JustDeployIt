	<div class='section section--first box'>
		<div class='page-header'>
			<h2 class='page-header__title g-heading-alpha'>New Deployment</h2>
			<p class='page-header__lead'>
				To deploy your project, just enter the revisions you wish to remove to and from using the form below and click 'Deploy' to run the deployment straight away.
			</p>
		</div>
	</div>
	<form accept-charset="UTF-8" action="/deployments/new/<?php echo $Project['id']; ?>" class="new_deployment" id="new_deployment" method="post">
		<div style="display:none">
			<input name="utf8" type="hidden" value="&#x2713;" />
			<input name="authenticity_token" type="hidden" value="lrgo11x68Isgd3O3SqO0BI3hTEBamU2O3XWubhaTZbg=" />
		</div>
		<div class='section section--first section--skinny box'>
			<h3 class='form-heading g-heading-beta'>1. Select a server</h3>
			<p class='form-paragraph'>
				Select the server you wish to deploy your project to.
				If the server you wish to deploy to is not in the list, you can create new servers within <a href="/servers/new/<?php echo $Project['id']; ?>">server settings</a>. The last server you deployed to is selected by default.
			</p>
			<div class='form-group form-group--inline-block'>
				<div class='form-select'>
					<select id="deployment_parent_identifier" name="deployment[parent_identifier]">
						<?php
						// 需要计算默认情况下应该操作的分支
						$defaultBranch = '';
						if(!empty($ServerList)) :
						?>
						<optgroup label="Individual Servers">
							<?php
							foreach($ServerList as $key => $val) :
								extract($val);
								if(empty($defaultBranch)) : // 取第一个为默认
									$defaultBranch = empty($Server['branch']) ? $Repository['branch'] : $Server['branch'];
								endif;
							?>
							<option value="<?php echo $Server['id'].'.Server';?>"><?php echo $Server['name'];?> (<?php echo $Server['username'].'@'.$Server['hostname'];?>)</option>
							<?php
							endforeach;
							?>
						</optgroup>
						<?php
						endif;
						?>
						<?php
						if(!empty($GroupList)) :
						?>
						<optgroup label="Server Groups">
							<?php
							foreach($GroupList as $key => $val) :
								extract($val);
								if(empty($defaultBranch)) : // 取第一个为默认
									$defaultBranch = empty($ServerGroup['branch']) ? $Repository['branch'] : $ServerGroup['branch'];
								endif;

								$servers = '';
								if(empty($Server)) :
									$servers = 'No Servers';
								else :
									foreach($Server as $key => $val):
										$servers .= $val['name'].',';
									endforeach;
									$servers = trim($servers, ',');
								endif;

							?>
							<option value="<?php echo $ServerGroup['id'].'.ServerGroup';?>"><?php echo $ServerGroup['name'];?> (<?php echo $servers;?>)</option>
							<?php
							endforeach;
							?>
						</optgroup>
						<?php
						endif;
						?>
					</select>
				</div>
			</div>
		</div>
		<div class='section section--first section--skinny box'>
			<h3 class='form-heading g-heading-beta'>2. Choose revisions/commits to deploy</h3>
			<p class='form-paragraph'>
				Enter the range of commits which you wish to deploy.
				Once you have selected a server, the start commit will automatically be set to the last revision you deployed.
			</p>
			<div class='form-group'>
				<h4 class='form-heading g-heading-gamma'>Start Commit</h4>
				<div class='js revision js-start-commit'>
					<p class='commit-info'>
						Beginning of time...
					</p>
					<a class="g-text-subtle change-text js-change-ref" href="#">(change)</a>
					<input id="deployment_start_revision" name="deployment[start_revision]" type="hidden" />
				</div>
			</div>
			<div class='form-group'>
				<h4 class='form-heading g-heading-gamma'>End Commit</h4>
				<div class='js-revision js-end-commit'>
					<p class='commit-info'>
						Fetching information from repository....
					</p>
					<a class="g-text-subtle change-text js-change-ref" href="#">(change)</a>
					<input id="deployment_end_revision" name="deployment[end_revision]" type="hidden" />
				</div>
			</div>
			<p class='form-paragraph g-text-subtle g-text-small'><a class="text--link text--semibold text--info text--micro js-show-advanced" href="#">Show Advanced Options</a></p>
			<div class='animated fadeIn is-hidden js-advanced-options'>
				<p class='form-paragraph'>Use the checkboxes below to change some of the behaviour for this deployment.</p>
				<div class='form-group'>
					<label class="form-checkbox" for="deployment_copy_config_files">
						<input name="deployment[copy_config_files]" type="hidden" value="0" />
						<input checked="checked" class="form-checkbox__input" id="deployment_copy_config_files" name="deployment[copy_config_files]" type="checkbox" value="1" />
						<span class='form-checkbox__text'>Copy <a href="/projects/deepphpoop/config_files">defined config files</a> to server?</span>
					</label></div>
				<div class='form-group'>
					<label class="form-checkbox" for="deployment_email_notify">
						<input name="deployment[email_notify]" type="hidden" value="0" />
						<input class="form-checkbox__input" id="deployment_email_notify" name="deployment[email_notify]" type="checkbox" value="1" />
						<span class='form-checkbox__text'>Send me an e-mail with the result of this deployment?</span>
					</label></div>
			</div>
		</div>
		<div class='section section--skinny section--first box'>
			<h3 class='form-heading g-heading-beta'>3. Run the deployment</h3>
			<p class='form-paragraph'>
				When you are happy with the fields you have entered above, just click 'Preview Deployment'.
				This will show you the preview of what will actually be carried out on your remote service.
			</p>
			<p class='form-paragraph'>However, if you'd rather not preview before deploying, click 'Run Deployment' to begin straight away.</p>
			<div class='form-group u-margin-top'>
				<input id="deployment_branch" name="deployment[branch]" type="hidden" value="<?php echo $defaultBranch; ?>" />
				<button class="button u-margin-right" name="preview" type="sumbit">Preview Deployment</button>
				<button class="button button--positive" name="submit" type="submit">Run Deployment</button>
			</div>
		</div>
	</form>
