<template>
	<div class="card m-5">
		<div class="card-header d-flex justify-content-between">
			<h2>CREAR USUARIO</h2>

			<!-- al hacer click en el boton abrimos el modal -->

			<button @click="openModal" class="btn btn-primary">Crear Usuario</button>
		</div>

		<!-- listamos usuarios en un recuadro -->
        <div class="card-body">
			<user-list ref="table" />
		</div>

		<!-- crear usuarios y desmontamos -->
		<section v-if="cargar_modal">
			<user-modal :user_data="user" />
		</section>
	</div>
</template>

<script>
	import userList from './userList.vue'
	import userModal from './userModal.vue'


	export default {
		components: {
			userList,
			userModal,
		},
		data() {
			return {
                cargar:false,
                users: [],
				cargar_modal: false, //secccion crear usuarios
				usermodal: null,
                user: {}
			}
		},
		methods: {
            // esta funcion da vida al modal
			openModal() {
				this.cargar_modal = true

				setTimeout(() => {
					this.usermodal = new bootstrap.Modal(
						document.getElementById('user_modal'),
						{
							keyboard: false
						}
					)
					this.usermodal.show()

					const usermodal = document.getElementById('user_modal')
					usermodal.addEventListener('hidden.bs.modal', () => {
						this.cargar_modal = false
						this.user = null
					})
				}, 200)
			},
            // async getUsers() {
			// 	try {
			// 		this.cargar = false
			// 		const { data } = await axios.get('Users/getUsers')
			// 		this.users = data.users
			// 		this.cargar = true
			// 	} catch (error) {
			// 		console.error(error)
			// 	}
			// },
			// aca cerramos y volvemos a cargar el listado despues de cerrar el modal
			closeModal() {
				this.usermodal.hide()
                this.$refs.table.datatable.destroy()
                this.$refs.table.index()
			},
			editUser(user) {
				this.user = user
				this.openModal()
			}
		}
	}
</script>
