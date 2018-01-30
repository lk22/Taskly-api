<template>
	<div id="app-head">
		<div class="head__inner">
			<div class="inner--content">
				<div class="content__row row">
					<div class="row--heading col-md-3 col-lg-3">
						<slot name="auth">Michael Hansen</slot> - {{ page }}
					</div>

					<div class="row--searchBar col-md-6 col-lg-6">
						<!-- search bar component here <SearchBar></SearchBar> -->
					</div>

					<div class="row--create-button col-md-3 col-lg-3">
						<slot name="create-task-button"></slot>
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
		}
	}
</script>