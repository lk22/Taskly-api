<template>
	<div class="inner-create__form--container">
        <h3 class="text-center text-primary">Create a new task</h3>
		<!-- form component -->
        <form 
            action="#" 
            method="post"
            class="create-task-form center-block"
        >

            <!-- form field group -->
            <div class="form__field--group">
                
                <!-- work_hour -->
                <div class="form-group work_hours-field col-md-5">
                    <label for="work_hours">Work hours <span class="text-danger">*</span></label>

                    <input
                        v-model="work_hours"
                        type="number" 
                        class="form-control" 
                        name="work_hours"
                        placeholder="Enter your work hours"
                    >

                </div>

                <!-- week details -->
                <div class="week-details col-md-7 col-lg-7">
                    
                    <!-- week_day -->
                    <div class="form-group weekday col-md-6 col-lg-6">
                        <label for="weekday">Week day <span class="text-danger">*</span></label>

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
                        <label for="week">Week <span class="text-danger">*</span></label>

                        <input 
                            v-model="week"
                            type="number"
                            name="week"
                            class="form-control"
                            placeholder="Enther the week" 
                        >
                    </div>

                </div>

                <!-- location field -->
                <div class="form-group location-field">
                    <label for="location">Location <span class="text-danger">*</span></label>

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
                    <small class="field-info text-info">Define the location you are doing this task at</small>
                </div>

                <!-- supplier field -->
                <div class="form-group supplier-field">
                    <label for="supplier">Supplier <span class="text-danger">*</span></label>

                    <input 
                        v-model="supplier"
                        type="text"
                        name="supplier"
                        class="form-control"
                        placeholder="Enter supplier"
                    >
                    <small class="field-info text-info">Define the supplier you are doing a task for</small>
                </div>

                <!-- weekend/evening job field -->
                <div class="form-group weekend_evening--check-field">
                    <label for="weekeend">Weekend / Evening</label>

                    <input 
                        v-model="weekend"
                        type="checkbox"
                        name="weekend"
                    >
                    <small class="field-info text-info">Control if this task is a weekend or a evening task</small>
                </div>

                <!-- comment field -->
                <div class="form-group comment-field">

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

                    <small class="field-info text-info">Make a clearer note about what your task is about</small>
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

        <Notification v-if="error" status="critical">
            {{ msg }}
        </Notification>
	</div>
</template>

<script>
import Notification from './wrappers/Notification'
	export default {
        components: {Notification},
		data() {
			return {
				work_hours: 	'',
				week_day: 		'',
				week: 			'',
				location: 		'',
				supplier: 		'',
				weekend: 		false,
				comment: 		'',
				error: 			false,
                success:        false
			}
		},

        watch: {

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
					let count = 5

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
        width: 104%; 
        margin-left: -45px;
        padding: 1rem;
        
        @media screen and(max-width: 400px) {
            width:100%;
            margin-left:0px;
        }

        // form
        .create-task-form{
            height: 100%;
            width: 100%;
            width: 80%; 
            
            @media screen and(max-width: 400px) {
                width: 100%; 
            }
            
            .form__field--group{
                .work_hours-field, .location-field, .supplier-field, .weekend_evening--check-field, .comment-field {
                    label{
                        font-size:13px;
                        color: #00b0eb; 
                    }

                    .form-control{
                        border:1px solid #00b0eb;
                        color: #00b0eb;
                        border-radius:2px;

                        &::placeholder{
                            font-size:13px;
                        }
                    }
                }

                // week details
                .week-details {
                    .weekday, .week{
                        @media screen and(max-width: 400px) {
                            width: 100%;
                            padding-left: 0px;
                            padding-right: 0px; 
                        }
                        label{
                            font-size:13px;
                            color: #00b0eb;
                        }

                        .form-control{
                            border: 1px solid #00b0eb;
                            color: #00b0eb;
                            border-radius:2px;

                            &::placeholder{
                                font-size:13px;
                            }
                        }
                    }
                }

                .submit{
                    .btn{
                        border:1px solid #00b0eb;
                        background: transparent;
                        color: #00b0eb;
                        margin-left: 1.5rem;
                        
                        &:hover{
                            background: #00b0eb;
                            color: #fff;
                        }
                        
                        @media screen and(max-width: 400px) {
                        margin-left: 0px;
                            width: 100%; 
                        }
                    }   
                }
            }
        }
    }

</style>