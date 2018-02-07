<template>
    <div id="app" class="dashboard">
		<div class="col-sm-2 col-md-1 app-sidebar">
            <Sidebar />
        </div>
        <div class="col-md-9 dashboard__content">
            <div class="container-fluid app-content">
            	<router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
	import Sidebar from './../components/app/Sidebar'
    import Header from './../components/app/Header'
    
    export default {
    	components: { Sidebar, Header },
    }
</script>