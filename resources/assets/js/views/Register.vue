<template>
	<!-- authentication wrapper -->
	<div class="taskly-register">
		<Header/>
		
		<!-- auth container -->
		<div class="register__container">
			
			<!-- signup container -->
			<div class="col-md-6 register__container--signup">
				
				<h3 class="signup-heading text-center">
					Sign up your new account
				</h3>

				<!-- Signup form components -->
				<SignupForm></SignupForm>

			</div> <!-- signup conatiner end -->
			
			<!-- signin container -->
			<div class="col-md-6 register__container--signin">

				<!-- heading -->
				<h3 class="text-center signin__heading">
					Or sign in to your existing account
				</h3>

				<!-- Authentication form -->
				<div class="signin__container">
					
					<!-- signin form container -->
					<div class="signin__container--form">
						
						<!-- signin form -->
						<form 
							action="#"
							method="post"
							class="signin-form"
						>
							
							<!-- field group -->
							<div class="field-group">
								
								<!-- username field -->
								<div class="form-group username-field">
									
									<!-- label -->
									<label for="username">Username:</label>

									<!-- field -->
									<input
										type="text"
										placeholder="Enter your username here"
										class="form-control"
										name="username"
									>
								</div> <!-- username field end -->

								<!-- password field -->
								<div class="form-group password-field">
									
									<!-- label -->
									<label for="password">Password:</label>

									<!-- field -->
									<input 
										type="password"
										placeholder="Enter your password here"
										class="form-control"
										name="password"
									>

								</div> <!-- password field end -->

								<!-- auth field -->
								<div class="form-group auth-field">
									
									<!-- auth button -->
									<input 
										type="submit"
										class="btn btn-primary auth-btn"
										value="Sign in"
									>

								</div> <!-- auth field end -->

							</div> <!-- field group end -->
						</form> <!-- signin form end -->
					</div> <!-- signin form container end -->
				</div><!-- signin container end -->
			
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
		mounted() {
			console.log("User registration page mounted")
		}
	}
</script>

<style lang="scss">
	// auth wrapper
	.taskly-register{
		height: 800px;
		width: 100%; 
		background-image: url('./../../images/workspace-820315_1920.jpg');
		background-size: cover;
		
		// auth container wrapper
		.register__container{
			min-height:550px;
			width: 80%;
			background: #fff;
			margin: 0px auto;
			margin-top: 2rem;

			// styles to define on both containers
			.register__container--signup, .register__container--signin{
				padding: 1.5rem;
			}

			// login container specific
			.register__container--signin{
				min-height: 550px;
				background: #809ed3;
				color: #fff; 
				
				// signin container
				.signin__container{
					height: 100%;
					width: 75%;
					margin: 0 auto;
					
					// signin form container
					.signin__container--form{
						padding-top:2rem;
						
						// form
						.signin-form{
							// field group
							.field-group{
								// username & password field group
								.username-field, .password-field{
									// field
									.form-control{
										border-radius: 0px;
										background: transparent;
			                			border:none;
										box-shadow: inset 0px 0px 0px 0px red;
										border-bottom: 1px solid #fff;
										padding:0;
										color: #fff; 
										
										// placeholder
										&::placeholder{
											font-size: 13px;
											color: #eee; 
										}
									}
								}

								// auth field
								.auth-field{
									.auth-btn{
										width: 100%;
										background: #fff;
										color: #809ed3;
										border:none;
										border-radius:20px;  
									}
								}
							}
						}
					}
				} 
			}
		}
	}
</style>