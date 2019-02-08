
<template>
	<div>
		<input @change="changeName()" class="bg-beige border-b-2 border-black outline-none mt-2 ml-1 h-5 container w-64 mx-auto" type="input" name="" v-model="name">
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
           				this.Render(() => {
           					console.log(this.$refs.hasOwnProperty(res.data.id))
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

           	Render(func) {
           		console.log("re-rendering")
           		this.render = false;
        		this.$nextTick(() => {
          			this.render = true;
          			this.$nextTick(func);
        		});
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
           	}
        }
    }
</script>