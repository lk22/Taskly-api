<template>

	<!-- header wrapper -->
	<header id="home-header" class="container-fluid">
		<div class="row">

			<!-- brand -->
			<div class="col-md-3 brand">
				<h1 class="navbar-brand">Taskly</h1>
			</div>

			<div class="col-md-6 col-md-offset-3 header-nav">
				<ul class="navigation">
					<li class="nav-item">
						<router-link :to="{name: 'authentication'}">Sign in</router-link>
					</li>
				</ul>
			</div>
		</div>
	</header>
</template>