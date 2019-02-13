
<template>
	<div>
		<div class="flex w-full justify-between">
			<a href="/" class="my-auto"><svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="black" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z" class=""></path></svg></a>
			<div class="content-center mx-auto">
				<input @change="changeName()" class="bg-beige border-b-2 border-black outline-none mt-2 ml-1 h-5 container w-64" type="input" name="" v-model="name">
			</div>
			<div @click="sortClick()">
				<svg v-if="!this.up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4"><path fill="black" d="M4.702 116.686l79.984-80.002c6.248-6.247 16.383-6.245 22.627 0l79.981 80.002c10.07 10.07 2.899 27.314-11.314 27.314H128v320c0 8.837-7.163 16-16 16H80c-8.837 0-16-7.163-16-16V144H16.016c-14.241 0-21.363-17.264-11.314-27.314zM240 96h256c8.837 0 16-7.163 16-16V48c0-8.837-7.163-16-16-16H240c-8.837 0-16 7.163-16 16v32c0 8.837 7.163 16 16 16zm-16 112v-32c0-8.837 7.163-16 16-16h192c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16H240c-8.837 0-16-7.163-16-16zm0 256v-32c0-8.837 7.163-16 16-16h64c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16h-64c-8.837 0-16-7.163-16-16zm0-128v-32c0-8.837 7.163-16 16-16h128c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16H240c-8.837 0-16-7.163-16-16z"></path></svg>
				<svg v-if="this.up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class=" w-4 h-4"><path fill="black" d="M187.298 395.314l-79.984 80.002c-6.248 6.247-16.383 6.245-22.627 0L4.705 395.314C-5.365 385.244 1.807 368 16.019 368H64V48c0-8.837 7.163-16 16-16h32c8.837 0 16 7.163 16 16v320h47.984c14.241 0 21.363 17.264 11.314 27.314zM240 96h256c8.837 0 16-7.163 16-16V48c0-8.837-7.163-16-16-16H240c-8.837 0-16 7.163-16 16v32c0 8.837 7.163 16 16 16zm-16 112v-32c0-8.837 7.163-16 16-16h192c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16H240c-8.837 0-16-7.163-16-16zm0 256v-32c0-8.837 7.163-16 16-16h64c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16h-64c-8.837 0-16-7.163-16-16zm0-128v-32c0-8.837 7.163-16 16-16h128c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16H240c-8.837 0-16-7.163-16-16z"></path></svg>
			</div>
		</div>
		<div v-if="render" v-for='task in tasks'>
			<task-component :ref="task.id" :key="task.id" :task='task'></task-component>
		</div>
		<div class="flex">
    		<div class="checkbox bg-beige border-2 border-black outline-none w-5 h-5 mt-2"></div>
    		<input @input='newTask()' class="bg-beige border-b-2 border-black outline-none mt-2 ml-1 h-5 w-full" type="text" name="" v-model="input"></input>
    	</div>
	</div>
</template>

<script>
	import Task from './TaskComponent.vue'
	import V from 'vue'

    export default {
        mounted() {
            console.log('List Component mounted.')
        },

        props: ['list'],

        data() {
        	return {
        		tasks: this.list.tasks,
        		name: this.list.name,
        		input: "",
        		render: true,
        		busy: false,
        		up: false,
        		sort: false,
        	}
        },

        methods: {

           	newTask() {
           		if(this.busy) return
           		this.busy = true
           		if(this.input.length > 0) {
           			axios.post('/new/task/' + this.list.id, {
                    	'body': this.input,
                	}).then(res => {
                    	res.data.body = this.input;
                    	this.tasks.push(res.data);
           				this.$nextTick(() => {
           					if(this.$refs.hasOwnProperty(res.data.id)) {
           						this.$refs[res.data.id][0].focus()
           						this.input = "";
           					}
           					this.busy = false;
           				})
                	}).catch(err => {
                    	console.error(err);
                    	this.busy = false;
                	})
           		}
           	},

           	changeName() {
           		console.log(this.name)
           		axios.post('/change/list/' + this.list.id, {
                    'name': this.name,
                }).then(res => {
                   	this.name = res.data.name
               	}).catch(err => {
                   	console.error(err);
                   	this.busy = false;
               	})
           	},

           	removeTask(task) {
           		for (var i = this.tasks.length - 1; i >= 0; i--) {
           			if(this.tasks[i].id == task.id) {
           				this.tasks.splice(i, 1)
           			}
           		}
           	},

           	sortClick() {
           		this.up = !this.up
           		this.sort = true;
           		this.sortTasks()
           	},

           	sortTasks() {
           		if(!this.sort) return;
           		this.tasks.sort((A, B) => {
           			return this.up?B.checked-A.checked:A.checked-B.checked;
           		})
           	}
        }
    }
</script>