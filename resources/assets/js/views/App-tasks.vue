<template>
    <div id="app-tasks">
        <div class="row">
            <Header page="tasks">
                <button 
                    class="create-task-btn btn btn-primary" 
                    @click="toggleCreate"
                >
                    <i class="fa fa-edit"></i>
                </button>
            </Header>
        </div>
        <div class="tasks__create--container" v-if="creating">
            <!-- creating task form -->
            <CreateTaskForm></CreateTaskForm>        
        </div>

        <!-- users tasks list -->
        <div class="tasks__container container-fluid">
            <div class="task__container--items" v-for="task in tasks">
                <div class="item__head">
                    <div class="row">
                        <div class="col-md-2 col-lg-2">Work hours</div>
                        <div class="col-md-2 col-lg-2">Date</div>
                        <div class="col-md-2 col-lg-2">Location</div>
                        <div class="col-md-2 col-lg-2">Supplier</div>
                        <div class="col-md-2 col-lg-2">Weekend / Evening</div>
                        <div class="col-md-2 col-lg-2">Comments</div>
                    </div class="row">
                </div>
                <div class="task__container--item">
                    <div class="item__inner">
                        <div class="row task">
                            <div class="task__location col-md-2 col-lg-2">
                                {{ task.location }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	import Sidebar from './../components/app/Sidebar'
    import Header from './../components/app/Header'
    import CreateTaskForm from './../components/app/Create-task-form'

    export default {
    	components: { Sidebar, Header, CreateTaskForm},
        layout: 'app',
        data() {
            return {
                creating:               false,
                locations:              [],     // selecting all locations from database
                completed:              false   // if task is completed
            }
        },

        methods: {
            toggleCreate(e) {
                e.preventDefault()
                this.creating = !this.creating
            }
        },

        mounted() {
            this.$store.dispatch('task/getTasks') 
        },

        computed: {
            tasks() {
                return this.$store.getters['task/getAllTasks']
            }
        }
    }
</script>

<style lang="scss">
    

    // desktop task create form
    .tasks__create--container{
        transition: ease-in-out 0.2s all;
        min-height: 150px;
        width: auto; 
    }

</style>