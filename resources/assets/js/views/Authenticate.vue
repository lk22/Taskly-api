<template>
	<!-- authentication wrapper -->
	<div class="taskly-auth">

		<!-- authentication container -->
		<div class="auth__container">
			
			<!-- sign in container -->
			<div class="auth__container--signin">

				<!-- heading -->
				<h3 class="text-center signin__heading">
					Sign in to your account
				</h3>

				<!-- Authentication form -->
				<AuthForm></AuthForm>
			
			</div> <!-- sign in container end -->
		</div> <!-- authentication container end -->
	</div> <!-- authentication wrapper end -->
</template>

<script>
	/**
	 * includable components (child components)
	 */
	import Header from './../components/homepage/Header'
	import SignupForm from './../components/auth/Signup-form'
	import AuthForm from './../components/auth/Auth-form.vue'

	export default {
		components: {SignupForm, AuthForm},
		mounted() { console.log("User authentication page mounted") }
	}
</script>

<style lang="scss">
	// authentication wrapper
	.taskly-auth{
		height: 800px;
		width: 100%; 
		background-image: url('./../../images/workspace-820315_1920.jpg');
		background-size: cover;
		padding-top:2rem;
		
		
		// authentication container wrapper
		.auth__container{
			min-height:550px;
			width: 65%;
			background: #fff;
			margin: 0px auto;
			margin-top: 2rem;
			
			// if mobile size
			@media screen and (min-width: 400px) and (max-width: 992px){
				width: 100%; 
			} 

			// login container specific
			.auth__container--signin{
				padding: 1.5rem;
				min-height: 550px;
				background: #fff;
				color: #000; 
			}
		}
	}
</style>
