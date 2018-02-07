<template>
	<div>
		<div id="sidebar" class="sidebar">
			<div class="sidebar__inner--desktop hidden-xs">
				<div class="sidebar__link">
					<router-link :to="{name: 'dashboard-tasks'}"><i class="fa fa-bars"></i></router-link>
				</div>
				<!-- <div class="sidebar__link">
					<router-link :to="{name: 'authenticated-user'}"><i class="fa fa-cog"></i></router-link>
				</div> -->
				<div class="bottom">
					<i class="fa fa-user"></i>
				</div>
			</div>
			
			<!-- mobile sidebar-header -->
			<div class="sidebar__inner--mobile hidden-md hidden-lg">
				<div class="row">
					<div class="col-xs-3 tasks-link">
						<router-link :to="{name: 'dashboard-tasks'}"><i class="fa fa-bars"></i></router-link>
					</div>

					<div class="col-xs-3 logout-link">
						<div class="logout">
							<i class="fa fa-user-times"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="scss">
	#sidebar{
		min-height: 800px;
		width: 100%; 
		border-right: 1px solid #809ed3;
		background: #fff;
		
		@media screen and(max-width: 400px) {
			min-height: 35px;
			border:none;
			background: #809ed3;
			color: #fff;
			margin-left: 0px;
			margin-right: 0px;
		}

		.sidebar__inner--desktop{
			padding: 1.5rem;

			.sidebar__link{
				padding-top: 1.5rem;
				padding-left: 0.5rem;
			
				a{
					color: #00B0EB; 
				}
			}

			.bottom{
				position: absolute;
				bottom: 10px;
				left: 2.5rem;
				color: #00B0EB 
			}
		}

		.sidebar__inner--mobile{
			padding:1.5rem;
			.tasks-link{
				a {
					color: #fff;
				}
			}
		}
	}
</style>