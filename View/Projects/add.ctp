	<div class='section section--first box'>
		<div class='page-header'>
			<h2 class='page-header__title g-heading-alpha'>New Project</h2>
			<div class='page-header__lead'>
				<p>Once created, you’ll be able to add repository and server details. You have <strong>21 more projects</strong> remaining. If you need more, <a href="/billing/package">click here to upgrade</a>.</p>

			</div>
		</div>
	</div>
	<div class='content--constrained'>
		<form accept-charset="UTF-8" action="/projects" class="new_project" id="new_project" method="post"><div style="display:none"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="YyvJGdeB6KmHOTGVNWGwPXlD00PLTiOFwngTc6Jr38c=" /></div><div class='section section--first section--skinny box js-project-name'>
				<div class='form-group'>
					<label class="form-label" for="project_name">Enter a name for the project:</label>
					<input autofocus="autofocus" class="form-control" id="project_name" name="project[name]" type="text" />
				</div>
			</div>
			<div class='section section--first section--skinny box js-source-select'>
				<h3 class='g-heading-beta'>Where is your respository hosted?</h3>
				<div class='host-select row js-host-select'>
					<div class='host-select__column js-host' data-provider='github'>
						<a class="host-select__inner" href="#" title="github"><img alt="github" class="host-select__logo" src="/img/logo-github-6dc2ba1f46e075155cd5ac8891c3b3c8.svg" /></a>
					</div>
					<div class='host-select__column js-host' data-provider='codebase'>
						<a class="host-select__inner" href="#" title="codebase"><img alt="codebase" class="host-select__logo" src="/img/logo-codebase-d43e1f209ad2ff67a9d27c05be1ccf44.svg" /></a>
					</div>
					<div class='host-select__column js-host' data-provider='bitbucket'>
						<a class="host-select__inner" href="#" title="bitbucket"><img alt="bitbucket" class="host-select__logo" src="/img/logo-bitbucket-80ea29fc1a2e1e35ca304910ac46e8dc.svg" /></a>
					</div>
				</div>
				<input id="repository_source" name="repository_source" type="hidden" />
				<p class='form-paragraph'>
					Hosted somewhere else? <a class="js-host-manual g-text-info g-text-underlined" href="#">Manually enter repository details</a>.
				</p>
			</div>
			<div class='section section--first section--skinny box js-host-manual-details is-hidden'>
				<h3 class='form-heading g-heading-beta'>Your Repository Details</h3>
				<div class='js-repo-manual-details is-git-repo'>
					<h3 class='form-heading g-heading-gamma'>Repository Type</h3>
					<div class='form-group'>
						<div class='radio-block radio-block--no-label'>
							<label class="radio-block__group radio-block__group--full" for="scm_type_git"><input checked="checked" class="radio-block__input js-scm-type" id="scm_type_git" name="repository[scm_type]" type="radio" value="git" />
								<span>Git</span>
							</label><label class="radio-block__group radio-block__group--full" for="scm_type_subversion"><input class="radio-block__input js-scm-type" id="scm_type_subversion" name="repository[scm_type]" type="radio" value="subversion" />
								<span>Subversion</span>
							</label><label class="radio-block__group radio-block__group--full" for="scm_type_mercurial"><input class="radio-block__input js-scm-type" id="scm_type_mercurial" name="repository[scm_type]" type="radio" value="mercurial" />
								<span>Mercurial</span>
							</label></div>
					</div>
					<hr class='form-separator'>
					<div class='form-group'>
						<label class="form-label" for="repository_url">Full URL to repository</label>
						<input class="form-control js-repo-url" id="repository_url" name="repository[url]" type="text" />
					</div>
					<div class='form-group is-related-git is-related-mercurial'>
						<label class="form-label" for="repository_port">Custom repository port (if required)</label>
						<input class="form-control" id="repository_port" name="repository[port]" type="text" />
					</div>
					<div class='form-group is-related-git is-related-mercurial'>
						<label class="form-label" for="repository_branch">Default branch you wish to deploy from?</label>
						<input class="form-control" id="repository_branch" name="repository[branch]" type="text" />
					</div>
					<div class='form-group js-auth-requirement-http is-hidden'>
						<div class='form-group'>
							<label class="form-label" for="repository_username">Username</label>
							<input class="form-control" id="repository_username" name="repository[username]" type="text" />
						</div>
						<div class='form-group'>
							<label class="form-label" for="repository_password">Password</label>
							<input class="form-control" id="repository_password" name="repository[password]" type="password" />
							<p class='form-hint'>Username/Password for HTTP only.</p>
						</div>
					</div>
					<div class='form-group js-auth-requirement-ssh'>
						<label class="form-label" for="deploy_generated_public">Use this public key and add it to your repository server&#39;s authorized keys:</label>
						<textarea class='textarea textarea--snippet' id='deploy_generated_public' readonly>ssh-rsa AAAAB3NzaC1yc2EAAAABIwAAAQEAuSPH4FpSYh6x76WaZMvG9hxwkRHTNaHj9PgN/HfsHte7b6qn/TqBUfxqCZOTQ7yZhs+dV6IExHLhhL1EIcr4X5qzasFpMmLOFveV+S0stRCSAl8PUkkxNDSSW2pFyTmg+OhbscLUU2Pk0uH5PD7QUfM6+j/Ls9C1pix/SRaLd4q6h/Uu1+YAWEz6e4+IA/VxmZjn/7YwkU2jk/fklM4pnC9IehfaPlVPufD/8rt7ZhCyuCP7lZURwH328u+5bn8h8fiV5CjOccNvXpEhnpch9Hk194/YLXmtUQPrSV+pVdgE7l7xclYltWGfeyC5TDAEUCPtw8s3n/fAzvIfJTtoMw==</textarea>
					</div>
				</div>

				<div class='form-group js-auth-requirement-ssh'>
					<p class='form-paragraph u-margin-top'>
						Want to use your own keys? <a class="js-key-upload g-text-info g-text-underlined" href="#">Upload your private key</a>.
					</p>
				</div>
				<div class='form-group js-private-key-upload is-hidden'>
					<label class="form-label" for="custom_private_key">To use your own private key, copy and paste it into the box below:</label>
<textarea class="textarea" id="project_custom_private_key" name="project[custom_private_key]">
</textarea>
					<p class='form-paragraph u-margin-top'>
						Or use the public key that Deploy has <a class="js-use-generated-public-key g-text-info g-text-underlined" href="#">generated for you</a>.
					</p>
				</div>

			</div>
			<div class='form-submit'>
				<input id="project_keypair_identifier" name="project[keypair_identifier]" type="hidden" value="6e23a218-2c05-cf64-5fac-e20e4fbaf0ac" />
				<button class="button button--positive" name="button" type="submit">Create Project</button>
			</div>
		</form>

	</div>
	<div class='sidebar'>
		<div class='content-block'>
			<h3 class='sidebar__heading g-heading-gamma'>Supported SCMs</h3>
			<p>We currently support the following version control systems:</p>
			<ul>
				<li>Git</li>
				<li>Subversion</li>
				<li>Mercurial</li>
			</ul>
			<p>We also integrate directly with <a href="http://www.codebasehq.com">Codebase</a> and other source code hosting sites.</p>
			<h3 class='sidebar__heading g-heading-gamma'>Supported Servers</h3>
			<p>We currently support the following server technologies for receiving your deployed code:</p>
			<ul>
				<li>SSH/SFTP</li>
				<li>FTP</li>
				<li>Amazon S3</li>
				<li>Rackspace Cloud Files</li>
			</ul>
		</div>
	</div>
