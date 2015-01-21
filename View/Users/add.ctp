	<div class='section section--first box'>
		<div class='page-header'>
			<h2 class='page-header__title g-heading-alpha'>Add New User</h2>
			<p class='page-header__lead'>Once created, the user will receive an email with setup instructions.</p>
		</div>
	</div>
	<form accept-charset="UTF-8" action="/users/new" class="new_user" id="new_user" method="post"><div style="display:none"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="QFy+K8j0wqfIVSkkd89qe/QEo2wgm/4H1FtjcbzE47I=" /></div><div class='content--constrained'>

			<div class='section section--skinny section--first box'>
				<h3 class='form-heading g-heading-beta u-margin-zero'>Personal Details</h3>
				<div class='form-set'>
					<div class='form-group'>
						<label class="form-label" for="user_first_name">Full Name</label>
						<input class="form-control" id="user_first_name" name="user[full_name]" type="text" />
					</div>
					<div class='form-group'>
						<label class="form-label" for="user_last_name">Password</label>
						<input class="form-control" id="user_last_name" name="user[password]" type="text" />
					</div>
					<div class='form-group'>
						<label class="form-label" for="user_email_address">Email Address</label>
						<input class="form-control" id="user_email_address" name="user[email_address]" type="text" />
					</div>
				</div>
				<h3 class='form-heading u-margin-zero g-heading-gamma'>Account Administrator</h3>
				<div class='form-group form-set'>
					<label class="form-checkbox" for="user_account_administrator"><input name="user[account_administrator]" type="hidden" value="0" /><input class="form-checkbox__input js-account-admin" id="user_account_administrator" name="user[account_administrator]" type="checkbox" value="1" />
						<span class='form-checkbox__text'>Is an account administrator?</span>
					</label><p class='form-hint'>Account administrators can create/delete projects, and access the billing centre.</p>
				</div>
				<h3 class='form-heading u-margin-zero g-heading-gamma'>User Manager</h3>
				<div class='form-group form-set'>
					<label class="form-checkbox" for="user_can_manage_users"><input name="user[can_manage_users]" type="hidden" value="0" /><input class="form-checkbox__input js-user-manager" id="user_can_manage_users" name="user[can_manage_users]" type="checkbox" value="1" />
						<span class='form-checkbox__text'>Can manage other users?</span>
					</label><p class='form-hint'>User managers can create/delete users, and assign other users to projects.</p>
				</div>
				<h3 class='form-heading u-margin-zero g-heading-gamma'>Project Access</h3>
				<div class='form-set'>
					<p class='form-paragraph'>
						Which projects should this user have access to?
					</p>
					<div class='form-group'>
						<ul class='checkbox-list'>
							<li class='checkbox-list__item checkbox-list__item--separated is-all-checkbox js-checkbox-container'>
								<label class="form-checkbox" for="all_projects"><input checked="checked" class="form-checkbox__input is-toggle-hint js-checkbox-all" id="all_projects" name="all_projects" type="checkbox" value="1" />
									<span class='form-checkbox__text'>All Projects</span>
									<p class='form-hint g-text-positive animated fadeIn'>
										This user will automatically be assigned to all current and future projects.
									</p>
								</label></li>
							<li class='checkbox-list__item'>
								<label class="form-checkbox" for="project_91546"><input class="form-checkbox__input" id="project_91546" name="user[projects_allowed][]" type="checkbox" value="91546" />
									<span class='form-checkbox__text'>DeepPHPOOP</span>
								</label></li>
						</ul>
					</div>
				</div>
			</div>
			<div class='form-submit'>
				<button class="button button--positive" name="button" type="submit">Create User</button>
			</div>
		</div>
	</form>
