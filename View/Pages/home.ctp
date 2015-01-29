	<div class='box section section--first'>
		<div class='page-header'>
			<h2 class='page-header__title g-heading-alpha'>Dashboard</h2>
			<p class='page-header__lead'>
				The dashboard shows the recent activity on your account along with a list of currently available projects.
			</p>
		</div>
	</div>
	<div class='content--constrained'>
		<div class='box section section--first section--skinny'>
			<h4 class='g-heading-beta feed-heading'>Welcome to Deploy!</h4>
			<div class='content-block'>
				<p class='u-margin-bottom'>
					Glad to have you on board, please watch the video below to get a feel for how Deploy works, or if you just want to jump right in click "Create a new project" over there on the right.
				</p>
			</div>
		</div>
	</div>
	<div class='sidebar'>
		<div class='content-block'>
			<h3 class='sidebar__heading g-heading-gamma'>Your Projects</h3>
		</div>
		<?php
		if(empty($ProjectList)) :
		?>
		<div class='content-block'>
			<p class='g-text-subtle'>You are not assigned to any projects.</p>
		</div>
		<?php
		else :
			foreach($ProjectList as $key => $val):
				extract($val);
		?>
		<ul class='project-list layout-list box js-starred-projects'>
			<li class='project-list__item project-list__item--starred'>
				<a class="project-list__action js-star-project" href="/projects/star/<?php echo $Project['id']; ?>">
					<img alt="Icon star empty" class="project-list__icon project-list__star" src="/img/icons/icon-star-empty-983228f419b166694a1f89f859051c01.svg" title="Star Project" />
					<img alt="Icon star filled" class="project-list__icon project-list__unstar" src="/img/icons/icon-star-filled-16fc7e710d631c5bd1e26ae07ea4f816.svg" title="Unstar Project" />
				</a>
				<a class="project-list__link" href="/deployments/index/<?php echo $Project['id']; ?>"><?php echo $Project['name']; ?></a>
			</li>

		</ul>
		<?php
			endforeach;
		endif;
		?>
		<!-- TODO: 按星标显示不同的分组Project.Star
		<ul class='box is-hidden js-unstarred-projects layout-list project-list'>

		</ul>
		-->
		<div class='content-block'>
			<p><a class="text--micro text--link text--positive text--semibold" href="/projects/new">Create a new project →</a></p>
		</div>
	</div>
