<template>
	<div
		class="card d-flex justify-content-center flex-wrap m-5"
		style="width: 18rem"
		v-for="(category, index) in category"
		:key="index"
	>
		<img
			class="card-img-top"
			:src="`/storage/images/${catgory.image }`"
			alt="Card image cap"
			v-if="category.image"
		/>
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">
				Some quick example text to build on the card title and make up the bulk of the
				card's content.
			</p>
			<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				category: {}
			}
		},
        mounted(){
        },
		created() {
			this.index()
		},
		methods: {
			async index() {
				await this.getCategoriesWithProducts()
			},
			async getCategoriesWithProducts() {

				const { data } = await axios.get('/Categories/GetCategoriesWithProducts')
				this.category = data.category
				this.load = true
			}
		}
	}
</script>
