<template>
	<div class="notification__container">
		<div class="inner">
			<slot></slot>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['status'],

		watch: {
			status() {
				if(this.$props.status === "critical") {
					document.querySelector(".notification__container > .inner").style.backgroundColor = "#eb2f06";
				}
			}
		}
	}
</script>

<style lang="scss">
	.notification__container {
		text-align:center;
		position:fixed;
		bottom: 0px;
		right: 0rem;
		border-radius:5px;
		width: 100%;
				
		.inner{
			background: #00b0eb;
			color: #fff;
			padding: 2rem;
			
		}
	}
</style>