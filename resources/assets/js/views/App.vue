<template>
    <div id="app">
		<div class="col-md-1 app-sidebar">
            <Sidebar />
        </div>
        <div class="col-md-11 app-content">
            <div class="container-fluid app-content">
                <div class="row">
                    <Header page="tasks">
                        <slot name="auth">{{ auth }}</slot>
                        <slot name="create-task-button">
                            <button 
                                class="create-task-btn btn btn-primary" 
                                @click="task.create.creating = true"
                            >
                                Create new task
                            </button>
                        </slot>
                    </Header>
                </div>
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
            axios.get('/api/v1/auth').then((response) => {
                console.log(response.data.name)
            })
        }
    }
</script>