<template>
	<table class="table" id="userTable" @click="getEvent">
		<thead>
			<tr>
				<th>number_id</th>
				<th>name</th>
				<td>last_name</td>
				<td>email</td>
				<td>actions</td>
			</tr>
		</thead>
		<tbody>
			<!-- aca iteramos -->
			<!-- <tr v-for="(user, index) in users" :key="index">

				<th>{{ user.number_id }}</th>
				<td>{{ user.name }}</td>
				<td>{{ user.last_name }}</td>
				<td>{{ user.email }}</td>
				<td>{{ user.password }}</td>
				<td>
					<button class="btn btn-warning me-2" @click="getUser(user)">Editar</button>
					<button class="btn btn-danger" @click="deleteUser(user)">Eliminar</button>
				</td>
			</tr> -->
		</tbody>
	</table>
</template>

<script>
	export default {
		data() {
			return {
                cargar: false,
				datatable: {},
				users: [],
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
				this.datatable = $('#userTable').DataTable({
					processing: true,
					serverSide: true,
					ajax: {
						url: '/Users/GetAllUsersDataTable'
					},
					columns: [
                    { data: 'number_id' },
                    { data: 'name' },
                    { data: 'last_name' },
                    { data: 'email' },
                    { data: 'actions' }]
				})
			},
            getEvent(event) {
				const button = event.target

				if (button.getAttribute('role') == 'edit') {
					this.getUser(button.getAttribute('data-id'))
				}
				if (button.getAttribute('role') == 'delete') {
					this.deleteUser(button.getAttribute('data-id'))
				}
			},
			async getUser(user_id) {
				try {
                    // console.log(user_id)
                    const { data } = await axios.get(`Users/getUser/${user_id}`)
					this.$parent.editUser(data.user)
				} catch (error) {
					console.error(error)
				}
			},
			async deleteUser(user_id) {
				try {
					const result = await swal.fire({
						icon: 'info',
						title: 'Desea eliminar el usuario ?',
						showCancelButton: true,
						confirmButtonText: 'Eliminar'
					})

					if (!result.isConfirmed) return
                    this.cargar = false
                    this.datatable.destroy()
					await axios.delete(`Users/deleteUser/${user_id}`)
                    this.index()
					swal.fire({
						icon: 'success',
						title: 'Felicidades',
						text: 'usuario Eliminado!'
					})
				} catch (error) {
					console.error(error)
				}
			}
		}
	}

	// para recibir datos lo hacemos por medio de props
	//para acceder a props se hace por data y muestra el alcance de las variables y objetos
</script>
