<template>
	<div id="app-head">
		<div class="head__inner">
			<div class="inner--content">
				<div class="content__row row">
					<div class="row--heading hidden-xs hidden-sm col-md-3 col-lg-3">
						{{ name }} - {{ page }}
					</div>

					<div class="row--searchBar col-md-6 col-lg-6">
						<!-- search bar component here <SearchBar></SearchBar> -->
					</div>

					<div class="row--create-button col-md-3 col-lg-3">
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
						}
					}
				}
			}
		}
	}

</style>