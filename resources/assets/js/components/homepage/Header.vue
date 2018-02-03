<template>
	<!-- header wrapper -->
	<div class="home-header container-fluid">
		<div class="row">

			<!-- brand -->
			<div class="col-md-3 brand">
				<h1 class="navbar-brand">
					<router-link :to="{name: 'home'}">{{ brand }}</router-link>
				</h1>
			</div>

			<div class="col-md-3 col-md-offset-6 header-nav">
				<ul class="nav__navigation">
					<li class="nav__navigation--item">
						<a class="item__link" href="/">Home</a>
					</li>

					<li class="nav__navigation--item">
						<router-link class="item__link" :to="{name: 'auth'}">Sign in</router-link>
					</li>

					<li class="nav__navigation--item">
						<router-link class="item__link" :to="{name: 'signup'}">Sign up</router-link>
					</li>
				</ul>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				brand: 'Taskly'
			}
		}
	}
</script>

<style lang="scss">
	// header wrapper
	.home-header{
		height: 70px;
		width: 100%;
		background: #809ed3;
		color: #fff;
		font-family: 'Raleway';
		
		// brand container
		.brand{

			// the brand
			.navbar-brand{
				font-size: 22px;
				line-height: 0.2;
				a{color:#fff;}
			}
		}

		// navigation wrapper
		.header-nav{
			padding: 0.5rem;
			
			// the list wrapper 
			.nav__navigation{
				height: 100%;
				padding: 2rem;
				
				.nav__navigation--item{
					display:inline;
					margin-left: 5px;

					// item link
					.item__link{
						color: #fff;
						font-size: 18px;
					}
				}
			}
		}
	}
</style>