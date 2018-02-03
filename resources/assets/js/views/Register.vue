<template>
	<!-- authentication wrapper -->
	<div class="taskly-register">
		
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
			<div class="col-md-6 register__container--signin hidden-xs hidden-sm">

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
										v-model="username"
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
										v-model="password"
									>

								</div> <!-- password field end -->

								<!-- auth field -->
								<div class="form-group auth-field">
									
									<!-- auth button -->
									<input 
										type="submit"
										class="btn btn-primary auth-btn"
										value="Sign in"
										@click="authenticate"
									>
								</div> <!-- auth field end -->
							</div> <!-- field group end -->
						</form> <!-- signin form end -->
					</div> <!-- signin form container end -->

					<!-- signin message container -->
					<div class="signin-error-container" v-if="error">
						<div class="alert alert-danger">{{ msg }} <i class="fa fa-times-circle"></i> </div>
					</div>

					<!-- success message container -->
					<div class="signin-success-container" v-if="success">
						<div class="alert alert-success">{{ msg }} <i class="fas fa-circle-notch"></i></div>
					</div>

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

		data() {
			return {
				success: false,
				error: false,
				username: '',
				password: ''
			}
		},

		mounted() {
			console.log("User registration page mounted")
		},

		methods: {
			authenticate(e){
				e.preventDefault()
				if (
					this.username === '' && this.password === '' ||
	               	this.username && this.password === '' ||
	               	this.username === '' && this.password
				) {

					console.log("failed")
					this.error = true
					let seconds = 10

					setInterval(() => {
						seconds--
						if(seconds === 0){
							this.error = false
							clearInterval()
						}
					}, 1000)
				} 

				// if both username and password is set
				if (this.username && this.password) {
					
					this.$store.dispatch('auth/login', {
						username: this.username,
						password: this.password
					}).then(() => {
						
						this.success = true
						
						let count = 10;
						setInterval(() => {
							count--

							if(count === 0){
								this.$router.replace({
									'path': '/app/dashboard/tasks'
								})
							}
						}, 1000)
					})

				}
			}
		},

		computed: {
			msg() {
				if(this.error)
					return 'Your credentials seems to be entered wrong try again'

				if(this.success)
					return 'Authentication success hold on.'
			},
		}
	}
</script>

<style lang="scss">
	// auth wrapper
	.taskly-register{
		min-height: 800px;
		width: 100%; 
		background-image: url('./../../images/workspace-820315_1920.jpg');
		background-size: cover;
		padding-top:2rem;
		
		// auth container wrapper
		.register__container{
			min-height:630px;
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
				min-height: 630px;
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