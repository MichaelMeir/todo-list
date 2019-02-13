<template>
	<div class="flex">
    	<div class="checkbox bg-beige border-2 border-black outline-none w-5 h-5 mt-2 cursor-pointer" 
    	v-on:click="check(taskdata)">
    		<svg v-if="checked(taskdata)" class=" w-3 h-4 text-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg>
    	</div>
    	<div contenteditable="true" ref="input" @blur="onChange(taskdata)" class="text-left bg-beige border-b-2 border-black outline-none mt-2 ml-1 min-h-5 w-9/10" v-model="taskdata.body">{{ taskdata.body }}</div>
        <svg @click="remove(taskdata)" class="content-end w-4 h-4 mt-2 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" class=""></path></svg>
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
                    this.$parent.sortTasks()
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
                    'body': this.$refs.input.textContent
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
                var range = document.createRange();
                var sel = window.getSelection();
                range.setStart(this.$refs.input, 1);
                range.collapse(true);
                sel.removeAllRanges();
                sel.addRange(range);
            },

            remove(task) {
                axios.post('/delete/task/' + task.id, {
                    'task': task
                }).then(res => {
                    this.$parent.removeTask(task);
                }).catch(err => {
                    this.busy = false;
                    console.error(err);
                })
            }
        }
    }
</script>