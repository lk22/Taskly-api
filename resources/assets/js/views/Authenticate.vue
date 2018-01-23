<template>
	<!-- authentication wrapper -->
	<div class="taskly-auth">
		<Header/>
		
		<!-- auth container -->
		<div class="auth__container">
			
			<!-- signup container -->
			<div class="col-md-6 auth__container--signup">
				
				<h3 class="signup-heading text-center">
					Sign up your new account
				</h3>

				<!-- Signup form components -->
				<SignupForm></SignupForm>

			</div> <!-- signup conatiner end -->
			
			<!-- login container -->
			<div class="col-md-6 auth__container--login">

				<!-- heading -->
				<h3 class="text-center login__heading">
					Or sign in to your existing account
				</h3>
			
			</div> <!-- login container end -->
		</div> <!-- auth container end -->
	</div> <!-- authentication wrapper end -->
</template>

<script>
	/**
	 * includable components (child components)
	 */
	import Header from './../components/homepage/Header'
	import SignupForm from './../components/auth/Signup-form'

	export default {
		components: {Header, SignupForm}
	}
</script>

<style lang="scss">
	// auth wrapper
	.taskly-auth{
		min-height: 800px;
		width: 100%; 
		background-image: url('./../../images/workspace-820315_1920.jpg');
		background-size: cover;
		
		// auth container wrapper
		.auth__container{
			min-height:550px;
			width: 80%;
			background: #fff;
			margin: 0px auto;
			margin-top: 2rem;

			// styles to define on both containers
			.auth__container--signup, .auth__container--login{
				padding: 1.5rem;
			}

			// login container specific
			.auth__container--login{
				min-height: 550px;
				background: #809ed3;
				color: #fff; 
			}
		}
	}
</style>
