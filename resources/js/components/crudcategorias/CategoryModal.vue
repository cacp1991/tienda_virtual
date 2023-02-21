<template>
	<div
		class="modal fade"
		id="category_modal"
		tabindex="-1"
		role="dialog"
		aria-labelledby="exampleModalLabel"
		aria-hidden="true"
	>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						{{ `${is_create ? 'Crear' : 'Actualizar'} categoria` }}
					</h5>

					<button
						type="button"
						class="btn-close"
						data-bs-dismiss="modal"
						aria-label="Close"
					></button>
				</div>
				<div class="modal-body">
					<!-- creamos una categoria -->
					<form @submit.prevent="storeCategory" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="image" class="form-label">image</label>
							<input
								type="file"
								class="form-control"
								id="image"
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
								v-model="category.name"
							/>
						</div>
						<hr />
						<section class="d-flex justify-content-end mt-3">
							<button
								type="button"
								class="btn btn-secondary me-2"
								data-dismiss="modal"
							>
								cerrar
							</button>
							<button type="submit" class="btn btn-primary">
								{{ `${is_create ? 'Crear' : 'Actualizar'}` }}
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
		props: ['category_data'],
		data() {
			return {
				is_create: true,
				category: {},
				file: null
			}
		},
		created() {
			this.index()
		},
		methods: {
			index() {
				this.setCategory()
			},
			setCategory() {
				if (!this.category_data) return
				this.category = { ...this.category_data }
				this.is_create = false
			},
			loadImage(event) {
				this.file = event.target.files[0]
			},
			loadFormData() {
				const form_data = new FormData()
				if (this.file) {
					form_data.append('image', this.file, this.file.name)
				}
				form_data.append('name', this.category.name)
				return form_data
			},
			async storeCategory() {
				try {
					const category = this.loadFormData()

					if (this.is_create) {
						await axios.post('Categories/SaveCategory', category)
					} else {
						await axios.post(`Categories/UpdateCategory/${this.category.id}`, category)
					}
					swal.fire({
						icon: 'success',
						title:'Felicidades',
						// title: `Category ${this.is_create ? 'created' : 'updated'}`,
						text: 'Categoria registrada!'
					})
					// aca tenemos la funcion del modal padre
					this.$parent.closeModal()
				} catch (error) {
					console.error(error)
					swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Algo salio mal!'
					})
				}
			}
		}
	}
</script>
