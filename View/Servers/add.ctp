	<div class='section section--first box'>
		<div class='page-header'>
			<h2 class='page-header__title g-heading-alpha'>Add New Server</h2>
			<p class='page-header__lead'>You can add an unlimited number of servers to your project. Each server can represent a different role of your project (for example you may have production, staging and development servers). Simply configure the appropriate fields below, we will attempt to connect to your server to ensure everything is OK when you click &lsquo;Save&rsquo;.</p>
		</div>
	</div>
	<div class='content--constrained'>
		<?php echo $this->element('servers/typeForm');?>
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
