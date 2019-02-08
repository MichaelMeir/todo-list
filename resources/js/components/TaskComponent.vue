<template>
	<div class="flex">
    	<div class="checkbox bg-beige border-2 border-black outline-none w-5 h-5 mt-2" 
    	v-on:click="check(taskdata)">
    		<svg v-if="checked(taskdata)" class=" w-3 h-4 text-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg>
    	</div>
    	<input ref="input" @input="onChange(taskdata)" class="bg-beige border-b-2 border-black outline-none mt-2 ml-1 h-5 w-full" type="text" name="" v-model="taskdata.body"></input>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Task Component mounted.')
        },

        data() {
            return {
                taskdata: this.task,
                busy: false,
            }
        },

        props: ['task'],

        methods: {
            check(task) {
                if(this.busy) return;
                this.busy = true;
                axios.post('/check/' + task.id, {
                    'task': task
                }).then(res => {
                    this.busy = false;
                    task.checked = res.data.checked;
                }).catch(err => {
                    this.busy = false;
                    console.error(err);
                })
            },

            checked(task) {
                return task.checked;
            },

            onChange(task) {
                if(this.busy) return
                this.busy = true
                axios.post('/change/task/' + task.id, {
                    'body': task.body
                }).then(res => {
                    this.busy = false
                    task.body = res.data.body;
                }).catch(err => {
                    this.busy = false
                    console.error(err);
                })
            },

            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>