<template>
    <div id="app-tasks">
        <div class="tasks__create--container" v-if="task.create.creating === true">
                
                <!-- form component -->
                <form 
                    action="#" 
                    method="post"
                    class="create-task-form"
                >

                    <!-- form field group -->
                    <div class="form__field--group">
                        
                        <!-- work_hour -->
                        <div class="form-group work_hours-field col-md-1 col-lg-1">
                            <label for="work_hours">Work hours</label>

                            <input 
                                type="number" 
                                class="form-control" 
                                name="work_hours"
                            >
                        </div>

                        <!-- week details -->
                        <div class="week-details col-md-2 col-lg-2">
                            
                            <!-- week_day -->
                            <div class="form-group weekday col-md-6 col-lg-6">
                                <label for="weekday">Week day</label>

                                <input 
                                    type="text" 
                                    name="week_day" 
                                    class="form-control"
                                >
                            </div>
    
                            <!-- week count -->
                            <div class="form-group week col-md-6 col-lg-6">
                                <label for="week">Week</label>

                                <input 
                                    type="number"
                                    name="week"
                                    class="form-control"
                                >
                            </div>

                        </div>

                        <!-- location field -->
                        <div class="form-group location-field col-md-2 col-lg-2">
                            <label for="location">Location</label>

                            <!-- <select v-for="location in locations" name="location" id="location">
                                <option value="{{ location.id }}">{{ location.name }}</option>
                            </select> -->

                            <input 
                                type="text"
                                name="location"
                                class="form-control"
                            >
                        </div>

                        <!-- supplier field -->
                        <div class="form-group supplier-field col-md-2 col-lg-2">
                            <label for="supplier">Supplier</label>

                            <input 
                                type="text"
                                name="supplier"
                                class="form-control"
                            >
                        </div>

                        <!-- weekend/evening job field -->
                        <div class="form-group weekend_evening--check-field col-md-2 col-lg-2">
                            <label for="weekeend">Weekend / Evening</label>

                            <input 
                                type="checkbox"
                                name="weekend"
                                class="form-control"
                            >
                        </div>

                        <!-- comment field -->
                        <div class="form-group comment-field col-md-3 col-lg-3">
                            <label for="comment">Comment</label>

                            <textarea 
                                name="comment" 
                                id="comment" 
                                cols="20" 
                                rows="5"
                                class="form-control"
                            ></textarea>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</template>

<script>
	import Sidebar from './../components/app/Sidebar'
    import Header from './../components/app/Header'
    export default {
    	components: { Sidebar, Header },
        layout: 'app',
        data() {
            return {
                task: {
                    create: {
                        creating:       true,  // if user wants to create a new tasks
                        week_hours:     '',     // defining work hours
                        week_day:       '',     // defining week day of the task
                        week:           '',     // defining week number of the task
                        location:       '',     // defining location for the task
                        supplier:       '',     // defining supplier for the task
                        weekend:        false,  // defining if the task is a weekend/evening job
                        comment:        '',     // defining the comment
                        validation: {
                            error:      false   // if validation goes wrong 
                        }
                    },
                    update: {
                        updating:       false,
                        validation: {
                            error:      false   // if patch validation fails
                        }
                    }
                },
                locations:              [],     // selecting all locations from databse
                completed:              false   // if task is completed
            }
        },
    }
</script>