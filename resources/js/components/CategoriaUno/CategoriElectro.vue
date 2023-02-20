<template>
	<section class="d-flex justify-content-center flex-wrap">
		<div class="card m-5" style="width: 14rem" v-for="(product, index) in product" :key="index">
			<img
				:src="`/storage/images/${product.image}`"
				alt=""
				class="card-img-top"
				width="100"
				height="160"
				v-if="product.image"
			/>

			<img src="electrodomesticos.jpeg" class="card-img-top" alt="producto" v-else />

			<div class="card-body d-flex justify-content-center flex-wrap">
				<a :href="`/Categories/GetCategoryElectric/${product.id}`"
					><H5 class="card-name">{{ product.name }}</H5>
				</a>
				<H5 class="card-description">{{ product.description }}</H5>
				<!-- <H5 class="card-price">${{ product.price }}</H5> -->
				<!-- <H5 class="card-stock"> {{ product.stock }} unidades</H5> -->

				<a :href="`/Categories/GetCategoryElectric/${product.id}`" class="btn btn-primary"
					>Detalles</a
				>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		props: ['product'],

		data() {
			return {}
		},

		mounted() {},

		methods: {}
	}
</script>
