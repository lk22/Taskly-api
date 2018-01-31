<template>
    <div id="app" class="dashboard">
		<div class="col-md-1 app-sidebar">
            <Sidebar />
        </div>
        <div class="col-md-11 dashboard__content">
            <div class="container-fluid app-content">
            	<router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
	import Sidebar from './../components/app/Sidebar'
    import Header from './../components/app/Header'
    import axios from 'axios'
    export default {
    	components: { Sidebar, Header },
        computed: {
            auth() {
                axios.get('api/v1/auth').then((response) => {
                    return response.data
                })
            }
        },
        mounted() {
            this.$store.dispatch('auth/getAuth', null)
        }
    }
</script>