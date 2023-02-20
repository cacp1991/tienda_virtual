<template>
	<div
		class="modal fade"
		id="createProduct_modal"
		tabindex="-1"
		role="dialog"
		aria-labelledby="exampleModalLabel"
		aria-hidden="true"
	>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						{{ `${is_create ? 'crear' : 'Actualizar'} product` }}
					</h5>

					<button
						type="button"
						class="btn-close"
						data-bs-dismiss="modal"
						aria-label="Close"
					></button>
				</div>
				<!-- vselect o selector categoria -->
				<div class="mb-3">
					<label for="category" class="form-label m-3">Category</label>

					<v-select
						:options="categories"
						v-model="product.category_id"
						:reduce="category => category.id"
						label="name"
						id="category_id"
						class=" modal-body
                        "
					>
					</v-select>

				</div>
				<div class="modal-body">
					<form @submit.prevent="itemProduct" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="images" class="form-label">image</label>
							<input
								type="file"
								class="form-control"
								id="file"
								accept="image/*"
								@change="loadImage"
							/>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">name</label>
							<input
								type="text"
								class="form-control"
								id="name"
								v-model="product.name"
							/>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">description</label>
                            <textarea class="form-control" rows="3" type="text"

								id="description"
								v-model="product.description">
							<input

							/>
                        </textarea>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">price</label>
							<input
								type="numeric"
								class="form-control"
								id="price"
								v-model="product.price"
							/>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">stock</label>
							<input
								type="numeric"
								class="form-control"
								id="stock"
								v-model="product.stock"
							/>
						</div>

						<hr />
						<section class="d-flex justify-content-end mt-3">
							<button
								type="button"
								class="btn btn-secondary me-2"
								data-dismiss="modal"
							>
								Close
							</button>
							<button type="submit" class="btn btn-primary">
								{{ `${is_create ? 'crear' : 'Actualizar'} ` }}
							</button>
						</section>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['product_data'],
		data() {
			return {
				is_create: true,
				product: {},
				file: null,
				categories: [] //data
			}
		},
		created() {
			this.index()
		},
		methods: {
			index() {
                this.getCategories() //index
				this.setProduct()
			},
			// seteamos para edicion
			setProduct() {
				if (!this.product_data) return
				this.product = { ...this.product_data }
				this.is_create = false
			},
			loadImage(event) {
				this.file = event.target.files[0]
			},
			loadFormData() {
				const form_data = new FormData()
				if (this.file) {form_data.append('image', this.file, this.file.name)}
				form_data.append('category_id', this.product.category_id)
				form_data.append('name', this.product.name)
				form_data.append('description', this.product.description)
				form_data.append('price', this.product.price)
				form_data.append('stock', this.product.stock)
				return form_data
			},
			async itemProduct() {
				try {
					const product = this.loadFormData() //capturamos el formdata
					if (this.is_create) {
						await axios.post('Products/SaveProduct', product)
					} else {
						await axios.post(`Products/UpdateProduct/${this.product.id}`, product)
					}
					swal.fire({
						icon: 'success',
						title: 'Felicidades',
						text: 'Producto registrado!'
					})

					this.$parent.closeModal()
				} catch (error) {
					console.error(error)
					swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Algo salio mal!'
					})
				}
			},

			async getCategories() {
				const { data } = await axios.get('Categories/GetAllCategories')
				this.categories = data.categories
			}
		}
	}
</script>
