<template>
	<div class="inner-create__form--container">
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
                        v-model="work_hours"
                        type="number" 
                        class="form-control" 
                        name="work_hours"
                    >
                </div>

                <!-- week details -->
                <div class="week-details col-md-3 col-lg-3">
                    
                    <!-- week_day -->
                    <div class="form-group weekday col-md-6 col-lg-6">
                        <label for="weekday">Week day</label>

                        <input 
                            v-model="week_day"
                            type="text" 
                            name="week_day" 
                            class="form-control"
                            placeholder="Enter weekday"
                        >
                    </div>

                    <!-- week count -->
                    <div class="form-group week col-md-6 col-lg-6">
                        <label for="week">Week</label>

                        <input 
                            v-model="week"
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
                        v-model="location"
                        type="text"
                        name="location"
                        class="form-control"
                        placeholder="Enter location"
                    >
                </div>

                <!-- supplier field -->
                <div class="form-group supplier-field col-md-2 col-lg-2">
                    <label for="supplier">Supplier</label>

                    <input 
                        v-model="supplier"
                        type="text"
                        name="supplier"
                        class="form-control"
                        placeholder="Enter supplier"
                    >
                </div>

                <!-- weekend/evening job field -->
                <div class="form-group weekend_evening--check-field col-md-1 col-lg-1">
                    <label for="weekeend">Weekend / Evening</label>

                    <input 
                        v-model="weekend"
                        type="checkbox"
                        name="weekend"
                    >
                </div>

                <!-- comment field -->
                <div class="form-group comment-field col-md-3 col-lg-3">

                    <label for="comment">Comment</label>

                    <textarea
                        v-model="comment"
                        name="comment" 
                        id="comment" 
                        cols="20" 
                        rows="2"
                        class="form-control"
                        placeholder="Give your task a comment"
                    ></textarea>
                </div>

                <div class="row submit">
                    
                    <!-- submit button -->
                    <div class="form-group">
                        <button
                            class="submit-task-btn btn btn-primary"
                            @click="createTask"
                        >
                            Create <i class="fa fa-pencil"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>


        <!-- error container-->
        <div class="create-task__error" v-if="error">
        	<div class="alert alert-danger">
        		{{ msg }}
        	</div>
        </div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				work_hours: 	'',
				week_day: 		'',
				week: 			'',
				location: 		'',
				supplier: 		'',
				weekend: 		false,
				comment: 		'',
				error: 			'',
			}
		},

		methods: {
			validateTask() {
				if(
				   this.work_hours === '' ||
				   this.location === '' ||
				   this.supplier === '' ||
				   this.work_hours && this.location === '' && this.supplier === '' ||
				   this.work_hours && this.location && this.supplier === ''
				) {
					this.error = true
					let count = 2

					setInterval(() => {
						count--

						if(count === 0)
							this.error = false
						clearInterval()
					}, 1000)
				}

				// if( this.error === true && this.work_hours && this.location && this.supplier ) {
				// 	this.error = false
				// }
			},

			createTask(e) {
				e.preventDefault()

				this.validateTask()

				if( !this.error ) {
					this.$store.dispatch('task/createTask', {
						work_hours: 	this.work_hours,
						week_day: 		this.week_day,
						week: 			this.week,
						location: 		this.location,
						supplier: 		this.supplier,
						weekend: 		this.weekend,
						comment: 		this.comment
					}).then(() => {
						this.creating = false
					})
				}
			}
		},

		computed: {
			msg() {
				if( this.work_hours === '' ) {
					return 'Your estimated work hours is required.'
				}

				if( this.location === '' ) {
					return 'You need to define a location for your task'
				}

				if( this.supplier === '' ) {
					return 'You need to define a supplier your doing this task for.'
				}
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

        // form
        .create-task-form{
            height: 100%;
            width: 100%;
            
            .form__field--group{
                .work_hours-field, .location-field, .supplier-field, .weekend_evening--check-field, .comment-field {
                    label{
                        font-size:10px;
                        color: #eee; 
                    }

                    .form-control{
                        border:1px solid #00b0eb;
                        color: #00b0eb;
                        border-radius:2px;

                        &::placeholder{
                            font-size:10px;
                        }
                    }
                }

                // week details
                .week-details {
                    .weekday, .week{
                        label{
                            font-size:10px;
                            color: #eee;
                        }

                        .form-control{
                            border: 1px solid #00b0eb;
                            color: #00b0eb;
                            border-radius:2px;

                            &::placeholder{
                                font-size:10px;
                            }
                        }
                    }
                }

                .submit{
                    .btn{
                        border:1px solid #00b0eb;
                        background: transparent;
                        color: #00b0eb;
                        margin-left: 3rem;
                    }   
                }
            }
        }
    }

</style>