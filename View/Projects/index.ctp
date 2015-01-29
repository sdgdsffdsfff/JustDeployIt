<?php
/**
 * 根据项目列表展示不同视图
 *
 * 有项目和无项目的界面差异很大
 */
if(empty($projectList)) :
?>
	<div class='box section section--first section--with-create'>
		<a class="button button--positive button--create section__create" href="/projects/new" title="Create a new project"><img alt="Icon add" class="button__icon" src="/img/icons/icon-add-e0280f31016ead5fa85f6969fbd6f2db.svg" /></a>
		<div class='page-header'>
			<h2 class='page-header__title g-heading-alpha'>Welcome to Deploy!</h2>
			<p class='page-header__lead'>
				Create a project to start deploying your Git, Mercurial, and Subversion repositories directly to any of your FTP or SFTP servers.After creating your project, you'll need to configure the repository and server details.
			</p>
		</div>
	</div>
	<div class='section--first u-text-center'>
		<p class='first-project'>
			<img alt="Crate" class="large-icon u-margin-bottom" src="/img/crate-19d6c1be00f83b61444752f5fe7ff6b1.svg" />
			<a class="button button--positive" href="/projects/new">Create your first project →</a>
		</p>
	</div>
<?php
else :
?>
	<div class='box section section--first section--with-create'>
		<a class="button button--positive button--create section__create" href="/projects/new" title="Create a new project"><img alt="Icon add" class="button__icon" src="/img/icons/icon-add-e0280f31016ead5fa85f6969fbd6f2db.svg" /></a>
		<div class='page-header'>
			<h2 class='page-header__title g-heading-alpha'>Your Projects</h2>
			<p class='page-header__lead'>
				The list below shows all the projects which are currently set up for this account.
				Click on a project to view further details or select 'Deploy Now' to be taken straight to the new deployment screen.
			</p>
		</div>
	</div>
	<div class='clearfix'>
		<form accept-charset="UTF-8" action="/users/3471e5ea-a920-5641-1ed9-16609e345521/projects_sort_preference" class="order-preference" id="user_project_sort" method="post">
			<div style="display:none">
				<input name="utf8" type="hidden" value="&#x2713;" />
				<input name="_method" type="hidden" value="patch" />
				<input name="authenticity_token" type="hidden" value="laBOjZbXcHz2Vlufb95oRysGrNnebQP1pBO7NWuJXns=" />
			</div>
			<div class='action-block clearfix'>
				<div class='action-block__sort radio-block js-project-sort'>
					<strong class='radio-block__label'>Sort:</strong>
					<label class="radio-block__group" for="user_alphabetic_sort_true">
						<input class="radio-block__input" id="user_alphabetic_sort_true" name="user[alphabetic_sort]" type="radio" value="true" />
						<span>Alphabetically</span>
					</label>
					<label class="radio-block__group" for="user_alphabetic_sort_false">
						<input checked="checked" class="radio-block__input" id="user_alphabetic_sort_false" name="user[alphabetic_sort]" type="radio" value="false" />
						<span>Recently Deployed</span>
					</label>
				</div>
			</div>
		</form>

		<form accept-charset="UTF-8" action="/users/3471e5ea-a920-5641-1ed9-16609e345521/projects_view_preference" class="edit_user" id="user_project_view" method="post">
			<div style="display:none">
				<input name="utf8" type="hidden" value="&#x2713;" />
				<input name="_method" type="hidden" value="patch" />
				<input name="authenticity_token" type="hidden" value="laBOjZbXcHz2Vlufb95oRysGrNnebQP1pBO7NWuJXns=" />
			</div>
			<ul class='view-preference layout-list clearfix box'>
				<li class='view-preference__item'>
					<a class="view-preference__link  js-view-preference" href="#"><img alt="Icon list table" class="view-preference__icon" src="/img/icons/icon-list-table-1d3083531e7d60e4677a1f896aa3e3cb.svg" /></a>
					<input class="is-hidden" id="user_compact_view_true" name="user[compact_view]" type="radio" value="true" />
				</li>
				<li class='view-preference__item'>
					<a class="view-preference__link is-active js-view-preference" href="#"><img alt="Icon list block white" class="view-preference__icon" src="/img/icons/icon-list-block-white-f9dfb5ef9ca2d4b6f399d1e61e04c048.svg" /></a>
					<input checked="checked" class="is-hidden" id="user_compact_view_false" name="user[compact_view]" type="radio" value="false" />
				</li>
			</ul>
		</form>

	</div>
	<ul class='project-listings layout-list clearfix js-project-list'>
		<?php
		foreach($projectList as $key => $val) :
			extract($val);
		?>
		<li class='project-listing js-project' data-last-deployed='1420966178' data-name='DeepPHPOOP'>
			<div class='box'>
				<h3 class='g-heading-beta project-listing__name'><a href="/projects/edit/<?php echo $Project['id'];?>"><?php echo $Project['name'];?></a></h3>
				<div class='project-listing__bar'>
					<div class='project-listing__deployments'>
						<span class='project-listing__count'><?php echo count($Deployment);?></span>
						<span class='project-listing__count-title'>Deployments</span>
					</div>
					<div class='project-listing__servers'>
						<span class='project-listing__count'><?php echo count($Server);?></span>
						<span class='project-listing__count-title'>Servers</span>
					</div>
					<div class='project-listing__deploy'>
						<a class="project-listing__deploy-button" href="/deployments/new/<?php echo $Project['id'];?>">Deploy</a>
					</div>
				</div>
			</div>
		</li>
		<?php
		endforeach;
		?>
	</ul>
<?php
	endif;
?>