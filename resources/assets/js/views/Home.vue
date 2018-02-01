<template>
	<div id="app-home">
		<Header />

		<router-view></router-view>
	</div>
</template>

<script>
	import Header from './../components/homepage/Header'

	export default {
		components: {Header}
	}
</script>

<style lang="scss">
	#app-home{
		font-family:'Raleway';
	}
</style>