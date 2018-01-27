<template>
	<!-- signup container wrapper -->
	<div class="signup__container">
		
		<!-- signup form container -->
		<div class="signup__container--form">

			<!-- signup form -->
			<form 
				action="#" 
				method="post"
				class="signup-form"
			>
				
				<!-- field group -->
				<div class="field-group">

					<!-- 
						firstname and lastname group
					-->
					<div class="row name-group">
						
						<!-- firstname field -->
						<div class="col-md-6 form-group firstname-field">
							
							<!-- label -->
							<label for="firstname">Firstname:</label>

							<!-- field -->
							<input 
								type="text"
								placeholder="Enter your firstname here"
								class="form-control"
								name="firstname"
							>

						</div> <!-- firstname field end -->

						<!-- lastname field -->
						<div class="col-md-6 form-group lastname-field">
							
							<!-- label -->
							<label for="lastname">Lastname:</label>

							<!-- field -->
							<input 
								type="text"
								placeholder="Enter your lastname here"
								class="form-control"
								name="lastname"
							>

						</div>

					</div>

					<!-- email field -->
					<div class="form-group email-field">
						
						<!-- label -->
						<label for="email">Email:</label>

						<!-- input field -->
						<input
							 
							type="email"
							placeholder="Enter your email here"
							class="form-control"
							name="email"
						>
					</div> <!-- email field end -->

					<!-- password field -->
					<div class="form-group password-field">
						
						<!-- label -->
						<label for="password">Password:</label>

						<!-- input field -->
						<input
							 
							type="password"
							placeholder="Enter your password here"
							class="form-control"
							name="password"
						>
					</div> <!-- password field end-->

					<!-- password confirmation field -->
					<div class="form-group password-confirm-field">
						
						<!-- label -->
						<label for="password_confirm">Confirm Password:</label>

						<!-- input field -->
						<input
							 
							type="password"
							placeholder="Confirm above password"
							class="form-control"
							name="password_confirm"
						>
					</div><!-- password confirm field end -->

					<!-- signup button field -->
					<div class="form-group signup">
						<input 
							type="submit"
							class="btn btn-primary signup-btn"
							value="Sign up" 
							@click="register"
						>
					</div>

					<!-- notification component -->
					<div class="register-notification" v-show="error">
						<div class="alert alert-danger register-warning">
							<p>{{ msg }}</p>
						</div>
					</div> <!-- notification component end -->
				</div> <!-- field group end -->
			</form> <!-- form end -->
		</div><!-- signup form container end -->
	</div> <!-- signup container wrapper end -->
</template>

<script>
	export default {
		data(){
			return {
				error: false,
				name: {
					firstname: '',
					lastname: '',
				},
				email: '',
				see_password: false, // add button to see text instead of * in password fields
				password: '',
				confirm_password: '',
				password_confirmed: null
			}
		},

		mounted() {
			console.log("Signup form component mounted")
		},

		methods:{
			register(e) {
				e.preventDefault()

				// check if the credentials is correctly
				if(
				   this.name.firstname === '' || 
				   this.name.lastname === '' ||
				   this.name.firstname && this.name.firstname < 1 && this.name.lastname === '' && this.name.lastname < 1 ||
				   this.name.firstname && this.name.lastname && this.email === '' ||
				   this.name.firstname && this.name.lastname && this.email && this.password === '' ||
				   this.name.firstname && this.name.lastname && this.email && this.password && this.password < 8
				) {
					this.error = true

					// if the confirmed passsword is the same as the password
					if(this.confirm_password === this.password){
						this.password_confirmed = true
					}

					// if the confirmation password not is the same as the password
					if(!this.confirm_password === this.password) {
						this.password_confirmed = false
					}
				} 

				// if the password is confirmed
				if(this.password_confirmed) {
					// make api call
					console.log('Registration confirmed!')
				}
			}
		},

		computed: {
			msg(){
				if(this.error) {

					if(this.password_confirmed === false){
						return 'The password is not exactly the same as u have been givin please try again,'
					}

					return 'The information you have been givin is not valid please try again'
				}
			}
		}
	}
</script>

<style lang="scss">
	// signup container
	.signup__container{
		height: 100%;
		width: 80%;
		margin:0 auto;
		
		// form container
		.signup__container--form{
			padding-top:2rem;
			
			// form 
			.signup-form{
				margin-left: 10%;
				margin-right: 10%;
				// field group wrapper
				.field-group{
					// firstname & lastname group
					.name-group{
						// firstname field
						.firstname-field, .lastname-field{
							// input
							.form-control{
								border-radius: 0px;
								background: transparent;
                    			border:none;
								box-shadow: inset 0px 0px 0px 0px red;
								border-bottom: 1px solid #000;
								padding:0;
								color: #809ED3; 
								
								// placeholder
								&::placeholder{
									font-size: 10px;
									color: #809ed3; 
								}

								// if focused
								&:focus{
									border-color: #809ed3;
									-webkit-transition: ease-in-out 0.2s all; 
										-moz-transition: ease-in-out 0.2s all; 
										-ms-transition: ease-in-out 0.2s all; 
										-o-transition: ease-in-out 0.2s all; 
										transition: ease-in-out 0.2s all; 	
								}

								// if not focused
								&:not(:focus){
									-webkit-transition: ease-in-out 0.2s all; 
										-moz-transition: ease-in-out 0.2s all; 
										-ms-transition: ease-in-out 0.2s all; 
										-o-transition: ease-in-out 0.2s all; 
										transition: ease-in-out 0.2s all; 
								}
							}
						}
					}

					// email, password, password confirmation field
					.email-field, 
					.password-field, 
					.password-confirm-field{
						.form-control{
							border-radius: 0px;
							background: transparent;
                			border:none;
							box-shadow: inset 0px 0px 0px 0px red;
							border-bottom: 1px solid #000;
							padding:0px;
							color: #809ED3; 
							
							// placeholder
							&::placeholder{
								font-size: 13px;
								color: #809ed3; 
							}

							// if focused
							&:focus{
								border-color: #809ed3;
								-webkit-transition: ease-in-out 0.2s all; 
									-moz-transition: ease-in-out 0.2s all; 
									-ms-transition: ease-in-out 0.2s all; 
									-o-transition: ease-in-out 0.2s all; 
									transition: ease-in-out 0.2s all; 	
							}

							// if not focused
							&:not(:focus){
								-webkit-transition: ease-in-out 0.2s all; 
									-moz-transition: ease-in-out 0.2s all; 
									-ms-transition: ease-in-out 0.2s all; 
									-o-transition: ease-in-out 0.2s all; 
									transition: ease-in-out 0.2s all; 
							}
						}
					}

					// signup button
					.signup{
						.signup-btn{
							border:none;
							border-radius: 20px;
							color: #fff;
							background: #809ed3;
							width: 100%; 
						}
					}
				}
			} 	
		}
	}
</style>