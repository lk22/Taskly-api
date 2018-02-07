<template>
	<div id="app-head">
		<div class="head__inner">
			<div class="inner--content">
				<div class="content__row row">
					<div class="row--heading col-xs-9 col-sm-6 col-md-11 col-lg-11">
						{{ name }} - {{ page }}
					</div>

					<!-- <div class="row--searchBar hidden-xs hidden-sm col-md-6 col-lg-6">
						<!-- search bar component here <SearchBar></SearchBar> -->
					<!-- </div> -->

					<div class="row--create-button col-xs-3 col-md-1 col-lg-1">
						<slot></slot>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			page:{
				type: String,
				required: true
			}
		},

		computed: {
			name() {
				return this.$store.getters['auth/fullName']
			}
		}
	}
</script>

<style lang="scss">
	
	#app-head {
		font-family: 'Raleway';
		height: 100px;
		width: 100%;
		margin-left: -30px;
	
		@media screen and(max-width: 400px) {
			margin-left: 0px; 
		}

		.head__inner{
			padding-top: 3rem;
			border-bottom: 1px solid #eee;
			padding-left:15px;
			padding-right: 15px;
			height:70px;
			
			.inner--content{
				.content__row{
					.row--heading{
						color: #00b0eb;
					}

					.row--create-button{
						.btn {
							border:none;
							background: transparent;
							color: #00b0eb;
							margin-top: -10px;
							font-size: 20px;
							
							&:active{
								border:none;
							}
						}
					}
				}
			}
		}
	}

</style>