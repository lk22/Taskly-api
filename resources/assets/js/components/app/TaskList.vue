<template>
	<!-- users tasks list -->
        <div class="tasks__container container-fluid">
            <div class="tasks__container--items" v-for="task in tasks">
                <div class="item__head">
                	<slot name="list-header"></slot>
                    <div class="row">
                        <div class="col-md-2 col-lg-2">{{ props.work_hours }}</div>
                        <div class="col-md-2 col-lg-2">{{ props.week_day }}</div>
                        <div class="col-md-2 col-lg-2">{{ props.location }}</div>
                        <div class="col-md-2 col-lg-2">{{ props.supplier }}</div>
                        <!-- <div class="col-md-2 col-lg-2">Weekend / Evening</div> -->
                        <!-- <div class="col-md-2 col-lg-2">Comments</div> -->
                    </div>
                </div>
                <div class="task__container--item">
                    <div class="item__inner">
                        <div class="row task">
                            <div class="task__location col-md-2 col-lg-2">
                                {{ task.work_hours }}
                            </div>

                            <div class="task__weekday col-md-2 col-lg-2">
                                {{ task.week_day }}
                            </div>

                            <div class="task__location col-md-2 col-lg-2">
                                {{ task.location }}
                            </div>

                            <div class="task__supplier col-md-2 col-lg-2">
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
</template>

<script>
	export default {
		props: ['work_hours', 'week_day', 'location', 'supplier', 'comment_count', 'is_weekend'],
	}
</script>