<template>

	<div>
		<div @click="newList()" class="text-right cursor-pointer">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4"><path fill="black" d="M352 240v32c0 6.6-5.4 12-12 12h-88v88c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-88h-88c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h88v-88c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v88h88c6.6 0 12 5.4 12 12zm96-160v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-48 346V86c0-3.3-2.7-6-6-6H54c-3.3 0-6 2.7-6 6v340c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z"></path></svg>
		</div>
		<ul v-if="empty(false)" class="list-reset">
			<li v-for="list in lists" class="bg-beige border-b-2 border-black outline-none mt-2 ml-1 h-5 w-full">
				<svg @click="deleteList(list)" class="w-4 h-4 float-left cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg>
				{{ list.name }}
				<a class="no-underline text-black" :href="'/' + list.id">
					<svg class="w-4 h-4 float-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="black" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg>
				</a>
			</li>
		</ul>
		<span v-if="empty(true)">You currently have no lists!</span>
	</div>
</template>

<script>
	export default {
		mounted() {
			console.log('Component mounted.')
		},

		props: ['l'],

		data() {
			return {
				lists: this.l,
			}
		},

		methods: {
			deleteList(list) {
				axios.post('/delete/list/' + list.id, {
                    'list': list
                }).then(res => {
                   	for (var i = this.lists.length - 1; i >= 0; i--) {
                   		if(this.lists[i].id == list.id) {
                   			this.lists.splice(i, 1)
                   		}
                   	}
               	}).catch(err => {
                   	console.error(err);
               	})
			},

			newList() {
				axios.post('/new/list/').then(
					res => {
						this.lists.push(res.data)
					}).catch(err => {
						console.error(err)
					})
			},

			empty(exp) {
				return (!(this.lists.length > 0)) == exp
			},
		}
	}
</script>