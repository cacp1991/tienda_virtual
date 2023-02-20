<template>

	<div class="card m-5">
		<div class="card-header d-flex justify-content-between">
			<h2>CREAR CATEGORIA</h2>

			<!-- al hacer click en el boton abrimos el modal -->

			<button @click="abrirModal" class="btn btn-primary">crear categoria</button>
		</div>

		<!-- crear tabla -->
		<div class="card-body">
			<category-list ref="table" />
		</div>

		<!-- crear usuarios y desmontamos modal -->

		<section v-if="cargar_modal">
			<category-modal :category_data="category" />
		</section>
	</div>
</template>

<script>
	import CategoryList from './CategoryList.vue'
	import CategoryModal from './CategoryModal.vue'

	export default {
		components: {
			CategoryList,
			CategoryModal
		},
		data() {
			return {
				cargar_modal: false, //secccion crear usuarios
				categorymodal: null,
				category: null
			}
		},
		methods: {
			// esta funcion da vida al modal
			abrirModal() {
				this.cargar_modal = true

				setTimeout(() => {
					this.categorymodal = new bootstrap.Modal(
						document.getElementById('category_modal'),
						{ keyboard: true }
					)
					this.categorymodal.show()

					const categorymodal = document.getElementById('category_modal')
					categorymodal.addEventListener('hidden.bs.modal', () => {
						this.cargar_modal = false
						this.category = null
					})
				}, 200)
			},
			 closeModal() {
				this.categorymodal.hide()
				this.$refs.table.datatable.destroy()
				this.$refs.table.index()
			},
			editCategory(category) {
				this.category = category
				this.abrirModal()
			}
		}
	}
</script>
