<template>
	<!-- authentication wrapper -->
	<div class="taskly-auth">
		<Header/>
		<!-- auth container -->
		<div class="auth__container">
			
			<!-- signin container -->
			<div class="auth__container--signin">

				<!-- heading -->
				<h3 class="text-center signin__heading">
					Sign in to your account
				</h3>

				<!-- Authentication form -->
				<AuthForm></AuthForm>
			
			</div> <!-- signin container end -->
		</div> <!-- auth container end -->
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
		components: {Header, SignupForm, AuthForm},
		mounted() { console.log("User authentication page mounted") }
	}
</script>

<style lang="scss">
	// auth wrapper
	.taskly-auth{
		height: 800px;
		width: 100%; 
		background-image: url('./../../images/workspace-820315_1920.jpg');
		background-size: cover;
		
		// auth container wrapper
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
