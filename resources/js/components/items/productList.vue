<template>
	<table class="table" id="productTable" @click="getEvent">
		<thead>
			<tr>
				<th>name</th>
				<th>description</th>
				<th>image</th>
				<th>price</th>
				<th>stock</th>
				<td>acciones</td>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</template>

<script>
	export default {
		data() {
			return {
				load: false,
				products: [],
				datatable: {}
			}
		},
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				this.load = true
				setTimeout(() => this.mountDataTable(), 200)
			},
			mountDataTable() {
				this.datatable = $('#productTable').DataTable({
					processing: true,
					serverSide: true,
					ajax: {
						url: '/Products/GetAllProductsDataTable'
					},
					columns: [
                    { data: 'name' },
                    { data: 'description' },
                    { data: 'image' },
                    { data: 'price' },
                    { data: 'stock' },
                    { data: 'actions' }]
				})
			},
            getEvent(event) {
				const button = event.target

				if (button.getAttribute('role') == 'edit') {
					this.getProduct(button.getAttribute('data-id'))
				}
				if (button.getAttribute('role') == 'delete') {
					this.deleteProduct(button.getAttribute('data-id'))
				}
			},
			// esta funcion va dirijida al controlador de productos
			async getProduct(product_id) {
				try {
					const { data } = await axios.get(`Products/GetProduct/${product_id}`)
					this.$parent.editProduct(data.product)
				} catch (error) {
					console.error(error)
				}
			},
			async deleteProduct(product_id) {
				try {
					const result = await swal.fire({
						icon: 'info',
						title: 'Desea eliminar el producto ?',
						showCancelButton: true,
						confirmButtonText: 'Eliminar'
					})

					if (!result.isConfirmed) return
                    this.load = false
                    this.datatable.destroy()
					await axios.delete(`Products/DeleteProduct/${product_id}`)
					this.index()
					swal.fire({
						icon: 'success',
						title: 'Felicidades',
						text: 'Producto Eliminado!'
					})
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>
