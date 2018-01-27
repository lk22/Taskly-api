<script>
    export default {}
</script>

<template>
	<div>
		<div id="sidebar" class="sidebar">
			<div class="sidebar__inner">
				<div class="sidebar__link">
					<i class="fa fa-bars"></i>
				</div>
				<div class="sidebar__link">
					<i class="fa fa-file-excel-o"></i>
				</div>
				<div class="sidebar__link">
					<i class="fa fa-file-pdf-o"></i>
				</div>
				<div class="sidebar__link">
					<i class="fa fa-cog"></i>
				</div>
				<div class="bottom">
					<i class="fa fa-user"></i>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="scss">
	#sidebar{
		min-height: 800px;
		width: 100%; 
		border-right: 1px solid #809ed3;
		background: #fff;
		padding:none;

		.sidebar__inner{
			padding: 1.5rem;

			.sidebar__link{
				color: #00b0eb;
				padding-top: 1.5rem;
				padding-left: 0.5rem;
			}

			.bottom{
				position: absolute;
				bottom: 10px;
				left: 2.5rem;
				color: #00B0EB 
			}
		}
	}
</style>