<template>
	<!-- signin container -->
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
							v-model="username"
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
							v-model="password"
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
							@click="authenticate"
						>

					</div> <!-- auth field end -->

					<!-- not having a account button -->
					<div class="form-group not-having-account">
						<p><a href="/register">Not having a account</a> ?</p>
					</div>

					<!-- 
						auth notification
						only shows on error
					 -->
					<div class="authentication-notification" v-show="error">
						<div class="alert alert-danger auth-warning">
							<p>{{ msg }}</p>
						</div>
					</div>

				</div> <!-- field group end -->
			</form> <!-- signin form end -->
		</div> <!-- signin form container end -->
	</div><!-- signin container end -->
</template>

<script>
	import axios from 'axios'
	import Store from './../../vuex'

	export default {
		data(){
			return {
				error: false,
				username: '',
				password: '',
				success: false
			}
		},

		mounted() {
			console.log('Authentication component mounted')
		},

		methods: {
			authenticate(e){
				e.preventDefault()
				if (
					this.username === '' && this.password === '' ||
	               	this.username && this.password === '' ||
	               	this.username === '' && this.password
				) {
					this.error = true
					let seconds = 10

					setInterval(() => {
						seconds--
						if(seconds = 0)
							this.error = false
					}, 10000)
				} 

				// if both username and password is set
				if (this.username && this.password) {

					// make api call
					Store.dispatch('auth/login', {

						// credentials to associate with the request
						username: this.username,
						password: this.password
					
					}).then(() => {

						this.success = true

						// setInterval(() => {
						// 	this.$router.replace({path: '/app/dashboard/tasklists'})
						// }, 3000)

						// naviagte to app routes
						this.$router.replace({path: '/app/dashboard/tasklists'})
					})

				}
			}
		},

		computed: {
			msg(){
				if(this.error)
					return 'Your credentials seems to be entered wrong try again'
			}
		}
	}
</script>

<style lang="scss">
	
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
							border-bottom: 1px solid #000;
							padding:0;
							color: #809ed3; 
							
							// placeholder
							&::placeholder{
								font-size: 13px;
								color: #809ed3; 
							}
						}
					}

					// auth field
					.auth-field{
						.auth-btn{
							width: 100%;
							background: #809ed3;
							color: #fff;
							border:none;
							border-radius:20px;  
						}
					}
				}
			}
		}
	} 

</style>