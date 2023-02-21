<template>
	<div>
		<table class="table" id="categoryTable" @click="getEvent">
			<thead>
				<tr>
					<th>image</th>
					<th>name</th>
					<td>actions</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				cargar: false,
				datatable: {},
				categories: []
			}
		},
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				this.cargar = true
				setTimeout(() => this.mountDataTable(), 200)
			},
			mountDataTable() {
				this.datatable = $('#categoryTable').DataTable({
					processing: true,
					serverSide: true,
					ajax: {
						url: '/Categories/GetAllCategoriesDataTable'
					},
					columns: [
                        { data: 'image' },
                        { data: 'name' },
                      { data: 'actions' }]
				})
			},
			getEvent(event) {
				const button = event.target

				if (button.getAttribute('role') == 'edit') {
					this.getCategory(button.getAttribute('data-id'))
				}
				if (button.getAttribute('role') == 'delete') {
					this.deleteCategory(button.getAttribute('data-id'))
				}
			},
			async getCategory(category_id) {
				try {
					const { data } = await axios.get(`Categories/GetCategory/${category_id}`)
					this.$parent.editCategory(data.category)
				} catch (error) {
					console.error(error)
				}
			},
			async deleteCategory(category_id) {
				try {
					const result = await swal.fire({
						title: 'Quiere eliminar la categoria?',
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Eliminar'
					})

					if (!result.isConfirmed) return
					this.cargar = false
					this.datatable.destroy()
					await axios.delete(`Categories/DeleteCategory/${category_id}`)
					this.index()
					swal.fire({
						icon: 'success',
						title: 'Felicidades!',
						text: 'Categoria Eliminada!'
					})
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>
