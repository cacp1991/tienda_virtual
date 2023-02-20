<template>
	<section class="d-flex justify-content-center flex-wrap">
		<div
			class="card m-5"
			style="width: 14rem"
			v-for="(category, index) in category"
			:key="index"
		>
        <img
				:src="`/storage/images/${category.image}`"
				alt=""
				class="card-img-top"
				width="100"
				height="160"
				v-if="category.image"
			/>

			<div class="card-body">
				<h5 class="card-title h4" >{{ category.name }}</h5>
				<a :href="`/Categories/GetCategoryProduct/${category.id}`" class="btn btn-primary">Detalles</a>
			</div>
		</div>
	</section>
</template>

<script>

	export default {
		data() {
			return {
				category: {}
			}
		},

		created() {
			this.index()
		},
		methods: {
			async index() {
				await this.getCategoriesWithProducts()
			},
			async getCategoriesWithProducts( ) {
				const { data } = await axios.get('/Categories/GetCategoriesWithProducts')
				// console.log (data)
				this.category = data.category
				this.load = true
			}
		}
	}
</script>
