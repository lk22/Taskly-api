<template>
    <div id="taskly-app">
		<div class="col-md-1 app-sidebar">
            <Sidebar />
        </div>
        <div class="col-md-11 app-content">
            <div class="container-fluid app-content">
            	
            </div>
        </div>
    </div>
</template>
<script>
	import Sidebar from './../components/app/Sidebar'
    export default {
    	components: { Sidebar }
    }
</script>