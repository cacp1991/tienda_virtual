<template>
	<div class="card m-5">
		<div class="card-header d-flex justify-content-between">
			<h2>CREAR PRODUCTO</h2>

			<button @click="abrirModal" class="btn btn-primary">Crear Producto</button>
		</div>

		<!-- listamos productos -->
		<div class="card-body">
			<product-list ref="table" />
		</div>

		<!-- creamos productos y desmontamos -->
		<section v-if="load_modal">
			<product-modal :product_data="product" />
		</section>
	</div>
</template>

<script>
	import productList from './productList.vue'
	import productModal from './productModal.vue'

	export default {
		components: {
			productList,
			productModal
		},
		data() {
			return {
				load: false,
				products: [],
				load_modal: false,
				anymodal: null,
				product: {}
			}
		},
		methods: {
			abrirModal() {
				this.load_modal = true

				setTimeout(() => {
					this.anymodal = new bootstrap.Modal(
						document.getElementById('createProduct_modal'),
						{
							keyboard: false
						}
					)
					this.anymodal.show()
					const modal = document.getElementById('createProduct_modal')
					modal.addEventListener('hidden.bs.modal', () => {
						this.load_modal = false
						this.product = null
					})
				}, 200)
			},
			async getProducts() {
				try {
					this.load = false
					const { data } = await axios.get('Products/getProducts')
					this.products = data.products
					this.load = true
				} catch (error) {
					console.error(error)
				}
			},
			closeModal() {
				this.anymodal.hide()
                this.$refs.table.datatable.destroy()
                this.$refs.table.index()
			},
			editProduct(product) {
				this.product = product
				this.abrirModal()
			}
		}
	}
</script>
