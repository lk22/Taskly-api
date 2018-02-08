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
        <div class="tasks__container container-fluid" v-if="!hideTasks === true">
            <div class="task__container--items" >
                <div class="item__head">
                    <div class="row">
                        <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">Work hours</div>
                        <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">Weekday</div>
                        <div class="col-xs-3 col-sm-2 col-md-3 col-lg-3">Location</div>
                        <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">Supplier</div>
                        <!-- <div class="col-md-2 col-lg-2">Weekend / Evening</div> -->
                        <!-- <div class="col-md-2 col-lg-2">Comments</div> -->
                    </div>
                </div>
                <div class="task__container--item" v-for="task in tasks">
                    <div class="item__inner">
                        <div class="row task">
                            <div class="task__location col-xs-3 col-sm-2 col-md-2 col-lg-2">
                                {{ task.work_hours }}
                            </div>

                            <div class="task__weekday col-xs-3 col-sm-2 col-md-2 col-lg-2">
                                {{ task.week_day }}
                            </div>

                            <div class="task__location col-xs-3 col-sm-2 col-md-3 col-lg-3">
                                {{ task.location }}
                            </div>

                            <div class="task__supplier col-xs-3 col-sm-2 col-md-2 col-lg-2">
                                {{ task.supplier }}
                            </div>

                            <!-- <div class="task-comment-count col-md-2 col-lg-2">
                                {{ task.comments_count }} comments
                            </div> -->

                            <!-- <div class="task-is_weekend col-md-1 col-md-1">
                                {{ task.is_weekend }}
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	import Sidebar          from './../components/app/Sidebar'
    import Header           from './../components/app/Header'
    import CreateTaskForm   from './../components/app/Create-task-form'
    import TaskList         from './../components/app/TaskList'

    export default {
    	components: { Sidebar, Header, CreateTaskForm, TaskList},
        layout: 'app',
        data() {
            return {
                hideTasks:              false,
                creating:               false,
                locations:              [],     // selecting all locations from database
                completed:              false   // if task is completed
            }
        },

        methods: {
            toggleCreate(e) {
                e.preventDefault()
                this.creating = !this.creating
                if(this.creating === true){
                    this.hideTasks = true
                } else {
                    this.hideTasks = false
                }
            }
        },

        beforeMount() {
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

    .tasks__container{
        height: auto;
        margin-left: -45px;
        margin-top:2rem;
        -webkit-transition: ease-in-out 0.2s all; 
        -moz-transition: ease-in-out 0.2s all; 
        -ms-transition: ease-in-out 0.2s all; 
        -o-transition: ease-in-out 0.2s all; 
        transition: ease-in-out 0.2s all; 
        
        @media screen and(max-width: 400px){
            margin:0px;
            width: 100%;
            padding-left:0px;
            padding-right:0px;
        }
        
        .task__container--items{

            .item__head{
                // on mobile version
                @media screen and(max-width: 400px){
                    font-size: 11px;
                }

            }

            .task__container--item{
                cursor: pointer;

                margin-top: 2rem;
                .item__inner{
                    background: #00b0eb;
                    padding: 1.5rem;
                    color: #fff;
                    height:50px;
                    border-radius:2px;
                    
                    &:hover{
                        background: #fff;
                        color: #00b0eb;
                        border: 1px solid #00b0eb;
                    }
                    
                    @media screen and(max-width: 400px) {
                        font-size: 11px;
                    }
                }
            }
        }
    }
    

    // desktop task create form
    .tasks__create--container{
        transition: ease-in-out 0.2s all;
        min-height: 150px;
    }

</style>